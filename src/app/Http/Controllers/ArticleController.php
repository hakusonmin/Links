<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Genre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    public function home()
    {
        // articles を「月間のいいね順（過去1ヶ月間のいいね数の多い順）」で返すには、
        // likes テーブルと結合して、過去30日間に付けられた like 数をカウント・ソートする
        // 必要がある。(withだけじゃだめ..)
        $articles = Article::with('user')
            ->withCount(['likes as likes_count' => function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subMonth());
            }])
            ->orderByDesc('likes_count')
            ->take(10)
            ->get();

        return Inertia::render('Guest/Home', [
            'articles' => $articles,
        ]);
    }

    public function search(Request $request)
    {
        //デフォルトのクエリ
        $sort = $request->input('sort', 'latest');

        $articles = Article::with('user')
            ->when($request->filled('query'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->query('query') . '%');
            })
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Guest/Article/Search', [
            'articles' => $articles,
            'filters' => $request->only(['query', 'sort']),
        ]);
    }

    public function genre(Genre $genre, Request $request)
    {
        //デフォルトのクエリ
        $sort = $request->input('sort', 'latest');

        $articles = $genre->articles()
            ->with('user')
            ->where('is_published', true)
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Guest/Article/Genre', [
            'genre' => $genre,
            'articles' => $articles,
            'filters' => $request->only('sort'),
        ]);
    }

    public function index(User $user, Request $request)
    {
        $sort = $request->input('sort', 'priority');

        $articles = $user->articles()
            ->with('user')
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->when($sort === 'priority', fn($q) => $q->orderByRaw("FIELD(priority, 'high', 'middle', 'low')"))
            ->paginate(9)
            ->withQueryString();

        // フォローされているかを判定（ログインユーザーが存在する場合のみ）↓ user.isFollowedで可否を取得できます.
        $user->isFollowed = Auth::check()
            ? $user->followers()->where('follower_id', Auth::id())->exists()
            : false;

        return Inertia::render('Guest/Article/Index', [
            'user' => $user,
            'articles' => $articles,
            'filters' => $request->only('sort'),
        ]);
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);

        //↓ここwithで取得しないと下のlikesでEroquentじゃない!と怒られます..
        $article = Article::with(['user', 'links', 'genres', 'likes'])
            ->findOrFail($article->id);

        //ログイン済み&その記事に対していいねしているかチェック
        $isLiked = Auth::check() && $article->likes->contains('user_id', Auth::id());

        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $htmlContent = (string) $converter->convert($article->content);

        return Inertia::render('Guest/Article/Show', [
            'article' => [
                ...$article->toArray(),
                'html_content' => $htmlContent,
                'isLiked' => $isLiked,
            ],
            'comments' => $article->comments()->with('user')->get(),
            'authUser' => Auth::user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Member/Article/Create', [
            'user' => Auth::user(),
        ]);
    }

    public function store(ArticleRequest $request, Article $article)
    {
        DB::transaction(function () use ($request) {

            $article = new Article();
            $article->title = $request->title;
            $article->priority = $request->priority;
            $article->content = $request->content;
            $article->user_id = Auth::user()->id();
            $article->save();

            $genreIds = collect($request->genres)->map(function ($name) {
                return Genre::firstOrCreate(['name' => $name])->id;
            });
            $article->genres()->sync($genreIds);

            // リンク保存
            foreach ($request->links as $link) {
                if (!empty($link['title']) && !empty($link['url'])) {
                    $article->links()->create([
                        'title' => $link['title'],
                        'url' => $link['url'],
                    ]);
                }
            }
        });

        return redirect()
            ->route('articles.show', [Auth::user()->id(), $article->id])
            ->with(['message' => '記事を作成しました', 'status' => 'success']);
    }

    // 編集画面
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        $article->load(['genres', 'links']);

        return Inertia::render('Member/Article/Edit', [
            'article' => $article,
            'genres' => Genre::all(),
            'user' => Auth::user(),
        ]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        DB::transaction(function () use ($request, $article) {
            $article->title = $request->title;
            $article->priority = $request->priority;
            $article->content = $request->content;
            $article->save();

            // ジャンル同期（新規作成も含む）
            $genreIds = collect($request->genres)->map(function ($name) {
                return Genre::firstOrCreate(['name' => $name])->id;
            });
            $article->genres()->sync($genreIds);

            $existingLinks = $article->links->keyBy('id');

            foreach ($request->links as $linkData) {
                if (!empty($linkData['id']) && $existingLinks->has($linkData['id'])) {
                    // 既存のidが送られてきたらUpdate
                    $existingLinks[$linkData['id']]->update([
                        'title' => $linkData['title'],
                        'link_url' => $linkData['link_url'],
                    ]);
                    $existingLinks->forget($linkData['id']); // 更新済みは除外
                } elseif (!empty($linkData['title']) && !empty($linkData['link_url'])) {
                    // それ以外は(=新しく送られてきたid)はCreate)
                    $article->links()->create([
                        'title' => $linkData['title'],
                        'link_url' => $linkData['link_url'],
                    ]);
                }
            }
            // 残っているのはフロントから削除されたもの → 削除
            foreach ($existingLinks as $link) {
                $link->delete();
            }
        });

        return redirect()
            ->route('articles.index')
            ->with(['message' => '記事を編集しました', 'status' => 'success']);
    }

    public function destroy(Request $request, Article $article)
    {
        $this->authorize('delete', $article);

        // 記事削除（カスケードも走ります）
        $article->delete();

        return redirect()
            ->route('articles.index', ['user' => Auth::id()])
            ->with([
                'status' => 'success',
                'message' => '記事を削除しました。',
            ]);
    }

    public function togglePublish(Article $article)
    {
        $this->authorize('update', $article);

        // $this->authorize('update', $article); // オプション：本人だけ許可
        $article->is_published = !$article->is_published;
        $article->save();

        return back()
            ->with(['message' => '記事の公開情報を変更しました', 'status' => 'success']);
    }

    public function like(Article $article)
    {
        $user = Auth::user();

        // すでにlikeしていなければ登録
        if (!$article->isLikedBy($user)) {
            $article->likes()->create(['user_id' => $user->id]);

            // 物理的に article テーブルの likes_count カウントを更新←ここポイント
            $article->increment('likes_count');
        }

        return back()->with('status', 'success')->with('message', 'いいねしました');
    }

    public function unlike(Article $article)
    {
        $user = Auth::user();

        $like = $article->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            // 物理的に article テーブルの likes カウントを更新←ここポイント
            $article->decrement('likes_count');
        }

        return back()->with('status', 'success')->with('message', 'いいねを解除しました');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Models\Article;
use App\Models\Genre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService
    ) {}

    public function home()
    {
        // articles を「月間のいいね順（過去1ヶ月間のいいね数の多い順）」で返すには、
        // likes テーブルと結合して、過去30日間に付けられた like 数をカウント・ソートする
        // 必要がある。(withだけじゃだめ..)

        $articles = Article::with('user')
            ->where('is_published', true)
            ->withCount([
                'likes as monthly_likes_count' => function ($query) {
                    $query->where('created_at', '>=', Carbon::now()->subMonth());
                }
            ])
            ->orderByDesc('monthly_likes_count')
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
        $query = $request->query('query');

        $articles = Article::with('user')
            ->where('is_published', true)
            ->when($request->filled('query'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->query('query') . '%');
            })
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Guest/Article/Search', [
            'articles' => $articles,
            'filters' => [
                'sort' => $sort,
                'query' => $query,
            ],
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
            'filters' => [ 'sort' => $sort ],
        ]);
    }

    public function index(User $user, Request $request)
    {
        $sort = $request->input('sort', 'priority');

        $articles = $user->articles()
            ->with('user')
            ->where('is_published', true)
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
            'filters' => [ 'sort' => $sort ],
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

    public function store(ArticleRequest $request)
    {
        $article = $this->articleService->createArticle($request->validated());

        return redirect()
            ->route('mypage.dashboard', [Auth::id(), $article->id])
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

        $this->articleService->updateArticle($article, $request->validated());

        return redirect()
            ->route('mypage.dashboard')
            ->with(['message' => '記事を編集しました', 'status' => 'success']);
    }

    public function destroy(Request $request, Article $article)
    {
        $this->authorize('delete', $article);

        // 記事削除（カスケードも走ります）
        $article->delete();

        return redirect()
            ->route('mypage.dashboard', ['user' => Auth::id()])
            ->with(['status' => 'success', 'message' => '記事を削除しました。',]);
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

        return back()->with(['message' => 'いいねしました', 'status' => 'success']);
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

        return back()->with(['message' => 'いいねを解除しました', 'status' => 'success']);
    }
}

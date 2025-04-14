<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Genre;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function search(Request $request)
    {
        $query = Article::with('user');

        // 検索キーワード
        if ($request->filled('query')) {
            $query->where('title', 'like', '%' . $request->query('query') . '%');
        }

        // 並び順
        if ($request->sort === 'likes') {
            $query->orderByDesc('likes');
        } else {
            $query->orderByDesc('created_at');
        }

        $articles = $query->paginate(10)->withQueryString();

        return Inertia::render('Guest/Article/Search', [
            'articles' => $articles,
            'filters' => $request->only(['query', 'sort']),
        ]);
    }

    // 作成画面表示
    public function create()
    {
        $genres = Genre::all();

        return Inertia::render('Articles/Create', [
            'genres' => $genres,
        ]);
    }

    // 登録処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'nullable|integer',
            'genres' => 'array',
            'genres.*' => 'integer|exists:genres,id',
            'links' => 'array|max:5',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.link_url' => 'nullable|url|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $article = Article::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'content' => $request->content,
                'priority' => $request->priority,
            ]);

            // ジャンルの同期
            $article->genres()->sync($request->genres);

            // リンクの登録
            foreach ($request->links as $link) {
                if (!empty($link['title']) && !empty($link['link_url'])) {
                    $article->links()->create($link);
                }
            }
        });

        return redirect()->route('articles.index')->with('message', '記事を作成しました');
    }

    // 詳細表示
    public function show(Article $article)
    {
        $article->load(['user', 'genres', 'links']);

        return Inertia::render('Articles/Show', [
            'article' => $article,
        ]);
    }

    // 編集画面
    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        $article->load(['genres', 'links']);

        return Inertia::render('Articles/Edit', [
            'article' => $article,
            'genres' => Genre::all(),
        ]);
    }

    // 更新処理
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'nullable|integer',
            'genres' => 'array',
            'genres.*' => 'integer|exists:genres,id',
            'links' => 'array|max:5',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.link_url' => 'nullable|url|max:2048',
        ]);

        DB::transaction(function () use ($request, $article) {
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'priority' => $request->priority,
            ]);

            $article->genres()->sync($request->genres);

            $article->links()->delete();
            foreach ($request->links as $link) {
                if (!empty($link['title']) && !empty($link['link_url'])) {
                    $article->links()->create($link);
                }
            }
        });

        return redirect()->route('articles.show', $article)->with('message', '記事を更新しました');
    }

    // 削除処理
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index')->with('message', '記事を削除しました');
    }
}

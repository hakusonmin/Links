<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Chapter;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Chapter $chapter)
    {
        $articles = Article::query()
            ->with('chapter')
            ->where('chapter_id', $chapter->id)
            ->get();

        return Inertia::render('User/Article/Index', [ 'chapter' => $chapter, 'articles' => $articles ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Chapter $chapter)
    {
        return Inertia::render('User/Article/Create', ['chapter' => $chapter]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request, Chapter $chapter)
    {
        $model = new Article();
        $model->title = $request->title;
        $model->content = $request->content;
        $model->chapter_id = $chapter->id;
        $model->save();

        return redirect()
            ->route('user.articles.index', ['chapter' => $chapter])
            ->with(['message' => '話を作成しました', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    // ↓ここ 変数の順番大事です
    public function show(Chapter $chapter, Article $article)
    {
        $article = Article::find($article->id);
        $article->load('chapter');
        return Inertia::render('User/Article/Show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter, Article $article)
    {
        $article->load('chapter');
        return Inertia::render('User/Article/Edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Chapter $chapter, Article $article)
    {
        $model = $article;
        $model->title = $request->title;
        $model->chapter_id = $chapter->id;
        $model->save();

        return redirect()
            ->route('user.articles.index', ['chapter' => $chapter])
            ->with(['message' => '話を更新しました', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter, Article $article)
    {
        $article->delete();
        return redirect()
            ->route('user.articles.index', ['chapter' => $chapter])
            ->with(['message' => '話を削除しました', 'status' => 'success']);
    }
}

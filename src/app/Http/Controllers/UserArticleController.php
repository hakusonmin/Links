<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Genre;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;

class UserArticleController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'priority');

        $articles = Article::with('user')
            ->where('user_id', Auth::user()->id)
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes'))
            ->when(
                $sort === 'priority',
                fn($q) =>
                $q->orderByRaw("FIELD(priority, 'high', 'middle', 'low')")
            )
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Guest/UserArticle/Index', [
            'user' => Auth::user(),
            'articles' => $articles,
            'filters' => $request->only('sort'),
        ]);
    }

    public function show(Article $article)
    {
        $article->load(['user', 'links', 'genres']);

        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $htmlContent = (string) $converter->convert($article->content);

        return Inertia::render('Guest/UserArticle/Show', [
            'article' => [
                ...$article->toArray(),
                'html_content' => $htmlContent,
            ],
            'comments' => $article->comments()->with('user')->get(),
            'authUser' => Auth::user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Member/UserArticle/Create' ,[
            'user' => Auth::user(),
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

         return redirect()->route('users.articles.index')->with('message', '記事を作成しました');
     }

     // 編集画面
     public function edit(Article $article)
     {
         $article->load(['genres', 'links']);

         return Inertia::render('Member/UserArticle/Edit', [
             'article' => $article,
             'genres' => Genre::all(),
             'user' => Auth::user(),
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

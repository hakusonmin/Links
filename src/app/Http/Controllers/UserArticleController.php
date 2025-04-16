<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;

class UserArticleController extends Controller
{
    public function index(User $user, Request $request)
    {
        $sort = $request->input('sort', 'priority');

        $articles = Article::with('user')
            ->where('user_id', $user->id)
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
            'user' => $user,
            'articles' => $articles,
            'filters' => $request->only('sort'),
        ]);
    }

    public function show(User $user, Article $article)
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
}

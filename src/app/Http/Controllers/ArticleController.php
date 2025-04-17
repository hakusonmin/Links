<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Genre;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function search(Request $request)
    {
        //all()だとコレクションを取得していない
        $query = User::query();

        // 検索キーワード
        if ($request->filled('query')) {
            $query->where('name', 'like', '%' . $request->query('query') . '%');
        }

        // 並び順
        if ($request->sort === 'followers') {
            $query->orderByDesc('followers');
        } else {
            $query->orderByDesc('created_at');
        }

        $users = $query->paginate(10)->withQueryString();

        return Inertia::render('Guest/User/Search', [
            'users' => $users,
            'filters' => $request->only(['query', 'sort']),
        ]);
    }
}

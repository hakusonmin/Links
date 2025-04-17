<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $query->orderByDesc('followers_count');
        } else {
            $query->orderByDesc('created_at');
        }

        $users = $query->paginate(10)->withQueryString();

        return Inertia::render('Guest/User/Search', [
            'users' => $users,
            'filters' => $request->only(['query', 'sort']),
        ]);
    }

    public function follow(User $user)
    {
        $authUser = Auth::user();
        if (!$user->isFollowedBy($authUser)) {
            $authUser->followings()->attach($user->id);
            $user->increment('followers_count');
        }
        return back()->with('status', 'success')->with('message', 'フォローしました');
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();
        if ($user->isFollowedBy($authUser)) {
            $authUser->followings()->detach($user->id);
            $user->decrement('followers_count');
        }
        return back()->with('status', 'success')->with('message', 'フォローを解除しました');
    }
}

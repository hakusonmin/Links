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
        $sort = $request->input('sort', 'latest');

        $users = User::query()
            ->when($request->filled('query'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->query('query') . '%');
            })
            ->when($sort === 'latest', fn($q) => $q->latest())
            ->when($sort === 'followers', fn($q) => $q->orderByDesc('followers_count'))
            ->paginate(10)
            ->withQueryString();

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
        return back()->with(['message' => 'フォローしました', 'status' => 'success']);
    }

    public function unfollow(User $user)
    {
        $authUser = Auth::user();
        if ($user->isFollowedBy($authUser)) {
            $authUser->followings()->detach($user->id);
            $user->decrement('followers_count');
        }
        return back()->with(['message' => 'フォローを解除しました', 'status' => 'success']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyPageController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Member/MyPage/Dashboard', [
            'user' => Auth::user(),
        ]);
    }

    public function likedArticle(Request $request)
    {
        $sort = $request->input('sort', 'latest');

        $articles = Auth::user()
            ->likedArticles()
            ->with('user') // 投稿者情報をつけたい場合
            ->where('is_published', true)
            ->when($sort === 'latest', fn($q) => $q->orderByDesc('likes.created_at')) // 中間テーブルの時系列順で並び替える場合
            ->when($sort === 'likes', fn($q) => $q->orderByDesc('likes_count'))
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Member/MyPage/LikedArticles', [
            'articles' => $articles,
            'filters' => $request->only('sort'),
        ]);
    }

    public function followedUsers()
    {
        $users = Auth::user()
            ->followings()
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return Inertia::render('Member/MyPage/FollowedUsers', [
            'users' => $users,
        ]);
    }

    public function profileEdit()
    {
        return Inertia::render('Member/MyPage/ProfileEdit', [
            'user' => Auth::user(),
        ]);
    }

    public function profileUpdate(UserRequest $request)
    {
        $this->authorize('update', $request->user());

        $request->user()->update($request->validated());

        return redirect()
            ->route('users.articles.index', ['user' => Auth::user()])
            ->with(['message' => 'プロフィールを更新しました', 'status' => 'success']);
    }
}

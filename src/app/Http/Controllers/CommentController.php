<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function create(Article $article)
    {
        return Inertia::render('Member/Comment/Create', [
            'article' => $article,
        ]);
    }

    public function store(CommentRequest $request, Article $article)
    {
        $article->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('articles.show', $article)
            ->with('message', 'コメントを投稿しました')->with('status', 'success');
    }

    public function edit(Article $article, Comment $comment)
    {
        $this->authorize('update', $comment);

        return Inertia::render('Member/Comment/Edit', [
            'article' => $article,
            'comment' => $comment,
        ]);
    }

    public function update(CommentRequest $request, Article $article, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('articles.show', $article)
            ->with('message', 'コメントを更新しました')->with('status', 'success');
    }

    public function destroy(Article $article, Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();

        return redirect()->route('articles.show', $article)
            ->with('message', 'コメントを削除しました')->with('status', 'success');
    }
}

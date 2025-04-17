<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * 一覧表示の許可（必要であれば true）
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * 記事の閲覧許可（公開記事か、自分の記事なら許可）
     */
    public function view(?User $user, Article $article): bool
    {
        // 公開されていれば誰でも見られる
        if ($article->is_published) {
            return true;
        }

        // 非公開記事は本人だけ
        return $user?->id === $article->user_id;
    }

    /**
     * 記事の新規作成はログインユーザーであればOK
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * 記事の編集は所有者のみ許可
     */
    public function update(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * 記事の削除は所有者のみ許可
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * 論理削除した記事の復元は所有者のみ許可（必要があれば）
     */
    public function restore(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }

    /**
     * 完全削除も所有者のみ許可（必要があれば）
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return $user->id === $article->user_id;
    }
}

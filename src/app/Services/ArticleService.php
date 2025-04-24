<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    public function createArticle(array $data): Article
    {
        return DB::transaction(function () use ($data) {
            $article = new Article();
            $article->title = $data['title'];
            $article->priority = $data['priority'];
            $article->content = $data['content'];
            $article->user_id = Auth::id();
            $article->save();

            // ジャンルの同期
            $genreIds = collect($data['genres'])->map(function ($name) {
                return Genre::firstOrCreate(['name' => $name])->id;
            });
            $article->genres()->sync($genreIds);

            // リンクの保存
            foreach ($data['links'] as $link) {
                if (!empty($link['title']) && !empty($link['link_url'])) {
                    $article->links()->create([
                        'title' => $link['title'],
                        'link_url' => $link['link_url'],
                        'comment' => $link['comment'],
                    ]);
                }
            }

            return $article;
        });
    }


    public function updateArticle(Article $article, array $data): void
    {
        DB::transaction(function () use ($article, $data) {
            $article->title = $data['title'];
            $article->priority = $data['priority'];
            $article->content = $data['content'];
            $article->save();

            // ジャンル同期（新規作成も含む）
            $genreIds = collect($data['genres'])->map(function ($name) {
                return Genre::firstOrCreate(['name' => $name])->id;
            });
            $article->genres()->sync($genreIds);

            $existingLinks = $article->links->keyBy('id');

            foreach ($data['links'] as $linkData) {
                if (!empty($linkData['id']) && $existingLinks->has($linkData['id'])) {
                    $existingLinks[$linkData['id']]->update([
                        'title' => $linkData['title'],
                        'link_url' => $linkData['link_url'],
                        'comment' => $linkData['comment'],
                    ]);
                    $existingLinks->forget($linkData['id']);
                } elseif (!empty($linkData['title']) && !empty($linkData['link_url'])) {
                    $article->links()->create([
                        'title' => $linkData['title'],
                        'link_url' => $linkData['link_url'],
                        'comment' => $linkData['comment'],
                    ]);
                }
            }

            foreach ($existingLinks as $link) {
                $link->delete();
            }
        });
    }
}

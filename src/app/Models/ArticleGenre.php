<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleGenre extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleGenreFactory> */
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

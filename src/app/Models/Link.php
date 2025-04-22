<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /** @use HasFactory<\Database\Factories\LinkFactory> */
    use HasFactory;

    protected $fillable = [
        'article_id',
        'title',
        'link_url',
        'comment'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /** @use HasFactory<\Database\Factories\ChapterFactory> */
    use HasFactory;

    protected $fillable = ['novel_id', 'title'];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}

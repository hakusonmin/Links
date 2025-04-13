<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    /** @use HasFactory<\Database\Factories\NovelFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'novel_id'];

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}

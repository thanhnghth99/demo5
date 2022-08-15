<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'author',
        'content',
        'image',
        // 'category_id',
        'status',
    ];
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}

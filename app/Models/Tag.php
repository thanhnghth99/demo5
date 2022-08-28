<?php

namespace App\Models;

use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, HasSearch, SoftDeletes;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    
    protected $fillable = [
        'name',
        'status',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function categories()
    {
        return $this->morphedByMany(Category::class, 'taggable');
    }
}

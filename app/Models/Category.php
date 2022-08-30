<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use HasPagination;
    use HasSearch;
    use SoftDeletes;

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    
    protected $fillable = [
        'name',
        'status',
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'categoryable');
    }
}

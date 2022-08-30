<?php

namespace App\Models;

use App\Support\Trait\HasFilter;
use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use HasFilter;
    use HasPagination;
    use HasSearch;
    use SoftDeletes;
    
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    protected $fillable = [
        'name',
        'author',
        'content',
        'image',
        'status',
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    public function authorInfo()
    {
        return $this->belongsTo(User::class, 'author');
    }
}

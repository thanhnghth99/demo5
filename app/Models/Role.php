<?php

namespace App\Models;

use App\Support\Trait\HasPagination;
use App\Support\Trait\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use HasPagination;
    use HasSearch;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
    ];

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'permissionable');
    }
}

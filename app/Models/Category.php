<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'icon',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'category_id');
    }
}

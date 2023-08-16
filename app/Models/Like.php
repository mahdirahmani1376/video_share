<?php

namespace App\Models;

use App\Enums\LikeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'vote' => LikeEnum::class
    ];
}

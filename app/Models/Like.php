<?php

namespace App\Models;

use App\Enums\LikeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;


class Like extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'vote' => LikeEnum::class
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

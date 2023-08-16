<?php

namespace App\Traits;

use App\Enums\LikeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait Likeable
{
    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function likedBy(User $user)
    {
        return $this->likes()->create([
            'vote' => LikeEnum::LIKE,
            'user_id' => $user->getKey()
        ]);
    }

    public function disLikedBy(User $user)
    {
        return $this->likes()->create([
            'vote' => LikeEnum::DISLIKE,
            'user_id' => $user->getKey()
        ]);
    }



}

<?php

namespace App\Traits;

use App\Enums\LikeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait Likeable
{
    public function likedBy(User $user)
    {
		if ($this->isLikedBy($user)){
            return;
        }

        if ($this->isDislikedBy($user)){
            $this->removeDislikes($user);
        }

        return $this->likes()->create([
            'vote' => LikeEnum::LIKE,
            'user_id' => $user->getKey()
        ]);
    }

    public function disLikedBy(User $user)
    {
        if ($this->isDislikedBy($user)){
            return;
        }

        if ($this->isLikedBy($user)){
            $this->removeLikes($user);
        }

        return $this->likes()->create([
            'vote' => LikeEnum::DISLIKE,
            'user_id' => $user->getKey()
        ]);
    }

    public function isLikedBy(User $user)
    {
        return $this->likes()->where([
           'user_id' => $user->id,
           'vote' => LikeEnum::LIKE->value
        ])->exists();
    }

    public function isDislikedBy(User $user)
    {
        return $this->likes()->where([
            'user_id' => $user->id,
            'vote' => LikeEnum::DISLIKE->value
        ])->exists();
    }

    public function removeLikes(User $user)
    {
        $this->likes()->where([
           'user_id' => $user->id,
           'vote' => LikeEnum::LIKE->value
        ])->delete();
    }

    public function removeDislikes(User $user)
    {
        $this->likes()->where([
            'user_id' => $user->id,
            'vote' => LikeEnum::DISLIKE->value
        ])->delete();
    }



}

<?php

namespace App\Traits;

use App\Enums\LikeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait Likeable
{
    public function likedBy(User $user)
    {
        if ($this->isLikedBy($user)) {
            return;
        }

        if ($this->isDislikedBy($user)) {
            $this->removeDislikes($user);
        }

        return $this->likes()->create([
            'vote' => LikeEnum::LIKE,
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

    public function removeDislikes(User $user)
    {
        $this->likes()->where([
            'user_id' => $user->id,
            'vote' => LikeEnum::DISLIKE->value
        ])->delete();
    }

    public function disLikedBy(User $user)
    {
        if ($this->isDislikedBy($user)) {
            return;
        }

        if ($this->isLikedBy($user)) {
            $this->removeLikes($user);
        }

        return $this->likes()->create([
            'vote' => LikeEnum::DISLIKE,
            'user_id' => $user->getKey()
        ]);
    }

    public function removeLikes(User $user)
    {
        $this->likes()->where([
            'user_id' => $user->id,
            'vote' => LikeEnum::LIKE->value
        ])->delete();
    }

    public function cacheLikeKey()
    {
        return config('custom.likes_key') . class_basename($this) . $this->getKey();
    }

    public function cacheDislikeKey()
    {
        return config('custom.dislikes_key') . class_basename($this) . $this->getKey();
    }

    public function likesCount()
    {
        dump(\cache($this->cacheLikeKey()));
        return Cache::remember($this->cacheLikeKey(), 300, function () {
            return $this->likes()->where('vote', LikeEnum::LIKE->value)->count();
        });
    }

    public function dislikesCount()
    {
        dump(\cache($this->cacheDislikeKey()));

        return Cache::remember($this->cacheDislikeKey(), 300, function () {
            return $this->likes()->where('vote', LikeEnum::DISLIKE->value)->count();
        });
    }


}

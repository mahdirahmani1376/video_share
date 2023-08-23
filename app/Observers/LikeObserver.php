<?php

namespace App\Observers;

use App\Enums\LikeEnum;
use App\Models\Like;
use App\Notifications\ResourceLikedNotification;
use Illuminate\Support\Facades\Cache;

class LikeObserver
{
    /**
     * @param Like $like
     * @return void
     */
    public function created(Like $like): void
    {
        Cache::forget($like->likeable->cacheLikeKey());
        Cache::forget($like->likeable->cacheDislikeKey());
    }

    public function updated(Like $like): void
    {
    }

    public function deleted(Like $like): void
    {
    }

    public function restored(Like $like): void
    {
    }

    public function forceDeleted(Like $like): void
    {
    }
}

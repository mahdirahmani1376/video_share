<?php

namespace App\Observers;

use App\Models\Like;
use App\Notifications\ResourceLikedNotification;

class LikeObserver
{
    /**
     * @param Like $like
     * @return void
     */
    public function created(Like $like): void
    {
//		$like->likeable->user->notify(new ResourceLikedNotification($like));
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

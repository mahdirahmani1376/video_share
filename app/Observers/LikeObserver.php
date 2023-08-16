<?php

namespace App\Observers;

use App\Models\Like;

class LikeObserver
{
    public function created(Like $like): void
    {

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

<?php

namespace App\Observers;

use App\Models\Video;
use Illuminate\Support\Facades\Storage;

class VideoObserver
{
    public function created(Video $video): void
    {

    }

    public function updated(Video $video): void
    {
        if ($video->wasChanged('path')) {
            Storage::delete($video->getOriginal('path'));
        }

    }

    public function deleted(Video $video): void
    {
    }

    public function restored(Video $video): void
    {
    }

    public function forceDeleted(Video $video): void
    {
    }
}

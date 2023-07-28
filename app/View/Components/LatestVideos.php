<?php

namespace App\View\Components;

use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class LatestVideos extends Component
{
    public $videos;
    public function __construct(
    )
    {
        $this->videos = Video::latest()->take(6)->get();
    }

    public function render(): View
    {
        return view('components.latest-videos');
    }
}

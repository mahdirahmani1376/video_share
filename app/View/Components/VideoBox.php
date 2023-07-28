<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoBox extends Component
{
    public function __construct(
        public \App\Models\Video $video
    )
    {
    }

    public function render(): View
    {
        return view('components.video-box');
    }
}

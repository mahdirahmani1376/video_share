<?php

namespace App\Services;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

class FFmpegAdapter
{
    private FFProbe $ffprobe;

    public function __construct()
    {
        $this->ffprobe = FFProbe::create();
//        $this->videoProbe = $this->ffprobe->format()
    }

    public function getDuration($path): int
    {
        return (int) $this->ffprobe->format('storage/' . $path)->get('duration');
    }

    public function getFrame()
    {

    }
}

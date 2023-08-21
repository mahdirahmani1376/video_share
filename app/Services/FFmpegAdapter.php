<?php

namespace App\Services;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Storage;

class FFmpegAdapter
{
    public function __construct(
        public string $path
    )
    {
        $pathToFile = Storage::disk('public')->path($path);
        $this->ffprobe = FFProbe::create();
        $this->ffmpeg = FFMpeg::create();
		$this->ffprobe->format($pathToFile);
        $this->video = $this->ffmpeg->open($pathToFile);
    }

    public function getDuration(): int
    {
        return (int) $this->ffprobe->format('storage/' . $this->path)->get('duration');
    }

    public function getFrame(): string
    {
        $frame = $this->video->frame(TimeCode::fromSeconds(1));
        $fileName = pathinfo($this->path,PATHINFO_FILENAME) . '.jpg';
        if (! Storage::directoryExists(storage_path('app/public/thumbnails'))){
            Storage::disk('public')->makeDirectory('thumbnails');
        }
        $storagePath = storage_path('app/public/thumbnails/' . $fileName);
        $frame->save($storagePath);

        return $fileName;
    }
}

<?php

namespace App\Actions\Video;

use App\Models\User;
use App\Services\FFmpegAdapter;
use Illuminate\Support\Facades\Storage;

class CreateVideoAction
{
    public function execute(User $user, array $data)
    {
        $file = $data['file'];
        $url = Storage::disk('public')->putFile($file);
        $ffmpegAdapter = new FFmpegAdapter($url);
        $data['path'] = $url;
        $videoDuration = $ffmpegAdapter->getDuration();
        $thumbnail = $ffmpegAdapter->getFrame();

        return $user->videos()->create([
            'path' => $data['path'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'thumbnail' => $thumbnail,
            'category_id' => $data['category_id'],
            'length' => $videoDuration
        ]);
	}
}

<?php

namespace App\Actions\Video;

use App\Models\User;
use App\Models\Video;
use App\Services\FFmpegAdapter;
use Illuminate\Support\Facades\Storage;

class UpdateVideoAction
{
    public function execute(Video $video, array $data)
    {
        if (array_key_exists('file',$data)){
            $url = Storage::disk('public')->putFile($data['file']);
            $ffmpegAdapter = new FFmpegAdapter($url);

            $data = array_merge($data,[
                'path' => $url,
                'length' => $ffmpegAdapter->getDuration(),
                'thumbnail' => $ffmpegAdapter->getFrame(),
            ]);

        }

        $video->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],
            'path' => array_key_exists('path',$data) ? $data['path'] : $video->path,
            'thumbnail' => array_key_exists('thumbnail',$data) ? $data['thumbnail'] : $video->thumbnail,
            'length' => array_key_exists('length',$data) ? $data['length'] : $video->length,
        ]);

        return $video;
	}
}

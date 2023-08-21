<?php

namespace App\Http\Controllers;

use App\Enums\LikeEnum;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;
use App\Services\FFmpegAdapter;
use Illuminate\Support\Facades\Storage;

class VideosController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $categories = Category::all();
        return view('videos.create',compact('categories'));
    }

    public function store(StoreVideoRequest $request)
    {
        $data = $request->validated();

        $file = $request->file('file');
        $url = Storage::disk('public')->putFile($file);
        $ffmpegAdapter = new FFmpegAdapter($url);

        $data['path'] = $url;
        $videoDuration = $ffmpegAdapter->getDuration();
        $thumbnail = $ffmpegAdapter->getFrame();

        $video = auth()->user()->videos()->create([
            'path' => $data['path'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'thumbnail' => $thumbnail,
            'category_id' => $data['category_id'],
            'length' => $videoDuration
        ]);

        return redirect()->route('videos.show',$video)->with('alert', __('messages.video_created_successfully'));
    }

    public function show(Video $video)
    {
        $categories = Category::all();
        $video = $video->load('comments');
        $videoLikes = $video->likes()->where('vote',LikeEnum::LIKE->value)->count();
        $videoDislikes = $video->likes()->where('vote',LikeEnum::DISLIKE->value)->count();
        return view('videos.show',compact(['video','categories','videoLikes','videoDislikes']));
    }

    public function edit(Video $video)
    {
        $categories = Category::all();

        return view('videos.edit',compact('video','categories'));
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $data = $request->safe();
        if ($request->file('file')){
            $url = Storage::disk('public')->putFile($request->file('file'));
            $ffmpegAdapter = new FFmpegAdapter($url);

            $data->merge([
                'path' => $url,
                'length' => $ffmpegAdapter->getDuration(),
                'thumbnail' => $ffmpegAdapter->getFrame(),
            ]);
        }

        $video->update($data->except('file'));

        return redirect()->route('videos.show',$video)->with('alert', __('messages.video_updated_successfully'));
    }

    public function destroy(Video $video)
    {
        $video->delete();
    }
}

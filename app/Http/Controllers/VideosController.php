<?php

namespace App\Http\Controllers;

use App\Actions\Video\CreateVideoAction;
use App\Actions\Video\UpdateVideoAction;
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

    public function store(StoreVideoRequest $request,CreateVideoAction $createVideoAction)
    {
        $data = $request->validated();
        $video = $createVideoAction->execute(auth()->user(),$data);

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

    public function update(UpdateVideoRequest $request, Video $video,UpdateVideoAction $updateVideoAction)
    {
        $data = $request->validated();
        $video = $updateVideoAction->execute($video,$data);

        return redirect()->route('videos.show',$video)->with('alert', __('messages.video_updated_successfully'));
    }

    public function destroy(Video $video)
    {
        $video->delete();
    }
}

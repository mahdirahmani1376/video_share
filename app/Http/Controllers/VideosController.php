<?php

namespace App\Http\Controllers;

use App\Enums\LikeEnum;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Models\Category;
use App\Models\Video;

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
        $video = auth()->user()->videos()->create($request->validated());

        return redirect()->route('index')->with('success', __('messages.success'));
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
        $video->update($request->validated());

        return redirect()->route('videos.show',$video)->with('success', __('messages.success'));
    }

    public function destroy(Video $video)
    {
        $video->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->validated());

        return redirect()->route('home')->with('success', __('messages.success'));
    }

    public function show(Video $video)
    {
        return view('videos.show',compact('video'));
    }

    public function edit(Video $video)
    {
        return view('videos.edit',compact('video'));
    }

    public function update(Request $request, Video $video)
    {
    }

    public function destroy(Video $video)
    {
    }
}

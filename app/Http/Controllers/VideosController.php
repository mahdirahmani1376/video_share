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
        return view('Videos.create');
    }

    public function store(StoreVideoRequest $request)
    {
        $video = Video::create($request->validated());

        return redirect()->route('home')->with('success', 'video created successfully');
    }

    public function show(Video $video)
    {
    }

    public function edit(Video $video)
    {
    }

    public function update(Request $request, Video $video)
    {
    }

    public function destroy(Video $video)
    {
    }
}

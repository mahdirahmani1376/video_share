<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::filter($request->all())->latest()->take(6)->get();
        $mostPopularVideos = Video::all()->random(6);
        $mostViewedVideos = Video::all()->random(6);
        return view('index',compact('videos','mostPopularVideos','mostViewedVideos'));
    }
}

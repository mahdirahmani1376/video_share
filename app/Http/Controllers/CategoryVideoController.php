<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryVideoController extends Controller
{
    public function index(Category $category)
    {
        $videos = $category->videos()->paginate();
        return view('videos.index', compact('videos'));
    }
}

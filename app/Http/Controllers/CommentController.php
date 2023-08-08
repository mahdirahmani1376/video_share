<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreCommnetRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Video;

class CommentController extends Controller
{
    public function store(StoreCommnetRequest $request,Video $video)
    {
        $comment = auth()->user()->comments()->create($request->validated());

        return redirect()->back()->with('success',__('messages.your_comment_has_been_created_successfully'));
	}
}

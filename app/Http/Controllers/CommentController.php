<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Video;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Video $video)
    {
        $data = $request->validated();
        $video->comments()->create([
           'user_id' => auth()->id(),
           'text' => $data['text']
        ]);

        return redirect()->back()->with('alert',__('messages.your_comment_has_been_created_successfully'));
	}
}

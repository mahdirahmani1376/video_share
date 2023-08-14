<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;

class LikeController extends Controller
{

    public function like(Model $model, int $vote)
    {
        $like = Like::create([
           'vote' => $vote,
           'likeable_type' => $model::class,
           'likeable_id' => $model->getKey(),
           'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', __('messages.your_comment_has_been_created_successfully'));
    }
}

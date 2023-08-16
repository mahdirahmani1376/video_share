<?php

namespace App\Http\Controllers;

use App\Enums\LikeEnum;

class DislikeController extends Controller
{
    public function dislike($likeable_type, $likeable_id)
    {
        $dislike = $likeable_id->dislikedBy(auth()->user());

        return redirect()->back();

    }
}

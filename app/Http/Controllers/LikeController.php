<?php

namespace App\Http\Controllers;

use App\Enums\LikeEnum;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;

class LikeController extends Controller
{
    public function like($likeable_type,$likeable_id)
    {
        $like = $likeable_id->likedBy(auth()->user());

        return redirect()->back();
    }


}

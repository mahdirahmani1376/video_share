<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Video\CreateVideoAction;
use App\Actions\Video\UpdateVideoAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    public function index()
    {
        return Response::json(
          data: VideoResource::make(Video::paginate())
        );
    }

    public function show(Video $video)
    {
        return Response::json(
          data: VideoResource::make($video->load('user','category','comments','likes'))
        );
    }

    public function store(StoreVideoRequest $request,CreateVideoAction $createVideoAction)
    {
        $video = $createVideoAction->execute(auth()->user(),$request->validated());

        return Response::json(
          data: VideoResource::make($video)
        );
    }

    public function update(UpdateVideoRequest $updateVideoRequest,Video $video,UpdateVideoAction $updateVideoAction)
    {
        $video = $updateVideoAction->execute($video,$updateVideoRequest->validated());

        return Response::json(
          data: VideoResource::make($video)
        );
    }

    public function destroy($video)
    {
        return Response::json([
            'message' => __('messages.video_deleted_successfully'),
        ]);
    }
}

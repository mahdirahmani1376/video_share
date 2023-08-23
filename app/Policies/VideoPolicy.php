<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Video $video): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Video $video)
    {
        return $user->isOwnerOf($video)
            ? Response::allow()
            : Response::deny(__('messages.this_video_does_not_belong_to_you'));
    }

    public function delete(User $user, Video $video): bool
    {
        return $user->isOwnerOf($video);
    }

    public function restore(User $user, Video $video): bool
    {
        return $user->isOwnerOf($video);
    }

    public function forceDelete(User $user, Video $video): bool
    {
        return $user->isOwnerOf($video);
    }
}

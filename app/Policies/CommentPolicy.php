<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Comment $comment): bool
    {
    }

    public function create(User $user,Video $video): bool
    {
        return ! $user->isOwnerOf($video);
    }

    public function update(User $user, Comment $comment): bool
    {
        return $user->isOwnerOf($comment) || ! $user->isOwnerOf($comment->video);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->isOwnerOf($comment) || $user->isOwnerOf($comment->video);
    }

    public function restore(User $user, Comment $comment): bool
    {
        return $user->isOwnerOf($comment) || $user->isOwnerOf($comment->video);
    }

    public function forceDelete(User $user, Comment $comment): bool
    {
        return $user->isOwnerOf($comment) || $user->isOwnerOf($comment->video);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Video */
class VideoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'path' => $this->path,
            'length' => $this->length,
            'slug' => $this->slug,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'length_in_human' => $this->length_in_human,
            'likes_count' => $this->likes_count,
            'owner_name' => $this->owner_name,
            'thumbnail_url' => $this->thumbnail_url,
            'video_url' => $this->video_url,
            'comments_count' => $this->comments_count,
            'is_disliked_by_count' => $this->is_disliked_by_count,
            'is_liked_by_count' => $this->is_liked_by_count,
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}

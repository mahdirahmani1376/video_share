<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    public function run(): void
    {
        $videos = Video::all();
        $users = User::all();
        foreach ($videos as $video){
            Comment::factory()->create([
               'user_id' =>  $users->random()->first()->id,
                'video_id' => $video->id
            ]);
        }
    }
}

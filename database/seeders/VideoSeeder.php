<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $categories = Category::all();
        foreach ($categories as $category){
            Video::factory()->count(15)
                ->for($category,'category')
                ->for($users->random(),'user')
                ->create();
        };
    }
}

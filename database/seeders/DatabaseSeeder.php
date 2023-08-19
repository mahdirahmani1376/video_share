<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        User::factory()->create([
           'name' => 'mahdi rahmani',
           'email' => 'test@test.com',
           'password' => '1234'
        ]);
        $this->call([
            CategorySeeder::class,
            VideoSeeder::class,
            CommentTableSeeder::class
        ]);
    }
}

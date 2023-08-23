<?php

namespace Database\Factories;

use App\Enums\LikeEnum;
use App\Models\Like;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first() ?? User::factory(),
            'vote' => LikeEnum::LIKE,
            'likeable_id' => Video::factory(),
            'likeable_type' => Video::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function forModel(Model $model)
    {
        return $this->state([
            'likeable_id' => $model->getKey(),
            'likeable_type' => $model::class
        ]);
    }


}

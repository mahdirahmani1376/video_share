<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'path' =>$this->faker->imageUrl(446, 240, 'animals', true),
            'length' => $this->faker->randomNumber(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->realText(),
            'category_id' => Category::factory(),
            'thumbnail' => 'https://loremflickr.com/446/240/world?random=' . rand(1, 99)
        ];
    }
}

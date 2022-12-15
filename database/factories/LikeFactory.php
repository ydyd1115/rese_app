<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Like;

class LikeFactory extends Factory
{
    protected $model = Like::class;

    public function definition()
    {
        return [
        'user_id' => $this->faker->numberBetween(1,5),
        'shop_id'=> $this->faker->numberBetween(1,5),
        ];
    }
}

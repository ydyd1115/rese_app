<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;
use App\Models\Review;
use App\Models\User;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
        'user_id' => Str::random(10),
        'shop_id'=> Shop::factory(),
        'date_time'=>$this->faker->dateTime(),
        'grade'=> $this->faker->numberBetween(1,5),
        'comment'=> Str::random(20),
        ];
    }
}

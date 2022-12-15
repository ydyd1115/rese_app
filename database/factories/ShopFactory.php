<?php

namespace Database\Factories;

use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Shop::class;

    public function definition()
    {
        return [
        'name' => Str::random(10),
        'area'=> Str::random(10),
        'genre'=> Str::random(10),
        'comment'=> Str::random(20),
        'image_URL' => $this->faker->url,
        ];
    }
}

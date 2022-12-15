<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\User;

class ReserveFactory extends Factory
{
    protected $model = Reserve::class;

    public function definition()
    {
        return [
        'user_id' =>$this->faker->numberBetween(1,5),
        'shop_id'=> $this->faker->numberBetween(1,5),
        'number' => $this->faker->numberBetween(1,5),
        'date_time'=>$this->faker->dateTime(),
        ];
    }
}

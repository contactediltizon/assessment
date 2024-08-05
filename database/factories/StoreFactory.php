<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition()
    {
        return [
            'brand' => $this->faker->randomElement(['Taco Bell', 'KFC', 'Pizza Hut']),
            'store_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'address' => $this->faker->address,
            'total_revenue' => $this->faker->numberBetween(100000, 500000),
            'total_profit' => $this->faker->numberBetween(10000, 100000),
            'user_id' => \App\Models\User::factory(), // Assumes user factory exists
        ];
    }
}


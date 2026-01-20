<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Generator as Faker;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'total_price' => $this->faker->randomFloat(2, 50, 2000), 
            'total_quantity' => $this->faker->numberBetween(1, 10), // Added missing field
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'zip_code' => $this->faker->postcode, // Changed to postcode for better format
        ];
    }
}
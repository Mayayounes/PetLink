<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Pet;
use Faker\Generator as Faker;

class AdoptionFactory extends Factory
{
    protected $model = \App\Models\Adoption::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'pet_id' => Pet::factory(),
            'date' => $this->faker->dateTime,
        ];
    }
}

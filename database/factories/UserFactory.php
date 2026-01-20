<?php

namespace Database\Factories;  // Correct namespace

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pet;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), 
           
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Generator as Faker;

class AppointmentFactory extends Factory
{
    protected $model = \App\Models\Appointment::class;

    public function definition()
    {
        return [
            'date' => $this->faker->dateTime,
            'user_id' => User::factory(), 
        ];
    }
}

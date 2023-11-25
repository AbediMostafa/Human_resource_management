<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => fake()->phoneNumber(),
            'type' => fake()->randomElement(['mobile', 'home']),
            'phoneable_id' => fake()->randomElement(User::all()->pluck('id')->toArray()),
            'phoneable_type' => User::class,
        ];
    }
}

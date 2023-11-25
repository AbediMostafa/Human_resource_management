<?php

namespace Database\Factories;

use App\Models\Demand;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $chattable = $this->chattable();

        return [
            'sender_id' => fake()->randomElement(User::all()->pluck('id')->toArray()),
            'receiver_id' => fake()->randomElement(User::all()->pluck('id')->toArray()),
            'text'=>fake()->realText(),
            'chattable_id' => fake()->randomElement(Demand::all()->pluck('id')->toArray()),
            'chattable_type' => Demand::class
        ];
    }

    public function chattable()
    {
        return fake()->randomElement([
            Demand::class, null
        ]);
    }
}

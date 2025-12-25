<?php

namespace Database\Factories;

use App\Enums\MessageState;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {

        $state = [MessageState::Read->value, MessageState::NotReadYet->value];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->word(),
            'subject' => fake()->word(),
            'message' => fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'state' => fake()->randomElement($state),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

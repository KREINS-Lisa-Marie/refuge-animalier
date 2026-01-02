<?php

namespace Database\Factories;

use App\Enums\RequestState;
use App\Models\Animal;
use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RequestFactory extends Factory
{
    protected $model = Request::class;

    public function definition(): array
    {

        $state = [RequestState::Refused->value, RequestState::Adopted->value, RequestState::InTreatment->value, RequestState::NotTreatedYet->value];

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'state' => fake()->randomElement($state),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'message' => fake()->text(),
            'comment' => fake()->text(),
            'date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

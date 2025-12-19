<?php

namespace Database\Factories;

use App\Models\Availability;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;

    public function definition(): array
    {
        return [
            'monday' => fake()->word(),
            'tuesday' => fake()->word(),
            'wednesday' => fake()->word(),
            'thursday' => fake()->word(),
            'friday' => fake()->word(),
            'saturday' => fake()->word(),
            'sunday' => fake()->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

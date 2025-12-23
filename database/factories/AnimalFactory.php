<?php

namespace Database\Factories;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'animal_name' => fake()->firstName(),
            'species' => fake()->word(),
            'race' => fake()->word(),
            'sex' => fake()->word(),
            'fur' => fake()->word(),
            'age' => fake()->randomNumber(),
            'vaccinations' => fake()->word(),
            'character' => fake()->word(),
            'state' => fake()->word(),
            'description' => fake()->text(),
            'show_image' => fake()->image(),
            'gallery_images' => fake()->image(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\AnimalState;
use App\Enums\Sex;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {

        $sex = [Sex::Male->value, Sex::Female->value];
        $state = [AnimalState::Adoptable->value, AnimalState::Adopted->value, AnimalState::ProcessingAdoption->value, AnimalState::InTreatment->value];


        return [
            'animal_name' => fake()->firstName(),
            'species' => fake()->word(),
            'race' => fake()->word(),
            'sex' => fake()->randomElement($sex),
            'fur' => fake()->word(),
            'age' => fake()->numberBetween(1, 18),
            'vaccinations' => fake()->word(),
            'character' => fake()->word(),
            'state' => fake()->randomElement($state),
            'description' => fake()->text(),
            'show_image' => fake()->image(),
            'gallery_images' => fake()->image(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

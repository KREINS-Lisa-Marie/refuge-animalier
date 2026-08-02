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
$gallery = fake()->boolean(50) ? ['images/animals/originals/default.jpeg'] : [];

        return [
            'animal_name' => fake()->firstName(),
            'species' => fake()->word(),
            'race' => fake()->word(),
            'sex' => fake()->randomElement($sex),
            'fur' => fake()->word(),
            'age' => fake()->dateTimeBetween('-15 years', 'now'),
            'vaccinations' => fake()->word(),
            'character' => fake()->word(),
            'state' => fake()->randomElement($state),
            'description' => fake()->text(),
            'show_image' => fake()->boolean(50) ? null : 'images/animals/originals/default.jpeg',
            'gallery_images' => $gallery,
            'internal_notes' => fake()->text(),
            'modification_request' => fake()->text(),
            'published_animal'=> fake()->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

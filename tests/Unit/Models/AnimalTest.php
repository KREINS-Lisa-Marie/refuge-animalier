<?php

use App\Models\Animal;
use App\Models\Request;

it('can create animals', function () {

    $animals = [];
    $animals = Animal::factory(5)->create();

    expect($animals)->toHaveCount(5);
});


it('has many requests who belong to an animal', function () {

    $animal = Animal::factory()->create();
    $requests = Request::factory(2)->create([
        'animal_id' => $animal->id
    ]);

    expect($animal->requests)->toHaveCount(2);
});

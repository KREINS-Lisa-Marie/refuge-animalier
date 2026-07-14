<?php

use App\Models\Animal;
use App\Models\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

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

    expect($animal->adoptionRequests)->toHaveCount(2);
    expect($animal->adoptionRequests->first())->toBeInstanceOf(Request::class);
});

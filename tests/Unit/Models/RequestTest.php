<?php

use App\Models\Animal;
use App\Models\Request;

it('can create a request', function () {


    $animal = Animal::factory()->create();
    $request = Request::factory()->for($animal)->create();

    expect($request->animal_id)->toBe($animal->id);

});


it('has many requests who belong to an animal', function () {

    $animal = Animal::factory()->create();
    $requests = Request::factory(2)->for($animal)->create();

    expect($animal->requests)->toHaveCount(2);
});

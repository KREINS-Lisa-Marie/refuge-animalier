<?php

use App\Models\Availability;
use App\Models\User;

it('can create availabilities', function () {

    $user = User::factory();
    $availabilities = [];
    $availabilities = Availability::factory(5)->for($user)->create();

    expect($availabilities)->toHaveCount(5);

});


it('belongs to a user', function () {

    $user = User::factory()->create();
    $availability = Availability::factory()->for($user)->create();

    expect($availability->user_id)->toBe($user->id);

});

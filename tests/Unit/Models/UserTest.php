<?php

use App\Models\Availability;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create many users', function () {

    $users = [];
    $users = User::factory(5)->create();

    expect($users)->toHaveCount(5);
});

it('has one availability', function () {

    $user = User::factory()->create();
    $other_users= User::factory(3)->create();
    $availability = Availability::factory()->for($user)->create();

    foreach ($other_users as $otheruser){
         Availability::factory()->create([
             'user_id'=>$otheruser->id
         ]);
    }
    expect($user->availability->id)->toBe($availability->id);
});



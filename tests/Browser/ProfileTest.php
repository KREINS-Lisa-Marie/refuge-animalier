<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

// fertig
// Profile

it('can click the edit password button of the profile and go to the edit page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);


    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::profile.index',[
        'locale' => $locale,
    ]);

    visit($route)
        ->click("a:has-text('Modifier mes données')")
        ->assertUrlIs(route('pages::profile.edit', [
            'profile' => $user->id,
            'locale' => $locale
        ]));
});

it('will disconnect the user when clicking on the disconnect button and redirect to the login page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::profile.index',[
        'locale' => $locale,
    ]);

    visit($route)
        ->click('Déconnexion')
        ->assertUrlIs(route('auth.login', [
            'locale' => $locale
        ]));

    expect(auth()->guest())->toBeTrue();
});

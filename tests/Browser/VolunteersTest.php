<?php

use App\Models\Availability;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

// fertig
// Volunteers

it('can click a volunteer card and go to the show page', function () {

    $user = User::factory()->create(['is_admin'=>'0']);
    $volunteer = $user;
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::volunteers.index',['locale' => $locale]);

    visit($route)
        ->click(".card-link")
        ->assertUrlIs(route('pages::volunteers.show', [
            'volunteer' => $volunteer->id,
            'locale' => $locale
        ]));
});

it('can click on create a volunteer and go to the create page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::volunteers.index',['locale' => $locale]);

    visit($route)
        ->click(".admin-button")
        ->assertUrlIs(route('pages::volunteers.create', [
            'locale' => $locale
        ]));
});

it('can click the edit button and go to the edit page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $volunteer = $user;
    $availabiliy = Availability::factory()->for($user)->create();
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::volunteers.show',[
        'locale' => $locale,
        'volunteer' => $volunteer->id,
        'availability' =>$availabiliy,
        ]);

    visit($route)
        ->click("Modifier les données")
        ->assertUrlIs(route('pages::volunteers.edit', [
            'volunteer' => $volunteer->id,
            'locale' => $locale
        ]));

    $new_route = route('pages::volunteers.edit',[
        'locale' => $locale,
        'volunteer' => $volunteer->id,
        'availability' =>$availabiliy,
    ]);

    visit($new_route)
        ->assertSee('Modifier')
        ->fill('first_name', $volunteer->first_name)
        ->fill('last_name', $volunteer->last_name)
        ->fill('phone', '5269436529')
        ->select('is_admin', '1')
        ->wait(1)
        ->click('Enregistrer')
        ->assertSee($volunteer->first_name)
    ->assertUrlIs(route('pages::volunteers.show', [
        'volunteer' => $volunteer->id,
        'locale' => $locale
    ]));
});

it('can click on the delete button, delete the volunteer and go back to the index page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $volunteer = $user;
    $locale = app()->getLocale();
    actingAs($user);
    $availabiliy = Availability::factory()->for($user)->create();

    $route = route('pages::volunteers.show',[
        'locale' => $locale,
        'volunteer' => $volunteer->id,
        'availability'=>$availabiliy,
    ]);
    visit($route)->assertUrlIs(route('pages::volunteers.show', [
        'locale' => $locale, 'volunteer' => $volunteer
    ]));
    visit($route)
        ->click("Supprimer la personne")
        ->assertUrlIs(route('pages::volunteers.index', [
            'locale' => $locale
        ]));

    assertDatabaseMissing('users', [
        'id' => $volunteer->id,
    ]);
});


it('can create a volunteer and redirect to the index page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::volunteers.create',['locale' => $locale]);

    visit($route)
        ->assertSee('Créer un Bénévole')
        ->fill('first_name', 'Kevin')
        ->fill('last_name', 'Meunier')
        ->fill('email', 'kevin@mail.com')
        ->fill('phone', '5269436529')
        ->select('is_admin', '1')
        ->fill('password', 'password')
        ->fill('password_confirmation', 'password')
        ->click('Enregistrer')
        ->assertSee('Kevin');

    assertDatabaseHas('users', [
        'email' => 'kevin@mail.com',
    ]);
});

it('can edit a volunteer and redirect to the show page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $volunteer = User::factory()->create();

    $route = route('pages::volunteers.edit',[
        'locale' => $locale,
        'volunteer' => $volunteer->id
    ]);

    visit($route)
        ->assertSee('Modifier')
        ->fill('first_name', $volunteer->first_name)
        ->fill('last_name', $volunteer->last_name)
        ->fill('phone', '5269436529')
        ->select('is_admin', '1')
        ->click('Enregistrer')
        ->assertSee($volunteer->first_name)
        ->assertUrlIs(route('pages::volunteers.show', [
            'locale' => $locale,
            'volunteer' => $volunteer->id
        ]));

    assertDatabaseHas('users', [
        'phone' => '5269436529',
    ]);
});


it('blocks the other users from creating a user', function () {

        $user = User::factory()->create(['is_admin'=>'0']);
        $locale = app()->getLocale();
        actingAs($user);

        $route = route('pages::volunteers.create',['locale' => $locale]);

        visit($route)
            ->assertSee('403');
    });



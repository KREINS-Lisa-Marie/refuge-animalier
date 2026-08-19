<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;

uses(RefreshDatabase::class);

//fertig
// Orders

it('can click an adoption-request card and show it in a modal',
    function () {

        $user = User::factory()->create(['is_admin'=>'1']);

        $animal = \App\Models\Animal::factory()->create();
        $adoption_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);
        $locale = app()->getLocale();
        actingAs($user);

        $route = route('pages::adoption-requests.index',['locale' => $locale]);

        visit($route)
            ->assertDontSee('.message-modal')
            ->click(".modal-tr-link")
            ->assertSee('Demande d’adoption pour');
    });

it('can click on create an adoption-request and go to the create page', function () {

    $user = User::factory()->create(['is_admin' => '1']);
    $animal = \App\Models\Animal::factory()->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::adoption-requests.index',['locale' => $locale]);

    visit($route)
        ->click(".admin-button")
        ->assertUrlIs(route('pages::adoption-requests.create', [
            'locale' => $locale
        ]))
    ->assertSee('Nouvelle demande d’adoption');
});

it('can click the edit button of a order and go to the edit page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animal = \App\Models\Animal::factory()->create();
    $adoption_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::adoption-requests.index',[
        'locale' => $locale,
    ]);

    visit($route)
        ->assertDontSee('.message-modal')
        ->click(".modal-tr-link")
        ->assertSee('Demande d’adoption pour')
        ->click("Modifier la demande")
        ->assertUrlIs(route('pages::adoption-requests.edit', [
            'locale' => $locale,
            'adoption_request' => $adoption_request->id
        ]))
        ->assertSee('Modifier une demande');

});

it('can create a adoption-request and redirect to the index page', function () {

    $user = User::factory()->create(['is_admin' => '1']);
    $animal = \App\Models\Animal::factory()->create(['state'=>'adoptable']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::adoption-requests.create',['locale' => $locale]);


    visit($route)
        ->assertSee('Nouvelle demande d’adoption')
        ->fill('first_name', 'John')
        ->fill('last_name', 'Doe')
        ->fill('address', 'Rue de la maison 2')
        ->fill('phone', '028582054280452')
        ->fill('email', 'j@doe.com')
        ->select('state', 'not_treated_yet')
        ->fill('message', 'Appel tel')
        ->fill('comment', 'Elle a téléphoné ajd')
        ->select('animal_id', $animal->id)
        ->click('Enregistrer')
        ->assertUrlIs(route('pages::adoption-requests.index', ['locale' => $locale]))
        ->assertSee('Créer une demande');

    assertDatabaseHas('requests',
        ['first_name' => 'John',
            'last_name' => 'Doe',
            'email'=>'j@doe.com']);
});

it('can edit an adoption request and redirect to the index page', function () {


    $user = User::factory()->create(['is_admin' => '1']);
    $animal = \App\Models\Animal::factory()->create(['state'=>'adoptable']);
    $adoption_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::adoption-requests.edit',['locale' => $locale, 'adoption_request' => $adoption_request]);


    visit($route)
        ->assertSee('Modifier une demande')
        ->fill('first_name', $adoption_request->first_name)
        ->fill('last_name', $adoption_request->last_name)
        ->fill('address', $adoption_request->address)
        ->fill('phone', $adoption_request->phone)
        ->fill('email', 'a@doe.com')
        ->select('state', 'adopted')
        ->fill('message', $adoption_request->message)
        ->fill('comment', $adoption_request->comment)
        ->select('animal_id', $animal->id)
        ->click('Enregistrer')
        ->assertUrlIs(route('pages::adoption-requests.index', ['locale' => $locale]))
        ->assertSee('Créer une demande');

    assertDatabaseHas('requests',
        [
            'id' => $adoption_request->id,
            'email'=>'a@doe.com',
            'state'=>'adopted'
        ]);
});

it('can delete an adoption request', function () {

    $user = User::factory()->create(['is_admin' => '1']);
    $animal = \App\Models\Animal::factory()->create(['state'=>'adoptable']);
    $adoption_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::adoption-requests.index',['locale' => $locale]);

    visit($route)
        ->click(".modal-tr-link")
        ->click("Supprimer la demande")
        ->assertDontSee("Supprimer la demande");

    assertSoftDeleted('requests', [
        'id' => $adoption_request->id,
    ]);
});

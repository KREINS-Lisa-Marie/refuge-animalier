<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);


// Animals

it('can click on an animal card and go to the show page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $animal = \App\Models\Animal::factory()->create(['animal_name' => 'Bob']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.index',['locale' => $locale]);

    visit($route)
        ->click(".table-species")       // parce que si je click sur la <a alors il connait pas à cause de position absolute.donc click sur table species pour cibler tout le lien
        ->assertUrlIs(route('pages::animals.show', [
            'animal' => $animal,
            'locale' => $locale
        ]));
});

it('can click on create an animal and go to the create page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.index',['locale' => $locale]);

    visit($route)
        ->click("Créer un animal")
        ->assertUrlIs(route('pages::animals.create', [
            'locale' => $locale
        ]));
});

it('can click the edit button of an animal and go to the edit page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animal = \App\Models\Animal::factory()->create();
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.show',[
        'locale' => $locale,
        'animal' => $animal->id,
    ]);

    visit($route)
        ->click("Modifier l’animal")
        ->assertUrlIs(route('pages::animals.edit', [
            'animal' => $animal->id,
            'locale' => $locale
        ]));
});

it('can click on the delete button, delete the animal and go back to the index page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animal = \App\Models\Animal::factory()->create();
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.show',[
        'locale' => $locale,
        'animal' => $animal->id,
    ]);

    visit($route)
        ->click("Supprimer l’animal")
        ->assertUrlIs(route('pages::animals.index', [
            'locale' => $locale
        ]));

    \Pest\Laravel\assertSoftDeleted(
        'animals', ['id' => $animal->id,
        ]);
});

it('can create an animal and redirect to the index page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.create',['locale' => $locale]);

    visit($route)
        ->assertSee('Créer un animal')
        ->fill('animal_name', 'Willy')
        ->select('species', 'dog')
        ->fill('race', 'Dalmatien')
        ->select('sex', 'male')
        ->fill('fur', 'brun')
        ->fill('age', '2022-01-12')
        ->fill('vaccinations', 'non')
        ->fill('character', 'calme')
        ->select('state', 'adoptable')
        ->fill('description', '')
        ->select('published_animal', '1')
        ->wait(1)
        ->click('Enregistrer')
        ->assertSee('Les animaux');

    assertDatabaseHas('animals', [
        'animal_name' => 'Willy',
    ]);
});

it('can edit an animal and redirect to the show page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $locale = app()->getLocale();
    actingAs($user);

    $animal = \App\Models\Animal::factory()->create([
        'show_image' => null,
        'gallery_images' => [],
        ]);

    $route = route('pages::animals.edit',[
        'locale' => $locale,
        'animal' => $animal->id
    ]);

    visit($route)
        ->assertSee('Modifier')
        ->fill('animal_name', $animal->animal_name)
        ->select('species', 'dog')
        ->fill('race', $animal->race)
        ->select('sex', $animal->sex)
        ->fill('fur', 'orange-gris')
        ->fill('age', '2022-03-03')
        ->fill('vaccinations', $animal->vaccinations)
        ->fill('character', $animal->character)
        ->select('state', 'adoptable')
        ->fill('description', $animal->description)
        ->click('Enregistrer')
        ->assertSee($animal->animal_name)
        ->wait(1);  //seconde

    assertDatabaseHas('animals', [
        'fur'=> 'orange-gris'
    ]);
});

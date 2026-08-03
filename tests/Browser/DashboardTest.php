<?php

use App\Models\Animal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

// Dashboard

it('can click on the add an animal link on the dashboard and go to the create animal page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click("Ajouter un animal")
        ->assertUrlIs(route('pages::animals.create', [
            'locale' => $locale
        ]));
});

it('can click on the add a volunteer link on the dashboard and go to the create volunteer page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click("Ajouter un bénévole")
        ->assertUrlIs(route('pages::volunteers.create', [
            'locale' => $locale
        ]));
});

it('can click on the add adoption request link on the dashboard and go to the adoption request create page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click("Ajouter une demande d’adoption")
        ->assertUrlIs(route('pages::adoption-requests.create', [
            'locale' => $locale
        ]));
});

it('can click on the see statisctics link on the dashboard and go to the statistics section', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click("Voir les statistiques")
        ->assertSee('Statistiques')
        ->assertVisible('#statistics');
});



it('can click on one of the 5 last animals link on the dashboard and go to the animal page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);
    $animals = \App\Models\Animal::factory(5)->create();
    $animal = $animals->first();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('tr.table-row:first-of-type a.card-link:first-of-type')
        ->assertUrlIs(route('pages::animals.show', [
            'animal' => $animal->id,
            'locale' => $locale
        ]));
});



it('shows the number of new adoption requests on the dashboard ', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animal = Animal::factory()->create(['state' => 'adoptable']);
    $animal2 = Animal::factory()->create(['state' => 'adoptable']);
    $adoption_requests = \App\Models\Request::factory(5)->create(['state'=>'not_treated_yet', 'animal_id'=>$animal->id]);
    $adoption_requests2 = \App\Models\Request::factory(10)->create(['state'=>'adopted',
        'animal_id'=>$animal2->id]);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->assertSeeIn('.dashboard-card:has-text("Demandes d’adoption non traités") .big-number',
            (string) $adoption_requests->count()         //string car sinon compare int avec string
        );
});

it('shows the number of new messages on the dashboard ', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $new_messages = \App\Models\Message::factory(5)->create([
        'state'=> 'not_read_yet'
    ]);
    $messages = \App\Models\Message::factory(15)->create([
        'state'=> 'read'
    ]);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->assertSeeIn(
            '.dashboard-card:has-text("Nouveaux messages de contact") .big-number',
            (string) $new_messages->count()         //string car sinon compare int avec string
        );
});

it('shows the number of animals in shelter on the dashboard ', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animals = Animal::factory(2)->create(['state'=>'adoptable']);
    $animals2 = Animal::factory(2)->create(['state'=>'adopted']);
    $animals3 = Animal::factory(2)->create(['state'=>'in_treatment']);
    $animals4 = Animal::factory(2)->create(['state'=>'processing_adoption']);

    $not_adopted = $animals->merge($animals3)->merge($animals4);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->assertSeeIn(
            '.dashboard-card:has-text("Animaux dans le réfuge") .big-number',
            (string) $not_adopted->count()         //string car sinon compare int avec string
        );
});



/*      DAS EINE MUSS NOCH GEMACHT WERDEN       */

it('shows the number of animals welcomed in shelter this year on the dashboard ', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animals = Animal::factory(2)->create(['created_at'=>'2026-01-01']);
    $animals2 = Animal::factory(2)->create(['created_at'=>'2022-10-10']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->assertSeeIn(
            '.dashboard-card:has-text("Animaux accueillis cette année") .big-number',
            (string) $animals->count()         //string car sinon compare int avec string
        );
});

it('shows the number of animals adopted in total on the dashboard ', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animals = Animal::factory(2)->create(['state'=>'adopted']);
    $animals2 = Animal::factory(2)->create(['state'=>'adoptable']);
    $animals3 = Animal::factory(2)->create(['state'=>'in_treatment']);
    $animals4 = Animal::factory(2)->create(['state'=>'processing_adoption']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->assertSeeIn(
            '.dashboard-card:has-text("Animaux adoptés en total") .big-number',
            (string) $animals->count()         //string car sinon compare int avec string
        );
});


//fertig
// Menu

it('can click on the dashboard link and go to the dashboard page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animals = Animal::factory(5)->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Dashboard"]')
        ->assertUrlIs(route('pages::dashboard.index', [
            'locale' => $locale
        ]));
});

it('can click on the animals link and go to the animals page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animals = Animal::factory(5)->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Les animaux"]')
        ->assertUrlIs(route('pages::animals.index', [
            'locale' => $locale
        ]));
});

it('can click on the adoption requests link and go to the adoption requests page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $animal = Animal::factory()->create();
     $requests = \App\Models\Request::factory(5)->create(['animal_id'=>$animal->id]);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Demandes d’adoption"]')
        ->assertUrlIs(route('pages::adoption-requests.index', [
            'locale' => $locale
        ]));
});

it('can click on the volunteers link and go to the volunteers page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $volunteers = User::factory(5)->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Bénévoles"]')
        ->assertUrlIs(route('pages::volunteers.index', [
            'locale' => $locale
        ]));
});

it('can click on the messages link and go to the messages page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $messages = \App\Models\Message::factory(5)->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Messages"]')
        ->assertUrlIs(route('pages::messages.index', [
            'locale' => $locale
        ]));
});

it('can click on the profile link and go to the profile page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $contacts = User::factory(5)->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::dashboard.index',['locale' => $locale]);

    visit($route)
        ->click('[title="Aller vers la page Profil"]')
        ->assertUrlIs(route('pages::profile.index', [
            'locale' => $locale
        ]));
});

it('can click on the disconnect link and disconnect the user and afterwards redirect to the login page', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::animals.index',['locale' => $locale]);

    visit($route)
        ->click('Déconnexion')
        ->assertUrlIs(route('auth.login', [
            'locale' => $locale
        ]));

    expect(auth()->guest())->toBeTrue();
});

<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\assertSoftDeleted;

uses(RefreshDatabase::class);

//fertig
// Messages

it('can click a message card and show the message', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $message = \App\Models\Message::factory()->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::messages.index',['locale' => $locale]);

    visit($route)
        ->click("Ouvrir le message")
        ->assertSee('Message vu');
});

it('can click a message card and show the message and click to let it know its seen', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $message = \App\Models\Message::factory()->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::messages.index',['locale' => $locale]);

    visit($route)
        ->click("Ouvrir le message")
        ->assertSee('Message vu')
        ->click("Message vu")
        ->assertDontSee('Message vu'); ;

    assertDatabaseHas('messages', [
        'id' => $message->id,
        'state' => 'read',
    ]);
});

it('can click a message card and show the message and click to delete it', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $message = \App\Models\Message::factory()->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::messages.index',['locale' => $locale]);

    visit($route)
        ->click("Ouvrir le message")
        ->click("Supprimer le message")
        ->assertDontSee("Supprimer le message");    //attend que le message est supprimé

    assertSoftDeleted('messages', [
        'id' => $message->id,
    ]);
});

it('can click a message card and show the message and click to close it', function () {

    $user = User::factory()->create(['is_admin'=>'1']);

    $message = \App\Models\Message::factory()->create();

    $locale = app()->getLocale();
    actingAs($user);

    $route = route('pages::messages.index',['locale' => $locale]);

    visit($route)
        ->click("Ouvrir le message")
        ->assertSee('Supprimer le message')
        ->click('Fermer')
        ->assertDontSee('Fermer');
});

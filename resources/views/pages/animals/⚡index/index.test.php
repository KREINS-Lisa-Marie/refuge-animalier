<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create();
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    Livewire::test('pages::animals.index')
        ->assertStatus(200);
});

it('verifies that the animals page is showing content elements in the right order', function () {
    Livewire::test('pages::animals.index')
        ->assertStatus(200)
        ->assertSee(['Les animaux', 'Créer', 'Filtrer', 'Image', 'Statut', 'Espèce' ]);
});


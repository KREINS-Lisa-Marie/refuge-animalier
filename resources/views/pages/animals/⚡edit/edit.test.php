<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create(['is_admin' => '1']);
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    $animal = \App\Models\Animal::factory()->create();
    Livewire::test('pages::animals.edit', ['animal'=> $animal])
        ->assertStatus(200);
});



it('verifies that the animals page is showing content elements in the right order', function () {
    $animal = \App\Models\Animal::factory()->create();
    Livewire::test('pages::animals.edit', ['animal'=> $animal])
        ->assertStatus(200)
        ->assertSee(['Modifier', 'Informations générales', 'Nom', 'Espèce', 'Statut', 'Description',  ]);
});


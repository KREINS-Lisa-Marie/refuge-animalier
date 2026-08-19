<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create();
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    $animal = \App\Models\Animal::factory()->create();

    Livewire::test('pages::animals.show', ['animal'=>$animal])
        ->assertStatus(200);
});

it('verifies that the page animals show shows the elements in the right order', function (){
    $animal = \App\Models\Animal::factory()->create();

    Livewire::test('pages::animals.show', ['animal'=>$animal]
    )->assertSeeInOrder(['Informations générales', 'Espèce', 'Vaccins', 'Statut', 'Image', 'Galerie', 'Modifier', 'Supprimer']);
});

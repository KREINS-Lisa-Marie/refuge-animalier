<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create(['is_admin' => '1']);
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    Livewire::test('pages::volunteers.index')
        ->assertStatus(200);
});


it('verifies that the volunteers page is showing content elements in the right order', function () {
    Livewire::test('pages::volunteers.index')
        ->assertStatus(200)
        ->assertSee(['Bénévoles', 'Créer', 'Rechercher', 'Image', 'Téléphone', 'Rôle' ]);
});


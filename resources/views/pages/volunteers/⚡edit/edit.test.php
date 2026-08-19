<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create(['is_admin' => '1']);
    \Pest\Laravel\actingAs($this-> user);});

it('renders successfully', function () {
    $volunteer = User::factory()->create(['is_admin'=>0]);

    Livewire::test('pages::volunteers.edit', ['volunteer'=>$volunteer])
        ->assertStatus(200);
});

it('verifies that the volunteers edit page is showing content elements in the right order', function () {
    $volunteer = User::factory()->create(['is_admin'=>false]);
    Livewire::test('pages::volunteers.edit', ['volunteer'=>$volunteer])
        ->assertStatus(200)
        ->assertSee(['Modifier', 'Informations générales', 'Rôle', 'Image', 'Disponibilités', 'Enregistrer' ]);
});

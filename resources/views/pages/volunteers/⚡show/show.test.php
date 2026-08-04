<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create(['is_admin' => '1']);
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    $volunteer = \App\Models\User::factory()->create(['is_admin' => false]);
    $availabilities = \App\Models\Availability::factory()->create(['user_id'=> $volunteer->id]);
    Livewire::test('pages::volunteers.show', [ 'volunteer'=>$volunteer
    ])
        ->assertStatus(200);
});


it('verifies that the volunteers show page is showing content elements in the right order', function () {

    $volunteer = \App\Models\User::factory()->create(['is_admin' => false]);
    $availabilities = \App\Models\Availability::factory()->create(['user_id'=> $volunteer->id]);
    Livewire::test('pages::volunteers.show', [ 'volunteer'=>$volunteer
    ])
        ->assertStatus(200)
        ->assertSee(['Informations générales', 'Email', 'Rôle', 'Image', 'Disponibilités', 'Modifier', 'Supprimer' ]);
});

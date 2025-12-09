<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::volunteers.index')
        ->assertStatus(200);
});


it('verifies that the volunteers page is showing content elements in the right order', function () {
    Livewire::test('pages::volunteers.index')
        ->assertStatus(200)
        ->assertSee(['Bénévoles', 'Créer', 'Rechercher', 'Image', 'Téléphone', 'Rôle' ]);
});


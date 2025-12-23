<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::volunteers.create')
        ->assertStatus(200);
});


it('verifies that the volunteers create page is showing content elements in the right order', function () {
    Livewire::test('pages::volunteers.create')
        ->assertStatus(200)
        ->assertSee(['Créer', 'Informations générales', 'Rôle', 'Mot de passe', 'Image', 'Disponibilités', 'Enregistrer' ]);
});

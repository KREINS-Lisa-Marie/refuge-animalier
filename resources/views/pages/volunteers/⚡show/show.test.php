<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::volunteers.show')
        ->assertStatus(200);
});


it('verifies that the volunteers show page is showing content elements in the right order', function () {
    Livewire::test('pages::volunteers.show')
        ->assertStatus(200)
        ->assertSee(['Informations générales', 'Email', 'Rôle', 'Image', 'Disponibilités', 'Modifier', 'Supprimer' ]);
});

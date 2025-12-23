<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::adoption-requests.index')
        ->assertStatus(200);
});

it('verifies that the adoption-requests page is showing content elements in the right order', function () {
    Livewire::test('pages::adoption-requests.index')
        ->assertStatus(200)
        ->assertSee(['Demandes d’adoption', 'Créer', 'Rechercher', 'Nom', 'Date', 'Statut' ]);
});


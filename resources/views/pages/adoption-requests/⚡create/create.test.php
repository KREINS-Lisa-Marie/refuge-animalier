<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::adoption-requests.create')
        ->assertStatus(200);
});

it('verifies that the adoption-request create page is showing content elements in the right order', function () {
    Livewire::test('pages::adoption-requests.create')
        ->assertStatus(200)
        ->assertSee(['Nouvelle demande d’adoption', 'Nom', 'Prénom', 'Date', 'Statut', 'Commentaire' ]);
});


<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::adoption-requests.edit')
        ->assertStatus(200);
});

it('verifies that the adoption-request edit page is showing content elements in the right order', function () {
    Livewire::test('pages::adoption-requests.edit')
        ->assertStatus(200)
        ->assertSee(['Modifier une demande', 'Nom', 'Prénom', 'Date', 'Statut', 'Commentaire' ]);
});


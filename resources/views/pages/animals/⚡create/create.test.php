<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animals.create')
        ->assertStatus(200);
});

it('verifies that the animals create page is showing content elements in the right order', function () {
    Livewire::test('pages::animals.create')
        ->assertStatus(200)
        ->assertSee(['Créer un animal', 'Informations générales', 'Nom', 'Espèce', 'Statut', 'Description', 'Image',  ]);
});

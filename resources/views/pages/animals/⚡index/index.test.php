<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animals.index')
        ->assertStatus(200);
});

it('verifies that the animals page is showing content elements in the right order', function () {
    Livewire::test('pages::animals.index')
        ->assertStatus(200)
        ->assertSee(['Les animaux', 'Créer', 'Filtrer', 'Image', 'Statut', 'Espèce' ]);
});


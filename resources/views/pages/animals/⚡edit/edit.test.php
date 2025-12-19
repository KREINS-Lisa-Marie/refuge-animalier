<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animals.edit')
        ->assertStatus(200);
});



it('verifies that the animals page is showing content elements in the right order', function () {
    Livewire::test('pages::animals.edit')
        ->assertStatus(200)
        ->assertSee(['Modifier', 'Informations générales', 'Nom', 'Espèce', 'Statut', 'Description', 'Image',  ]);
});


<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::messages.index')
        ->assertStatus(200);
});

it('verifies that the messages page is showing content elements in the right order', function () {
    Livewire::test('pages::messages.index')
        ->assertStatus(200)
        ->assertSee(['Messages', 'Ouvrir email', 'Rechercher', 'Nom', 'Date' ]);
});


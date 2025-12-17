<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::profile.edit')
        ->assertStatus(200);
});


it('verifies that the profile edit page is showing content elements in the right order', function () {
    Livewire::test('pages::profile.edit')
        ->assertStatus(200)
        ->assertSee([ 'Email', 'Mot de passe', 'Enregistrer']);
});


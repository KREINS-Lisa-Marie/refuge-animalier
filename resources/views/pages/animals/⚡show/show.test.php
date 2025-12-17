<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animals.show')
        ->assertStatus(200);
});

it('verifies that the page animals show shows the elements in the right order', function (){

    Livewire::test('pages::animals.show')->assertSeeInOrder(['Informations générales', 'Espèce', 'Vaccins', 'Statut', 'Image', 'Galerie', 'Modifier', 'Supprimer']);
});

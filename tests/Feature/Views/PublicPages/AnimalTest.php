<?php

it('verifies that the animal page is showing content elements in the right order', function () {

    $animal = \App\Models\Animal::factory()->create();

    //act
    $response = $this->get(route('public.animal', ['locale' => __('general.currentLocale'), 'animal' => $animal]));

    //assert
    $response->assertStatus(200)
        ->assertSeeInOrder(["Race", "Caractère", "Galerie"]);

});

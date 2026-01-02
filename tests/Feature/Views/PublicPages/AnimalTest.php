<?php

it('verifies that the animal page is showing content elements in the right order', function () {

    //act
    $response = $this->get(route('public.animal', ['locale' => __('general.currentLocale')]));

    //assert
    $response->assertStatus(200)
        ->assertSeeInOrder(["Race", "Caractère", "Galerie"]);

});

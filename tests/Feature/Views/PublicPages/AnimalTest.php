<?php

it('verifies that the animal page is showing content elements in the right order', function () {


    $response = $this->get(route('public.animal', ['locale' => __('general.currentLocale')]));

    $response->assertStatus(200)
        ->assertSeeInOrder(["Race", "Caractère", "Galerie"]);

});

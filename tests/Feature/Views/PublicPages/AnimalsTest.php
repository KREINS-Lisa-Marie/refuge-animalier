<?php

it('verifies that the animals page is showing content elements in the right order', function () {

$animals = \App\Models\Animal::factory(10)->create();

    $response = $this->get(route('public.animals', ['locale' => __('general.currentLocale')], compact('animals')));

    $response->assertStatus(200)
        ->assertSeeInOrder(["Nos animaux", "Age", "Rechercher"]);

});

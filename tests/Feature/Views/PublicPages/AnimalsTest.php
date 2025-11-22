<?php

it('verifies that the animals page is showing content elements in the right order', function () {


    $response = $this->get(route('public.animals'));

    $response->assertStatus(200)
        ->assertSeeInOrder(["Nos animaux", "Age", "Rechercher"]);

});

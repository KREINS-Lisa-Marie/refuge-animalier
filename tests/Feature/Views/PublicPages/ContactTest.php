<?php

it('verifies that the contact page is showing it’s main title', function () {


    $response = $this->get(route('public.contact'));

    $response->assertStatus(200)
        ->assertSeeInOrder(["form", "Contactez-nous", "Envoyer"]);

});

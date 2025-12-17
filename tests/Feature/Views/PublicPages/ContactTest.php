<?php

it('verifies that the contact page is showing it’s main title', function () {


    $response = $this->get(route('public.contact', ['locale' => __('general.currentLocale')]));

    $response->assertStatus(200)
        ->assertSeeInOrder([ "Contactez-nous", "form", "Envoyer"]);

});

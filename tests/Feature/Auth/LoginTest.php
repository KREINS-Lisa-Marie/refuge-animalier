<?php

it('verifies that the login page is showing content elements in the right order', function () {

    //act
    $response = $this->get(route('auth.login',['locale' => __('general.currentLocale')]));

    //assert
    $response->assertStatus(200)
        ->assertSeeInOrder(["Se connecter", "Adresse email", "Mot de passe", "button", "Se connecter"]);
});

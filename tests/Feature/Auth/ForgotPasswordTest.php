<?php

it('displays the forgotten password form and verifies that the elements are in the correct order', function () {

    // act
    $response = $this->get(route('auth.forgot-password',['locale' => __('general.currentLocale')]));

    // assert
    $response->assertStatus(200)
        ->assertSeeInOrder(["Mot de passe oublié", "form", "Adresse email", "button", "Réinitialiser"]);
    }
);

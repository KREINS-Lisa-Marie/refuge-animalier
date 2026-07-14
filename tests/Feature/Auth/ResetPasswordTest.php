<?php

it('verifies that a form is displayed on the reset password page and that the elements are in the right order', function () {

    // act
    $response = $this->get(route('auth.reset-password',['locale' => __('general.currentLocale')]));

    // assert
    $response->assertStatus(200)
        ->assertSeeInOrder(["Réinitialiser mot de passe", "form", "Adresse email", "Mot de passe", "Retapez votre mot de passe", "button", "Réinitialiser"]);
    }
);

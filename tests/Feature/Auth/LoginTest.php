<?php

it('can display the login form', function () {

    // action

    $response = $this->get('/login');

    // assert
    $response->assertSee('Se connecter')
        ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Se connecter'], true);
}
);



it('can display the forgotten password form', function () {

    // action

    $response = $this->get('/forgot-password');

    // assert
    $response->assertSee('Mot de passe oublié')
        ->assertSeeInOrder(['<form', 'email', '<button', 'Réinitialiser'], true);
}
);

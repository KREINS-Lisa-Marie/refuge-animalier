<?php

it('can display the login form', function () {

    // action

    $response = $this->get('/login');

    // assert
    $response->assertSee('Se connecter')
        ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Se connecter'], true);
}
);

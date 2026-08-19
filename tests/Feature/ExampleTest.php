<?php

test('the application returns a successful response', function () {
    $response = $this->get('/fr');

    $response->assertStatus(200);
});

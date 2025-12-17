<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});



it('verifies that the homepage is showing it’s main title and another title', function () {


    $response = $this->get(route('public.homepage', ['locale' => __('general.currentLocale')]));

    $response->assertStatus(200)
        ->assertSeeInOrder(["LES PATTES HEUREUSES", "Adoptez-nous"]);

});

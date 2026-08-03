<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseMissing;

uses(RefreshDatabase::class);

// fertig
//login

it('can sign in the user', function () {

    User::factory()->create([
        'first_name' => 'Test User',
        'last_name' => 'User',
        'email' => 'test@example.com',
        'phone' => fake()->phoneNumber(),
        'is_admin' => 'false',
        'password' => Hash::make('password'),
    ]);


    $locale = app()->getLocale();


    $this->visit("/$locale/login")->on()->mobile()
        ->assertSee('Se connecter')
        ->fill('email', 'test@example.com')
        ->fill('password', 'password')
        ->click('button[type="submit"]')
        ->assertSee('Accueil');

    $this->assertAuthenticated();
});

it('doesnt sign in the user if the credentials are wrong', function () {

    User::factory()->create([
        'email' => 'bob@test.com',
        'password' => 'password',
    ]);

    $locale = app()->getLocale()/*__('general.currentLocale')*/;


    $this->visit("/$locale/login")->on()->mobile()
        ->assertSee('Se connecter')
        ->fill('email', 'bob@test.com')
        ->fill('password', '12345678')
        ->click('button[type="submit"]')
        ->assertSee('Ces identifiants ne correspondent pas');

    $this->assertGuest();
});

it('redirects to the reset password page when clicked on the link', function () {

    $locale = app()->getLocale() /*__('general.currentLocale')*/;

    $this->visit(route('auth.login', ['locale' => $locale]))->on()->mobile()
        ->assertSee('Se connecter')
        ->click('Mot de passe oublié?')
        ->assertSee('Réinitialiser')
        ->assertUrlIs(route('auth.forgot-password', ['locale' => $locale]));
});


// Reset password

it('resets the password', function () {

    User::factory()->create([
        'email' => 'bob@test.com',
        'password' => 'password',
    ]);

    $locale = app()->getLocale()/* __('general.currentLocale')*/;


    $this->visit("/$locale/forgot-password")->on()->mobile()
        ->assertSee('Mot de passe oublié')
        ->fill('email', 'bob@test.com')
        ->click('button[type="submit"]')
        ->assertSee("Nous vous avons envoyé par e-mail ");
});

it('gives an error if reset password takes an email of someone who isnt a user', function () {

    User::factory()->create([
        'email' => 'bob@test.com',
        'password' => 'password',
    ]);

    $locale = app()->getLocale() /*__('general.currentLocale')*/;


    $this->visit("/$locale/forgot-password")->on()->mobile()
        ->assertSee('Mot de passe oublié')
        ->fill('email', 'bob@hotmail.com')
        ->click('button[type="submit"]')
        ->assertSee("Nous ne trouvons aucun utilisateur ");
});

it('redirects to the login page when clicked on the return link', function () {

    $locale = /*app()->getLocale()*/ __('general.currentLocale');

    $this->visit("/$locale/forgot-password")->on()->mobile()
        ->assertSee('Mot de passe oublié')
        ->click('Retour à la connexion')
        ->assertUrlIs(route('auth.login', ['locale' => $locale]));
});

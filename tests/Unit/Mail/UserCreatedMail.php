<?php

use App\Mail\OrderReminderMail;
use App\Mail\UserCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


it("can create an user created mail", function (){

    $volunteer = User::factory()->create(['is_admin'=>'0', 'password' => '1234567890']);

    $mail = new \App\Mail\UserCreatedMail($volunteer, '1234567890');     //créer le mail

    expect($mail)->toBeInstanceOf(UserCreatedMail::class);        //Mail  = UserCreatedMail objet

});

it("has the correct content in an user created mail", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0', 'password' => '1234567890']);

    $mail = new UserCreatedMail($volunteer, '1234567890');     //créer le mail

    $mail->assertSeeInOrderInHtml( ["identifiants pour vous connecter ", "Email", "Mot de passe", "collaboration porteuse"]);
});

it("sends an created mail mail to the correct user", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0', 'password' => '1234567890']);

    Mail::to($volunteer->email)->send(new UserCreatedMail($volunteer, '1234567890'));

    Mail::assertQueued(UserCreatedMail::class, function (UserCreatedMail $mail) use ($volunteer) {
        return $mail->hasTo($volunteer->email);
    });

});

it("only sends an created mail mail to one person", function (){

    \Mail::fake();

    $volunteers = User::factory(5)->create(['is_admin'=>'0']);
    $new_volunteer = User::factory()->create(['is_admin'=>'0', 'password' => '1234567890']);
    $admins = User::factory()->create(['is_admin'=>'1']);

        \Mail::to($new_volunteer->email)->send(new UserCreatedMail($new_volunteer, '1234567890'));

    Mail::assertQueued(UserCreatedMail::class, 1);
});


/*
 *
 * https://laravel.com/docs/13.x/mail#testing-mailable-sending
 *
 * */

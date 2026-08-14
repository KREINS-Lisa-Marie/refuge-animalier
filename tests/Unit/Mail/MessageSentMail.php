<?php

use App\Mail\MessageSentMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


it("can create an message sent mail", function (){

    $message = \App\Models\Message::factory()->create();

    $mail = new \App\Mail\MessageSentMail($message);     //créer le mail

    expect($mail)->toBeInstanceOf(\App\Mail\MessageSentMail::class);        //Mail  = UserCreatedMail objet

});

it("has the correct content in an message sent mail", function (){

    Mail::fake();

    $message = \App\Models\Message::factory()->create();

    $mail = new MessageSentMail($message);     //créer le mail

    $mail->assertSeeInOrderInHtml( ["Nous avons bien réçu votre message.", "Récapitulatif de votre message :", "Sujet"]);
});

it("sends the message sent mail to the correct user", function (){


    Mail::fake();

    $message = \App\Models\Message::factory(['email' => 'j@j.com'])->create();
    $admin = User::factory()->create(['is_admin' => '1']);

    $mail = new MessageSentMail($message);     //créer le mail

    $mail = Mail::to($admin->email)->send(new MessageSentMail($message));

    Mail::assertQueued(MessageSentMail::class, function (MessageSentMail $mail) use ($admin) {
        return $mail->hasTo($admin->email);
    });

});

<?php

use App\Mail\AdoptionRequestProcessingMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


it("can create an adoption request processing mail", function (){

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);

    $mail = new \App\Mail\AdoptionRequestProcessingMail($new_request);     //créer le mail

    expect($mail)->toBeInstanceOf(AdoptionRequestProcessingMail::class);        //Mail  = OrderReminderMail objet

});

it("has the correct content in an adoption request processing mail", function (){

    Mail::fake();

    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);

    $mail = new AdoptionRequestProcessingMail($new_request);     //créer le mail

    $mail->assertSeeInOrderInHtml( ["Votre demande d’adoption est en cours de vérification.", "rendez-vous avec vous.", "Récapitulatif de votre demande :"]);
});

it("sends an adoption request processing mail to the correct user", function (){

    Mail::fake();

    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);


    Mail::to($new_request->email)->send(new AdoptionRequestProcessingMail($new_request));

    Mail::assertQueued(AdoptionRequestProcessingMail::class, function (AdoptionRequestProcessingMail $mail) use ($new_request) {
        return $mail->hasTo($new_request->email);
    });

});

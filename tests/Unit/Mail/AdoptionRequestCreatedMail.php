<?php

use App\Mail\AdoptionRequestCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it("can create an adoption request created mail", function (){

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);

    $mail = new \App\Mail\AdoptionRequestCreatedMail($new_request);     //créer le mail

    expect($mail)->toBeInstanceOf(AdoptionRequestCreatedMail::class);        //Mail  = OrderReminderMail objet

});

it("has the correct content in an adoption request created mail", function (){

    Mail::fake();

    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);

    $mail = new AdoptionRequestCreatedMail($new_request);     //créer le mail

    $mail->assertSeeInOrderInHtml( ["Nous avons bien réçu votre demande d’adoption.", "reprendre contact avec vous", "Récapitulatif de votre demande :"]);
});

it("sends an adoption request created mail to the correct user", function (){

    Mail::fake();

    $animal = \App\Models\Animal::factory()->create();
    $new_request = \App\Models\Request::factory()->create(['animal_id'=>$animal->id]);


    Mail::to($new_request->email)->send(new AdoptionRequestCreatedMail($new_request));

    Mail::assertQueued(AdoptionRequestCreatedMail::class, function (AdoptionRequestCreatedMail $mail) use ($new_request) {
        return $mail->hasTo($new_request->email);
    });

});

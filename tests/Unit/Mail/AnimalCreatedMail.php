<?php

use App\Mail\AnimalCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


it("can create an animal created mail", function (){

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();

    $mail = new \App\Mail\AnimalCreatedMail($animal);     //créer le mail

    expect($mail)->toBeInstanceOf(AnimalCreatedMail::class);        //Mail  = OrderReminderMail objet
});

it("has the correct content in an animal created mail", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();

    $mail = new AnimalCreatedMail($animal);     //créer le mail

    $mail->assertSeeInOrderInHtml( ["nouvel animal", "Nom de l'animal", "Espèce"]);
    $mail->assertSeeInHtml($animal->animal_name);
});


it("sends an animal created mail to the correct user", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();
    $admin = User::factory()->create(['is_admin' => '1']);

    $mail = Mail::to($admin->email)->send(new AnimalCreatedMail($animal));
   /* expect($mail->hasTo($admin->email))->toBeTrue();*/
    Mail::assertQueued(AnimalCreatedMail::class, function (AnimalCreatedMail $mail) use ($admin) {
        return $mail->hasTo($admin->email);
    });
});

<?php

use App\Mail\AnimalUpdatedMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it("can create an animal updated mail", function (){

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();

    $mail = new \App\Mail\AnimalUpdatedMail($animal);     //créer le mail

    expect($mail)->toBeInstanceOf(\App\Mail\AnimalUpdatedMail::class);        //Mail  = AnimalUpdatedMail objet
});

it("has the correct content in an animal updated mail", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();

    $mail = new AnimalUpdatedMail($animal);     //créer le mail

    $mail->assertSeeInOrderInHtml( ["Un animal a été modifié", "Nom de l'animal", "Espèce", "Changé le"]);
    $mail->assertSeeInHtml($animal->animal_name);
});


it("sends an animal updated mail to the correct user", function (){

    Mail::fake();

    $volunteer = User::factory()->create(['is_admin'=>'0']);
    $animal = \App\Models\Animal::factory()->create();

    $mail = new AnimalUpdatedMail($animal);     //créer le mail
    $admin = User::factory()->create(['is_admin' => '1']);

    $mail = Mail::to($admin->email)->send(new AnimalUpdatedMail($animal));/*
    expect($mail->hasTo($admin->email))->toBeTrue();*/

    Mail::assertQueued(AnimalUpdatedMail::class, function (AnimalUpdatedMail $mail) use ($admin) {
        return $mail->hasTo($admin->email);
    });

});

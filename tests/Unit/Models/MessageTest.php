<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create multiple messages', function () {

    $messages = [];
    $messages = Message::factory(5)->create();

    expect($messages)->toHaveCount(5);
});


it('can retrieve messages with a state of read or not read yet.', function () {

    $message_read = Message::factory(4)->create([
        'state'=>'read'
    ]);
    $message_not_read = Message::factory(3)->create([
        'state'=>'not_read_yet'
    ]);

    expect($message_read)->toHaveCount(4);
    expect($message_not_read)->toHaveCount(3);
});

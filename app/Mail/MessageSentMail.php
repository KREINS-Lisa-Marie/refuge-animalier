<?php

namespace App\Mail;

use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class MessageSentMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Message $messageSent)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('lespattesheureuses@noreply.be', 'NoReply'),
            subject: __('emails/message-sent.message_sent'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.message-sent',
        );
    }

    public function attachments(): array
    {
        return [];
    }



    public function failed(Throwable $exception): void
    {
        //dump("Erreur pour queue");        Marche pas parce que c'est pas dans une requête web

        \Log::error( "Erreur pour queue".$exception->getMessage());
    }

    /*Pour quand queue fail
   https://laravel.com/docs/13.x/mail#queued-email-failures
   https://laravel.com/docs/13.x/logging#writing-log-messages
   */
}

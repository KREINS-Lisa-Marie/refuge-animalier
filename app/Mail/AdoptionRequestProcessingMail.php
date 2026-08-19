<?php

namespace App\Mail;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class AdoptionRequestProcessingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Request $adoptionRequest)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('lespattesheureuses@noreply.be', 'NoReply'),
            subject: __('emails/adoption-request-processing.adoption-request-processing'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.adoption-request-processing',
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

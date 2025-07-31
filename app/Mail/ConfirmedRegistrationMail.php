<?php

namespace App\Mail;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmedRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;

    /**
     * Create a new message instance.
     */
    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Konfirmasi Registrasi - ' . $this->registration->registrationForm->event->title)
            ->view('emails.confirmed-registration')
            ->with([
                'registration' => $this->registration,
                'event' => $this->registration->registrationForm->event,
                'participantName' => $this->registration->getParticipantName(),
                'statusUrl' => route('registrasi.status', $this->registration->id)
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

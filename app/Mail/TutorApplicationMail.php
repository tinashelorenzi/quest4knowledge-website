<?php

namespace App\Mail;

use App\Models\TutorApplication;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TutorApplicationMail extends Mailable
{
    use SerializesModels;

    public function __construct(
        public TutorApplication $application
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Tutor Application - ' . $this->application->full_name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.tutor-application',
        );
    }
}
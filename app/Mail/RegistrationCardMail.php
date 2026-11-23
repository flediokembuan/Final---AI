<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationCardMail extends Mailable
{
    use Queueable, SerializesModels;

    public Application $application;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application->loadMissing(['user', 'documents']);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusLabel = match ($this->application->status) {
            'approved' => '[DISETUJUI] ',
            'rejected' => '[PEMBERITAHUAN] ',
            default => '',
        };

        $regNum = $this->application->registration_number ?? 'PMB-UNKLAB-2026';

        return new Envelope(
            subject: "{$statusLabel}[PMB UNKLAB] Kartu Tanda Bukti Pendaftaran - {$regNum}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-card',
            with: [
                'application' => $this->application,
                'user' => $this->application->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     * Note: Requirement specifically states NO PDF attachment, render inline HTML directly.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

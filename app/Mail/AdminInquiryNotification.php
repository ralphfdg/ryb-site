<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminInquiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Inquiry $inquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New RYB General Inquiry: ' . $this->inquiry->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // We will create a simple markdown email template next
        return new Content(
            markdown: 'emails.admin.inquiry',
        );
    }
}
<?php

namespace App\Mail;

use App\Models\Meeting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetingReportMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $meeting;
    public $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct(Meeting $meeting, $pdfContent)
    {
        $this->meeting = $meeting;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "تقرير محضر اجتماع: {$this->meeting->title}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.meeting-report',
            with: [
                'title' => $this->meeting->title,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfContent, "meeting-report-{$this->meeting->id}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}

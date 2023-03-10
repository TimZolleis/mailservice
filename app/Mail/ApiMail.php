<?php

namespace App\Mail;

use App\Models\entities\MailRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use function Symfony\Component\Translation\t;

class

ApiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public string $mailSubject;
    public string $mailBody;
    public string $mailSendingAddress;
    public string $mailSendingName;

    public function __construct(string $mailSubject, string $mailBody, string $mailSendingAddress, string $mailSendingName)
    {
        $this->mailSubject = $mailSubject;
        $this->mailBody = $mailBody;
        $this->mailSendingAddress = $mailSendingAddress;
        $this->mailSendingName = $mailSendingName;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->mailSendingAddress, $this->mailSendingName),
            subject: $this->mailSubject
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.default', with: [
            'body' => $this->mailBody]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

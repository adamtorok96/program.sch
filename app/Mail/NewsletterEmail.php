<?php

namespace App\Mail;

use App\Models\NewsletterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class NewsletterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var NewsletterMail
     */
    private $newsletterMail;

    /**
     * Create a new message instance.
     *
     * @param NewsletterMail $newsletterMail
     */
    public function __construct(NewsletterMail $newsletterMail)
    {
        $this->newsletterMail = $newsletterMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to(config('mail.from.address'))
            ->from(Str::slug($this->newsletterMail->circle->name) . '@program.sch.bme.hu')
            ->bcc($this->newsletterMail->getParticipants())
            ->subject($this->newsletterMail->subject)
            ->view('mails.newsletter-mails.layout', [
                'msg'       => $this->newsletterMail->message,
                'circle'    => $this->newsletterMail->circle
            ])
        ;
    }
}

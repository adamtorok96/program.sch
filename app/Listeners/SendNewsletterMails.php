<?php

namespace App\Listeners;

use App\Events\NewsletterMailCreated;
use App\Mail\NewsletterEmail;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendNewsletterMails
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewsletterMailCreated  $event
     * @return void
     */
    public function handle(NewsletterMailCreated $event)
    {
        $newsletterMail = $event->getNewsletterMail();

        Mail::send(new NewsletterEmail($newsletterMail));

        $newsletterMail->update([
            'sent_at' => Carbon::now()
        ]);

        $newsletterMail->recipients()->attach($newsletterMail->getParticipants());
    }
}

<?php

namespace App\Events;

use App\Models\NewsletterMail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewsletterMailCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var $newsletterMail NewsletterMail
     */
    private $newsletterMail;

    /**
     * Create a new event instance.
     *
     * @param NewsletterMail $newsletterMail
     */
    public function __construct(NewsletterMail $newsletterMail)
    {
        $this->newsletterMail = $newsletterMail;
    }

    /**
     * @return NewsletterMail
     */
    public function getNewsletterMail() : NewsletterMail
    {
        return $this->newsletterMail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('newsletter-mail-created');
    }
}

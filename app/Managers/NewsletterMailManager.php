<?php


namespace App\Managers;


use App\Events\NewsletterMailCreated;
use App\Models\Circle;
use App\Models\NewsletterMail;
use App\Models\User;

class NewsletterMailManager
{
    public function store(Circle $circle, User $user, array $data) : NewsletterMail
    {
        $data = array_merge($data, [
            'circle_id' => $circle->id,
            'user_id'   => $user->id
        ]);

        $newsletterMail = NewsletterMail::create($data);

        event(new NewsletterMailCreated($newsletterMail));

        return $newsletterMail;
    }

}
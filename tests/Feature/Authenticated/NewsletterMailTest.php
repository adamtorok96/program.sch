<?php


namespace Tests\Feature\Authenticated;


use Tests\AuthenticatedFeatureTestCase;


class NewsletterMailTest extends AuthenticatedFeatureTestCase
{
    public function testIndex()
    {
        $this
            ->get('/newsletterMails')
            ->assertOk()
        ;
    }

    public function testArchive()
    {
        $this
            ->get('newsletterMails/archive')
            ->assertOk()
        ;
    }
}
<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreNewsletterMail;
use App\Managers\NewsletterMailManager;
use App\Models\Circle;
use App\Models\NewsletterMail;
use Auth;

class NewsletterMailsController extends Controller
{
    public function index()
    {
        return view('newsletter-mails.index', [
            'newsletters' => Auth::user()->newsletters()->latest()->paginate()
        ]);
    }

    public function archive()
    {
        return view('newsletter-mails.archive', [
            'newsletters' => NewsletterMail::latest()->paginate()
        ]);
    }

    public function create(Circle $circle)
    {
        return view('newsletter-mails.create', [
            'circle'    => $circle,
            'affected'  => $circle->newsletterRecipients()->count()
        ]);
    }

    public function store(NewsletterMailManager $manager, StoreNewsletterMail $request, Circle $circle)
    {
        $newsletterMail = $manager->store($circle, $request->user(), [
            'subject'       => $request->subject,
            'message'       => $request->message
        ]);

        return redirect()->route('newsletterMails.show', [
            'newsletterMail' => $newsletterMail
        ]);
    }

    public function show(NewsletterMail $newsletterMail)
    {
        return view('newsletter-mails.show', [
            'newsletterMail' => $newsletterMail
        ]);
    }
}
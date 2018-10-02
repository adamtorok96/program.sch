<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreEmailMessage;
use App\Http\Requests\UpdateEmailMessage;
use App\Models\Circle;
use App\Models\EmailMessage;
use Auth;
use Carbon\Carbon;

class EmailsController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('emails.create', [
            'circles' => Circle::wherePrManager(Auth::user())->orderBy('name')->get()
        ]);
    }

    public function store(StoreEmailMessage $request)
    {
        $emailMessage = EmailMessage::create([
            'user_id'       => $request->user()->id,
            'circle_id'     => $request->circle,
            'message'       => $request->message,
            'message_html'  => $request->message_html,
            'send_at'       => new Carbon($request->send_at)
        ]);

        // new event maybe

        return redirect()->route('emails.show', [
            'emailMessage' => $emailMessage
        ]);
    }

    public function edit(EmailMessage $emailMessage)
    {
        abort_if(is_null($emailMessage->send_at), 403, 'Ez az üzenet ki lett küldve vagy kiküldés alatt áll!');
    }

    public function update(UpdateEmailMessage $request, EmailMessage $emailMessage)
    {

    }

    public function destroy(EmailMessage $emailMessage)
    {
        abort_if(is_null($emailMessage->send_at), 403, 'Ez az üzenet ki lett küldve vagy kiküldés alatt áll!');
    }
}
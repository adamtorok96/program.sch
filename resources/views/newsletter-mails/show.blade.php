@extends('layouts.layout')

@section('title', 'Hírlevelek')
@section('subtitle', $newsletterMail->subject)
@section('icon', 'newspaper')

@section('content')
    @include('layouts.title-center')

    @markdown($newsletterMail->message)

    <hr>
    Ezt az e-mail <b>{{ $newsletterMail->recipients()->count() }}</b> felhasználó kapta meg.
    A levél kiküldésének időpontja: <b>{{ $newsletterMail->sent_at->format('Y. m. d. H:i') }}</b>
@endsection
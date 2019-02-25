@extends('layouts.layout')

@section('title', 'Új program')
@section('subtitle', 'Információ')
@section('icon', 'info-circle')

@section('content')
    @include('layouts.title')
    <p>
        Új program felvételéhez <b>Körvezető</b>nek vagy <b>PR mendezser</b>nek kell, hogy legyél az adott körnél <a href="https://pek.sch.bme.hu" target="_blank">PéK</a>-en.
    </p>
@endsection
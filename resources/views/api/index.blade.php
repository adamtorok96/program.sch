@extends('layouts.layout')

@section('title', 'Api információ')
@section('icon', 'cloud')

@section('content')
    @include('layouts.title')

    <p>
        Elérhetővé vált a Program.sch API használata.
        <a href="https://programsch-web-api-docs.firebaseapp.com" target="_blank">Ezen</a> az oldal elérhető a hozzá tartozó dokumentáció.<br>
        API token-t az alábbi e-mail címre írva tudtok igényelni: <b>adam.torok96</b>[kukac]<b>gmail</b>[pont]<b>com</b>.
    </p>
    <p class="text-right">Török Ádám <i>"Rick"</i></p>
@endsection
@extends('layouts.layout')
@section('title', 'Naptár')
@section('content')
    <div class="row">
        @each('calendar.day', $days, 'day')
    </div>
@endsection
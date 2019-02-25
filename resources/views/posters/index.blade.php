@extends('layouts.layout')

@section('title', 'Poszterek')
@section('icon', 'images')

@section('content')
    <div class="row">
        @each('posters.poster', $posters, 'poster')
    </div>
    {{ $posters->links() }}
@endsection
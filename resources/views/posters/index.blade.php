@extends('layouts.layout')

@section('title', 'Plakátok')
@section('icon', 'images')

@section('content')
    @include('layouts.title-center')

    <div class="row">
        @each('posters.poster', $posters, 'poster')
    </div>
    {{ $posters->links() }}
@endsection
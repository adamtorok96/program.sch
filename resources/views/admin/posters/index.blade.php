@extends('admin.layouts.layout')
@section('title', 'Plakátok')
@section('content')
    <div class="row">
        @each('admin.posters.poster', $posters, 'poster')
    </div>
@endsection
@extends('admin.layouts.layout')
@section('title', 'Adminisztráció')
@section('content')
    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.programs.index') }}" class="btn btn-default">
                <i class="fa fa-calendar fa-3x" aria-hidden="true"></i>
                <h3>{{ $programs }}</h3>
                <small>Programok</small>
            </a>
        </div>

        <div class="btn-group" role="group">
            <a href="{{ route('admin.resorts.index') }}" class="btn btn-default">
                <i class="fa fa-circle fa-3x" aria-hidden="true"></i>
                <h3>{{ $resorts }}</h3>
                <small>Reszortok</small>
            </a>
        </div>

        <div class="btn-group" role="group">
            <a href="{{ route('admin.circles.index') }}" class="btn btn-default">
                <i class="fa fa-circle-o fa-3x" aria-hidden="true"></i>
                <h3>{{ $circles }}</h3>
                <small>Körök</small>
            </a>
        </div>

        <div class="btn-group" role="group">
            <a href="{{ route('admin.users.index') }}" class="btn btn-default">
                <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                <h3>{{ $users }}</h3>
                <small>Felhasználók</small>
            </a>
        </div>
    </div>
@endsection
@extends('layouts.base')
@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('admin.layouts.navbar')
            </div>
            <div class="col-md-9">
                @include('layouts.title')
                @yield('content')
            </div>
        </div>
    </div>
@endsection
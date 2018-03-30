@extends('layouts.base')

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/laroute.js') }}"></script>
    <script type="text/javascript" src="{{ mix('js/admin.js') }}"></script>
@endpush

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
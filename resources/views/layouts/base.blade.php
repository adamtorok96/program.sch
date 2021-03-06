<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="@yield('title') | Program.sch" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="hu_HU" />
        @stack('ogs')

        <title>@yield('title') | Program.sch</title>

        <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon">
        <link href="{{ asset('favicon.ico') }}" type="image/x-icon" rel="icon">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        <header>@include('layouts.navbar')</header>
        <section>@yield('body')</section>

        <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
        @if(app()->environment('production'))
            <script type="text/javascript" src="{{ mix('js/google-analytic.js') }}"></script>
        @endif
        @if(Auth::check() && Auth::user()->isAdmin())
            <script type="text/javascript" src="{{ mix('js/laroute.js') }}"></script>
            <script type="text/javascript" src="{{ mix('js/admin.js') }}"></script>
        @endif
        @stack('scripts')
    </body>
</html>
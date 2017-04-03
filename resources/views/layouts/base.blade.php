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
        @stack('scripts')
    </body>
</html>
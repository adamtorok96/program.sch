<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | Program.sch</title>

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
    <h1>Hello, world!</h1>

        <script src="{{ mix('js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            @include('partials.header')

            @yield('content')
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>

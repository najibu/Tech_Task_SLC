<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Full Stack Tech Test</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body class="">
        <div id="app">
            <example-component></example-component>
         </div>

         <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="{{asset('dist/img/favicon.png')}}" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('dist/css/theme-default.css')}}"/>
    </head>
    <body>
        <div class="error-container">
            <div class="error-code">@yield('code')</div>
            <div class="error-text">@yield('message')</div>
            <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
            <div class="error-actions">
                @yield('action')
            </div>
        </div>                 
    </body>
</html>

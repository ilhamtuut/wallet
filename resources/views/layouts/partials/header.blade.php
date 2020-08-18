<head>
    <title>{{ config('app.name', 'Laravel') }}</title>            
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="{{asset('dist/img/favicon.png')}}" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('dist/css/theme-default.css')}}"/>
	<link href="{{asset('dist/captcha/slidercaptcha.css')}}" rel="stylesheet" />
</head>
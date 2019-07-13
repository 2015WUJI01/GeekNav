<!doctype html>
<html lang="zh_cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('style')
    <style>
        .container-fluid {
            margin-top: 70px;
        }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div class="container-fluid">
    @include('layouts.nav')
    @yield('content')
</div>
</body>
</html>

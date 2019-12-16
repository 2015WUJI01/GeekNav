<!doctype html>
<html lang="zh_cn">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/xenon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/xenon-components.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/xenon-skins.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/fonts/linecons/css/linecons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/webstack/css/fonts/fontawesome/css/font-awesome.min.css') }}">
    @yield('style')
    <script src="{{ asset('/assets/webstack/js/jquery-1.11.1.min.js') }}"></script>
</head>

<body class="page-body">
<!-- skin-white -->

@yield('content')

@yield('script')
</body>
</html>

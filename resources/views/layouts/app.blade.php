<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('includes.style')
    <link rel="stylesheet" href="{{ url('assets/css/shared/iconly.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div id="app">
        @include('includes.sidebar')
        @yield('content')
        @include('includes.script')
        @include('includes.sweetalerts')
    </div>

    @stack('after-script')
</body>

</html>
<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/f4eca1ee68.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-grid.css') }}">

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('links')
    @yield('styles')
    @yield('header')
    <!-- Styles -->
    <script src="https://kit.fontawesome.com/33aa20a538.js" crossorigin="anonymous"></script>
    @livewireStyles

</head>

<body class="font-sans antialiased bg-gray-200">
    @include('layouts.adminbar')


    @livewireScripts
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/flowbite.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    {{-- dark mode switcher --}}
    <script src="{{ asset('js/mode.js') }}"></script>
    {{-- dark mode switcher --}}
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    @yield('scripts')
</body>

</html>

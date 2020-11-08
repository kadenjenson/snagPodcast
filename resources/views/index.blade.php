<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-gray-900 antialiased leading-tight">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

{{--        <!-- CSRF Token -->--}}
{{--        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

        <title>@yield('title', 'Snag Podcast')</title>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body class="h-full min-h-screen w-full min-w-screen bg-gray-200">
        <div class="main-app-container h-full min-h-screen">

            <header class="nav-wrapper h-16 w-full px-8 bg-white shadow">
                @include('includes.navbar')
            </header>

            <section class="content-wrapper h-full w-full @yield('page-class', '')">
                @yield('page-header')
                @yield('page-content')
            </section>

            <footer class="footer-wrapper w-full p-8 bg-white border-purple-500 border-t-4">
                @include('includes.footer')
            </footer>

        </div>
    </body>
</html>

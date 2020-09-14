<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-gray-900 antialiased leading-tight">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Snag Podcast')</title>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="main-app-container">

            <header class="nav-wrapper">
                @include('includes.navbar')
            </header>

            <section class="content-wrapper">
                <div class="@yield('page-class', 'page')">
                    @yield('page-header', '')
                    @yield('page-content')
                </div>
            </section>

            <footer class="footer-wrapper">
                @include('includes.footer')
            </footer>

        </div>
    </body>
</html>

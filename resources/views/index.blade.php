<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, intial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>@yield('title', 'Snag Podcast')</title>
    </head>

    <body>
        <div class="main-app-container">

            <header class="nav-wrapper">
                @include('includes.navbar')
            </header>

            <div class="content-wrapper">
                <div class="@yield('page-class', 'page')">
                    @yield('page-header', '')
                    @yield('page')
                </div>
            </div>

            <footer class="footer-wrapper">
                @include('includes.footer')
            </footer>

        </div>
    </body>
</html>

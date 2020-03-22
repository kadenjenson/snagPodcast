<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield('title', 'Snag Podcast')</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
        <div class="main-app-container">

            <header class="nav-wrapper">
                @include('includes.navbar')
            </header>

            <div class="content-wrapper">
                <div class="@yield('page-class', 'page')">
                    @yield('page-header', '')
                    @yield('page-content')
                </div>
            </div>

            <footer class="footer-wrapper">
                @include('includes.footer')
            </footer>

        </div>
    </body>
</html>

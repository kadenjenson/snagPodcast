<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Snag Podcast')</title>

    @include('includes.head')
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

<!DOCTYPE html>
<html>
    <head>
      <title>@yield('title', 'Snagpodcast')</title>

      @include('includes.head')
    </head>

    <body>
      <div class="main-app-container">
        
        <header class="header-wrapper">

          @include('includes.header')

        </header>
        
        <div class="content-wrapper">
          <div class="@yield('page-class', 'page')">
            @yield('page')
          </div>
        </div>

        <footer class="footer-wrapper">

          @include('includes.footer')

        </footer>

      </div>
    </body> 
</html>
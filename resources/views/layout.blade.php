<!DOCTYPE html>
<html>
    <head>
      <title>@yield('title', 'Snagpodcast')</title>

      @include('includes.head')
    </head>

    <body>
      <div class="main-app-containter">
        <header class="app-header">

          @include('includes.header')

        </header>
        
        <div class="app-page">

          @yield('page')

        </div>

        <footer class="app-footer">

          @include('includes.footer')
          
        </footer>

      </div>
    </body> 
</html>
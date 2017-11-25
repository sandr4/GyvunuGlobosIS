<!DOCTYPE html>
<html lang="en">
  <head>
    @include('GyvunuGloba.Layout.Partials.header')
  </head>
  <body>
    <!-- Navigation -->
    @include('GyvunuGloba.Layout.Partials.navigation')
    <!-- Flash message -->
    @include('GyvunuGloba.Layout.Partials.flashMessage')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
          <!-- search -->
          @yield('search')
          @yield('width')
            <!-- slider -->
            @yield('slider')
            <div class="row">
              @yield('content')
            </div>
          </div>
        </div>
    </div>
    <!-- footer -->
    @include('GyvunuGloba.Layout.Partials.footer')
  </body>
</html>
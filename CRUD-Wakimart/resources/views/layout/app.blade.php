<!doctype html>
<html lang="{{ app()->getLocale() }}">
  @include('layout.head')
  <body>
    @yield('content')

    @include('layout.script')
    @yield('script')
  </body>
</html>
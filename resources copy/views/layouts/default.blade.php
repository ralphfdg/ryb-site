<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head />

<body>

  <x-header />

  <main>
    @yield('content')
  </main>

  <x-footer />

  <x-scripts />

</body>

</html>
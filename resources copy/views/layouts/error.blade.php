<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-head />

<body>

  <main>
    @yield('content')
  </main>

  <x-scripts />

</body>

</html>
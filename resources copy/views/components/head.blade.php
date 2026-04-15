<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Axemobile - Car Detailing Service & Car Repair Laravel 12 Template')</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  {{-- GLightbox Preview --}}
  <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/glightbox.min.css') }}">
  {{-- Animation On Scroll (AOS) --}}
  <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
  {{-- Bootstrap Icons CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  {{-- Template Styles --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  {{-- Additional Styles --}}
  @stack('styles')
</head>
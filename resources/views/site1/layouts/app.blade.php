<!doctype html>
  <html lang="en">
  <head>
    <!-- favicon 👇 -->
    <link rel="icon" type="image/svg+xml" href="{{ !empty($settings_data['favicon']) ? asset($settings_data['favicon']) : asset('assets/img/favicon.svg') }}">

    <title>@yield('title-tag')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="title" content="@yield('meta-title-tag')">

    <script>document.getElementsByTagName("html")[0].className += " js";</script>
    @yield('in-head')
    <script>
      if('CSS' in window && CSS.supports('color', 'var(--color-var)')) {
        document.write('<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">');
      } else {
        document.write('<link rel="stylesheet" href="{{ asset('assets/css/style-fallback.css') }}">');
      }
    </script>

    <noscript>
      <link rel="stylesheet" href="{{ asset('assets/css/style-fallback.css') }}">
    </noscript>

  </head>
  <body>
    
    <a class="back-to-top js-back-to-top" href="#" data-offset="100" data-duration="300">
      <svg class="icon" viewBox="0 0 16 16"><title>Go to top of page</title><g stroke-width="1" stroke="currentColor"><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="15.5,11.5 8,4 0.5,11.5 "></polyline></g></svg>
      </a>

    @include('site1.partials.external-fonts-v1')

    @include('site1.partials.header')

    @include('forms.signin-modal')

    @yield('content')

    @include('site1.partials.footer')

    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    @include('custom-scripts.signin-js')

    @yield('before-end')
  </body>
  </html>


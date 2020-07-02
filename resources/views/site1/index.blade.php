@include('site1.header.external-fonts')
@extends('site1.layouts.app')
@section('content')
@include('site1.body.draggable-gallery')
@include('site1.body.article-gallery')
@include('site1.footer.footer')
@endsection
<!doctype html>
<html lang="en">
<head>
  <title>Site 1</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>document.getElementsByTagName("html")[0].className += " js";</script>
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

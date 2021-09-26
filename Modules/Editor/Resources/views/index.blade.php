@extends('admin::layouts.master')
@section('content')
<div class="container max-width-lg">
  <div class="grid gap-md">
  @include('editor::partials.sidebar')
    <main class="position-relative z-index-1 col-12@md">
        <div id="site-table-with-pagination-container">
        @include('editor::partials.table')
        </div>
    </main>
  </div><!-- /.grid -->
</div><!-- /.container -->
@endsection

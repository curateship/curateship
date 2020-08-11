@extends('admin::layouts.master')
@include('admin::partials.custom-script')
@section('content')
  @include('users::partials.users-nav')
  @include('users::partials.modals')
  <section>
    <div class="container max-width-lg">
      <div class="grid gap-md@md">
        @include('users::partials.sidebar')
        <main class="position-relative padding-top-md z-index-1 col-12@md">
          <div id="site-table-with-pagination-container">
            @include('users::partials.control')
            @include('users::partials.table')
            @include('admin::partials.custom-script')
          </div><!-- /#site-table-with-pagination-container -->
        </main>
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection

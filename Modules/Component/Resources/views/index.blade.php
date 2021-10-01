@extends('admin::layouts.master')
@section('content')
@include('component::partials.edit-modal')
@include('component::partials.create-modal')
@include('component::partials.preview-modal')
<section>
    <div class="container max-width-lg">
      <div class="grid gap-sm">
        @include('component::partials.sidebar')
        <main class="position-relative z-index-1 col-12@md link-card radius-md">
          @include('component::partials.control')
        </div><!-- End Control -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
            <div id="site-table-with-pagination-container">
              @include('component::partials.table')
            </div><!-- /#site-table-with-pagination-container -->
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection
@extends('admin::layouts.master')
@section('content')
@include('comment::partials.modals')
@include('comment::partials.alert-modal')
  <div class="container max-width-lg">
    <div class="grid">
      @include('admin::partials.sidebar')
      <main class="position-relative z-index-1 col-12@md link-card radius-md">
          @include('comment::partials.control')
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
          <div class="padding-sm">
            <div id="site-table-with-pagination-container">
          @include('comment::partials.table')
          </div><!-- /#site-table-with-pagination-container -->
          </div><!-- Padding -->
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection

@push('module-scripts')
<!-- MODULE'S CUSTOM SCRIPT -->
  @include('comment::partials.script-js')
@endpush
@extends('admin::layouts.master')
@section('content')
@include('ad::popups.template-partials.edit-modal')
@include('ad::popups.template-partials.add-modal')
@include('ad::popups.template-partials.preview-modal')
<section>
    <div class="container max-width-lg">
      <div class="grid gap-sm">
        <main class="position-relative z-index-1 col-15@md link-card radius-md">
          @include('ad::popups.template-partials.control')
        </div><!-- End Control -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
            <div id="site-table-with-pagination-container">
            @include('ad::popups.template-partials.table')
            </div><!-- /#site-table-with-pagination-container -->
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection
@extends('admin::layouts.master')
@section('content')
@include('editor::partials.edit-modal')
@include('editor::partials.create-modal')
<section>
    <div class="container max-width-lg">
      <div class="grid gap-sm">
        @include('editor::partials.sidebar')
        <main class="position-relative z-index-1 col-12@md link-card radius-md">
          @include('editor::partials.control')
        </div><!-- End Control -->
          <div class="margin-top-auto border-top border-contrast-lower"></div><!-- Divider -->
              @include('editor::partials.table')
        </main><!-- .column -->
      </div><!-- /.grid -->
    </div><!-- /.container -->
  </section>
@endsection

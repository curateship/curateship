@extends('admin::layouts.master')
@section('content')
<!-- 👇 Content Body Wrapper-->
<section class="margin-y-md">
  <div class="container max-width-adaptive-lg">
    <div class="grid gap-md">
    @include('admin::partials.table')
    @include('admin::partials.sidebar')
    
    </div>
  </div>
</section
@endsection

@push('module-scripts')
<!-- MODULE'S CUSTOM SCRIPT -->
  @include('postbox.scripts.script-js')
@endpush

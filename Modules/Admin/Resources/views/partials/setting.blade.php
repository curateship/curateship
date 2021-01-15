@extends('admin::layouts.master')
@section('content')
  <section>
    <div class="container max-width-lg margin-top-lg">
        <div class="alert js-alert margin-bottom-lg" role="alert">
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 32 32" ><title>info icon</title><g><path d="M16,0C7.178,0,0,7.178,0,16s7.178,16,16,16s16-7.178,16-16S24.822,0,16,0z M18,7c1.105,0,2,0.895,2,2 s-0.895,2-2,2s-2-0.895-2-2S16.895,7,18,7z M19.763,24.046C17.944,24.762,17.413,25,16.245,25c-0.954,0-1.696-0.233-2.225-0.698 c-1.045-0.92-0.869-2.248-0.542-3.608l0.984-3.483c0.19-0.717,0.575-2.182,0.036-2.696c-0.539-0.514-1.794-0.189-2.524,0.083 l0.263-1.073c1.054-0.429,2.386-0.954,3.523-0.954c1.71,0,2.961,0.855,2.961,2.469c0,0.151-0.018,0.417-0.053,0.799 c-0.066,0.701-0.086,0.655-1.178,4.521c-0.122,0.425-0.311,1.328-0.311,1.765c0,1.683,1.957,1.267,2.847,0.847L19.763,24.046z"></path></g></svg>
              <div class="msg-container">
              </div>
            </div>

            <button class="reset alert__close-btn js-alert__close-btn">
              <svg class="icon" viewBox="0 0 24 24"><title>Close alert</title><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" stroke="currentColor" fill="none" stroke-miterlimit="10"><line x1="19" y1="5" x2="5" y2="19"></line><line fill="none" x1="19" y1="19" x2="5" y2="5"></line></g></svg>
            </button>
          </div>
        </div>

        <h1>Site Settings</h1>
        <form id="formSetting" method="POST">
            @csrf
            <fieldset class="margin-bottom-md margin-top-md">
                
              <div class="floating-label margin-bottom-md">
                <label class="form-label" for="logo_title">Enter Logo Title</label>
                <input class="form-control width-100%" type="text" name="logo_title" id="logo_title" value="{{ !empty($settings_data['logo_title']) ? $settings_data['logo_title'] : '' }}" placeholder="Enter Logo Title" required>
              </div>

              <div class="floating-label margin-bottom-md">
                <label class="form-label" for="logo_svg">Paste your Logo SVG</label>
                <textarea class="form-control width-100%" name="logo_svg" id="logo_svg" placeholder="Paste your Logo SVG" required>{{ !empty($settings_data['logo_svg']) ? $settings_data['logo_svg'] : '' }}</textarea>
              </div>

              <div class="floating-label margin-bottom-md">
                <label class="form-label" for="favicon">Paste your favicon SVG</label>
                <input class="form-control width-100%" name="favicon" id="favicon" value="{{ !empty($settings_data['favicon']) ? $settings_data['favicon'] : '' }}" placeholder="Paste your favicon path" required>
              </div>

              <h1>SEO Settings</h1>

              <div class="floating-label margin-bottom-md margin-top-md">
                <label class="form-label" for="page_title">Index Page Title</label>
                <input class="form-control width-100%" type="text" name="page_title" id="page_title" value="{{ !empty($settings_data['page_title']) ? $settings_data['page_title'] : '' }}" placeholder="Index Page Title" required>
              </div>

              <div class="floating-label margin-bottom-md margin-top-xs">
                <label class="form-label" for="meta_title">Tag Page Title</label>
                <input class="form-control width-100%" type="text" name="meta_title" id="meta_title" value="{{ !empty($settings_data['meta_title']) ? $settings_data['meta_title'] : '' }}" placeholder="Tag Page Title" required>
              </div>

              <button id="btnSave" class="btn btn--primary">Save</button>

            </fieldset>
          </form>
  </section>
@endsection

@push('module-scripts')
<!-- MODULE'S CUSTOM SCRIPT -->
  @include('admin::partials.settings-script-js')
@endpush

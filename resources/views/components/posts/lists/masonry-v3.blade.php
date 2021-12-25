<div class="container max-width-lg margin-top-md position-relative">
    <div class="preload-box" aria-hidden="true">
        <ul class="grid preload-grid gap-sm">
            @for($i = 1 ; $i <= 12 ; $i++)
                <li class="preload-item">
                    <div class="ske ske--rect-16:9 margin-bottom-sm"></div>
                </li>
            @endfor
        </ul>
    </div>

  <input type="hidden" class="masonry-path" value="{{$ajaxRoute}}">

  <div class="masonry-grid">
  </div>

    <div class="loader-ellips">
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
        <span class="loader-ellips__dot"></span>
    </div>
</div>
@push('module-scripts')
<!-- MODULE'S CUSTOM SCRIPT -->
  @include('custom-scripts.masonry-scroll')
@endpush

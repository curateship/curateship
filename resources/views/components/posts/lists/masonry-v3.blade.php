<div class="container max-width-lg margin-top-md">
    <div class="preload-box" aria-hidden="true">
        <ul class="grid preload-grid gap-sm">
            @for($i = 0 ; $i <= 8 ; $i++)
                <li class="col-6 col-4@md">
                    <div class="ske ske--rect-16:9 margin-bottom-sm"></div>
                </li>
            @endfor
        </ul>
    </div>

  <!--<ul class="masonry__list js-masonry__list js-infinite-scroll__content">-->
  <div class="masonry-grid opacity-0">
  @foreach($posts as $post)
    <div class="grid-item">
    @if($post->thumbnail)
      <a class="thumb" href="{{ route('single-post-view', ['slug'   => $post->slug]) }}">
        <figure class="card-v2">
          <img class="block width-500% radius-md radius-bottom-right-0 radius-bottom-left-0" src="{{ $post->showThumbnail('medium') }}" alt="Image of {{ $post->title }}">
          <figcaption class="card-v2__caption padding-x-sm padding-top-md padding-bottom-sm text-left">

          </figcaption>
        </figure>
      </a>
    @else
      <span class="card__img card__img-cropped bg-opacity-50%"></span>
      <div class="post-cell text-component line-height-xs v-space-xxs text-sm line-height-md">

      </div>
    @endif
      <div class="user-cell">
          <h3 class="text-xs padding-xs@md text-md@md"><a class="color-contrast-low" href="{{ route('single-post-view', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
      </div>
    </div>
  @endforeach
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

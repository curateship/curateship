<div class="js-infinite-scroll container max-width-lg" data-path="{{ url('/api/post/' . $post->id . '/{n}') }}" data-container=".js-infinite-scroll__content" data-current-page="1" data-load-btn="off">
  @include('components.posts.single.post-seed')

  <div class="text-center margin-y-md is-hidden js-infinite-scroll__loader" aria-hidden="true">
    <svg class="icon icon--md icon--is-spinning" viewBox="0 0 32 32"><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none"><circle cx="16" cy="16" r="15" opacity="0.4"></circle><path d="M16,1A15,15,0,0,1,31,16" stroke-linecap="butt"></path></g></svg>
  </div>

  <div class="margin-top-md flex justify-center">
    <button class="btn btn--primary js-infinite-scroll__btn">Load More</button>
  </div>

</div>

@push('module-styles')
  <!-- MODULE'S CUSTOM Style -->
  <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
@endpush

@push('module-scripts')
  <!-- MODULE'S CUSTOM SCRIPT -->
  @include('custom-scripts.infinite-post-scroll')
@endpush

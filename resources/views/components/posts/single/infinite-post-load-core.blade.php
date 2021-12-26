@if($post !== null)
    @if (session('responseMessage'))
        <div class="alert alert--is-visible js-alert margin-bottom-lg" role="alert">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 32 32">
                        <title>info icon</title>
                        <g>
                            <path d="M16,0C7.178,0,0,7.178,0,16s7.178,16,16,16s16-7.178,16-16S24.822,0,16,0z M18,7c1.105,0,2,0.895,2,2 s-0.895,2-2,2s-2-0.895-2-2S16.895,7,18,7z M19.763,24.046C17.944,24.762,17.413,25,16.245,25c-0.954,0-1.696-0.233-2.225-0.698 c-1.045-0.92-0.869-2.248-0.542-3.608l0.984-3.483c0.19-0.717,0.575-2.182,0.036-2.696c-0.539-0.514-1.794-0.189-2.524,0.083 l0.263-1.073c1.054-0.429,2.386-0.954,3.523-0.954c1.71,0,2.961,0.855,2.961,2.469c0,0.151-0.018,0.417-0.053,0.799 c-0.066,0.701-0.086,0.655-1.178,4.521c-0.122,0.425-0.311,1.328-0.311,1.765c0,1.683,1.957,1.267,2.847,0.847L19.763,24.046z"></path>
                        </g>
                    </svg>
                    <p>
                        {!! session()->get('responseMessage')!!}
                    </p>
                </div>

                <button class="reset alert__close-btn js-alert__close-btn">
                    <svg class="icon" viewBox="0 0 24 24">
                        <title>Close alert</title>
                        <g stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" stroke="currentColor" fill="none" stroke-miterlimit="10">
                            <line x1="19" y1="5" x2="5" y2="19"></line>
                            <line fill="none" x1="19" y1="19" x2="5" y2="5"></line>
                        </g>
                    </svg>
                </button>
            </div>
        </div>
    @endif

<div class="js-infinite-scroll container max-width-lg" data-path="{{ url('/api/post/' . $post->id . '/{n}') }}" data-container=".js-infinite-scroll__content" data-current-page="1" data-load-btn="off">

    <div class="js-infinite-scroll__content" data-path="{{ url('/api/post/' . $post->id . '/page={n}') }}" data-current-page="{{ $nextpage }}">
    <article class="container single-post max-width-sm padding-y-md" data-title="{!! $post->seo_title !!}" data-url="{{ url($post->url) }}">


        <div class="text-component text-left line-height-lg v-space-md margin-bottom-md text-sm">
            <h1>{{ $post->title }}</h1>
            <p class="color-contrast-medium text-md">{!! $post->description !!}</p>
            <figure class="">
                @if($post->video)
                    <div class="video-wrap margin-bottom-md">
                        <video id="video-player-{{$post->id}}" class="video-js video-small vjs-big-play-centered video-player" width="320" height="150" data-setup='{"controls": true, "autoplay": false, "preload": "auto", "fluid": true}' poster="{{ $post->showThumbnail('medium') }}">
                            <source src="{{ $post->video }}" type="{{ $post->video_type }}" />
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                >supports HTML5 video</a
                                >
                            </p>
                        </video>
                    </div>
                @else
                <!--<img src="{{ $post->showThumbnail() }}" alt="Image of {{ $post->title }}">-->
                    <figure class="image-zoom js-image-zoom ">
                        <img class="image-zoom__preview js-image-zoom__preview" src="{{ $post->showThumbnail() }}" alt="Image of {{ $post->title }}">
                    </figure>
                @endif

                <div class="author__content">
                    <h4 class="story-v2__meta text-sm">
                        by:
                        <a href="{{ route('pages.profile.user', $post->user->username) }}" rel="author">
                            {{ $post->user->name }}
                        </a>
                    </h4>
                </div>

                <span>
            @foreach($tag_pills as $tag_pills_key => $tag_pill_name)
                        <a
                            href="{{ route('pages.tags', $tag_pill_name) }}"
                            class="btn color-contrast-medium post-thumbnail-tags-pill margin-right-xxxs margin-bottom-xxxs"
                            draggable="false" ondragstart="return false;"
                        >
                {{ $tag_pill_name }}
              </a>
                        @if($tag_pills_key < count($tag_pills) - 1)
                        @endif
                    @endforeach
          </span>

            <!-- Start of comments -->
            <section class="comments margin-top-xl">
                <div class="margin-bottom-lg">
                  <div class="flex gap-sm flex-column flex-row@md justify-between items-center@md">
                    <div>
                      <h1 class="text-md">Comments</h1>
                    </div>
                  </div>
                </div>

                <ul class="list post-comments" data-post-id="{{$post->id}}">
                  @include('components.comments.post-comments', ['post_id' => $post->id, 'comments' => $post->comments, 'disable_comments' => $disable_comments])
                </ul>

                    @auth
                        @if($disable_comments != 'on')
                            @include('components.comments.form', ['title' => 'Add a new comment', 'item_id' => $post->id, 'type' => 'new'])
                        @endif
                    @endauth
                    @guest
                        <div>Please <a href="{{ url('/site2/login') }}">Login</a> to post comments</div>
                    @endguest
            </section>
          <!-- End of each Comments -->

            </figure>
        </div>
    </article>
    </div>

  <div class="text-center margin-y-md is-hidden js-infinite-scroll__loader" aria-hidden="true">
    <svg class="icon icon--md icon--is-spinning" viewBox="0 0 32 32"><g stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" stroke="currentColor" fill="none"><circle cx="16" cy="16" r="15" opacity="0.4"></circle><path d="M16,1A15,15,0,0,1,31,16" stroke-linecap="butt"></path></g></svg>
  </div>

  <div class="margin-top-md flex justify-center">
    <button class="btn btn--primary js-infinite-scroll__btn">Load More</button>
  </div>

</div>
@endif

@push('module-styles')
  <!-- MODULE'S CUSTOM Style -->
  <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
@endpush

@push('module-scripts')
  <!-- MODULE'S CUSTOM SCRIPT -->
  @include('custom-scripts.infinite-post-scroll')
@endpush

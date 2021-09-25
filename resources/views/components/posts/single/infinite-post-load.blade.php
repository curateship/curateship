<div class="js-infinite-scroll container max-width-lg" data-path="{{ url('/api/post/' . $post->id . '/{n}') }}" data-container=".js-infinite-scroll__content" data-current-page="1" data-load-btn="off">
  <!-- Start of infinite scroll post container -->
  <div class="js-infinite-scroll__content">
    <!-- Start of each post content -->
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
          <img src="{{ $post->showThumbnail() }}" alt="Image of {{ $post->title }}">
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
    
      <form aria-label="Choose sorting option">
        <div class="flex flex-wrap gap-sm text-sm">
          <div class="position-relative">
            <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsPopular" checked>
            <label for="sortCommentsPopular">Popular</label>
          </div>
      
          <div class="position-relative">
            <input class="comments__sorting-label" type="radio" name="sortComments" id="sortCommentsNewest">
            <label for="sortCommentsNewest">Newest</label>
          </div>
        </div>
      </form>
    </div>
  </div>

  <ul class="list">
    <li class="comments__comment">
      <div class="flex items-start margin-bottom-lg">
        <a href="#0" class="comments__author-img">
          <img src="https://codyhouse.co/app/assets/img/comments-placeholder.svg" alt="Author picture">
        </a>
  
        <div class="comments__content margin-top-xxxs">
          <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
            <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>

            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit sit sed cupiditate vel, sapiente aspernatur, reiciendis repellat ad delectus quia ea ipsam minima in dignissimos commodi velit nemo voluptatibus quisquam.</p>
          </div>
  
          <div class="margin-top-xs text-sm">
            <div class="flex gap-xxs items-center">
              <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                <span class="comments__vote-icon-wrapper">
                  <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                </span>

                <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
              </button>
    
              <span class="comments__inline-divider" aria-hidden="true"></span>
              <button class="reset comments__label-btn js-tab-focus">Reply</button>

              <span class="comments__inline-divider" aria-hidden="true"></span>
              <div class="reset comments__label-btn js-tab-focus" aria-controls="popover-example">Report</div>
              
              <div id="popover-example" class="popover bg-light padding-sm radius-md inner-glow shadow-md js-popover js-tab-focus" role="dialog">
                <div class="text-component text-md">

<fieldset class="margin-bottom-md">

<p class="text-xs">Help us keep the community clean</p>
  <ul class="flex flex-column list">

    <li>
      <input class="radio" type="radio" name="radio-button" id="radio-1" checked>
      <label for="radio-1">Spam</label>
    </li>

    <li>
      <input class="radio" type="radio" name="radio-button" id="radio-2">
      <label for="radio-2">Inappropriate</label>
    </li>

    </ul>
</fieldset>
<button class="margin-left-sm btn btn--primary">Report</button>
                    
                </div>
              </div>
    
              <span class="comments__inline-divider" aria-hidden="true"></span>
  
              <time class="comments__time" aria-label="1 hour ago">1h</time>
            </div>
          </div>
        </div>
      </div>
    </li>

    <li class="comments__comment">
      <div class="flex items-start">
        <a href="#0" class="comments__author-img">
          <img src="https://codyhouse.co/app/assets/img/comments-placeholder.svg" alt="Author picture">
        </a>
  
        <div class="comments__content margin-top-xxxs">
          <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
            <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
          </div>
  
          <div class="margin-top-xs text-sm">
            <div class="flex gap-xxs items-center">
              <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                <span class="comments__vote-icon-wrapper">
                  <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                </span>

                <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
              </button>
    
              <span class="comments__inline-divider" aria-hidden="true"></span>
    
              <button class="reset comments__label-btn js-tab-focus">Reply</button>
    
              <span class="comments__inline-divider" aria-hidden="true"></span>
  
              <time class="comments__time" aria-label="1 hour ago">1h</time>

            </div>
          </div>
        </div>
      </div>

      <details class="comments__details details js-details">
        <summary class="details__summary color-primary js-details__summary text-sm" role="button">
          <span class="flex items-center">
            <svg class="icon icon--xxs margin-right-xxs" aria-hidden="true" viewBox="0 0 12 12"><path d="M2.783.088A.5.5,0,0,0,2,.5v11a.5.5,0,0,0,.268.442A.49.49,0,0,0,2.5,12a.5.5,0,0,0,.283-.088l8-5.5a.5.5,0,0,0,0-.824Z"></path></svg>
            <span>View 2 replies</span>
          </span>
        </summary>
      
        <div class="details__content js-details__content">
          <ul>
            <li class="comments__comment">
              <div class="flex items-start">
                <a href="#0" class="comments__author-img">
                  <img src="https://codyhouse.co/app/assets/img/comments-placeholder.svg" alt="Author picture">
                </a>
          
                <div class="comments__content margin-top-xxxs">
                  <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                    <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
                  </div>
          
                  <div class="margin-top-xs text-sm">
                    <div class="flex gap-xxs items-center">
                      <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                        <span class="comments__vote-icon-wrapper">
                          <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                        </span>
                        
                        <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                      </button>
            
                      <span class="comments__inline-divider" aria-hidden="true"></span>
            
                      <button class="reset comments__label-btn js-tab-focus">Reply</button>
            
                      <span class="comments__inline-divider" aria-hidden="true"></span>
          
                      <time class="comments__time" aria-label="1 hour ago">1h</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>
    
            <li class="comments__comment">
              <div class="flex items-start">
                <a href="#0" class="comments__author-img">
                  <img src="https://codyhouse.co/app/assets/img/comments-placeholder.svg" alt="Author picture">
                </a>
          
                <div class="comments__content margin-top-xxxs">
                  <div class="text-component text-sm text-space-y-xs line-height-sm read-more js-read-more" data-characters="150" data-btn-class="comments__readmore-btn js-tab-focus">
                    <p><a href="#0" class="comments__author-name" rel="author">Olivia Gribben</a></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, accusantium consequatur. Perspiciatis!</p>
                  </div>
          
                  <div class="margin-top-xs text-sm">
                    <div class="flex gap-xxs items-center">
                      <button class="reset comments__vote-btn js-comments__vote-btn js-tab-focus" data-label="Like this comment along with 5 other people" aria-pressed="false">
                        <span class="comments__vote-icon-wrapper">
                          <svg class="icon block" viewBox="0 0 12 12" aria-hidden="true"><path d="M11.045,2.011a3.345,3.345,0,0,0-4.792,0c-.075.075-.15.225-.225.3-.075-.074-.15-.224-.225-.3a3.345,3.345,0,0,0-4.792,0,3.345,3.345,0,0,0,0,4.792l5.017,4.718L11.045,6.8A3.484,3.484,0,0,0,11.045,2.011Z"></path></svg>
                        </span>

                        <span class="margin-left-xxxs js-comments__vote-label" aria-hidden="true">5</span>
                      </button>
            
                      <span class="comments__inline-divider" aria-hidden="true"></span>
            
                      <button class="reset comments__label-btn js-tab-focus">Reply</button>
            
                      <span class="comments__inline-divider" aria-hidden="true"></span>
          
                      <time class="comments__time" aria-label="1 hour ago">1h</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </details>
    </li>

  </ul>

  <form>
    <fieldset>
      <legend class="form-legend">Add a new comment</legend>

      <div class="margin-bottom-xs">
        <label class="sr-only" for="commentNewContent">Your comment</label>
        <textarea class="form-control width-100%" name="commentNewContent" id="commentNewContent"></textarea>
      </div>

      <div>
        <button class="btn btn--primary">Post comment</button>
      </div>
    </fieldset>
  </form>
</section>
<!-- End of each Comments -->

        </figure>
      </div>
    </article> <!-- End of each post content -->  
  </div> <!-- End of infinite scroll post container -->

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

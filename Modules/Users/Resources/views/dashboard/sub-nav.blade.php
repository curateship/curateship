<div class="bg-contrast-lowest">
  <div class="container max-width-lg flex items-center justify-between">
    <div class="flex flex-wrap fl-align-center">
      <button class="btn btn--primary btn-new-post margin-right-md js-menu-bar" aria-controls="modal-add-article">Add</button>

        <div class="menu-bar__item" aria-controls="modal-search">
            <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
                <path d="M11.25 17.5c4.83 0 8.75-3.93 8.75-8.75s-3.93-8.75-8.75-8.75-8.75 3.93-8.75 8.75 3.93 8.75 8.75 8.75z m0-15c3.45 0 6.25 2.8 6.25 6.25s-2.8 6.25-6.25 6.25-6.25-2.8-6.25-6.25 2.8-6.25 6.25-6.25z"></path><path d="M0.36 17.86l3-2.99a10.02 10.02 0 0 0 1.76 1.77l-2.98 3a1.25 1.25 0 0 1-1.78 0 1.25 1.25 0 0 1 0-1.78z"></path>
            </svg>
            <span class="menu-bar__label">Search Users</span>
        </div>

      <div class="flex int-table-actions" data-table-controls="table-1">
        @if(! request()->has('status') || (request()->has('status') && request('status') != 'deleted'))
          <menu class="menu-bar is-hidden js-int-table-actions__items-selected js-menu-bar" id="btnDeleteMultiple">
              <li class="menu-bar__item menu-bar__item--trigger js-menu-bar__trigger" role="menuitem" aria-label="More options">
                  <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 16 16">
                      <circle cx="8" cy="7.5" r="1.5" />
                      <circle cx="1.5" cy="7.5" r="1.5" />
                      <circle cx="14.5" cy="7.5" r="1.5" /></svg>
              </li>
              <li class="menu-bar__item" role="menuitem">
                  <svg class="icon menu-bar__icon" viewBox="0 0 20 20">
                      <path d="M2.49 6.64v10.79a2.49 2.49 0 0 0 2.49 2.49h9.96a2.49 2.49 0 0 0 2.49-2.49v-10.79z m4.98 9.13h-1.66v-5.81h1.66z m3.32 0h-1.66v-5.81h1.66z m3.32 0h-1.66v-5.81h1.66z"></path><path d="M19.09 3.32h-4.98v-2.49a0.83 0.83 0 0 0-0.83-0.83h-6.64a0.83 0.83 0 0 0-0.83 0.83v2.49h-4.98a0.83 0.83 0 0 0 0 1.66h18.26a0.83 0.83 0 0 0 0-1.66z m-11.62-1.66h4.98v1.66h-4.98z"></path></svg>
                  <span class="menu-bar__label">Delete</span>
                  <span class="counter counter--critical counter--docked"><span id="deleteBadge">1</span> <i class="sr-only">Notifications</i></span>
              </li>
          </menu>
        @endif
      </div>
    </div>
    <div class="subnav subnav--expanded@sm js-subnav">
      <button class="reset btn btn--subtle margin-y-sm subnav__control js-subnav__control">
        <span>Panel</span>
        <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12">
          <polyline points="0.5 3.5 6 9.5 11.5 3.5" fill="none" stroke-width="1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline>
        </svg>
      </button>

      <div class="subnav__wrapper js-subnav__wrapper">
        <nav class="">
          <button class="reset subnav__close-btn js-subnav__close-btn js-tab-focus" aria-label="Close navigation">
            <svg class="icon" viewBox="0 0 16 16">
              <g stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
                <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
              </g>
            </svg>
          </button>

          <ul class="subnav__list">
            <li class="subnav__item"><a href="{{ url('/dashboard') }}" data-tab="published" class="subnav__link ajax-link" {{ (url('/dashboard') == url()->full()) ? 'aria-current=page' : '' }}>Published<span class="sidenav__counter user-nav__counter">{{ $posts_published_count }} <i class="sr-only">notifications</i></span></a></li>
            <li class="subnav__item"><a href="{{ url('/dashboard?status=draft') }}" data-tab="draft" class="subnav__link ajax-link">Draft<span class="sidenav__counter user-nav__counter">{{ $posts_draft_count }} <i class="sr-only">notifications</i></span></a></li>
            @if (!auth()->user()->isEditor())
            <li class="subnav__item"><a href="{{ url('/dashboard?status=pending') }}" data-tab="pending" class="subnav__link ajax-link">Pending<span class="sidenav__counter user-nav__counter">{{ $posts_pending_count }} <i class="sr-only">notifications</i></span></a></li>
            @endif
            <li class="subnav__item"><a href="{{ url('/dashboard?status=deleted') }}" data-tab="trashed" class="subnav__link ajax-link">Trash<span class="sidenav__counter user-nav__counter">{{ $posts_deleted_count }} <i class="sr-only">notifications</i></span></a></li>
          </ul>
        </nav>
      </div>
    </div> <!-- end of .subnav -->
  </div> <!-- end of .container -->
</div> <!-- end of .bg-contrast-lower -->

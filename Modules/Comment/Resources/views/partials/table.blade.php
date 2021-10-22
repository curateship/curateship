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

@if($status == 'deleted')
  <div class="margin-bottom-md">
    <form action="{{ url('admin/comment/trash/empty') }}" method="post">
      @csrf
      <span class="btn btn--subtle" id="emptyTrash">Empty trash</span>
    </form>
  </div>
@endif

<div id="table-1" class="int-table text-sm js-int-table">
  <div class="int-table__inner">
    
    <template id="selected-id-template">
      <input type="hidden" name="selectedIDs[]" value="@{{value}}">
    </template><!-- /#selected-id-template -->
    <form action="{{ url('admin/comment/bulk-suspend') }}" method="POST" id="form-bulk-suspend"> @csrf
      <div class="bulk-selected-ids"></div>
    </form>
    <form action="{{ url('admin/comment/bulk-delete') }}" method="POST" id="form-bulk-delete"> @csrf
      <div class="bulk-selected-ids"></div>
    </form>
    
    <table class="int-table__table" aria-label="Interactive table example">
      <thead class="int-table__header js-int-table__header">
        <tr class="int-table__row">
          <td class="int-table__cell" style="width: 5%">
            <div class="custom-checkbox int-table__checkbox">
              <input class="custom-checkbox__input js-int-table__select-all" type="checkbox" aria-label="Select all rows" />
              <div class="custom-checkbox__control" aria-hidden="true"></div>
            </div>
          </td>

          <th class="int-table__cell int-table__cell--th text-left" style="width: 70%">
            Comment
          </th>

          <th class="int-table__cell int-table__cell--th text-left" style="width: 10%">
            Status
          </th>

          <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort" data-date-format="dd-mm-yyyy" style="width: 10%">
            <div class="flex items-center">
              <span>Date</span>

              <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
            </div>

            <ul class="sr-only js-int-table__sort-list">
              <li>
                <input type="radio" name="sortingDate" id="sortingDateNone" value="none" checked>
                <label for="sortingDateNone">No sorting</label>
              </li>

              <li>
                <input type="radio" name="sortingDate" id="sortingDateAsc" value="asc">
                <label for="sortingDateAsc">Sort in ascending order</label>
              </li>

              <li>
                <input type="radio" name="sortingDate" id="sortingDateDes" value="desc">
                <label for="sortingDateDes">Sort in descending order</label>
              </li>
            </ul>
          </th>

          <th class="int-table__cell int-table__cell--th text-right" style="width: 5%">Action</th>
        </tr>
      </thead>

      <tbody class="int-table__body js-int-table__body">
      @foreach($comments as $key => $comment)
        <tr class="int-table__row">
          <th class="int-table__cell" scope="row" style="width: 5%">
            <div class="custom-checkbox int-table__checkbox">
              <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" value="{{$comment->id}}"/>
              <div class="custom-checkbox__control" aria-hidden="true"></div>
            </div>
          </th>
          <td class="int-table__cell text-truncate" style="width: 70%">
            <a href="{{url('admin/comment/edit/'.$comment->id)}}" data-update-url="{{url('admin/comment/update/'.$comment->id)}}" aria-controls="modal-edit-post" role="button" class="menu__content js-menu__content modal-trigger-edit-post" style="width:500px;">
              {{$comment->comment}}
            </a>
            <p class="text-component text-xs color-contrast-medium">By: {{$comment->username}}</p>
          </td>
          <td class="int-table__cell text-component text-sm" style="width: 10%">{{$comment->status}}</td>
          <td class="int-table__cell text-component text-sm" style="width: 10%">{{$comment->created_at->format('m/d/Y')}}</td>
          <td class="int-table__cell" style="width: 5%">
            <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example-row-{{$comment->id}}">
              <svg class="icon" viewBox="0 0 16 16">
                <circle cx="8" cy="7.5" r="1.5" />
                <circle cx="1.5" cy="7.5" r="1.5" />
                <circle cx="14.5" cy="7.5" r="1.5" /></svg>
            </button>
            <menu id="menu-example-row-{{$comment->id}}" class="menu js-menu">
              <li role="menuitem">
                <a href="{{url('admin/comment/edit/'.$comment->id)}}" data-update-url="{{url('admin/comment/update/'.$comment->id)}}" aria-controls="modal-edit-post" role="button" class="menu__content js-menu__content modal-trigger-edit-post">
                  <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                    <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
                  </svg>
                  <span>Edit</span>
                </a>
              </li>

              <li role="menuitem">
                <a href="{{ url('admin/comment/draft/'.$comment->id) }}">
                  <span class="menu__content js-menu__content">
                    <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                    <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M0.38 1.88h11.24"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M0.38 4.88h11.24"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M0.38 7.88h4.5"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M0.38 10.88h4.5"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M7.88 7.13l3.75 3.75"></path><path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M11.63 7.13l-3.76 3.75"></path>
                    </svg>
                    <span>Suspend</span>
                  </span>
                </a>
              </li>

              <li role="menuitem">
                <a href="{{ url('admin/comment/delete/'.$comment->id) }}">
                  <span class="menu__content js-menu__content">
                    <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
                      <path d="M8.354,3.646a.5.5,0,0,0-.708,0L6,5.293,4.354,3.646a.5.5,0,0,0-.708.708L5.293,6,3.646,7.646a.5.5,0,0,0,.708.708L6,6.707,7.646,8.354a.5.5,0,1,0,.708-.708L6.707,6,8.354,4.354A.5.5,0,0,0,8.354,3.646Z"></path>
                      <path d="M6,0a6,6,0,1,0,6,6A6.006,6.006,0,0,0,6,0ZM6,10a4,4,0,1,1,4-4A4,4,0,0,1,6,10Z"></path>
                    </svg>
                    <span>Delete</span>
                  </span>
                </a>
              </li>
            </menu>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

<div class="flex items-center justify-between padding-top-sm">
  <p class="text-sm">
    {{ $comments->count() }}
    {{ ($comments->count() < 2) ? 'result' : 'results' }}
  </p>

  @if($comments->count() > 0)
  <nav class="pagination text-sm" aria-label="Pagination" id="table-pagination-bottom">
    <ul class="pagination__list flex flex-wrap gap-xxxs">
      <li>
        <a href="{{ $comments->withQueryString()->previousPageUrl() }}" class="pagination__item
              {{ ($comments->currentPage() == 1) ? 'pagination__item--disabled' : '' }}
            ">
          <svg class="icon" viewBox="0 0 16 16">
            <title>Go to previous page</title>
            <g stroke-width="1.5" stroke="currentColor">
              <polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="9.5,3.5 5,8 9.5,12.5 "></polyline>
            </g>
          </svg>
        </a>
      </li>

      <li>
        <span class="pagination__jumper flex items-center">
          <form action="{{ url()->full() }}" class="inline" method="get">
            @if($request->has('status'))
            <input type="hidden" name="status" value="{{ $status }}">
            @endif

            <input aria-label="Page number" class="form-control" type="number" name="page" min="1" max="{{ $comments->lastPage() }}" value="{{ $comments->currentPage() }}">
          </form>
          <em>of {{ $comments->lastPage() }}</em>
        </span>
      </li>

      <li>
        <a href="{{ $comments->withQueryString()->nextPageUrl() }}" class="pagination__item
              {{ !$comments->hasMorePages() ? 'pagination__item--disabled' : '' }}
            ">
          <svg class="icon" viewBox="0 0 16 16">
            <title>Go to next page</title>
            <g stroke-width="1.5" stroke="currentColor">
              <polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="6.5,3.5 11,8 6.5,12.5 "></polyline>
            </g>
          </svg>
        </a>
      </li>
    </ul>
  </nav>
  @endif
</div><!-- /.flex items-center justify-between padding-top-sm -->

<!-- Re-initialized utl and menu component if the request is ajax -->
@if(Request::ajax())
<script src="{{ asset('assets/js/util.js') }}"></script>
<script src="{{ asset('assets/js/components/_1_menu.js') }}"></script>
<script src="{{ asset('assets/js/components/_2_interactive-table.js') }}"></script>
<script src="{{ asset('assets/js/components/_1_modal-window.js') }}"></script>
<script>
  (function() {
    // event that watches interactive table checkboxes
    $(document).on('click', '.int-table__table .custom-checkbox__input', function() {
      var checkedCheckboxes = $('.custom-checkbox__input:checked').length;

      if (checkedCheckboxes > 0) {
        // show menu-bar
        $('.menu-bar.js-int-table-actions__items-selected').removeClass('is-hidden');
        $('.menu-bar.js-int-table-actions__no-items-selected').addClass('is-hidden');
        return;
      }

      // hide menu-bar
      $('.menu-bar.js-int-table-actions__items-selected').addClass('is-hidden');
      $('.menu-bar.js-int-table-actions__no-items-selected').removeClass('is-hidden');
    });
  })();
</script>
@endif


<div class="padding-sm">
<div id="table-1" class="int-table text-sm js-int-table">
  <div class="int-table__inner">
    <table class="int-table__table" aria-label="Interactive table example">
      <thead class="int-table__header js-int-table__header">
        <tr class="int-table__row">
          <td class="int-table__cell">
            <div class="custom-checkbox int-table__checkbox">
              <input class="custom-checkbox__input js-int-table__select-all" type="checkbox" aria-label="Select all rows" />
              <div class="custom-checkbox__control" aria-hidden="true"></div>
            </div>
          </td>

          <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
            <div class="flex items-center">
              <span>ID</span>

              <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
            </div>

            <ul class="sr-only js-int-table__sort-list">
              <li>
                <input type="radio" name="sortingId" id="sortingIdNone" value="none" checked>
                <label for="sortingIdNone">No sorting</label>
              </li>

              <li>
                <input type="radio" name="sortingId" id="sortingIdAsc" value="asc">
                <label for="sortingIdAsc">Sort in ascending order</label>
              </li>

              <li>
                <input type="radio" name="sortingId" id="sortingIdDes" value="desc">
                <label for="sortingIdDes">Sort in descending order</label>
              </li>
            </ul>
          </th>

          <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
            <div class="flex items-center">
              <span>Name</span>

              <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
            </div>

            <ul class="sr-only js-int-table__sort-list">
              <li>
                <input type="radio" name="sortingName" id="sortingNameNone" value="none" checked>
                <label for="sortingNameNone">No sorting</label>
              </li>

              <li>
                <input type="radio" name="sortingName" id="sortingNameAsc" value="asc">
                <label for="sortingNameAsc">Sort in ascending order</label>
              </li>

              <li>
                <input type="radio" name="sortingName" id="sortingNameDes" value="desc">
                <label for="sortingNameDes">Sort in descending order</label>
              </li>
            </ul>
          </th>

          <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort">
            <div class="flex items-center">
              <span>Category</span>

              <svg class="icon icon--xxs margin-left-xxxs int-table__sort-icon" aria-hidden="true" viewBox="0 0 12 12">
                <polygon class="arrow-up" points="6 0 10 5 2 5 6 0" />
                <polygon class="arrow-down" points="6 12 2 7 10 7 6 12" /></svg>
            </div>

            <ul class="sr-only js-int-table__sort-list">
              <li>
                <input type="radio" name="sortingEmail" id="sortingEmailNone" value="none" checked>
                <label for="sortingEmailNone">No sorting</label>
              </li>

              <li>
                <input type="radio" name="sortingEmail" id="sortingEmailAsc" value="asc">
                <label for="sortingEmailAsc">Sort in ascending order</label>
              </li>

              <li>
                <input type="radio" name="sortingEmail" id="sortingEmailDes" value="desc">
                <label for="sortingEmailDes">Sort in descending order</label>
              </li>
            </ul>
          </th>

          <th class="int-table__cell int-table__cell--th text-left">
            Preview
          </th>

          <th class="int-table__cell int-table__cell--th int-table__cell--sort js-int-table__cell--sort" data-date-format="dd-mm-yyyy">
            <div class="flex items-center">
              <span>Status</span>

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

          <th class="int-table__cell int-table__cell--th text-left">Cookies</th>
          <th class="int-table__cell int-table__cell--th text-right">Action</th>
        </tr>
      </thead>

      <tbody class="int-table__body js-int-table__body">

        <tr class="int-table__row">
          <th class="int-table__cell" scope="row">
            <div class="custom-checkbox int-table__checkbox">
              <input class="custom-checkbox__input js-int-table__select-row" type="checkbox" aria-label="Select this row" />
              <div class="custom-checkbox__control" aria-hidden="true"></div>
            </div>
          </th>
          <td class="int-table__cell">1</td>
          <td class="int-table__cell" aria-controls="edit-modal"><a href="#0">Component Name</a></td>
          <td class="int-table__cell">Listing</td>
          <td class="int-table__cell text-truncate max-width-xxxxs">
              
          <button class="btn btn--primary">Preview</button>

          </td>
          <td class="int-table__cell">Published</td>
          <td class="int-table__cell">
              
        <div class="radius-lg padding-xxs inline-flex items-center">
            <p id="content-to-copy">Copy Shortcode</p>
            <button class="reset copy-to-clip margin-left-sm js-copy-to-clip js-tooltip-trigger" type="button" title="Click to copy" data-success-title="Copied!" aria-controls="content-to-copy">
                <svg class="icon icon--xs" width="16" height="16" viewBox="0 0 16 16">
                    <title>Click to copy</title>
                    <path d="M12,2h.5A1.5,1.5,0,0,1,14,3.5v10A1.5,1.5,0,0,1,12.5,15h-9A1.5,1.5,0,0,1,2,13.5V3.5A1.5,1.5,0,0,1,3.5,2H4" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"/>
                    <rect x="6" y="1" width="4" height="2" fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    <polyline class="copy-to-clip__icon-check" points="5 9 7 11 11 7" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </svg>
            </button>
        </div>

          </td>
          <td class="int-table__cell">
            <button class="reset int-table__menu-btn margin-left-auto js-tab-focus" data-label="Edit row" aria-controls="menu-example">
              <svg class="icon" viewBox="0 0 16 16">
                <circle cx="8" cy="7.5" r="1.5" />
                <circle cx="1.5" cy="7.5" r="1.5" />
                <circle cx="14.5" cy="7.5" r="1.5" /></svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<menu id="menu-example" class="menu js-menu">
  <li role="menuitem">
    <span class="menu__content js-menu__content">
      <svg class="icon menu__icon" aria-hidden="true" viewBox="0 0 12 12">
        <path d="M10.121.293a1,1,0,0,0-1.414,0L1,8,0,12l4-1,7.707-7.707a1,1,0,0,0,0-1.414Z"></path>
      </svg>
      <span>Edit</span>
    </span>
  </li>

</menu>
</div>
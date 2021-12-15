<div class="controlbar--sticky flex justify-between">
  <div class="margin-xs">
    <div class="inline-flex items-baseline">
      <h1 class="text-md color-contrast-high padding-y-xxxxs margin-x-xs" for="filterItems">Popups:</h1>
      <div class="select inline-block js-select" data-trigger-class="reset text-sm color-contrast-high h1 inline-flex items-center cursor-pointer js-tab-focus">
        <select name="filterItems" id="filterItems">
          <optgroup label="Post Status">
            <option value=""selected>Published</option>
            <option value="draft">Draft</option>
            <option value="deleted">Trash</option>
          </optgroup>
        </select>
        <svg class="icon icon--xxxs margin-left-xxs" viewBox="0 0 8 8"><path d="M7.934,1.251A.5.5,0,0,0,7.5,1H.5a.5.5,0,0,0-.432.752l3.5,6a.5.5,0,0,0,.864,0l3.5-6A.5.5,0,0,0,7.934,1.251Z"/></svg>
      </div>
    </div>
  </div>

  <!-- Menu Bar -->
  <div class="flex flex-wrap items-center justify-between margin-right-xxs">
    <div class="flex flex-wrap">
 
    <li class="menu-bar__item js-menu-bar" aria-controls="add-modal">
      <svg class="icon menu-bar__icon" aria-hidden="true" viewBox="0 0 20 20">
        <path d="M18.85 4.39l-3.32-3.32a0.83 0.83 0 0 0-1.18 0l-11.62 11.62a0.84 0.84 0 0 0-0.2 0.33l-1.66 4.98a0.83 0.83 0 0 0 0.79 1.09 0.84 0.84 0 0 0 0.26-0.04l4.98-1.66a0.84 0.84 0 0 0 0.33-0.2l11.62-11.62a0.83 0.83 0 0 0 0-1.18z m-6.54 1.08l1.17-1.18 2.15 2.15-1.18 1.17z"></path>
      </svg>
        <span class="menu-bar__label">Add Popup</span>
      </li>

      <li class="menu-bar__item">
        <a href="{{ url('admin/ad/templates') }}">
          <svg class="icon menu-bar__icon" viewBox="0 0 20 20">
          <path d="M16.88 0h-1.25a0.63 0.63 0 0 0-0.63 0.63v1.87h-1.87a0.63 0.63 0 0 0-0.63 0.63v1.25a0.63 0.63 0 0 0 0.63 0.62h1.87v1.88a0.63 0.63 0 0 0 0.63 0.62h1.25a0.63 0.63 0 0 0 0.62-0.62v-1.88h1.88a0.63 0.63 0 0 0 0.62-0.63v-1.25a0.63 0.63 0 0 0-0.62-0.62h-1.88v-1.88a0.63 0.63 0 0 0-0.62-0.62z"></path><path d="M14.37 9.71a6.2 6.2 0 0 1-4.08-4.08 6.34 6.34 0 0 1-0.16-3.13h-8.88a1.25 1.25 0 0 0-1.25 1.25v15a1.25 1.25 0 0 0 1.25 1.25h15a1.25 1.25 0 0 0 1.25-1.25v-8.88a6.34 6.34 0 0 1-3.13-0.15z m0.63 7.79h-12.5v-2.5h12.5z"></path>
        </svg>
        </a>
        <span class="menu-bar__label">Add Templates</span>
      </li>

    </div>
  </div> <!-- end of <div class="flex flex-wrap items-center justify-between margin-right-xxs"> -->

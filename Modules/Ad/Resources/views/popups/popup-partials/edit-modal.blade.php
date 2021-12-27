<div id="edit-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Edit Popup title</h1>

      <button class="reset modal__close-btn modal__close-btn--inner js-modal__close js-tab-focus">
        <svg class="icon icon--xs" viewBox="0 0 16 16">
          <title>Close modal window</title>
          <g stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
            <line x1="13.5" y1="2.5" x2="2.5" y2="13.5"></line>
            <line x1="2.5" y1="2.5" x2="13.5" y2="13.5"></line>
          </g>
        </svg>
      </button>
    </header>

    <div class="padding-y-sm padding-x-md flex-grow overflow-auto momentum-scrolling">
      <div class="text-component">
      <label class="form-label margin-bottom-xxxs" for="select-this"></label>

<div class="select inline-block js-select margin-top-sm" data-trigger-class="btn btn--subtle">
  <select name="select-this" id="select-this">
    <optgroup label="Group 1">
      <option value="0" selected>Default Template</option>
      <option value="1">Template 2</option>
      <option value="2">Template 3</option>
    </optgroup>
  </select>
  
  <svg class="icon icon--xxs margin-left-xxs" aria-hidden="true" viewBox="0 0 12 12"><path d="M10.947,3.276A.5.5,0,0,0,10.5,3h-9a.5.5,0,0,0-.4.8l4.5,6a.5.5,0,0,0,.8,0l4.5-6A.5.5,0,0,0,10.947,3.276Z"/></svg>
</div>
</div>

      <div class="margin-top-sm">
              <label class="form-label margin-bottom-xxs" for="inputEmail">Popup Name</label>
              <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="Enter Name">
      </div>

      <div class="margin-top-sm">
              <label class="form-label margin-bottom-xxs" for="inputEmail">Popup Timer</label>
              <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="Enter in seconds">
      </div>

      <fieldset class="margin-top-md">
      <h3 class="form-label" for="inputEmail">Cookies</h3>
      <p class="text-xs color-contrast-medium margin-top-xxs">This is a Session cookie. Session cookies expire when the user closes their browser</p>
        
            <div class="flex flex-wrap gap-md margin-top-sm">
              <div>
                <input class="checkbox" type="checkbox" id="checkbox1">
                <label for="checkbox1">Enable Cookie</label>
              </div>
            </div>
          </fieldset>

      <div class="margin-top-sm">
              <label class="form-label margin-bottom-xxs" for="inputEmail">Cookie Expiration</label>
              <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="Enter in days">
      </div>
      
      <div class="margin-top-sm">
              <label class="form-label margin-bottom-xxs" for="inputEmail">Cookie Code</label>
              <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="Enter Name">
      </div>

  </div>

    <footer class="padding-y-sm padding-x-md bg inner-glow-top shadow-md flex-shrink-0">
      <div class="flex justify-end gap-xs">
        <button class="btn btn--accent js-modal__close">Delete</button>
        <button class="btn btn--subtle js-modal__close">Cancel</button>
        <button class="btn btn--primary">Save</button>
      </div>
    </footer>
  </div>

</div>
<div id="edit-modal" class="modal modal--animate-translate-down flex flex-center bg-black bg-opacity-90% padding-md js-modal">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto bg radius-md inner-glow shadow-md flex flex-column" role="alertdialog" aria-labelledby="modal-title-4" aria-describedby="modal-description-4">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between flex-shrink-0">
      <h1 id="modal-title-4" class="text-truncate text-md">Edit Template title</h1>

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

<div class="padding-y-sm padding-x-md flex-grow overflow-auto momentum-scrolling"><div>
  <div class="margin-top-sm margin-bottom-sm">
      <label class="form-label margin-bottom-xxs" for="inputEmail">Edit Template Name</label>
      <input class="form-control width-100%" type="email" name="inputEmail" id="inputEmail" placeholder="Enter Name">
   </div>

   <label class="form-label margin-bottom-xxs margin-top-xs" for="textarea">Edit Your Modal Codes</label>
       <textarea class="form-control width-100%" name="textarea" id="textarea"></textarea>
        <p class="text-xs color-contrast-medium margin-top-xxs margin-bottom-md">Modal html codes only</p>

      <label class="form-label margin-bottom-xxs" for="textarea">Edit Your Ad Codes</label>
       <textarea class="form-control width-100%" name="textarea" id="textarea"></textarea>
        <p class="text-xs color-contrast-medium margin-top-xxs">Edit html</p>
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
<div class="modal modal--animate-scale flex flex-center bg-black bg-opacity-90% padding-md js-modal" id="edit-modal">
  <div class="modal__content width-100% max-width-xs max-height-100% overflow-auto bg radius-md inner-glow shadow-md" role="alertdialog" aria-labelledby="modal-title-1" aria-describedby="modal-description-1">
    <header class="bg-contrast-lower bg-opacity-50% padding-y-sm padding-x-md flex items-center justify-between">
      <h4 class="text-truncate" id="modal-title-1">Component Settings</h4>

      <button class="reset modal__close-btn modal__close-btn--inner hide@md js-modal__close js-tab-focus">
        <svg class="icon" viewBox="0 0 20 20">
          <title>Close modal window</title>
          <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="3" x2="17" y2="17" />
            <line x1="17" y1="3" x2="3" y2="17" />
          </g>
        </svg>
      </button>
    </header>

 <div class="padding-md">
    <form>
  <fieldset class="margin-bottom-md">
    <legend class="form-legend">Form Legend</legend>

    <div class="grid gap-sm">
        <label class="form-label margin-bottom-xxs" for="input-name">Edit name</label>
        <input class="form-control width-100%" type="text" name="input-name" id="input-name" required>

        <label class="form-label margin-bottom-xxs" for="qty-input-2">Items to list</label>

<div class="number-input number-input--v2  js-number-input">
  <input class="form-control js-number-input__value " type="number" name="qty-input-2" id="qty-input-2" min="0" max="10" step="1" value="1">
  
  <button class="reset number-input__btn number-input__btn--plus js-number-input__btn" aria-label="Increase Number">
    <svg class="icon" viewBox="0 0 12 12" aria-hidden="true"><path d="M11,5H7V1A1,1,0,0,0,5,1V5H1A1,1,0,0,0,1,7H5v4a1,1,0,0,0,2,0V7h4a1,1,0,0,0,0-2Z" /></svg>
  </button>

  <button class="reset number-input__btn number-input__btn--minus js-number-input__btn" aria-label="Decrease Number">
    <svg class="icon" viewBox="0 0 12 12" aria-hidden="true"><path d="M11,7H1A1,1,0,0,1,1,5H11a1,1,0,0,1,0,2Z"/></svg>
  </button>
</div>

    </div>
  </fieldset>

</form>
</div>

<div class="padding-x-md">
<label class="form-label margin-bottom-md" for="textarea">Metas</label>
<div class="tbl settings-tbl space-unit-em">
 <table class="tbl__table text-sm" aria-label="Table Example">
     <tr class="tbl__row">
       <th class="sr-only" scope="col">Enable/disable option</span></th>
     </tr>


   <tbody class="tbl__body">

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Name</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-push-notifications">
             <label class="switch__label" for="switch-push-notifications" aria-hidden="true">Name</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Content Count</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="emojis">
             <label class="switch__label" for="emojis" aria-hidden="true">Content Count</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Last Active</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-sms-notifications" checked>
             <label class="switch__label" for="switch-sms-notifications" aria-hidden="true">Last Active</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Label</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-email-notifications">
             <label class="switch__label" for="switch-email-notifications" aria-hidden="true">Label</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>
     
   </tbody>
 </table>
</div>

</div>


    <footer class="padding-md">
      <div class="flex justify-end gap-xs">
        <button class="btn btn--subtle js-modal__close">Cancel</button>
        <button class="btn btn--primary">Save</button>
        <button class="btn btn--primary">Generate Short Code</button>
      </div>
    </footer>
  </div>

  <button class="reset modal__close-btn modal__close-btn--outer display@md js-modal__close js-tab-focus">
    <svg class="icon icon--sm" viewBox="0 0 24 24">
      <title>Close modal window</title>
      <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="3" y1="3" x2="21" y2="21" />
        <line x1="21" y1="3" x2="3" y2="21" />
      </g>
    </svg>
  </button>
</div>
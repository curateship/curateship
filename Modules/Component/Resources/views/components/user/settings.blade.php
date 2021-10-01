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

        <label class="form-label margin-bottom-xxs" for="input-name">Edit URL Slug</label>
        <input class="form-control width-100%" type="text" name="input-name" id="input-name" required>
      
      <div>
        <label class="form-label margin-bottom-xxs" for="textarea">Edit Template Note</label>
        <textarea class="form-control width-100%" name="textarea" id="textarea"></textarea>
        <p class="text-xs color-contrast-medium margin-top-xxs">Use helper text to provide additional information.</p>
      </div>
    </div>
  </fieldset>

  <fieldset class="margin-bottom-md">
    <legend class="form-legend">Radio Buttons</legend>

    <ul class="flex flex-column gap-xxxs">
      <li>
        <input class="radio" type="radio" name="radio-buttons" id="radio-1" checked>
        <label for="radio-1">App 1</label>
      </li>

      <li>
        <input class="radio" type="radio" name="radio-buttons" id="radio-2">
        <label for="radio-2">App 2</label>
      </li>
    </ul>
  </fieldset>

</form>
</div>


<div class="padding-md">
<label class="form-label margin-bottom-md" for="textarea">Metas</label>
<div class="tbl settings-tbl space-unit-em">
 <table class="tbl__table text-sm" aria-label="Table Example">
     <tr class="tbl__row">
       <th class="sr-only" scope="col">Enable/disable option</span></th>
     </tr>


   <tbody class="tbl__body">

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Comment</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-push-notifications">
             <label class="switch__label" for="switch-push-notifications" aria-hidden="true">Push notifications</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Emojis</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="emojis">
             <label class="switch__label" for="emojis" aria-hidden="true">Emojis</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Recaptcha</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-sms-notifications" checked>
             <label class="switch__label" for="switch-sms-notifications" aria-hidden="true">Recaptcha</label>
             <div class="switch__marker" aria-hidden="true"></div>
           </div>
         </div>
       </td>
     </tr>

     <tr class="tbl__row">
       <td class="tbl__cell" role="cell">
         <p>Aged (3 Days)</p>
       </td>

       <td class="tbl__cell" role="cell">
         <div class="flex justify-end">

           <div class="switch ">
             <input class="switch__input" type="checkbox" id="switch-email-notifications">
             <label class="switch__label" for="switch-email-notifications" aria-hidden="true">Email notifications</label>
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
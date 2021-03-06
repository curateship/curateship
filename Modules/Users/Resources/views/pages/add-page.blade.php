<div class="max-width-sm mg-auto">
  <div class="add-page-wrp editorjs-fullwidth hidden">
    <form action="{{ route('pages.store') }}" data-action="{{ route('pages.store') }}" id="formAddPage" method="POST" enctype="multipart/form-data" >
      @csrf
      <input type="hidden" name="is_published"/>
      <div class="flex">
        <div class="height-100% width-100% bg radius-md flex flex-column">

          <div class="padding-y-sm flex-grow overflow-auto">
            <h1 class="js-input custom-input custom-input__title" placeholder="Title" target="title" required></h1>
            <input type="hidden" id="title" name="title" value="">
            
            <div class="grid gap-sm">
              <div id="editorjs" data-target-input="#description" class="site-editor"></div>
              <input type="hidden" name="description" id="description"/>
            </div>
          </div><!-- /.padding-y-sm flex-grow overflow-auto -->

          <footer class="padding-y-sm bg flex-shrink-0">
            <div class="flex justify-end gap-xs">
              <button type="button" class="btn btn--subtle btn-cancel-page">Cancel</button>
              <button type="button" id="btnSave" class="btn btn--primary site-editor" data-target-input="#description">Save</button>
              <button type="button" id="btnPublish" class="btn btn--primary site-editor" data-target-input="#description">Publish</button>
            </div>
          </footer>
        </div><!-- /.modal__content -->
      </div><!-- /.modal -->
    </form>
  </div>
</div>
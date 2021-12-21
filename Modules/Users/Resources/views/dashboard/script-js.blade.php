@auth

<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/raw@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>

<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>

<script>
  (function(){
    // Close modal trigger
    $('[data-toggle="close-modal"]').on('click', function(){
      var $this = $(this);
      var closeModalBtn = $($this.data('target-close'));

      closeModalBtn.click();
    });

    // load content when user clicked on sidebar links
    $(document).on('click', '.ajax-link', function (e) {
      e.preventDefault();
      var $this = $(this);
      var url = $this.attr('href');

      $('meta[name="current-url"]').attr('content', url);

      localStorage.setItem("cs_user_dashboard_init_tab", $(this).attr('data-tab'));

      // loads page content inside this element
      $('#site-table-with-pagination-container').load(url, function(){
        $('.add-post-wrp').addClass('hidden'); // hide add post section
        $('.posts-wrp').removeClass('hidden'); // show post list section
        $('.edit-post-wrp').addClass('hidden'); // hide post edit section

      });

      $('.subnav__item a').removeAttr('aria-current');
      $(this).attr('aria-current', 'page');
    });

    // init reload previous tab logic
    var init_tab = localStorage.getItem("cs_user_dashboard_init_tab");
    if (init_tab != null && document.referrer == document.location) {
      $('[data-tab="' + init_tab + '"]').trigger('click');
    } else {
      localStorage.setItem("cs_user_dashboard_init_tab", ""); // clear
    }
  })();
</script>

<script>
(function() {
  // initialize js custom input element event
  var CustomJSInput = function (element)  {
    this.element = element;
    this.target = this.element.getAttribute('target');
    this.targetElement = document.getElementById(this.target);

    initCustomJSInput(this);
    initCustomJSInputEvent(this);
  }

  // initialize element
  function initCustomJSInput(input) {
    input.element.setAttribute('contenteditable', true);
  }

  // initialize event
  function initCustomJSInputEvent(input) {
    // keyboard navigation
    input.element.addEventListener('keydown', function(event){
      if (event.keyCode === 13)
        event.preventDefault();
    });

    input.element.addEventListener('input', function(event){
      if (getCustomInputElementConent(input) === '')
        input.element.innerHTML = '';

      if (input.element.hasAttribute('required') && getCustomInputElementConent(input) === '') {
        Util.addClass(input.element, 'form-control--error');
      } else {
        Util.removeClass(input.element, 'form-control--error');
      }

      input.targetElement.value = getCustomInputElementConent(input);
    });
  }

  function getCustomInputElementConent(input) {
    return input.element.innerHTML.replace('<br>', '').trim();
  }

  //initialize the Custom JS Input objects
  var customJSInputElem = document.getElementsByClassName('js-input');
  if( customJSInputElem.length > 0 ) {
    for( var i = 0; i < customJSInputElem.length; i++) {
      (function(i){new CustomJSInput(customJSInputElem[i]);})(i);
    }
  }
}());
</script>

<script>
var videojs_template =
  `<video id="media-player" class="video-js video-small vjs-big-play-centered" data-setup='{"controls": true, "autoplay": false, "preload": "auto", "fluid": true}' width="320" height="150" style="display:none">
    <source src="" type="" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>`;

(function() {
  // Ajax Upload Process
  function validateMediaUpload(formData, jqForm, options) {
    console.log('validate form before upload');
    var form = jqForm[0];

    if ( !form.media.value ) {
      alert('File not found');
      return false;
    }
  }

  function uploadMedia(e) {
    e.preventDefault();

    console.log($(e.target).closest('form').attr('id'));
    var $form = $(e.target).closest('form');

    var progress_wrp = $('.progress-bar');
    var progress_value = $(progress_wrp).find('.progress-bar__value');
    var progress_final = $(progress_wrp).find('.progress-bar__final');
    var notification = $('.alert-upload');
    var bar = $('.progress-bar .progress-bar__fill');
    var js_percent = $('.progress-bar .js-progress-bar__aria-value');
    var percent = $('.progress-bar .progress-bar__value');


    $form.ajaxSubmit({
      url: "{{ route('posts.upload-media') }}",
      type: 'post',
      beforeSubmit: validateMediaUpload,
      beforeSend: function() {
        console.log('before send');
        var percentVal = '0%';
        progress_wrp.show();
        bar.width(percentVal)
        percent.html(percentVal);
        js_percent.html(percentVal);

        // Disable Save buttons
        $('#btnSave, #btnPublish, #btnEditSaveDraft, #btnEditSave, #btnEditSavePublish, .restore-post-link').addClass('btn--disabled');
      },
      uploadProgress: function(event, position, total, percentComplete) {
        console.log('uploading...');
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
        js_percent.html(percentVal);

        if (percentComplete == 100) {
          console.log('upload done');
          progress_value.hide();
          progress_final.show();
        }
      },
      complete: function(xhr) {
        console.log('upload complete');

        progress_wrp.hide();
        progress_value.show();
        progress_final.hide();

        $(notification).find('.message').html('Media file is uploaded successfully.');
        notification.removeClass('alert--error').addClass('alert--success').fadeIn().delay(1000).fadeOut();

        // reset progress bar
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
        js_percent.html(percentVal);

        console.log(xhr.responseJSON);
        console.log('New post uploading completed')
        // Update form data based on response data.
        $form.find('input[name="video"]').val(xhr.responseJSON.video);
        $form.find('input[name="thumbnail"]').val(xhr.responseJSON.thumbnail);
        $form.find('input[name="thumbnail_medium"]').val(xhr.responseJSON.thumbnail_medium);
          $form.find('input[name="original_filename"]').val(xhr.responseJSON.original_filename);

        // Should clear file upload input field. (Trick to clear data)
        $(e.target).attr('type', 'text');
        $(e.target).attr('type', 'file');
        $(e.target).prop('required', false);

        // reset video (Only when video is already initialized)
        if ( $('div#media-player').length > 0 ) {
          var oldPlayer = document.getElementById('media-player');
          videojs(oldPlayer).dispose();
        }

        // Update media video & thumbnail
        if ( xhr.responseJSON.video_url != '') {
          console.log('update video')
          $('#edit-media-player').html(videojs_template).show();

          $('#media-player').find('source').attr('src', xhr.responseJSON.video_url).attr('type', xhr.responseJSON.video_type);
          $('#media-player').attr('poster', xhr.responseJSON.thumbnail_url).show();

          videojs('#media-player', {
            controls: true,
            autoplay: false,
            fill: true,
            preload: 'auto'
          });
          $('#thumbnailPreview').hide();
        } else {
          console.log('update thumbnail')
          $('#thumbnailPreview').attr('src', xhr.responseJSON.thumbnail_url).show();
          $('#edit-media-player').hide();
        }

        // Enable Save Buttons
        $('#btnSave, #btnPublish, #btnEditSaveDraft, #btnEditSave, #btnEditSavePublish, .restore-post-link').removeClass('btn--disabled');
      },
      error: function() {
        // alert('failed');
        progress_wrp.hide();
        progress_value.show();
        progress_final.hide();

        $(notification).find('.message').html('Filed to upload media file.');
        notification.removeClass('alert--success').addClass('alert--error').fadeIn().delay(1000).fadeOut();
      }
    });

    return false;
  }
  $(document).on('change', '#editMedia', uploadMedia);
  $(document).on('change', '#upload-file', uploadMedia);
}());
</script>

<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
  function showNotificationBox(data) {
    $('#notification-box').removeClass('alert--error').removeClass('alert--success');
    $('#notification-box').addClass(data.class);
    $('#notification-box .message').html(data.message);
    $('#notification-box').addClass('alert--is-visible');
  }

  /** Form Fields Validation Module */
  // post tag fields validation
  function validatePostTagFields(form) {
    var isValid = false;

    $tag_elems_wrp = $(form).find('.post-tag-wrp');
    $tag_elems_alert_wrp = $tag_elems_wrp.find('.alert');
    $tag_elems = $tag_elems_wrp.find('select');

    if ($tag_elems.length == 0)
      return true;

    $tag_elems.each(function(idx, elem) {
      if ($(elem).select2('data').length > 0) {
        isValid = true;
      }
    });

    if (isValid) {
      $tag_elems_alert_wrp.removeClass('alert--is-visible');
      $tag_elems.each(function(idx, elem) {
        $(elem).removeClass('form-control--error');
        $(elem).siblings('.select2').find('.select2-selection').removeClass('form-control--error');
      });

    } else {
      $tag_elems_alert_wrp.addClass('alert--is-visible');
      $tag_elems.each(function(idx, elem) {
        $(elem).addClass('form-control--error');
        $(elem).siblings('.select2').find('.select2-selection').addClass('form-control--error');
      });
    }

    return isValid;
  }

  function validateCustomSelect(selector) {
    if ($(selector).parents('.post-tag-wrp').length > 0) {
      $form = $(selector).parents('form')[0];
      validatePostTagFields($form);

    } else {
      if ($(selector).prop('required')) { // only when set as required field
        if ($(selector).select2('data').length == 0) {
          $(selector).addClass('form-control--error');
          $(selector).siblings('.select2').find('.select2-selection').addClass('form-control--error');

        } else {
          $(selector).removeClass('form-control--error');
          $(selector).siblings('.select2').find('.select2-selection').removeClass('form-control--error');
        }
      }
    }
  }

  // remove validation error from form
  function clearError($form) {
    $form.find('.form-control--error').each(function(idx, elem) {
      $(elem).removeClass('form-control--error');
    });
    $form.find('.alert--is-visible:not(.alert-upload)').each(function(idx, elem) {
      $(elem).removeClass('alert--is-visible');
    });
  }

  // form required fields validation
  function validateItem(elem) {
    var isValid = true;
    switch ($(elem).prop('tagName')) {
      case 'INPUT':
        if ($(elem).prop('type') == 'file') {
          // file control
          $upload_alert_wrp = $('.file-upload .alert');
          if ($(elem).val() == '') {
            $upload_alert_wrp.addClass('alert--is-visible');
            $(elem).addClass('form-control--error');
            $(elem).parent('.ddf__area').addClass('form-control--error');
            isValid = false;

          } else {
            $upload_alert_wrp.removeClass('alert--is-visible');
            $(elem).removeClass('form-control--error');
            $(elem).parent('.ddf__area').removeClass('form-control--error');
          }

        } else if ($(elem).prop('type') == 'button' || $(elem).prop('type') == 'submit') {
          // buttons, ignore this
        } else {
          if ($(elem).val() == '') {
            $(elem).addClass('form-control--error');
            isValid = false;
          } else {
            $(elem).removeClass('form-control--error');
          }
        }
        break;

      default:
        if ($(elem).hasClass('custom-input')) {
          if ($(elem).html().trim() == '') {
            $(elem).addClass('form-control--error');
            isValid = false;
          } else {
            $(elem).removeClass('form-control--error');
          }
        }
    }

    return isValid;
  }

  $('form').find('[required]').each(function (idx, elem) {
    $(elem).change(function() {
      validateItem($(this));
    });
  });

  function formDataValidation($form) {
    $form.find('[required]').each(function (idx, elem) {
      validateItem(elem);
    });

    validatePostTagFields($form);

    if ($form.find('.form-control--error').length > 0)
      return false;

    return true;
  }

  function matchCustom(params, data) {
    // If there are no search terms, return null to prevent show all tags
    if ($.trim(params.term) === '') {
      return null;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.toLowerCase().indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
  }

  function select2ForTags(selector){
      const categoryId = $(selector).attr("data-id")

      $(selector).select2({
          ajax: {
              url: '/tags/searchTagsInCategory',
              delay: 250,
              data: function (params) {
                  return {
                      search: params.term,
                      categoryId: categoryId
                  }
              }
          },
          tags: true,
          tokenSeparators: [","],
          matcher: matchCustom,
          minimumInputLength: 2
    }).on('select2:opening', function(e){
      var $searchfield = $(selector).parent().find('.select2-search__field');

      if ($searchfield.val() == '')
        return false;
      else
        return true;
    }).on('select2:select', function(e) {
      validateCustomSelect(selector);
    }).on('select2:unselect', function(e) {
      validateCustomSelect(selector);
    });
  }

  $(function(){
    $('.site-tag-pills').each(function(){
      select2ForTags(this);
    });

    const ImageTool = window.ImageTool;

    var editor = null;
    if ($('#editorjs').length > 0) {
      editor = new EditorJS({
        /**
        * Id of Element that should contain Editor instance
        */
        holder: 'editorjs',
        placeholder: 'Tell your story...',
        tools: {
          header: Header,
          raw: RawTool,
          image: {
            class: ImageTool,
            config: {
              endpoints: {
                byFile: window.location.origin + '/editorjs/upload-image'
              },
              additionalRequestHeaders : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }
          },
          embed: Embed,
          quote: Quote,
          checklist: {
            class: Checklist,
            inlineToolbar: true,
          },
          list: {
            class: List,
            inlineToolbar: true,
          }
        }
      });
    }

    var editor2 = null;
    if ($('#editorjs2').length > 0) {
      editor2 = new EditorJS({
        /**
        * Id of Element that should contain Editor instance
        */
        holder: 'editorjs2',
        placeholder: 'Tell your story...',
        tools: {
          header: Header,
          raw: RawTool,
          image: {
            class: ImageTool,
            config: {
              endpoints: {
                byFile: window.location.origin + '/editorjs/upload-image'
              },
              additionalRequestHeaders : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }
          },
          embed: Embed,
          quote: Quote,
          checklist: {
            class: Checklist,
            inlineToolbar: true,
          },
          list: {
            class: List,
            inlineToolbar: true,
          }
        }
      });
    }

    // used editorjs for add post form
    $('.site-editor').on('input click', function(){
      var $this = $(this);

      if($this.data('target-input')){
        console.log('WTF');
        var $targetInput = $($this.data('target-input'));

        editor.save().then((outputData) => {
          // Save data as string
          $targetInput.val(JSON.stringify(outputData));
        }).catch((error) => {
          console.log('Saving failed: ', error);
        });
      }

    });

    // used editorjs for edit post form
    $('#editorjs2, .trigger-site-editor-save').on('input click', function(){
      var $this = $(this);

      if($this.data('target-input')){
        console.log('edit description input');
        var $targetInput = $($this.data('target-input'));

        editor2.save().then((outputData) => {
          // Save data as string
          $targetInput.val(JSON.stringify(outputData));
        }).catch((error) => {
          console.log('Saving failed: ', error);
        });
      }

    });

    $(document).on('click', '#btnSave, #btnPublish', function(){
      if ($(this).hasClass('btn--disabled'))
        return;

      if (!formDataValidation($('#formAddPost')))
        return;

      var status = ($(this).attr('id') != 'btnSave') ? 'published' : 'draft';
      $('#formAddPost').find('input[name="status"]').val(status);
      $('#formAddPost').submit();
    });

    $(document).on('click', '#closeEditModal', function(){
      $('#modal-edit-post').removeClass('modal--is-visible');
    });

    // add new post link
    $(document).on('click', '.btn-new-post', function() {
      clearError($('#formAddPost'));

      $('.add-post-wrp').removeClass('hidden'); // show add post section
      $('.posts-wrp').addClass('hidden'); // hide post list section
      $('.edit-post-wrp').addClass('hidden'); // hide post edit section

      $('.subnav a[aria-current]').attr('aria-current', '');
    });

    // cancel post add/edit link
    $(document).on('click', '.btn-cancel-post', function() {
      $('.add-post-wrp').addClass('hidden'); // hide add post section
      $('.posts-wrp').removeClass('hidden'); // show post list section
      $('.edit-post-wrp').addClass('hidden'); // hide post edit section

      $('.subnav a[aria-current]').attr('aria-current', 'page');

      // reset video
      var oldPlayer = document.getElementById('media-player');
      videojs(oldPlayer).dispose();
    });

    $(document).on('click', 'td[aria-controls="modal-edit-post"]', function(){

      var postId = $(this).attr('data-id');
      var editUrl = "dashboard/" + postId + "/fetch-data";

      // Clear form
      $('#formEditPost').get(0).reset();
      // $('#editTags').val('').trigger('change');
      $('.site-tag-pills').each(function(){
        $(this).val('').trigger('change');
      });
      editor2.clear(); // used editorjs for edit post form

      $('#edit-media-player').html(videojs_template);
      $('#thumbnailPreview').hide();

      $.ajax({
        url: editUrl,
        dataType: 'json',
        type: 'get',
        success: function(response) {
          if (response.status === false) {
            showNotificationBox(response);
            return;
          }

          var allTagsPerCategory = JSON.parse(response.tags);

          for (let i = 0; i < allTagsPerCategory.length; i++) {
            const tagCategory = allTagsPerCategory[i];
            $('#edit_tag_category_'+tagCategory.tag_category_id).html(tagCategory.tags);
          }

          if (response.description) {
            var editorData = JSON.parse(response.description);
            if (editorData.blocks.length > 0) {
              editor2.render(editorData);
              $('#editDescription').val(response.description);
            }
          }

          $('#editTitle').val(response.title);
          $('#editTitleElem').html(response.title);
          $('#editDescription').val(response.description);
          if ( response.video != '') {
            $('#media-player').find('source').attr('src', response.video).attr('type', response.video_type);
            $('#media-player').attr('poster', response.thumbnail).show();
            videojs('#media-player', {
              controls: true,
              autoplay: false,
              fill: true,
              preload: 'auto'
            });
            $('#edit-media-player').show();
            $('#thumbnailPreview').hide();
          } else {
            $('#thumbnailPreview').attr('src', response.thumbnail).show();
            $('#edit-media-player').hide();
          }
          // $('#editTags').html(response.tags);
          $('#postId').val(postId);

          if(response.status == 'published'){
            $(document).find('.publish-post-link').addClass('is-hidden');
            $(document).find('.restore-post-link').addClass('is-hidden');

            $(document).find('.draft-post-link').attr('href', '/dashboard/' + response.id + '/make-draft');
            $(document).find('.draft-post-link').removeClass('is-hidden');
          }

          if(response.status == 'draft'){
            $(document).find('.draft-post-link').addClass('is-hidden');
            $(document).find('.restore-post-link').addClass('is-hidden');

            $(document).find('.publish-post-link').attr('href', '/dashboard/' + response.id + '/publish');
            $(document).find('.publish-post-link').removeClass('is-hidden');
          }

          if(response.status == 'deleted'){
            // Hide the Draft and Publish button
            $(document).find('.draft-post-link').addClass('is-hidden');
            $(document).find('.publish-post-link').addClass('is-hidden');

            // Show restore button
            $(document).find('.restore-post-link').attr('href', '/dashboard/' + response.id + '/restore');
            $(document).find('.restore-post-link').removeClass('is-hidden');
          }

          // select2ForTags('#editTags');
          $('.site-tag-pills').each(function(){
            select2ForTags(this);
          });

          clearError($('#formEditPost'));

          $('.add-post-wrp').addClass('hidden'); // hide add post section
          $('.posts-wrp').addClass('hidden'); // hide post list section
          $('.edit-post-wrp').removeClass('hidden'); // show post edit section

          $('.subnav a[aria-current]').attr('aria-current', '');
        }
      });

      $('#modal-edit-post').addClass('modal--is-visible');
    });

    function savePost(e) {
      e.preventDefault();

      if ($(e.target).hasClass('btn--disabled'))
        return;

      if (!formDataValidation($('#formEditPost')))
        return;

      var status = $(this).data('toggle-published') == '1' ? 'published' : 'draft';

      $('#formEditPost').find('input[name="status"]').val(status);
      $('#formEditPost').submit();
    }

    $(document).on('click', '#btnEditSave', savePost);
    $(document).on('click', '#btnEditSaveDraft', savePost);
    $(document).on('click', '#btnEditSavePublish', savePost);

    // Single post delete
    $(document).on('click', '.btn-delete', function(){
      if(confirm("Are you sure you want to delete this post?")){
        $(this).closest('form').submit();
      }
    });

    // Multiple post delete
    $(document).on('click', '#btnDeleteMultiple', function(){
      if(confirm("Are you sure you want to delete these posts?")){
        $('#form-bulk-delete').submit();
      }
    });

    $(document).on('click', '#closeRejectModal', function(){
      $('#modal-reject-post').removeClass('modal--is-visible');
    });

    // Reject Post
    $(document).on('click', 'td[aria-controls="modal-reject-post"]', function(e){
      e.preventDefault();
      $('#modal-reject-post').addClass('modal--is-visible');

      var postId = $(this).attr('data-id');
      $('#postId').val(postId);
      $('#rejectMsg').val("").focus();
    });

    function rejectPost(e) {
      e.preventDefault();

      if (!formDataValidation($('#formRejectPost')))
        return;

      var $this = $(this);

      $(this).html("Please wait...");

      var formData = new FormData($('#formRejectPost')[0]);
      formData.append('id', $('#postId').val());
      formData.append('message', $('#rejectMsg').val());

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
      });

      $.ajax({
        url: "{{ route('posts.reject') }}",
        dataType: 'json',
        type: 'post',
        contentType: false,
        processData: false,
        data: formData,
        success: function(response){
          location.reload();
        }
      });
    }
    $(document).on('click', '#btnReject', rejectPost);

    // Trash icon badge update
    $(document).on('click', '.checkbox-delete', function(){
      var checkPostCount = 0;

      $('.checkbox-delete').each(function(){
        if($(this).is(':checked')){
          checkPostCount++
        }
      });

      if($('.checkbox-delete:checked').length){
        $(document).find('#btnRefreshTable').addClass('is-hidden');
        $(document).find('#btnDeleteMultiple').removeClass('is-hidden');
      } else {
        $(document).find('#btnRefreshTable').removeClass('is-hidden');
        $(document).find('#btnDeleteMultiple').addClass('is-hidden');
      }

      $('#deleteBadge').html(checkPostCount);
    });

    // Check all boxes when the checkall box checkbox is checked
    $(document).on('click', '#checkboxDeleteAll', function(){
      var table = $(this).parents('table')[0];
      if($(this).is(':checked')){
        $(table).find('.checkbox-delete').prop('checked', true);
      } else {
        $(table).find('.checkbox-delete').prop('checked', false);
      }

      var checkPostCount = 0;

      $(table).find('.checkbox-delete').each(function(){
        if($(this).is(':checked')){
          checkPostCount++
        }
      });

      $('#deleteBadge').html(checkPostCount);

      if($(table).find('.checkbox-delete:checked').length){
        $(document).find('#btnRefreshTable').addClass('is-hidden');
        $(document).find('#btnDeleteMultiple').removeClass('is-hidden');
      } else {
        $(document).find('#btnRefreshTable').removeClass('is-hidden');
        $(document).find('#btnDeleteMultiple').addClass('is-hidden');
      }

    });

    // Clean trash
    $(document).on('click', '#emptyTrash', function(){
      if(confirm('Are you sure you want to empty the trash?')){
        $(this).closest('form').submit();
      }
    });

    // var ddf = document.getElementsByClassName('ddf')[0];
    // if( ddf ) new Ddf({element: ddf});

    $(document).on('change', '#upload-file', function(){
      var ddfArea = $(this).closest('.ddf__area');

      ddfArea.addClass('ddf__area--file-dropped');
      ddfArea.find('.js-ddf__files-counter').html("1 selected file");
    });

    $(document).on('click', '.btn-full-screen', function(){
      var modalContent = $(this).closest('.modal__content');
      modalContent.toggleClass('max-width-sm');

      var hasClass = $(this).closest('.max-width-sm').length;

      if(hasClass){
        $(this).html('Full Screen');
        modalContent.removeClass('radius-0');
      } else {
        $(this).html('Shrink Screen');
        modalContent.addClass('radius-0');
      }
    });

    // Interactive table checkbox toggle
    $(document).on('input', '.js-int-table__select-all, .js-int-table__select-row', function(){
      console.log('check');
      var $checkBoxesChecked = $('.js-int-table__select-row:checked');
      var $totalSelected = $('.table-total-selected');
      // console.log($("#selected-id-template").html());
      var $inputHiddenTemplate = $("#selected-id-template").html().trim();

      $('.bulk-selected-ids').html('');

      $checkBoxesChecked.each(function(){
        var $this = $(this);
        var $selectedID = $inputHiddenTemplate.replace(/@{{value}}/gi, $this.val());
        $('.bulk-selected-ids').append($selectedID);
      });

      $totalSelected.text($checkBoxesChecked.length);
    });
  });
</script>
@endauth

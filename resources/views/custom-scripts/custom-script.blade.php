@auth
<script>
  (function(){

    setInterval(() => {
      if ($('.mega-nav').hasClass('hide-nav--off-canvas')) {
        $('.sidebar--sticky-on-desktop').addClass('custom');
      }else{
        $('.sidebar--sticky-on-desktop').removeClass('custom');
      }
    }, 0);

    $('.custom-modal-hide-body-scroll').on('modalIsOpen', function(){
      $('body').css('overflow', 'hidden');
    }).on('modalIsClose', function(){
      $('body').css('overflow', 'inherit');
    });

    // Interactive table checkbox toggle
    $(document).on('input', '.js-int-table__select-all, .js-int-table__select-row', function(){
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

    // when pagination links are clicked, only load the table
    $(document).on('click', '.site-load-content a, .site-table-filter a', function(e){
      $('.bulk-selected-ids').html(''); // remove hidden inputs on bulk select
      $('.table-total-selected').text('0'); // set counter to 0

      $('#site-table-limit-dropdown').find('[data-index="0"]').click(); // reset dropdown
    });

    // watch for change on the results limit dropdown
    $(document).on('change', '#site-table-limit', function() {
      var $this = $(this);
      var $submitForm = $this.closest('form');
      /* $submitForm.submit();
      return; */
      var url = $submitForm.attr('action');
      var method = $submitForm.attr('method');
      var dataType = 'HTML';
      var data = $submitForm.serialize();

      $.ajax({
        url: url,
        method: method,
        dataType: dataType,
        data: data
      })
        .done(function(data) {
          $('#site-table-with-pagination-container').html(data);
        })
        .fail(function(jqXHR, textStatus) {
          // console.log('Request failed: ' + textStatus);
          alert('Something went wrong. Please reload the page.');
        })
        .always(function() {});

    });

    // change sort and order whenever a table header column is toggled
    $(document).on('click', '.js-int-table__cell--sort', function(){
      var $this = $(this);
      var sort = $this.data('sort')
      var $checkedOrder = $this.find('input[type="radio"]:checked');
      var order = (order == 'none') ? 'desc' : $checkedOrder.val();

      $('input[name="sort"]').val(sort);
      $('input[name="order"]').val(order);

      // console.log(sort, order);
    });

    $(document).on('click', '.site-table-filter a', function(){
      var $this = $(this);
      $('.site-table-filter a').attr('aria-current', '');
      $this.attr('aria-current', 'page');
    });

    // trigger for bulk select
    $('[data-control-form]').on('click', function(){
      var $this = $(this);
      var $form = $($this.data('control-form'));

      $form.submit();
    });

    $(document).on('click', '.site-load-content a', function (e) {
      e.preventDefault();
      var $this = $(this);
      var url = $this.attr('href');

      $('meta[name="current-url"]').attr('content', url);
      console.log(url);

      // loads page content inside this element
      $('#site-table-with-pagination-container').load(url);
    });
  })();

  $(document).on('click', '.comment-reply', function(e) {
      e.preventDefault();

      var $this = $(this);
      var url = $this.attr('href');
      var saveurl = $this.data('save-url');
      var postId = $this.attr('data-post-id')

      $('#modal-comment-reply-form-' + postId).attr('action', saveurl);
      var $element = $('#ajax-comment-reply-form-' + postId);
      $element.load(url, function(response, status, xhr) {
      })
  });

  function initPostCommentsForms(){
      // Comments post form;
      $('.commentNewContent').each(function(){
          $(this).text()
          $(this).bind('input propertychange', function() {
              const postBtn = $('.postbtn[data-post-id="' + $(this).attr('data-post-id') + '"]')

              postBtn.attr('disabled', true);

              if(this.value.length){
                  postBtn.attr('disabled', false);
              }
          });
      })
  }

  $(document).ready(function(){
      // Init post comment forms;
      initPostCommentsForms()

      // Init modals;
      // Clean storage with modals;
      localStorage.removeItem('exist-modals')
      initModals();

      // Init read more;
      initReadMoreItems()

      // Check save theme in local storage;
      let selectedTheme = localStorage.getItem('selected-theme')
      const defaultTheme = '{{\Modules\Admin\Entities\Settings::where('key', 'theme')->first()->value}}'

      // If we do not have any theme in storage, we must get in from default system settings;
      if(selectedTheme == null){
          selectedTheme = defaultTheme;
      }

      const switcher = document.getElementById('themeSwitch')

      switch(selectedTheme){
          case 'dark':
              document.body.setAttribute('data-theme', 'dark')
              if(switcher !== undefined) switcher.checked = true
              break
          case 'white':
              document.body.removeAttribute('data-theme')
              if(switcher !== undefined) switcher.checked = false
              break
      }

      // Admin page does not have theme switcher - then we must reset cross style too;
      // Fix for framework styles;
      $('.anim-menu-btn__icon').addClass('cross-fix')
      setTimeout(function(){
          $('.anim-menu-btn__icon').removeClass('cross-fix')
      }, 1)
  })
</script>
@endauth

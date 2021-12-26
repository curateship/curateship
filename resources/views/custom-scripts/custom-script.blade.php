@auth
<script>
  import Scripts from "../../../public/assets/js/scripts";
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
  export default {
      components: {Scripts}
  }
</script>
@endauth

<script>
    const masonryBox = document.querySelector('.masonry-grid')

    if(masonryBox !== null){
        // init Masonry;
        var $grid = new Masonry(masonryBox, {
            gutter: 20,
            //percentPosition: true,
            isFitWidth: true,
            //transitionDuration: 0,
        });

        var infScroll = new InfiniteScroll('.masonry-grid', {
            //path: 'posts/page/@{{#}}',
            path: $('.masonry-path').val() + '@{{#}}',
            append: '.grid-item',
            history: false,
            outlayer: $grid,
            appendCallback: true,
            status: '.loader-ellips'
        });

        infScroll.pageIndex = 0
        infScroll.loadNextPage()

        $('.masonry-grid').on( 'last.infiniteScroll', function( event, body, path ) {
            $('.loader-ellips').hide()
        });

        $('.masonry-grid').on( 'append.infiniteScroll', function( event, body, path, items, response ) {
            $grid.layout();

            $('.preload-box').fadeOut()
        });
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

        @auth
        // Check save theme from DB;
        let theme = '{{\Illuminate\Support\Facades\Auth::user()->getTheme()}}'
        var switchers = document.getElementsByClassName('themeSwitch')

        for(var i = 0; i < switchers.length; i++) {
            (function(index) {
                if(theme === 'dark'){
                    console.log(switchers[index])

                    switchers[index].checked = true
                }

                if(theme === 'white'){
                    switchers[index].checked = false
                }
            })(i);
        }
        @endauth

        // Admin page does not have theme switcher - then we must reset cross style too;
        // Fix for framework styles;
        $('.anim-menu-btn__icon').addClass('cross-fix')
        setTimeout(function(){
            $('.anim-menu-btn__icon').removeClass('cross-fix')
        }, 1)
    })
</script>

<script>
    /* Comments ajax */
    function initPostCommentsForms(){
        // Comments post form;
        $('.commentNewContent').each(function(){
            $(this).text()
            $(this).bind('input propertychange', function() {
                const postBtn = $('.postbtn[data-item-id="' + $(this).attr('data-item-id') + '"][data-type="' + $(this).attr('data-type') + '"]')

                postBtn.attr('disabled', true);

                if(this.value.length){
                    postBtn.attr('disabled', false);
                }
            });
        })
    }

    $(document).on('click', '.cancel-reply', function(){
        $(this).parents('.comment-form-box').remove()
    })

    $(document).on('click', '.post-comment-bnt', function(e){
        e.preventDefault();
        const itemId = $(this).attr('data-item-id');
        const type = $(this).attr('data-type');

        $(this).html('Please wait...');
        const formData = new FormData($('.post-comment-form[data-item-id="' + itemId + '"]')[0]);
        const postResultMessage = $('.post-result-message[data-item-id="' + itemId + '"]');

        let url;
        if(type === 'new'){
            url = '{{route('post-comment-save')}}';
        }

        if(type === 'reply'){
            url = '{{route('post-comment-reply-save')}}';
        }

        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function(response){
                if(type === 'new'){
                    $('.post-comments[data-post-id="' + itemId + '"]').html(response.comments);

                    $('.post-comment-bnt[data-item-id="' + itemId + '"]').html('Post comment');
                    postResultMessage.html(response.result).fadeIn()

                    if(response.error === false){
                        $('.commentNewContent[data-item-id="' + itemId + '"]').val('');
                    }

                    setTimeout(function(){
                        postResultMessage.fadeOut()
                    }, 3000)
                }

                if(type === 'reply'){
                    $('.post-comments[data-post-id="' + response.post_id + '"]').html(response.comments);
                    $('.post-comment-form[data-item-id="' + itemId + '"][data-type="reply"]').parents('.comment-form-box').remove()
                }

                initReadMoreItems()
            }
        });
    })

    $(document).on('click', '.comments__label-btn', function(){
        const $this = $(this)
        const replyId = $this.attr('data-reply-id')

        $('.post-comment-form[data-type="reply"]').parent().remove()

        $.ajax({
            url: "{{route('post-comment-reply')}}?replyId=" + replyId,
            type: 'get',
            contentType: false,
            processData: false,
            success: function(response){
                $this.parents('.comments__comment').after(response)
                initPostCommentsForms()
            }
        });
    })
</script>

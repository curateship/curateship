@auth
<script>
  (function(){
    $(document).on('change', '#filterItems', function(e) {
      e.preventDefault();
      var $this = $(this);
      var url = "{{ url('/admin/comment') }}";
      var url_snippet = $this.find('option:selected').closest('optgroup').attr('data-type');
      if (url_snippet == undefined) {
        url_snippet = 'Status';
      }
      if ($this.val()) {
        url = url + '?' + url_snippet + '=' + $this.val();
      }
      $('meta[name="current-url"]').attr('content', url);

      localStorage.setItem("cs_admin_users_init_tab", $(this).val());

      // loads page content inside this element
      $('#site-table-with-pagination-container').load(url, function() {
        console.log(url)
        // Apply pagination dynamically
        var $tablePaginationBottom = $('#table-pagination-bottom');
        var $tablePaginationTop = $('#table-pagination-top');
        $tablePaginationTop.html(
          ($tablePaginationBottom.length > 0) ?
          $tablePaginationBottom.html() :
          $tablePaginationTop.html('')
        );
      });
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
          console.log('Request failed: ' + textStatus);
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

      console.log(sort, order);
    });

    var currentUserAvatar = '',
      currentDataAvatar = '',
      currentUserCoverPhoto = '',
      currentUserId = '';
    // trigger to show edit user modal form
    $(document).on('click', '.modal-trigger-edit-post', function(e) {
      e.preventDefault();
      // $('.modal-trigger-edit-user').on('click', function() {

      var $this = $(this);
      var url = $this.attr('href');
      var updateURL = $this.data('update-url');
      
      $('#modal-edit-post-form').attr('action', updateURL);
      var $element = $('#ajax-edit-post-form');
      $element.load(url, function(response, status, xhr) {
        
      });
    });

    // Clean trash
    $(document).on('click', '#emptyTrash', function(){
      if(confirm('Are you sure you want to empty the trash?')){
        $(this).closest('form').submit();
      }
    });
    
  })();
</script>
@endauth

$(document).on('click', '.comment-reply', function(e) {
    e.preventDefault();

    var $this = $(this);
    var url = $this.attr('href');
    var saveurl = $this.data('save-url');

    $('#modal-comment-reply-form').attr('action', saveurl);
    var $element = $('#ajax-comment-reply-form');
    $element.load(url, function(response, status, xhr) {
    })
  });

  $('#commentNewContent').text()
  $('#commentNewContent').bind('input propertychange', function() {

    $("#postbtn").attr('disabled', true);

    if(this.value.length){
      $("#postbtn").attr('disabled', false);
    }
});
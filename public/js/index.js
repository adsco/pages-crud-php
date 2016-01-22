$(document).ready(function() {
  $('#summernote').summernote();
  $('.confirm-delete').on('click', function(e){
        if(!confirm('Are you sure?')){
            e.preventDefault();
        }
  });
});
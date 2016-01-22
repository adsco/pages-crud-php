$(document).ready(function(){
    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = new Image(),
                    preview = $('#' + id);
            
                image.src = e.target.result;
                image.onload = function(){
					$input = $(input);
                    if($input.hasClass('banner')){
                        if(this.width != 600 || this.height != 400){
                            input.value = null;
                            alert('Banner must be 600x400');
                            return false;
                        }
                    } else if($input.hasClass('thumbnail')){
                        if(this.width != 200 || this.height != 200){
                            input.value = null;
                            alert('Thumbnail must be 200x200');
                            return false;
                        }
                    }
                    
                    preview.attr('src', e.target.result);
                    preview.removeClass('hidden');
                };
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image-upload").change(function(){
        readURL(this, this.getAttribute('data-preview'));
    });
});
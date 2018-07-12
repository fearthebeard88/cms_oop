$(document).ready(function() {
    var image_src;
    var image_split;
    var image_id;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop('disabled', false);
        var user_id = $.urlParam('id');
        $.ajax({
            url: 'edit_user.php',
            data: user_id,
            success: console.log(user_id),
            dataType: 'string'
        });
        image_src = $(this).prop("src");
    image_split = image_src.split("/");
    image_id = image_split[image_split.length-1];
    alert(image_id);
    
    tinymce.init({ selector:'textarea' });
    })
    
})

$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return decodeURI(results[1]) || 0;
    }
}


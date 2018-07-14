$(document).ready(function() {
    var user_id;
    var image_src;
    var image_split;
    var image_name;
    var photo_id;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop('disabled', false);
        user_id = $.urlParam('id');
        $.ajax({
            url: 'ajax_code.php',
            data: user_id,
            success: console.log(user_id),
            dataType: 'string'
        });
        image_src = $(this).prop("src");
        image_split = image_src.split("/");
        image_name = image_split[image_split.length-1];
        photo_id = $(this).attr("data");

        $.ajax({
            url: "includes/ajax_code.php",
            data: {photo_id:photo_id},
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    $("#modal_sidebar").html(data);
                }
            }
        })
    });

    // edit_photo.php sidebar
    $(".info-box-header").click(function() {
        $(".inside").slideToggle("slow");
        $("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon");
    });

tinymce.init({ selector:'textarea' });

    $("#set_user_image").click(function() {
        $.ajax({
            url: "includes/ajax_code.php",
            data: {
                image_name: image_name,
                user_id: user_id
            },
            type: "POST",
            success: function(data) {
                if(!data.error) {
                    $(".user_image_box a img").prop('src', data);                }
            }
        })
    });
    
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


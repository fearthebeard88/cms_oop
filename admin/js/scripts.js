$(document).ready(function() {
    var user_id;
    var image_src;
    var image_split;
    var image_name;

    $(".modal_thumbnails").click(function() {
        $("#set_user_image").prop('disabled', false);
        user_id = $.urlParam('id');
        $.ajax({
            url: 'edit_user.php',
            data: user_id,
            success: console.log(user_id),
            dataType: 'string'
        });
        image_src = $(this).prop("src");
    image_split = image_src.split("/");
    image_name = image_split[image_split.length-1];
    
    tinymce.init({ selector:'textarea' });
    })

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
                    alert(image_name);
                }
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


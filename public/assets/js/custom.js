$(function (){
    /* JQUERY UI SORTABLE */
    $( "#sortable" ).sortable({
        update: function (event, ui){
            let url  = $(this).data("url");
            let csrf = $(this).data("csrf");
            var data = $("#sortable").sortable('toArray');
            $.ajax({
                type: "POST",
                async: true,
                url: url,
                data: {_token:csrf, data:data},
                dataType: 'json',
                error: function(data) { return false; },
                success: function(data) { return false; }
            });
        }
    });
});

/* postForm */
$(document).on("submit",".postForm",function(e){
    e.preventDefault();
    var post = $(this);
    $.ajax({
        type: post.attr("method"),
        url: post.attr("action"),
        data: new FormData(post[0]),
        processData: false,
        contentType: false,
        dataType: 'json',

        uploadProgress: function(event, position, total, percentComplete) {

            swal({

                title: "Yükleniyor",

                text : "Lütfen bekleyiniz",

                type : "info",

                showConfirmButton: false

            });

        },

        beforeSend: function(){

            swal({

                title: "Yükleniyor",

                text : "Lütfen bekleyiniz",

                type : "info",

                showConfirmButton: false

            });

        },

        success: function(data) {

            if(data.title){

                if(data.reload){

                    sweetAlert({

                            title	: data.title,

                            text 	: data.message,

                            type	: data.type

                        },

                        function(){

                            if(data.url){

                                location.href = data.url;

                            }else{

                                window.location.reload(true);

                            }



                        });

                }else{

                    sweetAlert(data.title,data.message,data.type);

                }

            }else{

                if(data.message){

                    location.href = data.message;

                }else{

                    window.location.reload(true);

                }

            }
            return false;
        }
    });
});

/* MENU */
$("select[name=hrefTypes]").change(function(){
    let val = $(this).val();
    $(".menuDiv select[name='href'], .menuDiv input[name='href']").attr("disabled");
    $(".menuDiv .form-group").hide();
    $("#"+val).find("select[name='href'], input[name='href']").removeAttr('disabled');
    $("#"+val).show(500);
});

/* TABLE MULTIPLE ROW START */
$("#table_add_row").click(function(){
    let clone = $("table tbody tr:last-child").clone();
    clone.find("input").val('');
    clone.appendTo("table tbody");
});

$(document).on("click",".delete-table-row",function(){
    $(this).closest("tr").remove();
});
/* TABLE MULTIPLE ROW END */

/* Post function built for inline elements */
function postInput(type,id, token, method = "POST"){
    $.post(type,{id:id, _token:token, _method:method},function(data){

        sweetAlert({

                title	: data.title,

                text 	: data.message,

                type	: data.type

            },

            function(){

                if(data.url){

                    location.href = data.url;

                }else{

                    window.location.reload(true);

                }

            });

    }, "json");
}




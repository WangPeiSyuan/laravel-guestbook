$(function(){

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#ajax').click(function() {
    $.ajax({
        url: "/post",
        data: {
            content: $("#message-name").val()

        },
        type: "POST",
        dataType: "json",
        success: function(data,statusTxt,xhr) {
            console.log(data.message);
            $('#all-post').append("<div class='panel panel-info'><div class='panel-heading' style='background-color: #29c1d8; color: white;'>的貼文</div><div class='panel-body' style='word-break:break-all; word-wrap:break-all;'>"+data.message+"</div><div class='panel-body' style='padding: 0 15px; text-align: right;'><!--留言按鈕--><a href='http://127.0.0.1:8000/post/"+data.id+"/messages' style='color: black;'><i class='glyphicon glyphicon-comment'></i></a><!--刪除按鈕 --><form action='http://127.0.0.1:8000/post/"+data.id+"' method='DELETE' style='display: inline-block;'><button type='submit' id='delete-post-"+ data.id +"' class='btn' style='background-color: transparent;'><i class='glyphicon glyphicon-trash'></i></button></form><!--編輯按鈕--><form action='http://127.0.0.1:8000/post/"+data.id+"/edit' method='GET' style='display: inline-block;'><button type='submit' id='edit-post-"+data.id+"' class='btn' style='background-color: transparent;'><i class='glyphicon glyphicon-pencil'></i></button></form></div></div> ")
        },
        error: function() {
            console.log("fail");
        },
        complete: function() {
        } 
    });
});
 
});
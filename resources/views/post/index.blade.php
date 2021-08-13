@extends('layouts.app')

@section('content')
<!-- 顯示驗證錯誤 -->
@include('common.error')
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8" >
      <div class="panel-body">
        <!--新留言的表單-->
        <form action="{{ url('post') }}" method="POST" class="form-horizontal" >
             {{ csrf_field() }}
             <!--留言內容-->
             <!-- <input type="text" name="post_id" value=1 style="display:none;"> -->
             <div class="form-group text-center">
                <h4>我要留言</h4><br>
                <div >
                   <textarea name="content"  id="message-name" rows="8" style='width: -webkit-fill-available;'></textarea>
                </div>
              </div>
           <!--增加留言功能-->
           <div class="form-group" style="margin-top: 20px;">
            <div class="col-sm-offset-10 col-sm-2">
               <button type="submit" class="btn btn-info">
                  發布
              </button>
          </div>
      </div>
  </form>
      
    </div>
        <!--顯示留言內容-->
        <div id="all-post">
        @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="panel panel-info" id="post-panel-{{ $post->id }}">
            <div class="panel-heading " style="background-color: #29c1d8; color: white;">
                {{$post->user->name}}的貼文
            </div>
            <div class="panel-body" style="word-break: break-word; white-space: pre-line;">{{ $post->content }}</div>
                <div class="panel-body" style="padding: 0 15px; text-align: right; ">
                    <!--留言按鈕-->
                    <a href="{{ url('post/'.$post->id.'/messages') }}" style="color: black;"> <i class="glyphicon glyphicon-comment"></i></a>

                    <!--刪除按鈕 -->
                    @if (Auth::user()->id==$post->user_id)
                  
                    <!-- <form action="{{ url('post/'.$post->id) }}" method="POST" style="display: inline-block;">
                      {!! csrf_field() !!}
                      {!! method_field('DELETE') !!}

                      <button type="submit" data-id="{{ $post->id }}" id="delete-btn" class="btn" style="background-color: transparent;">
                       <i class="glyphicon glyphicon-trash"></i>
                      </button>
                    </form> -->
                    <!--編輯按鈕-->
                    <form action="{{ url('post/'.$post->id.'/edit') }}" method="GET" style="display: inline-block;">
                      <button type="submit" id="edit-post-{{ $post->id }}" class="btn" style="background-color: transparent;">
                       <i class="glyphicon glyphicon-pencil"></i>
                      </button>
                    </form>  
                    <a href="{{ route('post.destroy',$post->id) }}" data-id="{{$post->id}}" id="delete-btn" style="color: black;">Delete</a>
                    @endif
                </div>
                     

            
        </div> 
        @endforeach
        @endif
        </div>
        
      <div style="position: fixed; bottom: 30px; right: 30px">
          <i class="far fa-arrow-alt-circle-up" style="font-size: 50px;" id="go-down"></i>
      </div>
<script type="text/javascript">
  $(document).ready(function () {
    
    /* 按下GoTop按鈕時的事件 */
    $('#go-down').click(function(){
        $('html,body').animate({ scrollTop: 0}, 'slow');
        // window.scrollTo(0,document.body.scrollHeight);
        return false;
    });
    
 $("body").on("click","#delete-btn",function(e){

    if(!confirm("確定刪除?")) {
       return false;
     }

    e.preventDefault();
    var id = $(this).data("id");
    
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;
    console.log(id);
    console.log(url);
    $.ajax(
        {
          url: url.href, //or you can use url: "company/"+id,
          type: 'DELETE',
          data: {
            _token: token,
                id: id
        },
        success: function (response){
            $("#success").html(response.message);
            
            $("#post-panel-"+id).remove();
        },
        error: function() {
            console.log(url);
        },
     });
      return false;
   });
    

});
</script>

</div>
</div>

@endsection
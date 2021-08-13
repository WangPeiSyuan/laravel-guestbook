@extends('layouts.app')

@section('content')
<link href="{{ URL::asset('css/message.css') }}" rel="stylesheet" type="text/css"/>

<div class="container">
<div class="row justify-content-md-center">

<div class="col-md-6 ">
<h3 class="text-center" style="color: cadetblue;">{{ $post->user->name }}的貼文</h3>
   
    <div class="breadcrumb" id="post_name" style=" background-color: #e3ecf9; border-radius: 6px;  padding: 20px; margin-top: 50px ">
        <div id="post_conntent" style="word-break: break-word; white-space: pre-line;">
            {{ $post->content }}
        </div>
    </div>
    @if(count($messages)>0)
    
    <table class="table table-hover" >
        @foreach ($messages as $message)
        <tr id="message-{{$message->id}}" class="message">
            <td style="color: cadetblue; width: 20%">{{ $message->user->name }}</td>
            <td style="width: 70%; word-break: break-word;  white-space: pre-line;">{{ $message->content }}</td>
            @if (Auth::user()->id==$post->user_id)
            <td style="text-align: right;">
                <a href="{{ url('post/'.$post->id.'/messages/'.$message->id) }}" data-id="{{$message->id}}" id="delete-btn" style="color: black; font-size: 11px">刪除</a>
                <!-- <form action="{{ url('post/'.$post->id.'/messages/'.$message->id) }}" method="POST" style="display: inline-block;">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                    <button type="submit" id="delete-post-{{ $post->id }}" class="btn" style="background-color: transparent;">
                       <i class="glyphicon glyphicon-trash"></i>

                    </button>
                </form> -->
            </td>
            @endif
        </tr>
       
    @endforeach
    </table> 

    @endif
    <form method="POST" action="#">
        {{ csrf_field() }}
        <div class="form-group" style="margin-top: 30px">
            <textarea name="content" class="form-control"></textarea>
        </div>
        <div class="text-center">        
            <button type="submit" class="btn btn-info">留言</button>
            <input type ="button" class="btn btn-info" onclick="javascript:location.href='{{ url('post')}}'" value="返回" ></input>
        </div>

    </form>
   <a href="{{ url('post') }}" style="color: black;" > 

    
</div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function () {

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
            $("#message-"+id).remove();
        },
        error: function() {
            console.log(url);
        },
     });
      return false;
   });
    

});
</script>
@endsection
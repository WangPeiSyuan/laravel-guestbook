<script type="text/javascript">
    function getcontent(){
        var content = document.getElementById('contentdiv').textContent;
        var text = document.getElementById('contenttext');
        text.value=content;
    }
</script>
@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">

    <!-- <div class="breadcrumb">Origin Message: {{ $post->content }}</div> -->

    <form method="POST" action="{{ url('post/'.$post->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div id="contentdiv" style="word-break:break-all; word-wrap:break-all; background-color: #dee2e6; padding: 10px; border-radius: 10px; margin: 30px" contenteditable >{{ $post->content }}</div>
        <textarea name="content" id="contenttext" hidden></textarea>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-info" onclick="getcontent()";>更新</button>
            <input type ="button" class="btn btn-info" onclick="javascript:location.href='{{ url('post')}}'" value="返回" ></input>
        </div>
    </form>

</div>
</div>
</div>
@endsection
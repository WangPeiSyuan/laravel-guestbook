<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Message;
use DB; 

class MessageController extends Controller
{
    public function showmessage($id)
	{	
		// $notes = $request->post()->get();
		// $post = DB::table('posts')->where('id',$id)->first();
		$post = Post::find($id);
		$messages = Message::where('post_id', $id)->get();
		// $messages = DB::table('messages')->where('post_id', $id)->get();
	    return view('post.show',['messages'=>$messages, 'post'=>$post]);
	}

    public function store(Request $request, Post $post)
	{
		// dd($request->all());
	    // $post->message()->create([
	    //     // 'content' => $request->content

	    // ]);
	    $request->user()->messages()->create([
	    	'content' => $request->content,
	    	'post_id' => $post->id
	    ]);
	    return back();
	}
	public function destroy(Request $request,$post, $id)
	{	

		// dd($post_user);
		// $message->delete();
		// return redirect('/post/'.$post.'/messages');
		$message = Message::find($id);
      	$message->delete();
      	return response()->json([
        	'message' => 'Data deleted successfully!'
      	]);

	}
}

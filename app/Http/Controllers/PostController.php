<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //user必須登入才能做這些動作
    }

    public function index(Request $request)	//顯示所有post
	{
    	$posts = Post::whereNotNull('updated_at')->orderby('updated_at','desc')->get();
    	// dd($posts);
    	$users = User::all();
	    return view('post.index',['posts'=>$posts]); 
	}

	public function store(Request $request){ //新增post
		// dd($request->all()); 
		if($request->content!=null){
		$request->user()->post()->create([
        'content' => $request->content,
    	]);
   
		
		}
	return redirect('/post');
		// $request->user()->post()->create([
		// 	'content' => $request->content,
		// ]);
		// return response()->json(['success'=>'Form is successfully submitted!']);
		
	
	}

	public function destroy(Request $request, $id){ //刪除
		// 
		// $post->delete();
		// return redirect('/post');
		$post = Post::find($id);
		$this->authorize('destroy', $post);
      	$post->delete();
      	return response()->json([
        	'message' => 'Data deleted successfully!'
      	]);
	}

	
	//編輯
	public function edit(Request $request, Post $post){ //畫面
		// dd($post);
	
		// $this->authorize('get', $post);
		if($request->user()->id==$post->user_id){
			return view('post.edit',compact('post'));
		}else
			abort('403');
	}

	public function update(Request $request, Post $post){ //更新
		$this->authorize('update',$post);
		$post->update([
			'content'=>$request->content
		]);
		return redirect('/post');
	}

	// public function get_user(Post $post){
	// 	User::find(1)
	// 	$name = DB::table('user')->where('id',$id)->first();
	// 	return view('post.',['messages'=>$messages, 'post'=>$post]);


	// }

}

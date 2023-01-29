<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // get all post
    public function getAllPost(){
        $post = Post::orderBy('created_at','desc')->get();
        return response()->json([
            'status' => 'success',
            'post' => $post
        ]);
    }

    // post search
    public function postSearch(Request $request){
        $post = Post::where('title','LIKE','%'.$request->key.'%')
                ->orderBy('created_at','desc')->get();
        return response()->json([
            'searchData' => $post
        ]);
    }

    // post detials
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('post_id',$id)->first();
        return response()->json([
            'post' => $post
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    // trend post list
    public function index(){
        $post = ActionLog::select('action_logs.*','posts.*',DB::raw('COUNT(action_logs.post_id) as post_count'))
                ->leftJoin('posts','posts.post_id','action_logs.post_id')
                ->groupBy('action_logs.post_id')
                ->orderBy('post_count','desc')
                ->when(request('key'),function($query){
                        $query  ->where('title','LIKE','%'.request('key').'%')
                                ->orWhere('action_logs.post_id','LIKE','%'.request('key').'%');
                })->get();
        return view('admin.trend_post.index',compact('post'));
    }

    // details trend post
    public function details($id){
        $details = Post::where('post_id',$id)->first();
        // dd($details->toArray());
        return view('admin.trend_post.details',compact('details'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // direct post list page
    public function index(Request $request){
        $data = Post::when(request('key'),function($query){
                $query  ->where('title','LIKE','%'.request('key').'%')
                        ->orWhere('category_id','LIKE','%'.request('key').'%')
                        ->orWhere('post_id','LIKE','%'.request('key').'%');
        })->paginate(4);
        return view('admin.post.index',compact('data'));
    }

    // create post page
    public function createPage(){
        $categories = Category::get();
        return view('admin.post.create',compact('categories'));
    }

    // create post
    public function create(Request $request){
        $validator = $this->postValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)
                         ->withInput();
        }
        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);
            $data = $this->getPostData($request,$fileName);
        }else{
            $data = $this->getPostData($request,NULL);
        }

        Post::create($data);
        return redirect()->route('admin#post')->with(['createSuccess' => 'Post Created Successfully!']);
    }

    // delete post
    public function delete($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData->image;

        Post::where('post_id',$id)->delete();
        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        return back()->with(['deleteSuccess' => 'Post Deleted Successfully!']);
    }

    // edit post
    public function edit($id){
        $post = Post::where('post_id',$id)->first();
        $categories = Category::get();
        return view('admin.post.edit',compact('post','categories'));
    }

    // update post
    public function update($id,Request $request){
        $validator = $this->postValidationCheck($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->requestUpdateData($request);

        if(isset($request->postImage)){
            // get from client
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();

            // put new image to data array
            $data['image'] = $fileName;

            // get image name from database
            $postData = Post::where('post_id',$id)->first();
            $dbImageName = $postData->image;

            // delete image from public folder
            if(File::exists(public_path().'/postImage/'.$dbImageName)){
                File::delete(public_path().'/postImage/'.$dbImageName);
            }

            // store under public folder
            $file->move(public_path().'/postImage',$fileName);

            // update new data with new image
            Post::where('post_id',$id)->update($data);
        }else{
            Post::where('post_id',$id)->update($data);
        }
        return redirect()->route('admin#post')->with(['updateSuccess' => 'Post Updated Successfully!']);
    }

    // post validation check
    private function postValidationCheck($request){
        return Validator::make($request->all(),[
            'postTitle' => 'required|min:4',
            'postDescription' => 'required|min:15',
            'postCategory' => 'required',
        ]);
    }

    // get post data
    private function getPostData($request,$fileName){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory
        ];
    }

    // request update data
    private function requestUpdateData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now()
        ];
    }
}

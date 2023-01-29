<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // // admin list
    public function index(Request $request){
        $userData = User::when(request('key'),function($query){
                $query->where('name','LIKE','%'.request('key').'%')
                    ->orWhere('email','LIKE','%'.request('key').'%')
                    ->orWhere('phone','LIKE','%'.request('key').'%')
                    ->orWhere('gender','LIKE','%'.request('key').'%');
        })->paginate(5);
        return view('admin.list.index',compact('userData'));
    }

    // public function index(){
    //     $userData = User::select('id','name','email','gender','phone','address')->get();
    //     return view('admin.list.index',compact('userData'));
    // }

    // delete account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'User Account Deleted Successfully']);
    }

}

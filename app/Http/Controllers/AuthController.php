<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // user login and release token
    public function login(Request $request){
        // email password
        $user = User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
            }
        }else{
            return response()->json([
                'user' => null,
                'token' => null
            ]);
        }
    }

    // user register
    public function register(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        User::create($data);
        $user = User::where('email',$request->email)->first();
        return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken
                ]);
    }

    // category list
    public function categoryList(){
        $category = Category::get();
        return response()->json([
            'message' => $category
        ]);
    }

}

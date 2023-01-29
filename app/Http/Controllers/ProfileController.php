<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // direct admin home page
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id','name','address','phone','email','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('user'));
    }

    // update admin account
    public function updateAdminAccount(Request $request){
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin Account Updated Successfully!']);
    }

    // change password page
    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    // change password
    public function changePassword(Request $request){
        $validator = $this->changePasswordValidationCheck($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashUserPassword = Hash::make($request->newPassword);
        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];
        if(Hash::check($request->oldPassword,$dbPassword)){
            User::where('id',Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard')->with(['success'=>'Password Change Successfully!']);
        }else{
            return back()->with(['fail'=>'Old Password Do not Match!']);
        }
    }

    // get user info
    private function getUserInfo($request){
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'phone' => $request->adminPhone,
            'address' => $request->adminAddress,
            'gender' => $request->adminGender,
            'updated_at' => Carbon::now()
        ];
    }

    // user validation check
    private function userValidationCheck($request){
        return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ],[
            'adminName.required' => 'The name field is required.',
            'adminEmail.required' => 'The email field is required.'
        ]);
    }

    // password validation check
    private function changePasswordValidationCheck($request){
        return Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6|max:15',
            'confirmPassword' => 'required|min:6|max:15|same:newPassword',
        ]);
    }
}

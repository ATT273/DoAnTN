<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Bill;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    
    public function postLogin(Request $request){
    	
    	
    	if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    		return redirect('index');
    	}
    	else{
    		return redirect('login')->with('thongbao','Failed to login '.$request->email.' '.$request->password);
    	}
    // 	echo $request->username.' '.$request->password;
    }

    public function postAdminLogin(Request $request){
        
        
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login')->with('thongbao','Failed to login: Email or password is invalid');
        }
    //  echo $request->username.' '.$request->password;
    }

    public function postRegister(Request $request){
        $this->validate($request,
        [
            'password' => 'required|min:6|confirmed',
            'username' => 'required|unique:users,username',
            'fullname' => 'required|regex:/^[a-zA-Z][a-zA-Z\s]*$/',
            'email' => 'required'
        ],
        [
            'password.required' => 'Type in your Password',
            'password.min' => 'Your password need at least 6 character',
            'password.confirmed' => 'Confirm password did not match',
            'username.required' => 'Input your username',
            'username.unique' => 'username has been used',
            'fullname.required' => 'Input your fullname',
            'fullname.regex' => 'no special characters and numbers are allowed',
            'email.required' => 'input your email'

        ]);
        $user = new User;
        $user->username = $request->username;
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();
         return redirect('login')->with('thongbao','Registered successfully! Please Login your account');
    }
    public function getLogout(){
        Auth::logout();
        return redirect('index');
    }

    public function getDanhsach(){
        $users = User::all();
        return view('admin.user.danhsach_user',['users'=>$users]);
    }
    public function getAdd(){
        return view('admin.user.add');
    }
    public function getEdit($id){
        $user = User::find($id);
        return view('admin.user.edit',['user'=>$user]);
    }

    public function getUserProfile($id){
        $user = User::find($id);
        $bill = Bill::where('user_id',$id)->get();
        return view('admin.user.profile_user',['user' => $user, 'bills' => $bill]);
    }
}

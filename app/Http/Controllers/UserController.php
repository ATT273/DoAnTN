<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Bill;
use App\Http\Requests;
use Validator;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    
    public function postLogin(Request $request){
    	
    	
    	if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $receiver = $payer = Auth::user()->name;
            $receiver_phone = $payer_phone =  Auth::user()->phone;
            $shipping_address = $billing_address = Auth::user()->address;
            Session::put('checkout_info',
                [
                    'receiver' => $receiver,
                    'receiver_phone' => $receiver_phone,
                    'shipping_address' => $shipping_address,
                    'payer' => $payer,
                    'payer_phone' => $payer_phone,
                    'billing_address' => $billing_address,
                ]);
            Session::save();
            if($request->has('to_checkout')){
                Session::forget('to_checkout');
                
                return redirect('checkout');
            }else{
                return redirect('index');
            }
    		
    	}
    	else{
    		return redirect('login')->with('thongbao','Failed to login ');
    	}
    }

    public function postAdminLogin(Request $request){
        
        
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
            $receiver = $payer = Auth::user()->name;
            $receiver_phone = $payer_phone =  Auth::user()->phone;
            $shipping_address = $billing_address = Auth::user()->address;
            Session::put('checkout_info',
                [
                    'receiver' => $receiver,
                    'receiver_phone' => $receiver_phone,
                    'shipping_address' => $shipping_address,
                    'payer' => $payer,
                    'payer_phone' => $payer_phone,
                    'billing_address' => $billing_address,
                ]);
            Session::save();
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login')->with('thongbao','Failed to login: Email or password is invalid');
        }
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
        Session::forget('cart');
        Session::forget('checkout_info');
        return redirect('index');
    }

    public function getDanhsach(){
        $users = User::paginate(5);
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
        $bills = Bill::where('user_id',$id)->get();
        return view('admin.user.profile_user',['user' => $user, 'bills' => $bills]);
    }

    public function getSearchUser(Request $request){
        if($request->has('keyword')){
            $users = User::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('username','LIKE', '%'.$request->keyword.'%')->orWhere('email','LIKE', '%'.$request->keyword.'%')->paginate(2);
            $users->appends(['keyword' => $request->keyword]);
            return view('admin.user.danhsach_user',['users'=>$users]);
        }else{
            return redirect('admin/user/danhsach-users');
        }
    }

    public function postEditProfile(Request $request,$id){
        $this->validate($request,
            [
                'phone' => 'numeric',
            ],
            [
                'phone.numeric' => 'Phone must be number',
            ]);
        $user = User::find($id);
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        return redirect()->back()->with('thongbao','Updated successfully');
    }


    public function getSetAdmin($id){
        $user = User::find($id);
        if($user->role == 1){
            $user->role = 0;
            $user->save();
        }elseif ($user->role == 0) {
            $user->role = 1;
            $user->save();
        }
        return redirect('admin/user/danhsach-users')->with('thongbao','Set role successfully');
    }
 // Api function
    public function postAdminLoginApi(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $admin  = Auth::user();
            $user = User::all();
            $bill = Bill::all();
            $user_count = count($user);
            $bill_count = count($bill);
            $response["status"] = 200;
            $response["message"] = 'Login Success';
            $response["user_count"] = $user_count;
            $response["bill_count"] = $bill_count;
            $response["admin"] = $admin;
        } else{
            $response["status"] = 205;
            $response["message"] = 'Login Fail';
        }

        return response()->json($response);
    }

    public function postLoginApi(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user  = Auth::user();
            $response["status"] = 200;
            $response["message"] = 'Login Success';
            $response["user"] = $user;
        }
        else{
            $response["status"] = 205;
            $response["message"] = 'Login Fail';
        }
    return response()->json($response);
    }

    public function getDanhsachApi(){
        $users = User::paginate(5);
        $response["status"] = 200;
        $response["users"] = $users;
        return response()->json($response);
    }

    public function getUserProfileApi($id){
        $bills = Bill::where('user_id',$id)->get();

        $response["status"] = 200;
        $response["bills"] = $bills;

        return response()->json($response);
    }

    public function postRegisterApi(Request $request){
        $rules = [
                'username' => 'required|unique:users,username',
                 'fullname' => 'required|regex:/^[a-zA-Z][a-zA-Z\s]*$/',
            ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $user = new User;
            $user->username = $request->username;
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }

        return response()->json($response);
    }
}

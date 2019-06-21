<?php

namespace App\Http\Controllers;
use App\User;
use App\Bill;
use App\BillDetail;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getAdminDashboard(){
        $user = User::all();
        $bill = Bill::all();
    	return view('admin.dashboard.dashboard',['users'=>$user, 'bills'=>$bill]);
    }
    public function getAdminlogin(){
    	return view('layouts.admin.admin_login');
    }
    public function getlogin(){
    	return view('customer.login');
    }

    public function getRegister(){
        return view('customer.register');
    }

    public function getIndex(){
        $categories = Category::all();
        $newProducts = Product::orderBy('id','DESC')->take(4)->get();
        $topProduct = Product::orderBy('sold','DESC')->take(4)->get();
        return view('customer.index',['categories' => $categories]);
    }
}
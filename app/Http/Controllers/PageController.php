<?php

namespace App\Http\Controllers;
use App\User;
use App\Bill;
use App\BillDetail;
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
    	return view('login');
    }

    public function getIndex(){
        return view('customer.index');
    }
}
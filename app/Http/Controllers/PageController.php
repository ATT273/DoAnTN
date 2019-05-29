<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getAdminDashboard(){
    	return view('admin.dashboard.dashboard');
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
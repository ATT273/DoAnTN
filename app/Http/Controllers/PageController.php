<?php

namespace App\Http\Controllers;
use App\User;
use App\Bill;
use App\BillDetail;
use App\Category;
use App\Product;
use App\Slide;
use App\ProductType;
use App\ProductImage;
use App\Tag;
use Validator;
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
        $categories = Category::all();
    	return view('customer.login',['categories' => $categories]);
    }

    public function getRegister(){
        $categories = Category::all();
        return view('customer.register',['categories' => $categories]);
    }

    public function getIndex(){
        $categories = Category::all();
        $newProducts = Product::orderBy('id','DESC')->take(4)->get();
        $topProducts = Product::orderBy('sold','DESC')->take(4)->get();
        $banners  = Slide::all();
        return view('customer.index',['categories' => $categories, 'banners' => $banners, 'newProducts' => $newProducts, 'topProducts' => $topProducts]);
    }

    public function getDetailProduct($id){
        $product = Product::findOrFail($id);
        
        $relatedProducts = Product::where('type_id',$product->type_id)->take(4)->get();
        $categories = Category::all();
        $tags = Tag::whereIn('id',$product->tag()->allRelatedIds())->get();
        return view('customer.product_detail',['product' => $product, 'categories' => $categories, 'relatedProducts' => $relatedProducts, 'tags' => $tags]);
    }
}
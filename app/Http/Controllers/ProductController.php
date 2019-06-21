<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\ProductType;
use App\ProductImage;
use App\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getDanhsach(){
    	$products = Product::all();
    	return view('admin.product.danhsach_product',['products' => $products]);
    }

    public function getAdd(){
    	$productTypes  = ProductType::all();
    	return view('admin.product.them_product',['productTypes' => $productTypes]);
    }
}

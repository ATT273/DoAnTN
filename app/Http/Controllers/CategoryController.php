<?php

namespace App\Http\Controllers;
use App\Category;
use App\ProductType;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function getDanhsach(){
    	$category = Category::all();
    	return view('admin.category.danhsach_category',['category'=> $category]);

    }

    public function getAdd(){
    	return view('admin.category.them_category');
    }

    public function postAdd(Request $request){
    	$this -> validate($request,
    		[
    			'category'=>'required|unique:category,name| min:3| max:100'
    		],
    		[
    			'category.required'=>'chua nhap ten the loai',
    			'category.unique'=> 'Ten da bi trung',
    			'category.min'=>'Ten co do dai tu 3 den 100 ky tu',
    			'category.max'=>'Ten co do dai tu 3 den 100 ky tu'
    		]
    	);
    	$category = new Category;
    	$category->name = $request->category;
    	$category->lowcase_name = changeTitle($request->category);
    	$category->save();

    	return redirect('admin/category/add')->with('thongbao','Added Successfully');
    	// echo changeTitle($request->category);
    	// echo $category->lowcaseName;
    }

    public function getEdit($id){
    	$category = Category::find($id);
    	return view('admin.category.sua_category',['category'=>$category]);
    }

    public function postEdit(Request $request,$id){
    	
    	$this->validate($request,
    		[
    			'category' => 'required|unique:category,name|min:3|max:100'
    		],
    		[
    			'category.required'=>'Ban chua nhap ten moi',
    			'category.unique'=> 'Ten da bi trung',
    			'category.min'=>'Ten co do dai tu 3 den 100 ky tu',
    			'category.max'=>'Ten co do dai tu 3 den 100 ky tu'
    		]
    	);
    	$category = Category::find($id);
    	$category->name = $request->category;
    	$category->lowcase_name = changeTitle($request->category);
    	$category->save();
    	return redirect('admin/category/edit/'.$category->id)->with('thongbao','Updated Successfully');
    }

    public function getDel($id){
        $category = Category::find($id);
        $category->delete();
        return redirect('admin/category/danhsach_category')->with('thongbao','Delete  Successfully');
    }
}

<?php

namespace App\Http\Controllers;
use App\Category;
use App\ProductType;
use App\Product;
use Validator;
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
    			'category' => 'required|min:3|max:100'
    		],
    		[
    			'category.required'=>'Ban chua nhap ten moi',
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
        $count = count($category->product);
        
        if ($count > 0) {
            return redirect('admin/category/danhsach-danhmuc')->with('loi','cannot delete because there are many products belong to this category');
        }elseif ($count == 0) {
            $category->delete();
            return redirect('admin/category/danhsach_category')->with('thongbao','Delete  Successfully');
        }
        
    }

    // Api function

    public function getDanhSachApi(){
        $category = Category::all();
        $response["status"] = 200;
        $response["category"] = $category;
        return response()->json($response);
    }

    public function postAddApi(Request $request){
        $rules = [
                'category'=>'required|unique:category,name| min:3| max:100'
            ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $category = new Category;
            $category->name = $request->category;
            $category->lowcase_name = changeTitle($request->category);
            $category->save();

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }

        return response()->json($response);
    }

    public function postEditApi(Request $request, $id){
        $rules = [
                'category' => 'required|unique:category,name|min:3|max:100'
            ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $category = Category::find($id);
            $category->name = $request->category;
            $category->lowcase_name = changeTitle($request->category);
            $category->save();

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }
        
        return response()->json($response);
    }

    public function getDelApi($id){
        $category = Category::find($id);
        $count = count($category->product);
        
        if ($count > 0) {
            $response["status"] = 501;
            $response["message"] = "cannot delete because there are many products belong to this category";
        }elseif ($count == 0) {
            $category->delete();
            $response["status"] = 200;
            $response["message"] = "success";
        }

        return response()->json($response);
    }
}

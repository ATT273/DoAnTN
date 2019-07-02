<?php

namespace App\Http\Controllers;
use App\ProductType;
use App\Product;
use App\Category;
use Validator;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    //
	//List Product Type
    public function getDanhsach(){
    	$productTypes = ProductType::all();

    	return view('admin.product_type.danhsach_producttype',['prtypes' => $productTypes]);
    }

    //Add product type
    public function getAdd(){
    	$categories = Category::all();
    	return view('admin.product_type.them_producttype',['categories' => $categories]);
    }
    public function postAdd(Request $request){
    	$this->validate($request,
    	[
    		'product_type' => 'required|unique:type_product,name',
    	],
    	[
    		'product_type.required' => 'Please Enter Product Type Name',
    		'product_type.unique' => 'You have already added this product type',
    	]);

    	$product_type = new ProductType;
    	$product_type->name = $request->product_type;
    	$product_type->lowcase_name = changeTitle($request->product_type);
    	$product_type->category_id = $request->category;
    	$product_type->save();

    	return redirect('admin/product_type/add')->with('thongbao','Added Successfully');
    }

    //Edit product type
    public function getEdit($id){
    	$categories = Category::all();
    	$productTypes = ProductType::find($id);

    	return view('admin.product_type.sua_producttype',['categories' => $categories, 'prtypes' => $productTypes]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'category' => 'required',
    			'product_type' => 'required',
    		],
    		[
    			'category.required' => 'Please choose Category',
    			'product_type.required' => 'Please Enter Product Type Name',
    			
    		]);

    	$productType = ProductType::find($id);
    	$productType->category_id = $request->category;
    	$productType->name = $request->product_type;
    	$productType->lowcase_name = changeTitle($request->product_type);
    	$productType->save();
    	return redirect('admin/product_type/danhsach-loaisp')->with('thongbao','Update Successfully');
    }

    //Delete product type

    public function getDel($id){
        $productType = ProductType::find($id);
        $count = count($productType->product);
        
        if ($count > 0) {
            return redirect('admin/product_type/danhsach-loaisp')->with('loi','cannot delete because there are many products belong to this product type');
        }elseif ($count == 0) {
            $category->delete();
            return redirect('admin/product_type/danhsach_loaisp')->with('thongbao','Delete  Successfully');
        }
    }

    // Api function
    public function getDanhSachApi(){
        $productTypes = ProductType::all();
        $categories = Category::all();
        $response["status"] = 200;
        $response["productTypes"] = $productTypes;
        $response["categories"] = $categories;
        return response()->json($response);
    }

    public function postAddApi(Request $request){
        $rules = [
                'product_type' => 'required|unique:type_product,name',
            ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $product_type = new ProductType;
            $product_type->name = $request->product_type;
            $product_type->lowcase_name = changeTitle($request->product_type);
            $product_type->category_id = $request->category;
            $product_type->save();

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
                'category' => 'required',
                'product_type' => 'required|unique:type_product,name',
            ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $productType = ProductType::find($id);
            $productType->category_id = $request->category;
            $productType->name = $request->product_type;
            $productType->lowcase_name = changeTitle($request->product_type);
            $productType->save();

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }
        
        return response()->json($response);
    }

    public function getDelApi($id){
        $productType = ProductType::find($id);
        $count = count($productType->product);
        
        if ($count > 0) {
            $response["status"] = 501;
            $response["message"] = "cannot delete because there are many products belong to this category";
        }elseif ($count == 0) {
            $productType->delete();
            $response["status"] = 200;
            $response["message"] = "success";
        }

        return response()->json($response);
    }
}

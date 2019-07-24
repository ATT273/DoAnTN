<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\ProductType;
use App\ProductImage;
use App\Tag;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function getDanhsach(){
    	$products = Product::paginate(5);
    	return view('admin.product.danhsach_product',['products' => $products]);
    }

    public function getAdd(){
    	$productTypes  = ProductType::all();
    	$tags = Tag::all();
    	return view('admin.product.them_product',['productTypes' => $productTypes, 'tags' => $tags]);
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'product_name' => 'required|unique:product,name|min:10|max:200',
    			'product_type' => 'required',
    			'product_unit' => 'required',
    			'product_price' => 'required',
    			'product_qty' => 'required',
    			'product_promo' => 'required',
    			'product_img.*' => 'required|mimes:jpeg,png|max:1024',
    		],
    		[
    			'product_name.required'=>'Please enter product name',
    			'product_name.unique'=>'You have added this product',
    			'product_name.min'=>'Name must be between 10 and 200 charaters',
    			'product_name.max'=>'Name must be between 10 and 200 charaters',
    			'product_price.required'=>'Please enter product price',
    			'product_promo.required'=>'Please enter product promo price',
    			'product_qty.required'=>'Please enter product quantity',
    			'product_unit.required'=>'Please enter product unit',
    			'product_img.*.required' => 'Please choose images for this product',
                'product_img.*.mimes' => 'Image must be jpeg,jpg,png',
                'product_img.*.max' => ' Max size is 1Mb',
    			// 'product_promo'
    		]);

    	$product = new Product;
    	$product->name = $request->product_name;
    	$product->type_id = $request->product_type;
    	$product->price = $request->product_price;
    	$product->promo_price = $request->product_promo;
    	$product->unit = $request->product_unit;
    	$product->quantity = $request->product_qty;
    	$product->description = $request->product_desc;

    	$product->save();

    	$product->tag()->sync($request->tag,false);

    	$lastest_pr = Product::orderBy('created_at','DESC')->first();
    	$files = $request->file('product_img');
    	$dates = date('Y-m-d H-i-s');
    	foreach ($files as $file) {
    		$file_name = $file->getClientOriginalName();
    		$name = $dates."-".$file_name;
    		$file->move('upload/product',$name);
    		$img = new ProductImage;
    		$img->name = $name;
    		$img->product_id = $lastest_pr->id;
    		$img->save();
    	}
    	return redirect('admin/product/danhsach-sp')->with('thongbao','Added Successfully');
    }

    public function getEdit($id){
    	$product = Product::findOrFail($id);
		// $product_images = ProductImage::where('product_id',$id)->get();
    	$productTypes = ProductType::all();
    	$tags = Tag::all();
	
	 	return view('admin.product.sua_product',['product'=>$product,'productTypes'=>$productTypes, 'tags' => $tags]);
    	
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'product_name' => 'required|min:10|max:200',
    			'product_type' => 'required',
    			'product_unit' => 'required',
    			'product_price' => 'required',
    			'product_qty' => 'required',
    			'product_promo' => 'required',
    			'product_img.*' => 'mimes:jpeg,png|max:1024',
    		],
    		[
    			'product_name.required'=>'Please enter product name',
    			'product_name.min'=>'Name must be between 10 and 200 charaters',
    			'product_name.max'=>'Name must be between 10 and 200 charaters',
    			'product_price.required'=>'Please enter product price',
    			'product_promo.required'=>'Please enter product promo price',
    			'product_qty.required'=>'Please enter product quantity',
    			'product_unit.required'=>'Please enter product unit',
    			'product_img.*.mimes' => 'Image must be jpeg,jpg,png',
                'product_img.*.max' => ' Max size is 1Mb',
    			// 'product_promo'
    		]);


        $checkname = Product::where('name',$request->product_name)->get();
        if(count($checkname) == 0){
            $product = Product::findOrFail($id);
            $product->name = $request->product_name;
            $product->type_id = $request->product_type;
            $product->price = $request->product_price;
            $product->promo_price = $request->product_promo;
            $product->unit = $request->product_unit;
            $product->quantity = $request->product_qty;
            $product->description = $request->product_desc;

            $product->save();

            
            if($request->hasFile('product_img')){
                $files = $request->file('product_img');
                $dates = date('Y-m-d H-i-s');
                foreach ($files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $name = $dates."-".$file_name;
                    $file->move('upload/product',$name);
                    $img = new ProductImage;
                    $img->name = $name;
                    $img->product_id = $product->id;
                    $img->save();
                }
            }
            
            if(isset($request->tag)){
                $product->tag()->sync($request->tag);
            }else{
                $product->tag()->sync(array());
            }

            return redirect('admin/product/danhsach-sp')->with('thongbao','Updated Successfully');
        }
        if($checkname[0]->id == $id){
            $product = Product::findOrFail($id);
            $product->name = $request->product_name;
            $product->type_id = $request->product_type;
            $product->price = $request->product_price;
            $product->promo_price = $request->product_promo;
            $product->unit = $request->product_unit;
            $product->quantity = $request->product_qty;
            $product->description = $request->product_desc;

            $product->save();

            
            if($request->hasFile('product_img')){
                $files = $request->file('product_img');
                $dates = date('Y-m-d H-i-s');
                foreach ($files as $file) {
                    $file_name = $file->getClientOriginalName();
                    $name = $dates."-".$file_name;
                    $file->move('upload/product',$name);
                    $img = new ProductImage;
                    $img->name = $name;
                    $img->product_id = $product->id;
                    $img->save();
                }
            }
            
            if(isset($request->tag)){
                $product->tag()->sync($request->tag);
            }else{
                $product->tag()->sync(array());
            }

            return redirect('admin/product/danhsach-sp')->with('thongbao','Updated Successfully');
        }elseif ($checkname[0]->id !== $id) {
            return redirect('admin/product/edit/'.$id)->with('loi','This product has already been existed');
        }
    }

    public function getDeleteImage($id){
    	$img = ProductImage::find($id);
    	unlink('upload/product/'.$img->name);
        $img->delete();

        return redirect()->back();
    }

    public function getDel($id){
        $product = Product::find($id);
        $images = ProductImage::where('product_id',$id)->get();
        foreach ($images as $img) {
            unlink('upload/product/'.$img->name);
            $img->delete();
        }
        $product->delete();

        return redirect('admin/product/danhsach-sp')->with('thongbao','Deleted Successfully');
    }


    public function getSearchProduct(Request $request){
        if($request->has('keyword')){
            $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->orWhere('price',$request->keyword)->paginate(2);
            $products->appends(['keyword' => $request->keyword]);
            return view('admin.product.danhsach_product',['products'=>$products]);
        }else{
           return redirect('admin/product/danhsach-sp');
        }
    	
    }
    
   



    // APi function

    public function getDanhsachApi(){
        $products = Product::paginate(5);
        $tagAll = Tag::all(); 
        $productTypes = ProductType::all();
        foreach ($products as $product) { 
            $image = $product->productimg; 
            $productType = $product->product_type->first(); 
            $category = $product->product_type->category->first();
            $tags = $product->tag; 
        } 
            $response = array( 
                'status' => 200, 
                'message' => "success", 
                'products' => $products->toArray(), 
                'tags' => $tagAll->toArray(),
                'productTypes' => $productTypes->toArray()
            ); 
            return response()->json($response);
    }

    public function postAddApi(Request $request){
        $rules = [
                'product_name' => 'required|unique:product,name|min:10|max:200',
                'product_type' => 'required',
                'product_unit' => 'required',
                'product_price' => 'required',
                'product_qty' => 'required',
                'product_promo' => 'required',
            ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
                $product = new Product;
                $product->name = $request->product_name;
                $product->type_id = $request->product_type;
                $product->price = $request->product_price;
                $product->promo_price = $request->product_promo;
                $product->unit = $request->product_unit;
                $product->quantity = $request->product_qty;
                $product->description = $request->product_desc;

                $product->save();

                $product->tag()->sync($request->tag,false);

                $lastest_pr = Product::orderBy('created_at','DESC')->first();
                if(Request::has('file')){
                    $files = Input::file('file');
                    $dates = date('Y-m-d H-i-s');
                    foreach ($files as $file) {
                        $file_name = $file->getClientOriginalName();
                        $name = $dates."-".$file_name;
                        $file->move('upload/product',$name);
                        $img = new ProductImage;
                        $img->name = $name;
                        $img->product_id = $lastest_pr->id;
                        $img->save();
                    }
                
                }

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }

        return response()->json($response);
    }

    public function getDelApi($id){
        $product = Product::find($id);
        // $img = ProductImage::find($id);
        // foreach ($images as $img) {
        //     unlink('upload/product/'.$img->name);
        //     $img->delete();
        // }
        $product->delete();

        $response["status"] = 200;
        $response["message"] = "success";

        return response()->json($response);
    }
}

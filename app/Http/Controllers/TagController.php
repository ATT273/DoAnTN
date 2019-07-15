<?php

namespace App\Http\Controllers;
use App\Tag;
use App\ProductTag;
use Validator;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function getDanhsach(){
    	$tags = Tag::paginate(5) ;
    	return view('admin.tag.danhsach_tag',['tags'=>$tags]);
    }

    public function getAdd(){
    	return view('admin.tag.them_tag');
    }

    public function postAdd(Request $request){
    	$this -> validate($request,
    		[
    			'tag'=>'required|unique:category,name| min:3| max:20'
    		],
    		[
    			'category.required'=>'chua nhap ten the loai',
    			'category.unique'=> 'Ten da bi trung',
    			'category.min'=>'Ten co do dai tu 3 den 20 ky tu',
    			'category.max'=>'Ten co do dai tu 3 den 20 ky tu'
    		]
    	);

    	$tag = new Tag;
    	$tag->name = $request->tag;
    	$tag->save();
    	return redirect('admin/tag/danhsach-tag')->with('thongbao','Added Successfully');
    }

    public function getEdit($id){
    	$tag = Tag::find($id);
    	return view('admin.tag.sua_tag',['tag'=>$tag]);
    }
    public function postEdit(Request $request, $id){
        $this -> validate($request,
            [
                'tag'=>'required| min:3| max:20'
            ],
            [
                'category.required'=>'chua nhap ten the loai',
                'category.min'=>'Ten co do dai tu 3 den 20 ky tu',
                'category.max'=>'Ten co do dai tu 3 den 20 ky tu'
            ]
        );

        $checkname = Tag::where('name',$request->tag)->get();
        if(count($checkname) == 0){
            $tag = Tag::find($id);
            $tag->name = $request->tag;
            $tag->save();

            return redirect('admin/tag/danhsach-tag')->with('thongbao','Added Successfully');
        }
        if($checkname[0]->id == $id){
            $tag = Tag::find($id);
            $tag->name = $request->tag;
            $tag->save();

            return redirect('admin/tag/danhsach-tag')->with('thongbao','Added Successfully');
        }elseif ($checkname[0]->id !== $id) {
            return redirect('admin/tag/edit/'.$id)->with('loi','This tag has already been existed');
        }
    }

    
    public function getDel($id){
        $tag = Tag::find($id);
        $productTags = ProductTag::where('tag_id',$id)->get();

        $tag->delete();
        foreach ($productTags as $pt) {
            $pt->delete();
        }

        return redirect('admin/tag/danhsach-tag')->with('thongbao', 'Deleted Successfully');

    }

    public function getSearchTag(Request $request){
        if($request->has('keyword')){
            $tags = Tag::where('name','LIKE', '%'.$request->keyword.'%')->paginate(2);
            $tags->appends(['keyword' => $request->keyword]);
            return view('admin.tag.danhsach_tag',['tags'=>$tags]);
        }else{
            return redirect('admin/tag/danhsach-tag');
        }
        
    }


     // APi function

    public function getDanhsachApi(){
        $tags = Tag::all() ;
        $response["status"] = 200;
        $response["tags"] = $tags;
        return response()->json($response);
    }

    public function postAddApi(Request $request){
        $rules = [
                'tag'=>'required|unique:tag,name| min:3| max:100'
            ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $tag = new Tag;
            $tag->name = $request->tag;
            $tag->save();

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
                'tag' => 'required|unique:tag,name|min:3|max:100'
            ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            $tag = Tag::find($id);
            $tag->name = $request->tag;
            $tag->save();

            $response["status"] = 200;
            $response["message"] = "success";
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
        }
        return response()->json($response);
    }

    public function getDelApi($id){

        $tag = Tag::find($id);
        $productTags = ProductTag::where('tag_id',$id)->get();

        $tag->delete();
        foreach ($productTags as $pt) {
            $pt->delete();
        }

        $response["status"] = 200;
        $response["message"] = "success";

        return response()->json($response);
    }
}

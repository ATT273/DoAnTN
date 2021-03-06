<?php

namespace App\Http\Controllers;
use App\Tag;
use App\User;
use Validator;
use App\ProductTag;
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
        // dd($tag);
        $productTags = ProductTag::where('tag_id',$id)->get();
        if(count($productTags) > 0){
            foreach ($productTags as $pt) {
                $pt->delete();
            }
        }
        $tag->delete();
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
        $id = explode('_', $request->apiToken)[0];
        $user = User::find($id);
        if ($request->apiToken != $user->api_token) {
            $response["status"] = 250;
            $response["message"] = 'token timeout';
            return response()->json($response);
        }
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
        $uid = explode('_', $request->apiToken)[0];
        $user = User::find($uid);
        if ($request->apiToken != $user->api_token) {
            $response["status"] = 250;
            $response["message"] = 'token timeout';
            return response()->json($response);
        }
        $rules = [
                'tag' => 'required|unique:tag,name|min:3|max:100'
            ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){

            $checkname = Tag::where('name',$request->tag)->get();
            if(count($checkname) == 0){
                $tag = Tag::find($id);
                $tag->name = $request->tag;
                $tag->save();

                $response["status"] = 200;
                $response["message"] = "success";
                return response()->json($response);
            }
            if($checkname[0]->id == $id){
                $tag = Tag::find($id);
                $tag->name = $request->tag;
                $tag->save();

                $response["status"] = 200;
                $response["message"] = "success";
                return response()->json($response);
            }elseif ($checkname[0]->id !== $id) {
                $response["status"] = 500;
                $response["message"] = 'This tag has already been existed';
                return response()->json($response);
            }
            
        } else {
            $response["status"] = 500;
            $response["message"] = $validator->errors()->first();
            return response()->json($response);
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

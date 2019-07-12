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
        $tag = Tag::find($id);
        $tag->name = $request->tag;
        $tag->save();

        return redirect('admin/tag/danhsach-tag')->with('thongbao','Added Successfully');
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
}

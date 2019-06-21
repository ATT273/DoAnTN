<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function getDanhsach(){
    	$tags = Tag::all() ;
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
    	return redirect('admin/tag/add')->with('thongbao','Added Successfully');
    }

    public function getEdit($id){
    	$tag = Tag::find($id);
    	return view('admin.tag.sua_tag',['tag'=>$tag]);
    }
}

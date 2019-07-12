<?php

namespace App\Http\Controllers;
use App\Slide;
use App\News;
use Validator;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    //

    public function getDanhsach(){
    	$banners = Slide::all();
    	return view('admin.slider.danhsach_banner', ['banners' => $banners]);
    }

    public function getAdd(){
    	$news = News::all();
    	return view('admin.slider.them_banner',['news' => $news]);
    }

    public function postAdd(Request $request){
        $this->validate($request,
            [
                'image.*' => 'required|mimes:jpeg|max:1024',
            ],
            [
                'image.*.max' => 'max file size is 1024Kb',
                'image.*.mimes' => 'Image type must be jpeg',
            ]
        );
        $banner = new Slide;
        $file = $request->file('image');
        $date = date('Y-m-d H-i-s');
        $file_name = $file->getClientOriginalName();
        $name = $date."-".$file_name;
        $file->move('upload/slide',$name);

        $banner->news_id = $request->news_id;
        $banner->image = $name;
        $banner->save();
        return redirect('admin/slide/danhsach-banner')->with('thongbao','Added Successfully');
    }

    public function getEdit($id){
        $banner = Slide::find($id);
        $news = News::all();
        return view('admin.slider.sua_banner',['banner' => $banner, 'news' => $news]);
    }

    public function postEdit(Request $request, $id){
        $this->validate($request,
            [
                'image.*' => 'required|mimes:jpeg|max:1024',
            ],
            [
                'image.*.max' => 'max file size is 1024Kb',
                'image.*.mimes' => 'Image type must be jpeg',
            ]
        );
        $banner = Slide::find($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $date = date('Y-m-d H-i-s');
            $file_name = $file->getClientOriginalName();
            $name = $date."-".$file_name;
            $file->move('upload/slide',$name);
            unlink('upload/slide/'.$banner->image);
            $banner->image = $name;
        }
        $banner->news_id = $request->news_id;
        $banner->save();
        return redirect('admin/slide/danhsach-banner')->with('thongbao','Updated Successfully');
    }

    public function getDel($id){
        $banner = Slide::find($id);
        unlink('upload/slide/'.$banner->image);
        $banner->delete();
        return redirect('admin/slide/danhsach-banner')->with('thongbao','Deleted Successfully');
    }
}

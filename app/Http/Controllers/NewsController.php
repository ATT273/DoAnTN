<?php

namespace App\Http\Controllers;
use App\Slide;
use App\News;
use Validator;
use Storage;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //

    public function getDanhsach(){
    	$news = News::paginate(5);
    	return view('admin.news.danhsach_news', ['news' => $news]);
    }

    public function getAdd(){
    	return view('admin.news.them_news');
    }

    public function postAdd(Request $request){
    	$this->validate($request,
    		[
    			'title' => 'required',
    			'content' => 'required'
    		],
    		[
    			'title.required' => 'please input news title',
    			'content.required' => 'please input news content',
    		]
    	);


    	if($request->hasFile('image')){
    		$file = $request->file('image');
	    	$date = date('Y-m-d H-i-s');
    		$file_name = $file->getClientOriginalName();
    		$name = $date."-".$file_name;
    		$file->move('upload/news',$name);
    		
    		$news = new News;
    		$news->title = $request->title;
    		$news->content = $request->content;
    		$news->image = $name;
    		$news->save();
    	}elseif(!$request->hasFile('image')){
    		$news = new News;
    		$news->title = $request->title;
    		$news->content = $request->content;
    		$news->save();
    	}

    	return redirect('admin/news/danhsach-news')->with('thongbao','Added Successfully');
    }

    public function getEdit($id){
    	$news = News::find($id);
    	return view('admin.news.sua_news',['news' => $news]);
    }

    public function postEdit(Request $request, $id){
    	$this->validate($request,
    		[
    			'title' => 'required',
    			'content' => 'required'
    		],
    		[
    			'title.required' => 'please input news title',
    			'content.required' => 'please input news content',
    		]
    	);

    	$news = News::find($id);
		if($request->hasFile('image')){
			$file = $request->file('image');
	    	$date = date('Y-m-d H-i-s');
    		$file_name = $file->getClientOriginalName();
    		$name = $date."-".$file_name;
    		$file->move('upload/news',$name);
    		$news->title = $request->title;
    		$news->content = $request->content;
    		
			if($news->image == ''){
	    		$news->image = $name;
	    		$news->save();
			}elseif($news->image != ''){
				unlink('upload/news/'.$news->image);
				$news->image = $name;
	    		$news->save();
			}
    		
    	}elseif(!$request->hasFile('image')){
    		
    		$news->title = $request->title;
    		$news->content = $request->content;
    		$news->save();
    	}
    	return redirect('admin/news/danhsach-news')->with('thongbao','Updated Successfully');
    }

    public function getDel($id){
    	$news = News::find($id);
    	if($news->image != ''){
    		unlink('upload/news/'.$news->image);
    	}
    	$news->delete();
    	return redirect('admin/news/danhsach-news')->with('thongbao','Deleted Successfully');
    }

    public function getDelImage($id){
    	$news = News::find($id);
    	unlink('upload/news/'.$news->image);
    	$news->image = '';
    	$news->save();
    	return redirect()->back();
    }

    public function getSearchNews(Request $request){
        if($request->has('keyword')){
            $news = News::where('title','LIKE', '%'.$request->keyword.'%')->paginate(2);
            $news->appends(['keyword' => $request->keyword]);
            return view('admin.news.danhsach_news',['news'=>$news]);
        }else{
            return redirect('admin/news/danhsach-news');
        }
        
    }
}

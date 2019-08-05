<?php

namespace App\Http\Controllers;
use App\Comment;
use Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function postAddComment(Request $request){
    	$this->validate($request,
    		[
    			'comment' => 'min:10|max:300'
    		],
    		[
    			'comment.min'=>'Your comment is too short',
    			'comment.max'=>'Your comment is too long',
    		]);

    	$comment = new Comment;
    	$comment->product_id = $request->product_id;
    	$comment->user_id = $request->user_id;
    	$comment->content = $request->comment;
    	$comment->save();

    	return redirect('product/'.$request->product_id);
    }
}

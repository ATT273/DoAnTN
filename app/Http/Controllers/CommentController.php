<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Product;
use App\User;
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
    //apiiii
    public function postAddCommentApi(Request $request){
        $id = explode('_', $request->apiToken)[0];
        $user = User::find($id);
        if ($request->apiToken != $user->api_token) {
            $response["status"] = 250;
            $response["message"] = 'token timeout';
            return response()->json($response);
        }
        $comment = new Comment;
        $comment->product_id = $request->product_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->comment;
        $comment->save();

        $product = Product::where('id',$request->product_id)->first();
        foreach ($product->comment as $cmt) {
                $cmt->user;
            }

            $response["status"] = 200;
            $response["message"] = 'Success';
            $response["comments"] = $product->comment;

            return response()->json($response);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function create(Request $request){
        $comment = new Comment;
        $comment->user_id= Auth::user()->id;
        $comment->journal_id=$request->id;
        $comment->comment= $request->comment;
        $comment->save();

        return response()->json([

            'success'=>true,
            'message'=>'Comment Posted',
        ]);

    }
    public function update(Request $request){
        $comment= Comment::find($request->id);
        //CHECK IF THE USER IS EDITING THEIR OWN COMMENT
        if($comment->user_id != Auth::user()->id){
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized Access!!!'
            ]);
        }
        $comment->comment=$request->comment;
        $comment->update();

        return response()->json([
            'success'=>true,
            'message'=>'Comment Edited'
        ]);
    }




    public function delete(Request $request){
        $comment= Comment::find($request->id);
        //CHECK IF THE USER IS DELETING THEIR OWN COMMENT
        if($comment->id != Auth::user()->id){
            return response()->json([
                'success'=>false,
                'message'=>'Unauthorized Access!!!'
            ]);
        }
      
        $comment->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Comment Deleted'
        ]);
    }

    public function comment(Request $request){
        $comment= Comment::where('journal_id',$request->id)->get();
      // $comment= Comment::orderBy('id','desc')->get();
        //SHOW WHICH USER MADE A PARTICULAR COMMENT ON THE JOURNAL

       foreach($comment as $comment){
        $comment->user;

        }


   
        
        return response()->json([
            'success'=>true,
            'comment'=> $comment
        ]);
     
    }

}

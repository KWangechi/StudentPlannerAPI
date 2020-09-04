<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Likes;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like(Request $request){
        $like=Likes::where('journal_id',$request->journal_id)->where('user_id',Auth::user()->id)->get();
        //check if it returns 0 then this post is not liked and should be unliked
        if(count($like)>0){
            $like->deleteAll();
            return response()->json([
                'success'=>true,
                'message'=>'unliked'
            ]);
        }
        $like=new Likes;
        $like->user_id=Auth::user()->id;
        $like->journal_id=$request->id;
        $like->save();


        return response()->json([
            'success'=>true,
            'message'=>'liked'
        ]);
    }
}

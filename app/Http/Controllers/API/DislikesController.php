<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dislikes;
use Illuminate\Support\Facades\Auth;

class DislikesController extends Controller
{
    public function Dislike(Request $request){
        $dislike=Dislikes::where('journal_id',$request->journal_id)->where('user_id',Auth::user()->id)->get();
        //check if it returns 0 then this post is not liked and should be unliked
        if(count($dislike)>0){
            $dislike->deleteAll();
            return response()->json([
                'success'=>true,
                'message'=>'unliked'
            ]);
        }
        $dislike=new Dislikes;
        $dislike->user_id=Auth::user()->id;
        $dislike->journal_id=$request->id;
        $dislike->save();


        return response()->json([
            'success'=>true,
            'message'=>'Entry Disliked'
        ]);
    }
}

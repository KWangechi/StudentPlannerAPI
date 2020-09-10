<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\journal;
use App\Comment;
use App\Likes;
use App\Dislikes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Http\Resources\tasks;



class JournalController extends Controller
{
    public function create (Request $request){

        $journal=new journal;
        $journal->user_id =Auth::user()->id;
        $journal->about= $request->about;
        $journal->date= $request->date;
        $journal->feelings= $request->feelings;
        $journal->tag= $request->tag;

        //CHECK IF JOURNAL ENTRY HAS A PHOTO
    if($request->photo != ''){
        //CHOOSE A UNIQUE NAME FOR PHOTO
        $photo=time().'jpg';
        //LINK TO STORAGE FOLDER TO PUBLIC
        file_put_contents('storage/journal'.$photo,base64_decode($request->photo));
        $journal->photo=$photo;
    }
    $journal->save();
    $journal->user;
    return response()->json([

        'success'=>true,
        'message'=>'Journal entry created & posted',
        'journal'=>$journal
    ]

    );
    }

    public function update(Request $request){
        $journal= journal::find($request->id);
        //CHECK IF THE USER IS EDITING THEIR OWN JOURNAL ENTRY
        //CHECK USER ID WITH JOURNAL USER ID
        if(Auth::user()->id != $request->user_id){
            return response()->json([
                'success'=>false,
                'message'=>'you are not authorized to edit this journal entry'
            ]);
        }
        $journal->about=$request->about;
        $journal->date=$request->date;
        $journal->feelings=$request->feelings;
        $journal->tag=$request->tag;
        $journal->update();

        return response()->json([
            'success'=>true,
            'message'=>'Journal Entry Updated'
        ]);
    }



    
    public function delete(Request $request){
        $journal= journal::find($request->user_id);
        //CHECK IF THE USER IS EDITING THEIR OWN JOURNAL ENTRY
        if(Auth::user()->id != $request->id){
            return response()->json([
                'success'=>false,
                'message'=>'you are not authorized to edit this journal entry'
            ]);
        }

        //CHECK IF POST HAS PHOTO TO DELETE

        if($journal->photo != ''){
            Storage::delete('public/journal/'.$journal->photo);
        }
        $journal->delete();

      
        return response()->json([
            'success'=>true,
            'message'=>'Journal Entry Deleted'
        ]);

}

public function journal(){
   //$journal= journal::orderBy('id','desc')->get();


$journals= journal::all();





  foreach($journals as $journal){
     //   GET USER OF THE JOURNAL ENTRY

        $journal->user;
        
        //GET COMMENTS COUNT

    
        $journal['commentCount'] = count($journal->comment);
//return (new tasks($journals))->response();


  

        
        //GET LIKE COUNT
        $journal['likesCount'] = count($journal->likes);
        
        //GET DISLIKE COUNT

        $journal['DislikesCount'] = count($journal->Dislikes);
        //CHECK IF USER LIKED THEIR OWN POST
        $journal['selfLike']=false;
        foreach($journal->likes as $like){
            if($like->user_id==Auth::user()->id){
                $journal['selfLike']=true;
           
        //CHECK IF USER DISLIKED THEIR OWN POST
      
        $journal['selfDisLike']=false;
        foreach($journal->Dislikes as $Dislike){
            if($Dislike->user_id==Auth::user()->id){
                $journal['selfDisLike']=true;

            
        
            }
        }

  
}
  }

 // return (new tasks($journals))->response();

    }
    return response()->json([
        'success'=>true,
        'journal'=>$journals
    ]);
   
    
   
}



}

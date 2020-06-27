<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\journal;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
class JournalController extends Controller
{
    public function create (Request $request){

        $journal=new journal;
        $journal->user_id =Auth::user()->id;
        $journal->about= $request->about;

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
        if(Auth::user()->id != $request->id){
            return response()->json([
                'success'=>false,
                'message'=>'you are not authorized to edit this journal entry'
            ]);
        }
        $journal->about=$request->about;
        $journal->update();

        return response()->json([
            'success'=>true,
            'message'=>'Journal Entry Updated'
        ]);
    }



    
    public function delete(Request $request){
        $journal= journal::find($request->id);
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
    $journal= journal::orderBy('id','desc')->get();
  /* foreach($journal as $journal){
        //GET USER OF THE JOURNAL ENTRY

        $journal->user;

        //GET COMMENTS COUNT

        $journal['commentCount'] = count($journal->comment);

    }*/
  return response()->json([
      'success'=>true,
      'journal'=>$journal
  ]);
}

}

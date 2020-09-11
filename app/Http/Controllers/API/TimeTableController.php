<?php

namespace App\Http\Controllers\API;


use App\User;
use App\Category;
use App\TimeTable;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    
    //create methods for creating, updating, showing and deleting categories
    

    //1. function for showing all the timetables
    public function timetables(Request $request){
        $timetables = TimeTable::where('user_id', Auth::user()->id)->get();
       
        foreach($timetables as $timetable){
            $timetable->user;
        }

        /*
        if($request->user_id != Auth::user()->id){
                return response()->json([
                    'success' => false,
                    'message' => "You can only view your timetables"
                ]);

                */

                return response()->json([
                    'success' => true,
                    'message' => 'Request successful',
                    'timetables' => $timetables
                ]);

        }

    //2. function for creating a new timetable
    public function create(Request $request){

        $timetable = new TimeTable;

        
        $timetable = TimeTable::create([
            'user_id' => Auth::user()->id,
            //'category_id' => $request->category_id,
            'timetable_title' => $request->timetable_title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description
        ]);



            
    
        $timetable->user;

        $timetable->save();

        return response()->json([
            'success' => true,
            'message' => "Timetable created successfully",
            'timetable' => $timetable
        ]);
    }


    //3.  function for updating a created timetable
    public function update(Request $request){
        $timetable = TimeTable::find($request->id);


        //checks if the user is editng their own timetable
        if(Auth::user()->id != $timetable->user_id){
            return response()->json([
                'success' => false,
                'message' => "You can only update your own timetable"
            ]);

        }

        
           // $timetable->category_id = $request->category_id;
            $timetable->timetable_title = $request->timetable_title;
            $timetable->date = $request->date;
            $timetable->start_time = $request->start_time;
            $timetable->end_time = $request->end_time;
            $timetable->description = $request->description;


            $timetable->user;

            $timetable->update();

            return response()->json([
                'success' => true,
                'message' => "Update successful",
                'timetable' => $timetable
            ]);
        }

    

    public function destroy(Request $request){

        $timetable = TimeTable::find($request->id);


        //check if current authenticated user is the owner of the post
        
        if(Auth::user()->id != $timetable->user_id){
            return response()->json([
                'success' => false,
                'message' => "You can only delete your own timetable"
            ]);

        }

$timetable->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deletion successful!!'
            ]);
        }

    }

    




<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Semester;
class SemesterController extends Controller
{
    //method for creating a new semester
public function create(Request $request){
    $semester = Semester::create([
        'semester_id' => $request->semester_id,
        'semester_name' => $request->semester_name,
        'start_month' => $request->start_month,
        'end_month' => $request->end_month
    ]);
    
    $semester->save();
    
    return response()->json([
        'success' => true,
        'meesage' => 'Semester created successfully',
        'semester' => $semester
    ]);
    
    
    }
    
    
    
    //method for viewing all the semesters
    public function semesters(Request $request){
    $semesters = Semester::all();
    
    return response()->json([
        'sucess'=> true,
        'semesters' => $semesters
    ]);
    
    }
    
    
    //method for updating details of a semester
    public function update(Request $request){
        $semester = Semester::findOrFail($request->semester_id);
    
        $semester->semester_id = $request->semester_id;
        $semester->semester_name = $request->semester_name;
        $semester->start_month = $request->start_month;
        $semester->end_month = $request->end_month;
    
    
        $semester->update();
    
        return response()->json([
            'success' =>  true,
            'message' => 'Semester has been updated',
            'semester' => $semester
        ]);
    
    }
    
    //method for deleting a semester
    public function destroy(Request $request){
        $semester = Semester::findOrFail($request->semester_id);
    
        $semester->delete();
    
        return response()->json([
            'success' =>  true,
            'message' => 'Semester has been deleted'
        ]);
    
    }
}

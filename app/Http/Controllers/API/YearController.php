<?php

namespace App\Http\Controllers\API;

use App\Year;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YearController extends Controller
{
    //method for viewing all the years
    public function years(Request $request){
        $years = Year::all();

        return response()->json([
            'success' => true,
            'years' => $years
        ]);

    }

    //method for creating years
    public function create(Request $request){
        $year = Year::create([
            'year_id' => $request->year_id,
            'year_name' => $request->year_name
        ]);
        $year->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Year created successfully',
            'year' => $year            
        ]);
    }

    //method for updating the years
    public function update(Request $request){
        $year = Year::findOrFail($request->year_id);

        $year->year_id = $request->year_id;
        $year->year_name = $request->year_name;

        $year->update();
        return response()->json([
            'success' => true,
            'message' => 'Successful update!',
            'year' => $year
        ]);

    }

    //method for deleting an year
    public function destroy(Request $request){
        $year = Year::find($request->year_id);

        $year->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Successful deletion!!'
        ]);
        
    }
    
    
}

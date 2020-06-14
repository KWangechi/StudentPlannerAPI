<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //create methods for creating, updating, showing and deleting categories
    

    //1. function for showing all the timetables of a particular user
    public function categories(){
        $category = Category::all();

        return response()->json([
            'success' => true,
            'categories' => $category
        ]);
    }


    //2. function for creating a new timetable
    public function create(Request $request){
$category = Category::create([
    'category_name' => $request->category_name
]);

$category->save();

return response()->json([
    'success' => true,
    'messag' => "Category created!!",
    'category' => $category
]);

    }

    //3.  function for updating a created timetable
    public function update(Request $request){
        $category = Category::find($request->id);

        
        $category->category_name = $request->category_name;

        $category->update();

        return response()->json([
            'success' => true,
            'message' => "Update successful",
            'category' => $category

        ]);

    }

    public function destroy(Request $request){
        $category = Category::find($request->id);
            $category->delete();

            return response()->json([
                'success' => true,
                'message'=> "Deleted successfully"
            ]);
        }



}

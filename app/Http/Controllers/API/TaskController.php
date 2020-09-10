<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Timetable;



class TaskController extends Controller
{
    //a method for creating a task
    public function create(Request $request){
        $task = Task::create([
            'timetable_id' => $request->timetable_id,
            'task_name' => $request->task_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start-time' => $request->start_time,
            'end_time' => $request->end_time,
            'priority' => $request->prority
            
        ]);

        $task->save();
        $task->task;

        return response()->json([
            'success'=> true,
            'message'=> 'Task created successfully',
            'task' =>$task
        ]);

    }

    //updating a task that has been created
public function update(Request $request){
    $task = Task::findOrFail($request->task_id);


        $task->timetable_id = $request->timetable_id;
        $task->task_name = $request->task_name;
        $task->start_date= $request->start_date;
        $task->end_date = $request->end_date;
        $task->start_time = $request->start_time;
        $task->end_time = $request->end_time;
        $task->priority = $request->priority;



            $task->timetable;

            $task->update();

            return response()->json([
                'success' => true,
                'message' => "Task updated successful",
                'task' => $task
            ]);
    }


//method for deleting a task
public function destroy(Request $request){
    $task = Task::findOrFail($request->task_id);

    $task->delete();

    return response()->json([
        'success' => true,
        'message' => 'Task deletion successful',
    ]);

}

//method for retrieving tasks that belong to a particular timetable 
public function tasks(Request $request){
    $tasks = Task::where('timetable_id', $request->timetable_id)->get();
       
        foreach($tasks as $task){
            $task->timetable;
        }

                return response()->json([
                    'success' => true,
                    'message' => 'Request successful',
                    'task' => $tasks
                ]);
    }
}



    


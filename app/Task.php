<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Timetable;
class Task extends Model
{

    protected $fillable=['timetable_id', 'task_name'];
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';

    //define the relationship between the task and the timetable
    public function timetable(){
        return $this->belongsTo(Timetable::class);
    }


}

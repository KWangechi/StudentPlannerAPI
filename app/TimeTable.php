<?php

namespace App;

use App\User;
use App\Category;
use App\Task;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $table = "time_tables";


    protected $fillable = ['user_id' , 'category_id' , 'timetable_title', 'date', 'start_time', 'end_time', 
    'description'];


    
    //a timetable belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //a timetable belongs to a category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //a timeatable has many tasks
    public function task(){
        return $this->hasMany(Task::class);

    }
}

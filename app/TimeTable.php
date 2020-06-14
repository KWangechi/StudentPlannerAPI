<?php

namespace App;

use App\User;
use App\Category;

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

    //a timetable has many categories
    public function category(){
        return $this->belongsTo(Category::class);
    }
}

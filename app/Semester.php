<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TimeTable;
use App\Year;

class Semester extends Model
{
    
    public $incrementing = false;
    public $primaryKey = 'semester_id';
    public $timestamps = false;

    public $fillable = ['semester_id','semester_name', 'start_month', 'end_month'];


}

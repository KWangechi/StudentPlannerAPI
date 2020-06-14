<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TimeTable;
class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['category_name'];


    public function timetable(){
        return $this->hasMany(TimeTable::class);
    }
}

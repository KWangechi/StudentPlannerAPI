<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Semester;

class Year extends Model
{
    public $incrementing= false;
    public $fillable = ['year_id', 'year_name'];

    protected $primaryKey = "year_id";

    

    
}

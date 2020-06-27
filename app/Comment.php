<?php

namespace App;
use App\User;
use App\journal;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function journal(){
        return $this->belongsTo(journal::class);
    }

}

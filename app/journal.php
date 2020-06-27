<?php

namespace App;
use App\User;
use App\Comment;

use Illuminate\Database\Eloquent\Model;

class journal extends Model
{
    protected $table = "journal";


    protected $fillable = ['user_id' , 'about' , 'photo'];


    
    //a journal belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}

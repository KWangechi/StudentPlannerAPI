<?php

namespace App;
use App\User;
use App\Comment;
use App\Likes;
use App\Dislikes;

use Illuminate\Database\Eloquent\Model;

class journal extends Model
{
    protected $table = "journal";


    protected $fillable = ['user_id' , 'about', 'date' , 'feelings' , 'tag'  , 'photo'];


    
    //a journal belongs to a user
    public function user(){
        return $this->belongsTo(User::class);
    }

   // public function comment(){
    //    return $this->belongsTo(Comment::class);
    //}
    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function likes(){
        return $this->hasMany(Likes::class);
    }
    public function Dislikes(){
        return $this->hasMany(Dislikes::class);
    }
}

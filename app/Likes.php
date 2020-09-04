<?php

namespace App;
use App\User;
use App\Comment;
use App\Likes;
use App\Dislikes;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    public function journal(){
        return $this->belongsTo(journal::class);
    }


}

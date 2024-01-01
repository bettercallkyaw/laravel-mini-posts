<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Post extends Model
{
    use HasFactory;

    //post belongto a category
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    //post has many comments
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    //post belongsto a user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

<?php

namespace App;

use App\Model;
class Post extends Model
{
    //
    protected $table = "posts";
    protected $fillable = ['title','content'];
}

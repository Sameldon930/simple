<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //不能被注入的字段
    protected $fillable = [
        'name','email','password'
    ];
}

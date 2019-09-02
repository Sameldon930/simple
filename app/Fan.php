<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;


class Fan extends BaseModel
{
    //获取粉丝用户
    public function fuser(){
        return $this->hasOne('App\User','id','fan_id');
    }

    //获取被关注的用户
    public function  suser(){
        return $this->hasOne('App\User','id','star_id');
    }


}

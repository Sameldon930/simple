<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;



class Comment extends BaseModel
{
    //一对多的反向  多个评论属于文章
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }

    //一对多的反向  多个评论属于用户
    public function user(){
        return $this->belongsTo('App\user','user_id','id');
    }



}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected  $fillable = ['name'];
    //获取属于专题的文章  也就是专题和文章的关系  多对多关系
    pubLic function posts(){
        return $this->belongsToMany('\App\Post','post_topics','topic_id','post_id');

    }
    //获取文章数
    public function postTopics(){
        return $this->hasMany('\App\PostTopic');
    }
}

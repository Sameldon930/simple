<?php

namespace App;
/**
 * 文章模型
 */
use App\Model;
class Post extends Model
{
    //
    protected $table = "posts";
    protected $fillable = ['title','content','user_id'];

    //关联用户  文章属于用户  文章的user_id关联用户的id
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    //文章有多个评论 一对多 获取文章的所有评论 按照发布时间 倒叙显示
    public function comments(){
        return $this->hasMany('App\Comment','post_id','id')->orderBy('created_at','desc');
    }

    //    关联赞  一篇文章 一个用户只能一个赞  判断某个用户对文章是否有赞
    public function zan($user_id){
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }
    //获取文章的所有赞 一篇文章有多个赞
    public function zans(){
        return   $this->hasMany('App\Zan');
    }
}


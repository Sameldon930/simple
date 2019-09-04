<?php

namespace App;
/**
 * 文章模型
 */
use App\Model;
use Illuminate\Database\Schema\Blueprint;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use Searchable;
    //定义索引里面的type
    public function searchableAs()
    {
        return "post";
    }
    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content
        ];
    }

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

    //文章模型和文章专题之间的关系  一对多的关系
    public function postTopics(){
        return $this->hasMany('\App\PostTopic','post_id','id');
    }

    //获取属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id){
        //文章表的user_id 等于传进来的用户的id
        return  $query->where('user_id',$user_id);
    }

    //获取不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topic_id){
        //doesntHave 获取文章专题关系 并且文章不属于专题  使用匿名函数 拿到参数$topic_id
        return $query->doesntHave('postTopics','and',function ($q) use($topic_id){
            $q->where('topic_id',$topic_id);
        });
    }

    //全局scope的方法
    public function scopeAviable($query)
    {
        return $query->whereIn('status', [0, 1]);
    }
}


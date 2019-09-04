<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    //专题详情页
    public function show(Topic $topic){
        //专题下的文章数
        $topic = Topic::withCount('postTopics')->find($topic->id);

        //当前专题的文章列表
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();

        //属于当前用户的文章 但是没有投稿
        $myposts = \App\Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();
        return view('topic/show',compact('topic','posts','myposts'));
    }

    //专题投稿
    public function submit(Topic $topic){

        //验证
        $this->validate(\request(),[
           'post_ids'=>'required|array'
        ]);
        //处理
        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        //编辑数组
        foreach($post_ids  as $post_id){
            PostTopic::firstOrCreate(compact('topic_id','post_id'));
        }
        //返回
        return back();
    }
}

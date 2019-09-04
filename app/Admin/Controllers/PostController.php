<?php
namespace App\Admin\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller{
    //获取待审核文章
    public function index(){
        //显示未处理的文章 也就是status为1  不调用模型层的全局scope方法
        $posts = Post::withoutGlobalScope('available')->where('status',0)->orderBy('created_at','desc')->paginate(10);
        return view('admin.post.index',compact('posts'));
    }
    //审核处理
    public function status(Post $post){

        //验证
        $this->validate(request(),[
            'status'     =>'required|in:-1,1',
        ]);
        //逻辑处理
        $post->status = request('status');
        $post->save();
        //反馈
        return [
            'error'=>0,
            'msg'=>'审核失败！'
        ];
    }
}
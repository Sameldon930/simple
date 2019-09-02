<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //文章列表页
    public function index(Request $request){
        $req = $request->all();
        $where = [];
        if(!empty($req['query'])){
            $where[] = ['title','like','%'.$req['query'].'%'];
        }
        $posts = Post::orderBy('created_at','desc')
            ->where($where)
            ->withCount(['comments','zans'])
            ->paginate(15);

        return view('post/index',compact('posts'));
    }
    //文章详情页
    public function show(Post $post){
        //记载文章模型关联的评论模型 获取相关评论
        $post->load('comments');
        return view('post/show',compact('post'));
    }

    //创建文章 -- 页面
    public function create(){
        return view("post/create");
    }
    //创建文章 -- 保存
    public function store(){
        //插入之前进行验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5 ',
            'content'=>'required|string|min:100',
        ]);
        //插入数据模型层写法
        $user_id = Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
        $data = Post::create($params);
        if($data){
            return redirect('/posts');
        }else{
            die('保存失败！');
        }
    }
    //编辑文章 --读取数据
    public function edit(Post $post){

        return view('post/edit',compact('post'));
    }
    //编辑文章 --保存
    public function update(Post $post){
        //插入之前进行验证
        //编辑之前进行验证是否有权限编辑
        $this->authorize('update',$post);
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5 ',
            'content'=>'required|string|min:100'
        ]);
        $post->title = request('title');
        $post->content = request('content');

        $post->update();
        return redirect("/posts/{$post->id}");

    }
    //删除文章
    public function delete(Post $post){
        //删除之前进行验证是否有权限编辑
        $this->authorize('delete',$post);
        $post->delete();
        return redirect("/posts");
    }

    //上传图片的方法
    public function imageUpload(){
        //配置文件名 并返回文件的具体路径
        $path = request()->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
    //提交评论
    public function comment(Post $post){

        //验证
        $this->validate(request(),[
           'content'=>'required|min:3'
        ]);
        //处理逻辑 插入一条评论  因为post模型已经关联了comment
        $comment = new Comment();
        $comment->user_id = Auth::id();//评论的用户id
        $comment->content = request('content');//评论的内容
        $post->comments()->save($comment);

        //返回详情页
        return back();
    }

    //生成赞
    public function zan(Post $post){

        //处理参数
        $params = [
            'user_id'=> Auth::id(),
            'post_id'=>$post->id
        ];
        //接收参数 进行业务处理  如果没有就创建 存在就查找
        Zan::firstOrCreate($params);
        return back();
    }
    //取消赞
    public function unzan(Post $post){
        $post->zan(Auth::id())->delete();
        return back();
    }
}

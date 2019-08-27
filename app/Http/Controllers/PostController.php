<?php

namespace App\Http\Controllers;


use App\Post;

class PostController extends Controller
{

    //文章列表页
    public function index(){
        $posts = Post::orderBy('created_at','desc')->paginate(15);
        return view('post/index',compact('posts'));
    }
    //文章详情页
    public function show(Post $post){
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
            'content'=>'required|string|min:100'
        ]);
        //插入数据模型层写法
        $data = Post::create(request(['title','content']));
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
        $post->delete();
        return redirect("/posts");
    }

    //上传图片的方法
    public function imageUpload(){
        //配置文件名 并返回文件的具体路径
        $path = request()->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}

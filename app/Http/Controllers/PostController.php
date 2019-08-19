<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //文章列表页
    public function index(){

        return view('post/index',compact(''));
    }
    //文章详情页
    public function show(){
        return view('post/show');
    }

    //创建文章 -- 页面
    public function create(){
        return view("post/create");
    }
    //创建文章 -- 保存
    public function store(){

    }
    //编辑文章 --读取数据
    public function edit(){
        return view('post/edit');
    }
    //编辑文章 --保存
    public function update(){

    }
    //删除文章
    public function delete(){

    }
}

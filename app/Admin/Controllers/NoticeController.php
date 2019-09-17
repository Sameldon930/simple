<?php
namespace App\Admin\Controllers;

use App\Notice;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NoticeController extends Controller{
    //通知列表
    public function index(){
        $notices = Notice::all();
        return view('admin/notice/index',compact('notices'));
    }
    //增加通知
    public function create(){
        return view('admin/notice/create');
    }
    //处理增加的逻辑
    public function store(){
        $this->validate(request(),[
            'title'=>'required|string',
            'content'=>'required|string'
        ]);
        $notice = Notice::create(request(['title','content']));
        //创建分发逻辑  也就是新增一条通知之后  发送到用户那边进行通知
        dispatch(new \App\Jobs\SendMessage($notice));
        //创建成功 返回到列表页
        return \redirect('/admin/notices');
    }
    

}
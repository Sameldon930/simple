<?php
namespace App\Admin\Controllers;

use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TopicController extends Controller{
    //专题列表
    public function index(){

        $topics = Topic::all();
        return view('admin/topic/index',compact('topics'));
    }
    //增加专题
    public function create(){

        return view('admin/topic/create');

    }
    //处理增加的逻辑
    public function store(){
        $this->validate(request(),[
            'name'=>'required|string'
        ]);
        Topic::create(['name'=>request('name')]);
        return \redirect('/admin/topics');

    }
    //删除专题
    public function destroy(Topic $topic){
        $topic->delete();
        return [
            'error'=>0,
            'msg'=>''
        ];
    }

}
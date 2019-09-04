<?php
namespace App\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller{
    //登陆显示页面
    public function index(){
        return view('admin.login.index');
    }
    //登陆处理逻辑
    public function login(){

        //验证
        $this->validate(request(),[
            'name'     =>'required',
            'password' =>'required'
        ]);
        //逻辑处理
        $admin = request(['name','password']);
        if(Auth::guard('admin')->attempt($admin)){
            return redirect('/admin/home');
        }
        //反馈
        return Redirect::back()->withErrors('账号或密码输入错误！');
    }
    //登出处理
    public function logout(){
        Auth::guard('admin')->logout();
        return \redirect('admin/login');
    }

}
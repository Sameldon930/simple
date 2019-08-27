<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
        return view('register.index');
    }
    //注册的逻辑处理
    public function register(){

        //验证
        $this->validate(request(),[
           'name' => 'required|min:3|unique:users,name',
           'email' => 'required|unique:users:email|email',
            'password' =>'required|min:5|max:10|confirmed'
        ]);
        //验证通过 创建user
        $name = request('name');
        $name = request('email');
        $name = bcrypt(request('name'));


    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //登陆页面
    public function index(){
        return view('login.index');
    }
    //登陆的处理
    public function login(){
        //验证
        $this->validate(request(),[
            'email'=>'required|email',//邮箱
            'password'=>'required|min:5|max:10',//密码
            'is_remember'=>'integer'//是否记住
        ]);
        //逻辑
        $user = request(['email','password']);
        $is_remember = boolVal(request('is_remember'));//转换成布尔值
        $info = User::where('email','=',request('email'))->first();
        if($info === null){
            return redirect()->guest('login')->withError('登陆的账号不存在！');
        }
       if(Auth::attempt($user,$is_remember)){//如果登陆成功
//            成功进入
           return redirect('/posts');
        }
       //否则返回登陆页面
        return redirect()->guest('login')->withError('You are not logged in or Your session has expired');
    }
    //登出
    public function logout(){
        Auth::logout();
        return \redirect('/login');
    }
}

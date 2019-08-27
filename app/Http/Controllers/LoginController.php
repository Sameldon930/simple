<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //登陆页面
    public function index(){
        return view('login.index');
    }
    //登陆的处理
    public function login(){

    }
    //登出
    public function logout(){

    }
}

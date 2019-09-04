<?php
namespace App\Admin\Controllers;

use App\AdminUser;

class UserController extends Controller{

    //管理员列表
    public function index(){

        $admins = AdminUser::paginate(10);
        return view('admin.user.index',compact('admins'));
    }

    //新增管理员页面
    public function create(){

        return view('admin.user.add');
    }
    //管理员新增处理逻辑
    public function store(){
        //验证
        $this->validate(request(),[
            'name'=>'required|unique:admin_users,name',
            'password'=>'required|min:6|max:12'
        ]);
        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name','password'));

        return redirect('admin/users');
    }
}
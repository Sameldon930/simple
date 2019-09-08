<?php
namespace App\Admin\Controllers;

use App\AdminRole;
use App\AdminUser;

/**
 * Class UserController
 * @package App\Admin\Controllers
 * 管理员控制器
 */
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
    //管理员角色关联页面
    public function role(AdminUser $user){

        $roles = AdminRole::all();//获取所有角色

        $myRoles = $user->roles;//获取当前管理员所属的角色
        return view('/admin/user/role',compact('roles','myRoles','user'));
    }
    //处理管理员分配角色逻辑
    public function storeRole(AdminUser $user){
        $this->validate(request(),[
           'roles'=>'required|array'
        ]);
        $roles = AdminRole::find(request('roles'));

        $myRoles = $user->roles;

        //提交过来的数据对已配置的数据进行差集运算 得出所增加的角色
        $addRoles = $roles->diff($myRoles);

        //进行增加
        foreach($addRoles as $role) {
            $user->roles()->save($role);

        }
        //提交过来的数据对已配置的数据进行差集运算 得出所减少的角色 也就是要取消的角色
        $delRoles = $roles->diff($myRoles);

        //进行删除
        foreach ($delRoles as $role){
            $user->deleteRole($role);
        }
        return back();


    }
}
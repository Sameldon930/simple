<?php
namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;
use App\AdminUser;

/**
 * Class RoleController
 * @package App\Admin\Controllers
 * 角色控制器
 */
class RoleController extends Controller{

    //角色列表
    public function index(){
        $roles = AdminRole::paginate(10);
        return view('admin/role/index',compact('roles'));
    }
    //创建角色页面
    public function create(){
        return view('admin/role/add');

    }
    //处理创建角色逻辑
    public function store(){
        $this->validate(request(),[
           'name' =>'required',
            'description'=>'required'
        ]);
        AdminRole::create(request(['name','description']));
        return redirect('admin/roles');
    }
    //给角色分配权限页面
    public function permission(AdminRole $role){
        //获取所有权限
        $permissions = AdminPermission::all();

        //获取当前角色所拥有的权限
        $myPermissions = $role->permissions;
        return view('admin/role/permission',compact('permissions','myPermissions','role'));

    }
    //处理分配权限的逻辑
    public function storePermission(AdminRole $role){
        $this->validate(request(),[
            'permissions' => 'required|array'
        ]);
        //获取提交过来的权限
        $permissions = \App\AdminPermission::find(request('permissions'));
        //获取这个角色所拥有的权限
        $myPermissions = $role->permissions;

        // 将上面两个数据进行运算 得出增加的权限 进行增加处理
        $addPermissions = $permissions->diff($myPermissions);
        foreach ($addPermissions as $permission) {
            $role->grantPermission($permission);
        }

        $deletePermissions = $myPermissions->diff($permissions);
        foreach ($deletePermissions as $permission) {
            $role->deletePermission($permission);
        }
        return back();
    }

}
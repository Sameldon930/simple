<?php
namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminUser;

/**
 * Class PermissionController
 * @package App\Admin\Controllers
 * 权限控制器
 */
class PermissionController extends Controller{

    //权限列表
    public function index(){
        $permissions = AdminPermission::paginate(10);
        return view('admin/permission/index',compact('permissions'));
    }
    //创建权限页面
    public function create(){
        return view('admin/permission/add');

    }
    //处理创建权限逻辑
    public function store(){
        $this->validate(request(),[
           'name' =>'required',
            'description'=>'required'
        ]);
        AdminPermission::create(request(['name','description']));
        return redirect('admin/permissions');
    }


}
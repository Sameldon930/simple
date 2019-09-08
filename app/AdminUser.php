<?php

namespace App;
use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable
{
    //实际表名
    protected $table = 'admin_users';
    //忽略防注入验证
    protected $guarded = [];
    //忽略remember_token的验证
    protected $rememberTokenName = '';

    //管理员拥有哪些角色  多对多
    public function roles(){
        //建立 管理员表 角色表 还有 管理员角色关系表 三个表之间的关系  并将所涉及的字段拿出来
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    //判断是否存在某个角色  也就是当前这个角色是否存在角色表中
    public function isInRoles($roles){
        //进行对比  得出是否存在与现有的角色中  0返回false表示不存在  1返回true表示存在
        return !!$roles->intersect($this->roles())->count();
    }

    //给管理员分配角色
    public function assignRole($role){
        //调用方法 分配之后 也会保存管理员和角色的关系
        return $this->roles()->save($role);
    }

    //取消管理员所分配的角色
    public function deleteRole($role){
        //删除关系表中的 管理员和角色的关系 那条数据
        return $this->roles()->detach($role);
    }

    //管理员是否有权限
    public function hasPermission($permission){
        return  $this->isInRoles($permission->roles);
    }
}

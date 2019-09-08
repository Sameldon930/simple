<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminRole extends Authenticatable
{
    protected $table = 'admin_roles';
    protected $fillable = [
        'name','description'
    ];
    //角色和权限的关系
    public function permissions(){
        //配置三表关系 角色表 权限表  角色权限关系表 取出关联表中的字段
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','role_id','permission_id')->withPivot(['role_id','permission_id']);
    }
    //给角色分配权限  也就是想两者关系 保存在 角色权限关系表
    public function grantPermission($permission){
        return $this->permissions()->save($permission);
    }
    //取消角色所拥有的权限
    public function  deletePermission($permission){
        return $this->permissions()->detach($permission);
    }

    //判断角色是否拥有某个权限  也就是判断某个权限是否包含在其中
    public function hasPermission($permission){
        return $this->permissions()->contains($permission);
    }
}

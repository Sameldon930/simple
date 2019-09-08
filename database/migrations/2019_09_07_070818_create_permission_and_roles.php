<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePermissionAndRoles
 * 权限相关的表
 */
class CreatePermissionAndRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //角色表
        Schema::create('admin_roles',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->default('')->comment('角色名称');
            $table->string('description',100)->default('角色详细配置');
            $table->timestamps();
        });
        //权限表
        Schema::create('admin_permissions',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->default('')->comment('权限名称');
            $table->string('description',100)->default('')->comment('权限详细配置');
            $table->timestamps();
        });
        //权限角色关系表
        Schema::create('admin_permission_role',function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id')->comment('角色id');
            $table->integer('permission_id')->comment('权限详细配置');
            $table->timestamps();
        });
        //管理员角色关系表
        Schema::create('admin_role_user',function (Blueprint $table){
            $table->increments('id');
            $table->integer('role_id')->comment('角色id');
            $table->integer('user_id')->comment('管理员id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_role_user');
    }
}

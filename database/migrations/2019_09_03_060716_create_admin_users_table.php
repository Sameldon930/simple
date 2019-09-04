<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建后台管理员表
        Schema::create('admin_users',function (Blueprint $table){
            $table->increments('id');
            $table->string('name',30)->comment('管理员名称');
            $table->string('password',100)->comment('管理员密码');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('admin_users');
    }
}

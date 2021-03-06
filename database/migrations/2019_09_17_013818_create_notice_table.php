<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //系统通知表
        Schema::create('notices',function (Blueprint $table){
            $table->increments('id');
            $table->string('title',50)->comment('通知标题');
            $table->string('content',1000)->default("")->comment("通知内容");
            $table->timestamps();
        });
        //用户和通知关系表
        Schema::create('user_notice',function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment('用户id');
            $table->integer('notice_id')->default(0)->comment('通知id');
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
        Schema::dropIfExists('notices');
        Schema::dropIfExists('user_notice');
    }
}

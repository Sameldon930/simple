<?php

/**
 * 总后台的路由文件
 */

//后台的路由组
Route::group(['prefix'=>'admin'],function (){

    //登陆显示页面
    Route::get('/login','\App\Admin\Controllers\LoginController@index');
    //登陆处理逻辑
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    //登出处理
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');
    Route::group(['middleware'=>'auth:admin'],function(){

        //后台首页
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        //管理员模块
        Route::get('/users','\App\Admin\Controllers\UserController@index');//管理员列表
        Route::get('/users/create','\App\Admin\Controllers\UserController@create');//管理员新增页面
        Route::post('/users/store','\App\Admin\Controllers\UserController@store');//管理员新增验证逻辑

        //文章审核模块
        Route::get('/posts','\App\Admin\Controllers\PostController@index');//获取待审核文章
        Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');//审核文章逻辑处理

    });

});
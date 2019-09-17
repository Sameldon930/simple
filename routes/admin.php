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

        //使用门卫 进行权限验证  这个模块是系统管理模块  包含 管理员 角色 权限 的功能
//        Route::group(['middleware'=>'can:system'],function (){
            //管理员模块
            Route::get('/users','\App\Admin\Controllers\UserController@index');//管理员列表
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');//管理员新增页面
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');//管理员新增验证逻辑
            Route::get('/users/{user}/role','\App\Admin\Controllers\UserController@role');//管理员角色关联页面
            Route::post('/users/{user}/role','\App\Admin\Controllers\UserController@storeRole');//处理管理员分配角色逻辑

            //权限
            Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');//权限列表
            Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');//创建权限页面
            Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');//处理创建权限逻辑

            //角色相关
            Route::get('/roles','\App\Admin\Controllers\RoleController@index');//角色列表
            Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');//创建角色页面
            Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');//处理创建角色逻辑
            Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');//给角色分配权限页面
            Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@storePermission');//处理分配权限的逻辑
//        });

        //使用门卫 进行权限验证  这个模块是文章管理模块
//        Route::group(['middleware'=>'can:post'],function (){
            //文章审核模块
            Route::get('/posts','\App\Admin\Controllers\PostController@index');//获取待审核文章
            Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');//审核文章逻辑处理
//        });

        //使用门卫 进行权限验证  这个模块是通知管理模块  只用到 列表页 增加  不需要删除
//        Route::group(['middleware'=>'can:notice'],function (){
            Route::resource('notices','\App\Admin\Controllers\NoticeController',[
                'only'=>['index','create','store']
            ]);
//        });

        //使用门卫 进行权限验证  这个模块是专题管理模块
//        Route::group(['middleware' => 'can:topic'], function(){
            Route::resource('topics', '\App\Admin\Controllers\TopicController', ['only' => [
                'index', 'create', 'store', 'destroy'
            ]]);
//        });










    });

});
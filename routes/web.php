<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//文章列表页
Route::get('/posts','PostController@index');
//文章详情页
Route::get('/posts/{post}','PostController@show');
//创建文章 -- 页面
Route::get('/post/create','PostController@create');
//创建文章 -- 保存
Route::post('/posts','PostController@store');
//编辑文章 --读取数据
Route::get('/posts/{post}/edit','PostController@edit');
//编辑文章 --保存
Route::put('/posts/{post}','PostController@update');
//删除文章
Route::get('/posts/{post}/delete','PostController@delete');
//图片上传路由
Route::post('/posts/image/upload','PostController@imageUpload');

/**
 * 用户模块
 */

//注册页面
Route::get('/register','RegisterController@index');
//注册的处理
Route::post('/register','RegisterController@register');
//登陆页面
Route::get('/login','LoginController@index');
//登陆的处理
Route::post('/login','LoginController@login');
//登出
Route::get('/logout','LoginController@logout');
//个人设置页面
Route::get('/user/me/setting','UserController@setting');
//个人设置处理
Route::post('/user/me/setting','LoginController@settingStore');


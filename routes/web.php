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

/**
 * 用户模块
 */
//用户模块
Route::get('/',function(){
   return redirect('/login');
});
//注册页面
Route::get('/register','RegisterController@index');
//注册的处理
Route::post('/register','RegisterController@register');
//登陆页面
Route::get('/login','LoginController@index')->name('login');
//登陆的处理
Route::post('/login','LoginController@login');

Route::group(['middleware'=>'auth:user'],function(){
    //登出
    Route::get('/logout','LoginController@logout');


    //个人设置页面
    Route::get('/user/me/setting','UserController@setting');
    //个人设置处理
    Route::post('/user/{user}/setting','UserController@settingStore');


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
    //提交评论
    Route::post('/posts/{post}/comment','PostController@comment');


    //点赞
    Route::get('/posts/{post}/zan','PostController@zan');
    //取消赞
    Route::get('/posts/{post}/unzan','PostController@unzan');


    //个人中心
    Route::get('/user/{user}','UserController@show');
    //对某个用户进行关注
    Route::post('/user/{user}/fan','UserController@fan');
    //取消关注
    Route::post('/user/{user}/unfan','UserController@unfan');


    //专题详情页
    Route::get('/topic/{topic}','TopicController@show');
    //专题投稿
    Route::post('/topic/{topic}/submit','TopicController@submit');


    //通知模块
    Route::get('/notices','NoticeController@index');

});

include_once "admin.php";





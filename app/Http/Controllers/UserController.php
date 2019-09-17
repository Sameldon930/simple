<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人中心页面
    public function show(User $user){
        //获取个人信息  个人的关注 粉丝 文章数
        $user = User::withCount(['fans','stars','posts'])->find($user->id);
        //个人的文章列表 取出最新创建的十条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //获取这个人关注的用户 以及这个用户下的 关注数 粉丝数 文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['fans','stars','posts'])->get();
        //获取这个人的粉丝 以及这个粉丝下的  关注数 粉丝数 文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['fans','stars','posts'])->get();
        return view('user/show',compact('user','posts','susers','fusers'));
    }

    //关注用户
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>'关注成功'
        ];
    }

    //取消关注
    public function unfan(User $user){
        $me = Auth::user();
        $me->doUnfan($user->id);
        return [
            'error'=>0,
            'msg'=>'取关成功'
        ];
    }
    //个人设置页面
    public function setting(){
        $me = Auth::user();
        return view('user/setting', compact('me'));
    }
    //个人设置处理
    public function settingStore(Request $request,User $user){

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly(md5(\Auth::id() . time()));
            $user->avatar = "/storage/". $path;
        }

        $user->save();
        return back();
    }
}

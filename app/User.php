<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //不能被注入的字段
    protected $fillable = [
        'name','email','password'
    ];

    //获取当前用户有多少文章
    public function posts(){
        return $this->hasMany('App\Post','user_id','id');
    }

    //获取当前用户拥有多少粉丝--当前用户是被关注的 所以star_i 等于当前用户的id
    public function fans(){
        return $this->hasMany('App\Fan','star_id','id');
    }

    //获取当前用户关注了哪些人---当前用户是粉丝 所以 fan_id 等于当前用户的id
    public function stars(){
        return $this->hasMany('App\Fan','fan_id','id');
    }

    /**
     * 当前用户 需要关注 某个用户
     * 参数  被关注的用户id
     */
    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;//传入的id就是等于粉丝表的被关注id
        //进行保存
        return $this->stars()->save($fan);
    }

    /**
     * 取消关注
     * 参数  被关注的用户id
     */
    public function doUnfan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;//传入的id就是等于粉丝表的被关注id
        //进行删除
        return $this->stars()->delete($fan);
    }

    /**
     * @param $uid
     * @return mixed
     * 当前用户是否被人关注 并算出总数
     */
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    /**
     * 当前用户是否关注某个用户  并算出总数
     */
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }


}

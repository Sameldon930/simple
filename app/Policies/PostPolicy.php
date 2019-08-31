<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //定义编辑文章的策略 规定文章可以被谁修改 判断文章的user_id是否等于当前登陆id 等于就是有权限修改 否则没有权限修改
    public function update(User $user,Post $post){
        return $user->id == $post->user_id;
    }

    //删除文章的策略
    public function delete(User $user,Post $post){
        return $user->id ==  $post->user_id;
    }
}

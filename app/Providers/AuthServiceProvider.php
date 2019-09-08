<?php

namespace App\Providers;

use App\AdminUser;
use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissions = \App\AdminPermission::all();

        //获取所有权限  每条权限的名称放入门卫中 用来做权限的过滤  匿名函数中传递参数 use
        foreach ($permissions as $permission){
            Gate::define($permission->name,function (AdminUser $user) use($permission){
                //判断当前登陆的管理员是否有资格访问这个权限
                return $user->hasPermission($permission);
            });
        }
    }
}

<?php

namespace App;
use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AdminUser extends Authenticatable
{
    //实际表名
    protected $table = 'admin_users';
    //忽略防注入验证
    protected $guarded = [];
    //忽略remember_token的验证
    protected $rememberTokenName = '';
}

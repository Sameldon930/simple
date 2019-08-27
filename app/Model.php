<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    //
    protected $guarded  = [];//表示不可以注入的字段
}

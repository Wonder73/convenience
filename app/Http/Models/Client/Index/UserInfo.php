<?php

namespace App\Http\Models\Client\Index;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //表名
    protected $table = 'user_info';
    //主键
    protected $primarykey = 'id';
    //操作字段
    protected $fillable = ['user_id', 'app'];
    //不要时间戳
    public $timestamps = false;
}

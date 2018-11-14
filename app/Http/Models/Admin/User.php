<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    //use SoftDeletes;
    //声明三个受保护成员
    protected $primary = 'id';
    protected $table = 'user_info';
    protected $fillable = ['user_id','nickname','major','real_name','qq','birth','phone','head','app','date'];
    //public $timestamps = false;
    //protected $guarded = [排除入库的数组]
}

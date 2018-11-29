<?php

namespace App\Http\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    
    protected $fillable = ['id','role_name','date'];
    
    //关闭时间戳
    public $timestamps = false;
}

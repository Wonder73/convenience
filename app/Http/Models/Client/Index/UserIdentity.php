<?php

namespace App\Http\Models\Client\Index;

use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
    protected $table = 'user_identity';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'role_id', 'check'];
    public $timestamps = false;

    public function user (){
        return $this -> hasOne('App\Http\Models\Client\Index\User', 'id', 'user_id');
    }

    public function user_info(){
        return $this -> hasOne('App\Http\Models\Client\Index\UserInfo', 'user_id', 'user_id');
    }

    //获取水电费后勤人员的id
    public function getlogisticsUserId(){
        $role_id = 4;    //水电费后勤角色id
        
        $logisticsInfo = UserIdentity::where('role_id', $role_id) -> orderBy('id') -> select('user_id') -> first();   //获取后勤人员身份信息
        
        return $logisticsInfo -> user_id;    //获取后勤人员的用户id
    }
}

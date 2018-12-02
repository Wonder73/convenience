<?php

namespace App\Http\Models\Client\Index;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //表名
    protected $table = 'user';
    //主键
    protected $primarykey = 'id';
    //操作字段
    protected $fillable = ['username', 'password', 'email', 'salt'];
    //关闭时间戳
    public $timestamps = false;

    public function user_identity (){
        return $this -> hasOne('App\Http\Models\Client\Index\UserIdentity', 'user_id', 'id');
    }
    public function user_info (){
        return $this -> hasOne('App\Http\Models\Client\Index\UserInfo', 'user_id', 'id');
    }

    //用户身份验证
    public function checkIdentity($data, $roleId){
        $userInfo = json_decode($data['userInfo'], true);

        //从数据库中获取数据
        $info = User::with('user_identity') -> where('id', $userInfo['id']) -> get();
        
        if($info && $info[0]['username'] == $userInfo['username'] && $info[0]['password'] == md5($userInfo['password'].$info[0]['salt']) && $info[0]['user_identity']['role_id'] == $roleId && $info[0]['user_identity']['check']){
            return ['type' => true, 'info' => '身份正确'];
        }else {
            return ['type' => false, 'info' => '身份错误'];
        }
    }
}

<?php

namespace App\Http\Models\Client\Utilities;

use Illuminate\Database\Eloquent\Model;

class AA extends Model
{
    protected $table = 'aa';
    protected $primarykey = 'id';
    protected $fillable = ['utilities_id', 'user_id', 'cost'];

    public $timestamps = false;

    public function user (){
        return $this -> hasOne('App\Http\Models\Client\Index\User', 'id', 'user_id');
    }

    public function user_info(){
        return $this -> hasOne('App\Http\Models\Client\Index\UserInfo', 'user_id', 'user_id');
    }

    
    //往AA表中初始化数据
    public function insertAAData($utilitiesId, $cost, $info){

        forEach($info as $k => $v){
            AA::create([
                'utilities_id' => $utilitiesId,
                'user_id' => $v -> user_id,
                'cost' => $cost
            ]);
        }
        
    }

    //标志完成支付的用户
    public function complete_pay($utilitiesId, $userId){
        $info = AA::where([
            ['user_id', '=', $userId],
            ['utilities_id', '=', $utilitiesId],
        ])->first();

        $info -> complete_pay = 1;
        $info -> save();
    }
}

<?php

namespace App\Http\Models\Client\Utilities;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Client\Index\UserIdentity;
use App\Http\Models\Client\Utilities\Utilities;
use App\Http\Models\Client\Utilities\AA;
use App\Http\Models\Client\Utilities\Consume;

class Pay extends Model
{
    protected $table = 'pay';
    protected $primarykey = 'id';
    protected $fillable = ['money', 'error_count', 'cooling_date'];

    public $timestamps = false;


    //检查支付密码 $payUserId支付人id，$payPassword支付人密码
    public function checkPay ($payUserId, $payPassword){
        $message = ["type" => false, "info" => ""];

        $info = Pay::where('user_id', $payUserId) -> first();

        //用户没有弄支付设置
        if(!$info) {
            $message["type"] = false;
            $message["info"] = "抱歉，您没有设置支付密码，所以无法进行支付！！！";

            return $message;
        }

        //判断用户用户能不能进行支付
        if($info -> error_count >= 5 && !$this -> passCooling($info -> cooling_date, $info)){
            $message["type"] = false;
            $message["info"] = "支付冷却中...请等待24小时后操作！！！";
        }else {
            if($this -> checkPassword($payPassword, $info)){
                $message["type"] = true;
            }else{
                $message["type"] = false;
                $message["info"] = "密码输入错误！！！";
            }
        }

        return $message;
    }

    //检查有没有过冷却时间
    private function passCooling($cooling_date, $info){
        $today = time();
        $cooling_date = strtotime($info -> cooling_date);

        if($cooling_date && $today - $cooling_date >= (60*60*24)){

            $info -> error_count = 0;
            $info -> cooling_date = '';
            $info -> save();

            return true;
        }else {
            return false;
        }
    }

    //检查密码是否输入正确
    private function checkPassword($payPassword, $info){

        //当错误不超过5次时，隔天清除记录
        if($info -> cooling_date && time() > strtotime(date('Y-m-d', strtotime($info -> cooling_date . '+1 day')))){
            $info -> error_count = 0;
            $info -> cooling_date = null;
            $info -> save();
        }

        if(md5($payPassword.$info -> salt) == $info -> pay_password){
            return true;
        }else{
            $info -> error_count += 1;
            $info -> cooling_date = date('Y-m-d H:i:s');

            $info -> save();

            return false;
        }
    }

    //进行支付
    public function pay($data) {
        $userIdentity = new UserIdentity();
        $utilities = new Utilities();
        $aa = new AA();
        $message = ["type" => false, "info" => ""];   //返回的数据


        $logisticsUserId = $userIdentity -> getlogisticsUserId();    //获取水电费管理员的id
        $primaryData = ['payUserId' => $data['payUserId'], 'logisticsUserId' => $logisticsUserId, 'cost' => $data['cost'], 'category' => $data['category']];       //储存一下必要数据

        if($res = $this -> modifyUserMoney($primaryData) && $this -> modifyLogisticsMoney($primaryData) && $utilities -> modifyUtilitiesCost($data['utilitiesId'], $data['cost'])){
            
            //判断是否是aa支付，如果不是就要标志那个已经交钱的用户
            if($data['oneKey'] == 0){
                $aa -> complete_pay($data['utilitiesId'], $data['userId']);   //完成支付
            }

            $message['type'] = true;
            $message['info'] = "支付成功！！！";
        }else {
            if($res){
                $message['type'] = false;
                $message['info'] = "支付失败，请检查网络是否正常！！！";
            }else {
                $message['type'] = false;
                $message['info'] = "支付失败，余额不足！！！";
            }
        }

        return $message;
    }

    //修改支付用户的金额
    private function modifyUserMoney ($data){
        $consume = new Consume();
        $info = Pay::where('user_id', $data['payUserId']) -> first();

        if($info -> money >= $data['cost']){
            $info -> money -= $data['cost'];
            $info -> save();

            //记录
            $organization = $data['category'] == '0'? '水费': ($data['category'] == '1'? '电费': '网费');
            $consume -> insertConsume([
                'user_id' => $data['payUserId'], 
                'pay_user_id' => $data['logisticsUserId'], 
                'organization' => $organization,
                'consume_type' => 0,
                'consume_cost' => $data['cost'],    
            ]);

            return true;
        }else {
            return false;
        }
    }

    //修改管理员的金额
    private function modifyLogisticsMoney ($data) {
        $consume = new Consume();
        $info = Pay::where('user_id', $data['logisticsUserId']) -> first();

        if($info){
            $info -> money += $data['cost'];
            $info -> save();

            //记录
            $organization = $data['category'] == '0'? '水费': ($data['category'] == '1'? '电费': '网费');
            $consume -> insertConsume([
                'user_id' => $data['logisticsUserId'], 
                'pay_user_id' => $data['payUserId'], 
                'organization' => $organization,
                'consume_type' => 1,
                'consume_cost' => $data['cost'],
            ]);

            return true;
        }else {
            return false;
        }

    }
    

}

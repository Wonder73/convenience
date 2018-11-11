<?php

namespace App\Http\Controllers\Client\Utilities;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Utilities\Utilities;
use App\Http\Models\Client\Utilities\AA;
use App\Http\Models\Client\Utilities\Pay;
use App\Http\Models\Client\Index\UserIdentity;

class IndexController extends Controller
{
    //视图展览
    public function index(Request $request) {
        return view('client\utilities\utilities');
    }

    //获取收缩结果
    public function query(Request $request) {
        $data = $request -> all();
        
        $info = Utilities::with(['porms' => function ($query) {
            $query -> with([
                'user' => function ($query){
                    $query -> select('id', 'username');
                }, 
                'user_info' => function ($query){
                    $query -> select('id', 'user_id', 'nickname');
                },
            ])-> select('utilities_id', 'user_id', 'cost', 'complete_pay');
        }]) -> where([
            ['category', '=', $data['category']], 
            ['ridgepole', '=', $data['ridgepole']], 
            ['dorm_num', '=',  $data['dormNum']],
            ['start_month', '>=',  $data['startMonth']],
            ['end_month', '<=',  $data['endMonth']],
        ]) -> select('id', 'ridgepole', 'dorm_num as dormNum', 'category', 'last_degrees as lastDegrees', 'this_degrees as thisDegrees', 'practical_degrees as practicalDegrees','price', 'cost', 'has_pay as hasPay', 'start_month as startMonth', 'end_month as endMonth', 'complete_pay as completePay', 'aa', 'date') 
           -> get();

           
        return $info;
    }
        
    //获取AA人的信息
    public function getAAInfo(Request $request) {
        $aa = new AA();    //实例化aa模型
        $utilities = new Utilities();   //实例化utilities模型
        $data = $request -> all();
        
        $info = UserIdentity::with([
            'user' => function ($query){
                $query -> select('id', 'username');
            }, 
            'user_info' => function ($query){
                $query -> select('id', 'user_id','nickname');
            },
        ]) 
        -> where([
            ['ridgepole', '=', $data['ridgepole']],
            ['dorm_num', '=', $data['dormNum']]
        ]) -> get();
            
        //往aa表里插入数据
        $aa -> insertAAData($data['utilitiesId'], $data['cost']/count($info), $info);
        //标识开启了aa
        $utilities -> updateUtilitiesAA($data['utilitiesId']);

        return $info;
    }

    //处理支付
    public function handlePay(Request $request) {
        $pay = new Pay();   //实例化Pay模型
        $data = $request -> all();    //获取post过来的数据

        //检查支付密码是否输入正确
        $res = $pay -> checkPay($data['payUserId'], $data['payPassword']);
        if($res['type']){
            return $pay -> pay($data);
        }else{
            return $res;
        }
    }
}


//update `yb-utilities` set complete_pay=0;update `yb-utilities` set has_pay=0;update `yb-aa` set complete_pay=0;
//delete from `yb-aa`; update `yb-utilities` set aa=0
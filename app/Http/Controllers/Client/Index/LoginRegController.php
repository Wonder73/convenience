<?php

namespace App\Http\Controllers\Client\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Index\User;
use App\Http\Models\Client\Index\UserInfo;
use App\Http\Models\Admin\AppManage\App;
use App\Http\Models\Client\Index\UserIdentity;
use Mail;

//登录和注册控制器
class LoginRegController extends Controller
{   
    //获取验证码
    public function getValidate(Request $request){
        $emailInfo = $request -> all();   //获取post过来的所有数据
        $to = $emailInfo['email'];   //邮箱地址

        $res = User::where('email', $to) -> count();
        if($res > 0 && $emailInfo['register'] == 'true' ){
            return 1;
        }else if($res <= 0 && $emailInfo['register'] == 'false') {
            return 2;
        }else{
            $flag = $this -> sendMail($to);

            if(!!$flag){
                return $flag;
            }else {
                return 2;
            }
        }
    }

    //获取热门应用
    public function getHotApp(Request $request) {

        $res = App::where([
            ['app_permission', 'like', '%2%'],
          ]) -> select('id', 'app_name as name') -> limit(10) -> offset(0) -> orderBy('id', 'desc') -> get();

        return $res;
    }

    //完成注册
    public function register(Request $request){

        $info = $request -> all();    //获取post过来的数据
        $salt = $this -> randomStr(4);

        //往用户表插入数据
        $user = ['username' => $info['username'], 'password' => md5($info['password'] . $salt), 'email' => $info['email'], 'salt' => $salt];
        $res = User::create($user);

        //往用户信息表插入数据
        $userInfo = ['user_id' => $res -> id, 'app' => $info['hotApp']];
        $res = UserInfo::create($userInfo);

        //往用户权限变插入数据
        $UserIdentity = ['user_id' => $res -> id, 'role_id' => 1, 'check' => 0];
        $res = UserIdentity::create($UserIdentity);
        
        //判断输出
        if($res) {
            return 1;
        }else {
            return 0;
        }
    }

    //用户登录
    public function login(Request $request){
        $info = $request -> all();

        return $this -> checkUser($info);
    }
    //用户邮箱登录
    public function emailLogin(Request $request){
        $info = $request -> all();
        $res = User::with('user_identity')->with(['user_info' => function ($query){
            $query -> select('user_id', 'app');
        }])->where('email', $info['email']) -> get() -> toArray();

        if($res) {
            return '{"id": "'. $res[0]['id'] .'", "username": "'. $res[0]['username'] .'", "password": "'. $res[0]['password'] .'", "email": "'. $res[0]['email'] .'", "user_identity": '. json_encode($res[0]['user_identity']) .', "user_app": '. json_encode($res[0]['user_info']['app']) .'}';
        }else{
            return 1;
        }
    }

    //检查用户登录
    public function checkLogin(Request $request) {
        $info = $request -> all();

        $res = $this -> checkUser($info);

        if(strlen($res) > 1){
            return $res;
        }else{
            return 0;
        }
    }

    //判断数据库中是否有该用户
    private function checkUser($info){
        $res = User::with('user_identity')->with(['user_info' => function ($query){
            $query -> select('user_id', 'app');
        }])->where('username', $info['username']) -> get() -> toArray();
        
        if($res) {
            if($res[0]['username'] == $info['username'] && ($res[0]['password'] == md5($info['password'] . $res[0]['salt']) || $res[0]['password'] == $info['password'])){
                return '{"id": "'. $res[0]['id'] .'", "username": "'. $info['username'] .'", "password": "'. $info['password'] .'", "email": "'. $res[0]['email'] .'", "user_identity": '. json_encode($res[0]['user_identity']) .', "user_app": '. json_encode($res[0]['user_info']['app']) .'}';
            }else{
                return 2;
            }
        }else{
            return 1;
        }
    }

    //发送邮件
    private function sendMail($to) {

        $validate = $this -> randomStr(6);   //获取验证码

        $flag = Mail::send('emails.test', ['validate' => $validate], function ($message) use($to){
            $message -> to($to) -> subject('优便校园验证码');
        });

        return $this -> encryption($validate);
    }

    //获取随机字符串
    private function randomStr($length){
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';
        $validate = '';   //保存验证码

        for($i = 0; $i < $length; $i++){
            $validate .= $str[rand(0, strlen($str)-1)];
        }

        return $validate;
    }

    //对验证码进行加密，
    private function encryption ($code) {
        //对验证码进行加密
        $data = bin2hex(strrev(strtolower($code)));
        $newData = '';
        $newData2 = '';
        $newData3 = '';
        $newData4 = '';

        for($i=0;$i<strlen($data);$i++){
          $newData .= base_convert($data[$i],16,10);
        }
        for($i=0;$i<strlen($newData);$i++){
          $newData2 .= base_convert($newData[$i],10,8);
        }
        for($i=0;$i<strlen($newData2);$i++){
          $newData3 .= base_convert($newData2[$i],10,2);
        }
        for($i=0;$i<strlen($newData3);$i++){
          $newData4 .= ($newData3[$i] == '0'?'1':'0');
        }
        return strrev(base_convert($newData4,2,10));
    }

}

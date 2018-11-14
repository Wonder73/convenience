<?php

namespace App\Http\Controllers\Client\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Index\Role;
use App\Http\Models\Client\Index\UserIdentity;
use App\Http\Models\Client\Utilities\Pay;
use App\Http\Models\Client\Utilities\Consume;

use Validator;

use DB;

class IndexController extends Controller
{
    public function updateidentity(Request $request){
        $user_id = $request->input('user_id');
        $rolename = $request->input('role_id');
        
        $info = Role::where('role_name',$rolename)->get();
        $role_id = $info[0]['id'];
        $res = UserIdentity::where('user_id',$user_id)->update([
            'role_id'=>$role_id,
            'ridgepole'=>$request->input('ridgepole'),
            'dorm_num'=>$request->input('dorm_num')
        ]);
        if($res){
            return redirect('home');
        }else{
            echo '失败';
        }
    }

    public function get(Request $request){
        $id = $request->input('id');        
        $data = DB::table('user_info')->where('user_id',$id)->get();
        $identity = UserIdentity::where('user_id',$id)->get();
        $roleid = $identity[0]['role_id'];

        $rolename = Role::where('id',$roleid)->pluck('role_name');
        return ['data'=>$data,'identity'=>$identity,'rolename'=>$rolename]; 
    }
    public function userCenter(){
        $now = date('Y-m-d');
        $role = Role::get();
        
        return view('client/userCenter', compact('now','role'));  
    }
    
    public function updateUser(Request $request){
        //$data = $request->all();
        
        $id = $request->input('user_id');
        $info= $request->all();
            $info['head']=$request->input('head');
            $head = $request->file('head');
            if($request->hasFile('head') && $head->isValid()){
              //获取文件后缀
                $ext = $head->getClientOriginalExtension();
                //获取文件上传原名
                $oldname = $head->getClientOriginalName();
                //获取文件的大小
                $filesize = $head->getClientSize();
                //创建新的文件名称
                $newname = uniqid().date('Y-m-d-H-i-s').'.'.$ext;
                //移动到目标文件夹
                $head->move('./uploads/image/',$newname);
                //文件路径存储
                $info['head'] = "/uploads/image/".$newname;
            }
            if($info['head']==''){
                $res =  DB::table('user_info')->where('user_id',$id)->update([
                'nickname'=>$info['nickname'],
                'major'=>$info['major'],
                'real_name'=>$info['real_name'],
                'major'=>$info['major'],
                'qq'=>$info['qq'],
                'birth'=>$info['birth'],
                'phone'=>$info['phone'],
                'date'=>date('Y-m-d H-i-s')         
                ]);
            }else{
                $res =  DB::table('user_info')->where('user_id',$id)->update([
                    'nickname'=>$info['nickname'],
                    'major'=>$info['major'],
                    'real_name'=>$info['real_name'],
                    'major'=>$info['major'],
                    'qq'=>$info['qq'],
                    'birth'=>$info['birth'],
                    'phone'=>$info['phone'],
                    'head'=>$info['head'],
                    'date'=>date('Y-m-d H-i-s')         
                ]);
            }
            if($res){
                return redirect('home');
            }else{
                return ['data'=>'error'];
            }
    }

    //获取余额
    public function getMoney(Request $request){
        $data = $request -> all();

        $res = Pay::where('user_id', $data['userId']) -> first();
        
        return ['type' => true, 'money' => $res['money']];
    }

    //用户支付
    public function handlePay(Request $request){
        $pay = new Pay();   //实例化Pay模型
        $data = $request -> all();    //获取post过来的数据

        //检查支付密码是否输入正确
        $res = $pay -> checkPay($data['payUserId'], $data['payPassword']);
        if($res['type']){
            return $pay -> topUp($data);
        }else{
            return $res;
        }
    }

    //获取零钱明细
    public function getPayDetail(Request $request) {
        $data = $request -> all();

        $res = Consume::where('user_id', $data['userId']) -> limit($data['limit']) -> offset(($data['offset']-1)*$data['limit']) -> select('organization', 'consume_cost', 'consume_type', 'date') -> orderBy('date', 'desc') -> get();

        if($res) {
            return ['type' => true, 'dataSource' => $res];
        }else {
            return ['type' => false, 'dataSource' => ''];
        }
    }
}
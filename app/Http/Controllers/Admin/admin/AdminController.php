<?php

namespace App\Http\Controllers\Admin\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Admin;
use Auth;
use Validator;
use Storage;

class AdminController extends Controller
{
    //显示登录页面
    public function login() {
        return view('admin/admin/login');
    }
    
    //登录
    public function loginok(Request $request) {
         $this->validate($request,[
            'username'=>'required|min:2',
            'password'=>'required|between:6,12',
            'captcha'=>'required|captcha',
        ]);
        $info = $request->all();
        $res = Admin::where([
            ['username', $info['username']],
            ['password', $info['password']],
        ]) -> get() -> toArray();
         if($res){
             return redirect('yb-admin');
         }
         else{
             return back()->withErrors(['msg'=>'username or password error!']);
         }
    }
    //退出登陆
     public function loginout() {
        return view('admin/admin/login');
    }
    //后台管理人员
    public function adminlist() {
        $data = Admin::all();
        return view('admin/admin/adminlist',compact('data')); 
    }
    //删除后台管理人员
    public function admindel(Request $request){
            $id = $request->input('id');
            $info=Admin::find($id);
            $info->delete();
            return ['info'=>1];
    }
    //添加后台管理人员
    public function adminadd(Request $request){
        if($request->isMethod('get')){
            //加载显示表单
            //获取栏目的数据
            $data = Admin::all();
            return view('admin/admin/adminadd',compact('data'));
        }else if($request->isMethod('post')){
            //判断是否是post提交；
            $data = $request->all();
            $rules = [
                'username'=>'required',
                'password'=>'required|min:6'
            ];
            $msg = [
                'username.required'=>'管理员名称不能为空',
                'password.min'=>'密码至少是6个字符'
            ];
            $validator = Validator::make($data,$rules,$msg);
            if($validator->passes()){
                Admin::create($data);
                return ['info'=>1];
            }else {
                $error = collect($validator->messages())->implode('0', ',');
                return ['info'=>0,'error'=>$error];
            }
        } 
    }   
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Role;
use DB;
class RoleController extends Controller
{
    public function index(){
        $count = Role::count();
        $data = Role::get();
        //var_dump($data);
        return view('admin/roleIndex', compact('data','count'));
    }
    
    public function addRole(Request $request){
        if($request->isMethod('get')){
           return view('admin/addRole'); 
        }
        if($request->isMethod('post')){
            $role_name = $request->input('role_name');
            $data = ['role_name'=>$role_name];
            $res = DB::table('role')->insert($data);
            if($res){
                return ['info'=>1];
            } else {
                return ['info'=>0];
            }
        }      
    }
    
    public function delRole(Request $request){
        //接收传递过来的数据
        $id = $request->input('id');
        $info = Role::find($id); //返回要删除的数据
        //删除记录
        $res = $info->delete();
        if($res){
           return ['info'=>1];
        }
        else{
            return ['info'=>0];
        }
    }
    
    //修改商品
    public function updateRole(Request $request,Role $role) {
        //Goods $goods相当于$goods = Goods::find(id)
        if($request->isMethod('get')){
    		//加载显示表单
    		//获取栏目的数据
    		$data = Role::all();
    		return view('admin/updateRole',compact('role','data'));
    	}else if($request->isMethod('post')){
    		//判断是否是post提交；
//                $role_name = $request->input('role_name');
//                $data = ['role_name'=>$role_name];
//                $res = DB::table('role')->insert($data);
                
    		$data = $request->all();
                $res =$role->update($data);
                if($res){
                    return ['info'=>1];
                 }
                 else{
                     return ['info'=>0];
                 }
                    
                }
    }
}

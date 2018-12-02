<?php

namespace App\Http\Controllers\Client\Index;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Admin\AppManage\App;
use App\Http\Models\Client\Index\UserInfo;

class IndexController extends Controller
{
  public function index(Request $request){
    return view('client\index');
  }

  //获取用户添加的app
  public function getApp(Request $request){
    $data = $request -> all();

    $res = App::whereIn('id', $data['apps']) -> select('app_name', 'app_logo', 'app_address') -> get();
    
    return ['type' => true, 'data' => $res];
  }

  //获取说有的app
  public function getAllApp(Request $request){
    $data = $request -> all();

    $res = App::where([
      ['app_permission', 'like', '%'.$data['role_id'].'%'],
      ['app_name', 'like', '%'. ($request ->has('searchValue')? $data['searchValue']: '') .'%'],
    ]) -> select('id', 'app_name', 'app_logo', 'app_description') -> limit($data['limit']) -> offset(($data['offset']-1)*$data['limit']) -> get();

    return ['type' => true, 'data' => $res];
  }

  //修改用户App
  public function modifyApp(Request $request){
    $data = $request -> all();

    $res = UserInfo::where('user_id', $data['userId']) -> first();
    $res -> app = $data['user_app'];
    $result = $res -> save();

    if($result) {
      if($data['type'] == 'add'){
        return ['type' => true, 'message' => '添加成功!!!'];
      }else {
        return ['type' => true, 'message' => '删除成功!!!'];
      }
    }else{
      return ['type' => true, 'message' => '操作失败！！！'];
    }
  }
}

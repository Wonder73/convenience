<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Client\Index\Role;
use App\Http\Models\Admin\AppManage\App;

class AppController extends Controller
{
    public function index(){
        return view('admin/app-manage');
    }

    //获取角色
    public function getRole(Request $request){
        $data = Role::select('id', 'role_name') -> get();

        if($data) {
            return ['type' => true, 'data' => $data];
        }else {
            return ['type' => false, 'data' => []];
        }
    }

    //添加应用或修改应用
    public function addUploadApp(Request $request) {
        $app = new App();

        $data = $request -> all();

        //检查名字和地址是否重复
        $res = $app -> checkApp($data['app_name'], $data['app_address']);
        if($res['type'] || $data['id']){
            $file = $request -> file('app_logo');
            if($request -> hasFile('app_logo') && $file -> isValid()){
                $ext = $file -> getClientOriginalExtension();
                $filename = uniqid().Date('Y-m-d-H-i-s'). '.' . $ext;
                $file -> move('./uploads/app_logo', $filename);
            
                //图片存放路径
                $create_path = './uploads/app_logo/'.$filename;

                $data['app_logo'] = $create_path;
            }
            if(!$request -> has('id')){
                //写入数据库
                return $app -> addApp($data);
            }else{
                //修改数据
                return $app -> uploadApp($data);
            }
        }else {
            return $res;
        }
    }

    //获取应用列表
    public function getData(Request $request) {
        $app = new App();
        $data = $request -> all();

        //过滤条件
        $filter = ['current' => $data['currentPage'], 'pageSize' => $data['pageSize']];
        $filter['order'] = $request -> has('sort')? $data['sort']: ['orderName' => 'id', 'order' => 'asc'];
        $filter['searchValue'] = $request -> has('searchValue')? $data['searchValue']: '';

        //调用模型方法
        $info = $app -> getData($filter);

        return $info;
    }

    //删除数据
    public function deleteData(Request $request) {
        $info = $request -> all();

        $res = App::destroy($info['appId']);

        if($res) {
            return ['type' => true, 'info' => '删除成功'];
        }else {
            return ['type' => false, 'info' => '删除失败'];
        }
    }
}

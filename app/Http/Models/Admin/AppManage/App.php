<?php

namespace App\Http\Models\Admin\AppManage;

use Illuminate\Database\Eloquent\Model;

use App\Http\Models\Client\Index\Role;

class app extends Model
{
    protected $table = "app";
    protected $primarykey = "id";
    protected $fillable = ['app_name', 'app_address', 'app_logo', 'app_permission', 'app_description'];
    public $timestamps = false;

    //检查应用名称或者应用链接是否重复
    public function checkApp($app_name, $app_address) {
        
        if(App::where('app_name', $app_name) -> count()){
            return ['type' => false, 'message' => '应用名称已存在'];
        }else if(App::Where('app_address', $app_address) -> count()){
            return ['type' => false, 'message' => '应用链接已存在'];
        }else {
            return ['type' => true, 'message' => ''];
        }
    }

    //把数据库写入应用
    public function addApp($data){
        $res = App::create($data);

        if($res) {
            return ['type' => true, 'message' => '添加成功'];
        }else {
            return ['type' => false, 'message' => '添加失败'];
        }
    }

    //修改数据
    public function uploadApp($data) {
        $res = App::find($data['id']);
        $res -> app_name = $data['app_name'];
        $res -> app_address = $data['app_address'];
        $res -> app_logo = $data['app_logo'];
        $res -> app_permission = $data['app_permission'];
        $res -> app_description = $data['app_description'];

        $result = $res -> save();

        if($res) {
            return ['type' => true, 'message' => '修改成功'];
        }else {
            return ['type' => false, 'message' => '修改失败'];
        }

    }

    //获取数据
    public function getData($filter){
        
        $total = App::where('app_name', 'like', "%{$filter['searchValue']}%") -> count();

        $res = App::where('app_name', 'like', "%{$filter['searchValue']}%")
            -> orderBy($filter['order']['orderName'], $filter['order']['order'])
            -> limit($filter['pageSize']? $filter['pageSize']: $total)
            -> offset(($filter['current']-1)*$filter['pageSize'])
            -> get();
        
        //处理数据
        $handleRes = $this -> handleData($res);

        return ['total' => $total, 'dataSource' => $handleRes];
    }

    private function handleData ($data) {
        $role = Role::pluck('role_name', 'id');

        forEach($data as $k => $v){
            if(!$v['app_permission']) continue;
            $permissions = explode(',', $v['app_permission']);
            $app_permission = [];
            forEach($permissions as $v){
                array_push($app_permission, ['id' => $v, 'name' => $role[$v]]);
            }
            $data[$k]['app_permissions'] = $app_permission;
        }

        return $data;
    }
}

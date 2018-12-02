<?php

namespace App\Http\Controllers\Client\UtilitiesManage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;

use App\Http\Models\Client\Utilities\Utilities;

class IndexController extends Controller
{
    //视图加载
    public function index(Request $requset){
        return view('client\utilities-manage\utilities-manage');
    }

    //文件上传
    public function uploadExcel(Request $request) {
        $utilities = new Utilities();
        $category = $request -> input('category');
        $file = $request -> file('file');

        if($request -> hasFile('file') && $file -> isValid('file')){
            $ext = $file -> getClientOriginalExtension();
            $filename = uniqid().Date('Y-m-d-H-i-s'). '.' . $ext;
            $file -> move('./uploads/excel', $filename);
            
            //解析excel，并写入数据库
            $create_path = './uploads/excel/'.$filename;
            Excel::load($create_path, function ($reader) use ($utilities, $category){
                $reader->ignoreEmpty();
                $data = $reader->all()->toArray();

                $utilities -> insertData($data, $category);
            }, 'UTF-8');

            return ['type' => true, 'info' => '上传成功'];
        }
    }

    //文件下载
    public function download(Request $request){
        $utilities = new Utilities();
        $data = json_decode($request -> input('filter'), true);

        //过滤条件
        //过滤条件
        $filter = ['current' => 0, 'pageSize' => 0];
        $filter['order'] = $data['order'] != '{}'? json_decode($data['order'], true): ['orderName' => 'id', 'order' => 'asc'];
        $filter['searchValue'] = $data['searchValue'] != '{}'? json_decode($data['searchValue'], true): [];

        //调用模型方法
        $info = $utilities -> getData($filter, $data['category']);
        //获取数据源
        $dataSource = $this -> setDataSource($info['dataSource'] -> toArray());
        $excelName = $data['category']? '电费报表': '水费报表';
        
        Excel::create($excelName, function ($excel) use($dataSource) {
            $excel -> sheet('报表', function ($sheet) use($dataSource) {
                $sheet -> rows($dataSource);
            });
        }) -> export('xls');
    }

    //设置数据源使得编程excel的格式
    private function setDataSource($data) {
        $array = [['所属栋', '宿舍号', '开始日期', '结束日期', '上个月读数', '这个月读数', '实际读数', '价格', '缴纳费用', '已缴纳费用', '是否交齐']];
        
        forEach($data as $k => $v){
            array_push($array, [$v['ridgepole'], $v['dormNum'], $v['startDate'], $v['endDate'], $v['lastDegrees'], $v['thisDegrees'], $v['practicalDegrees'], $v['price'], $v['cost'], $v['hasPay'], ($v['completePay']? '已交齐': '未交齐')]);
        }

        return $array;
    }

    //获取数据
    public function getData(Request $request) {
        $utilities = new Utilities();
        $data = $request -> all();

        //过滤条件
        $filter = ['current' => $data['currentPage'], 'pageSize' => $data['pageSize']];
        $filter['order'] = $request -> has('sort')? $data['sort']: ['orderName' => 'id', 'order' => 'asc'];
        $filter['searchValue'] = $request -> has('searchValue')? $data['searchValue']: [];

        //调用模型方法
        $info = $utilities -> getData($filter, $data['category']);

        return $info;
    }

    //删除数据
    public function deleteData(Request $request) {
        $info = $request -> all();

        $res = Utilities::destroy($info['utilitiesId']);

        if($res) {
            return ['type' => true, 'info' => '删除成功'];
        }else {
            return ['type' => false, 'info' => '删除失败'];
        }
    }

    //修改数据
    public function updateData(Request $request){
        $info = $request -> all();

        $res = Utilities::find($info['dataSource']['id']);

        $res -> ridgepole = $info['dataSource']['ridgepole'];
        $res -> dorm_num = $info['dataSource']['dormNum'];
        $res -> start_month = $info['dataSource']['startDate'];
        $res -> end_month = $info['dataSource']['endDate'];
        $res -> last_degrees = $info['dataSource']['lastDegrees'];
        $res -> this_degrees = $info['dataSource']['thisDegrees'];
        $res -> practical_degrees = $info['dataSource']['practicalDegrees'];
        $res -> price = $info['dataSource']['price'];
        $res -> cost = $info['dataSource']['cost'];
        $res -> has_pay = $info['dataSource']['hasPay'];
        $res -> complete_pay = $info['dataSource']['completePay'];

        $response = $res -> save();
        if($response) {
            return ['type' => true, 'info' => '修改成功'];
        }else {
            return ['type' => false, 'info' => '修改失败'];
        }
    }
}

<?php

namespace App\Http\Models\Client\Utilities;

use Illuminate\Database\Eloquent\Model;

class Utilities extends Model
{
    //表名
    protected $table = 'utilities';
    //主键
    protected $primary = 'id';
    //操作字段
    protected $fillable = ['ridgepole', 'dorm_num', 'category', 'last_degrees', 'this_degrees', 'practical_degrees', 'price', 'cost',  'aa', 'start_month', 'end_month'];
    //关闭时间戳
    public $timestamps = false;

    //链接AA
    public function porms(){
        return $this -> hasMany('App\Http\Models\Client\Utilities\AA', 'utilities_id', 'id');
    }

    //插入数据
    public function insertData($data, $category){
        forEach($data as $k => $v){
            $v['category'] = $category;
            Utilities::create($v);
        }

        return true;
    }

    //获取数据
    public function getData($filter, $category){
        $where = $this -> setWhere($filter['searchValue']);
        
        $total = Utilities::where($where) -> where('category', $category) -> count();

        $res = Utilities::where($where) 
            -> where('category', $category)
            -> orderBy($filter['order']['orderName'], $filter['order']['order']) 
            -> select('id', 'ridgepole', 'dorm_num as dormNum', 'category', 'last_degrees as lastDegrees', 'this_degrees as thisDegrees', 'practical_degrees as practicalDegrees','price', 'cost', 'has_pay as hasPay', 'start_month as startDate', 'end_month as endDate', 'complete_pay as completePay', 'aa', 'date')
            -> limit($filter['pageSize']? $filter['pageSize']: $total)
            -> offset(($filter['current']-1)*$filter['pageSize'])
            -> get();
        

        return ['total' => $total, 'dataSource' => $res];
    }

    //过来searchValue
    private function setWhere($searchValue) {
        $where = [];

        forEach($searchValue as $k => $v){
            if(!$v) continue;

            if($k == 'startMonth') {
                array_push($where, [$k, '>=', $v]);
            }else if($k == 'startMonth') {
                array_push($where, [$k, '<=', $v]);
            }else {
                array_push($where, [$k, '=', $v]);
            }
        }

        return $where;
    }

    //标记utilities表的aa字段
    public function updateUtilitiesAA($utilitiesId){
        $info = Utilities::find($utilitiesId);

        $info -> aa = 1;

        $info -> save();
    }

    //修改金额,完成支付
    public function modifyUtilitiesCost($utilitiesId, $cost) {
        $info = Utilities::find($utilitiesId);

        if($info) {
            $info -> has_pay += $cost;
            $info -> complete_pay = $info -> has_pay == $info -> cost? 1: 0;
            $info -> save();

            return true;
        }else {
            return false;
        }
    }

    

}

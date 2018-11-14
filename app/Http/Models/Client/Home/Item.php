<?php

namespace App\Http\Models\Client\Home;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //表名
    protected $table = 'item';
    //主键
    protected $primarykey = 'id';
    //操作字段
    protected $fillable = ['user_id', 'type', 'title', 'sort','time','address','description','picture','linkman','phone','qq','date'];
    //关闭时间戳
    public $timestamps = false;
    
    //模型联系，hasOne(关联模型，外键，本表字段）
    public function comment(){
        return $this->hasMany('App\Http\Models\Client\Home\Comment','item_id','id');
    }
}

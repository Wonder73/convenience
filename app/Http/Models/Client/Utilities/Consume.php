<?php

namespace App\Http\Models\Client\Utilities;

use Illuminate\Database\Eloquent\Model;

class Consume extends Model
{
    protected $table = 'consume';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'pay_user_id', 'organization', 'consume_type', 'consume_cost'];

    public $timestamps = false;

    //往消费记录表中插入数据
    public function insertConsume ($info) {
        Consume::create($info);
    }
}

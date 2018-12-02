<?php

namespace App\Http\Models\Client\Home;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';

    protected $fillable = ['user_id','item_id','comment'];

    public $timestamps = false;
    
    //模型联系，hasOne(关联模型，外键，本表字段）
    public function user(){
        return $this->hasOne('App\Http\Models\Client\Home\User','id','user_id');
    }
    
    public function item(){
        return $this->hasOne('App\Http\Models\Client\Home\Item','id','item_id');
    }
}

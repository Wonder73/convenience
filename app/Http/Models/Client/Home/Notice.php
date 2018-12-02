<?php

namespace App\Http\Models\Client\Home;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    //
    protected $table = 'item';

    protected $fillable = ['user_id','type', 'title', 'sort', 'time','address','description','picture','linkman','phone','qq'];

    public $timestamps = false;
}

<?php

namespace App\Http\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    //use SoftDeletes;
    //声明三个受保护成员
    protected $primary = 'id';
    protected $table = 'book';
    protected $fillable = ['user_id','book_name','book_desc','book_pic','book_cate','book_owner','is_lend','contact_info','created_at','updated_at'];
    //public $timestamps = false;
    //protected $guarded = [排除入库的数组]
}

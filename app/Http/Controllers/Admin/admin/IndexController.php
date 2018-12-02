<?php

namespace App\Http\Controllers\Admin\admin;

use Illuminate\Http\Request;
use App\Http\Models\Admin\User;
use App\Http\Models\Book\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    
    //获取数据
    public function userlist() {
        $data = User::all();
        return view('admin/userlist',compact('data')); 
    }
    public function userdel(Request $request){
            $id = $request->input('id');
            $info=User::find($id);
            $info->delete();
            return ['info'=>1];
    }
     public function booklist() {
        $data = Book::all();
        return view('admin/booklist',compact('data')); 
    }
     public function bookdel(Request $request){
            $id = $request->input('id');
            $info=Book::find($id);
            $info->delete();
            return ['info'=>1];
    }
}

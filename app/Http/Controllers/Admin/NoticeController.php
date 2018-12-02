<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Home\Notice;
use App\Http\Models\Client\Home\Comment;
use App\Http\Models\Client\Home\User;
use App\Http\Models\Client\Home\Item;

class NoticeController extends Controller
{
    //后台启事首页
    public function index(){
        $data = Item::with('user')->orderBy('date','desc')->get();
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        
        return view('admin/noticeIndex', compact('data','countLost','countFound'));
    }
    
    //启事类型
    public function typeIndex($type){
        $data = Item::with('user')->where('type',$type)->orderBy('date','desc')->get();   
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        return view('admin/noticeIndex', compact('data','countLost','countFound'));
    }
    
    //搜索启事
    public function search(Request $request){
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        $keyword = $request->input('keyword');
        $data = Item::with('user')->where('type','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->orderBy('date','desc')->get();
        return view('admin/noticeIndex', compact('data','countLost','countFound'));
    }
    
    //启事删除
    public function delete(Request $request) {
        //接收传递过来的数据
        $id = $request->input('id');
        $info = Notice::find($id); //返回要删除的数据
        $res = $info->delete();
        if($res){
           return ['info'=>1];
        }
        else{
            return ['info'=>'0'];
        }   
    }
}

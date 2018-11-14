<?php

namespace App\Http\Controllers\Client\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Client\Home\Notice;
use App\Http\Models\Client\Home\Comment;
use App\Http\Models\Client\Home\User;
use App\Http\Models\Client\Home\Item;
use DB;

class NoticeController extends Controller
{
    public function getuserid(Request $request){
        $id = $request->input('id');  
        return ['data'=>$id];
    }

    public function demo(){
        $comment = Comment::with('user')->where('item_id',10)->orderBy('date','desc')->get();
        $size = sizeof($comment);
        echo $size;
        /*echo '<hr>';
        foreach($comment as $v){
            echo '<hr>';
            echo $v->user_id;
            echo '<hr>';
            echo $v->comment;
            echo '<hr>';
            echo $v->user->username;
        }*/
    }
    
    public function centerid(Request $request){
        $id = $request->input('id');  
        $lost_data = Item::where('user_id',$id)->where('type','寻物启事')->get();
        $found_data = Item::where('user_id',$id)->where('type','招领启事')->get();
        $comment = Comment::with('item')->where('user_id',$id)->get();
        return ['data'=>$id,'lost_data'=>$lost_data,'found_data'=>$found_data,'comment'=>$comment];
    }

    //失物招领个人中心
    public function noticeUserCenter(Request $request){
        $now = date('Y-m-d');
        return view('client/noticeUserCenter',compact('now'));
    }

    //失物招领首页
    public function noticeIndex(){
        $now = date('Y-m-d');
        $data = Notice::orderBy('date','desc')->get();
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        $countComment = Comment::count();
        return view('client/lostFoundIndex', compact('now','data','countLost','countFound','countComment'));
    }
    
    //搜索启事
    public function search(Request $request){
        $keyword = $request->input('keyword');
        $now = date('Y-m-d');
        $data = Notice::where('type','like','%'.$keyword.'%')->orWhere('title','like','%'.$keyword.'%')->orWhere('description','like','%'.$keyword.'%')->orderBy('date','desc')->get();
        //var_dump($data);
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        $countComment = Comment::count();
        return view('client/lostFoundIndex', compact('now','data','countLost','countFound','countComment'));
    }
    
    //启事类型
    public function typeIndex($type){
        $now = date('Y-m-d');
        $data = Notice::where('type',$type)->orderBy('date','desc')->get();   
        $countLost = Notice::where('type','寻物启事')->count();
        $countFound = Notice::where('type','招领启事')->count();
        $countComment = Comment::count();
        return view('client/lostFoundIndex', compact('now','data','countLost','countFound','countComment'));
    }
    
    //失物招领详细信息
    public function detail($id){
        $now = date('Y-m-d');
        $data = Notice::where('id',$id)->get(); 
        $comment = Comment::with('user')->where('item_id',$id)->orderBy('date','desc')->get();
//        foreach($comment as $v){
//            echo $v->user['username'];
//        }
        return view('client/lostFoundDetail', compact('now','data','comment'));
    }
    
    //添加留言
    public function comment(Request $request){
        $data = $request->all();  
        
        $res = Comment::create($data);
        if($res){
            return ['info'=>1];
            //echo '留言成功';
        }else{
            return ['info'=>0];
        }
    }

        //添加失物启事
    public function addlost(Request $request){
            $data = $request->all();
            //var_dump($data);
            $picture = $request->file('picture');
            if($request->hasFile('picture') && $picture->isValid()){
              //获取文件后缀
                $ext = $picture->getClientOriginalExtension();
                //获取文件上传原名
                $oldname = $picture->getClientOriginalName();
                //获取文件的大小
                $filesize = $picture->getClientSize();
                //创建新的文件名称
                $newname = uniqid().date('Y-m-d-H-i-s').'.'.$ext;
                //移动到目标文件夹
                $picture->move('./uploads/noticeImg/',$newname);
                //文件路径存储
                $data['picture'] = "/uploads/noticeImg/".$newname;
            }
            
            $res = Notice::create($data);
            if($res){
                return redirect('home/noticeIndex');
            }else{
                return 'error';
            }
        }
        
    
}

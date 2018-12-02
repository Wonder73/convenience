<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;
use App\Http\Models\Admin\User;
use App\Http\Models\Book\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Storage;

class BookController extends Controller
{
    //展示书籍首页
    public function booklist(){
        $data = Book::all();
        return view('book/book_list',compact('data'));
    }

    //展示书籍详情页
    public function bookinfo(Request $request){
        if($request->isMethod('get')){
             $info=$request->all();
             $data = Book::find($info['id']);
             return view('book/book_details',compact('data'));
        }
    }
    //借阅
    public function lend(Request $request){
        $id = $request->input('id');
        $data = Book::find($id);
        $info =  Book::where('id',$data['id'])->first();
        if($info->is_lend==1){
            $info -> is_lend ='2';
            $info->save();
            return ['info'=>1];
        }
        else{
            return['info'=>0];
        }
        
    }



    //展示我的共享页
    public function mybook(){
        $data = Book::all();
        $info = Book::where('user_id',2)->get();
        return view('book/mybook',compact('info'));
    }
    public function bookshare(Request $request){
        if($request->isMethod('get')){
            //加载显示表单
            //获取栏目的数据
            $data = Book::all();
            return view('book/bookshare',compact('data'));
        }else if($request->isMethod('post')){
            //判断是否是post提交；
            $data = $request->all();
            $rules = [
                'book_name'=>'required',
                //'user_id'=>'required|integer',
                'book_desc'=>'required|min:5'
            ];
            $msg = [
                'book_name.required'=>'分享品名称不能为空',
                //'user_id.required'=>'栏目数据不能为空',
                //'user_id.integer'=>'栏目数据异常',
                'book_desc.required'=>'分享品描述不能为空',
                'book_desc.min'=>'分享品描述至少是5个字符'
            ];
            $validator = Validator::make($data,$rules,$msg);
            if($validator->passes()){
                Book::create($data);
                return ['info'=>1];
            }else {
                $error = collect($validator->messages())->implode('0', ',');
                return ['info'=>0,'error'=>$error];
            }

        } 
    }

    //文件上传
    public function upimage(Request $request){
        $file = $request->file('file');//上传的文件域的名称是file名称；
        //$file->store('存储位置里面的子目录','存储位置名称');
    
        $filename =  '/uploads/'.$file->store('books','uploads');//返回值就是上传文件；
        return ['info'=>$filename];
    }
    //重新共享
     public function re_lend(Request $request){
        $id = $request->input('id');
        $data = Book::find($id);
        $info =  Book::where('id',$data['id'])->first();
        if($info->is_lend==2){
            $info -> is_lend ='1';
            $info->save();
            return ['info'=>1];
        }
        else{
            return['info'=>0];
        }
        
    }

}
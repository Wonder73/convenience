<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '', 'namespace' => 'Client'], function (){

    //首页控制器
    Route::group(['prefix' => '', 'namespace' => 'Index'], function (){
        Route::get('', 'IndexController@index');
    });
    /* 首页路由 */
    Route::group(['prefix' => 'index', 'namespace' => 'Index'], function (){
        //获取用户添加的app
        Route::post('getApp', 'IndexController@getApp');
        //获取所有app
        Route::post('getAllApp', 'IndexController@getAllApp');
        //添加或删除app
        Route::post('modifyApp', 'IndexController@modifyApp');
    });
    
    //登录
    Route::group(['prefix' => 'login', 'namespace' => 'Index'], function (){
        //发送邮件
        Route::post('getValidate', 'LoginRegController@getValidate');
        //获取热门app
        Route::post('getHotApp', 'LoginRegController@getHotApp');
        //完成注册
        Route::post('register', 'LoginRegController@register');
        //用户登录
        Route::post('login', 'loginRegController@login');
        //用户用邮箱登录
        Route::post('emailLogin', 'loginRegController@emailLogin');
        //检查用户登录
        Route::post('checkLogin', 'loginRegController@checkLogin');
    });

    
    ///个人信息
    Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
        //用户中心
        Route::match(['get','post'],'','IndexController@userCenter'); 
        //修改用户信息
        Route::match(['get','post'],'updateUser', 'IndexController@updateUser');
        Route::post('get', 'IndexController@get');
        //修改用户身份
        Route::post('updateidentity', 'IndexController@updateidentity');
        //获取余额
        Route::post('getMoney', 'IndexController@getMoney');
        //用户充值
        Route::post('handlePay', 'IndexController@handlePay');
        //获取零钱明细
        Route::post('getPayDetail', 'IndexController@getPayDetail');

        //设置
        Route::group(['prefix'=>'config'], function (){
            //修改邮箱
            Route::post('modifyEmail', 'IndexController@modifyEmail');
            //判断是否开启支付
            Route::post('checkOpenPay', 'IndexController@checkOpenPay');
            //设置或者修改支付密码
            Route::post('configPayPassword', 'IndexController@configPayPassword');
            //检查密码是否正确
            Route::post('checkPassword', 'IndexController@checkPassword');
            //修改密码
            Route::post('modifyPassword', 'IndexController@modifyPassword');
        });
		
		
        //获取用户id
        Route::post('getuserid', 'NoticeController@getuserid');
        //启事首页
        Route::get('noticeIndex', 'NoticeController@noticeIndex');
        Route::get('typeIndex/{type}', 'NoticeController@typeIndex');
        //启事详情
        Route::get('detail/{id}', 'NoticeController@detail');
        //发布启事
       Route::post('addlost', 'NoticeController@addlost');
        Route::post('search', 'NoticeController@search');
        //启事留言
        Route::post('comment', 'NoticeController@comment');
        
        //失物招领个人中心
        Route::match(['get','post'],'noticeUserCenter', 'NoticeController@noticeUserCenter');
        //个人中心的id
        Route::post('centerid', 'NoticeController@centerid');
        
        
        
        Route::get('demo', 'NoticeController@demo');
    });

    //代缴水电费
    Route::group(['prefix' => 'utilities', 'namespace' => 'Utilities'], function (){
        //视图展览
        Route::get('', 'IndexController@index');
        //获取搜索结果
        Route::post('query', 'IndexController@query');
        //获取aa人的信息
        Route::post('getAAInfo', 'IndexController@getAAInfo');
        //支付
        Route::post('handlePay', 'IndexController@handlePay');
    });

    //管理水电费
    Route::group(['prefix' => 'utilities-manage', 'namespace' => 'UtilitiesManage'], function (){
        //视图加载
        Route::get('', 'IndexController@index');
        //上传文件
        Route::post('uploadExcel', 'IndexController@uploadExcel');
        //导出数据
        Route::get('download', 'IndexController@download');
        //获取数据
        Route::post('getData', 'IndexController@getData');
        //删除数据
        Route::post('deleteData', 'IndexController@deleteData');
        //修改数据
        Route::post('updateData', 'IndexController@updateData');
    });

    //用户身份验证
    Route::group(['prefix' => 'checkIdentity'], function (){
        //检查水电费管理员
        Route::post('utilities-manage', 'CheckIdentityController@utilitiesManage');
    });

});




Route::group(['prefix' => 'yb-admin', 'namespace' => 'Admin'], function (){
    Route::get('', 'IndexController@index');
    Route::get('welcome', 'IndexController@welcome');
	Route::get('userlist', 'admin\IndexController@userlist');
    Route::post('userdel', 'admin\IndexController@userdel');
	
    //电费管理
    Route::group(['prefix' => 'electricity-manage', 'namespace' => 'Utilities'], function (){
        Route::get('', 'ElectricityManageController@index');
    });
	
    //水费管理
    Route::group(['prefix' => 'water-manage', 'namespace' => 'Utilities'], function (){
        Route::get('', 'WaterManageController@index');
    });
	
    //应用管理
    Route::group(['prefix' => 'app-manage'], function (){
        Route::get('', 'AppController@index');
        //获取角色列表
        Route::post('getRole', 'AppController@getRole');
        //添加应用
        Route::post('addUploadApp', 'AppController@addUploadApp');
        //应用列表
        Route::post('getData', 'AppController@getData');
        //删除
        Route::post('deleteData', 'AppController@deleteData');
    });

     //管理员后台登陆
     Route::get('login','admin\AdminController@login');
     Route::post('loginok','admin\AdminController@loginok');
     //管理员退出登陆
     Route::get('loginout','admin\AdminController@loginout');
     //管理员列表
     Route::get('adminlist', 'admin\AdminController@adminlist');
     //删除管理员
     Route::post('admindel', 'admin\AdminController@admindel');
     //添加管理员
     Route::match(['get','post'],'adminadd', 'admin\AdminController@adminadd');
     //书籍共享后台 
     Route::get('booklist', 'admin\IndexController@booklist');
     Route::post('bookdel', 'admin\IndexController@bookdel');

     //启事首页
    Route::get('noticeIndex', 'NoticeController@index');
    //启事类型
    Route::get('typeIndex/{type}', 'NoticeController@typeIndex');
    //删除启事
    Route::post('delete', 'NoticeController@delete');
    //启事搜索
    Route::post('search', 'NoticeController@search');
    //角色管理首页
    Route::get('roleIndex', 'RoleController@index');
    //角色添加
    Route::match(['get','post'],'addRole', 'RoleController@addRole');
    //删除角色
    Route::post('delRole','RoleController@delRole'); 
    //修改角色
    Route::match(['get','post'],'updateRole/{role}','RoleController@updateRole'); 
});

//功能 书籍共享
Route::group(['prefix' => 'home', 'namespace' => 'Book'], function (){
    Route::get('booklist', 'BookController@booklist'); 
    Route::get('bookinfo', 'BookController@bookinfo');
    Route::get('mybook', 'BookController@mybook');
    Route::match(['get','post'],'bookshare', 'BookController@bookshare');
    //上传图片
    Route::post('upimage','BookController@upimage');
    Route::post('lend', 'BookController@lend');
});
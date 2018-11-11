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

    
    //个人信息
    Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
        Route::get('','IndexController@userCenter');
        
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
});
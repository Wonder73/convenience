/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function (){
    
    //检查用户登录
  let userInfo = decodeURIComponent($.cookie('userInfo'));
  if(userInfo !== 'undefined' && userInfo !== 'null'){
    userInfo  = JSON.parse(userInfo);
    
    $.ajax({
      type: 'post',
      url: common.rootURL + '/login/checkLogin',
      data: {
        'username': userInfo.username,
        'password': userInfo.password,
        '_token': common.token,
      },
      success: function (response){
        if(response){
          $('#login_reg_btn').hide().siblings().show();
        }else{
          $.cookie('userInfo', null);
          window.location.reload();
        }
      }
    });
  }

    
  $.ajax({
    type: "post",
    url: common.rootURL + "/home/getuserid",
    dataType:"json",
    data: {
        'id': userInfo.id,
        '_token': common.token,
    },
    success: function (data) { 
      $("#lost1").attr("value",data.data);
      $("#found1").attr("value",data.data);
      if(data==1){
        parent.window.location.href=parent.window.location.href;
        layer.msg('发布成功');               
      }
    }
  });
    
    

    
    
    
});
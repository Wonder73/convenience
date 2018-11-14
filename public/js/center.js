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
        if(+response){
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
        url: common.rootURL + "home/centerid",
        dataType:"json",
        cache:'false',
        data: {
            'id': userInfo.id,
            '_token': common.token,
        },
        success: function (data) {   
            console.log(data);
            var lostlen = data.lost_data.length;
            var foundlen = data.found_data.length;
            var commentlen = data.comment.length;

        //寻物
        if(lostlen>0){
            var cm = "";
            $.each(data.lost_data, function(i, obj) {
            cm += '<div class="grid col-md-3 col-sm-4 col-xs-12">';
            cm += '<div class="grip-wrap">';
            cm += '<a href="http://localhost/convenience/public/home/detail/'+obj.id+'">';
            if(obj.picture==null){
                cm += '<div class="col-md-12 col-sm-12 col-xs-12" style="background: #ccc;height: 100px;font-size: 24px;color: #fff;line-height: 100px;text-align: center;">暂无相关图片</div>';
            }else{           
                cm += '<img src="http://localhost/convenience/public'+obj.picture+'" class="img-responsive"/>';
            }
            cm += '<span>'+obj.title+'</span>';
            cm += '<hr/>';
            cm += '<h5>'+obj.type+'</h5>';
            cm += '<p>'+obj.description+'</p>';
            cm += '<p style="padding: 0;text-align: right;">发布日期：'+obj.date+'</p>';
            cm += '</a>';
            cm += '</div>';
            cm += '</div> ';
            });
            $("#lost-list").append(cm);
        }else{
            var cm = "";
            cm += '<div class="col-md-12 col-sm-12 col-xs-12" style="line-height:200px;text-align: center;">亲！您未发布任何寻物启事哦！</div>';
            $('#lost-list').append(cm);
        }
        
        //招领
        if(foundlen>0){
            var wcm = "";
            $.each(data.found_data, function(i, obj) {
            wcm += '<div class="grid col-md-3 col-sm-4 col-xs-12">';
            wcm += '<div class="grip-wrap">';
            wcm += '<a href="http://localhost/convenience/public/home/detail/'+obj.id+'">';
            if(obj.picture==null){
                wcm += '<div class="col-md-12 col-sm-12 col-xs-12" style="background: #ccc;height: 100px;font-size: 24px;color: #fff;line-height: 100px;text-align: center;">暂无相关图片</div>';
            }else{           
                wcm += '<img src="http://localhost/convenience/public'+obj.picture+'" class="img-responsive"/>';
            }
            wcm += '<span></span>';
            wcm += '<hr/>';
            wcm += '<h5>'+obj.type+'</h5>';
            wcm += '<p></p>';
            wcm += '<p style="padding: 0;text-align: right;">发布日期：'+obj.id+'</p>';
            wcm += '</a>';
            wcm += '</div>';
            wcm += '</div> ';
            });
            $("#found-list").append(wcm);
        }else{
            var wcm = "";
            wcm += '<div class="col-md-12 col-sm-12 col-xs-12" style="line-height:200px;text-align: center;">亲！您未发布任何招领启事哦！</div>';
            $('#found-list').append(wcm);
        }
        
        //评论
        if(commentlen>0){
            var acm = "";
            $.each(data.comment, function(i, obj) {
            acm += '<div class="grid col-md-3 col-sm-4 col-xs-12">';
            acm += '<div class="grip-wrap">';
            acm += '<a href="http://localhost/convenience/public/home/detail/'+obj.item.id+'">';
            if(obj.item.picture==null){
                acm += '<div class="col-md-12 col-sm-12 col-xs-12" style="background: #ccc;height: 100px;font-size: 24px;color: #fff;line-height: 100px;text-align: center;">暂无相关图片</div>';
            }else{           
                acm += '<img src="http://localhost/convenience/public'+obj.item.picture+'" class="img-responsive"/>';
            }
            acm += '<span>'+obj.item.title+'</span>';
            acm += '<hr/>';
            acm += '<h5>'+obj.item.type+'</h5>';
            acm += '<p>'+obj.item.description+'</p>';
            acm += '<p style="padding: 0;text-align: right;">发布日期：<br>'+obj.date+'</p>';
            acm += '</a>';
            acm += '</div>';
            acm += '</div> ';
            });          
            $("#comment-list").append(acm);
        }else{
            var acm = "";
            acm += '<div class="col-md-12 col-sm-12 col-xs-12" style="line-height:200px;text-align: center;">亲！您没有评论任何启事哦！</div>';
            $('#comment-list').append(acm);
        }

           
        }
    

 });   
    

    
    
    
});
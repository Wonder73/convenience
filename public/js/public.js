$(function (){
  //点击头部按钮时出现登录注册框
  $('#login_reg_btn').click(function (){
    $('.login').fadeIn(300);
    $('.shadow').fadeIn(300);
  });

  $('#login_reg_btn').show().siblings().hide();
  
  //检查用户登录
  let userInfo = decodeURIComponent($.cookie('userInfo'));
  if(userInfo !== 'undefined' && userInfo !== 'null'){
    userInfo = JSON.parse(userInfo);

    $.ajax({
      async: false,
      type: 'post',
      url: common.rootURL + '/login/checkLogin',
      data: {
        'username': userInfo.username,
        'password': userInfo.password,
        '_token': common.token,
      },
      success: function (response){
        if(response){
          $.cookie('userInfo', response);
          $('#login_reg_btn').hide().siblings().show();
        }else{
          $.cookie('userInfo', null);
          window.open('/index', '_self');
        }
      }
    });
  }
  
  //退出登录
  $('#logout').click(function (){
    layer.confirm('您确定要登录吗？', {
      btn: ['确定', '取消']
    }, function (){
      $.cookie('userInfo', null);
      window.location.reload();
    });
  });

  /*登录部分*/
  /*邮箱登录和账号登录的相互切换*/
  $('.login .login_content .Login-o span:first-child').click(function (){
    if($(this).hasClass('emailLogin')){
      $('.login .first_step').fadeOut(200,function (){
        $('.login .second_step').fadeIn(200);
      });
    }else if($(this).hasClass('accountLogin')){
      $('.login .second_step').fadeOut(200,function (){
        $('.login .first_step').fadeIn(200);
      });
    }
  });

  /*登录切注册，注册切登录*/
  $('.login .login_foot .reg').click(function (){
    RegisterShow();
  });
  $('.register .register_foot .log').click(function (){
    loginShow();
  });

  function loginShow(){
    $('.register').fadeOut(300);
    $('.login').fadeIn(300);
    $('.shadow').fadeIn(300);
    document.body.parentNode.style.overflow = "hidden";
  }
  function RegisterShow(){
    $('.login').fadeOut(300);
    $('.register').fadeIn(300);
    $('.shadow').fadeIn(300);
    document.body.parentNode.style.overflow = "hidden";
  }

  /*关闭登录和注册窗口*/
  $('.login .close,.register .close').click(function (){
    $(this).parent().fadeOut(300);
    $('.shadow').fadeOut(300);
    document.body.parentNode.style.overflow = "auto";
  });


  /*注册和注册*/
  (function (){
    /*隐藏第二步，和第三步*/
    $('.login .scond_step').hide();
    $('.login .second_step').hide();
    $('.register .second_step').hide();
    $('.register .third_step').hide();

    //登录验证码
    let storageValidateErrorCount = sessionStorage.getItem('validateErrorCount');
    if(storageValidateErrorCount >= 5){
      $('.login_content .validate_box').show();
    }

    var flag = true;   //用于判断是否可以提交

    /*注册部分*/
    /*获取焦点移除错误*/
    $('.Input').focus(function (){
      if($(this).hasClass('error')){
        $(this).removeClass('error').val('');
        if($(this).parent().hasClass('password') || $(this).parent().hasClass('confirm_password')){
          $(this).attr('type','password');
        }
      }
      if($(this).next().hasClass('error')){
        $(this).next().removeClass('error').html('');
      }
    });
    /*输入框失去焦点时的判断*/
    $('.Input').blur(function (){
      isEmpty($(this));
    });

    /* 绘制验证码 */
    $('#validate_canvas').click(function (){
      common.drawValidate($('#validate_canvas').get(0), 4);
    }).click();

    /*获取验证码 判断cd是否结束*/
    var Codetime = Date.parse(new Date())/1000;
    var time_difference = Codetime - (isNaN(localStorage.getItem('Codetime'))?Codetime:localStorage.getItem('Codetime'));
    var cd = (isNaN(localStorage.getItem('cd'))?0:localStorage.getItem('cd'));
    var getCodeDom = $('.email_validate span.getCode');
    if(time_difference >= cd){
      getCodeDom.on('click',function (){
        getCode(this);
      });
    }else{
      var time = cd - time_difference;
      getCodeDom.html(time + 's');
      var timer = setInterval(function (){
        localStorage.setItem('Codetime',++Codetime);   //验证码的cd，就是关闭浏览器也有效
        localStorage.setItem('cd',--time);   //验证码的cd，就是关闭浏览器也有效
        getCodeDom.html(time + 's');
        if(time <= 0){
          getCodeDom.html('重新发送验证码').on('click',function (){
            getCode(this);
          });
          clearInterval(timer);
        }
      },1000);
    }

    /*点击观看密码或隐藏密码*/
    $('.see_password').click(function (){
      $(this).toggleClass('fa-eye-slash').toggleClass('fa-eye');
      if($(this).hasClass('fa-eye-slash')){
        type = 'password';
      }else{
        type = 'text';
      }
      var input = $(this).parent().find('.Input');
      if(!input.hasClass('error')){
        input.attr('type',type);
      }
    });

    /*点击注册，如果正确就跳转到下一步*/
    $('.register .first_step button').click(function (){
      if(isEmpty($('.register_content .email')) * isEmpty($('.register_content .emailCode'))){
        var emailCode = $('.register_content .emailCode').val().toLowerCase();
        var sessionEmailCode = sessionStorage.getItem('emailCode');
        //验证码验证
        if(common.encryption(emailCode) == sessionEmailCode){
        // if(1){
          $('.register .first_step').fadeOut(function (){
            $('.register .second_step').fadeIn();
          });
        }else{
          $('.register_content .emailCode').next().addClass('error').html('验证码错误');
        }
      }
    });

    /*第二步点击下一步*/
    $('.register .second_step button').click(function (){
      if(isEmpty($('.register_content .username')) * isEmpty($('.register_content .password')) * isEmpty($('.register_content .confirmPwd')) * flag){
        $('.register .second_step').fadeOut(function (){
          $('.register .third_step').fadeIn();
          /*获取热门的话题并显示在页面上*/
          $.ajax({
            async:true,
            type:'post',
            url:common.rootURL + '/login/getHotApp',
            data:{
              '_token': common.token,
            },
            success:function (responseText){
              var data = responseText;
              var html = '';
              
              if(typeof responseText == 'string'){
                data = JSON.parse(data);
              }

              for(let value of data){
                html += '<li app-id="'+ value.id +'">'+ value.name +'</li>';
              }
              $('.register .third_step ul').html(html);
            }
          });
        });
      }
    });


    /*点击完成注册*/
    $('.register .third_step button').click(function (){
      var _this = this;
      var li = $(this).prev().prev().find('li.selected');
      var hotApp = [];
      var email = $('.register input.email').val();
      var username = $('.register input.username').val();
      var password = $('.register input.password').val();
      if(li.size()>0){
        $(this).prev().fadeOut();
        for(let i = 0; i < li.size(); i++){
          hotApp.push(li.eq(i).attr('app-id'));
        }
        /*向后台插入数据*/
        $.ajax({
          async:true,
          type:'post',
          url:common.rootURL+'/login/register',
          data:{
            'username':username,
            'password':password,
            'email':email,
            'hotApp':hotApp.join(','),
            '_token': common.token,
          },
          beforeSend:function (){
            $(_this).html('<i class="fa fa-spinner fa-pulse"></i>');
            $(_this).attr('disabled','true');
          },
          success:function (responseText){
            $(_this).removeAttr('disabled');
            if(+responseText){
              $(_this).html('注册成功，跳转到登录中....');
              setTimeout(function (){
                $(_this).html('完成');
                $('.log_rg input').val('');
                $('.register .first_step').show();
                $('.register .second_step').hide();
                $('.register .third_step').hide();
                loginShow();
              },2000);
            }else{
              $(_this).html('注册失败请重新注册.....');
              setTimeout(function (){
                $(_this).html('完成');
                window.location.reload();
              },2000);
            }
          }
        });
      }else{
        $(this).prev().fadeIn();
      }
    });

    /*注册面板选择喜欢的应用*/
    $('.register_content ul').on('click','li',function (){
      $(this).toggleClass('selected');
    });

    /*登录部分*/
    /*邮箱登录和账号登录的相互切换*/
    $('.login .login_content .Login-o span:first-child').click(function (){
      if($(this).hasClass('emailLogin')){
        $('.login .first_step').fadeOut(200,function (){
          $('.login .second_step').fadeIn(200);
        });
      }else if($(this).hasClass('accountLogin')){
        $('.login .second_step').fadeOut(200,function (){
          $('.login .first_step').fadeIn(200);
        });
      }
    });

    /*账号密码登录*/
    $('.login .first_step button').click(function (){
      clickLogin(this);
    });
    $('.login .first_step .password').keydown(function (e){
      if(e.keyCode === 13){
        clickLogin($('.login .first_step button'));
      }
    });
    //登录函数
    function clickLogin(Dom){
      var _this = Dom;
      
      if(isEmpty($('.login_content .username')) * isEmpty($('.login_content .password')) * isEmpty($('.login_content .validate'))){
        var username = $('.login_content .username').val();
        var password = $('.login_content .password').val();
        $.ajax({
          async:true,
          type:'post',
          url: common.rootURL+'/login/login',
          data:{
            'username':username,
            'password':password,
            '_token': common.token,
          },
          beforeSend:function (){
            $(_this).html('<i class="fa fa-spinner fa-pulse"></i>');
            $(_this).attr('disabled','true');
          },
          success:function (responseText){
            $(_this).removeAttr('disabled');
            $(_this).html('登录');
            if(+responseText == 1){
              $('.login_content .username').next().addClass('error').html('用户名不存在');
            }else if(+responseText == 2){
              $('.login_content .password').next().addClass('error').html('用户名或密码错误');
            }else{
              $.cookie('userInfo',encodeURIComponent(responseText),{expires:3});
              window.location.reload();
            }
          }
        });
      }else{
        let storageValidateErrorCount = sessionStorage.getItem('validateErrorCount');
        let validateErrorCount =  storageValidateErrorCount?  storageValidateErrorCount:0;
        validateErrorCount++;
        
        if(validateErrorCount >= 5){
          $('.login_content .validate_box').show();
        }
        sessionStorage.setItem('validateErrorCount', validateErrorCount)
      }
    }

    //邮箱登录
    $('.login .second_step button').click(function (){
      emailLogin(this);
    });
    $('.login .second_step .emailCode').keydown(function (e){
      if(e.keyCode === 13){
        emailLogin($('.login .second_step button'));
      }
    });

    function emailLogin(Dom){
      var _this = Dom;
      if(isEmpty($('.login_content .email')) * isEmpty($('.login_content .emailCode'))){
        var emailCode = $('.login_content .emailCode').val().toLowerCase();
        var sessionEmailCode = sessionStorage.getItem('emailCode');
        if(common.encryption(emailCode) == sessionEmailCode){
          $.ajax({
            async:true,
            type:'post',
            url:common.rootURL+'/login/emailLogin',
            data:{
              email:$('.login_content .email').val(),
              '_token': common.token,
            },
            beforeSend:function (){
              $(_this).html('<i class="fa fa-spinner fa-pulse"></i>');
              $(_this).attr('disabled','true');
            },
            success:function (responseText){
              $(_this).removeAttr('disabled');
              $(_this).html('登录');

              $.cookie('userInfo',encodeURIComponent(responseText),{expires:3});
              window.location.reload();
            }
          });
        }else{
          $('.login_content .emailCode').next().addClass('error').html('验证码错误');
        }
      }
    }

    /*获取验证码*/
    function getCode(_this){
      var emailInput;

      if($(_this).parent().parent().parent().hasClass('register_content')){
        emailInput = $('.register_content .email');
      }else{
        emailInput = $('.login_content .email');
      }

      if(!emailInput.hasClass('error') && isEmpty(emailInput)){
        $.ajax({
          async:true,
          type:'POST',
          url:common.rootURL+'/login/getValidate',
          data:{
            email:emailInput.val(),
            register:$(_this).parent().parent().parent().hasClass('register_content'),
            '_token': common.token,
          },
          beforeSend:function (){
            $(_this).off('click');
          },
          success:function (responseData){
            if(+responseData === 1 ){
              $(_this).on('click',function (){
                getCode(this);
              });
              emailInput.next().addClass('error').html('邮箱已被注册');
            }else if(+responseData === 2){
              $(_this).on('click',function (){
                getCode(this);
              });
              emailInput.next().addClass('error').html('邮箱不存在');
            }else{
              var date = Date.parse(new Date())/1000;  //获取当前的时间戳
              sessionStorage.setItem('emailCode',responseData);  //storage保存
              /*防止疯狂点击*/
              var time = 60;    //冷却时间
              $(_this).html(time + 's');
              var timer = setInterval(function (){
                localStorage.setItem('Codetime',++date);   //验证码的cd，就是关闭浏览器也有效
                localStorage.setItem('cd',--time);   //验证码的cd，就是关闭浏览器也有效
                $(_this).html(time + 's');
                if(time <= 0){
                  $(_this).html('重新发送验证码').on('click',function (){
                    getCode(this);
                  });
                  clearInterval(timer);
                }
              },1000);
            }
          }
        });
      }
    }


    /*输入框是否空时*/
    function isEmpty(dom){
      let storageValidateErrorCount = sessionStorage.getItem('validateErrorCount');   //登录错误次数
      var parentDom = dom.parent().parent().parent().attr('class');
      var name = dom.attr('name');
      var value = dom.val();

      if(!value){    //为空时的判断
        dom.addClass('error');
        var str = '';
        if(name == 'email'){
          str = "请输入电子邮件";
        }else if(name == 'emailCode'){
          str = "请输入验证码";
        }else if(name == 'username'){
          str = "用户名不得为空";
        }else if(name == 'password'){
          str = "密码不得为空";
        }else if(name == 'confirmPwd'){
          str = "确认密码不得为空";
        }else if(name === 'validate'){
          //判断错误有没有大于五次
          if(storageValidateErrorCount >= 5){
            str = "验证码不得为空";
          }else {
            return true;
          }
        }
        dom.attr('type','text').val(str);
        return false;
      }else{           //不为空时的判断
        if(!dom.hasClass('error')){
          if(name == 'email'){
            if(!/^\w{2,25}@\w{2,10}\.\w{2,3}$/.test(value)){
              dom.next().addClass('error').html('邮箱格式不正确');
              return false;
            }
          }else if(name == 'emailCode'){
            if(value.length > 6 || value.length < 6){
              dom.next().addClass('error').html('验证码格式不正确');
              return false;
            }
          }else if(name == 'username'){
            if(value.length < 2 || value.length > 20){
              dom.next().addClass('error').html('用户名长度不符合');
              return false;
            }else if(parentDom == 'register_content'){
              /*用户名是否有重复*/
              $.ajax({
                async:true,
                type:'post',
                url:rootURL+'/index.php/index/register/exitUser',
                data:{
                  username:value,
                },
                success:function (responseText){
                  if(+responseText){
                    dom.next().addClass('error').html('用户名已存在');
                    flag = false;
                  }
                }
              });
            }
          }else if(name == 'password'){
            if(value.length < 6 || value.length >18){
              dom.next().addClass('error').html('密码长度不符合');
              return false;
            }else if(/[^0-9a-zA-Z.,_!?+-]+/.test(value)){
              dom.next().addClass('error').html('密码不能包含特殊字符');
              return false;
            }
          }else if(name == 'confirmPwd'){
            var password = dom.parent().prev().find('input').val();

            if(password != value){
              dom.next().addClass('error').html('密码不一致');
              return false;
            }
          }else if(name == 'validate' && storageValidateErrorCount >= 5) {
            const validate = sessionStorage.getItem('validate');
            const enValidate = common.encryption(value.toLowerCase());
            
            if(validate !== enValidate) {
              dom.next().addClass('error').html('验证码错误');
              return false;
            }
          }
        }else{
          return false;
        }
        return true;
      }
    }
  })();

});

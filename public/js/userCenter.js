/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

function center() {
  wid = document.body.clientWidth;
  obj = document.getElementByClassName("content");
  obj.style.marginLeft = wid / 2;
}

function changeColor(colorRGB) {
  wid = document.body.clientWidth;
  obj = document.getElementByClassName("content");
  obj.style.marginLeft = wid / 2;

  $('.content').append("<style>.content::after{display:block}</style>");
}
$(function () {

  //如果没有用户登录，就回到首页
  let userInfo = decodeURIComponent($.cookie('userInfo'));
  if (userInfo === 'undefined' || userInfo === 'null') {
      window.open('./', '_self');
  }
  //检查用户登录
  if (userInfo !== 'undefined' && userInfo !== 'null') {
      userInfo = JSON.parse(userInfo);

      $.ajax({
          type: 'post',
          url: common.rootURL + '/login/checkLogin',
          data: {
              'username': userInfo.username,
              'password': userInfo.password,
              '_token': common.token,
          },
          success: function (response) {
              if (response) {
                  $.cookie('userInfo', response);
                  $('#login_reg_btn').hide().siblings().show();
              } else {
                  $.cookie('userInfo', null);
                  window.open('/index', '_self');
              }
          }
      });
  }
  /*carman*/
  $.ajax({
      type: "post",
      url: common.rootURL + "/home/get",
      dataType: "json",
      data: {
          'id': userInfo.id,
          '_token': common.token,
      },
      success: function (data) {
          $("#username").html(data.data[0].nickname);
          $("#nickname").html(data.data[0].nickname);
          $("#major").html(data.data[0].major);
          $("#real_name").html(data.data[0].real_name);
          $("#qq").html(data.data[0].qq);
          $("#birth").html(data.data[0].birth);
          $("#phone").html(data.data[0].phone);
          if (data.data[0].head !== null) {
              $("#head").attr("src", common.rootURL + data.data[0].head);
          } else {
              $("#head").attr("src", common.rootURL + "/uploads/image/white.jpg");
          }
          $("#rolename").html(data.rolename);
          $("#ridgepole").html(data.identity[0].ridgepole);
          $("#dorm_num").html(data.identity[0].dorm_num);
          if (data.identity[0].check == 0) {
              $("#check").html('审核中');
          } else {
              $("#check").html('审核通过');
          }

          $("#info1").html(data.data[0].nickname);
          $("#info2").html(data.data[0].major);
          $("#info3").html(data.data[0].real_name);
          $("#info4").html(data.data[0].qq);
          $("#info5").html(data.data[0].birth);
          $("#info6").html(data.data[0].phone);
          if (data.data[0].head !== null) {
              $("#img-info").attr("src", common.rootURL + data.data[0].head);
          } else {
              $("#img-info").attr("src", common.rootURL + "/uploads/image/white.jpg");
          }
          $("#info7").html(data.rolename);
          $("#info8").html(data.identity[0].ridgepole);
          $("#info9").html(data.identity[0].dorm_num);

          $("#user_id").attr("value", data.data[0].user_id);
          $("#userid").attr("value", data.data[0].user_id);
          $("#input1").attr("value", data.data[0].nickname);
          $("#input2").attr("value", data.data[0].major);
          $("#input3").attr("value", data.data[0].real_name);
          $("#input4").attr("value", data.data[0].qq);
          if (data.data[0].birth == null) {
              $("#input5").attr("value", '2018-12-12');
          } else {
              $("#input5").attr("value", data.data[0].birth);
          }
          $("#input6").attr("value", data.data[0].phone);
          $("#input7[value="+data.rolname+"]").attr("selected", 'selected');
          $("#input8").attr("value", data.identity[0].ridgepole);
          $("#input9").attr("value", data.identity[0].dorm_num);

      }
  });

  const vm = new Vue({
      el: '.yue',
      delimiters:['${', '}'],
      data: {
        userInfo: JSON.parse(decodeURIComponent($.cookie('userInfo'))),
        openPay: false,   //是否开通支付
        money: 1000,
        payPassword: '',
        disabledInput: false,
        pay: {
          visible: false,
        },
        topUp: false,
        payDetail: {
          'visiable': false,
          'offset': 1,
          'limit': 10,
          'dataSource': []
        }
      },
      mounted (){
          common.ajax({
            url: 'home/getMoney',
            data: {
              'userId': this.userInfo.id,
              '_token': common.token
            }
          }).then((response) => {

            if(response.type){
              this.money = response.money;
            }
              
          });

        //判断是否开启了支付功能
        common.ajax({
          url: '/home/config/checkOpenPay',
          data: {
            'userId': this.userInfo.id,
            '_token': common.token,
          }
        }).then((response) => {
          if(response.type){
            this.openPay = 1;
          }
        }).catch((error) => {
          throw new Error(error);
        });
      },
      filters: {
        moneyFormat (value) {

          if (/[^0-9\.]/.test(value))
            return '￥ '+ "0.00";
          
          if (value == null || value == "null" || value == "")
            return '￥ '+ "0.00";

          value = value.toString().replace(/^(\d*)$/, "$1.");
          value = (value + "00").replace(/(\d*\.\d\d)\d*/, "$1");
          value = value.replace(".", ",");
          var re = /(\d)(\d{3},)/;

          while (re.test(value))
            value = value.replace(re, "$1,$2");
          
          value = value.replace(/,(\d\d)$/, ".$1");
          
          var a = value.split(".");
          if (a[1] == "00") {
            value = a[0];
          }

          return '￥ '+ value;
        }
      },
      watch: {
        payPassword (value){
          this.payPassword = value.slice(0, 6);
          if(this.payPassword.length === 6){
            this.disabledInput = true;
            this.handlePay();
          }
        }
      },
      methods: {
        //显示支付密码
        showPay () {
          if(this.pay.cost > 0) {
            this.pay.visible = true;
          }
          this.topUp = false;
        },
        handleClick (){
          this.$refs.input.focus();
        },
        handlePay (){
          this.pay.payUserId = this.userInfo.id;
          this.pay.type = 0;

          const loading = this.$loading({
            lock: true,
            text:'支付中.....',
          });
          
          common.ajax({
            url: 'home/handlePay',
            data: {
            payPassword: common.encryption(this.payPassword),
            ...this.pay,
            '_token': common.token,
            },
          }).then((response) => {
            loading.close();
            if(response.type){
              this.money = this.money*1 + this.pay.cost*1;
              this.pay.visible = false;
              this.pay.cost = 0;
              this.$message({
                'message': response.info,
                'type': 'success',
              });
            }else {
              this.$message({
                'message': response.info,
                'type': 'error',
              });
            }
            this.payPassword = '';
            this.disabledInput = false;
          }).catch((error) => {
            throw error;
          });

        },

        //显示零钱明细
        showPayDetail (){
          this.payDetail.visiable = true;

          this.getPayDetail();
        },

        //滚动到底部加载更多
        handleScroll (event){
          if(event.target.clientHeight + event.target.scrollTop === event.target.scrollHeight){
            this.getPayDetail();
          }
        },
        //获取零钱明细
        getPayDetail (){
          common.ajax({
            url: 'home/getPayDetail',
            data: {
              'userId': this.userInfo.id,
              'offset': this.payDetail.offset,
              'limit': this.payDetail.limit,
              '_token': common.token
            }
          }).then((response) => {
            if(response.type) {
              this.payDetail.offset ++;
              const data = this.payDetail.dataSource
              this.payDetail.dataSource = data.concat(response.dataSource);
            }
          });
        }

      }

  });

  const setting = new Vue({
    el: '.setting',
    delimiters: ['${', '}'],
    data: {
      userInfo: JSON.parse(decodeURIComponent($.cookie('userInfo'))),
      slideSide: false,
      showMain: 0,   //默认第一个
      //账号和安全信息
      safety: {
        //用户名
        'youbianNumber': '',
        //用户原邮箱
        'bindEmail': '',
        //是否修改邮箱标志
        'modifyEmail': 0,
        //获取邮箱验证码后的按钮状态
        'buttonStatus': {
          disabled: false,
          content: "获取验证码"
        },
        //修改邮箱的信息，比如：验证码之类的信息
        'modifyEmailInfo': {
          'originValidate': '',
          'next': false
        }
      },
      payPassword: '',   //全局支付密码
      //支付设置
      payConfig: {
        type: 0,       //0代表开启， 1代表修改
        showValidateEmail: false,    //显示邮箱验证
        ShowPayPassword: false,     //显示密码设置
        disabledInput: false,
        confirm: false,     //是否未确认密码
        payPassword: '',    //第一次密码
      },
      //密码修改信息
      modifyPassword: {},
      //修改密码验证规则
      rules: {
        originPassword: [
          { required: true, message: "原密码不可以为空", trigger: 'blur' },
          {min: 6, max: 16, message: "长度在 6 到 16 个字符", trigger: 'blur'},
          {validator: (rules, value, callback) => {
            common.ajax({
              url: 'home/config/checkPassword',
              data: {
                'userId': vm.userInfo.id,
                'originPassword': value,
                '_token': common.token
              }
            }).then((response) => {
              if(!response.type){
                callback(new Error(response.message));
              }else {
                callback();
              }
            }).catch((error) => {
              throw new Error(error);
            });
          }, trigger: 'submit'}
        ],
        password: [
          { required: true, message: "密码不可以为空", trigger: 'blur' },
          {min: 6, max: 16, message: "长度在 6 到 16 个字符", trigger: 'blur'},
        ],
        confirmPassword: [
          { required: true, message: "确认密码不可以为空", trigger: 'blur' },
          {min: 6, max: 16, message: "长度在 6 到 16 个字符", trigger: 'blur'},
          {validator: (rule, value, callback) => {
            if(value !== setting.modifyPassword.password){
              callback(new Error('两次密码输入不一致'));
            }else {
              callback();
            }
          }, trigger: 'blur'},
        ],
      },
      //修改邮箱验证规则
      modifyEmailRules: {
        originValidate: [
          {required: true, message: "验证码不可以为空", trigger: 'blur'},
          {min: 6, max: 6, message: "验证码长度错误", trigger: 'blur'},
          {validator: (rule, value, callback) => {
            const originValidate = +sessionStorage.getItem('originValidate');

            if(originValidate && common.encryption(value) != originValidate) {
              callback(new Error('验证码错误'));
            }else {
              setting.safety.buttonStatus = {
                disabled: false,
                content: '获取验证码'
              }
              clearInterval(setting.timer);
              callback();
            }
          }, trigger: "blur"}
        ],
        newEmail: [
          {required: true, message: "邮箱不可为空", trigger: "blur"},
          {validator: (rule, value, callback) => {
            if(!/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(value)){
              callback(new Error('邮箱格式错误'));
            }else{
              callback();
            }
          }, trigger: "blur"}
        ],
        newValidate: [
          {required: true, message: "验证码不可以为空", trigger: 'blur'},
          {min: 6, max: 6, message: "验证码长度错误", trigger: 'blur'},
          {validator: (rule, value, callback) => {
            const newValidate = +sessionStorage.getItem('newValidate');

            if(newValidate && common.encryption(value) != newValidate){
              callback(new Error('验证码错误'));
            }else {
              setting.safety.buttonStatus = {
                disabled: false,
                content: '获取验证码'
              }
              clearInterval(setting.timer);
              callback();
            }
          }, trigger: 'blur'},
        ]
      }
    },
    mounted (){
      this.safety.youbianNumber = this.userInfo.username;
      this.safety.bindEmail = this.userInfo.email;
    },
    watch: {
      payPassword (value){
        this.payPassword = value.slice(0, 6);
        if(this.payPassword.length === 6){
          this.$set(this.payConfig, 'disabledInput', true);

          if(this.payConfig.confirm){

            if(this.payPassword === this.payConfig.payPassword){
              const loading = this.$loading({
                lock: true,
                text: 'Loading',
              });

              common.ajax({
                url: 'home/config/configPayPassword',
                data: {
                  'payPassword': common.encryption(this.payPassword),
                  'userId': this.userInfo.id,
                  'type': this.payConfig.type,
                  '_token': common.token,
                }
              }).then((response) => {
                loading.close();
                this.payPassword = '';
                this.$set(this.payConfig, 'disabledInput', false);
                this.$set(this.payConfig, 'confirm', false);
                this.payConfig.ShowPayPassword = false;

                if(response.type){
                  this.$message({
                    type: 'success',
                    message: response.message,
                  });
                }else {
                  this.$message({
                    type: 'warning',
                    message: response.message,
                  });
                }
              }).catch((error) => {
                throw new Error(error);
              });
            }else {
              this.payPassword = '';
              this.$set(this.payConfig, 'disabledInput', false);
              this.$message({
                type: 'warning',
                message: '两次支付密码输入错误'
              });
            }
          }else{
            this.payConfig.payPassword = this.payPassword;
            this.$set(this.payConfig, 'confirm', true);

            this.payPassword = '';
            this.$set(this.payConfig, 'disabledInput', false);
          }
        }
      }
    },
    methods: {
      // 点击修改按钮弹出修改框
      handleModifyButton (){
        this.safety.modifyEmail = 1;

        //判断cd是否结束
        const nowDate = parseInt(new Date().getTime()/1000);
        const buttonCodeTime = +localStorage.getItem('button_Codetime');
        const buttonCd = +localStorage.getItem('button_cd');
        
        if(buttonCd && buttonCodeTime && nowDate - buttonCodeTime < buttonCd){
          this.modifyButtonStatus(buttonCd - (nowDate - buttonCodeTime));
        }
      },
      //修改绑定邮箱 -- 下一步
      handleModifyEmail (formName) {
        this.$refs[formName].validate((valid) => {
          if(valid){
            let modifyEmailInfo = Object.assign({}, this.safety.modifyEmailInfo);
            modifyEmailInfo.next = true;
            this.$set(this.safety, 'modifyEmailInfo', modifyEmailInfo);
          }else{
            return false;
          }
        });
      },
      //获取新邮箱的验证码
      getNewCode (){
        const value = this.safety.modifyEmailInfo.newEmail;

        if(value && /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/.test(value)){
          this.getCode(value, true);
        }
      },
      //修改绑定邮箱 -- 保存
      handleSaveEmail (formName) {
        this.$refs[formName].validate((valid) => {
          if(valid) {
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
            });
            common.ajax({
              url: '/home/config/modifyEmail',
              data: {
                'userId': this.userInfo.id,
                'originEmail': this.userInfo.email,
                'newEmail': this.safety.modifyEmailInfo.newEmail,
                '_token': common.token,
              }
            }).then((response) => {
              this.safety.modifyEmail = 0;
              loading.close();
              if(response.type){
                this.safety.bindEmail = this.safety.modifyEmailInfo.newEmail;
                this.$message({
                  type: 'success',
                  message: response.message,
                });
              }else {
                this.$message({
                  type: 'error',
                  message: response.message,
                });
              }
            }).catch((err) => {
              throw new Error(err);
            });
          }else{
            return false;
          }
        });
      },
      //修改绑定邮箱 -- 清空数据
      resetData (){
        this.safety.modifyEmailInfo = {};
        this.safety.modifyEmailInfo.next = false;
        clearInterval(setting.timer);
      },
      //显示支付设置
      showPayConfig (){
        this.showMain = 1;

        //判断是否开启了支付功能
        common.ajax({
          url: '/home/config/checkOpenPay',
          data: {
            'userId': this.userInfo.id,
            '_token': common.token,
          }
        }).then((response) => {
          if(response.type){
            this.payConfig.type = 1;
          }
        }).catch((error) => {
          throw new Error(error);
        });
      },
      //开通支付
      openPay (){
        this.payConfig.showValidateEmail = true;
      },
      //支付-----邮箱确认提交
      handlePaySubmit (formName){
        this.$refs[formName].validate((valid) => {
          if(valid) {
            this.payConfig.showValidateEmail = false;
            this.payConfig.ShowPayPassword = true;
          }else {
            return false;
          }
        });
      },
      handleClick (){
        this.$refs.input.focus();
      },
      //修改密码提交
      handleSubmit (formName) {
        this.$refs[formName].validate((valid) => {
          if(valid) {
            const loading = this.$loading({
              lock: true,
              text: 'Loading',
            });
            common.ajax({
              url: '/home/config/modifyPassword',
              data: {
                'userId': this.userInfo.id,
                'password': this.modifyPassword.password,
                '_token': common.token,
              }
            }).then((response) => {
              this.modifyPassword = {};
              loading.close();

              if(response.type) {
                this.$message({
                  type: 'success',
                  message: response.message,
                });
              }else {
                this.$message({
                  type: 'warning',
                  message: response.message,
                });
              }
            }).catch((error) => {
              throw new Error(error);
            });
          }else {
            return false;
          }
        })
      },
      //修改重置
      handleReset (formName) {
        this.$refs[formName].resetFields();
      },
      
      //获取验证码
      //register 判断是否为注册邮箱，或者只是单纯的获取验证码
      getCode (email, register = false){
        this.modifyButtonStatus();

        common.ajax({
          url: '/login/getValidate',
          data:{
            email,
            register,
            '_token': common.token,
          }
        }).then((response) => {
          if(+response === 1 ){
            this.$message({
              type: 'warning',
              message: '邮箱已被注册',
            });
          }else if(+response === 2){
            this.$message({
              type: 'warning',
              message: '邮箱不存在',
            });
          }else{
            if(register) {
              sessionStorage.setItem('newValidate', response);
            }else{
              sessionStorage.setItem('originValidate', response);
            }
          }
        }).catch((err) => {
          throw new Error(err);
        });
      },
      //获取验证码按钮状态
      modifyButtonStatus (cd = 20){
        
        this.safety.buttonStatus = {
          disabled: true,
          content: `${cd}s`
        };
        localStorage.setItem('button_Codetime', parseInt(new Date().getTime()/1000));   //验证码的cd，就是关闭浏览器也有效
        localStorage.setItem('button_cd', cd-1);   //验证码的cd，就是关闭浏览器也有效
        
        setting.timer = setInterval(() => {
          const cd = parseInt(this.safety.buttonStatus.content);
          this.safety.buttonStatus.content = `${cd-1}s`;

          localStorage.setItem('button_Codetime', parseInt(new Date().getTime()/1000));   //验证码的cd，就是关闭浏览器也有效
          localStorage.setItem('button_cd', cd-1);   //验证码的cd，就是关闭浏览器也有效

          if(cd - 1 < 0){
            this.safety.buttonStatus = {
              disabled: false,
              content: '重新获取验证码'
            };
            clearInterval(setting.timer);
          }
        }, 1000);
      },

      //退出登录
      logout (){
        this.$confirm('您确定要退出登录吗？', '退出登录', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          $.cookie('userInfo', null);
          window.open('./', '_self');
        }).catch(() => {
          return false;        
        });;
      }
    },
  });
});
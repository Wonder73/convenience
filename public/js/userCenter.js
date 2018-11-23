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
      showMain: 0,   //默认第一个
      //账号和安全信息
      safety: {
        'youbianNumber': 'Wonder',
        'bindEmail': '1491733348@qq.com',
        'modifyEmail': 0,
      },
      //密码修改信息
      modifyPassword: {},
      //修改密码验证规则
      rules: {
        originPassword: [
          { required: true, message: "原密码不可以为空", trigger: 'blur' },
          {min: 6, max: 16, message: "长度在 6 到 16 个字符", trigger: 'blur'},
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
      }
    },
    methods: {
      //修改密码提交
      handleSubmit (formName) {
        this.$refs[formName].validate((valid) => {
          if(valid) {
            alert('submit');
          }else {
            return false;
          }
        })
      },
      //修改密码重置
      handleReset (formName) {
        this.$refs[formName].resetFields();
      }
    },
  });
});
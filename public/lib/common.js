function Common(){
  this.rootURL = 'http://localhost/server/PHPWeb/convenience/public';
}

/**
 * 绘制验证码
 * dom  绘制验证码的节点
 * length 验证码的长度
 * 
 **/
Common.prototype.drawValidate = function (dom, length){
  const pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwsxz0123456789';
  const myCtx = dom.getContext("2d");
  const width = dom.width;    //画布宽度
  const height = dom.height;   //画布高度
  let str = '';      //保存每次获取到的数据

  //初始化画布
  myCtx.fillStyle = '#f1f1f1';
  myCtx.fillRect(0, 0, width, height);

  for(let i = 0; i < length; i++){
    const c = pool[this._randomNum(0, pool.length)];  //随机字
    const fs = this._randomNum(18, height);  //字体大小
    const deg = this._randomNum(-30, 30);   //字体旋转角度
    
    myCtx.font = fs + 'px Simhei';
    myCtx.textBaseline = 'top';
    myCtx.fillStyle = '#333';
    myCtx.save();
    myCtx.translate(20, 0);
    myCtx.translate(15*i+10, 15);
    myCtx.rotate(deg*Math.PI/180);
    myCtx.fillText(c, -15 + 5, -15);
    myCtx.restore();

    str += c;
  }

  //保存到storage中
  sessionStorage.setItem('validate', this.encryption(str.toLowerCase()));
}

/* 产生一个随机数 */
Common.prototype._randomNum = function (min, max){

  return parseInt(Math.random()*(max-min)+min);
}

/* 产生一个随机颜色 */
Common.prototype._randomColor = function (min, max){
  const r = this._randomNum(min, max);
  const g = this._randomNum(min, max);
  const b = this._randomNum(min, max);

  return `rgb(${b}, ${g}, ${b})`;
}

/* 加密算法 */
Common.prototype.encryption = function (value){
  var encreyption = value.toLowerCase().split('').reverse().join('');
  
  var encreyption2 = '';
  var encreyption3 = '';
  var encreyption4 = '';
  var encreyption5 = '';
  var encreyption6 = '';
  for(let i = 0;i<encreyption.length;i++){
    encreyption2 += encreyption[i].charCodeAt().toString(16);
  }
  for(let i = 0;i<encreyption2.length;i++){
    encreyption3 += parseInt(encreyption2[i],16);
  }
  for(let i = 0;i<encreyption3.length;i++){
    encreyption4 += (+encreyption3[i]).toString(8);
  }
  for(let i = 0;i<encreyption4.length;i++){
    encreyption5 += (+encreyption4[i]).toString(2);
  }
  for(let i = 0;i<encreyption5.length;i++){
    encreyption6 += (encreyption5[i] == '0'?'1':0);
  }
  var encreyption7 = parseInt(encreyption6,2).toString().split('').reverse().join('');

  return encreyption7;
}

/* 修改jq的ajax */
Common.prototype.ajax = function (obj) {
  return new Promise((resolve, reject) => {
    $.ajax({
      async: true,
      type: 'post',
      url: this.rootURL + '/' + obj.url,
      data: obj.data,
      dataType: 'json',
      processData : obj.processData,
      contentType : obj.contentType,
      success: function (response){
        resolve(response);
      },
      error: function (xhr, errorInfo) {
        reject(errorInfo);
      }
    })
  });
}

//获得年月
Common.prototype.nowMonth = function (span){
  const date = new Date();

  let year = date.getFullYear();
  let month = date.getMonth()+1;

  //相差月数
  if(span) {
    month += span;

    if(month < 1){
      month = 12;
      year--;
    }else if(month > 12){
      month = 1;
      year++;
    }
  }

  return `${year}-${month}`;
}

/* 支付组件 */
Common.prototype.payComponent = {
    props: ['pay'],
    data (){
      return {
        payPassword: '',
        disabledInput: false,
      }
    },
    mounted (){
      
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
      handleClick (){
        this.$refs.input.focus();
      },
      handlePay (){
        
        const loading = this.$loading({
          lock: true,
          text:'支付中.....',
        });
        
        common.ajax({
          url: 'utilities/handlePay',
          data: {
            payPassword: common.encryption(this.payPassword),
            ...this.pay,
            '_token': common.token,
          },
        }).then((response) => {
          loading.close();
          if(response.type){
            this.$emit('completepay', { index: this.pay.index, pormIndex: this.pay.pormIndex, value: 1, cost: this.pay.cost });
            this.pay.visible = false;
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

      }
    },
    template: `
      <div id="pay">
        <el-dialog
          custom-class = "pay"
          title = "请输入支付密码"
          :visible.sync = "pay.visible"
          center
        > 
          <div class="pay--main">
            <span>{{pay.category == 0? '缴纳水费': pay.category == 1? '缴纳电费': 0}}</span>
            <span>￥{{pay.cost}}</span>
            <div class="pay--main__password" @click="handleClick">
              <span>{{(payPassword.length > 0? '●': null)}}</span>
              <span>{{(payPassword.length > 1? '●': null)}}</span>
              <span>{{(payPassword.length > 2? '●': null)}}</span>
              <span>{{(payPassword.length > 3? '●': null)}}</span>
              <span>{{(payPassword.length > 4? '●': null)}}</span>
              <span>{{(payPassword.length > 5? '●': null)}}</span>
            </div>
            <input type="number" style="opacity:0" v-model="payPassword" maxlength="6" :disabled="disabledInput" autofocus="autofocus" ref="input"/>
          </div>
        </el-dialog>
      </div>
    `
}

//验证用户身份
Common.prototype.checkIdentity = function (userInfo, Identity){
  this.ajax({
    url: 'checkIdentity/' + Identity,
    data: {
      userInfo,
      '_token': this.token
    }    
  }).then((response) => {
    if(!response.type){
      window.open('.', '_self');
    }
  });
}
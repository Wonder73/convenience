$(function (){

  var vm = new Vue({
    el: '#utilities',
    delimiters:['${', '}'],
    data: {
      //用户基本信息
      userInfo: JSON.parse(decodeURIComponent($.cookie('userInfo'))),
      //缴纳类型
      category: 0,
      //搜索费用的条件
      search: {
        ridgepole: '',
        dorm: '',
        startMonth: '',
        endMonth: ''
      },
      searchResults: [],
      //搜索水费的一些条件
      water: {
        ridepoles: [
          {value: '1'},
          {value: '2'},
          {value: '3'},
          {value: '4'},
          {value: '5'},
          {value: '6'},
          {value: '7'},
          {value: '8'},
          {value: '9'},
          {value: '10'},
        ]
      },
      rules: {
        ridgepole: [
          {required: true, message: '所属栋不可为空', trigger: 'blur'},
        ],
        dorm: [
          {required: true, message: '宿舍号不可为空', trigger: 'blur'}
        ],
        startMonth: [
          {required: true, message: '开始日期不可为空', trigger: 'blur'},
        ],
        endMonth: [
          {required: true, message: '结束日期不可为空', trigger: 'blur'},
          {validator: (rule, value, callback) => {
            if(new Date(vm.search.startMonth).getTime() - new Date(value).getTime() > 0){
              callback(new Error('结束日期不可以小于开始日期'));
            }else{
              callback();
            }

          }, trigger: 'blur'}
        ]
      },
      /* 支付的一些必要条件 */
      pay: {},
      /* 显示aa支付按钮,只有舍长才能开启 */
      showAABut: false,
    },
    mounted (){
      this.userInfo = JSON.parse(userInfo);
      this.search = {
        'ridgepole': this.userInfo.user_identity.ridgepole,
        'dorm': this.userInfo.user_identity.dorm_num,
        'startMonth': common.nowMonth(-1),
        'endMonth': common.nowMonth(),
      }
      this.showAABut = this.userInfo.user_identity.role_id == 1;
    },
    components: {
      'v-pay': common.payComponent
    },
    filters: {
      //给栋加上后缀
      suffix (value) {
        return `${value}栋`
      },
      //日期范围格式
      dateFormat (value) {
        return value.slice(0, value.lastIndexOf('-'))
      }
    },
    methods: {
      //查询
      query (formName){
        
        this.$refs[formName].validate((valid) => {
          if(valid) {
            
            const loading = this.$loading({   //loading;
              lock: true,
              text: '搜索中.....'
            });
            //获取搜索结果
            common.ajax({
              'url': 'utilities/query',
              'data': {
                'ridgepole': this.search.ridgepole,
                'dormNum': this.search.dorm,
                'startMonth': this.search.startMonth,
                'endMonth': this.search.endMonth,
                'category': this.category,
                '_token': common.token
              }
            }).then((response) => {
              if(response){
                loading.close();

                let message = {};  //消息提示
                if(response.length){
                  const newResponse = formatResponse(response);

                  this.searchResults = response;

                  message={
                    message: `共搜索到${response.length}条记录`,
                    type: 'success',
                  };
                }else {
                  this.searchResults = [];
                  message={
                    message: `很遗憾，没有搜索到记录！！！`,
                    type: 'warning',
                  };
                }
                this.$message(message);
              }
            }).catch((err) => {
              throw Error(err);
            });
          } else {
            // console.log('error');
            return false;
          }
        });
      },
      //一键支付
      oneKey (index){
        this.pay = {
          category: this.category,
          utilitiesId: this.searchResults[index].id,
          payUserId: this.userInfo.id,
          visible: true,
          index,
          cost: this.searchResults[index].cost,
          oneKey: 1,    //1代表一键支付
        };
      },
      //aa支付
      /** 
       * utilitiesId //水电费的id
       * porm   //aa支付的信息
       * pormIndex  //aa支付的信息下标
       * index   //水电费的下标
      */
      handlePay (utilitiesId, porm, pormIndex, index) {
        this.pay = {
          visible: true,
          utilitiesId,
          payUserId: this.userInfo.id,
          userId: porm.user_id,
          cost: porm.cost,
          category: this.category,
          oneKey: 0,    //0代表不是一键支付
          pormIndex,
          index,
        }
      },
      //完成支付
      handleCompletePay (obj) {
        this.searchResults[obj.index].hasPay = this.searchResults[obj.index].hasPay*1 + obj.cost*1;

        if(obj.pormIndex || obj.pormIndex === 0){
          this.searchResults[obj.index].porms[obj.pormIndex].complete_pay = +obj.value;
        }else{
          this.searchResults[obj.index].completePay = +obj.value;
        }
      },
      //实行aa
      handleaa (index) {

        this.$confirm('此操作将永远开启AA支付，是否开启', '开启AA支付', {
          confirmButtonText: '开启',
          cancelButtonText: '取消',
          type: 'warning',
          center: true,
        }).then(() => {
          this.$message({
            message: '已开启',
            type: 'success'
          });

          common.ajax({
            url: 'utilities/getAAInfo',
            data: {
              'utilitiesId': this.searchResults[index].id,
              'ridgepole': this.searchResults[index].ridgepole,
              'dormNum': this.searchResults[index].dormNum,
              'cost': +this.searchResults[index].cost,
              '_token': common.token,
            }
          }).then((response) => {
            this.searchResults[index].aa = 1;
            this.searchResults[index].porms = getPorms2(response, +this.searchResults[index].cost/response.length);
          }).catch((error) => {
            console.log(error);
          });

        }).catch(() => {
          this.$message({
            message: '已取消',
            type: 'info'
          });
        });

        
      }
    },
    
  });
});

//格式化resposne
function formatResponse(response) {
  let newResponse = [];

  for(let v of response){
    v.porms = getPorms(v.porms);
    
    newResponse.push(v);
  }

  return newResponse;
}

//格式化获取proms     查询时
function getPorms(porms){
  let proms = [];

  for(let v of porms){
    
    let temp = {
      'user_id': v.user_id,
      'username': v.user.username,
      'nickname': v.user_info.nickname,
      'cost': v.cost,
      'complete_pay': v.complete_pay,
    }

    proms.push(temp);
  }

  return proms;
}


//格式化proms    当第一次开启aa时
function getPorms2(response, cost) {
  let proms = [];

  for(let v of response) {
    let temp = {
      'user_id': v.user_id,
      'username': v.user.username,
      'nickname': v.user_info.nickname,
      'cost': cost,
      'complete_pay': 0,
    }

    proms.push(temp);
  }

  return proms;
}


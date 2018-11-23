$(function (){
  $('#myCarousel').carousel({
    'interval': false,
  });


  const vm = new Vue({
    el: '.container',
    delimiters:['${', '}'],
    data: {
      //显示添加app
      showAddApp: false,
      //app收缩按钮
      addAppSearchShow: false,
      //判断是否有用户登录
      checkUser: false,
      //搜索app
      app: {
        'offset': 1,
        'limit': 10,
        'searchValue': '',
      },
      userInfo: {},
      dataSources: [],
      //所有app
      allAppDataSources: [],
    },
    mounted (){
      let userInfo = decodeURIComponent($.cookie('userInfo'));
      if(userInfo !== 'undefined' && userInfo !== 'null'){
        this.checkUser = true;
        this.userInfo = JSON.parse(userInfo);
        common.ajax({
          url: 'index/getApp',
          data: {
            'apps': this.userInfo.user_app.split(','),
            '_token': common.token
          }
        }).then((response) => {
          if(response.type){
            this.dataSources = response.data;
          }
        });
      }
    },
    methods: {
      //显示登录框
      showLogin (){
        $('.login').fadeIn(300);
        $('.shadow').fadeIn(300);
      },
      //处理显示添加app
      handleShowAddApp (){
        this.showAddApp = true;
        this.getAllApp();
      },
      query (){
        this.allAppDataSources = [];
        this.app.offset = 1;
        this.getAllApp();
      },
      //滚动到底部加载更多
      handleScroll (event){
        if(event.target.clientHeight + event.target.scrollTop === event.target.scrollHeight){
          this.getAllApp();
        }
      },
      //获取说有app
      getAllApp(role_id = this.userInfo.user_identity.role_id){
        common.ajax({
          url: 'index/getAllApp',
          data: {
            role_id,
            ...this.app,
            '_token': common.token
          }
        }).then((response) => {
          if(response.type){
            this.app.offset ++;
            const data = this.allAppDataSources;
            this.allAppDataSources = data.concat(response.data);
          }
        });
      },
      //添加应用
      addApp(app_id){
        const user_app = this.userInfo.user_app.split(',');
        console.log(user_app);
        user_app.push(app_id);
        this.modifyApp(user_app, 'add');
      },
      //删除应用
      deleteApp(app_id){
        const user_app = this.userInfo.user_app.split(',');
        console.log(user_app);
        user_app.splice(user_app.indexOf(app_id.toString()),1);
        this.modifyApp(user_app, 'delete');
      },
      //修改用户拥有的app
      modifyApp (array, type){
        const loading = this.$loading({
          lock: true,
          text: '添加中...',
        });
        console.log(this.userInfo);
        const user_app = array.join(',');
        common.ajax({
          url: 'index/modifyApp',
          data: {
            userId: this.userInfo.id,
            user_app,
            type,
            '_token': common.token,
          },
        }).then((response) => {
          loading.close();
          if(response.type){
            this.$message({
              type: 'success',
              message: response.message,
            });
            this.userInfo.user_app = user_app;
            $.cookie('userInfo',encodeURIComponent(JSON.stringify(this.userInfo)),{expires:3});
          }else {
            this.$message({
              type: 'warning',
              message: response.message,
            });
          }
        });
      }
    }
  });
});
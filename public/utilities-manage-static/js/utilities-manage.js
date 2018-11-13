$(function (){

  var vm = new Vue({
    el: '#utilities-manage',
    delimiters:['${', '}'],
    data: {
      //excel 文件上传链接
      upload: {
        uploadShow: false,
        uploadAction: common.rootURL + "/utilities-manage/uploadExcel",
        data: {
          '_token': common.token,
          'category': 0,
        }
      },
      //用户基本信息
      userInfo: JSON.parse(decodeURIComponent($.cookie('userInfo'))),
      //水电费类型
      category: 0,
      //分页初始化数据
      pagination: {
        currentPage: 1,
        pageSize: 10,
        pagerCount: 5,
        layout: "total, prev, pager, next, jumper",
        small: false
      },
      //表格数据源
      tableData: {},
      //多选，选择项
      selected: [],
      //搜索框的显示
      searchVisible: false,
      //搜索条件
      searchValue: {},
      //排序
      sort: {},
      //栋
      ridepoles: [
        { index: '1', value: '1' },
        { index: '2', value: '2' },
        { index: '3', value: '3' },
        { index: '4', value: '4' },
        { index: '5', value: '5' },
        { index: '6', value: '6' },
        { index: '7', value: '7' },
        { index: '8', value: '8' },
        { index: '9', value: '9' },
        { index: '10', value: '10' },
      ],

      //表格更新数据时,启动loading
      loading: false,
    },
    mounted (){
      this.userInfo = JSON.parse(userInfo);
      
      //分页的响应式
      const offsetWidth = document.documentElement.offsetWidth;
      if(offsetWidth < 460){
        this.pagination.small = true;
        this.pagination.layout = "prev, pager, next";
      }else if(offsetWidth < 460){
        this.pagination.small = true;
        this.pagination.layout = "total, prev, pager, next";
      }else if(offsetWidth < 600){
        this.pagination.layout = "total, prev, pager, next";
      }

      //获取初始化数据
      this.getTableData();
      
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
    watch: {
      category (val){
        this.upload.data.category = val;
        this.getTableData();
      }
    },
    methods: {
      //当多选框发生改变时
      handleSelectChange ($row){
        //筛选数据，只要utilitiesId
        //如果为空退出
        if(!$row.length){
          this.selected = [];
          return false;
        }

        for(let v of $row){
          this.selected.push(v.id);
        }
      },

      //启动编辑
      openEdit (index) {
        this.$confirm('此操作将会开启编辑，是否继续?', '开启标记', {
          confirmButtonText: '继续',
          cancelButtonText: '取消',
          type: 'warning',
          center: true
        }).then(() => {
          this.tableData.dataSource[index].edit = true;
        });
      },

      //取消编辑
      closeEdit (index) {
        this.$confirm('此操作将会取消修改的内容，是否继续?', '取消编辑', {
          confirmButtonText: '继续',
          cancelButtonText: '取消',
          type: 'warning',
          center: true
        }).then(() => {
          this.tableData.dataSource[index].edit = 0;
        });
      },

      //删除单条数据
      deleteData (utilitiesId) {

        this.$confirm('此操作将会删除该条数据，是否继续?', '删除', {
          confirmButtonText: '继续',
          cancelButtonText: '取消',
          type: 'warning',
          center: true
        }).then(() => {
          this.loading = true;

          common.ajax({
            url: 'utilities-manage/deleteData',
            data: {
              utilitiesId,
              '_token': common.token
            }
          }).then((response) => {
            if(response.type){
              this.$message({
                type: 'success',
                message: response.info
              });
              this.getTableData();
            }else{
              this.$message({
                type: 'error',
                message: response.info
              });
              this.loading = false;
            }
          });
        });
      },

      //批量删除
      bacthDelete (){
        this.deleteData(this.selected);
      },
      
      //保存修改数据
      saveEdit (index) {

        this.$confirm('此操作将会保存修改的数据，是否继续?', '删除', {
          confirmButtonText: '继续',
          cancelButtonText: '取消',
          type: 'warning',
          center: true
        }).then(() => {
          this.loading = true;

          common.ajax({
            url: 'utilities-manage/updateData',
            data: {
              dataSource: this.tableData.dataSource[index],
              '_token': common.token
            }
          }).then((response) => {
            this.loading = false;
            this.tableData.dataSource[index].edit = false;
            if(response.type){
              this.$message({
                type: 'success',
                message: response.info
              });
            }else{
              this.$message({
                type: 'warning',
                message: response.info
              });
            }
          });
        });

      },

      //当前页码改变时触发
      handleCurrentChange (val){
        this.getTableData(val);
      },

      //按条件搜索
      query (){
        this.searchVisible = false;
        this.getTableData(this.pagination.currentPage, this.searchValue, this.sort);
      },

      //排序
      handleSortChange (sort){
        this.sort.orderName = sort.prop;
        this.sort.order = sort.order.slice(0, sort.order.lastIndexOf('e'));
        
        this.getTableData(this.pagination.currentPage, this.searchValue, this.sort);
      },

      //上传成功的回调
      successUpload(info){
        this.uploadLoading.close();
        if(info.type){
          this.$message({
            type: 'success',
            message: '上传成功',
          });
          this.upload.uploadShow = false;
          window.location.reload();
        }
      },
      
      //上传时
      beforeUpload(info){
        this.uploadLoading = this.$loading({
          lock:true,
          text: "上传中....",
        });
      },

      //获取数据方法
      getTableData (currentPage = this.pagination.currentPage, searchValue = this.searchValue, sort = this.sort, pageSize = this.pagination.pageSize, category = this.category){
        this.loading = true;
        //获取数据
        common.ajax({
          url: 'utilities-manage/getData',
          data: {
            searchValue,
            sort,
            currentPage,
            pageSize,
            category,
            '_token': common.token
          }
        }).then((response) => {
          response.dataSource.forEach((value, index) => {
            value.edit = 0;
          })
          this.tableData = response;
          //取消loading;
          this.loading = false;
        });
      },
      //导出
      download (){
        const filter = {
          category: this.category,
          searchValue: JSON.stringify(this.searchValue),
          order: JSON.stringify(this.sort)
        }
        window.open('./utilities-manage/download?filter=' + JSON.stringify(filter));
      }    
    },


  });
});

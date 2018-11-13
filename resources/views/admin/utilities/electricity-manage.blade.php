<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>电费管理</title>
<style type="text/css">
.cl .l a{
	margin: 5px;
}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 水电费管理 <span class="c-gray en">&gt;</span> 电费管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" @click="bacthDelete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a><a href="javascript:;" class="btn btn-primary radius"  @click = "searchVisible = true"><i class="Hui-iconfont">&#xe683;</i></a><a href="javascript:;" class="btn btn-primary radius" @click="upload.uploadShow = true"><i class="Hui-iconfont">&#xe645;</i>导入</a><a href="javascript:;" class="btn btn-primary radius"  @click="download"><i class="Hui-iconfont">&#xe644</i>导出</a></span> <span class="r">共有数据：<strong>${tableData.total}</strong> 条</span> </div>
	<div class="mt-20">
		<el-table
			border
			v-loading="loading"
			element-loading-text="拼命加载中"
			ref="multipleTable"
			size = "mini"
			style = "width: 100%;"
			:data = "tableData.dataSource"
			@selection-change = "handleSelectChange"
			@sort-change = "handleSortChange"
		>
			<el-table-column 
				type = "selection"
				align = "center"
				min-width = "40"
			></el-table-column>
			<el-table-column 
				prop = "ridgepole"
				label = "所属栋"
				align = "center" 
				min-width = "85"
				fixed = "left"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.ridgepole | suffix}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.ridgepole" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				prop = "dorm_num"
				label = "宿舍号"
				align = "center" 
				fixed = "left"
				min-width = "85"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.dormNum}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.dormNum" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "开始日期"
				prop = "start_month"  
				align = "center"  
				min-width = "110"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.startDate}</div>
					<div v-else><el-date-picker type="date" placeholder="开始日期" style="width: 100%;" size="mini" prefix-icon="none" value-format="yyyy-MM-dd" v-model="scope.row.startDate"></el-date-picker></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "结束日期"
				prop = "end_month"  
				align = "center" 
				min-width = "110"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.startDate}</div>
					<div v-else><el-date-picker type="date" placeholder="开始日期" style="width: 100%;" size="mini"  prefix-icon="none" value-format="yyyy-MM-dd" v-model="scope.row.endDate"></el-date-picker></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "上个月读数"
				prop = "last_degrees"
				align = "center" 
				min-width = "120" 
				sortable = "custom" 
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.lastDegrees}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.lastDegrees" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "这个月读数"
				prop = 'this_degrees'
				align = "center"  
				min-width = "120"
				sortable = "custom" 
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.thisDegrees}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.thisDegrees" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "实际读数" 
				prop = "practical_degrees"
				align = "center" 
				min-width = "100"
				sortable = "custom" 
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.practicalDegrees}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.practicalDegrees" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "价格"
				prop = "price"
				align = "center" 
				min-width = "100" 
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.price}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.price" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "缴纳费用"
				prop = "cost"
				align = "center"
				min-width = "100"
				sortable = "custom" 
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.cost}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.cost" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "已缴纳费用"
				prop = "has_pay" 
				align = "center" 
				min-width = "110"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.hasPay}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.hasPay" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "是否交齐"
				prop = "complete_pay"
				align = "center"
				min-width = "110" 
				fixed = "right"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">
						<div style="color: #85ce61" v-if="scope.row.completePay">已交齐</div>
						<div style="color: #f56c6c" v-else>未交齐</div>
					</div>
					<div v-else>
						<el-radio-group v-model="scope.row.completePay" size="mini">
							<el-radio-button label="0">否</el-radio-button>
							<el-radio-button label="1">是</el-radio-button>
						</el-radio-group>
					</div>
				</template>
			</el-table-column>
			<el-table-column
				label = "操作"
				align = "center"
				min-width = "160"
			>
				<template slot-scope="scope">
					<transition name="fade">
						<div v-if="!scope.row.edit">
							<el-button size="mini" @click="openEdit(scope.$index)">编辑</el-button>
							<el-button type="danger" size="mini" @click="deleteData(scope.row.id)">删除</el-button>
						</div>
						<div v-else>
							<el-button type="primary" size="mini" @click="saveEdit(scope.$index)">保存</el-button>
							<el-button type="danger" size="mini" @click="closeEdit(scope.$index)">取消</el-button>
						</div>
					</transition>
				</template>
			</el-table-column>
		</el-table>

		<!-- 分页 -->
		<div class="utilities-manage--main__table-pagination" v-if="tableData.total > pagination.pageSize">
			<el-pagination
				:total = "tableData.total"
				:current-page.sync = "pagination.currentPage"
				:page-size = "pagination.pageSize"
				:pager-count = "pagination.pagerCount"
				:layout = "pagination.layout"
				:small = "pagination.small"
				@current-change = "handleCurrentChange"
			></el-pagination>
		</div>
	</div>

	<!-- 上传组件 -->
	<div class="utilities-manage--main__upload">
        <el-dialog
          custom-class = "utilities-manage--main__upload-dialog" 
          title="导入excel表格"
          :visible.sync = "upload.uploadShow"
          center
          >
          <el-upload
            class="utilities-manage--main__upload-upload"
            drag
            :action="upload.uploadAction"
            accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            :data = "upload.data"
            :on-success = "successUpload"
            :before-upload = "beforeUpload"
          >
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
            <div class="el-upload__tip" slot="tip">只能上传excel文件，且不超过500kb</div>
          </el-upload>
        </el-dialog>
      </div>

      <!-- 搜索内容的关键字 -->
      <div class="utilities-manage--main__search">
        <el-dialog
          title="搜索关键字"
          :visible.sync="searchVisible"
          center = "true"
          custom-class = "utilities-manage--main__search-dialog"
        >
          <el-form ref="form" :model="searchValue" label-width="80px">
            <el-form-item label="所属栋：" prop="ridgepole">
              <el-select v-model="searchValue.ridgepole" placeholder="所属栋" filterable="true" size="small">
                <el-option
                  v-for="(ridepole, index) in ridepoles"
                  :key="index"
                  :label="ridepole.value + ' 栋'"
                  :value="ridepole.value"
                ></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="宿舍号：" prop="dorm">
              <el-input type="text" placeholder="宿舍号。如：306" size="small" v-model="searchValue.dorm_num"/>
            </el-form-item>
            <el-form-item label="时　间：">
              <el-col :span="11">
                <el-form-item prop="startMonth">
                  <el-date-picker type="month" placeholder="开始日期" v-model="searchValue.start_month" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
                </el-form-item>
              </el-col>
              <el-col style="text-align: center" :span="2">~</el-col>
              <el-col :span="11">
                <el-form-item prop="endMonth">
                  <el-date-picker type="month" placeholder="日期日期" v-model="searchValue.end_month" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
                </el-form-item>
              </el-col>
            </el-form-item>
            <el-form-item label="交　齐：" prop="completePay">
              <el-radio-group v-model="searchValue.complete_pay">
                <el-radio :label="0">未交齐</el-radio>
                <el-radio :label="1">已交齐</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" size="small" @click="query('form')">搜索</el-button>
            </el-form-item>
          </el-form>
        </el-dialog>
      </div>
    </div>

</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('lib/common.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->
<script src="{{asset('admins')}}/lib/vue.min.js"></script>
<link href="{{asset('admins')}}/lib/element-ui/lib/theme-chalk/index.css" rel="stylesheet">
<script src="{{asset('admins')}}/lib/element-ui/lib/index.js"></script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
const common = new Common();
common.token = "{{csrf_token()}}"
const vm = new Vue({
	el: '.page-container',
	delimiters:['${', '}'],
	data: {
		//excel 文件上传链接
		upload: {
			uploadShow: false,
			uploadAction: common.rootURL + "/utilities-manage/uploadExcel",
			data: {
				'_token': common.token,
				'category': 1,
			}
		},
		//分页初始化数据
		pagination: {
			currentPage: 1,
			pageSize: 10,
			pagerCount: 5,
			layout: "total, prev, pager, next, jumper",
			small: false
		},
		//数据类型
		category: 1,
		//表格数据源
		tableData: {},
		//多选，选择项
		selected: [],
		//排序
		sort: {},
		//表格更新数据时,启动loading
		loading: false,
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
	},
	mounted (){
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
		//导出
		download (){
			const filter = {
				category: this.category,
				searchValue: JSON.stringify(this.searchValue),
				order: JSON.stringify(this.sort)
			}
			window.open('../utilities-manage/download?filter=' + JSON.stringify(filter));
		}    
	}
});
</script>
</body>
</html>
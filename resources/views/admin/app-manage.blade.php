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
<link href="{{asset('admins')}}/lib/element-ui/lib/theme-chalk/index.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>水费管理</title>
<style type="text/css">
.cl .l a{
	margin: 5px;
}
</style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 应用管理 <span class="c-gray en">&gt;</span> 应用列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<input type="text" name="" id="" placeholder="应用名称" style="width:250px" class="input-text" v-model="searchValue">
		<button name="" id="" class="btn btn-success" @click="query"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" @click="bacthDelete" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a><a href="javascript:;" class="btn btn-primary radius"  @click = "appVisible = true"><i class="Hui-iconfont">&#xe600;</i>添加</a></span> <span class="r">共有数据：<strong>${tableData.total}</strong> 条</span> </div>
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
				prop = "app_name"
				label = "应用名称"
				align = "center" 
				min-width = "85"
				fixed = "left"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit">${scope.row.app_name}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.app_name" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				prop = "app_address"
				label = "访问路由"
				align = "center" 
				fixed = "left"
				min-width = "85"
				sortable = "custom"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit" @click="jumpUrl(scope.row.app_address)" style="cursor:pointer;">${scope.row.app_address}</div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.app_address" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "应用图标"
				prop = "app_logo"
				align = "center" 
				min-width = "120"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit"><img :src="scope.row.app_logo | modifyLogoUrl" width="80px" height="80px" /></div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.app_logo" /></div>
				</template>
			</el-table-column>
			<el-table-column 
				label = "权限"
				prop = 'app_permission'
				align = "center"  
				min-width = "120"
			>
				<template slot-scope="scope">
					<div v-if="!scope.row.edit"><el-tag size="mini" v-for="permission in scope.row.app_permissions" :key="permission.id">${permission.name}</el-tag></div>
					<div v-else><el-input type="text" size="mini"  v-model="scope.row.thisDegrees" /></div>
				</template>
			</el-table-column>
			<el-table-column
				label = "操作"
				align = "center"
				min-width = "150"
			>
				<template slot-scope="scope">
					<div>
						<el-button size="mini" @click="openEdit(scope.$index)">编辑</el-button>
						<el-button type="danger" size="mini" @click="deleteData(scope.row.id)">删除</el-button>
					</div>
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

		<!-- 添加和修改 -->
		<div class="utilities-manage--main__search">
			<el-dialog
				:title="modifyVisible?'修改应用':'添加应用'"
				:visible.sync="appVisible"
				center = "true"
				custom-class = "utilities-manage--main__search-dialog"
				@close = "dialogClose"
			>
				<el-form ref="form" :model="appInfo" :rules="rules" label-width="100px">
					<el-form-item label="应用名称：" prop="app_name">
						<el-input type="text" placeholder="应用名称" size="small" v-model="appInfo.app_name"/>
					</el-form-item>
					<el-form-item label="访问地址：" prop="app_address">
						<el-input type="text" placeholder="应用地址" size="small" v-model="appInfo.app_address"/>
					</el-form-item>
					<el-form-item label="应用图标：" prop="app_logo">
						<el-upload
							class="avatar-uploader"
							action = "https://jsonplaceholder.typicode.com/posts/"
							:show-file-list="false"
							:before-upload = "handleBeforeUpload"
						>
							<img v-if="upload.imageUrl" :src="upload.imageUrl" class="avatar">
							<i v-else class="el-icon-plus avatar-uploader-icon"></i>
						</el-upload>
					</el-form-item>
					<el-form-item label="应用权限：" prop="app_permission">
						<el-select v-model="appInfo.app_permission" multiple size="small" placeholder="应用权限">
							<el-option v-for="(permission, index) in permissions" :key="index" :value="permission.id" :label="permission.role_name"></el-option>
						</el-select>
					</el-form-item>
					<el-form-item label="应用描述：" prop="app_description">
						<el-input type="textarea" placeholder="应用描述" size="small" :autosize="{minRows: 3}" resize="none" v-model="appInfo.app_description"/>
					</el-form-item>
					<el-form-item>
						<el-button type="primary" size="small" @click="addUpload('form')">${modifyVisible?'修改':'添加'}</el-button>
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
		//图片上传链接
		upload: {
			//图片链接
			imageUrl: '',
		},
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
		//排序
		sort: {},
		//搜索内容
		searchValue: '',
		//表格更新数据时,启动loading
		loading: false,
		//添加应用的显示
		appVisible: false,
		//修改应用的显示
		modifyVisible: false,
		//添加内容
		appInfo: {
			app_permission: [],
		},
		
		//权限选项
		permissions: [],
		//提交验证规则
		rules: {
			app_name: [
				{required: true, message: "应用名称不可以为空", trigger: 'blur'}
			],
			app_address: [
				{required: true, message: "访问地址不可以为空", trigger: 'blur'}
			],
			app_logo: [
				{required: true, message: "应用名称不可以为空", trigger: 'blur'}
			],
			app_permission: [
				{required: true, message: "用户权限不可以为空", trigger: 'blur'}
			],
		}
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
		
		//获取角色列表
		common.ajax({
				url: 'yb-admin/app-manage/getRole',
				data: {
					'_token': common.token
				}
			}).then((response) => {
				if(response.type){
					this.permissions = response.data;
				}
			});

		//获取初始化数据
		this.getTableData();
	},
	filters: {
		//给栋加上后缀
		modifyLogoUrl (value) {
			return common.rootURL +'/'+ value;
		},
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

		// 编辑框关闭时，初始化数据
		dialogClose (){
			this.modifyVisible = false;
			
			delete this.appInfo.id;
			delete this.appInfo.app_name;
			delete this.appInfo.app_address;
			delete this.appInfo.app_logo;
			delete this.appInfo.app_description;
			this.appInfo.app_permission = [];
			this.upload.imageUrl = '';
		},

		//启动编辑
		openEdit (index) {
			const data = this.tableData.dataSource[index];

			this.appVisible = true;
			this.modifyVisible = true;
			
			this.appInfo.id = data.id;
			this.appInfo.app_name = data.app_name;
			this.appInfo.app_address = data.app_address;
			this.appInfo.app_logo = data.app_logo;
			this.appInfo.app_description = data.app_description;
			this.appInfo.app_permission = data.app_permission.split(',').map((value, index) => {
				return value*1;
			});
			this.upload.imageUrl = common.rootURL + data.app_logo;
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
		deleteData (appId) {

			this.$confirm('此操作将会删除该条数据，是否继续?', '删除', {
				confirmButtonText: '继续',
				cancelButtonText: '取消',
				type: 'warning',
				center: true
			}).then(() => {
				this.loading = true;

				common.ajax({
					url: 'yb-admin/app-manage/deleteData',
					data: {
						appId,
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
		
		//当前页码改变时触发
		handleCurrentChange (val){
			this.getTableData(val);
		},

		//图片上传
		handleBeforeUpload (file){
			this.appInfo.app_logo = file;
			this.upload.imageUrl = URL.createObjectURL(file);
		},

		//添加应用
		addUpload (formName){
			this.addLoading = this.$loading({
				lock: true,
				text: '添加中...',
			});
			this.$refs[formName].validate((valid) => {
				if(valid) {
					let formData = new FormData();
					//把appInfo的数据添加到formData里面
					for(let value in this.appInfo){
						formData.append(value, this.appInfo[value]);
					}
					formData.append('_token', common.token);

					common.ajax({
						url: 'yb-admin/app-manage/addUploadApp',
						data: formData,
						processData: false,
						contentType : false,
					}).then((response) => {
						this.addLoading.close();
						if(response.type){
							this.$message({
								type: 'success',
								message: response.message,
							});
							//数据清空
							this.appInfo.app_name = '';
							this.appInfo.app_address = '';
							this.appInfo.app_logo = '';
							this.upload.imageUrl = '';

							this.appVisible = false;
							this.getTableData();
						}else {
							this.$message({
								type: 'warning',
								message: response.message
							});
						}
					}).catch((err) => {
						this.addLoading.close();
					});

				}else{
					return false;
				}
			});
		},

		//点击范围链接进行跳转
		jumpUrl (url){
			console.log(common.rootURL);
			window.open(common.rootURL + '/' + url);
		},

		//排序
		handleSortChange (sort){
			this.sort.orderName = sort.prop;
			this.sort.order = sort.order.slice(0, sort.order.lastIndexOf('e'));
			
			this.getTableData(this.pagination.currentPage, this.searchValue, this.sort);
		},
		//搜索
		query(){
			this.getTableData();
		},

		//获取数据方法
		getTableData (currentPage = this.pagination.currentPage, searchValue = this.searchValue, sort = this.sort, pageSize = this.pagination.pageSize){
			this.loading = true;
			//获取数据
			common.ajax({
				url: 'yb-admin/app-manage/getData',
				data: {
					searchValue,
					sort,
					currentPage,
					pageSize,
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
	}
});
</script>
</body>
</html>
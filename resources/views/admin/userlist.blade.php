<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admins')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admins')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户管理 <span class="c-gray en">&gt;</span>用户管理列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
		<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="category_add()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="14">用户管理列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="50">账号</th>
				<th width="50">昵称</th>
				
				<th width="50">专业</th>
				<th width="50">真实姓名</th>
				<th width="50">qq</th>
				<th width="50">生日</th>
				<th width="50">电话</th>
				<th width="50">头像</th>
				<th width="50">选择的应用</th>
				<th width="50">创建日期</th>
				<th width="50">状态</th>
				<th width="50">操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $v)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$v->id}}</td>
				<td>{{$v->user_id}}</td>
				<td>{{$v->nickname}}</td>
				
				<td>{{$v->major}}</td>
				<td>{{$v->real_name}}</td>
				<td>{{$v->qq}}</td>
				<td>{{$v->birth}}</td>
				<td>{{$v->phone}}</td>
				<td><img style="width: 100px;" src="{{asset($v->head?$v->head: 'image/more.png')}}"/></td>
				<td>{{$v->app}}</td>
				<td>{{$v->date}}</td>


				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<td class="td-manage"><a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用">
                                <i class="Hui-iconfont">&#xe631;</i></a>
                                <a title="删除" href="javascript:;" onclick="user_del(this,'{{$v->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
		@endforeach	
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admins/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admins/static/h-ui/js/H-ui.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins/static/h-ui.admin/js/H-ui.admin.js')}}"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins/lib/My97DatePicker/4.8/WdatePicker.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins/lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins/lib/laypage/1.2/laypage.js')}}"></script>







<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
		]
	});
	
});




/*分类-增加*/
function category_add(){
	//layer_show实现一个弹窗效果
	//第一个参数：标题
	//第二个参数：路由，通过路由指定加载的页面
	//第三个参数：窗口的宽度
	//第四个参数；窗口的高度
	layer_show('添加分类','{{url("admin/category/add")}}',1000);
}


/*分类删除*/
function user_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
            $.ajax({
                type:'post',
                url:"{{url('yb-admin/userdel')}}",
                data:{'id':id,'_token':'{{csrf_token()}}'},
                dataType:'json',
                success:function(msg){
                    if(msg.info==1){
                        window.location.href = window.location.href;
                        layer_close();
                    }else{
                        layer.msg('添加失败',{icon:5,time:3000});
                    }
                }
            });	
	});

}






/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>
</body>
</html>
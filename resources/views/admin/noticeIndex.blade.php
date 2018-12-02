<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>失物招领</title>
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" href="{{asset('css')}}/bootstrap.min.css"> 
<link rel="stylesheet" href="{{asset('css')}}/lost-found-index.css">  


<script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/lost-found-index.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('lib/layer/2.4/layer.js')}}"></script>
<style>
    body{background: #fff;}
</style>
</head>

<body>

	
<div class="nav col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
	<div class="search"> 
                <form action="{{url('yb-admin/search')}}" method="post">{{csrf_field()}}
                <input type="text" placeholder="输入物品信息快速搜索" name="keyword"/>
		<button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </form>
    </div><!--end search-->
	<div class="nav-wrap col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
		<ul class="top-navgation1 col-md-6 col-sm-12 col-xs-12 pull-right">
                    <a href="{{url('yb-admin/typeIndex')}}/寻物启事"><li style="width: 50%;">寻物启事({{$countLost}})</li></a>
                    <a href="{{url('yb-admin/typeIndex')}}/招领启事"><li style="width: 50%;">招领启事({{$countFound}})</li></a>
		</ul>
        </div><!--end wrap-->    
        <div class="top-navgation2 dropdown" style="float:right;">
	<button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">
		导航<span class="caret"></span>
	</button>
            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('admin/typeIndex')}}/寻物启事">寻物</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('admin/typeIndex')}}/招领启事">招领</a>
		</li>
	</ul>
        </div>
    
</div><!--end nav-->




<div class="list col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th>发布者</th>
				<th>启事类型</th>
				<th>标题</th>
				<th>物品类别</th>
                                <th>丢失/捡拾日期</th>
                                <th>丢失/捡拾地点</th>
                                <th width="150">详情描述</th>
				<th>图片</th>
				<th>联系人</th>
				<th>联系电话</th>
                                <th>QQ号码</th>
                                <th>发布时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $v)
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$v->id}}</td>
				<td>{{$v->user->username}}</td>
				<td>{{$v->type}}</td>
                                <td>{{$v->title}}</td>
                                <td>{{$v->sort}}</td>
                                <td>{{$v->time}}</td>
                                <td>{{$v->address}}</td>
                                <td style="width:100px;height:24px;overflow:hidden;text-overflow:ellipsis;">{{$v->description}}</td>
				<td><img style="width: 100px;" src="{{asset($v->picture)}}"/></td>
                                <td>{{$v->linkman}}</td>
                                <td>{{$v->phone}}</td>
                                <td>{{$v->qq}}</td>
				<td>{{$v->date}}</td>
				<td class="td-manage">
                                    <a title="停用" style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" ><i class="Hui-iconfont">&#xe631;</i></a> <br>
                                    <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','admin-add.html','1','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a><br>
                                    <a title="删除" href="javascript:;" onclick="notice_del(this,{{$v->id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                                </td>
			</tr>
		@endforeach	
		</tbody>
	</table>
<script>
function notice_del(obj,id){
    layer.confirm("确认要删除吗？",function(index){
        //ajax请求
       $.ajax({
       type: 'post',
       url: '{{url("yb-admin/delete")}}',
       data: {'id':id,'_token':'{{csrf_token()}}'},
       dataType: 'json',
       success:function(msg){
           if(msg.info==1){
               $(obj).parents("tr").remove(); //删除当前行
               layer.msg("删除成功！");
           }else{
               layer.msg('删除失败');
           }
       },
       error:function(data){
         console.log(data.msg);  
       },
        });
    });
}
</script>
</body>
</html>

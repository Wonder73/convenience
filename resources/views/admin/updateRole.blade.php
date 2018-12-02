<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admins')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/webuploader/0.1.5/webuploader.css" />

<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admins')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加分类 - 分类管理 </title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add"> {{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$role->role_name}}" autocomplete="off" id="role_name" name="role_name">
		</div>
                
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	//完成上传的；
	var uploader = WebUploader.create({
		//选择上传的文件后，要立即上传；
		auto: true,
		//加载一个插件文件；
		swf: '{{asset("admins")}}/lib/webuploader/0.1.5/Uploader.swf',
	
		// 指定一个路由，该路由对应的方法，用于完成文件的上传
		server: '{{url("admin/goods/upimage")}}',
	
		// 选择文件的按钮。可选。
		// 把 id= filePicker的dom元素制作成上传按钮；
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		},
		//添加一个令牌
		formData:{
			"_token":'{{csrf_token()}}'
		}
	});
	// 监听上传成功事件
	uploader.on( 'uploadSuccess', function( file,data ) {
		//data 是一个json格式，表示上传成功后，返回的数据
		var info = data.info;
		 var imgs = "<img style='width:100px;margin-bottom:10px;' src='{{asset('')}}"+info+"'/>";
		$("#fileList").html(imgs);
		$("#goods_thumb").val(info);
		$("#a .sr-only").hide();
		layer.msg('上传完成');
	});

	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		
		$("#a .sr-only").css( 'width', percentage * 100 + '%' );
	});

	
	//选中表单，添加submit事件；
	$("#form-admin-add").submit(function(event){
		//阻止表单的默认提交
		event.preventDefault()
		//获取表单里面的数据
		var data = $(this).serialize();
		//ajax提交数据
		$.ajax({
			type:'post',
			url:'{{url("yb-admin/updateRole")}}/{{$role->id}}',
			data:data,
			dataType:'json',
			success:function(msg){
				//msg是返回的json格式数据；
				if(msg.info==1){
					//认为入库成功
					layer.alert('修改成功',function(){
						//刷新列表页面(父窗口的)
						parent.window.location.href  = parent.window.location.href;
						//关闭弹窗框
						layer_close();
					});
				}else {
					//入库失败
					layer.msg('修改失败:'+msg.error,{icon:5,time:3000});
				}

			}
		});

	});
});
</script> 

</body>
</html>
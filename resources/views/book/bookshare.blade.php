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
<title>我要共享</title>
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-admin-add" > {{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>共享品名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="book_name" name="book_name">
		</div>
                
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>s所属分类：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="book_cate" size="1">
                                @foreach($data as $v)
                                    <option value="{{$v->id}}">{{$v->book_cate}}</option>
                                @endforeach
			</select>
			</span> </div>
	</div>
        <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>资源所在：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="book_owner" name="book_owner">
		</div>
                
	</div>
        <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>联系方式：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="contact_info" name="contact_info">
		</div>
                
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>缩略图：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div class="uploader-thum-container">
                            <input type="text" class="input-text" value="" placeholder="" id="book_pic" name="book_pic">
					<div id="fileList" class="uploader-list"></div>
                                        <div id="a">
                                            <div class="b" style="width: 700px">
                                                <div class="sr-only" style="width: 0%"></div>
                                            </div>
                                        </div>
					<div id="filePicker">选择图片</div>
                           </div>             
		</div>
	</div>
        <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>共享品描述：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="book_desc" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
                
	</div>
        <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否可借：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
                            <input name="is_lend" type="radio" id="sex-1" checked value="1">
				是
			</div>
			<div class="radio-box">
                            <input type="radio" id="sex-2" name="is_hot" value="0">
				不是
			</div>
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
   var uploader = WebUploader.create({
              //立即上传
		auto: true,
		swf: "{{asset('admins')}}/lib/webuploader/0.1.5/Uploader.swf",
	
		// 文件接收服务端路由
		server: "{{url('home/upimage')}}",
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		},
                formData:{
                    '_token':'{{csrf_token()}}'
                }
	});
        
      uploader.on('uploadSuccess',function(file,data){
          //data是json
          var info = data.info;
          console.log(info);
          var imgs = "<img style='width:100px;margin-bottom:10px;' src='{{asset('')}}"+info+"'/>";
          $('#fileList').html(imgs);
          $('#book_pic').val(info);
          $('#a .sr-only').hide();
          layer.msg('OK');
      });  
      
      // 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
	$('#a .sr-only').css('width',percentage*100+'%');
	});
      
   $('#form-admin-add').submit(function(event){
       //阻止表单的默认提交
        event.preventDefault();
       //获取表单数据
       var data  = $(this).serialize();
       //ajax提交
       $.ajax({
       type: 'post',
       url: '{{url("home/bookshare")}}',
       data: data,
       dataType: 'json',
       success:function(msg){
           //msg服务器返回json格式数据
           if(msg.info == 1){
               //插入成功
               parent.window.location.href = parent.window.location.href;
               layer_close();
           }
           else{
               //插入失败
               layer.msg('添加失败'+msg.error,{icon:5,time:3000});
           }
       }
       
       });
   });      
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
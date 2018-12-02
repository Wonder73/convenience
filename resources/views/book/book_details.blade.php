<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="{{asset('css/book/book_details.css')}}" />
<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>书籍详情</title>
</head>
<body>
<div class="container">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <b>Hi~欢迎使用优便校园</b> </div>
      <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
              <li> <a href="{{url('home')}}">个人中心</a> </li>
              <li> <a href="{{url('home/mybook')}}">我的共享</a> </li>
              <li> <a href="#">消息</a> </li>
          <li> <a href="{{url('')}}">首页</a> </li>
          <li class="dropdown">
            <ul class="dropdown-menu">
              <li> <a href="{{url('home')}}">个人中心</a> </li>
              <li class="divider"></li>
              <li> <a href="{{url('home/mybook')}}">我的共享</a> </li>
              <li class="divider"></li>
              <li> <a href="#">消息</a> </li>
              <li> <a href="{{url('')}}">首页</a> </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="row" >
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
      <div class="main-menu-box"></div>
    </div>
  </div>
  <div class="row" >
    <div class="middle">
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
        <div class="middle-left"> <img src="{{asset($data->book_pic)}}" class="img-responsive" alt="book.jpg"> </div>
      </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
        <div class="middle-right">
          <div class="details">
            <p>名称:<span></span><b>{{$data->book_name}}</b></p>
            <br />
            <p>简介:<span></span><b>{{$data->book_desc}}</b></p>
            <p>状态:<span></span><b>@if($data->is_lend==1) 可借 @else 不可借 @endif</b></p>
            <p>共享者:<span></span><b>{{$data->book_owner}}</b></p>
            <p>联系方式:<span></span><b>{{$data->contact_info}}</b></p>
          </div>
          <div class="middle_btn">
            <a href="javascript:;" onclick="lend(this,{{$data->id}})"><button>我要借阅</button></a>
            <button><b>我要预约</b></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="footer">
    <div class="top-box">
      <div class="top">
        <ul class="clearfix">
          <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
          <li>
            <div class="clearfix">
              <h5><img src="{{asset('image/book/footer_top_img1.png')}}" alt="footer_top_img1.png"/></h5>
              <p>100%正品共享 </p>
            </div>
          </li>
          </div>
          <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
          <li>
            <div class="clearfix">
              <h5><img src="{{asset('image/book/footer_top_img2.png')}}" alt="footer_top_img2.png"/></h5>
              <p>便捷交换</p>
            </div>
          </li>
          </div>
          <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
          <li>
            <div class="clearfix">
              <h5><img src="{{asset('image/book/footer_top_img3.png')}}" alt="footer_top_img3.png"/></h5>
              <p>资源繁多</p>
            </div>
          </li>
          </div>
          <div class="col-lg-3 col-md-3 col-xs-6 col-sm-6">
          <li>
            <div class="clearfix">
              <h5><img src="{{asset('image/book/footer_top_img4.png')}}" alt="footer_top_img4.png"/></h5>
              <p>真心服务</p>
            </div>
          </li>
          </div>
        </ul>
      </div>
    </div>
  </div>
  </div>
</div>
</body>
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
  function lend(obj,id){
        //ajax请求
       $.ajax({
       type: 'post',
       url: '{{url("home/lend")}}',
       data: {'id':id,'_token':'{{csrf_token()}}'},
       dataType: 'json',
       success:function(msg){
           if(msg.info==1){
               layer.msg("借阅成功！");
               window.location.href=window.location.href;
           }else{
               layer.msg('借阅失败,此书以被借/预约');
           }
       },
       error:function(data){
         console.log(data.msg);  
       },
        });
}
</script>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>我的共享</title>
	<link rel="stylesheet" href="{{asset('css/book/mybook.css')}}" />
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

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

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
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
              <li> <a href="#">我的共享</a> </li>
              <li> <a href="#">消息</a> </li>
          <li> <a href="{{url('')}}">首页</a> </li>
          <li class="dropdown">
            <ul class="dropdown-menu">
              <li> <a href="{{url('home')}}">个人中心</a> </li>
              <li class="divider"></li>
              <li> <a href="#">我的共享</a> </li>
              <li class="divider"></li>
              <li> <a href="#">消息</a> </li>
              <li> <a href="{{url('')}}">首页</a> </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="row">
  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<ul id="myTab" class="nav nav-tabs">
	<li class="active"><a href="#home" data-toggle="tab">我的共享</a></li>
	<li><a href="#jieyue" data-toggle="tab">我的借阅</a></li>
	<li><a href="#yuyue" data-toggle="tab">我的预约</a></li>
	<li><a href="#xiaoxi" data-toggle="tab">我的消息</a></li>
</ul>
</div>
</div>

<div id="myTabContent" class="tab-content">
	<div class="tab-pane fade in active" id="home">
		
		<div class="list">
			<div class="gongxiang"><a href="javascript:;" onclick="share()">我要共享</a></div>
            @foreach($info as $v)
            <div class="order-list">
                <ul>
                    <li class="clearfix">
                        <div class="order-img">
                            <a href="#"><img src="{{asset($v->book_pic)}}" alt="book.jpg" /></a>
                        </div>
                        <div class="tips">
                            <h3><a href="#">{{$v->book_desc}}</a></h3> 
                        </div>
                        <div class="bookname">
                            <b>名称：{{$v->book_name}}</b>
                        </div>
                        <div class="actions">
                            <a href="javascript:;" onclick="re_lend(this,{{$v->id}})"><button>重新借出</button></a>
                            <button>删除该书</button>
                        </div>
                    </li>
                </ul>
            </div>
      @endforeach
        </div>
    <div class="row">  
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
    <div class="next-page-bottom">
        <a href="#">上一页</a>
        <a href="#" class="on">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">......</a>
        <a href="#">5</a>
        <a href="#">下一页</a>
        <span>到第</span>
        <input type="text" />
        <span>页</span>
        <button>GO</button>
    </div>
    </div>
    </div>



	</div>
	<div class="tab-pane fade" id="jieyue">
		<div class="list">
      @foreach($info as $v)
            <div class="order-list">
                <ul>
                    <li class="clearfix">
                        <div class="order-img">
                            <a href="#"><img src="{{asset($v->book_pic)}}" alt="book.jpg" /></a>
                        </div>
                        <div class="tips">
                            <h3><a href="#">{{$v->book_desc}}</a></h3> 
                        </div>
                        <div class="bookname">
                            <b>名称：{{$v->book_name}}</b>
                        </div>
                        <div class="actions">
                            <a href="javascript:;" onclick="re_lend(this,{{$v->id}})"><button>看完借出</button></a>
                            <button>看完归还</button>
                        </div>
                    </li>
                </ul>
            </div>
      @endforeach
        </div>
        <div class="row">  
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
    <div class="next-page-bottom">
        <a href="#">上一页</a>
        <a href="#" class="on">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">......</a>
        <a href="#">5</a>
        <a href="#">下一页</a>
        <span>到第</span>
        <input type="text" />
        <span>页</span>
        <button>GO</button>
    </div>
    </div>
    </div>
	</div>
	<div class="tab-pane fade" id="yuyue">
		<div class="list">
            <div class="order-list">
                <ul>
                    <li class="clearfix">
                        <div class="order-img">
                            <a href="product_details.html"><img src="{{asset('image/book/book.jpg')}}" alt="book.jpg" /></a>
                        </div>
                        <div class="tips">
                            <h3><a href="#">百年孤独百年孤独百年孤独百年孤独百年孤独百年孤独百年孤独</a></h3> 
                        </div>
                        <div class="bookname">
                            <b>名称：百年孤独</b>
                        </div>
                        <div class="actions">
                            <button>查看详情</button>
                            <button>停止预约</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">  
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
    <div class="next-page-bottom">
        <a href="#">上一页</a>
        <a href="#" class="on">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">......</a>
        <a href="#">5</a>
        <a href="#">下一页</a>
        <span>到第</span>
        <input type="text" />
        <span>页</span>
        <button>GO</button>
    </div>
    </div>
    </div>
	</div>
	<div class="tab-pane fade" id="xiaoxi">
		<div class="list">
			暂时没有消息
		</div>
		<div class="row">  
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
    <div class="next-page-bottom">
        <a href="#">上一页</a>
        <a href="#" class="on">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">......</a>
        <a href="#">5</a>
        <a href="#">下一页</a>
        <span>到第</span>
        <input type="text" />
        <span>页</span>
        <button>GO</button>
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
<script type="text/javascript">
  function share(){
  //layer_show实现一个弹窗效果
  //第一个参数：标题
  //第二个参数：路由，通过路由指定加载的页面
  //第三个参数：窗口的宽度
  //第四个参数；窗口的高度
  layer_show('我要共享','{{url("home/bookshare")}}',1000);
}

</script>
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
  function re_lend(obj,id){
        //ajax请求
       $.ajax({
       type: 'post',
       url: '{{url("home/re_lend")}}',
       data: {'id':id,'_token':'{{csrf_token()}}'},
       dataType: 'json',
       success:function(msg){
           if(msg.info==1){
               layer.msg("共享成功！");
               window.location.href=window.location.href;
           }else{
               layer.msg('共享失败');
           }
       },
       error:function(data){
         console.log(data.msg);  
       },
        });
}
</script>
</html>
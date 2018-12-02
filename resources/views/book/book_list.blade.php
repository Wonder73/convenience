<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="{{asset('css/book/book_list.css')}}" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <title>书籍共享</title>
</head>
<body>
<div class="container">
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <b>Hi~欢迎使用优便校园</b> </div>
      <div class="collapse navbar-collapse" id="example-navbar-collapse"> {{csrf_field()}}
        <ul class="nav navbar-nav navbar-right">
              <li> <a href="{{url('home')}}">个人中心</a> </li>
              <li> <a href="{{url('home/mybook')}}">我的共享</a> </li>
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
<div class="logo clearfix">
   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <img src="{{asset('image/book/booklogo.png')}}" alt="logo.png" class="img-responsive"/>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="search-box">
        <form action="">
            <div class="search">
                
                <input type="text" value="" />
                <button>搜索</button>
            </div>
        </form>
        <div class="search-key">
            <ul>
                <li><a href="#">专业教科书</a></li>
                <li><a href="#" class="on">公共教科书</a></li>
                <li><a href="#">考证资料</a></li>
                <li><a href="#">课外小说</a></li>
                <li><a href="#" class="on">哲学</a></li>
                <li><a href="#">历史/文化</a></li>
                <li><a href="#">其他</a></li>
            </ul>
        </div>
    </div>
    </div>
</div>
</div>
<div class="middle">
    <div class="filter-type-box clearfix">
        <div class="filter-type"><b class="on">综合排序</b><b>最新</b><b>最热</b><b>评论数</b></div>
    </div>
        <div class="books_list">
          <div class="row">
            @foreach($data as $v)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="book">
                <a href = "{{url('home/bookinfo?id='.$v->id)}}" >
                    <div class="book_img"> <img src="{{asset($v->book_pic)}}" class="img-responsive">
                      <div class="show">
                        <h3 class="title">{{$v->book_name}}</h3>
                         </div>
                    </div>
                </a>
              </div>
            </div>
            @endforeach
            
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
</html>
@include('client\login')
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse"> <span class="sr-only">切换导航</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <b>Hi~欢迎使用优便校园</b> </div>
      <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li id="login_reg_btn"> <a href="#">登录/注册</a> </li>
          <li> <a href="{{url('home')}}">个人中心</a> </li>
          <li id="logout"> <a href="#">退出</a> </li>
          <li class="dropdown">
            <ul class="dropdown-menu">
              <li id="login_reg_btn"> <a href="#">登录/注册</a> </li>
              <li class="divider"></li>
              <li> <a href="{{url('home')}}">个人中心</a> </li>
              <li class="divider"></li>
              <li id="logout"> <a href="#">退出</a> </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
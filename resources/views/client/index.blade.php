<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>首页</title>

@include('client\common')

</head>
<body>
  @include('client\header')
  <link href="{{asset('lib/element-ui/lib/theme-chalk/index.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/index.css')}}" />
  <script src="{{asset('lib/element-ui/lib/index.js')}}"></script>
  <script src="{{asset('js/index.js')}}"></script>

<div class="container">
  <div class="logo clearfix">
    <h1>优便校园</h1>
    <p>优便校园，优便你我他</p>
  </div>
  <div id="myCarousel" class="carousel slide" v-if="checkUser"> 
    
    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
      <div class="item active">
        <ul>
          <li v-for="(dataSource, index) of dataSources" :key="index">
            <img :src="dataSource.app_logo" class="img-responsive">
            <p class="item__title" :title="dataSource.app_name"><a :href="dataSource.app_address" target="_brack">${dataSource.app_name}</a></p>
          </li>
          <li v-if="checkUser" @click="handleShowAddApp">
            <img src="image/more.png" class="img-responsive">
          </li>
        </ul>
      </div>
    </div>
    <!-- 轮播（Carousel）导航 --> 
    <a class="carousel-control right" href="#myCarousel" 
    data-slide="prev"> <span _ngcontent-c3="" aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span></a> <a class="carousel-control left" href="#myCarousel" 
    data-slide="next"><span _ngcontent-c3="" aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span></a> 
  </div>
  <div class="userLogin" v-else>
    <button class="userLogin_button" @click="showLogin">用户登录</button>
  </div>
  <transition name="fade">
    <div id="add-app" v-if="showAddApp">
      <h1>添加应用</h1>
      <div class="add-app__search">
        <button type="button" :class="{active: addAppSearchShow}" @click="query">搜索</button>
        <input type="text" name="search" placeholder="输入搜索内容" autocomplete="off" v-model="app.searchValue" @keyup.enter="query" @focus="addAppSearchShow = true" @blur="addAppSearchShow = false"/>
      </div>

      <ul class="add-app__content" @scroll="handleScroll">
        <li v-for="(dataSource, index) of allAppDataSources" :key="index">
          <div class="add-app__content--img">
            <img :src="dataSource.app_logo" />
          </div>
          <div class="add-app__content--info">
            <p>${dataSource.app_name}</p>
            <p>${dataSource.app_description}</p>
          </div>
          <div class="add-app__content--button">
            <button v-if="userInfo.user_app.indexOf(dataSource.id) < 0" @click="addApp(dataSource.id)">添加应用</button>
            <button class="active" v-else @click="deleteApp(dataSource.id)">已添加</button>
          </div>
        </li>
      </ul>

      <div class="close add-app__close"  @click="showAddApp = false"><i class="fa fa-close"></i></div>
    </div>
  </transition>

  <transition name="fade">
    <div class="app_shadow"  v-if="showAddApp"></div>
  </transition>
</div>
</body>
</html>
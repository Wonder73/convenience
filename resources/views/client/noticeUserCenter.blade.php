<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link  href="{{asset('css')}}/lost-found-index.css" rel="stylesheet" type="text/css">  
        <link  href="{{asset('css')}}/noticeUserCenter.css" rel="stylesheet" type="text/css">  


<script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/lost-found-index.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.cookie.js')}}"></script>
<script src="{{asset('lib/layer/2.4/layer.js')}}"></script>
<script src="{{asset('js')}}/center.js"></script>
<script src="{{asset('js')}}/notice.js"></script>
<script src="{{asset('lib/common.js')}}"></script>
<script type="text/javascript">
          let common = new Common();
          common.token = '{{csrf_token()}}';  //获取token;
</script>
    </head>
    <body>
<div class="top col-md-12 col-sm-12 col-xs-12">
	<a href="#" style="float: left;">有一种难过，叫做丢了东西。有一种喜悦，叫做失而复得。</a>
	<a href="#" style="float: right">前往首页</a>
</div>
	
<div class="nav col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
	<div class="search"> 
                <form action="{{url('home/search')}}" method="post">{{csrf_field()}}
                <input type="text" placeholder="输入物品信心快速搜索" name="keyword"/>
		<button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </form>
    </div><!--end search-->
	<div class="nav-wrap col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
		<ul class="top-navgation1 col-md-6 col-sm-12 col-xs-12 pull-right">
			<a href="{{url('home/noticeIndex')}}"><li>首页</li></a>
                        <a href="{{url('home/typeIndex')}}/寻物启事"><li>寻物</li></a>
			<a href="{{url('home/typeIndex')}}/招领启事"><li>招领</li></a>
                        <a href="{{url('home/noticeUserCenter')}}"><li>个人中心</li></a>
                        <li><a  data-toggle="modal" data-target="#myModal" class="publish" style="color:#fff;">发布+</a></li>
		</ul>
        </div><!--end wrap-->    
        <div class="top-navgation2 dropdown" style="float:right;">
	<button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">
		导航<span class="caret"></span>
	</button>
            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('home/noticeIndex')}}">首页</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('home/typeIndex')}}/寻物启事">寻物</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('home/typeIndex')}}/招领启事">招领</a>
		</li>
		<li role="presentation">
			<a role="menuitem" tabindex="-1" href="{{url('home/noticeUserCenter')}}" id="index_user_id1">个人中心</a>
		</li>
                <li role="presentation">
                    <a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#myModal" class="publish" style="color:#fff;">发布+</a>
		</li>
	</ul>
        </div>
    
</div><!--end nav-->

<div class="center-nav col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
    <ul id="myTab" style="float:left;" class="col-md-2 col-sm-4 col-xs-12">
	<li class="active col-md-12 col-sm-12 col-xs-4"><a href="#lost" data-toggle="tab">我的寻物</a></li>
        <li class="col-md-12 col-sm-12 col-xs-4"><a href="#found" data-toggle="tab">我的招领</a></li>
	<li class="col-md-12 col-sm-12 col-xs-4"><a href="#comment" data-toggle="tab">我的评论</a></li>
</ul>
    
<div id="myTabContent" class="center-wrap tab-content col-md-10 col-sm-8 col-xs-12">
    <div class="showlost tab-pane fade in active" id="lost">
        <div class="list col-md-12 col-sm-12 col-xs-12" style="padding:0;" id="lost-list">
            
        </div><!--end list-->
    </div>
    
    <div class="tab-pane fade" id="found">
        <div class="list col-md-12 col-sm-12 col-xs-12" style="padding:0;" id="found-list">
        </div><!--end list-->
    </div>

    <div class="tab-pane fade" id="comment">
        <div class="list col-md-12 col-sm-12 col-xs-12" style="padding:0;" id="comment-list">
        </div><!--end list-->
    </div>
</div>
</div>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="border: 0;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<div class="modal_title col-md-12 col-sm-12 col-xs-12">
					<div class="lost col-md-6 col-sm-6 col-xs-6" onClick="show(1)" id="title1">
						寻物启事
					</div>
					<div class="found col-md-6 col-sm-6 col-xs-6" onClick="show(2)" id="title2">
						招领启事
					</div>
				</div><!--end modal_title-->
			</div>
		    <!--寻物启事-->
                    <form action="{{url('home/addlost')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
			<div id="show1">
			<div class="modal-body lost-info">                          
				<table class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="hidden" name="user_id" value="888" id="lost1"/>
                                    <input type="hidden" name="type" value="寻物启事"/>
					<tr>
                                            <td>信息标题</td><td><input type="text" name="title" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
						<td>失物类别</td>
						<td>
							<select name="sort">
								<option>请选择</option>
                                                                <option value="钱包">钱包</option>
								<option value="钥匙">钥匙</option>
								<option value="宠物">宠物</option>
								<option value="卡类/证照">卡类/证照</option>
								<option value="数码产品">数码产品</option>
								<option value="手袋/挎包">手袋/挎包</option>
								<option value="衣服/鞋帽">衣服/鞋帽</option>
								<option value="首饰/挂饰">首饰/挂饰</option>
								<option value="行李/包裹">行李/包裹</option>
								<option value="书籍/文件">书籍/文件</option>
								<option value="其他">其他</option>
							</select>
						</td>
					</tr>
					<tr>
                                            <td>丢失日期</td><td><input type="date" name="time" value="{{$now}}" required="required"/></td>
					</tr>
					<tr>
                                            <td>丢失地点</td><td><input type="text" name="address" placeholder="  必填" required="required"/> 如：火车站、XX路公交车</td>
					</tr>
					<tr>
                                            <td>详情描述</td><td><textarea name="description" required="required" class="col-md-12 col-sm-12 col-xs-12" placeholder="请输入丢失物品的详细描述信息以及物品的丢失过程！实践证明，信息描述越详细找回的几率更大。描述信息长度50~1000个汉字，建议不少于150个汉字。"></textarea></td>
					</tr>
                                        <tr>
                                            <td>物品图片</td><td><input type="file" name="picture"/></td>
					</tr>
					<tr>
                                            <td>联系人</td><td><input type="text" name="linkman" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
                                            <td>联系电话</td><td><input type="text" name="phone" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
                                            <td>联系QQ</td><td><input type="text" name="qq" placeholder="  可空"/></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer" style="border: 0;">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
                            <button type="submit" class="btn btn-primary">
					确认并发布信息
				</button>
			</div>
			</div><!--end lost-id-->
                        </form>
                    
                    <!--招领启事-->    
                    <form action="{{url('home/addlost')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
			<div id="show2">
			<div class="modal-body lost-info">
				<table class="col-md-12 col-sm-12 col-xs-12">
                                    <input type="hidden" name="user_id" value="8" id="found1"/>
                                    <input type="hidden" name="type" value="招领启事"/>
					<tr>
                                            <td>信息标题</td><td><input type="text" name="title" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
						<td>物品种类</td>
						<td>
							<select name="sort">
								<option>请选择</option>
                                                                <option value="钱包">钱包</option>
								<option value="钥匙">钥匙</option>
								<option value="宠物">宠物</option>
								<option value="卡类/证照">卡类/证照</option>
								<option value="数码产品">数码产品</option>
								<option value="手袋/挎包">手袋/挎包</option>
								<option value="衣服/鞋帽">衣服/鞋帽</option>
								<option value="首饰/挂饰">首饰/挂饰</option>
								<option value="行李/包裹">行李/包裹</option>
								<option value="书籍/文件">书籍/文件</option>
								<option value="其他">其他</option>
							</select>
						</td>
					</tr>
					<tr>
                                            <td>捡拾日期</td><td><input type="date" name="time" required="required" value="{{$now}}"/></td>
					</tr>
					<tr>
                                            <td>捡拾地点</td><td><input type="text" name="address" placeholder="  必填" required="required"/> 如：火车站、XX路公交车</td>
					</tr>					
					<tr>
                                            <td>联系人</td><td><input type="text" name="linkman" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
                                            <td>联系电话</td><td><input type="text" name="phone" placeholder="  必填" required="required"/></td>
					</tr>
					<tr>
                                            <td>联系QQ</td><td><input type="text" name="qq" placeholder="  可空"/></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer" style="border: 0;">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
                            <button type="submit" class="btn btn-primary">
					确认并发布信息
				</button>
			</div>
			</div><!--end found-id-->
                        </form>
                        
                        
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div><!-- 模态框（Modal） -->
</body>
</html>

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
	<link rel="stylesheet" href="{{asset('css')}}/bootstrap.min.css">
	<link rel="stylesheet" href="{{asset('css')}}/lost-found-index.css">
	<script src="{{asset('js')}}/jquery.min.js"></script>
	<script src="{{asset('js')}}/jquery-1.11.1.min.js"></script>
	<script src="{{asset('js')}}/bootstrap.min.js"></script>
	<script src="{{asset('js')}}/lost-found-index.js"></script>
	<script src="{{asset('lib/layer/2.4/layer.js')}}"></script>
	<script src="{{asset('js')}}/notice.js"></script>
	<script src="{{asset('js/jquery.cookie.js')}}"></script>
	<script src="{{asset('lib/common.js')}}"></script>
	<script type="text/javascript">
		let common = new Common();
		common.token = '{{csrf_token()}}'; //获取token;
	</script>
</head>

<body>
	<div class="top col-md-12 col-sm-12 col-xs-12">
		<a href="#" style="float: left;">有一种难过，叫做丢了东西。有一种喜悦，叫做失而复得。</a>
		<a href="{{url('/')}}" style="float: right">前往首页</a>
	</div>

	<div class="nav col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
		<div class="search">
			<form action="{{url('home/search')}}" method="post">{{csrf_field()}}
				<input type="text" placeholder="输入物品信心快速搜索" name="keyword" />
				<button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			</form>
		</div>
		<!--end search-->
		<div class="nav-wrap col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
			<ul class="top-navgation1 col-md-6 col-sm-12 col-xs-12 pull-right">
				<a href="{{url('home/noticeIndex')}}">
					<li>首页</li>
				</a>
				<a href="{{url('home/typeIndex')}}/寻物启事">
					<li>寻物</li>
				</a>
				<a href="{{url('home/typeIndex')}}/招领启事">
					<li>招领</li>
				</a>
				<a href="{{url('home/noticeUserCenter')}}">
					<li>个人中心</li>
				</a>
				<li><a data-toggle="modal" data-target="#myModal" class="publish" style="color:#fff;">发布+</a></li>
			</ul>
		</div>
		<!--end wrap-->
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

	</div>
	<!--end nav-->


	<div id="detail" class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
		<div class="detail-wrap col-md-12 col-sm-12 col-xs-12">
			@foreach($data as $v)
			<h1>{{$v->title}}</h1>
			<span>{{$v->date}} 发布,当前状态：@if($v->type=='寻物启事')寻找中…… @elseif($v->type=='招领启事')招领中……@endif</span>

			<table>
				<tr>
					<td class="attribute">物品种类：</td>
					<td>{{$v->sort}}</td>
				</tr>
				<tr>
					<td class="attribute col-md-3 col-sm-3 col-xs-6">图片：</td>
					<td>
						@if($v->picture=='')
						<div class="col-md-12 col-sm-12 col-xs-12" style="background: #ccc;height: 100px;font-size: 24px;color: #fff;line-height: 100px;text-align: center;">暂无图片</div>
						@else
						<img src="{{asset('')}}{{$v->picture}}" class="img-responsive" style="width: 250px;height: 200px;" />
						@endif

					</td>
				</tr>
				<tr>
					<td class="attribute">详情:</td>
					<td class="article">{{$v->description}}</td>
				</tr>
				<tr>
					<td class="attribute">丢失地点：</td>
					<td>{{$v->address}}</td>
				</tr>
				<tr>
					<td class="attribute">丢失日期：</td>
					<td>{{$v->time}}</td>
				</tr>
				<tr>
					<td class="attribute">联系人：</td>
					<td>{{$v->linkman}}</td>
				</tr>
				<tr>
					<td class="attribute">手机：</td>
					<td>{{$v->phone}}</td>
				</tr>
				<tr>
					<td class="attribute">QQ：</td>
					<td>{{$v->qq}}</td>
				</tr>
			</table>
			<span><b>诚信，从你我做起！</b>本站不欢迎利用本站发布的信息来诱骗失主，请给自己留一点自尊，也请给这个社会多一份爱心。</span>

		</div>
	</div>
	<!--end detail-id-->
	<div class="comment col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="margin-top: 15px;">
		<div class="comment-wrap" style="background: #fff;">
			<form method="post" id="comment">{{csrf_field()}}
				<input type="hidden" name="user_id" value="1" />
				<input type="hidden" name="item_id" value="{{$v->id}}" />
				<input type="text" name="comment" autocomplete="off" class="col-md-12 col-sm-12 col-xs-12" placeholder="请文明留言!不得违反国家法律法规"
				 style="margin-top: 15px;height: 150px;" />
				<button type="submit" class="btn btn-info right-align" style="float: right;margin-bottom: 0;">发表留言</button>
			</form>
		</div>
		<!--end comment-wrap-->
		@endforeach
		<div class="comment-list col-md-12 col-sm-12 col-xs-12" style="text-align: center;margin-top: 15px;background: #fff;">
			<div class="comment-info col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;padding-bottom: 15px;">


				@foreach($comment as $v)
				<table class="col-md-12 col-sm-12 col-xs-12" style="background: #f0ecec;text-align: left; margin-top: 15px;">
					<tr>
						<td>留言者：{{$v->user['username']}}</td>
						<td style="text-align: right;">邮箱：{{$v->user['email']}}</td>
					</tr>
					<tr>
						<td colspan="2">留言内容：</td>
					</tr>
					<tr>
						<td colspan="2">{{$v->comment}}</td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align: right;">留言时间：{{$v->date}}</td>
					</tr>
				</table>
				@endforeach


			</div>
		</div>
		<!--end comment-list-->

	</div>
	<!--end comment-->





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
					</div>
					<!--end modal_title-->
				</div>
				<!--寻物启事-->
				<form action="{{url('home/addlost')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
					<div id="show1">
						<div class="modal-body lost-info">
							<table class="col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" name="user_id" value="888" id="lost1" />
								<input type="hidden" name="type" value="寻物启事" />
								<tr>
									<td>信息标题</td>
									<td><input type="text" name="title" placeholder="  必填" required="required" /></td>
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
									<td>丢失日期</td>
									<td><input type="date" name="time" value="{{$now}}" required="required" /></td>
								</tr>
								<tr>
									<td>丢失地点</td>
									<td><input type="text" name="address" placeholder="  必填" required="required" /> 如：火车站、XX路公交车</td>
								</tr>
								<tr>
									<td>详情描述</td>
									<td><textarea name="description" required="required" class="col-md-12 col-sm-12 col-xs-12" placeholder="请输入丢失物品的详细描述信息以及物品的丢失过程！实践证明，信息描述越详细找回的几率更大。描述信息长度50~1000个汉字，建议不少于150个汉字。"></textarea></td>
								</tr>
								<tr>
									<td>物品图片</td>
									<td><input type="file" name="picture" /></td>
								</tr>
								<tr>
									<td>联系人</td>
									<td><input type="text" name="linkman" placeholder="  必填" required="required" /></td>
								</tr>
								<tr>
									<td>联系电话</td>
									<td><input type="text" name="phone" placeholder="  必填" required="required" /></td>
								</tr>
								<tr>
									<td>联系QQ</td>
									<td><input type="text" name="qq" placeholder="  可空" /></td>
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
					</div>
					<!--end lost-id-->
				</form>

				<!--招领启事-->
				<form action="{{url('home/addlost')}}" method="post" enctype="multipart/form-data">{{csrf_field()}}
					<div id="show2">
						<div class="modal-body lost-info">
							<table class="col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" name="user_id" value="8" id="found1" />
								<input type="hidden" name="type" value="招领启事" />
								<tr>
									<td>信息标题</td>
									<td><input type="text" name="title" placeholder="  必填" required="required" /></td>
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
									<td>捡拾日期</td>
									<td><input type="date" name="time" required="required" value="{{$now}}" /></td>
								</tr>
								<tr>
									<td>捡拾地点</td>
									<td><input type="text" name="address" placeholder="  必填" required="required" /> 如：火车站、XX路公交车</td>
								</tr>
								<tr>
									<td>联系人</td>
									<td><input type="text" name="linkman" placeholder="  必填" required="required" /></td>
								</tr>
								<tr>
									<td>联系电话</td>
									<td><input type="text" name="phone" placeholder="  必填" required="required" /></td>
								</tr>
								<tr>
									<td>联系QQ</td>
									<td><input type="text" name="qq" placeholder="  可空" /></td>
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
					</div>
					<!--end found-id-->
				</form>


			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div><!-- 模态框（Modal） -->
	<script>
		$(function () {
			$('#comment').submit(function (event) {
				//阻止表单的默认提交
				event.preventDefault();
				//获取表单数据
				var data = $(this).serialize();
				//ajax提交
				$.ajax({
					type: 'post',
					url: '{{url("home/comment")}}',
					data: data,
					dataType: 'json',
					success: function (msg) {
						//msg服务器返回json格式数据
						if (msg.info == 1) {
							//插入成功
							layer.msg('留言成功');
							parent.window.location.href = parent.window.location.href;
							//layer_close();
						} else {
							//插入失败
							layer.msg('留言失败' + msg.error, {
								icon: 5,
								time: 3000
							});
						}
					}

				});
			});
		});
	</script>

</body>

</html>
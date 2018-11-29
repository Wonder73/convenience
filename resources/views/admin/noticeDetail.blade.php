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
</head>

<body>
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
                        <img src="{{asset('')}}{{$v->picture}}" class="img-responsive" style="width: 250px;height: 200px;"/>
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
</div><!--end detail-id-->
<div class="comment col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="margin-top: 15px;">
    <div class="comment-wrap" style="background: #fff;">
        <form method="post" id="comment">{{csrf_field()}}
        <input type="hidden" name="user_id" value="1"/>
        <input type="hidden" name="item_id" value="{{$v->id}}"/>
        <input type="text" name="comment" autocomplete="off"  class="col-md-12 col-sm-12 col-xs-12" placeholder="请文明留言!不得违反国家法律法规" style="margin-top: 15px;height: 150px;"/>
        <button  type="submit" class="btn btn-info right-align" style="float: right;margin-bottom: 0;">发表留言</button>
        </form>
    </div><!--end comment-wrap-->
    @endforeach
    <div class="comment-list col-md-12 col-sm-12 col-xs-12" style="text-align: center;margin-top: 15px;background: #fff;">
            <div class="comment-info col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;padding-bottom: 15px;">     
                

                @foreach($comment as $v)
                <table class="col-md-12 col-sm-12 col-xs-12" style="background: #f0ecec;text-align: left; margin-top: 15px;">
                    <tr><td>留言者：{{$v->user['username']}}</td><td style="text-align: right;">邮箱：{{$v->user['email']}}</td></tr>
                    <tr><td colspan="2">留言内容：</td></tr>
                    <tr><td colspan="2">{{$v->comment}}</td></tr>
                    <tr><td></td><td style="text-align: right;">留言时间：{{$v->date}}</td></tr>
                </table>
                @endforeach

                
            </div>
    </div><!--end comment-list-->
    
</div><!--end comment-->
</body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>用户中心</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
  
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/userCenter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/updateUser.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/userCenter.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/testing.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <style>
            .hid{display: none;}
        </style>
    </head>
    <body>
        <div class="content col-md-12" style="padding: 0;">
                <div class="head col-md-8 col-xs-8" style="margin-top: 15px;margin-bottom: 15px;" >
                    
                    <table>
                        <tr><td rowspan="2">
                                <span class="img_content">
                                <img src="{{asset('image/head.jpeg')}}" class="img-circle img-thumbnail img-responsive"/>
                                <span class="mask" data-toggle="modal" data-target="#myModal">修改头像</span>
                                </span>
                            </td>
                            <td class="userName">用户名</td>
                        </tr> 
                        <tr><td class="userName">aa账号aa</td></tr>
                    </table>
                </div>
                <div class="choose col-md-4 col-xs-4" style="margin-top: 15px;margin-bottom: 15px;" >
                    <div class="right">
                        <div class="right1"><p>关注</p><p>0</p></div>
                        <div class="right2"><p>粉丝</p><p>0</p></div>
                        <div class="right3"><p>发布</p><p>0</p></div>
                        <div class="right4"><p>收藏</p><p>0</p></div>
                    </div>
                </div>
            <div class="programa col-md-12 col-xs-12" style="padding: 0;">
                <ul class="programa col-md-12 col-xs-12" style="padding: 0;">
                    <li class="col-md-4 col-xs-4" onclick="show(1)" id="bg1" onmouseover="back(1)">个人信息</li>
                    <li class="col-md-2 col-xs-2" onclick="show(2)" id="bg2" onmouseover="back(2)">动态</li>
                    <li class="col-md-2 col-xs-2" onclick="show(3)" id="bg3" onmouseover="back(3)">回答</li>
                    <li class="col-md-2 col-xs-2" onclick="show(4)" id="bg4" onmouseover="back(4)">文章</li>
                    <li class="col-md-2 col-xs-2" onclick="show(5)" id="bg5" onmouseover="back(5)">提问</li>
                </ul>
            </div>
            <script type="text/javascript">
                function show(f){
                    for(y=1;y<=5;y++){
                        art = document.getElementById("a"+y);
                        art.style.display="none";
                        bg = document.getElementById("bg"+y);
                        bg.style.background="url('../image/twenty.png')";
                    }
                    i=f;
                    obj = document.getElementById("a"+i);
                    obj.style.display="block";  
                    bg = document.getElementById("bg"+i);
                    bg.style.background="url('../image/fourty.png')"; 
                }
            </script>         
            </div><!--end content-->
            
        <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;" id="a1">
                <table class="table table-striped table-hover">
		<tbody>
			<tr>
				<td>账号</td>
				<td>Anna</td>
			</tr>
			<tr>
				<td>当前专业</td>
				<td>Debbie</td>
			</tr>
			<tr>
				<td>真实姓名</td>
				<td>John</td>
			</tr>
                        <tr>
				<td>性别</td>
				<td>男</td>
			</tr>
                        <tr>
				<td>QQ号码</td>
				<td>553066956</td>
			</tr>
                        <tr>
				<td>出生时间</td>
				<td>1997-07-07</td>
			</tr>
                        <tr>
				<td>联系电话</td>
				<td>183****1349</td>
			</tr>
                        <tr>
				<td>电子邮箱</td>
				<td>553066956@qq.com</td>
			</tr>
                        
		</tbody>
            </table>
            <button type="button" class="btn btn-info col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal">修改个人信息</button>
            </div>
            
            <!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!--<div class="model_content col-md-12  col-xs-12">-->
                        <img src="{{asset('image/head.jpeg')}}" class="img-circle img-thumbnail img-responsive center-block"/>
            <!--<div class="information col-md-9 col-xs-9">-->
      
                <table class="table table-hover information">
		<tbody>
                        <tr>
				<td>更改头像</td>
                                <td><input type="file"/></td>
			</tr>
                        <tr>
				<td>账号</td>
				<td>Anna</td>
			</tr>
                        <tr onmouseover="update(8)" onmouseout="hid(8)">
                            <td class="col-md-4 col-xs-4">用户名</td>
                            <td class=" col-md-8 col-xs-8"><div id="hideinfo8"><span>carman</span> <span id="up8" class="hid"  onclick="hideinfo(8)">&nbsp;&nbsp;修改</span></div>
                                <div id="updateinfo8">
                                <input type="text" class="full"/>
                                <button class="btn btn-primary marginTop" onclick="updateinfo(8)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(8)">取消</button>
                                </div>
                            </td>
			</tr>
			
                        <tr onmouseover="update(1)" onmouseout="hid(1)">
                            <td class="col-md-4 col-xs-4">当前专业</td>
                            <td class=" col-md-8 col-xs-8"><div id="hideinfo1"><span>未知</span> <span id="up1" class="hid"  onclick="hideinfo(1)">&nbsp;&nbsp;修改</span></div>
                                <div id="updateinfo1">
                                <input type="text" class="full"/>
                                <button class="btn btn-primary marginTop" onclick="updateinfo(1)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(1)">取消</button>
                                </div>
                            </td>
			</tr>
                        
			<tr onmouseover="update(2)" onmouseout="hid(2)">
				<td>真实姓名</td>
                                <td><div id="hideinfo2"><span>未知</span><span id="up2" class="hid"  onclick="hideinfo(2)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo2">
                                    <input type="text" class="full"/>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(2)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(2)">取消</button>
                                    </div>
                                </td>
			</tr>
                        
                        <tr onmouseover="update(3)" onmouseout="hid(3)">
				<td>性别</td>
				<td><div id="hideinfo3"><span>未知</span><span id="up3" class="hid"  onclick="hideinfo(3)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo3">
                                        <div class="whole">
                                        <input type="radio" value="男" name="gender"/>男&nbsp;&nbsp;
                                        <input type="radio" value="女" name="gender"/>女
                                        </div>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(3)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(3)">取消</button>
                                    </div>
                                </td>
			</tr>
                        
                        <tr onmouseover="update(4)" onmouseout="hid(4)">
				<td>QQ号码</td>
				<td><div id="hideinfo4"><span>未知</span><span id="up4" class="hid"  onclick="hideinfo(4)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo4">
                                    <input type="text" class="full"/>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(4)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(4)">取消</button>
                                    </div>
                                </td>
			</tr>
                        <tr onmouseover="update(5)" onmouseout="hid(5)">
				<td>出生时间</td>
				<td><div id="hideinfo5"><span>未知</span><span id="up5" class="hid"  onclick="hideinfo(5)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo5">
                                        <input type="date" value="2018-10-01" class="whole" style="color:black;"/>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(5)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(5)">取消</button>
                                    </div>
                                </td>
			</tr>
                        <tr onmouseover="update(6)" onmouseout="hid(6)">
				<td>联系电话</td>
				<td><div id="hideinfo6"><span>未知</span><span id="up6" class="hid"  onclick="hideinfo(6)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo6">
                                    <input type="text" class="full"/>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(6)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(6)">取消</button>
                                    </div>
                                </td>
			</tr>
                        <tr onmouseover="update(7)" onmouseout="hid(7)">
				<td>电子邮箱</td>
                                <td><div id="hideinfo7"><span>未知</span><span id="up7" class="hid"  onclick="hideinfo(7)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo7">
                                    <input type="text" class="full"/>
                                    <button class="btn btn-primary marginTop" onclick="updateinfo(7)">保存</button><button class="btn btn-default marginTop marginLeft" onclick="updateinfo(7)">取消</button>
                                    </div>
                                </td>
			</tr>
                       
		</tbody>
            </table>
            <script type="text/javascript">
                function hideinfo(f){
                    i=f;
                    obj = document.getElementById("hideinfo"+i);
                    obj.style.display="none"; 
                    object = document.getElementById("updateinfo"+i);
                    object.style.display="block"; 
                }
                
                function updateinfo(f){
                    i=f;
                    obj = document.getElementById("hideinfo"+i);
                    obj.style.display="block"; 
                    object = document.getElementById("updateinfo"+i);
                    object.style.display="none"; 
                }
            </script>
                
      
            <!--</div>end infomation-->
            <button type="button" class="btn  btn-default" data-dismiss="modal" style="float:right;">关闭</button>
				
        <button type="button" class="btn  btn-default" style="float:right;">保存数据</button>    
        <!--</div>end model_content-->
                    
        <script type="text/javascript">
                function update(f){
                    for(y=1;y<=8;y++){
                        art = document.getElementById("up"+y);
                        art.style.display="none";
                    }
                    i=f;
                    obj = document.getElementById("up"+i);
                    obj.style.display="block";           
                }
                function hid(y){
                    for(y=1;y<=8;y++){
                        art = document.getElementById("up"+y);
                        art.style.display="none";
                    }
                }
        </script> 
		</div><!-- /.modal-content -->
                
	</div><!-- /.modal -->
</div>
        
        <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;text-align: center;line-height: 300px;" id="a2">
            暂无动态
        </div>
        <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;text-align: center;line-height: 300px;" id="a3">
            暂无回答
        </div>
        <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;text-align: center;line-height: 300px;" id="a4">
            暂无文章
        </div>
        <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;text-align: center;line-height: 300px;" id="a5">
            暂无提问
        </div>
    </body>
</html>

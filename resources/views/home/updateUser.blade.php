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
        <link href="{{asset('css/updateUser.css')}}" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/userCenter.js')}}"></script>
        <style>
            .hid{display: none;}
        </style>
    </head>
    <body>
        <div class="content col-md-9 col-md-offset-1 col-xs-12">
            <div class="head col-md-3 col-xs-4"><img src="{{asset('image/head.jpeg')}}" class="img-circle img-thumbnail img-responsive"/></div>
            <div class="information col-md-9 col-xs-9">
                <div class="update_userName">用户名sss</div>
                <table class="table table-hover">
		<tbody>
			<tr>
				<td>账号</td>
				<td>Anna</td>
			</tr>
                        <tr onmouseover="update(1)" onmouseout="hid(1)">
                            <td class="col-md-4 col-xs-4">当前专业</td>
                            <td class=" col-md-8 col-xs-8"><span>未知</span> <span><a href="" id="up1" class="hid">修改</a></span></span></td>
			</tr>
			<tr onmouseover="update(2)" onmouseout="hid(2)">
				<td>真实姓名</td>
                                <td><span>未知</span> <span> <a href="" id="up2" class="hid">修改</a></span></td>
			</tr>
                        <tr onmouseover="update(3)" onmouseout="hid(3)">
				<td>性别</td>
				<td><span>未知</span> <span> <a href="" id="up3" class="hid">修改</a></span></td>
			</tr>
                        <tr onmouseover="update(4)" onmouseout="hid(4)">
				<td>QQ号码</td>
				<td><span>未知</span> <span> <a href="" id="up4" class="hid">修改</a></span></td>
			</tr>
                        <tr onmouseover="update(5)" onmouseout="hid(5)">
				<td>出生时间</td>
				<td><span>未知</span> <span> <a href="" id="up5" class="hid">修改</a></span></td>
			</tr>
                        <tr onmouseover="update(6)" onmouseout="hid(6)">
				<td>联系电话</td>
				<td><span>未知</span> <span> <a href="" id="up6" class="hid">修改</a></span></td>
			</tr>
                        <tr onmouseover="update(7)" onmouseout="hid(7)">
				<td>电子邮箱</td>
                                <td><span>未知</span> <span> <a href="" id="up7" class="hid">修改</a></span></td>
			</tr>
                       
		</tbody>
            </table>
                <button type="button" class="btn btn-default center-block col-md-12 col-xs-12">保存数据</button>
            </div>
        </div>
        <script type="text/javascript">
                function update(f){
                    for(y=1;y<=7;y++){
                        art = document.getElementById("up"+y);
                        art.style.display="none";
                    }
                    i=f;
                    obj = document.getElementById("up"+i);
                    obj.style.display="block";           
                }
                function hid(y){
                    for(y=1;y<=7;y++){
                        art = document.getElementById("up"+y);
                        art.style.display="none";
                    }
                }
        </script>   
    </body>
</html>

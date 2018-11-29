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
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('lib/element-ui/lib/theme-chalk/index.css')}}" rel="stylesheet">

    <script src="{{asset('lib/common.js')}}"></script>
    <script type="text/javascript">
        let common = new Common();
        common.token = '{{csrf_token()}}'; //获取token;
    </script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('lib/layer/2.4/layer.js')}}"></script>
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('lib/element-ui/lib/index.js')}}"></script>
    <link href="{{asset('css/userCenter.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{asset('js/userCenter.js')}}"></script>

    <style>
        .hid{display: none;}
        </style>
</head>

<body>

    <div class="content col-md-12" style="padding: 0;">
        <a href="{{url('')}}" title="返回首页"><span class="glyphicon glyphicon-home back"></span></a>
        <div class="head col-md-8 col-xs-8" style="margin-top: 15px;margin-bottom: 15px;">

            <table>
                <tr>
                    <td rowspan="2">
                        <span class="img_content">
                            <img src="{{asset('uploads/image/white.jpg')}}" class="img-circle img-thumbnail img-responsive"
                                id="head" />
                            <span class="mask" data-toggle="modal" data-target="#myModal">修改头像</span>
                        </span>
                    </td>
                    <td class="userName">您好！</td>
                </tr>
                <tr>
                    <td class="userName" id="username"></td>
                </tr>
            </table>
        </div>
        <div class="programa col-md-12 col-xs-12" style="padding: 0;">
            <ul class="programa col-md-12 col-xs-12 header-nav" style="padding: 0;">
                <li class="col-md-4 col-xs-4 active" onclick="show(1)" id="bg1">个人信息</li>
                <li class="col-md-4 col-xs-4" onclick="show(2)" id="bg2">用户身份</li>
                <li class="col-md-2 col-xs-2" onclick="show(3)" id="bg3">余额</li>
                <li onclick="show(4)" id="bg4"></li>
                <li class="col-md-2 col-xs-2" onclick="show(5)" id="bg5">设置</li>
            </ul>
        </div>
        <script type="text/javascript">
            function show(f) {
                for (y = 1; y <= 5; y++) {
                    art = document.getElementById("a" + y);
                    art.style.display = "none";
                    bg = document.getElementById("bg" + y);
                    bg.style.background = "rgba(0, 0, 32, 0)";
                    bg.style.color = "#000";
                }
                i = f;
                obj = document.getElementById("a" + i);
                if (f != 5) {
                    obj.style.display = "block";
                } else {
                    obj.style.display = "flex";
                }
                bg = document.getElementById("bg" + i);
                bg.style.background = "rgba(0, 0, 32, 0.2)";
                bg.style.color = "#fff";
            }

            function back(i) {
                for (y = 1; y <= 5; y++) {
                    bg = document.getElementById("bg" + y);
                    bg.style.background = "rgba(0, 0, 32, 0)";
                }
                f = i;
                bg = document.getElementById("bg" + f);
                bg.style.background = "rgba(0, 0, 32, 0.2)";
            }
        </script>
    </div>
    <!--end content-->

    <div class="article_a col-md-10 col-xs-12 col-md-offset-1" style="margin-top: 15px;" id="a1">
        <table class="table table-striped table-hover">
            <tbody>

                <tr>
                    <td>昵称</td>
                    <td id="nickname"></td>
                </tr>
                <tr>
                    <td>当前专业</td>
                    <td id="major"></td>
                </tr>
                <tr>
                    <td>真实姓名</td>
                    <td id="real_name"></td>
                </tr>
                <tr>
                    <td>QQ号码</td>
                    <td id="qq"></td>
                </tr>
                <tr>
                    <td>出生时间</td>
                    <td id="birth"></td>
                </tr>
                <tr>
                    <td>联系电话</td>
                    <td id="phone"></td>
                </tr>

            </tbody>
        </table>
        <button type="button" class="btn btn-info col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal">修改个人信息</button>
    </div>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <img src="" class="img-circle img-thumbnail img-responsive center-block" id="img-info" />
                <form method="post" enctype="multipart/form-data" action="{{url('home/updateUser')}}" id="updateUser">
                    {{csrf_field()}}

                    <table class="table information">
                        <tbody>
                            <tr>
                                <td>更改头像</td>
                                <td><input value="" type="file" name="head" autocomplete="off" /></td>
                            </tr>
                            <input id="user_id" name="user_id" type="hidden" value="sssdddd">
                            <tr onmouseover="update(1)" onmouseout="hid(1)">
                                <td class="col-md-4 col-xs-4">昵称</td>
                                <td class=" col-md-8 col-xs-8">
                                    <div id="hideinfo1"><span id="info1"></span> <span id="up1" class="hid" onclick="hideinfo(1)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo1">
                                        <input type="text" value="" class="full" id="input1" name="nickname"
                                            autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(1)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(1)">取消</div>
                                    </div>
                                </td>
                            </tr>


                            <tr onmouseover="update(2)" onmouseout="hid(2)">
                                <td class="col-md-4 col-xs-4">当前专业</td>
                                <td class=" col-md-8 col-xs-8">
                                    <div id="hideinfo2"><span id="info2"></span> <span id="up2" class="hid" onclick="hideinfo(2)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo2">
                                        <input type="text" value="" class="full" id="input2" name="major" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(2)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(2)">取消</div>
                                    </div>
                                </td>
                            </tr>

                            <tr onmouseover="update(3)" onmouseout="hid(3)">
                                <td>真实姓名</td>
                                <td>
                                    <div id="hideinfo3"><span id="info3"></span><span id="up3" class="hid" onclick="hideinfo(3)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo3">
                                        <input type="text" value="" class="full" id="input3" name="real_name"
                                            autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(3)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(3)">取消</div>
                                    </div>
                                </td>
                            </tr>

                            <tr onmouseover="update(4)" onmouseout="hid(4)">
                                <td>QQ号码</td>
                                <td>
                                    <div id="hideinfo4"><span id="info4"></span><span id="up4" class="hid" onclick="hideinfo(4)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo4">
                                        <input type="text" value="" class="full" id="input4" name="qq" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(4)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(4)">取消</div>
                                    </div>
                                </td>
                            </tr>
                            <tr onmouseover="update(5)" onmouseout="hid(5)">
                                <td>出生时间</td>
                                <td>
                                    <div id="hideinfo5"><span id="info5"></span><span id="up5" class="hid" onclick="hideinfo(5)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo5">
                                        <input type="date" value="{{$now}}" class="whole" style="color:black;" id="input5"
                                            name="birth" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(5)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(5)">取消</div>
                                    </div>
                                </td>
                            </tr>
                            <tr onmouseover="update(6)" onmouseout="hid(6)">
                                <td>联系电话</td>
                                <td>
                                    <div id="hideinfo6"><span id="info6"></span><span id="up6" class="hid" onclick="hideinfo(6)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo6">
                                        <input type="text" value="" class="full" id="input6" name="phone" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(6)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(6)">取消</div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>




                    <!--</div>end infomation-->
                    <button type="button" class="btn  btn-default" data-dismiss="modal" style="float:right;" onclick="close()">关闭</button>

                    <button type="submit" class="btn  btn-default" style="float:right;">保存数据</button>
                    <!--</div>end model_content-->
                </form>

            </div><!-- /.modal-content -->

        </div><!-- /.modal -->
    </div>
    <div class="article_a col-md-10 col-xs-12 col-md-offset-1 hid" style="margin-top: 15px;" id="a2">
        <table class="table table-striped table-hover">
            <tbody>

                <tr>
                    <td>角色</td>
                    <td id="rolename"></td>
                </tr>
                <tr>
                    <td>所属栋</td>
                    <td id="ridgepole"></td>
                </tr>
                <tr>
                    <td>宿舍号</td>
                    <td id="dorm_num"></td>
                </tr>
                <tr>
                    <td>是否通过审核</td>
                    <td id="check"></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="btn btn-info col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal2">修改用户身份</button>
    </div>
    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data" action="{{url('home/updateidentity')}}" style="padding:15px 15px 0 15px;">
                    {{csrf_field()}}
                    <input name="user_id" id="userid" type="hidden" value="ww" />
                    <table class="table information">
                        <tbody>
                            <tr onmouseover="update(7)" onmouseout="hid(7)">
                                <td class="col-md-4 col-xs-4" style="border-top: 0px;">角色</td>
                                <td class=" col-md-8 col-xs-8" style="border-top: 0px;">
                                    <div id="hideinfo7"><span id="info7">必选</span> <span id="up7" class="hid" onclick="hideinfo(7)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo7" style="color:#cccccc;">
                                        <select class="select full" name="role_id" size="1">
                                            <option value="0">选择栏目</option>
                                            @foreach($role as $v)
                                            <option value="{{$v->role_name}}" id="input7">{{$v->role_name}}</option>
                                            @endforeach
                                        </select>
                                        <!--<div class="btn btn-primary marginTop" onclick="updateinfo(7)">保存</div><div class="btn btn-default marginTop marginLeft" onclick="cancel(7)">取消</div>-->
                                    </div>
                                </td>
                            </tr>


                            <tr onmouseover="update(8)" onmouseout="hid(8)">
                                <td class="col-md-4 col-xs-4">所属栋</td>
                                <td class=" col-md-8 col-xs-8">
                                    <div id="hideinfo8"><span id="info8">必填</span> <span id="up8" class="hid" onclick="hideinfo(8)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo8">
                                        <input type="text" value="" required="required" onkeyup="if(/\D/.test(this.value)){layer.msg('请输入数字');this.value='';}"
                                            class="full" id="input8" name="ridgepole" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(8)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(8)">取消</div>
                                    </div>
                                </td>
                            </tr>

                            <tr onmouseover="update(9)" onmouseout="hid(9)">
                                <td>宿舍号</td>
                                <td class=" col-md-8 col-xs-8">
                                    <div id="hideinfo9"><span id="info9">必填</span><span id="up9" class="hid" onclick="hideinfo(9)">&nbsp;&nbsp;修改</span></div>
                                    <div id="updateinfo9" style="display:none;">
                                        <input type="text" value="" required="required" onkeyup="if(/\D/.test(this.value)){layer.msg('请输入数字');this.value='';}"
                                            class="full" id="input9" name="dorm_num" autocomplete="off" />
                                        <div class="btn btn-primary marginTop" onclick="updateinfo(9)">保存</div>
                                        <div class="btn btn-default marginTop marginLeft" onclick="cancel(9)">取消</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                    <!--</div>end infomation-->
                    <button type="button" class="btn  btn-default" data-dismiss="modal" style="float:right;" onclick="close()">关闭</button>

                    <button type="submit" class="btn  btn-default" style="float:right;">保存数据</button>
                    <!--</div>end model_content-->
                </form>

            </div><!-- /.modal-content -->

        </div><!-- /.modal -->
    </div>
    <div class="col-md-10 col-xs-12 col-md-offset-1 hid" style="margin-top: 15px;" id="a3">
        <div class="yue">
            <div v-if="openPay">
                <p>我的余额</p>
                <h1>${money | moneyFormat}</h1>
                <el-button type="primary" style="width: 100%;" @click="topUp = true">充值</el-button>
                <el-button width="100%" style="width: 100%;">提现</el-button>
                <p class="pay-detail" @click="showPayDetail">零钱明细</p>
    
                <div class="pay">
                    <el-dialog custom-class="pay" title="输入金额" :visible.sync="topUp" center>
                        <div class="pay--main">
                            <span>${pay.type == 0? '充值': pay.type == 1? '提现': '充值'}</span>
                            <div class="pay--main__money">
                                <el-input type="number" autofocus="autofocus" v-model="pay.cost" @keyup.enter="showPay"></el-input>
                                <el-button type="primary" @click="showPay">充值</el-button>
                            </div>
                        </div>
                    </el-dialog>
                </div>
    
                <div class="pay">
                    <el-dialog custom-class="pay" title="请输入支付密码" :visible.sync="pay.visible" center>
                        <div class="pay--main">
                            <span>${pay.type == 0? '充值': pay.type == 1? '提现': '充值'}</span>
                            <span>${pay.cost | moneyFormat}</span>
                            <div class="pay--main__password" @click="handleClick">
                                <span>${(payPassword.length > 0? '●': null)}</span>
                                <span>${(payPassword.length > 1? '●': null)}</span>
                                <span>${(payPassword.length > 2? '●': null)}</span>
                                <span>${(payPassword.length > 3? '●': null)}</span>
                                <span>${(payPassword.length > 4? '●': null)}</span>
                                <span>${(payPassword.length > 5? '●': null)}</span>
                            </div>
                            <input type="number" style="opacity:0" v-model="payPassword" maxlength="6" :disabled="disabledInput"
                                autofocus="autofocus" ref="input" />
                        </div>
                    </el-dialog>
                </div>
    
                <!-- 零钱明细 -->
                <el-dialog custom-class="pay-detail__dialog" title="零钱明细" :visible.sync="payDetail.visiable" center>
                    <ul class="pay-detail__dialog--list" @scroll="handleScroll($event)">
                        <li v-for="(value, index) of payDetail.dataSource" :key="index">
                            <div class="pay-detail__dialog--list-left">
                                <p>${value.organization}</p>
                                <p>${value.date}</p>
                            </div>
                            <div :class="{'pay-detail__dialog--list-right':true, 'income': !!value.consume_type}">${value.consume_type?
                                '+': '-'} ${value.consume_cost}</div>
                        </li>
                    </ul>
                </el-dialog>
            </div>
            <p v-else style="text-align: center;">未开通支付功能，请前往设置中设置</p>
        </div>
    </div>
    <div class="article_a col-md-10 col-xs-12 col-md-offset-1 hid" style="margin-top: 15px;text-align: center;line-height: 300px;"
        id="a4">
        暂无回答
    </div>
    <div class="article_b col-md-10 col-xs-12 col-md-offset-1 hid" style="margin-top: 15px;text-align: center;line-height: 300px;"
        id="a5">
        <div class="setting">
            <ul :class="{'setting__side':true, 'active': slideSide}">
                <li :class="{active: showMain == 0}" @click="showMain = 0">账号与安全</li>
                <li :class="{active: showMain == 1}" @click="showPayConfig">支付设置</li>
                <li :class="{active: showMain == 2}" @click="showMain = 2">修改密码</li>
                <li :class="{active: showMain == 3}" @click="showMain = 3">关于优便</li>
                <li @click="logout">退出登录</li>
            </ul>
            <i :class="{'el-icon-d-arrow':true, 'el-icon-d-arrow-right': true, 'active': slideSide}" @click="slideSide = !slideSide"></i>
            <div class="setting__main">
                <transition name="fade"  mode="out-in">
                    <div class="safety" v-if="showMain == 0">
                        <h1>优便校园</h1>
                        <p>优便校园，优便你我他</p>
                        <div class="safety__content">
                            <div>
                                <span>优便号：</span><span>Wonder</span>
                            </div>
                            <div>
                                <span>绑定邮箱：</span>
                                <div>
                                    <span>${safety.bindEmail}</span>
                                    <el-button type="primary" size="small" @click="handleModifyButton">修改</el-button>
                                </div>
                            </div>
                        </div>

                        <el-dialog
                            custom-class="modifyEmail-dialog"
                            title = "修改绑定的邮箱"
                            :visible.sync = "safety.modifyEmail"
                            @close = "resetData"
                            center
                        >
                            <el-form :model="safety.modifyEmailInfo" :rules="modifyEmailRules" ref="modifyEmailForm" label-width="70px" @submit.native.prevent>
                                <div v-if="!safety.modifyEmailInfo.next" :key="1">
                                    <el-form-item label="原邮箱">
                                        <span>${safety.bindEmail}</span>
                                    </el-form-item>
                                    <el-form-item prop="originValidate" label="验证码">
                                        <div class="modifyEmail-dialog__originValidate">
                                            <el-input type="text" placeholder="输入验证码" v-model="safety.modifyEmailInfo.originValidate" @keyup.enter.native="handleModifyEmail('modifyEmailForm')"></el-input>
                                            <el-button @click="getCode(safety.bindEmail)" :disabled="safety.buttonStatus.disabled">${safety.buttonStatus.content}</el-button>
                                        </div>
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="handleModifyEmail('modifyEmailForm')">下一步</el-button>
                                        <el-button @click="handleReset('modifyEmailForm')">重置</el-button>
                                    </el-form-item>
                                </div>
                                <div v-else :key="2">
                                    <el-form-item prop="newEmail" label="新邮箱">
                                        <el-input type="text" placeholder="输入要绑定的邮箱" v-model="safety.modifyEmailInfo.newEmail" autofocus></el-input>
                                    </el-form-item>
                                    <el-form-item prop="newValidate" label="验证码">
                                        <div class="modifyEmail-dialog__originValidate">
                                            <el-input type="text" placeholder="输入验证码" v-model="safety.modifyEmailInfo.newValidate" @keyup.enter.native="handleSaveEmail('modifyEmailForm')"></el-input>
                                            <el-button @click="getNewCode" :disabled="safety.buttonStatus.disabled">${safety.buttonStatus.content}</el-button>
                                        </div>
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="handleSaveEmail('modifyEmailForm')">保存</el-button>
                                        <el-button @click="handleReset('modifyEmailForm')">重置</el-button>
                                    </el-form-item>
                                </div>
                            </el-form>
                        </el-dialog>
                    </div>
                    <div class="paySetting" v-if="showMain == 1">
                        <h1>优便校园</h1>
                        <p>优便校园，优便你我他</p>
                        <el-button type="primary" v-if="!payConfig.type" @click="openPay">开通支付功能</el-button>
                        <el-button type="primary" v-else @click="openPay">修改支付密码</el-button>

                        <el-dialog
                            custom-class="modifyEmail-dialog"
                            title = "验证邮箱"
                            :visible.sync = "payConfig.showValidateEmail"
                            @close = "resetData"
                            center
                        >
                            <el-form :model="safety.modifyEmailInfo" :rules="modifyEmailRules" ref="confirmEmailForm" label-width="70px" @submit.native.prevent>
                                <el-form-item label="邮箱">
                                    <span>${safety.bindEmail}</span>
                                </el-form-item>
                                <el-form-item prop="originValidate" label="验证码">
                                    <div class="modifyEmail-dialog__originValidate">
                                        <el-input type="text" placeholder="输入验证码" v-model="safety.modifyEmailInfo.originValidate" @keyup.enter.native="handleModifyEmail('confirmEmailForm')"></el-input>
                                        <el-button @click="getCode(safety.bindEmail)" :disabled="safety.buttonStatus.disabled">${safety.buttonStatus.content}</el-button>
                                    </div>
                                </el-form-item>
                                <el-form-item>
                                    <el-button type="primary" @click="handlePaySubmit('confirmEmailForm')">提交</el-button>
                                    <el-button @click="handleReset('confirmEmailForm')">重置</el-button>
                                </el-form-item>
                            </el-form>
                        </el-dialog>

                        <el-dialog custom-class="pay" :title="payConfig.confirm? '确认密码': '请输入支付密码'" :visible.sync="payConfig.ShowPayPassword" center>
                            <div class="pay--main">
                                <div class="pay--main__password" @click="handleClick">
                                    <span>${(payPassword.length > 0? '●': null)}</span>
                                    <span>${(payPassword.length > 1? '●': null)}</span>
                                    <span>${(payPassword.length > 2? '●': null)}</span>
                                    <span>${(payPassword.length > 3? '●': null)}</span>
                                    <span>${(payPassword.length > 4? '●': null)}</span>
                                    <span>${(payPassword.length > 5? '●': null)}</span>
                                </div>
                                <input type="number" style="opacity:0" v-model="payPassword" maxlength="6" :disabled="payConfig.disabledInput"
                                    autofocus="autofocus" ref="input" />
                            </div>
                        </el-dialog>
                        
                    </div>
                    <div class="modifyPassword" v-if="showMain == 2">
                        <h1>优便校园</h1>
                        <p>优便校园，优便你我他</p>
                        <el-form :model="modifyPassword" :rules="rules" ref="modifyPassword" label-width="100px">
                            <el-form-item label="原密码" prop="originPassword">
                                <el-input type="password" v-model="modifyPassword.originPassword" autocompolete/>
                            </el-form-item>
                            <el-form-item label="密码" prop="password">
                                <el-input type="password" v-model="modifyPassword.password" autocompolete/>
                            </el-form-item>
                            <el-form-item label="确认密码" prop="confirmPassword">
                                <el-input type="password" v-model="modifyPassword.confirmPassword" autocompolete/>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="handleSubmit('modifyPassword')">提交</el-button>
                                <el-button @click="handleReset('modifyPassword')">重置</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                    <div class="about" v-if="showMain == 3">
                        关于优便
                    </div>
                </transition>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function update(f) {
            for (y = 1; y <= 9; y++) {
                art = document.getElementById("up" + y);
                art.style.display = "none";
            }
            i = f;
            obj = document.getElementById("up" + i);
            obj.style.display = "block";
        }

        function hid(y) {
            for (y = 1; y <= 9; y++) {
                art = document.getElementById("up" + y);
                art.style.display = "none";
            }
        }

        function hideinfo(f) {
            i = f;
            obj = document.getElementById("hideinfo" + i);
            obj.style.display = "none";
            object = document.getElementById("updateinfo" + i);
            object.style.display = "block";
        }

        function cancel(f) {
            i = f;
            obj = document.getElementById("hideinfo" + i);
            obj.style.display = "block";
            object = document.getElementById("updateinfo" + i);
            object.style.display = "none";
        }

        function updateinfo(f) {
            i = f;
            obj = document.getElementById("hideinfo" + i);
            obj.style.display = "block";
            object = document.getElementById("updateinfo" + i);
            object.style.display = "none";

            var input = $('#input' + i).val();
            $('#info' + i).html(input)
            //alert(input);

        }
    </script>
</body>

</html>
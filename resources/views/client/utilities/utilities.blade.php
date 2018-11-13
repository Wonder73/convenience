<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>优便校园 --- 水电费</title>
  @include('client\common')
</head>
<body>
  @include('client\header')
  <link href="{{asset('lib/element-ui/lib/theme-chalk/index.css')}}" rel="stylesheet">
  <script src="{{asset('lib/element-ui/lib/index.js')}}"></script>
  <script src="{{asset('utilities-static\js\utilities.js')}}"></script>
  <link rel="stylesheet" href="{{asset('utilities-static\css\utilities.css')}}" />
  <link rel="stylesheet" href="{{asset('utilities-static\css\utilities-media.css')}}" />

  <div id="utilities">
    <h1 class="title">水&nbsp;电&nbsp;费</h1>

    <ul class="cost-category">
      <li title="水费" :class="{active: category === 0}" @click="category = 0"><i class="fa fa-tint"></i></li>
      <li title="电费" :class="{active: category === 1}" @click="category = 1"><i class="fa fa-bolt"></i></li>
      <!-- <li title="网费" :class="{active: category === 2}" @click="category = 2"><i class="fa fa-wifi"></i></li> -->
    </ul>
    <div class="utilities--main">
      <el-form ref="form" :model="search" :rules="rules" label-width="80px">
        <el-form-item label="所属栋：" prop="ridgepole" required>
          <el-select v-model="search.ridgepole" placeholder="所属栋" filterable="true" size="small">
            <el-option
              v-for="(ridepole, index) in water.ridepoles"
              :key="index"
              :label="ridepole.value + ' 栋'"
              :value="ridepole.value"
            ></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="宿舍号：" prop="dorm" required>
          <el-input type="text" placeholder="宿舍号。如：306" size="small" v-model="search.dorm"/>
        </el-form-item>
        <el-form-item label="时　间：" required>
          <el-col :span="11">
            <el-form-item prop="startMonth">
              <el-date-picker type="month" placeholder="开始日期" v-model="search.startMonth" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col style="text-align: center" :span="2">~</el-col>
          <el-col :span="11">
            <el-form-item prop="endMonth">
              <el-date-picker type="month" placeholder="日期日期" v-model="search.endMonth" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" size="small" @click="query('form')">查询</el-button>
        </el-form-item>
      </el-form>

      <div class="utilities--main__search-result" v-for="(searchResult, index) of searchResults" :key="index">
        <el-row :gutter="10">
          <el-col :span="12" tag="span">所属栋：</el-col>
          <el-col :span="12" tag="span">${searchResult.ridgepole | suffix}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">宿舍号：</el-col>
          <el-col :span="12" tag="span">${searchResult.dormNum}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">搜索范围：</el-col>
          <el-col :span="12" tag="span">${searchResult.startMonth | dateFormat} ~ ${searchResult.endMonth | dateFormat}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">上个月度数：</el-col>
          <el-col :span="12" tag="span">${searchResult.lastDegrees}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">这个月度数：</el-col>
          <el-col :span="12" tag="span">${searchResult.thisDegrees}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">该月实际度数：</el-col>
          <el-col :span="12" tag="span">${searchResult.practicalDegrees}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">价格(元/每度)：</el-col>
          <el-col :span="12" tag="span">${searchResult.price}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">费用：</el-col>
          <el-col :span="12" tag="span">${searchResult.cost}</el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="12" tag="span">已支付：</el-col>
          <el-col :span="12" tag="span">${searchResult.hasPay}</el-col>
        </el-row>

        <!-- 非直接宿舍的不显示 -->
        <div v-if="searchResult.ridgepole == userInfo.user_identity.ridgepole && searchResult.dormNum == userInfo.user_identity.dorm_num">
          <el-row :gutter="10" v-if="!searchResult.completePay">
            <el-col :span="12"  :offset="showAABut? 0: 2" tag="span"><el-button type="primary" size="small" @click="oneKey(index)" v-if="!searchResult.aa">一键支付</el-button></el-col>
            <el-col :span="12" tag="span"><el-button type="primary" size="small" @click="handleaa(index)" v-if="!searchResult.aa && showAABut">AA支付</el-button></el-col>
          </el-row>
          <el-row :gutter="10" v-else>
            <el-col :span="12" offset="2" tag="span"><el-button type="success" size="small">完成支付</el-button></el-col>
          </el-row>

          <div class="utilities--main__search-aa" v-if="searchResult.aa">
            <el-row :gutter="10" type="flex" align="middle">
              <el-col :span="8" tag="span">人名</el-col>
              <el-col :span="8" tag="span">金额</el-col>
            </el-row>
            <el-row :gutter="10"  type="flex" align="middle" v-for="(porm, pormsIndex) of searchResult.porms" :key="pormsIndex">
              <el-col :span="8" tag="span">${porm.nickname? porm.nickname: porm.username}</el-col>
              <el-col :span="8" tag="span">${porm.cost}</el-col>
              <el-col :span="8" tag="span" v-if="!porm.complete_pay"><el-button type="primary" size="small" @click="handlePay(searchResult.id, porm, pormsIndex, index)">支付</el-button></el-col>
              <el-col :span="8" tag="span" v-else><el-button type="success" size="small">完成支付</el-button></el-col>
            </el-row>
          </div>
        </div>
      </div>

    </div>

    <!-- 支付密码 -->
    <v-pay :pay="pay" @completepay="handleCompletePay"></v-pay>

  </div>

</body>
</html>
<script>
  //检查用户登录
  let userInfo = decodeURIComponent($.cookie('userInfo'));
  //如果没有用户登录，就回到首页
  if(userInfo === 'undefined' || userInfo === 'null'){
    window.open('./', '_self');
  }
</script>
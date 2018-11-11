<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>优便校园 --- 水电费管理</title>
  @include('client\common')
  <script>
    //检查用户登录
    let userInfo = decodeURIComponent($.cookie('userInfo'));

    //如果没有用户登录，就回到首页
    if(userInfo === 'undefined' || userInfo === 'null'){
      window.open('./', '_self');
    }

    //验证用户身份
    common.checkIdentity(userInfo, 'utilities-manage');
  </script>
</head>
<body>
  @include('client\header')
  <link href="{{asset('lib/element-ui/lib/theme-chalk/index.css')}}" rel="stylesheet">
  <script src="{{asset('lib/element-ui/lib/index.js')}}"></script>
  <script src="{{asset('utilities-manage-static\js\utilities-manage.js')}}"></script>
  <link rel="stylesheet" href="{{asset('utilities-manage-static\css\utilities-manage.css')}}" />
  <link rel="stylesheet" href="{{asset('utilities-manage-static\css\utilities-manage-media.css')}}" />

  <div id="utilities-manage">
    <h1 class="title">水&nbsp;电&nbsp;费&nbsp;管&nbsp;理</h1>

    <ul class="cost-category">
      <li title="水费" :class="{active: category === 0}" @click="category = 0"><i class="fa fa-tint"></i></li>
      <li title="电费" :class="{active: category === 1}" @click="category = 1"><i class="fa fa-bolt"></i></li>
      <!-- <li title="网费" :class="{active: category === 2}" @click="category = 2"><i class="fa fa-wifi"></i></li> -->
    </ul>
    <div class="utilities-manage--main">
      <div class="utilities-manage--main__operation">
        <div class="utilities-manage--main__batch">
          <transition name="fade">
            <el-button type="danger" size="mini" v-if="selected.length" @click="bacthDelete"><i class="el-icon-delete"></i> 批量删除</el-button>
          </transition>
        </div>
        <div class="utilities-manage--main__operation-button">
          <el-button size="small" circle @click = "searchVisible = true"><i class="fa fa-search utilities-manage__search-button"></i></el-button>
          <el-button type="primary" size="mini" @click="upload.uploadShow = true"><i class="fa fa-sign-in"></i> 导入</el-button>
          <el-button type="primary" size="mini" @click="download"><i class="fa fa-sign-out"></i> 导出</el-button>
        </div>
      </div>
      <div class="utilities-manage--main__table">
        <el-table
          border
          v-loading="loading"
          element-loading-text="拼命加载中"
          ref="multipleTable"
          size = "mini"
          style = "width: 100%;"
          :data = "tableData.dataSource"
          @selection-change = "handleSelectChange"
          @sort-change = "handleSortChange"
        >
          <el-table-column 
            type = "selection"
            align = "center"
            min-width = "40"
          ></el-table-column>
          <el-table-column 
            prop = "ridgepole"
            label = "所属栋"
            align = "center" 
            min-width = "85"
            fixed = "left"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.ridgepole | suffix}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.ridgepole" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            prop = "dorm_num"
            label = "宿舍号"
            align = "center" 
            fixed = "left"
            min-width = "85"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.dormNum}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.dormNum" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "开始日期"
            prop = "start_month"  
            align = "center"  
            min-width = "110"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.startDate}</div>
              <div v-else><el-date-picker type="date" placeholder="开始日期" style="width: 100%;" size="mini" prefix-icon="none" value-format="yyyy-MM-dd" v-model="scope.row.startDate"></el-date-picker></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "结束日期"
            prop = "end_month"  
            align = "center" 
            min-width = "110"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.startDate}</div>
              <div v-else><el-date-picker type="date" placeholder="开始日期" style="width: 100%;" size="mini"  prefix-icon="none" value-format="yyyy-MM-dd" v-model="scope.row.endDate"></el-date-picker></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "上个月读数"
            prop = "last_degrees"
            align = "center" 
            min-width = "120" 
            sortable = "custom" 
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.lastDegrees}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.lastDegrees" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "这个月读数"
            prop = 'this_degrees'
            align = "center"  
            min-width = "120"
            sortable = "custom" 
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.thisDegrees}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.thisDegrees" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "实际读数" 
            prop = "practical_degrees"
            align = "center" 
            min-width = "100"
            sortable = "custom" 
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.practicalDegrees}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.practicalDegrees" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "价格"
            prop = "price"
            align = "center" 
            min-width = "100" 
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.price}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.price" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "缴纳费用"
            prop = "cost"
            align = "center"
            min-width = "100"
            sortable = "custom" 
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.cost}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.cost" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "已缴纳费用"
            prop = "has_pay" 
            align = "center" 
            min-width = "110"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">${scope.row.hasPay}</div>
              <div v-else><el-input type="text" size="mini"  v-model="scope.row.hasPay" /></div>
            </template>
          </el-table-column>
          <el-table-column 
            label = "是否交齐"
            prop = "complete_pay"
            align = "center"
            min-width = "110" 
            fixed = "right"
            sortable = "custom"
          >
            <template slot-scope="scope">
              <div v-if="!scope.row.edit">
                <div style="color: #85ce61" v-if="scope.row.completePay">已交齐</div>
                <div style="color: #f56c6c" v-else>未交齐</div>
              </div>
              <div v-else>
                <el-radio-group v-model="scope.row.completePay" size="mini">
                  <el-radio-button label="0">否</el-radio-button>
                  <el-radio-button label="1">是</el-radio-button>
                </el-radio-group>
              </div>
            </template>
          </el-table-column>
          <el-table-column
            label = "操作"
            align = "center"
            min-width = "160"
          >
            <template slot-scope="scope">
              <transition name="fade">
                <div v-if="!scope.row.edit">
                  <el-button size="mini" @click="openEdit(scope.$index)">编辑</el-button>
                  <el-button type="danger" size="mini" @click="deleteData(scope.row.id)">删除</el-button>
                </div>
                <div v-else>
                  <el-button type="primary" size="mini" @click="saveEdit(scope.$index)">保存</el-button>
                  <el-button type="danger" size="mini" @click="closeEdit(scope.$index)">取消</el-button>
                </div>
              </transition>
            </template>
          </el-table-column>
        </el-table>

        <!-- 分页 -->
        <div class="utilities-manage--main__table-pagination" v-if="tableData.total > pagination.pageSize">
          <el-pagination
            :total = "tableData.total"
            :current-page.sync = "pagination.currentPage"
            :page-size = "pagination.pageSize"
            :pager-count = "pagination.pagerCount"
            :layout = "pagination.layout"
            :small = "pagination.small"
            @current-change = "handleCurrentChange"
          ></el-pagination>
        </div>
      </div>

      <!-- 上传组件 -->
      <div class="utilities-manage--main__upload">
        <el-dialog
          custom-class = "utilities-manage--main__upload-dialog" 
          title="导入excel表格"
          :visible.sync = "upload.uploadShow"
          center
          >
          <el-upload
            class="utilities-manage--main__upload-upload"
            drag
            :action="upload.uploadAction"
            accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            :data = "upload.data"
            :on-success = "successUpload"
            :before-upload = "beforeUpload"
          >
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
            <div class="el-upload__tip" slot="tip">只能上传excel文件，且不超过500kb</div>
          </el-upload>
        </el-dialog>
      </div>

      <!-- 搜索内容的关键字 -->
      <div class="utilities-manage--main__search">
        <el-dialog
          title="搜索关键字"
          :visible.sync="searchVisible"
          center = "true"
          custom-class = "utilities-manage--main__search-dialog"
        >
          <el-form ref="form" :model="searchValue" label-width="80px">
            <el-form-item label="所属栋：" prop="ridgepole">
              <el-select v-model="searchValue.ridgepole" placeholder="所属栋" filterable="true" size="small">
                <el-option
                  v-for="(ridepole, index) in ridepoles"
                  :key="index"
                  :label="ridepole.value + ' 栋'"
                  :value="ridepole.value"
                ></el-option>
              </el-select>
            </el-form-item>
            <el-form-item label="宿舍号：" prop="dorm">
              <el-input type="text" placeholder="宿舍号。如：306" size="small" v-model="searchValue.dorm_num"/>
            </el-form-item>
            <el-form-item label="时　间：">
              <el-col :span="11">
                <el-form-item prop="startMonth">
                  <el-date-picker type="month" placeholder="开始日期" v-model="searchValue.start_month" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
                </el-form-item>
              </el-col>
              <el-col style="text-align: center" :span="2">~</el-col>
              <el-col :span="11">
                <el-form-item prop="endMonth">
                  <el-date-picker type="month" placeholder="日期日期" v-model="searchValue.end_month" style="width: 100%;" size="small" value-format="yyyy-MM-dd"></el-date-picker>
                </el-form-item>
              </el-col>
            </el-form-item>
            <el-form-item label="交　齐：" prop="completePay">
              <el-radio-group v-model="searchValue.complete_pay">
                <el-radio :label="0">未交齐</el-radio>
                <el-radio :label="1">已交齐</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" size="small" @click="query('form')">搜索</el-button>
            </el-form-item>
          </el-form>
        </el-dialog>
      </div>
    </div>
    
  </div>

</body>
</html>

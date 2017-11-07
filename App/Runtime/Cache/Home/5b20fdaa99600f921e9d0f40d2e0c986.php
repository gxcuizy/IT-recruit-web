<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>发布招聘信息-<?php echo ($sysInfo["title"]); ?></title>
  
    <style type="text/css">
      body { padding-top:60px; overflow-y:scroll;}
      form,div{
        margin:0;
        padding:0;
      }

      .online-resume{
        height:50px;
        margin-top:50px;
      }

      .resume-border{
        border:1px solid #dddddd;
      }

      #umessage{
        margin-top:10px;
        background-color:#eee;
      }
    </style>
    <script src="<?php echo ($path); ?>/js/jquery-1.8.3.min.js"></script>
    
    <link rel="stylesheet" href="/ITrecruit/Public/Home/css/default.css" />
    <script charset="utf-8" src="/ITrecruit/Public/Home/js/kindeditor.js"></script>
      <script type="text/javascript">
          $(function(){
              $("select[name='apply_type']").change(function(){
                  var ob = this;
                  $(".job_type~option").remove();
                  $.ajax({
                      type:"POST",             //发送方式
                      url :"/ITrecruit/Home/EnApply/doload",  //请求地址
                      data:"pid="+ob.value,   //请求数据
                      async:true,             //是否异步
                      dataType:"json",        //响应数据类型
                      success:function(data){ //成功回调函数
                          if(data==null){
                              return;
                          }
                          var str = "";
                          //遍历结果，拼装下拉项
                          for(var i=0;i<data.length;i++){
                              str +="<option value='"+data[i].name+"'>";
                              str +=data[i].name;
                              str +="</option>";
                          }
                           //添加下拉项中
                          $("select[name='job_type']").append(str);
                      },
                  });
              });
              
              //加载一级城市信息
            $.ajax({
                type:"POST",             //发送方式
                url :"/ITrecruit/Home/EnApply/load",     //请求地址
                data:"pid=0",            //请求数据
                async:true,              //是否异步
                dataType:"json",         //响应数据类型
                success:function(data){  //成功回调函数
                    //遍历结果，拼装下拉项
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str +="<option sid='"+data[i].id+"' value='"+data[i].name+"'>";
                        str +=data[i].name;
                        str +="</option>";
                    }
                    //添加下拉项中
                    $("select[name='work_province']").append(str);
                },
            });
            //加载二级城市信息
            $("select[name='work_province']").change(function(){
              var ob = this;
              var sid=$("select[name='work_province'] option:selected").attr("sid");
              $(".city~option").remove();
              $.ajax({
                      type:"POST",             //发送方式
                      url :"/ITrecruit/Home/EnApply/load",     //请求地址
                      data:"pid="+sid,         //请求数据
                      async:true,              //是否异步
                      dataType:"json",         //响应数据类型
                      success:function(data){  //成功回调函数
                          if(data==null){
                              return;
                          }
                          var str = "";
                          //遍历结果，拼装下拉项
                          for(var i=0;i<data.length;i++){
                              str +="<option sid='"+data[i].id+"' value='"+data[i].name+"'>";
                              str +=data[i].name;
                              str +="</option>";
                          }
                           //添加下拉项中
                          $("select[name='work_city']").append(str);
                      },
                  });
            });

           //加载三级城市信息
            $("select[name='work_city']").change(function(){
              var ob = this;
              var sid=$("select[name='work_city'] option:selected").attr("sid");
              $(".county~option").remove();
              $.ajax({
                      type:"POST",             //发送方式
                      url :"/ITrecruit/Home/EnApply/load",     //请求地址
                      data:"pid="+sid,         //请求数据
                      async:true,              //是否异步
                      dataType:"json",         //响应数据类型
                      success:function(data){  //成功回调函数
                          if(data==null){
                              return;
                          }
                          var str = "";
                          //遍历结果，拼装下拉项
                          for(var i=0;i<data.length;i++){
                              str +="<option value='"+data[i].name+"'>";
                              str +=data[i].name;
                              str +="</option>";
                          }
                           //添加下拉项中
                          $("select[name='work_county']").append(str);
                      },
                  });
            });

            //验证发布公司
            $("input[name='en_name']").blur(function(){
              var name = $("input[name='en_name']").val();
              $("input[name='en_name']+span").remove();
              if(name.length<1){
                  var str = "<span style='color:red'>发布公司不能为空!</span>";
                  $("input[name='en_name']").after(str);
                   $("#addposition").attr("onsubmit","return false");
                  }else{
                       $("#addposition").attr("onsubmit","");
                  }
              });
            //验证职位名称
            $("input[name='job_name']").blur(function(){
              var name = $("input[name='job_name']").val();
              $("input[name='job_name']+span").remove();
              if(name.length<1){
                  var str = "<span style='color:red'>职位名称不能为空!</span>";
                  $("input[name='job_name']").after(str);
                   $("#addposition").attr("onsubmit","return false");
                  }else{
                       $("#addposition").attr("onsubmit","");
                  }
              });
            //验证职位职责
            $("textarea[name='work_duty']").blur(function(){
              var text = $("textarea[name='work_duty']").val();
              $("textarea[name='work_duty']+span").remove();
              if(text.length<1){
                  var str = "<span style='color:red'>职位职责不能为空!</span>";
                  $("textarea[name='work_duty']").after(str);
                   $("#addposition").attr("onsubmit","return false");
                  }else{
                       $("#addposition").attr("onsubmit","");
                  }
              });
            //验证职位要求
             $("textarea[name='work_claim']").blur(function(){
              var text = $("textarea[name='work_claim']").val();
              $("textarea[name='work_claim']+span").remove();
              if(text.length<1){
                  var str = "<span style='color:red'>职位要求不能为空!</span>";
                  $("textarea[name='work_claim']").after(str);
                   $("#addposition").attr("onsubmit","return false");
                  }else{
                       $("#addposition").attr("onsubmit","");
                  }
              });
            //验证企业介绍
             $("textarea[name='en_introduction']").blur(function(){
              var text = $("textarea[name='en_introduction']").val();
              $("textarea[name='en_introduction']+span").remove();
              if(text.length<1){
                  var str = "<span style='color:red'>企业介绍不能为空!</span>";
                  $("textarea[name='en_introduction']").after(str);
                   $("#addposition").attr("onsubmit","return false");
                  }else{
                       $("#addposition").attr("onsubmit","");
                  }
              });
             //验证下拉框
             
          });
        // 职位职责编辑器定义
        KE.show({
          id : 'contentDuty',
          resizeMode : 1,
          allowPreviewEmoticons : false,
          allowUpload : false,
          items : [
          'fontname', 'fontsize', '|', 'textcolor', 'bold', 'italic', 'underline',
          'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
          'insertunorderedlist']
        });
        // 任职要求编辑器定义
        KE.show({
          id : 'contentClaim',
          resizeMode : 1,
          allowPreviewEmoticons : false,
          allowUpload : false,
          items : [
          'fontname', 'fontsize', '|', 'textcolor', 'bold', 'italic', 'underline',
          'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
          'insertunorderedlist']
        });
      </script>
  
    <!-- Bootstrap -->
    <link href="<?php echo ($path); ?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <script type="text/javascript">
    $(function(){
      $(".navbar-nav li").mousemove(function(){
        $(this).addClass('active');
        // alert('ok');
      }).mouseout(function(){
        $(this).removeClass('active');
      });
    });
    </script>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container-fluid container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand glyphicon glyphicon-fire" href="<?php echo U('Home/Index/index');?>">IT招聘网</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo U('Home/Index/index');?>">首页 <span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo U('Home/EnterpriseList/index');?>">企业列表</a></li>
        <li><a href="<?php echo U('Home/Apply/index');?>">招聘列表</a></li>
        <li><a href="<?php echo U('Home/Resume/index');?>">简历列表</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if($_SESSION['ITUser']['type'] == '0'): ?><!-- 求职者入口 -->
          <li><a href="<?php echo U('Home/Jobhunter/index');?>"><?php echo ($_SESSION['ITUser']['username']); ?></a></li>
          <li><a href="<?php echo U('Home/Login/loginOut');?>">退出</a></li>
        <?php elseif($_SESSION['ITUser']['type'] == '1'): ?>
        <!-- 企业入口 -->
          <li><a href="<?php echo U('Home/Enterprise/index');?>"><?php echo ($_SESSION['ITUser']['username']); ?></a></li>
          <li><a href="<?php echo U('Home/Login/loginOut');?>">退出</a></li>
        <?php else: ?>
        <!-- 未登陆入口 -->
          <li>
            <a data-toggle="dropdown" href="">登陆</a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Home/Login/jobLogin');?>">求职者登陆</a></li>
              <li><a href="<?php echo U('Home/Login/enLogin');?>">企业登陆</a></li>
            </ul>
          </li>
          <li>
            <a data-toggle="dropdown" href="">注册</a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Home/Register/jobRegister');?>">求职者注册</a></li>
              <li><a href="<?php echo U('Home/Register/enRegister');?>">企业注册</a></li>
            </ul>
          </li><?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  
    <div class="container">
      
    <div class="col-md-3" style="border-top:1px solid #ddd;">
      <div style="margin-top:10px;">
        <img src="<?php echo ($path); ?>/uploads/enterprise/photo/<?php echo ($_SESSION['ITUser']['en_photo']); ?>" alt="头像" class="img-circle center-block" width="160" height="160" style="margin-bottom:10px;">
        <p class="text-muted text-center"><strong><?php echo ($_SESSION['ITUser']['en_name']); ?></strong></p>
      </div>
      <ul class="nav nav-pills nav-stacked">
        <li role="presentation"><a href="/ITrecruit/Home/Enterprise/index">个人中心</a></li>
        <li role="presentation" class="active"><a href="/ITrecruit/Home/EnApply/listApply">招聘管理</a></li>
        <li role="presentation"><a href="/ITrecruit/Home/DealResume/index">简历管理</a></li>
        <li role="presentation"><a href="/ITrecruit/Home/Enterprise/setEnInfo">企业管理</a></li>
        <li role="presentation"><a href="/ITrecruit/Home/Enterprise/updatePw">修改密码</a></li>
      </ul>
    </div>
  
      
    <div class="col-md-9 resume-border" >
      <div class="online-resume">
        <h3>发布职位招聘信息</h3>
      </div>
      <ul class="nav nav-tabs">
        <li role="presentation"><a href="/ITrecruit/Home/EnApply/listApply">招聘职位列表</a></li>
        <li role="presentation" class="active"><a href="/ITrecruit/Home/EnApply/addApply">发布招聘信息</a></li>
      </ul>
      <!-- 招聘职位基本信息 -->
      <form class="form-horizontal" id="addposition" method="post" action="/ITrecruit/Home/EnApply/add/">
        <div class="alert alert-info col-md-12" role="alert" id="umessage">基本信息</div>
        <div class="col-md-12">
          <div class=" col-md-offset-1 col-md-10">
            <div class="form-group">
              <label for="enName" class="col-sm-2 control-label">*发布公司</label>
              <div class="col-sm-10">
                <input type="text" name="en_name" id="enName" value="<?php echo ($enterprise['en_name']); ?>"  class="form-control" placeholder="请输入您的公司名字">
              </div>
            </div>
            <div class="form-group">
              <label for="jobName" class="col-sm-2 control-label">*职位名称</label>
              <div class="col-sm-10">
                <input type="text" name="job_name" id="jobName" class="form-control" placeholder="请输入招聘职位名称">
              </div>
            </div>
            <div class="form-group">
              <label for="applyType" class="col-sm-2 control-label">*招聘类型</label>
              <div class="col-sm-4">
                <select class="form-control" name="apply_type">
                  <option value="">请选择招聘类型</option>
                  <option value="0">技术类招聘</option>
                  <option value="1">产品类招聘</option>
                  <option value="2">设计类招聘</option>
                  <option value="3">运营类招聘</option>
                </select>
              </div>
              <label class="col-sm-2 control-label">*工作关键字</label>
              <div class="col-sm-4">
                <select class="form-control" name="job_type">
                  <option class="job_type" value="">请选择工作关键字</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="jobExperience" name="jobExperience" class="col-sm-2 control-label">*工作经验</label>
              <div class="col-sm-4">
                <select class="form-control" name="job_experience">
                  <option value="">请选择工作经验</option>
                  <option value="5年以上">5年以上</option>
                  <option value="3-5年">3-5年</option>
                  <option value="1-3年">1-3年</option>
                  <option value="无要求">无要求</option>
                </select>
              </div>
              <label for="salary" class="col-sm-2 control-label">*月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;薪</label>
              <div class="col-sm-4">
                <select class="form-control" name="salary">
                  <option value="">请选择月薪</option>
                  <option value="1000-3000">1000-3000</option>
                  <option value="3000-5000">3000-5000</option>
                  <option value="5000-7000">5000-7000</option>
                  <option value="7000-9000">7000-9000</option>
                  <option value="10000+">10000+</option>
                  <option value="面谈">面谈</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="educationClaim" class="col-sm-2 control-label">*学历要求</label>
              <div class="col-sm-4">
                <select class="form-control" name="education_claim">
                  <option value="">请选择学历</option>
                  <option value="博士">博士</option>
                  <option value="研究生">研究生</option>
                  <option value="本科">本科</option>
                  <option value="专科">专科</option>
                  <option value="高中">高中</option>
                  <option value="高中以下">高中以下</option>
                  <option value="学历不限">学历不限</option>
                </select>
              </div>
                <!-- 公司邮箱 -->
                <input type="hidden" name="en_email" value="<?php echo ($enterprise['email']); ?>" id="en_email" class="form-control" placeholder="请输入公司邮箱">
              <label for="ageClaim" class="col-sm-2 control-label">*年龄要求</label>
              <div class="col-sm-4">
                <select class="form-control" name="age_claim">
                  <option value="">请选择年龄</option>
                  <option value="20岁以下">20岁以下</option>
                  <option value="20-25岁">20-25岁</option>
                  <option value="25-30岁">25-30岁</option>
                  <option value="30-35岁">30-35岁</option>
                  <option value="年龄不限">年龄不限</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="workAddress" class="col-sm-2 control-label">*工作地点</label>
              <div class="col-sm-10">
                <div class="col-md-4">
                  <select class="form-control" name="work_province" id="education">
                    <option class="province" value="">请选择</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-control" name="work_city" id="education">
                    <option class="city" value="">请选择</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select class="form-control" name="work_county" id="education">
                    <option class="county" value="">请选择</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="enAdvantages" class="col-sm-2 control-label">*职位亮点</label>
              <div class="col-sm-10">
                <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  请选择职位亮点标签
                </button>
                <div class="collapse" id="collapseExample">
                  <div class="well">
                    <?php if(is_array($advantages)): $i = 0; $__LIST__ = $advantages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline" for="<?php echo ($vo["id"]); ?>" style="margin-left:10px;">
                          <input type="checkbox" name="work_advantages[]" id="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["name"]); ?>"/><?php echo ($vo["name"]); ?>
                        </label><?php endforeach; endif; else: echo "" ;endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 基本信息结束 -->
        <!-- 职位职责 -->
        <div class="alert alert-info col-md-12" role="alert" id="umessage" >职位职责</div>
        <div class="col-md-12">
          <div class="col-md-offset-1 col-md-10">
            <div class="form-group">
              <!-- <textarea class="form-control" rows="7" style="resize:none;" name="work_duty" placeholder="请用150字左右说明当前招聘职位的职责，即主要是做什么方面的工作"></textarea> -->
              <textarea class="form-control" id="contentDuty" name="work_duty" rows="10" style="resize:none;" placeholder="请用150字左右说明当前招聘职位的职责，即主要是做什么方面的工作"></textarea>
            </div>
          </div>
        </div>
        <!-- 职位职责结束 -->
        <!-- 任职要求 -->
        <div class="alert alert-info col-md-12" role="alert" id="umessage">任职要求</div>
        <div class="col-md-12">
          <div class="col-md-offset-1 col-md-10">
            <div class="form-group">
              <textarea class="form-control" id="contentClaim" name="work_claim" rows="10" style="resize:none;" placeholder="请用150字左右对求职者的技术以及各种条件作出详细的说明，方便求职者正确选择就业职位"></textarea>
            </div>
          </div>
        </div>
        <!-- 任职要求结束 -->
        <!-- 企业介绍职责 -->
        <div class="alert alert-info col-md-12" role="alert" id="umessage">企业介绍</div>
        <div class="col-md-12">
          <div class="col-md-offset-1 col-md-10">
            <div class="form-group">
              <textarea class="form-control" rows="7" style="resize:none;" name="en_introduction" value="<?php echo ($enterprise['en_introduction']); ?>" placeholder="请用300字以上简单的介绍您的企业信息"><?php echo ($enterprise['en_introduction']); ?></textarea>
            </div>
          </div>
        </div>
        <!-- 企业介绍结束 -->
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px;">发布职位</button>
        </div>
      </form>
    </div>
  
      
    <div class="col-md-12" style="margin-top:20px;">
	<p class="text-center">地址: <?php echo ($sysInfo["footer_address"]); ?></p>
	<p class="text-center">版权所有: <?php echo ($sysInfo["footer_copyright"]); ?></p>
</div>
  
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="<?php echo ($path); ?>/js/jquery.min.js"></script>
   <!-- <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ($path); ?>/js/bootstrap.min.js"></script>
  </body>
</html>
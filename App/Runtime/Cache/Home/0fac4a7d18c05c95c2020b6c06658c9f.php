<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>企业信息设置-<?php echo ($sysInfo["title"]); ?></title>
  
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
    
    <script type="text/javascript">
      //获取select下拉框并添加选中事件
        // 省变化的时候自动加载市级城市
      $(function(){
        $("select[name='en_province']").change(function(){
          var ob = this;
          var pid=$("#province option:selected").attr('cid');
          // alert(pid);
          // die();
          var opt = "<option>请选择</option>";
          $("#city").empty();
          $("#city").append(opt);
          var opt = "<option>请选择</option>";
          $("#county").empty();
          $("#county").append(opt);
          $.ajax({
            type:"POST",             //发送方式
            url :"/ITrecruit/Home/Enterprise/doload",  //请求地址
            data:"pid="+pid,      //请求数据
            async:true,             //是否异步
            dataType:"json",        //响应数据类型
            success:function(data){ //成功回调函数
              if(data==null){
                  return;
              }
              //遍历结果，拼装下拉项
              var str = "";
              for(var i=0;i<data.length;i++){
                str +="<option cid='"+data[i].id+"' value='"+data[i].name+"'>";
                str +=data[i].name;
                str +="</option>";
              }
              //添加下拉项中
              $("select[name='en_city']").append(str);
            },
          });
        });
        // 市变化的时候自动加载县级城市
        $("select[name='en_city']").change(function(){
          var ob = this;
          var cid=$("#city option:selected").attr('cid');
          // alert(cid);
          // die();
          $("#county").empty();
          var op = "<option>请选择</option>";
          $("#county").append(op);
          $.ajax({
            type:"POST",             //发送方式
            url :"/ITrecruit/Home/Enterprise/doload",  //请求地址
            data:"pid="+cid,   //请求数据
            async:true,             //是否异步
            dataType:"json",        //响应数据类型
            success:function(data){ //成功回调函数
              if(data==null){
                  return;
              }
              //遍历结果，拼装下拉项
              var str = "";
              for(var i=0;i<data.length;i++){
                str +="<option cid='"+data[i].id+"' value='"+data[i].name+"'>";
                str +=data[i].name;
                str +="</option>";
              }
              //添加下拉项中
              $("select[name='en_county']").append(str);
            },
          });
        });
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
        <li role="presentation"><a href="<?php echo U('Home/Enterprise/index');?>">个人中心</a></li>
        <li role="presentation"><a href="<?php echo U('Home/EnApply/listApply');?>">招聘管理</a></li>
        <li role="presentation"><a href="<?php echo U('Home/DealResume/index');?>">简历管理</a></li>
        <li role="presentation" class="active"><a href="<?php echo U('Home/Enterprise/setEnInfo');?>">企业管理</a></li>
        <li role="presentation"><a href="<?php echo U('Home/Enterprise/updatePw');?>">修改密码</a></li>
      </ul>
    </div>
  
      
    <div class="col-md-9 resume-border" >
    <div class="online-resume">
      <h3>管理企业基本信息</h3>
    </div>
     <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="<?php echo U('Home/Enterprise/setEnInfo');?>">修改企业信息</a></li>
    </ul>
    <!-- 招聘职位基本信息 -->
    <form class="form-horizontal" action="<?php echo U('Home/Enterprise/saveEnInfo');?>" method="post" enctype="multipart/form-data">
      <div class="alert alert-info col-md-12" role="alert" id="umessage">基本信息</div>
      <div class="col-md-12">
        <div class=" col-md-offset-1 col-md-10">
          <div class="form-group">
            <label for="enNa" class="col-sm-2 control-label">*企业名称</label>
            <div class="col-sm-10">
              <input type="text" name="en_name" value="<?php echo ($enterprise["en_name"]); ?>" class="form-control" id="enNa" placeholder="请输入您的企业名称">
            </div>
          </div>
          <div class="form-group">
            <label for="enAd" class="col-sm-2 control-label">*企业地址</label>
            <div class="col-sm-10">
              <div class="col-md-4">
                <select class="form-control" name="en_province" id="province">
                  <option value="">请选择省份</option>
                  <?php if(is_array($provinceList)): $i = 0; $__LIST__ = $provinceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>" cid="<?php echo ($vo["id"]); ?>" <?php if($vo["name"] == $enterprise['en_province']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="en_city" id="city">
                  <option value="">请选择</option>
                  <?php if(is_array($cityList)): $i = 0; $__LIST__ = $cityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>" cid="<?php echo ($vo["id"]); ?>" <?php if($vo["name"] == $enterprise['en_city']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="en_county" id="county">
                  <option value="">请选择</option>
                  <?php if(is_array($countyList)): $i = 0; $__LIST__ = $countyList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>" cid="<?php echo ($vo["id"]); ?>" <?php if($vo["name"] == $enterprise['en_county']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="enDet" class="col-sm-2 control-label">*详细地址</label>
            <div class="col-sm-10">
              <input type="text" name="en_address_details" value="<?php echo ($enterprise["en_address_details"]); ?>" class="form-control" id="enDet" placeholder="请输入企业详细地址">
            </div>
          </div>
          <div class="form-group">
            <label for="enNat" class="col-sm-2 control-label">*企业性质</label>
            <div class="col-sm-4">
              <select class="form-control" name="en_nature" id="enNat">
                <!-- <option value="<?php echo ($enterprise["en_nature"]); ?>"><?php echo ($enterprise["en_nature"]); ?></option> -->
                <option value="">请选择企业规模</option>
                <option value="外商独资" <?php if($enterprise["en_nature"] == '外商独资'): ?>selected<?php endif; ?>>外商独资</option>
                <option value="中外合营" <?php if($enterprise["en_nature"] == '中外合营'): ?>selected<?php endif; ?>>中外合营</option>
                <option value="民营企业" <?php if($enterprise["en_nature"] == '民营企业'): ?>selected<?php endif; ?>>民营企业</option>
                <option value="国有企业" <?php if($enterprise["en_nature"] == '国有企业'): ?>selected<?php endif; ?>>国有企业</option>
                <option value="国内上市公司" <?php if($enterprise["en_nature"] == '国内上市公司'): ?>selected<?php endif; ?>>国内上市公司</option>
                <option value="政府机关" <?php if($enterprise["en_nature"] == '政府机关'): ?>selected<?php endif; ?>>政府机关</option>
                <option value="事业单位" <?php if($enterprise["en_nature"] == '事业单位'): ?>selected<?php endif; ?>>事业单位</option>
                <option value="公益组织" <?php if($enterprise["en_nature"] == '事业单位'): ?>selected<?php endif; ?>>公益组织</option>
                <option value="其他" <?php if($enterprise["en_nature"] == '其他'): ?>selected<?php endif; ?>>其他</option>
              </select>
            </div>
            <label for="enSc" class="col-sm-2 control-label">*企业规模</label>
            <div class="col-sm-4">
              <select class="form-control" name="en_scale" id="enSc">
                <!-- <option value="<?php echo ($enterprise["en_scale"]); ?>"><?php echo ($enterprise["en_scale"]); ?></option> -->
                <option value="">请选择企业规模</option>
                <option value="10人以下" <?php if($enterprise["en_scale"] == '10人以下'): ?>selected<?php endif; ?>>10人以下</option>
                <option value="10-50人" <?php if($enterprise["en_scale"] == '10-50人'): ?>selected<?php endif; ?>>10-50人</option>
                <option value="50-100人" <?php if($enterprise["en_scale"] == '50-100人'): ?>selected<?php endif; ?>>50-100人</option>
                <option value="100-300人" <?php if($enterprise["en_scale"] == '100-300人'): ?>selected<?php endif; ?>>100-300人</option>
                <option value="300人以上" <?php if($enterprise["en_scale"] == '300人以上'): ?>selected<?php endif; ?>>300人以上</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label  class="col-sm-2 control-label">*企业图标</label>
            <div class="col-sm-10 form-group">
              <label for="enphoto">
                <img src="<?php echo ($path); ?>/uploads/enterprise/photo/<?php echo ($enterprise["en_photo"]); ?>" title="请点击上传企业图标" alt="企业图标" class="img-thumbnail center-block" style="margin-bottom:-25px;margin-left:15px;">
                <input type="file" name="en_photo" id="enphoto" style="margin-top:5px;display:none;" class="col-md-7">
              </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">*企业亮点</label>
            <div class="col-sm-10">
              <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                请选择企业亮点标签
              </button>
              <div class="collapse" id="collapseExample">
                <div class="well">
                  <?php if(is_array($enAdvantage)): $i = 0; $__LIST__ = $enAdvantage;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox-inline" for="<?php echo ($vo["id"]); ?>" style="margin-left:10px;">
                      <input type="checkbox" name="en_advantages[]" id="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["id"]); ?>" <?php if(in_array($vo['id'],$enAdvantageArray)): ?>checked<?php endif; ?> ><?php echo ($vo["name"]); ?>
                    </label><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- 基本信息结束 -->
      <!-- 企业介绍 -->
      <div class="alert alert-info col-md-12" role="alert" id="umessage">企业介绍</div>
      <div class="col-md-12">
        <div class="col-md-offset-1 col-md-10">
          <div class="form-group">
            <textarea class="form-control" rows="10" style="resize:none;" name="en_introduction" id="enIntroduction" placeholder="请用300字以上简单的介绍您的企业信息"><?php echo ($enterprise["en_introduction"]); ?></textarea>
          </div>
        </div>
      </div>
      <!-- 企业介绍结束 -->
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px;">保存</button>
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
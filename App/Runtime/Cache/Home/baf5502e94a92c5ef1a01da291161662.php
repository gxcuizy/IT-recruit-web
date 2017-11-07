<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>求职者登录-<?php echo ($sysInfo["title"]); ?></title>
  
    <script type="text/javascript" src="<?php echo ($path); ?>/js/jquery-1.8.3.min.js"></script>
    <style type="text/css">
    body { padding-top:60px;overflow-y:scroll; }
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
      .form-group{
        margin-bottom:10px;
      }
      .form-group{
        margin-bottom:10px;
      }
      #info{
        margin-top:10px;
        color:red;
        width:190px;
        margin-left: auto;
        margin-right: auto;
      }
    </style>
    <script src="<?php echo ($path); ?>/js/jquery-1.8.3.min.js"></script>
    
    <!-- Bootstrap -->
    <link href="<?php echo ($path); ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="background-color:#f6f6f6;">
    <!-- 导航开始 -->
    
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
  
    <!-- 导航结束 -->
    <!-- 页面主体  -->
    <div class="container" style="margin-top:10px;">
      
    <div class="panel panel-default">
      <div class="panel-body" style="margin-top:100px;margin-bottom:100px;">
        <div class="login-title text-center">
          <h3>欢迎您登录IT招聘网~求职者账号</h3>
        </div>
        <form action="<?php echo U('Home/Login/checkJobLogin');?>" method="post" class="col-md-offset-4 col-md-4">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
              <input type="text" id="username" name="contact" class="form-control" value="" placeholder="请输入您的手机号码">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" id="password" name="password" class="form-control" placeholder="请输入您的密码">
            </div>
          </div>
          <span align="center" class="center-block" style="color:red;margin-bottom:10px;"><?php echo ($errorinfo); ?></span>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4 ">
              <button type="submit" class="btn btn-sm btn-info col-md-12">登录</button>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 link">
              <p class="text-center remove-margin"><small>忘记密码？</small> <a href="<?php echo U('Home/Register/retrieveJobPw');?>" ><small>找回</small></a>
              </p>
            </div>
            <div class="col-md-6 link">
              <p class="text-center remove-margin"><small>没有账号?</small> <a href="<?php echo U('Home/Register/jobRegister');?>" ><small>马上注册</small></a>
              </p>
            </div>
          </div>
        </form>
      </div>
    </div>
  
      <!-- 底部版权 -->
      
    <div class="col-md-12" style="margin-top:20px;">
	<p class="text-center">地址: <?php echo ($sysInfo["footer_address"]); ?></p>
	<p class="text-center">版权所有: <?php echo ($sysInfo["footer_copyright"]); ?></p>
</div>
  
      <!-- 底部版权结束 -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="<?php echo ($path); ?>/js/jquery.min.js"></script>
    <!-- <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ($path); ?>/js/bootstrap.min.js"></script>
  </body>
</html>
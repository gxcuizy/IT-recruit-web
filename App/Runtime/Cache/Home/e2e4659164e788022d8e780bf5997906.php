<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>收藏列表-<?php echo ($sysInfo["title"]); ?></title>
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
          <img src="<?php echo ($path); ?>/uploads/jobhunter/photo/<?php echo ($_SESSION['ITUser']['photo']); ?>" alt="头像" class="img-circle center-block" width="150" height="150">
          <p class="text-muted text-center" style="margin-top:10px;"><strong><?php echo ($_SESSION['ITUser']['username']); ?></strong></p>
        </div>
        <ul class="nav nav-pills nav-stacked">
          <li role="presentation"><a href="<?php echo U('Home/Jobhunter/index');?>">个人简历</a></li>
          <li role="presentation"><a href="<?php echo U('Home/Jobhunter/applyList');?>">职位管理</a></li>
          <li role="presentation" class="active"><a href="<?php echo U('Home/Jobhunter/favoritesJob');?>">收藏列表</a></li>
          <li role="presentation"><a href="<?php echo U('Home/Jobhunter/updatePw');?>">修改密码</a></li>
        </ul>
      </div>
    
      
      <div class="col-md-9 resume-border">
        <div class="online-resume">
          <h3>个人收藏职位管理</h3>
        </div>
        <!-- 简历右边导航选项卡 -->
        <ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="<?php echo U('Home/Jobhunter/favoritesJob');?>">收藏的职位</a></li>
        </ul>
        <!-- 简历右边导航选项卡结束 -->
        <!-- 基本信息 -->
        <div class="panel panel-default table-responsive" style="border-top:0;padding-bottom:25px;">
          <div class="panel-heading" style="position:relative;top:20px;left:20px;width:95%;">
            <span class="glyphicon glyphicon-heart"> <strong>我收藏的职位</strong></span>
          </div>
          <table class="table" style="position:relative;top:20px;left:20px;width:95%;">
            <thead>
              <tr>
                <th>职位名称</th>
                <th>所属企业</th>
                <th>招聘类型</th>
                <th>工作地点</th>
                <th>月薪</th>
                <th>收藏时间</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><a href="<?php echo U('Home/Apply/applyDetails','id='.$vo['aid']);?>" target="_blank"><?php echo ($vo["job_name"]); ?></a></td>
                    <td><?php echo ($vo["en_name"]); ?></td>
                    <td>
                        <?php switch($vo["apply_type"]): case "0": ?>技术类型<?php break;?>
                          <?php case "1": ?>产品类型<?php break;?>
                          <?php case "2": ?>设计类型<?php break;?>
                          <?php case "3": ?>运营类型<?php break; endswitch;?>
                    </td>
                    <td><?php echo ($vo["work_province"]); echo ($vo["work_city"]); ?></td>
                    <td><?php echo ($vo["salary"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$vo["collection_time"])); ?></td>
                    <td><a href="<?php echo U('Home/Jobhunter/delCollection','id='.$vo['id']);?>">删除</a></td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              <tr>
                <td>
                  收藏职位总数：<?php echo ($count); ?>
                </td>
                 <td colspan="6" align="right">
                  <a href="<?php echo U('Jobhunter/favoritesJob',array('page'=>($page-1)));?>">上一页</a>
                  <a href="<?php echo U('Jobhunter/favoritesJob',array('page'=>($page+1)));?>"> 下一页</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- 基本信息面板结束 -->
        
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
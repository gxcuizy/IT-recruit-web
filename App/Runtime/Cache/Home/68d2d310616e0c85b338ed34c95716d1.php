<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>招聘信息详情-<?php echo ($sysInfo["title"]); ?></title>
  
    
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
        .text-muted a:hover{
            text-decoration: none;
            color:#777777;
        }
        .text-muted a{
            color:#777777;
        }
      </style>
    <script src="<?php echo ($path); ?>/js/jquery-1.8.3.min.js"></script>
    
    
    <!-- Bootstrap -->
    <link href="<?php echo ($path); ?>/css/bootstrap.min.css" rel="stylesheet" />
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
    <div class="container">
      <!-- 页面主体头部 -->
      
      <!-- 页面主体头部结束 -->
      <div class="row">
        <!-- 页面主内容 -->
        
    <div class="col-md-9">
    <!-- 工作名称显示 -->
    <div class="panel panel-default">
      <div class="panel-body">
        <p class="bg-primary" style="padding-left:15px;">
          <span style="font-size:25px;"><?php echo ($applyDetails["job_name"]); ?></span>
          <?php if(isset($collected)): ?><a type="button" class="btn btn-warning pull-right" style="margin:13px 10px 0 0;"><span class="glyphicon glyphicon-heart-empty"><strong><?php echo ($collected); ?></strong></span></a>
          <?php else: ?>
            <a type="button" class="btn btn-warning pull-right" style="margin:13px 10px 0 0;" href="<?php echo U('Home/Apply/collectApply/','aid='.$applyDetails['id']);?>"><span class="glyphicon glyphicon-heart-empty"><strong>收藏</strong></span></a><?php endif; ?>
          <?php if(isset($applyed)): ?><a type="button" class="btn btn-warning pull-right" style="margin:13px 10px 0 0;"><span class="glyphicon glyphicon-check"><strong><?php echo ($applyed); ?></strong></span></a>
          <?php else: ?>
            <a type="button" class="btn btn-warning pull-right" style="margin:13px 10px 0 0;" href="<?php echo U('Home/Apply/sendResume/','aid='.$applyDetails['id']);?>"><span class="glyphicon glyphicon-check"><strong>投递简历</strong></span></a><?php endif; ?>
          <br />
          <span style="font-size:17px;"><?php echo ($applyDetails["en_name"]); ?></span>
        </p>
      </div>
      <div class="panel-body">
        <span class="glyphicon glyphicon-map-marker">工作地点：<?php echo ($applyDetails["work_province"]); echo ($applyDetails["work_city"]); ?>　</span>
        <span class="glyphicon glyphicon-time">发布于：<?php echo (date("Y-m-d H:i:s",$applyDetails["publish_time"])); ?>　</span>
        <span class="glyphicon glyphicon-yen">月薪：<?php echo ($applyDetails["salary"]); ?>　</span>
      </div>
      <div class="panel-body">
        <ul class="list-inline">
          <li>学历要求：<?php echo ($applyDetails["education_claim"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;|</li>
          <li>工作经历要求：<?php echo ($applyDetails["job_experience"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;|</li>
          <li>年龄要求：<?php echo ($applyDetails["age_claim"]); ?></li>
        </ul>
      </div>
      <div class="panel-body">
        <ul class="list-inline">
          <?php if(is_array($workAdvantagesArr)): $i = 0; $__LIST__ = $workAdvantagesArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="margin-bottom:10px;"><button type="button" class="btn btn-info"><?php echo ($vo); ?></button></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
      <table class="table table-striped">
        <tr>
          <th>职位职责</th>
        </tr>
        <tr>
          <td><?php echo html_entity_decode($applyDetails['work_duty']);?></td>
        </tr>
        <tr>
          <th>任职要求</th>
        </tr>
        <tr>
          <td><?php echo html_entity_decode($applyDetails['work_claim']);?></td>
        </tr>
        <tr>
          <th>企业介绍</th>
        </tr>
        <tr>
          <td><?php echo ($applyDetails["en_introduction"]); ?></td>
        </tr>
      </table>
    </div>
    <!-- 工作名称和单位结束 -->
    </div>
  
        <!-- 页面主内容结束 -->
        <!-- 右边分栏 -->
        
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">职位发布企业</div>
        <div class="panel-body">
          <a href="<?php echo U('Home/EnterpriseList/enterprise/','id='.$enterpriseDetails['id']);?>" target="_blank"><img src="<?php echo ($path); ?>/uploads/enterprise/photo/<?php echo ($enterpriseDetails["en_photo"]); ?>" alt="" class="img-thumbnail"></a>
          <h4><?php echo ($enterpriseDetails["en_name"]); ?></h4>
          <span>规模：<?php echo ($enterpriseDetails["en_scale"]); ?></span><br />
          <span>性质：<?php echo ($enterpriseDetails["en_nature"]); ?></span><br />
          <span>地址：<?php echo ($enterpriseDetails["en_province"]); echo ($enterpriseDetails["en_address_details"]); ?></span>
        </div>
      </div>
    </div>
  
        <!-- 右边分栏结束 -->
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
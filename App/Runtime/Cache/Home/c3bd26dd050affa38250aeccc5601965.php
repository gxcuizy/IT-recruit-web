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
      .text-muted a:hover{
        text-decoration: none;
        color:#777777;
      }
      .text-muted a{
        color:#777777;
      }
      DIV.meneame {
        PADDING-RIGHT: 3px; PADDING-LEFT: 3px; FONT-SIZE: 20px; PADDING-BOTTOM: 3px; MARGIN: 3px; COLOR: #337AB7; PADDING-TOP: 3px; TEXT-ALIGN: center
      }
      DIV.meneame A {
        BORDER-RIGHT: #DDDDDD 1px solid; PADDING-RIGHT: 10px; BACKGROUND-POSITION: 50% bottom; BORDER-TOP: #DDDDDD 1px solid; PADDING-LEFT: 10px;  PADDING-BOTTOM: 5px; BORDER-LEFT: #DDDDDD 1px solid; COLOR: #337AB7; MARGIN-RIGHT: 3px; PADDING-TOP: 5px; BORDER-BOTTOM: #DDDDDD 1px solid; TEXT-DECORATION: none
      }
      DIV.meneame A:hover {
        BORDER-RIGHT: #DDDDDD 1px solid; BORDER-TOP: #DDDDDD 1px solid; BACKGROUND-IMAGE: none; BORDER-LEFT: #DDDDDD 1px solid; COLOR: #337AB7; BORDER-BOTTOM: #DDDDDD 1px solid; BACKGROUND-COLOR: #F5F5F5
      }
      DIV.meneame A:active {
        BORDER-RIGHT: #DDDDDD 1px solid; BORDER-TOP: #DDDDDD 1px solid; BACKGROUND-IMAGE: none; BORDER-LEFT: #DDDDDD 1px solid; COLOR: #337AB7; BORDER-BOTTOM: #DDDDDD 1px solid; BACKGROUND-COLOR: #F5F5F5
      }
      DIV.meneame SPAN.current {
        BORDER-RIGHT: #DDDDDD 1px solid; PADDING-RIGHT: 12px; BORDER-TOP: #DDDDDD 1px solid; PADDING-LEFT: 12px; FONT-WEIGHT: bold; PADDING-BOTTOM: 7px; BORDER-LEFT: #DDDDDD 1px solid; COLOR: #ffffff; MARGIN-RIGHT: 3px; PADDING-TOP: 7px; BORDER-BOTTOM: #DDDDDD 1px solid; BACKGROUND-COLOR: #337AB7
      }
      DIV.meneame SPAN.disabled {
        BORDER-RIGHT: #ffe3c6 1px solid; PADDING-RIGHT: 7px; BORDER-TOP: #ffe3c6 1px solid; PADDING-LEFT: 7px; PADDING-BOTTOM: 5px; BORDER-LEFT: #ffe3c6 1px solid; COLOR: #ffe3c6; MARGIN-RIGHT: 3px; PADDING-TOP: 5px; BORDER-BOTTOM: #ffe3c6 1px solid
      }
    </style>
  
    
    <!-- Bootstrap -->
    <link href="<?php echo ($path); ?>/css/bootstrap.min.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
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
      
    <?php $kw = $_GET['kw']; ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row" style="margin-top:10px;">
          <div class="col-lg-10">
            <form action="<?php echo U('Home/EnterpriseList/index');?>" method="get">
            <div class="input-group">
              <input type="text" name="kw" value="<?php echo ($kw); ?>" class="form-control" placeholder="请输入企业名称：如兄弟连IT教育等" style="border:2px solid #286090;">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                  搜索</button>
              </span>
            </div><!-- /input-group -->
          </form>
          </div><!-- /.col-lg-6 -->
        </div>
        <!-- 热门关键字 -->
        <div class="row">
          <p class="text-muted" style="margin:10px 0 0px 20px;">热门搜索：
              <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Home/EnterpriseList/index',array('kw'=>$hot['hot_name']));?>"><?php echo ($hot["hot_name"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
          </p>
        </div>
      </div>
    </div>
  
      <!-- 页面主体头部结束 -->
      <div class="row">
        <!-- 页面主内容 -->
        
      <div class="col-md-9">
        <!-- 标题导航筛选栏 -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <span>为您找到 <b><?php echo ($EnterpriseListCount); ?></b> 家企业</span>
            <div class="btn-group pull-right" style="margin-top:-6px;">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ($_GET['en_nature']?$_GET['en_nature']:企业性质); ?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'外商独资'));?>">外商独资</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'中外合营'));?>">中外合营</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'民营企业'));?>">民营企业</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'国有企业'));?>">国有企业</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'国内上市公司'));?>">国内上市公司</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'政府机关'));?>">政府机关</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'事业单位'));?>">事业单位</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'公益组织'));?>">公益组织</a></li>
                <li><a href="<?php echo U('Home/EnterpriseList/index',array('en_nature'=>'其他'));?>">其他</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- 标题状态栏结束 -->
        <div class="col-md-12">
          <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-4">
              <div class="thumbnail">
                <img src="<?php echo ($path); ?>/uploads/enterprise/photo/<?php echo ($vo["en_photo"]); ?>" alt="...">
                <div class="caption">
                  <h3><a href="<?php echo U('Home/EnterpriseList/enterprise','id='.$vo['id']);?>"><?php echo ($vo["en_name"]); ?></a></h3>
                  <div style="text-overflow:ellipsis;overflow:hidden;height:57px;"><?php echo ($vo["en_introduction"]); ?></div>
                </div>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- 分页  -->
         <div class="meneame">
          <?php echo ($page); ?>
        </div> 
        <!-- 分页结束 -->
      </div>
    
        <!-- 页面主内容结束 -->
        <!-- 右边分栏 -->
        
      <div class="col-md-3 visible-md-block visible-lg-block">
        <div class="list-group">
          <?php if(is_array($broList)): $i = 0; $__LIST__ = $broList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bro): $mod = ($i % 2 );++$i;?><a href="<?php echo ($bro["url"]); ?>" class="list-group-item" target="_blank">
              <img src="/ITrecruit/Public/Admin/uploads/broen/logo/<?php echo ($bro["logo"]); ?>" title="<?php echo ($bro["en_name"]); ?>" alt="企业图标">
            </a><?php endforeach; endif; else: echo "" ;endif; ?>
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
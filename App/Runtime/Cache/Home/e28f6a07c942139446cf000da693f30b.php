<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>简历列表-<?php echo ($sysInfo["title"]); ?></title>
    
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
      
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row" style="margin-top:10px;">
              <div class="col-lg-10">
                <form method="get" action="<?php echo U('Resume/index');?>">
                  <div class="input-group">
                      <input type="text" name="kw" class="form-control" placeholder="请输入姓名进行搜索：如小明等" style="border:2px solid #286090;" value="<?php echo ($_GET['kw']); ?>">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                          <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                          搜索</button>
                      </span>
                  </div>
                </form>
                <!-- /input-group -->
              </div><!-- /.col-lg-6 -->
            </div>
            <!-- 热门关键字 -->
            <div class="row hidden-xs">
              <p class="text-muted" style="margin:10px 0 0px 20px;">热门搜索:
                <?php if(is_array($hotRe)): $i = 0; $__LIST__ = $hotRe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotRe): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Resume/index',array('kw'=>$hotRe['hot_name']));?>" style="margin-right:10px"><?php echo ($hotRe["hot_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
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
              <span>为您找到 <b><?php echo ($count); ?></b> 份简历</span>
              <div class="btn-group pull-right hidden-xs" style="margin-top:-6px;">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ($_GET['education']?$_GET['education']:请选择学历); ?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu ">
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'博士'));?>">博士</a></li>
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'研究生'));?>">研究生</a></li>
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'本科'));?>">本科</a></li>
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'专科'));?>">专科</a></li>
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'高中'));?>">高中</a></li>
                  <li><a href="<?php echo U('Home/Resume/index',array('education'=>'高中以下'));?>">高中以下</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- 职位列表 -->
          <div class="table-responsive">
            <table class="table  table-hover table-responsive" style="border-bottom:1px solid #ddd;">
              <thead>
                <tr class="success">
                  <th>简历照片</th>
                  <th>姓名</th>
                  <th>年龄</th>
                  <th>性别</th>
                  <th>学历</th>
                  <th>期望职位</th>
                  <th>工作状态</th>
                </tr>
              </thead>
              <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td style="height:50px;line-height:50px;"><a href="<?php echo U('Resume/details',array('id'=>$vo['id']));?>"><img class="media-object" src="<?php echo ($path); ?>/uploads/jobhunter/photo/<?php echo ($vo["photo"]); ?>" alt="简历头像" width="50" /></a></td>
                    <td style="height:50px;line-height:50px;"><?php echo ($vo["name"]); ?></td>
                    <td style="height:50px;line-height:50px;"><?php echo ($vo["age"]); ?></td>
                    <td style="height:50px;line-height:50px;"><?php if($vo["sex"] == 0): ?>女<?php else: ?>男<?php endif; ?></td>
                    <td style="height:50px;line-height:50px;"><?php echo ($vo["education"]); ?></td>
                    <td style="height:50px;line-height:50px;"><?php echo ($vo["love_job"]); ?></td>
                    <td style="height:50px;line-height:50px;">
                      <?php switch($vo["work_status"]): case "0": ?>在职，看看新机会<?php break;?>
                        <?php case "1": ?>在职，急寻新工作<?php break;?>
                        <?php case "2": ?>在职，暂无跳槽打算<?php break;?>
                        <?php case "3": ?>离职，正在找工作<?php break; endswitch;?>
                    </td>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              </tbody>
            </table>
          </div>
          <!-- 职位列表结束 -->
          <!-- 分页  -->
           <div class="meneame">
              <?php echo ($page); ?>
          </div> 
          <!-- 分页结束 -->
        </div>
      
        <!-- 页面主内容结束 -->
        <!-- 右边分栏 -->
        
        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-heading"><strong>本网站推荐简历</strong></div>
            <div class="panel-body">
              <?php if(is_array($ll)): $i = 0; $__LIST__ = $ll;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="media">
                  <div class="media-left">
                    <a href="<?php echo U('Resume/details',array('id'=>$vo['id']));?>">
                      <img class="media-object" src="<?php echo ($path); ?>/uploads/jobhunter/photo/<?php echo ($vo["photo"]); ?>" alt="..." width="90">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">姓名：<?php echo ($vo["name"]); ?></h4>
                    <div>性别：<?php if($vo["sex"] == 0): ?>女<?php else: ?>男<?php endif; ?></div>
                    <div>年龄：<?php echo ($vo["age"]); ?></div>
                    <div>学历：<?php echo ($vo["education"]); ?></div>
                  </div>
                </div>
                <hr /><?php endforeach; endif; else: echo "" ;endif; ?>
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
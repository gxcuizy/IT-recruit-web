<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title>招聘信息列表-<?php echo ($sysInfo["title"]); ?></title>
  
    
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
    
     <script type="text/javascript">
      $(function(){
        $(".pagination li a").mousemove(function(){
          var ds = $(this).parent().attr('class');
          if(ds == 'disabled' || ds == 'active'){
            // 当前页和禁止点击的上一页和下一页不可触发
          }else{
            $(this).css("cursor","pointer");
            $(this).parent().addClass('active');
            $(this).parent().attr('a','b');
          }
        }).mouseout(function(){
          var getb = $(this).parent().attr('a');
          if(getb == 'b'){
            $(this).css("cursor","");
            $(this).attr("a","");
            $(this).parent().removeClass('active');
          }
        });
      });
    </script>
  
    
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
    <?php $jt = $_GET['jt']; ?>
    <?php $at = $_GET['at']; ?>
    <?php $sl = $_GET['sl']; ?>
    <?php $t = $_GET['t']; ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row" style="margin-top:10px;">
          <div class="col-lg-10">
            <form action="<?php echo U('Home/Apply/index');?>" method="get" id="search">
              <div class="input-group">
                <input type="text" name="kw" class="form-control" placeholder="请输入职位名称：如PHP高级工程师等" style="border:2px solid #286090;" value="<?php echo ($kw); ?>">
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
          <p class="text-muted" style="margin:10px 0 0px 20px;">热门搜索：
              <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Home/Apply/index/',array('kw'=>$hot['hot_name'],'jt'=>$jt,'at'=>$at));?>"><?php echo ($hot["hot_name"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
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
          <span>为您找到<strong> <?php echo ($applyCount); ?> </strong>个招聘职位</span>
          <div class="btn-group pull-right hidden-xs" style="margin-top:-7px;">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo ($sl?$sl:'月薪不限'); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t));?>">月薪不限</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t,'sl'=>'1000-3000'));?>">1000-3000</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t,'sl'=>'3000-5000'));?>">3000-5000</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t,'sl'=>'5000-7000'));?>">5000-7000</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t,'sl'=>'7000-10000'));?>">7000-10000</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'t'=>$t,'sl'=>'10000+'));?>">10000+</a></li>
            </ul>
          </div>
          <div class="btn-group pull-right hidden-xs" style="margin-top:-7px;margin-right:15px;">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <?php echo ($t?$t:'发布时间不限'); ?> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'sl'=>$sl));?>">发布时间不限</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'sl'=>$sl,'t'=>'一天内'));?>">一天内</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'sl'=>$sl,'t'=>'三天内'));?>">三天内</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'sl'=>$sl,'t'=>'一周内'));?>">一周内</a></li>
              <li><a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'sl'=>$sl,'t'=>'一个月内'));?>">一个月内</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table  table-hover" style="border-bottom:1px solid #ddd;">
          <thead>
            <tr class="success">
              <th>招聘职位名称</th>
              <th>发布招聘企业</th>
              <th>工作地点</th>
              <th>发布时间</th>
              <th>月薪</th>
            </tr>
          </thead>
          <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><a href="<?php echo U('Home/Apply/applyDetails/','id='.$vo['id']);?>"><?php echo ($vo["job_name"]); ?></a></td>
                <td><?php echo ($vo["en_name"]); ?></td>
                <td><?php echo ($vo["work_province"]); ?>-<?php echo ($vo["work_city"]); ?></td>
                <td><?php echo (date("Y-m-d",$vo["publish_time"])); ?></td>
                <td><span class="glyphicon glyphicon-yen"></span><?php echo ($vo["salary"]); ?></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
          </tbody>
        </table>
      </div>
      <!-- 职位列表结束 -->
      <!-- 分页  -->
      <div class="row">
        <nav class="text-center col-md-12" style="margin-top:-15px;">
          <ul class="pagination">
            <?php if(($page) == "1"): ?><li class="disabled">
              <a href="#">
                <span aria-hidden="true">上一页</span>
              </a>
            </li>
            <?php else: ?>
              <li>   
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($page-1),'sl'=>$sl,'t'=>$t));?>">
                  <span aria-hidden="true">上一页</span>
                </a>
              </li><?php endif; ?>
            <!-- 页码小于8 -->            
            <?php if(($pageCount) < "8"): $__FOR_START_12252__=1;$__FOR_END_12252__=$pageCount+1;for($i=$__FOR_START_12252__;$i < $__FOR_END_12252__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } endif; ?>
            <!-- 页数为8、9 -->
            <?php if(($pageCount > 7) AND ($pageCount < 10) AND ($page > 5)): ?><li <?php if(($page) == "1"): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>1,'sl'=>$sl,'t'=>$t));?>">1</a>
              </li>
              <li>
                <a href="#">...</a>
              </li>              
              <?php $__FOR_START_6373__=$pageCount-5;$__FOR_END_6373__=$pageCount+1;for($i=$__FOR_START_6373__;$i < $__FOR_END_6373__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } ?>
            <?php elseif(($pageCount > 7) AND ($pageCount < 10) AND ($page < 6)): ?>         
              <?php $__FOR_START_4026__=1;$__FOR_END_4026__=7;for($i=$__FOR_START_4026__;$i < $__FOR_END_4026__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } ?>
              <li>
                <a href="#">...</a>
              </li>
              <li <?php if(($page) == $pageCount): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>$pageCount,'sl'=>$sl,'t'=>$t));?>"><?php echo ($pageCount); ?></a>
              </li><?php endif; ?>
            <!-- 页码为大于等于10 -->
            <?php if(($pageCount > 9) AND ($page < 6)): $__FOR_START_3691__=1;$__FOR_END_3691__=7;for($i=$__FOR_START_3691__;$i < $__FOR_END_3691__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } ?>
              <li>
                <a href="#">...</a>
              </li>
              <li <?php if(($page) == $pageCount): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>$pageCount,'sl'=>$sl,'t'=>$t));?>"><?php echo ($pageCount); ?></a>
              </li>    
            <?php elseif(($pageCount > 9) AND (($pageCount-$page) > 3)): ?>
              <li <?php if(($page) == "1"): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>1,'sl'=>$sl,'t'=>$t));?>">1</a>
              </li>
              <li>
                <a href="#">...</a>
              </li>
              <?php $__FOR_START_28104__=($page-2);$__FOR_END_28104__=($page+3);for($i=$__FOR_START_28104__;$i < $__FOR_END_28104__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } ?>
              <li>
                <a href="#">...</a>
              </li>
              <li <?php if(($page) == $pageCount): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>$pageCount,'sl'=>$sl,'t'=>$t));?>"><?php echo ($pageCount); ?></a>
              </li>
            <?php elseif(($pageCount > 9) AND (($pageCount-$page) < 4)): ?>
              <li <?php if(($page) == "1"): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>1,'sl'=>$sl,'t'=>$t));?>">1</a>
              </li>
              <li>
                <a href="#">...</a>
              </li>
              <?php $__FOR_START_24161__=($pageCount-5);$__FOR_END_24161__=($pageCount);for($i=$__FOR_START_24161__;$i < $__FOR_END_24161__;$i+=1){ ?><li <?php if(($i) == $page): ?>class="active"<?php endif; ?>>
                  <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($i),'sl'=>$sl,'t'=>$t));?>"><?php echo ($i); ?></a>
                </li><?php } ?>              
              <li <?php if(($page) == $pageCount): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>$pageCount,'sl'=>$sl,'t'=>$t));?>"><?php echo ($pageCount); ?></a>
              </li><?php endif; ?>
            <?php if(($page == $pageCount) OR ($pageCount == '0')): ?><li class="disabled">
              <a href="#">
                <span aria-hidden="true">下一页</span>
              </a>
            </li>
            <?php else: ?>
              <li>
                <a href="<?php echo U('Home/Apply/index/',array('kw'=>$kw,'jt'=>$jt,'at'=>$at,'page'=>($page+1),'sl'=>$sl,'t'=>$t));?>">
                  <span aria-hidden="true">下一页</span>
                </a>
              </li><?php endif; ?>
          </ul>
        </nav>
      </div>
      <!-- 分页结束 -->
    </div>
  
        <!-- 页面主内容结束 -->
        <!-- 右边分栏 -->
        
    <div class="col-md-3  visible-md-block visible-lg-block">
      <div class="list-group">
        <?php if(is_array($broList)): $i = 0; $__LIST__ = $broList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bro): $mod = ($i % 2 );++$i;?><a href="<?php echo ($bro["url"]); ?>" class="list-group-item" target="_blank">
            <img src="/ITrecruit/Public/Admin/uploads/broen/logo/<?php echo ($bro["logo"]); ?>" title="<?php echo ($bro["en_name"]); ?>" alt="企业图标" />
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
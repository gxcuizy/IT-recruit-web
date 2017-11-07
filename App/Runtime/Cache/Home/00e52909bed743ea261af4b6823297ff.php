<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Home'; ?>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
    <script src="<?php echo ($path); ?>/js/jquery-1.8.3.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    
    <title><?php echo ($sysInfo["title"]); ?>-欢迎您</title>
  
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
    </style>
    <script type="text/JavaScript">
      $(function(){
          $("#input").focus(function(){
              $("#did").css({display:'block'});
          })
          $("body").click(function(event) {
              if (event.target.id != "input") {
                  $("#did").css({display:'none'});
              }
          });
      });
    </script>
    
    <script type="text/javascript">
      $(function(){
        $("#type").change(function(){
          var type=$("#type option:selected").val();
          if(type=='0'){
            $("#job").css("display","block");
            $("#ent").css("display","none");
            $("#resume").css("display","none");
            $("#myform").attr("action","<?php echo U('Apply/index');?>");
            $("#input").attr("placeholder","请输入职位名称：如PHP高级工程师等");
          }else if(type=='1'){
            $("#ent").css("display","block");
            $("#job").css("display","none");
            $("#resume").css("display","none");
            $("#myform").attr("action","<?php echo U('EnterpriseList/index');?>");
            $("#input").attr("placeholder","请输入企业名称：如兄弟连IT教育等");
          }else if(type=='2'){
            $("#resume").css("display","block");
            $("#ent").css("display","none");
            $("#job").css("display","none");
            $("#myform").attr("action","<?php echo U('Resume/index');?>");
            $("#input").attr("placeholder","请输入简历姓名：如马尧等");
          }
        });
      });
    </script>
  
    <!-- Bootstrap -->
    <link href="<?php echo ($path); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ($path); ?>/css/index.css" rel="stylesheet">
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
  
    
    <div class="container-fluid" style="background-color:#eeeeee;">
      <div class="container">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php if(is_array($litt)): $i = 0; $__LIST__ = $litt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if($vv["img_position"] == 0): ?><div class="item active">
                  <img src="<?php echo ($path); ?>/uploads/slides/<?php echo ($vv["image"]); ?>" alt="<?php echo ($vv["img_content"]); ?>">
                  <div class="carousel-caption">
                    <h3><?php echo ($vv["img_title"]); ?></h3>
                  </div>
                </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <?php if(is_array($litt)): $i = 0; $__LIST__ = $litt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i; if(($vv["img_position"] > 0) AND ($vv["img_position"] < 3)): ?><div class="item">
                <img src="<?php echo ($path); ?>/uploads/slides/<?php echo ($vv["image"]); ?>" style="height:300px;width:1140px" alt="<?php echo ($vv["img_content"]); ?>">
                <div class="carousel-caption">
                  <h3><?php echo ($vv["img_title"]); ?></h3>
                </div>
              </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  
    <div class="container">
      
    <div class="row" style="margin-top:20px;">
      <div class="col-lg-9">
        <form action="<?php echo U('Apply/index');?>" method="get" id="myform">
          <div class="input-group input-group-lg">
            <input type="text" name="kw" class="form-control" id="input" placeholder="请输入职位关键词：如PHP高级工程师等"/>
            <span class="input-group-btn input-group-lg">
              <select name="type" style="width:111px;" class="form-control" id="type">
                <option value="0" selected>按职位</option>
                <option value="1">按企业</option>
                <option value="2">按简历</option>
              </select>
            </span>
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              搜索</button>
            </span>
          </div>
        </form>
      </div>
      <div class="col-lg-3 visible-lg-block">
        <div class="panel panel-info">
          <div class="panel-body">
          本网站在招职位<strong> <?php echo ($count); ?> </strong>个
          </div>
        </div>
      </div>
    </div>
    <!-- 热门关键字 -->
    <div class="row visible-md-block visible-lg-block">
      <p class="text-muted" style="margin:-20px 0 10px 20px;" id="job">热门职位搜索：
          <?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Apply/index',array('kw'=>$hot['hot_name']));?>"><?php echo ($hot["hot_name"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
      </p>
      <p class="text-muted" style="margin:-20px 0 10px 20px;display:none;" id="ent">热门企业搜索：
          <?php if(is_array($hotEn)): $i = 0; $__LIST__ = $hotEn;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotEn): $mod = ($i % 2 );++$i;?><a href="<?php echo U('EnterpriseList/index',array('kw'=>$hotEn['hot_name']));?>"><?php echo ($hotEn["hot_name"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
      </p>
      <p class="text-muted" style="margin:-20px 0 10px 20px;display:none;" id="resume">热门简历搜索：
          <?php if(is_array($hotRe)): $i = 0; $__LIST__ = $hotRe;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotRe): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Resume/index',array('kw'=>$hotRe['hot_name']));?>"><?php echo ($hotRe["hot_name"]); ?>&nbsp;&nbsp;&nbsp;</a><?php endforeach; endif; else: echo "" ;endif; ?>
      </p>
    </div>
    <!-- 职业关键字 -->
    <div id="did" style="display:none;" class="panel panel-default">
        <div>
            <div>技术类:</div>
            <?php if(is_array($type0)): $i = 0; $__LIST__ = $type0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type0): $mod = ($i % 2 );++$i;?><div><a href="<?php echo U('Apply/index',array('jt'=>$type0['name']));?>"><?php echo ($type0["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div>
            <div>产品类:</div>
            <?php if(is_array($type1)): $i = 0; $__LIST__ = $type1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type1): $mod = ($i % 2 );++$i;?><div><a href="<?php echo U('Apply/index',array('jt'=>$type1['name']));?>"><?php echo ($type1["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div>
            <div>设计类:</div>
            <?php if(is_array($type2)): $i = 0; $__LIST__ = $type2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type2): $mod = ($i % 2 );++$i;?><div><a href="<?php echo U('Apply/index',array('jt'=>$type2['name']));?>"><?php echo ($type2["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div>
            <div>运营类:</div>
            <?php if(is_array($type3)): $i = 0; $__LIST__ = $type3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type3): $mod = ($i % 2 );++$i;?><div><a href="<?php echo U('Apply/index',array('jt'=>$type3['name']));?>"><?php echo ($type3["name"]); ?></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-- 搜索框结束 -->
  
      
    <!-- 职位推荐标题 -->
    <div class="row">
        <h3 style="margin-left:20px;"><span class="glyphicon glyphicon-screenshot">最新职位推荐</span></h3>
    </div>
    <!-- 职位推荐标题结束 -->
    <!-- 各行业招聘模板 -->
    <div class="row">
      <!-- 技术模块 -->
      <div class="col-md-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><strong>技术类招聘（<?php echo ($applyCount0); ?>个职位）</strong><span style="float:right;"><a href="<?php echo U('/Apply/index',array('at'=>0));?>">更多</a></span></div>
          <!-- Table -->
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>职位名称</th>
                <th>公司名称</th>
                <th>薪资</th>
                <th>发布时间</th>
              </tr>
              <?php if(is_array($list0)): $i = 0; $__LIST__ = $list0;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["apply_type"] == '0') AND ($vo["apply_status"] == '0')): ?><tr>
                    <td><a href="<?php echo U('Home/Apply/applyDetails','id='.$vo['id']);?>"><?php echo ($vo["job_name"]); ?></a></td>
                    <td><a href="<?php echo U('Home/EnterpriseList/enterprise','id='.$vo['eid']);?>"><?php echo ($vo["en_name"]); ?></a></td>
                    <td><?php echo ($vo["salary"]); ?></td>
                    <td><?php echo (date("Y-m-d",$vo["publish_time"])); ?></td>
                  </tr>
                  <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </table>
          </div>
        </div>
      </div>
      <!-- 产品模块 -->
      <div class="col-md-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><strong>产品类招聘（<?php echo ($applyCount1); ?>个职位）</strong><span style="float:right;"><a href="<?php echo U('/Apply/index',array('at'=>1));?>">更多</a></span></div>
          <!-- Table -->
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>职位名称</th>
                <th>公司名称</th>
                <th>薪资</th>
                <th>发布时间</th>
              </tr>
              <?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["apply_type"] == '1') AND ($vo["apply_status"] == '0')): ?><tr>
                    <td><a href="<?php echo U('Home/Apply/applyDetails','id='.$vo['id']);?>"><?php echo ($vo["job_name"]); ?></a></td>
                    <td><a href="<?php echo U('Home/EnterpriseList/enterprise','id='.$vo['eid']);?>"><?php echo ($vo["en_name"]); ?></a></td>
                    <td><?php echo ($vo["salary"]); ?></td>
                    <td><?php echo (date("Y-m-d",$vo["publish_time"])); ?></td>
                  </tr>
                  <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </table>
          </div>
        </div>
      </div>
      <!-- 设计模块 -->
      <div class="col-md-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><strong>设计类招聘（<?php echo ($applyCount2); ?>个职位）</strong><span style="float:right;"><a href="<?php echo U('/Apply/index',array('at'=>2));?>">更多</a></span></div>
          <!-- Table -->
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>职位名称</th>
                <th>公司名称</th>
                <th>薪资</th>
                <th>发布时间</th>
              </tr>
              <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["apply_type"] == '2') AND ($vo["apply_status"] == '0')): ?><tr>
                    <td><a href="<?php echo U('Home/Apply/applyDetails','id='.$vo['id']);?>"><?php echo ($vo["job_name"]); ?></a></td>
                    <td><a href="<?php echo U('Home/EnterpriseList/enterprise','id='.$vo['eid']);?>"><?php echo ($vo["en_name"]); ?></a></td>
                    <td><?php echo ($vo["salary"]); ?></td>
                    <td><?php echo (date("Y-m-d",$vo["publish_time"])); ?></td>
                  </tr>
                  <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </table>
          </div>
        </div>
      </div>
      <!-- 运营模块 -->
      <div class="col-md-6">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><strong>运营类招聘（<?php echo ($applyCount3); ?>个职位）</strong><span style="float:right;"><a href="<?php echo U('/Apply/index',array('at'=>3));?>">更多</a></span></div>
          <!-- Table -->
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>职位名称</th>
                <th>公司名称</th>
                <th>薪资</th>
                <th>发布时间</th>
              </tr>
              <?php if(is_array($list3)): $i = 0; $__LIST__ = $list3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["apply_type"] == '3') AND ($vo["apply_status"] == '0')): ?><tr>
                    <td><a href="<?php echo U('Home/Apply/applyDetails','id='.$vo['id']);?>"><?php echo ($vo["job_name"]); ?></a></td>
                    <td><a href="<?php echo U('Home/EnterpriseList/enterprise','id='.$vo['eid']);?>"><?php echo ($vo["en_name"]); ?></a></td>
                    <td><?php echo ($vo["salary"]); ?></td>
                    <td><?php echo (date("Y-m-d",$vo["publish_time"])); ?></td>
                  </tr>
                  <?php else: endif; endforeach; endif; else: echo "" ;endif; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  
      
    <div class="row visible-md-block visible-lg-block" style="font-size:12px;">
	<div class="col-md-12" style="border-bottom:2px solid turquoise;margin:0 0 10px 0;">
		<h4><span class="glyphicon glyphicon-link">友情链接</span></h4>
	</div>
	<?php if(is_array($linkList)): $i = 0; $__LIST__ = $linkList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-1" style="margin-bottom:5px;">
			<span><a style="color:#555;" href="<?php echo ($vo["link_url"]); ?>" target="_blank"><?php echo ($vo["link_title"]); ?></a></span>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	
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
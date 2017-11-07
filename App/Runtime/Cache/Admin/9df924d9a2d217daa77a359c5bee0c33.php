<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = '/ITrecruit/Public/Admin'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
<title>IT招聘网后台管理中心</title>

<link href="<?php echo ($path); ?>/jui/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo ($path); ?>/jui/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo ($path); ?>/jui/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<link href="<?php echo ($path); ?>/jui/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="/ITrecruit/Public/jui/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<!--[if lte IE 9]>
<script src="/ITrecruit/Public/jui/js/speedup.js" type="text/javascript"></script>
<![endif]-->

<script src="<?php echo ($path); ?>/jui/js/jquery-1.7.2.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/js/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/xheditor/xheditor-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/xheditor/xheditor_lang/zh-cn.js" type="text/javascript"></script>
<script src="<?php echo ($path); ?>/jui/uploadify/scripts/jquery.uploadify.js" type="text/javascript"></script>

<!-- svg图表  supports Firefox 3.0+, Safari 3.0+, Chrome 5.0+, Opera 9.5+ and Internet Explorer 6.0+ -->
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/raphael.js"></script>
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/g.raphael.js"></script>
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/g.bar.js"></script>
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/g.line.js"></script>
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/g.pie.js"></script>
<script type="text/javascript" src="<?php echo ($path); ?>/jui/chart/g.dot.js"></script>

<script src="<?php echo ($path); ?>/jui/js/dwz.min.js" type="text/javascript"></script>

<script src="<?php echo ($path); ?>/jui/js/dwz.regional.zh.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function(){
            DWZ.init("<?php echo ($path); ?>/jui/dwz.frag.xml", {
                //loginUrl:"login_dialog.html", loginTitle:"登录",	// 弹出登录对话框
                //loginUrl:"login.html",	// 跳到登录页面
                statusCode:{ ok:200, error:300, timeout:301}, //【可选】
                pageInfo:{ pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
                debug:false,	// 调试模式 【true|false】
                callback:function(){
                    initEnv();
                    $("#themeList").theme({themeBase:"<?php echo ($path); ?>/jui/themes"}); // themeBase 相对于index页面的主题base路径
                }
            });
        });
    </script>
</head>

<body scroll="no">
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<h2 style="font-size:20px;color:white;line-height:50px;margin-left:10px;">IT招聘网后台管理中心</h2>
				<ul class="nav">
					<li><span style="color:#ffffff;">欢迎您，<span style="font-weight:bold;"><?php echo ($_SESSION["adminuser"]["admin_name"]); ?></span>！</span></li>
					<li><a href="/ITrecruit/Admin/Login/loginOut">退出</a></li>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<!--<li theme="red"><div>红色</div></li>-->
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>

			<!-- navMenu -->
			
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
                    <?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["level"] == '2') and ($vo["is_nav"] == '1')): ?><div class="accordionHeader">
	                            <h2><span>Folder</span><?php echo ($vo["title"]); ?></h2>
	                        </div>
	                        <div class="accordionContent">
	                            <ul class="tree treeFolder collapse">
	                                <?php if(is_array($vo["node"])): $i = 0; $__LIST__ = $vo["node"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$svo): $mod = ($i % 2 );++$i; if(($svo["level"] == '3') and ($svo["is_nav"] == '1')): ?><li><a href="/ITrecruit/Admin/<?php echo ($vo["name"]); ?>/<?php echo ($svo["name"]); ?>" target="<?php echo ($svo["open_style"]); ?>" rel="<?php echo ($svo["rel_name"]); ?>"><?php echo ($svo["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	                            </ul>
	                        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>

			</div>
		</div>
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">后台主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">我的主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox" style="">
						<div align="center" style="margin-top:210px;font-size:25px;font-weight:bold;">
							欢迎进入IT招聘网后台管理中心
						</div>
						<div align="center" style="margin-top:20px;font-size:15px;">
							<?php $ntime=time(); ?>
							<?php $nowTime = $ntime; ?>
							今天是：<?php echo (date("Y年m月d日 l",$nowTime)); ?>
						</div>
						<div align="center" style="margin-top:17px;font-size:15px;">
							技术支持：兄弟连IT教育
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">当前时间：<span id="time"></span>&nbsp;&nbsp;&nbsp;&nbsp;版权所有：兄弟连IT教育</div>
	<script type="text/javascript">
		function getTime(){
			//实例化一个时间对象c
			var nowTime = new Date();
			//获取时间各个属性值
			var year = nowTime.getFullYear();
			var month = nowTime.getMonth()+1;
			var date = nowTime.getDate();
			var hours = nowTime.getHours();
			var minutes = nowTime.getMinutes();
			var seconds = nowTime.getSeconds();
			//时分秒小于10，自动加0开始
			if(hours<10){
				hours="0"+hours;
			}
			if(minutes<10){
				minutes="0"+minutes;
			}
			if(seconds<10){
				seconds="0"+seconds;
			}
			//输出时间
			var webTime = "<font>"+year+"-"+month+"-"+date+" "+hours+":"+minutes+":"+seconds+"</font>";
			var div = document.getElementById("time")
			div.innerHTML=webTime;
			setTimeout("getTime()",1000);
		}
		getTime();
	</script>
</body>
</html>
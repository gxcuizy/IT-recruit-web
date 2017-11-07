<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<?php $path = '/ITrecruit/Public/Admin'; ?>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php echo ($path); ?>/images/favicon.ico" type="image/x-icon" />
        <title>IT招聘网后台登陆</title>
        <!-- CSS -->

        <link rel="stylesheet" href="<?php echo ($path); ?>/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo ($path); ?>/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo ($path); ?>/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <script language="JavaScript">
            <!--
            function fleshVerify(type){ 
                //重载验证码
                var timenow = new Date().getTime()
                $('#verifyImg').attr("src", '/ITrecruit/Admin/Login/verify/'+timenow);
            }
            //-->
        </script>
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>IT招聘网</h3>
                            		<p>欢迎进入IT招聘网后台登陆</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="/ITrecruit/Admin/Login/checkLogin/" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">用户名</label>
			                        	<input type="text" name="name" value="" placeholder="用户名" class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">密码</label>
			                        	<input type="password" name="password" placeholder="密码" class="form-password form-control" id="form-password">
			                        </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">验证码</label>
                                        <input type="text" name="code" placeholder="验证码" class="col-md-8" id="form-password" style="margin-right:10px;">
                                       <!--  <input type="password" name="form-password" placeholder="验证码" class="col-md-4" id="form-password"> -->
                                       <span><img id="verifyImg" SRC="/ITrecruit/Admin/Login/verify/" onClick="fleshVerify()" border="0" alt="点击刷新验证码" style="cursor:pointer;width:90px;height:50px;line-height:50px;" align="absmiddle"></span>
                                    </div><br/>
                                         <span style="color:red"><?php echo ($errorinfo); ?></span>
			                        <button type="submit" class="btn">登陆</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <!-- Javascript -->
        <script src="<?php echo ($path); ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo ($path); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo ($path); ?>/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo ($path); ?>/js/scripts.js"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
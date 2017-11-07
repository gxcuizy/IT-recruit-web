<?php
//自定义公共函数库文件

//自定义一个发送邮件函数
function sendMail($address,$title,$message){
	//导入mail类文件
	//require("./PHPMailer/class.phpmailer.php");
	
	vendor('PHPMailer.class#phpmailer'); //Thinkphp的导入方式，放在/ThinkPHP/Extend/Vendor/
	
	//创建mail对象
	$mail = new PHPMailer();

	$mail->IsSMTP();                         // 设置使用SMTP服务器发送
	$mail->Host = "smtp.sina.cn";            // 设置126邮箱服务 
	$mail->SMTPAuth = true;                  // 设置需要验证
	$mail->Username = "18377883517@sina.cn"; // 发件人使用邮箱
	$mail->Password = "XQ711118";            // 设置发件人密码

	$mail->From = "18377883517@sina.cn";     // 发件人邮箱
	$mail->FromName = "IT招聘网";            // 发送者名称
	$mail->AddAddress($address);             // 添加发送地址
	
	$mail->IsHTML(true);                     // 指定支持html格式
	$mail->CharSet="UTF-8";
	
	$mail->Subject = $title;
	$mail->Body = $message;
	
	if($mail->Send()){
	   return true;
	}else{
	   return false;
	}
}
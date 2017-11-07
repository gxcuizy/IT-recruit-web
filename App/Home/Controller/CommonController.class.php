<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	
	// 判断是否登陆和获取网站系统信息
	public function _initialize(){
        $sysInfo=M('System_info')->find();
        $webState=$sysInfo['web_status'];
        if($webState!=1){
            $this->redirect('Maintain/index');
        }else if($_SESSION['ITUser']){
            $this->assign('sysInfo',$sysInfo);
        }else{
            $this->error('请文明上网，切勿非法操作！');
            $this->assign('sysInfo',$sysInfo);
            die();
        }
	}
}
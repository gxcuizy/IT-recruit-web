<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	
	// 获取网站系统信息
	public function _initialize(){
        $sysInfo=M('System_info')->find();
        $webState=$sysInfo['web_status'];
        if($webState!=1){
            $this->redirect('Maintain/index');       }else{
            $this->assign('sysInfo',$sysInfo);
        }
	}
}
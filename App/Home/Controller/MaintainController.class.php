<?php
namespace Home\Controller;
use Think\Controller;
class MaintainController extends Controller {
    public function index(){
    	// 查看网站是否处于维护状态
        $sysInfo=M('System_info')->find(1);
        $webState=$sysInfo['web_status'];
        if($webState==1){
            $this->redirect('Index/index');
        }else{
            $this->display('index');
        }
    }
}
<?php
namespace Admin\Controller;

class SystemInfoController extends CommonController {
    //获取网站信息
    public function index(){
        $mod = M('System_info');
        $systemInfo=$this->assign('systemInfo',$mod->select());
        $this->display('index');
    }

    //获取网站信息
    public function edit(){
        $mod = M('System_info');
        $systemInfo=$this->assign('systemInfo',$mod->select());
        $this->display('edit');
    }

    //设置网站信息
    public function save(){
        $mod = M('System_info');
        $mod->create();
        if($mod->save()){
            $this->success('设置网站信息成功！');
        }else{
            $this->error('设置网站信息失败！');
        }

    }

	//获取网站标题
    public function title(){
    	$mod = M('System_info');
    	$title=$mod->field('id,title')->select();
    	$this->assign('title',$title);
    	$this->display('title');
    }

    //更改网站标题
    public function updateTitle(){
    	$mod = M('System_info');
    	$mod->create();
    	if($mod->save()){
    		$this->success('设置网站标题成功');
    	}else{
    		$this->error('设置网站标题失败');
    	}
    }

    //获取网站页脚信息
    public function getCopyright(){
    	$mod = M('System_info');
    	$copyright=$mod->field('id,footer_address,footer_copyright')->select();
    	$copyright=$this->assign('copyright',$copyright);
    	$this->display('copyright');
    }

    //设置网站页脚信息
    public function updateFooter(){
    	$mod = M('System_info');
    	$mod->create();
    	if($mod->save()){
    		$this->success('设置网站页脚成功');
    	}else{
    		$this->error('设置网站页脚失败');
    	}
    }

    //获取网站运行状态
    public function getSwitch(){
        $mod = M('System_info');
        $webSwitch=$mod->field('id,web_status')->select();
        $webSwitch=$this->assign('webSwitch',$webSwitch);
        $this->display('webSwitch'); 
    }

    //设置网站运行状态
    public function setswitch(){
        $mod = M('System_info');
        $mod->create();
        if($mod->save()){
            $this->success('设置网站运行状态成功');
        }else{
            $this->error('设置网站运行状态失败');
        }
    }
}
<?php
namespace Admin\Controller;
class EnterpriseController extends CommonController {
	// 模糊搜索
	public function _filter(&$map){
        $name = $_POST['en_name'];
        $map['en_name']=array('like',"%$name%");
    }
	//禁止添加企业信息
	public function add(){
		$this->error('禁止添加企业信息！');
	}

	//禁止编辑企业信息
	public function edit(){
		$this->error('禁止编辑企业信息');
	}
}
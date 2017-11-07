<?php
namespace Admin\Controller;
class ApplyController extends CommonController {
	// 模糊搜索
	public function _filter(&$map){
        $name = $_POST['job_name'];
        $map['job_name']=array('like',"%$name%");
    }

	//禁止编辑招聘资料
	public function edit(){
		$this->error('禁止编辑招聘信息！');
	}

	//禁止添加招聘资料
	public function add(){
		$this->error('禁止添加招聘信息！');
	}
}
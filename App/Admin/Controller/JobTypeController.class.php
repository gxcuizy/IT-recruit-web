<?php
namespace Admin\Controller;

class JobTypeController extends CommonController {
	
	//招聘关键字的模糊搜索
	public function _filter(&$map){
		if(!empty($_POST['keyword'])){
		$map['name'] = array('like',"%{$_POST['keyword']}%");
		}
	}
}
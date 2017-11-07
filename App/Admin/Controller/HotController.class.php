<?php
namespace Admin\Controller;

class HotController extends CommonController {

	public function insert(){
		$_POST['hot_time']=time();
		parent::insert();
	}

	public function _filter(&$map){
		$name = $_POST['hot_name'];
		$map['hot_name']=array('like',"%$name%");
	}
}
<?php
namespace Admin\Controller;
class AdvantagesController extends CommonController {
	// 模糊搜索
	public function _filter(&$map){
        $name = $_POST['name'];
        $map['name']=array('like',"%$name%");
    }
}
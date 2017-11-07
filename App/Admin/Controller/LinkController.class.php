<?php
namespace Admin\Controller;
class LinkController extends CommonController {
	// 模糊搜索
	public function _filter(&$map){
        $name = $_POST['link_title'];
        $map['link_title']=array('like',"%$name%");
    }

}
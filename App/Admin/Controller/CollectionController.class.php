<?php
namespace Admin\Controller;

class CollectionController extends CommonController {
	//设置回调接口
	public function _tigger_list(&$list){
		foreach($list as &$map){
			//查看收藏者
			$uid = $map['uid'];
			$mod = M("resume");
			$user = $mod->field("name")->find($uid);
			$map['name']=$user['name'];
			//查看收藏职位和企业名称
			$aid = $map['aid'];
			$mod = M("apply");
			$apply = $mod->field("job_name,en_name")->find($aid);
			$map['job_name']=$apply['job_name'];
			$map['en_name']=$apply['en_name'];
		}
	}

	//过滤收藏者字段
	public function _filter(&$map){
		
		if(!empty($_POST['name'])){
			$name = $_POST['name'];
			//$where['en_name']=array('like',"%$name%");
			$where['en_name']=$name;
			$mod = M("apply")->field("id")->where($where)->find();
			//dump($mod);
			$map['aid']=$mod['id'];
		}
	}
}
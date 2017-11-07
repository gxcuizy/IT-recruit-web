<?php
namespace Admin\Controller;

class IndexController extends CommonController {
	public function index(){
		// 超级用户，直接获取所有的权限
		if(session(C('ADMIN_AUTH_KEY'))){
			$node = D('Node')->relation(true)->select();
		}else{
			// 取出所有权限节点
			$node = D('Node')->relation(true)->select();
			// 取出当前登录用户所有模块权限(英文名称)和操作权限(ID)
			$module='';
			$node_id='';
			$accessList = $_SESSION['_ACCESS_LIST'];
			foreach($accessList as $key=>$value){
				foreach($value as $key1=>$value1){
					$module[]=$key1;
					foreach($value1 as $key2=>$value2){
						$node_id=$node_id.','.$value2;
					}
				}
			}
			// 去除没有权限的节点
			foreach($node as $key=>$value){
				if(!in_array(strtoupper($value['name']),$module)){
					unset($node[$key]);
				}else{
					// 模块存在，比较里面的操作
					foreach($value['node'] as $key1=>$value1){
						// dump($value1['id']);
						if(!in_array($value1['id'],explode(',',$node_id))){
							unset($node[$key]['node'][$key1]);
						}
					}
				}
			}
		}
		$this->assign('node',$node);
		$this->display("index");
		// echo "<pre>";
		// echo "123";
		// print_r($accessList);
		// print_r($node1);
		// echo $_SESSION[C('USER_AUTH_KEY')];
	}
}
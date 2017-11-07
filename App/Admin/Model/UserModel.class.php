<?php
//自定义User表信息操作Model类
namespace Admin\Model;

use Think\Model;

class UserModel extends Model{
	 
	//自动完成
	protected $_auto = array(
		array('password',md5($think.))
	);

}
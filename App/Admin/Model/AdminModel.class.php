<?php
//自定义User表信息操作Model类
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model{
	 //实际的表名
	 //protected $tableName = 'User';

	//自动完成
	protected $_auto = array(
		array('admin_password','md5',3,'function'),
	);

}
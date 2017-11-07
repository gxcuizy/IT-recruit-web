<?php
//自定义User表信息操作Model类
namespace Admin\Model;

use Think\Model;

class UserEnterpriseModel extends Model{
	//实际的表名
	protected $tableName = 'User';

	//自动验证
	protected $_validate = array(
	    array('username','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证username字段是否唯一
	    array('contact','','此邮箱已经注册！',0,'unique',1), // 在新增的时候验证username字段是否唯一
	    // array('repassword','password','密码输入不一致',0,'confirm'), // 验证确认密码是否和密码一致
	);

}
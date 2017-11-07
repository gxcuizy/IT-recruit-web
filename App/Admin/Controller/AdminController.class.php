<?php
namespace Admin\Controller;

class AdminController extends CommonController {
	//获取管理员所属角色
    public function _tigger_list(&$list){
        //遍历添加所属角色信息
        foreach ($list as &$admin) {
            $uid=$admin['id'];
            $vo1=M('RoleUser')->field('role_id')->where("user_id=$uid")->find();
            $vo2=M('Role')->find($vo1['role_id']);
            $admin['role_name']=$vo2['name'];
        }
    }
   
	//添加管理员页面
	public function add(){
		$mod = M('Role');
		$roleList=$mod->select();
		$this->assign('roleList',$roleList);
		$this->display('add');
	}

	//执行添加管理员
    public function insert(){
    	$mod = M('Admin');
    	$data['admin_name']=$_POST['admin_name'];
    	$data['admin_password']=MD5($_POST['admin_password']);
    	$mod->data($data);
    	$res=$mod->add();
    	$role_id=$_POST['role_id'];
    	if($res){
    		$where['admin_name']=$_POST['admin_name'];
    		$user=$mod->where($where)->find();
    		$user_id=$user['id'];
    		$role = M('Role_user');
    		$roledata['role_id']=$role_id;
    		$roledata['user_id']=$user_id;
    		$role->data($roledata);
    		$resu=$role->add();
    		if($resu){
    			$this->success('添加管理员成功！');
    		}else{
    			$mod->where($where)->delete();
    			$this->error('添加管理员失败！');
    		}
    	}else{
    		$this->error('添加管理员失败！');
    	}
    }
}
<?php
namespace Admin\Controller;

class RoleController extends CommonController {
    // 模糊搜索
    public function _filter(&$map){
        $name = $_POST['name'];
        $map['name']=array('like',"%$name%");
    }

    //更新角色信息
    public function update(){
        $_POST['update_time']=time();
        parent::update();
    }

    //执行更新角色信息
    public function insert(){
        $_POST['create_time']=time();
        parent::insert();
    }

    //执行添加角色操作
    public function addRoleDo(){
    	$mod = M('Role');
    	$data=$_POST;
    	$data['create_time']=time();
    	$mod->create($data);
    	$mod->add();
    	$this->success('添加角色成功！');
    }

    // 删除角色同时删除所属角色的管理员
    public function del(){
        $rid = $_REQUEST['id'];
        $userId=M("Role_user")->where("role_id=$rid")->select();
        foreach ($userId as $key => $value) {
            $userIdArray[]=$value['user_id'];
        }
        $uid=implode(',',$userIdArray);
        $userInfo=M("Admin")->delete($uid);
        parent::del();
    }
}
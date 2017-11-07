<?php
namespace Admin\Controller;

class UserWorkerController extends CommonController {
    //获取企业用户信息
    public function _tigger_list(&$list){
        $mod = M('Resume');
        //遍历数据
        foreach ($list as &$user) {
            $vo=$mod->field('name,work_status')->find($user['id']);
            $user['workName']=$vo['name'];
            $user['work_status']=$vo['work_status'];
        }
    }

    //添加查询条件，即值查询企业用户
    public function _filter(&$map){
        $map['type']=1;
        $name = $_POST['username'];
        $map['username']=array('like',"%$name%");
    }

    //添加
    public function insert(){
        $password=$_POST['password'];
        $_POST['password']=md5("$password".'IT');
        parent::insert();
    }

    //修改
    public function update(){
        $password=$_POST['password'];
        $_POST['password']=md5("$password".'IT');
        parent::update();
    }

    public function del(){
        $uid = $_REQUEST['id'];
        $user=M("Resume")->where("id=$uid")->delete();
        parent::del();
    }
}
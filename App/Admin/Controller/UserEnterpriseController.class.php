<?php
namespace Admin\Controller;

class UserEnterpriseController extends CommonController {
    //获取企业用户信息
    public function _tigger_list(&$list){
        $mod = M('Enterprise');
        //遍历数据
        foreach ($list as &$user) {
            $vo=$mod->field('name,position,en_name')->find($user['id']);
            $user['hrName']=$vo['name'];
            $user['position']=$vo['position'];
            $user['enName']=$vo['en_name'];
        }
    }

    //添加查询条件，即值查询企业用户
    public function _filter(&$map){
        $map['type']=2;
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
}
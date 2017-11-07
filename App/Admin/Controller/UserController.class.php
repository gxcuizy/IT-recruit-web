<?php
namespace Admin\Controller;

class UserController extends CommonController {
    //获取企业用户信息
    public function _tigger_list(&$list){
        $mod = M('Enterprise');
        //遍历数据
        foreach ($list as &$user) {
            $vo=$mod->field('name,position')->find($user['id']);
            $user['enName']=$vo['name'];
            $user['position']=$vo['position'];
        }
    }

    //添加查询条件，即值查询企业用户
    public function _filter(&$map){
        $map['type']=2;
    }

   

    //获取企业用户信息
    public function getWorkerInfo(){
        $mod = M('User');
        $listWorker=$mod->table(array('it_user'=>'user','it_resume'=>'resume'))
        ->field('user.id,user.username,user.type,user.last_login,resume.name,resume.uid,resume.work_status')
        ->where('user.type=1 AND user.id=resume.uid')->select();
        $this->assign('listWorker',$listWorker);
        $this->display('listWorker');
    }
}
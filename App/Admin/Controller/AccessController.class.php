<?php
namespace Admin\Controller;
use Think\Tree;
class AccessController extends CommonController {

    public function access(){
        //获取所属组的信息
        $rid = trim($_GET['id']);
        $this->assign("rid",$rid);
        $name=M('role')->where("id={$rid}")->getField('name');
        $this->assign("name",$name);

        //获取所有的节点
        $node= D('node')->order('sort')->relation(true)->select();
        // $accesstree = Tree::create($node);
        $this->assign("accessdata",$node);

        //$data用于存放当前角色的权限组
        $data=array();
        $access =M('access');
        $data=$access->where("role_id=$rid")->getField('node_id',true);
        $this->assign('nodelist',$data);
        $this->display('access');
        // dump($data);
    }

    //分配权限
    public function setAccess(){
        $rid=$_POST['rid'];
        $access = M('access');
        if(isset($_POST['access'])){
            //清空当前用户的所有权限
            $access->where('role_id='.$rid)->delete();
            $data= array();
            foreach($_POST['access'] as $key=>$value){
                $accInfo=M('Node')->find($value);
                $data[] = array(
                    'role_id'=>$rid,
                    'node_id'=>$accInfo['id'],
                    'level'=>$accInfo['level'],
                    'module'=>$accInfo['name']
                );
            }
            // echo "<pre>";
            // print_r($data);
            // die();
            $res=M('access')->addAll($data);
            if($res){
                $this->success("分配权限成功！");
            }else{
                $this->error("分配权限失败！");
            }
        }else{
            $this->error("分配权限失败！");
        }
    }
}
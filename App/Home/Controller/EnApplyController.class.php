<?php
namespace Home\Controller;
class EnApplyController extends CommonController {
	// 加载当前企业发布的招聘职位列表
    public function listApply(){
    	$mod = M('Apply');
        $page=1;
        $pageCount=1;
        // 页码
        if(!empty($_GET['page'])){
            $page=$_GET['page'];
        }
        if($_GET['status']=='0' || !empty($_GET['status'])){
            $data['apply_status']=$_GET['status'];
        }
        // 企业id
        $eid=$_SESSION['ITUser']['id'];
        $data['eid']=$eid;
        $applyCount=$mod->where($data)->count();
        // 每页显示条数
        $num=10;
        // 总页数
        if($applyCount/$num==0){
            $pageCount=$applyCount/$num;
        }else{
            $pageCount=ceil($applyCount/$num);
        }
    	$applyList=$mod->where($data)->page($page,$num)->order('publish_time desc')->select();
        $this->assign('page',$page);
        $this->assign('pageCount',$pageCount);
        $this->assign('applyList',$applyList);
    	$this->display('listApply');
    }

    //删除招聘信息
    public function delApply($aid){
        $mod = M('Apply');
        $where['id']=$aid;
        $res=$mod->where($where)->delete();
        if($res){
            // 删除求职者收藏的职位
            $collect=M('Collection');
            $colw['aid']=$aid;
            $num1=$collect->where($colw)->delete();
            // 删除求职者投递简历的记录信息
            $apply=M('ResumeApply');
            $appw['aid']=$aid;
            $num2=$apply->where($appw)->delete();
            $this->success('删除招聘信息成功！');
        }else{
            $this->error('删除招聘简历失败！');
        }
    }

    //控制招聘信息的状态，即停止招聘
    public function stopApply($aid){
        $mod=M('Apply');
        $data['apply_status']='1';
        $data['id']=$aid;
        $mod->create($data);
        $mod->save();
        $this->redirect('EnApply/listApply');
    }

    //控制招聘信息的状态，即继续招聘
    public function startApply($aid){
        $mod=M('Apply');
        $data['apply_status']='0';
        $data['id']=$aid;
        $mod->create($data);
        $mod->save();
        $this->redirect('EnApply/listApply',1);
    }

   //发布招聘信息
    public function addApply(){
        //查看企业信息
        $mod = M("enterprise");
        $id=$_SESSION['ITUser']['id'];
        $enterprise = $mod->field('en_name,email,en_advantages,en_introduction')->find($id);
        $this->assign("enterprise",$enterprise);

        $advantages = explode(',',$enterprise['en_advantages'] );
        
        //查看企业亮点
        foreach ($advantages as $v) {
            $mod = M("advantages");
            $vv=$mod->field("name")->find($v);
            $ss['id']=$v;
            $ss['name']=$vv['name']; 
            $aa[] = $ss;
        }
       $this->assign("advantages",$aa);
      

        $this->display();
 
    }

     //添加招聘
    public function add(){
        //添加招聘
        $mod = M("apply");
        $_POST['eid']=$_SESSION['ITUser']['id'];
        $_POST['publish_time']=time();
        
        $_POST['work_advantages']=implode(',', $_POST['work_advantages']);

        if($mod->create()){
            $mod->add();
            $url=U('EnApply/listApply');
            $this->success("发布招聘信息成功！",$url);
        }
    }

    //查看四大类别下面的子类
    public function doload($pid){
        $mod = M("jobType");
        $where['pid']=$pid;
        $list = $mod->where($where)->select();
        die(json_encode($list));
    }

    //查看城市信息
    public function load($pid){
        $mod = M("City");
        $where['upid']=$pid;
        $list = $mod->where($where)->select();
        die(json_encode($list));
    }
}
<?php
namespace Home\Controller;
class ResumeController extends PublicController {
	//加载简历列表
	public function index(){
		$mod = M("resume");
		$where['is_show']= '1';
		
		//封装名字
		if(!empty($_GET['kw'])){
			$name = $_GET['kw'];
			$where['name']=array('like',"%$name%");
		}
		//封装学历
		if(!empty($_GET['education'])){
			$education = $_GET['education'];
			$where['education']=array('like',"%$education%");
		}
		$count = $mod->where($where)->count();
		//实例化page类
		$page = new \Think\Page($count,10);
		$page->setConfig('prev','上一页');
            $page->setConfig('next','下一页');
            $page->setConfig('first','首页');
            $page->setConfig('last','尾页');
        $show = $page -> show();
        $list = $mod->limit($page->firstRow.','.$page->listRows)->where($where)->select();
        $this->assign("page",$show);
		$this->assign("list",$list);
		$this->assign("count",$count);

		//查看推荐简历
		$ww['is_recommend']='1';
		$ww['is_show']='1';
		$ll = $mod->where($ww)->order("add_time desc")->limit(5)->select();
		$this->assign("ll",$ll);

		//获取热点简历名称
		$mod = M('hot');
        $type['type']='2';
        $hotRe = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hotRe',$hotRe);

		$this->display();
	}

	//加载简历详情
	public function details(){
		$id = $_GET['id'];
		$mod = M('resume');
		$list = $mod->find($id);
		$this->assign("list",$list);
		//封装where条件
		$where['uid']=$id;
		$where['eid']=$_SESSION['ITUser']['id'];
		$res = M('invite')->where($where)->find();
		if($res){
			$this->assign('res','已邀请');
		}
		$this->display("resumeDetails");
	}

	//验证是否能邀请面试
	public function check(){
		$id = $_GET['id'];
		if(empty($_SESSION['ITUser']['en_photo'])){
			$url = U('/Login/enLogin');
			$this->error('您还没有登录或者没有资格',$url,2);
		}else{
			//添加到邀请列表
			$eid = $_SESSION['ITUser']['id'];
			$date['eid']=$eid;
			$date['uid']=$id;
			$date['invite_time']=time();
			$date['status']='0';
			M('invite')->add($date);
			//查看邮箱和用户名称
			$mod = M('resume');
			$list = $mod->field("email,name")->find($id);
			//给用户发送邮件
			$email=$list['email'];
            $title="IT招聘网";
            $msg=$list['name']."，您好，有企业向您发送了面试邀请，请及时查看！";
            sendMail($email,$title,$msg);
			$this->success("邀请成功！");
		}
	}	

}
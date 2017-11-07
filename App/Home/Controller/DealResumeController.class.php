<?php
namespace Home\Controller;
class DealResumeController extends CommonController {

	//查看简历管理
	public function index(){
		$id = $_SESSION['ITUser']['id'];
		//查看简历管理
		$mod = M("resumeApply ra");
		$count = $mod->field("ra.id,ra.uid,ra.aid,a.eid,a.job_name,r.name,r.sex,r.age,r.education,r.work_status,ra.feedback_status,ra.time")
					  ->join("it_resume r ON ra.uid = r.id")
					  ->join("it_apply  a ON ra.aid = a.id")
					  ->where("eid=".$id)
					  ->count();
		//查看现在的页数
			$page = empty($_GET['page'])?1:$_GET['page'];
			//查看总页数
			$total = ceil($count/10);
			$this->assign("total",$total);
			//判断上一页
			if($page<1){
				$page=1;
			}
			//判断下一页
			if($page>$total){
				$page=$total;
			}
			
		$resume = $mod->field("ra.id,ra.uid,ra.aid,a.eid,a.job_name,r.name,r.sex,r.age,r.education,r.work_status,ra.feedback_status,ra.time")
					  ->join("it_resume r ON ra.uid = r.id")
					  ->join("it_apply  a ON ra.aid = a.id")
					  ->where("eid=".$id)
					  ->page($page,10)
					  ->select();
		$this->assign("page",$page);
		$this->assign("resume",$resume);
		$this->display("resumeList");
	}

	//查看简历详情
	public function myResume($id){
		$mod = M("resume");
		$resume = $mod->find($id);
		$this->assign("resume",$resume);
		$this->display();
	}

	//删除投递简历
	public function delete($id){
		M("resumeApply")->delete($id);
		$this->success("删除成功！");
	}

	//改变企业给的反馈状态
	public function change(){
		$mod = M("resumeApply");
		$status = $_GET['status'];
		$id = $_GET['id'];
		$date['feedback_status']=$status;
		$date['feedback_time']=time();
		$mod->where('id='.$id)->save($date);
		$this->success("更改成功！");
	}

	// 企业邀请求职者面试列表
	public function inviteList(){
		$this->display('inviteList');
	}

	//邀请求职者面试
	public function invite(){
		$this->display("inviteEn");
	}
}
<?php
namespace Home\Controller;
class InviteController extends CommonController {
	// 求职者部分的企业邀请列表信息
	public function inviteJob(){
		$mod = M('Invite');
		$page=1;
		// 页码
        if(!empty($_GET['page'])){
            $page=$_GET['page'];
        }
		$uid=$_SESSION['ITUser']['id'];
		$inviteCount=$mod->where("uid=$uid")->count();
        // 每页显示条数
        $num=10;
        // 总页数
        if($inviteCount/$num==0){
            $pageCount=$inviteCount/$num;
        }else{
            $pageCount=ceil($inviteCount/$num);
        }
        $this->assign('pageCount',$pageCount);
        $this->assign('page',$page);

		$inviteList=$mod->join('it_enterprise on it_invite.eid=it_enterprise.id')->where("it_invite.uid=$uid")->select();
		$this->assign('inviteList',$inviteList);
		$this->display('inviteJob');
	}

	// 求职者处理邀请信息
	public function doInviteJob(){
		$mod = M('Invite');
		$id=$_GET['id'];
		$status=$_GET['status'];
		$where['iid']=$id;
		$where['status']=$status;
		$data=$mod->create($where);
		if($mod->save()){
			if ($status=='1') {
				$this->success('请尽快与企业联系，祝您面试顺利！');
			}else{
				$this->success('很遗憾，该企业不符合您的要求！');
			}
		}else{
			$this->error('处理失败！');
		}
	}

	// 删除企业邀请信息
	public function delInvite(){
		$mod = M('Invite');
		$id=$_GET['id'];
		$where['iid']=$id;
		$mod->where($where)->delete();
		$this->success('删除企业邀请信息成功！');
	}

	// 加载企业简历管理的邀请面试信息
	public function inviteEn(){
		$mod = M('Invite');
		$page=1;
		// 页码
        if(!empty($_GET['page'])){
            $page=$_GET['page'];
        }
		$eid=$_SESSION['ITUser']['id'];
		$inviteCount=$mod->where("eid=$eid")->count();
        // 每页显示条数
        $num=10;
        // 总页数
        if($inviteCount/$num==0){
            $pageCount=$inviteCount/$num;
        }else{
            $pageCount=ceil($inviteCount/$num);
        }
        $this->assign('pageCount',$pageCount);
        $this->assign('page',$page);
		
		$inviteList=$mod->join('it_resume on it_invite.uid=it_resume.id')->where("it_invite.eid=$eid")->page($page,$num)->select();
		$this->assign('inviteList',$inviteList);
		$this->display('inviteEn');
	}

	// 企业处理邀请面试信息
	public function doInviteEn(){
		$mod = M('Invite');
		$id=$_GET['id'];
		$status=$_GET['status'];
		$where['iid']=$id;
		$where['status']=$status;
		$data=$mod->create($where);
		if($mod->save()){
			if ($status=='3') {
				$this->success('恭喜您，招聘到满意的IT人才！');
			}else{
				$this->success('很遗憾，该求职者不符合您的要求！');
			}
		}else{
			$this->error('处理失败！');
		}
	}

	// 删除企业邀请信息
	public function cancelInvite(){
		$mod = M('Invite');
		$id=$_GET['id'];
		$where['iid']=$id;
		$mod->where($where)->delete();
		$this->success('取消邀请面试操作成功！');
	}
}
<?php
namespace Home\Controller;
class ApplyController extends PublicController {
	// 加载职位列表
    public function index(){
    	$mod = M('Apply');
    	// 获取职位数据条数
        // 判断封装搜索条件
        $where=array();
        $page=1;
        $pageCount=1;
        // 页码
        if(!empty($_GET['page'])){
            $page=$_GET['page'];
        }
        // 输入框工作关键字搜索
        if(!empty($_GET['kw'])){
            
            $jobw['job_name']=array('like',"%{$_GET['kw']}%");
        }
        // 已定工作关键字搜索
        if(!empty($_GET['jt'])){
            $jobw['job_type']=$_GET['jt'];
        }
        // 工作类型(四大类)
        if($_GET['at']=='0' || !empty($_GET['at'])){
            $jobw['apply_type']=$_GET['at'];
        }
        // 月薪
        if (!empty($_GET['sl'])) {
            $jobw['salary']=$_GET['sl'];
        }
        // 发布时间
        if (!empty($_GET['t'])) {
            $t=$_GET['t'];
            switch ($t) {
                case '一天内':
                    $pt='86400';
                    break;
                case '三天内':
                    $pt='259200';
                    break;
                case '一周内':
                    $pt='604800';
                    break;
                case '一个月内':
                    $pt='2592000';
                    break;
            }
            $pubt=time()-$pt;
            // var_dump($pubt);
            // die();
            $jobw['publish_time']=array('gt',$pubt);
        }
        // 封装当前正在招聘的职位
        $jobw['apply_status']='0';
        $applyCount=$mod->where($jobw)->count();
    	$this->assign('applyCount',$applyCount);
        // 每页显示条数
        $num=15;
        // 总页数
        if($applyCount/$num==0){
            $pageCount=$applyCount/$num;
        }else{
            $pageCount=ceil($applyCount/$num);
        }
        $this->assign('pageCount',$pageCount);
        $this->assign('page',$page);
    	// 查询职位数据列表
        $list=$mod->field('id,job_name,en_name,work_province,work_city,publish_time,salary')
            ->where($jobw)
            ->order('publish_time desc')
            ->page($page,$num)->select();
    	$this->assign('list',$list);
        // 获取合作企业列表
        $mod = M('Bro_enterprise');
        $where['show']='1';
        $broList=$mod->where($where)->order('add_time desc')->field('id,en_name,url,logo')->limit('7')->select();
        $this->assign('broList',$broList);

        // 获取热点职位
        $mod = M('hot');
        $type['type']='0';
        $hot = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hot',$hot);

    	$this->display('index');
    }

    // 获取职位详情
    public function applyDetails($id){
    	$mod = M('Apply');
    	// 获取招聘职位详细信息
    	$job = $mod -> find($id);
    	$this->assign('applyDetails',$job);

    	// 浏览量加1
		$job['browse_times']++;
		$mod->where("id={$id}")->save($job);

		// 处理招聘职位亮点
		$workAdvantages=$job['work_advantages'];
		$workAdvantagesArr=explode(',',$workAdvantages);
		$this->assign('workAdvantagesArr',$workAdvantagesArr);

		// 获取企业id，即eid
		$eid=$job['eid'];
		// 获取企业信息
		$enterprise = M('Enterprise');
		$enterpriseDetails=$enterprise->field('id,en_name,en_scale,en_nature,en_province,en_address_details,en_advantages,en_photo')
		->find($eid);
		$this->assign('enterpriseDetails',$enterpriseDetails);
        // 查看该求职者是否对该招聘职位投递了简历
        $applyed = M('ResumeApply');
        $where['uid']=$_SESSION['ITUser']['id'];
        $where['aid']=$id;
        $res=$applyed->where($where)->find();
        if ($res) {
            $this->assign('applyed','已投递简历');
        }
        // 查看该求职者是否对该招聘职位进行了收藏
        $collect = M('Collection');
        $res=$collect->where($where)->find();
        if ($res) {
            $this->assign('collected','已收藏');
        }
    	$this->display('applyDetails');
    }

    // 发送简历
    public function sendResume($aid){
        $uid=$_SESSION['ITUser']['id'];
        $type=$_SESSION['ITUser']['type'];
        if(!empty($uid)){
            if($type=='0'){
                $user=M('User');
                $where['id']=$uid;
                $where['allow_admin']='1';
                $userFind=$user->where($where)->count();
                if($userFind){
                    $apply = M('ResumeApply');
                    $data['time']=time();
                    $data['feedback_time']=time();
                    $data['uid']=$uid;
                    $data['aid']=$aid;
                    $apply->create($data);
                    $res=$apply->add();
                    if($res){
                        // 应聘量加1
                        $ap['apply_times']++;
                        M('Apply')->where("id={$aid}")->save($ap);
                        $this->success('投递简历成功，请等待企业回复！');
                    }else{
                        $this->error('投递简历失败！');
                    }
                }else{
                    $this->error('您无权投递简历，请与管理员联系！');
                }
            }else{
               $this->error('您无权投递简历！'); 
            }
        }else{
            $url=U('Login/jobLogin');
            $this->error('您还未登陆，请登陆后再投递简历！',$url);
        }
    }

    // 收藏招聘信息
    public function collectApply($aid){
        $uid=$_SESSION['ITUser']['id'];
        $type=$_SESSION['ITUser']['type'];
        if(!empty($uid)){
            if($type=='0'){
                $collect = M('Collection');
                $data['collection_time']=time();
                $data['uid']=$uid;
                $data['aid']=$aid;
                $collect->create($data);
                $res=$collect->add();
                if($res){
                    $this->success('收藏该招聘职位成功！');
                }else{
                    $this->error('收藏该招聘职位失败！');
                }
            }else{
                $this->error('您无权收藏职位信息！');
            }
        }else{
            $url=U('Login/jobLogin');
            $this->error('您还未登陆，请登陆后再收藏该职位！',$url);
        }
    }
}
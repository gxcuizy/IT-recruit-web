<?php
namespace Home\Controller;
class IndexController extends PublicController {
    public function index(){        
    	//遍历招聘信息
    	$mod = M("Apply");
    	//查看招聘条数
        //获取技术类前三条招聘信息和总数信息
    	$apply_type['apply_type']='0';
        $apply_type['apply_status']='0';
    	$this->assign("applyCount0",$mod->where($apply_type)->count());
        $this->assign("list0",$mod->field("id,eid,job_name,en_name,work_province,work_city,salary,publish_time,apply_type,apply_status")->where($apply_type)->order("publish_time desc")->limit(3)->select());

        //获取产品类前三条招聘信息和总数信息
    	$apply_type['apply_type']='1';
    	$this->assign("applyCount1",$mod->where($apply_type)->count());
        $this->assign("list1",$mod->field("id,eid,job_name,en_name,work_province,work_city,salary,publish_time,apply_type,apply_status")->where($apply_type)->order("publish_time desc")->limit(3)->select());

        //获取设计类前三条招聘信息和总数信息
    	$apply_type['apply_type']='2';
    	$this->assign("applyCount2",$mod->where($apply_type)->count());
        $this->assign("list2",$mod->field("id,eid,job_name,en_name,work_province,work_city,salary,publish_time,apply_type,apply_status")->where($apply_type)->order("publish_time desc")->limit(3)->select());

        //获取运营类前三条招聘信息和总数信息
    	$apply_type['apply_type']='3';
    	$this->assign("applyCount3",$mod->where($apply_type)->count());
        $this->assign("list3",$mod->field("id,eid,job_name,en_name,work_province,work_city,salary,publish_time,apply_type,apply_status")->where($apply_type)->order("publish_time desc")->limit(3)->select());
    	
    	

        //遍历幻灯片信息
        $this->assign("litt",M("Slides")->field("image,img_title,img_content,img_position")->select());

        //获取友情链接
        $link = M('Link');
        $linkList=$link->field('link_title,link_url')->where("is_show='1'")->order('add_time desc')->limit(33)->select();
        $this->assign('linkList',$linkList);
    	

        //获取本站总共招聘职位
        $mod = M("apply");
        $count = $mod->where("apply_status='0'")->count();
        $this->assign("count",$count);
        

        //获取首页的热点职位
        $mod = M('hot');
        $type['type']='0';
        $hot = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hot',$hot);
        

        //获得职位类下面的关键字
        $mod = M('jobType');
        //获取技术类
        $where['pid']='0';
        $type0=$mod->where($where)->limit(7)->select();
        $this->assign("type0",$type0);

        //获取产品类
        $where['pid']='1';
        $type1=$mod->where($where)->limit(7)->select();
        $this->assign("type1",$type1);

        //获取技术类
        $where['pid']='2';
        $type2=$mod->where($where)->limit(7)->select();
        $this->assign("type2",$type2);

        //获取运营类
        $where['pid']='3';
        $type3=$mod->where($where)->limit(7)->select();
        $this->assign("type3",$type3);

        // 获取首页的热点企业
        $mod = M('hot');
        $type['type']='1';
        $hotEn = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hotEn',$hotEn);

        //获取热点简历
        $type['type']='2';
        $hotRe = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hotRe',$hotRe);

        $this->display('index');
    }
}
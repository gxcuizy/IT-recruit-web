<?php
namespace Home\Controller;
class EnterpriseListController extends PublicController {
	//加载企业列表
    public function index(){
        $mod=M('Enterprise');

        //封装企业名称条件
        $search = trim($_GET['kw']);
        if(!empty($search)){
            $where['en_name'] = array('like',"%$search%"); 
        }
        //封装企业性质条件
        $en = $_GET['en_nature'];
        if(!empty($en)){
            $where['en_nature'] = array('like',"%$en%");
        }
        //获取企业数据条数
        $count = $mod->where($where)->count();
        $this->assign('EnterpriseListCount',$count);
        //查询企业数据列表和分页效果
        $Page = new \Think\Page($count,9);
        $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('first','首页');
            $Page->setConfig('last','尾页');
        $show = $Page -> show();
        
        $this->assign('list',$mod->field('en_name,en_introduction,en_photo,id')
             -> limit($Page->firstRow.','.$Page->listRows)
             ->order('register_time desc')
             ->where($where)->select());
        $this->assign("page",$show);
        //获取合作企业列表
        $mod = M('Bro_enterprise');
        $ww['show']='1';
        $broList=$mod->where($ww)->order('add_time desc')->field('id,en_name,url,logo')->limit('7')->select();
        $this->assign('broList',$broList);

        //获取热点企业
        $mod = M('hot');
        $type['type']='1';
        $hot = $mod->field('hot_name')->where($type)->order('hot_level desc,hot_time desc')->limit(6)->select();
        $this->assign('hot',$hot);

        $this->display("enterpriseList");
    }

    //获取企业详情表
    public function enterprise($id){
        $mod = M('Enterprise');

         //查询企业数据列表
        $advantages = $mod->field('id,en_name,en_introduction,en_city,en_county,en_photo,en_province,en_address_details,en_nature,en_scale,en_advantages,phone,email')->find($id);
        $this->assign('vo',$advantages);

        //遍历企业亮点
         $advantages = explode(',',$advantages['en_advantages'] );
        
        //查看企业亮点 
        foreach ($advantages as $v) {
            $mod = M("advantages");
            $vv=$mod->field("name")->find($v);
            $ss['id']=$v;
            $ss['name']=$vv['name']; 
            $aa[] = $ss;
        }
       $this->assign("advantages",$aa);
        //查看职位列表
        $mod = M('Apply');
        //企业id
        $eid['eid']=$id;
        //获取职位数据条数
        $count = $mod->where($eid)->count();
        $this->assign('applyCount',$count);

        //获取总页数
        $total = ceil($count/7);
        $this->assign("total",$total);
        //获取当前页
        $page=empty($_GET['page'])?1:$_GET['page'];
        
        //判断上一页
        if($page<1){
            $page = 1;
        }
        //判断下一页
        if($page>$total){
            $page = $total;
        }
        $this->assign("page",$page);
        //查询职位数据列表
        $this->assign('litt',$mod->field('id,job_name,en_name,work_province,work_city,salary,publish_time')->page("$page,7")->order("publish_time desc")->where($eid)->select());

        $this->display();
        
    }
}
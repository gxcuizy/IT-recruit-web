<?php
namespace Home\Controller;
class EnterpriseController extends CommonController {
	//加载显示企业个人中心
    public function index(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        $contact=$_SESSION['ITUser']['contact'];
        $data=$mod->find($id);
        $this->assign('enterprise',$data);
    	$this->display('index');
    }

    //获取企业账号信息
    public function getInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        $data=$mod->field('name,position,sex,phone,email,photo')->find($id);
        $this->assign('enterprise',$data);
    	$this->display('getInfo');
    }

    //修改企业账号信息
    public function setInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        $enterpriseInfo=$mod->find($id);
        //上传个人头像
        if(!empty($_FILES) && $_FILES["photo"]["error"]==0){
            $upload=new \Think\Upload();                            // 实例化上传类
            $upload->maxSize=3145728;                               // 设置附件上传大小
            $upload->exts=array('jpg','gif','png','jpeg');          // 设置附件上传类型
            $upload->rootPath='./Public/Home/uploads/enterprise/';  // 设置附件上传目录
            $upload->savePath='photo/';                             // 设置附件上传目录
            $upload->autoSub=false;                                 // 关闭子目录保存
            $upload->replace=true;                                  // 设置同名文件覆盖
            $upload->saveName='time'; 
            // 上传文件
            $info = $upload -> upload();
            if(!empty($info)) {
                // 删除原来的头像
                @unlink('./Public/Home/uploads/enterprise/photo/'.$enterpriseInfo['photo']);
                // 处理上传的图片，进行压缩
                $image = new \Think\Image();
                $image->open('./Public/Home/uploads/enterprise/photo/'.$info['photo']['savename']);
                $image->thumb(160,160,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/enterprise/photo/'.$info['photo']['savename']);
                $savename=$info['photo']['savename'];
            }else{
                // 头像上传失败
                $this->error('头像上传失败！');
            } 
        }else{
            $savename=$enterpriseInfo['photo'];
        }
        $data=$_POST;
        $data['id']=$id;
        $data['photo']=$savename;
        $mod->create($data);
        if(!empty($enterpriseInfo)){
            $res=$mod->save();
        }else{
            $res=$mod->add();
        }
        if($res){
            $email=M('User');
            $emailNum['contact']=$_POST['email'];
            $emailNum['id']=$id;
            $email->create($emailNum);
            $email->save();
            $this->success('账号信息保存成功！');
        }else{
            $this->error('账号保存失败！');
        }
    }

    //获取企业信息
    public function setEnInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        $data=$mod->field('en_name,en_province,en_city,en_county,en_address_details,en_nature,en_scale,en_photo,en_advantages,en_introduction')->find($id);
        $this->assign('enterprise',$data);
        // 获取三级城市
        $countyName=$data['en_county'];
        $cw['name']=$countyName;
        $cw['level']='3';
        $countyInfo=M('City')->where($cw)->find();
        $countyPid=$countyInfo['upid'];
        $cwh['level']='3';
        $cwh['upid']=$countyPid;
        $countyList=M('City')->where($cwh)->field('id,name')->select();
        // dump($countyList);
        // die();
        $this->assign('countyList',$countyList);

        // 获取二级城市
        $countyName=$data['en_city'];
        $cityid=$countyPid;
        $cityInfo=M('City')->where("id=$cityid")->find();
        $cityPid=$cityInfo['upid'];
        $citywh['level']='2';
        $citywh['upid']=$cityPid;
        $cityList=M('City')->where($citywh)->field('id,name')->select();
        // dump($cityList);
        // die();
        $this->assign('cityList',$cityList);

        // 获取一级城市
        $provinceList=M('City')->where('level=1')->field('id,name')->select();
        $this->assign('provinceList',$provinceList);
        // //把本企业的亮点处理为数组并处理
        $enAdvantageArray=explode(',',$data['en_advantages']);
        $this->assign('enAdvantageArray',$enAdvantageArray);
        //获取企业亮点表信息
        $adv = M('Advantages');
        $this->assign('enAdvantage',$adv->select());
        $this->display('setEnInfo');
    }

    //保存企业信息
    public function saveEnInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        $enterpriseInfo=$mod->find($id);
        //上传企业图标
        if(!empty($_FILES) && $_FILES["en_photo"]["error"]==0){
            $upload=new \Think\Upload();                            // 实例化上传类
            $upload->maxSize=3145728;                               // 设置附件上传大小
            $upload->exts=array('jpg','gif','png','jpeg');          // 设置附件上传类型
            $upload->rootPath='./Public/Home/uploads/enterprise/';  // 设置附件上传目录
            $upload->savePath='photo/';                             // 设置附件上传目录
            $upload->autoSub=false;                                 // 关闭子目录保存
            $upload->replace=true;                                  // 设置同名文件覆盖
            $upload->saveName='time'; 
            // 上传文件
            $info = $upload -> upload();
            if(!empty($info)) {
                // 删除原来的头像
                @unlink('./Public/Home/uploads/enterprise/photo/'.$enterpriseInfo['en_photo']);
                // 处理上传的图片，进行压缩为230*80
                $image = new \Think\Image();
                $image->open('./Public/Home/uploads/enterprise/photo/'.$info['en_photo']['savename']);
                $image->thumb(230,80,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/enterprise/photo/'.$info['en_photo']['savename']);
                $savename=$info['en_photo']['savename'];
            }else{
                // 企业图标上传失败
                $this->error('企业图标上传失败！');
            } 
        }else{
            //没有上传企业图标，则不修改
            $savename=$enterpriseInfo['en_photo'];
        }
        $data=$_POST;
        $data['id']=$id;
        $data['en_photo']=$savename;
        $data['en_advantages']=implode(',',$_POST['en_advantages']);
        $mod->create($data);
        $res=$mod->save();
        if($res){
            $_SESSION['ITUser']['en_photo']=$savename;
            $this->success('企业信息修改成功！','setEnInfo',1);
        }else{
            $this->error('企业信息修改失败！');
        }
    }

    //加载密码修改页面
    public function updatePw(){
    	$this->display('updatePw');
    }

    //修改账号密码
    public function resetPw(){
        $mod = M('User');
        $id=$_SESSION['ITUser']['id'];
        $userPw=$mod->field('password')->find($id);
        //判断两次密码输入是否一致
        if($_POST['newPassword']!=$_POST['againPassword']){
            $this->error('两次密码输入不一致！');
        }
        //判断原密码输入是否正确
        $password=MD5($_POST['password'].'IT');
        if($userPw['password']==$password){
            $newPassword=MD5($_POST['newPassword'].'IT');
            $data['password']=$newPassword;
            $data['id']=$id;
            $res=$mod->data($data)->save();
            if($res){
                $this->success('密码修改成功！');
            }else{
                $this->error('密码修改失败！');
            }
        }else{
            $this->error('原密码输入不正确！');
        }
    }

    //加载城市信息
    public function doload($pid=0){
        $list = M("City")->where("upid={$pid}")->select();
        die(json_encode($list));
    }
}
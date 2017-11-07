<?php
namespace Home\Controller;
class RegisterController extends PublicController {

    // 生成验证码
    public function verify(){
    	$verify = new \Think\Verify();
    	$verify->fontSize = 50;
        $verify->length   = 4;
        $verify->useNoise = true;
        $verify->useCurve = false;
        $verify->useImgBg = true; 
    	$verify->entry();
    }

    // 验证注册用户名是否存在
    public function checkName(){
        if(M("User")->where("username='{$_POST['username']}'")->count()>0){
            $res['state']=true;
        }else{
            $res['state']=false;
        }
        die(json_encode($res));
    }

    // 验证注册用户联系方式是否存在
    public function checkContact(){
        if(M("User")->where("contact='{$_POST['contact']}'")->count()>0){
            $res['state']=true;
        }else{
            $res['state']=false;
        }
        die(json_encode($res));
    }

    // 验证求职者注册信息
    public function checkJobRegister(){
    	// 检验验证码
    	$verify = new \Think\Verify();
    	if(!$verify->check($_POST['code'])){
            $this->error('验证码错误！');
            $this->display('jobRegister');
            return;
        }

        // 验证用户名
        $mod = M('User');
        $where['username']=$_POST['username'];
        $user=$mod->where($where)->count();
        if(!empty($user)){
        	$this->error('用户名已存在！');
        	$this->display('jobRegister');
        	return;
        }

        // 验证手机号码
        $where['contact']=$_POST['contact'];
        $contact=$mod->where($where)->count();
        if(!empty($contact)){
        	$this->error('该手机号码已存在！');
        	$this->display('jobRegister');
        	return;
        }

        // 整理并插入求职者用户注册信息
        $mod = M('User');
        $password=MD5($_POST['password'].'IT');
        $data['username']=$_POST['username'];
        $data['password']=$password;
        $data['contact']=$_POST['contact'];
        $data['register_time']=time();
        $data['type']='0';
        $res=$mod->data($data)->add();
        if(!empty($res)){
			// 以注册内容在数据库查询，进行二次验证是否注册成功，并且将需要的数据赋值session
			$where['username']=$_POST['username'];
			$where['password']=$password;
			$res=$mod->field('id,username,contact')->where($where)->find();
			$_SESSION['ITUser']=$res;
        	$this->success('求职者账号注册成功！','addResume',1);
        }else{
        	$this->success('求职者账号注册失败！');
        	return;
        }
    }

    // 加载添加求职者简历页面
    public function addResume(){
        $this->display('addResume');
    }

    // 添加求职者简历信息
    public function setResume(){
        $mod = M('Resume');
        $id=$_SESSION['ITUser']['id'];
        // 先上传个人头像
        if(!empty($_FILES) && $_FILES["photo"]["error"]==0){
            $upload=new \Think\Upload();                            // 实例化上传类
            $upload->maxSize=3145728;                               // 设置附件上传大小
            $upload->exts=array('jpg','gif','png','jpeg');          // 设置附件上传类型
            $upload->rootPath='./Public/Home/uploads/jobhunter/';  // 设置附件上传目录
            $upload->savePath='photo/';                             // 设置附件上传目录
            $upload->autoSub=false;                                 // 关闭子目录保存
            $upload->replace=true;                                  // 设置同名文件覆盖
            $upload->saveName='time'; 
            // 上传文件
            $info = $upload -> upload();
            if(!empty($info)) {
                // 处理上传的图片，进行压缩成160*160
                $image = new \Think\Image();
                $image->open('./Public/Home/uploads/jobhunter/photo/'.$info['photo']['savename']);
                $image->thumb(160,160,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/jobhunter/photo/'.$info['photo']['savename']);
                $savename=$info['photo']['savename'];
            }else{
                // 头像上传失败
                $this->error('头像上传失败！');
            }
        }else{
            $savename='default.jpg';
        }
        $data=$_POST;
        $data['id']=$id;
        $data['photo']=$savename;
        $data['add_time']=time();
        $mod->create($data);
        $res=$mod->add();
        if($res){
            $_SESSION['ITUser']['type']='0';
            $_SESSION['ITUser']['photo']=$savename;
            // 求职者注册成功，发送邮箱
            $email=$_POST['email'];
            $title="欢迎注册IT招聘网";
            $msg=$_SESSION['ITUser']['username']."，您好，欢迎您注册IT招聘网！感谢您选择我们，我们会竭尽全力助您找到满意的工作！";
            sendMail($email,$title,$msg);

            $url=U('Jobhunter/index');
            $this->success('您的简历信息保存成功，祝您早日找到满意的工作！',$url,3);
        }else{
            $this->error('您的简历信息保存失败！');
        }
    }

    // 验证企业注册信息
    public function checkEnRegister(){
        // 检验验证码
        $verify = new \Think\Verify();
        if(!$verify->check($_POST['code'])){
            $this->error('验证码错误！');
            $this->display('enRegister');
            return;
        }

        // 验证用户名
        $mod = M('User');
        $where['username']=$_POST['username'];
        $user=$mod->where($where)->count();
        if(!empty($user)){
            $this->error('用户名已存在！');
            $this->display('enRegister');
            return;
        }

        // 验证注册邮箱
        $where['contact']=$_POST['contact'];
        $contact=$mod->where($where)->count();
        if(!empty($contact)){
            $this->error('该邮箱号码已存在！');
            $this->display('enRegister');
            return;
        }

        //整理并插入企业用户注册信息
        $mod = M('User');
        $password=MD5($_POST['password'].'IT');
        $data['username']=$_POST['username'];
        $data['password']=$password;
        $data['contact']=$_POST['contact'];
        $data['register_time']=time();
        $data['type']='1';
        $res=$mod->data($data)->add();
        if(!empty($res)){
            // 注册成功，转到完善账号信息页面，把需要的信息存入$_SESSION['ITUser']
            $where['username']=$_POST['username'];
            $where['password']=$password;
            $res=$mod->field('id,username,contact')->where($where)->find();
            $_SESSION['ITUser']=$res;
            $this->success('企业账号注册成功！','addHrInfo',1);
        }else{
            $this->error('errorInfo','企业账号注册失败！');
            $this->display('enRegister');
            return;
        }
    }

    // 加载页面，完善企业用户账号信息
    public function addHrInfo(){
        $this->display('addHrInfo');
    }

    // 添加企业账号信息
    public function setHrInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        // 先上传个人头像
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
                // 处理上传的图片，进行压缩成160*160
                $image = new \Think\Image();
                $image->open('./Public/Home/uploads/enterprise/photo/'.$info['photo']['savename']);
                $image->thumb(160,160,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/enterprise/photo/'.$info['photo']['savename']);
                $savename=$info['photo']['savename'];
            }else{
                // 头像上传失败
                $this->error('头像上传失败！');
            }
        }else{
            $savename='default.jpg';
        }
        $data=$_POST;
        $data['id']=$id;
        $data['photo']=$savename;
        $data['register_time']=time();
        $mod->create($data);
        $res=$mod->add();
        if($res){
            $this->success('个人账号信息保存成功！','addEnInfo',1);
        }else{
            $this->error('账号信息保存失败！');
        }
    }

    // 加载页面，填写企业具体信息
    public function addEnInfo(){
        // 获取企业亮点表信息
        $adv = M('Advantages');
        $this->assign('enAdvantage',$adv->select());
        $this->display('addEnInfo');
    }

    // 添加企业信息
    public function setEnInfo(){
        $mod = M('Enterprise');
        $id=$_SESSION['ITUser']['id'];
        // 先上传个人头像
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
                // 处理上传的图片，进行压缩成230*80
                $image = new \Think\Image();
                $image->open('./Public/Home/uploads/enterprise/photo/'.$info['en_photo']['savename']);
                $image->thumb(230,80,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/enterprise/photo/'.$info['en_photo']['savename']);
                $savename=$info['en_photo']['savename'];
            }else{
                // 头像上传失败
                $this->error('企业图标上传失败！');
            }
        }else{
            $savename='default_en.jpg';
        }
        // 更新企业表信息
        $data=$_POST;
        $data['id']=$id;
        $data['en_photo']=$savename;
        $data['en_advantages']=implode(',',$_POST['en_advantages']);
        $mod->create($data);
        $res=$mod->save();
        if($res){
            $_SESSION['ITUser']['type']='1';
            $_SESSION['ITUser']['en_photo']=$savename;
            // 企业注册成功，发送邮箱
            $email=$_SESSION['ITUser']['contact'];
            $title="欢迎注册IT招聘网";
            $msg=$_SESSION['ITUser']['username']."，您好，欢迎注册IT招聘网！谢谢您选择我们，我们会竭尽全力助您招聘到您满意的IT人才！";
            sendMail($email,$title,$msg);

            $url=U('Enterprise/index');
            $this->success('企业信息保存成功，祝您早日招聘到IT界大牛！',$url,3);
        }else{
            $this->error('企业信息保存失败！');
        }
    }

    // 加载城市信息
    public function doload($pid=0){
        $list = M("City")->where("upid={$pid}")->select();
        die(json_encode($list));
    }

    // 求职者找回密码
    public function  retrieveJobPw(){
        $this->display('retrieveJobPw');
    }

    // 修改求职者密码
    public function doRetrieveJobPw(){
        // 检验验证码
        $verify = new \Think\Verify();
        if(!$verify->check($_POST['code'])){
            $this->error('验证码错误！');
            return;
        }

        // 验证求职者邮箱
        $email=$_POST['email'];
        $resumeW['email']=$email;
        $userResume=M("Resume")->where($resumeW)->find();
        if($userResume){
            $uid=$userResume['id'];
            $userInfo=M('User')->where("id=$uid and type='0'")->find();
            if($userInfo){
                $pw=mt_rand(100000,999999);
                $upw['password']=MD5($pw.'IT');
                $updatePw=M('User')->where("id=$uid")->save($upw);
                if($updatePw){
                    // 验证求职者邮箱成功，发送邮箱传递新密码
                    $email=$email;
                    $title="找回密码~来自IT招聘网";
                    $msg=$userInfo['username']."，您好，欢迎您回到IT招聘网！您的新密码为：".$pw."，为了您的账号安全，请您登陆后立即修改密码，祝您早日找到满意的工作！";
                    sendMail($email,$title,$msg);
                    $url=U('Home/Index/index');
                    $this->success('恭喜您，密码修改成功，请登陆邮箱查看！',$url,3);
                }
            }else{
                $this->error('很抱歉，您的账号不存在！');
            }
        }else{
            $this->error('很抱歉，邮箱填写错误！');
        }
    }

    // 企业找回密码
    public function  retrieveEnPw(){
        $this->display('retrieveEnPw');
    }

    // 修改企业密码
    public function doRetrieveEnPw(){
        // 检验验证码
        $verify = new \Think\Verify();
        if(!$verify->check($_POST['code'])){
            $this->error('验证码错误！');
            return;
        }

        // 验证企业邮箱
        $email=$_POST['email'];
        $enterpriseW['contact']=$email;
        $enterpriseW['type']='1';
        $userInfo=M('User')->where($enterpriseW)->find();
        if($userInfo){
            $pw=mt_rand(100000,999999);
            $upw['password']=MD5($pw.'IT');
            $updateW['contact']=$email;
            $updatePw=M('User')->where($updateW)->save($upw);
            if($updatePw){
                // 验证企业邮箱成功，发送邮箱传递新密码
                $email=$email;
                $title="找回密码~来自IT招聘网";
                $msg=$userInfo['username']."，您好，欢迎您回到IT招聘网！您的新密码为：".$pw."，为了您的账号安全，请您登陆后立即修改密码，祝您招聘到最优秀的IT人才！";
                sendMail($email,$title,$msg);
                $url=U('Home/Index/index');
                $this->success('恭喜您，密码修改成功，请登陆邮箱查看！',$url,3);
            }else{
                $this->error('很抱歉，修改密码失败！');
            }
        }else{
            $this->error('很抱歉，您的账号不存在！');
        }
    }
}



















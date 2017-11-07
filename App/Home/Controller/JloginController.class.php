<?php
namespace Home\Controller;
class JloginController extends PublicController {
    public function index(){
    	$this->display('index');
    }

    //加载注册页面
    public function register(){
    	$this->display('register');
    }

    //生成验证码
    public function verify(){
    	$verify = new \Think\Verify();
    	$verify->fontSize = 50;
        $verify->length   = 4;
        $verify->useNoise = true;
        $verify->useCurve = false;
        $verify->useImgBg = true; 
    	$verify->entry();
    }

    // 验证注册信息
    public function checkRegister(){
    	// 检验验证码
    	$verify = new \Think\Verify();
    	if(!$verify->check($_POST['code'])){
            $this->assign('errorInfo','验证码错误！');
            $this->display('register');
            return;
        }

        // 验证用户名
        $mod = M('User');
        $where['username']=$_POST['username'];
        $user=$mod->where($where)->count();
        if(!empty($user)){
        	$this->assign('errorInfo','用户名已存在！');
        	$this->display('register');
        	return;
        }

        // 验证用户名
        $where['contact']=$_POST['contact'];
        $contact=$mod->where($where)->count();
        if(!empty($contact)){
        	$this->assign('errorInfo','该手机号码已存在！');
        	$this->display('register');
        	return;
        }

        // 验证密码
        $password=$_POST['password'];
        $passwordAgain=$_POST['passwordAgain'];
        if ($password!=$passwordAgain) {
        	$this->assign('errorInfo','密码输入不一致！');
        	$this->display('register');
        	return;
        }

        //整理并插入用户注册信息
        $mod = M('User');
        $password=MD5($_POST['password'].'it');
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
			$res=$mod->field('id,username,type')->where($where)->find();
			$_SESSION['ITUser']=$res;
        	$this->redirect('Home/Index/index');
        }else{
        	$this->assign('errorInfo','注册失败！');
        	$this->display('register');
        	return;
        }
    }
}
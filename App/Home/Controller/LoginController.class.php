<?php
	namespace Home\Controller;
	class LoginController extends PublicController {
		//加载求职者登录
		public function jodLogin(){
			$this->display("jodLogin");
		}
		//验证求职者登录
		public function checkJobLogin(){
			
			//登录账号验证
	        $mod = M("user");
	        $where['contact']=$_POST['contact'];
	        $where['type']='0';
	        $user = $mod->where($where)->find();
	        if(empty($user)){
	            $this->assign("errorinfo","登录账户不存在！");
	            $this->display("jobLogin");
	            return;
	        }
	        
	        //密码验证
	        if($user['password']==MD5($_POST['password'].'IT')){
	            //将登陆者信息放入session
	            $ww['id']=$user['id'];
	            $resume = M("resume")->field('photo')->where($ww)->find();
	            $_SESSION['ITUser'] = $user;
	            $_SESSION['ITUser']['photo'] = $resume['photo'];
	            //更改登录者信息
	            //$user['logincount']=$user['logincount']+1;
	            //$user['last_login']=time();
	            //$user['login_ip']=get_client_ip();
	            $mod->save($user);
	            //跳转
	            $this->redirect("Jobhunter/index");
	        }else{
	            $this->assign("errorinfo","登录密码错误！");
	            $this->display("jobLogin");
	            return;
	        }
		}

		//加载企业登录中心
		public function enLogin(){
			$this->display("enLogin");
		}

		//验证企业登录
		public function checkEnLogin(){
			
			//登录账号验证
	        $mod = M("user");
	        $where['contact']=$_POST['contact'];
	        $where['type']='1';
	        $user = $mod->where($where)->find();
	        if(empty($user)){
	            $this->assign("errorinfo","登录账户不存在！");
	            $this->display("enLogin");
	            return;
	        }
	        
	        //密码验证
	        if($user['password']==MD5($_POST['password'].'IT')){
	            //将登陆者信息放入session
	            $ww['id']=$user['id'];
	            $resume = M("enterprise")->field('en_photo,en_name')->where($ww)->find();
	            $_SESSION['ITUser'] = $user;
	            $_SESSION['ITUser']['en_photo'] = $resume['en_photo'];
	            $_SESSION['ITUser']['en_name'] = $resume['en_name'];	
	            //更改登录者信息
	            //$user['logincount']=$user['logincount']+1;
	            //$user['last_login']=time();
	            //$user['login_ip']=get_client_ip();
	            $mod->save($user);
	            
	            //跳转
	            $this->redirect("Enterprise/index");
	        }else{
	            $this->assign("errorinfo","登录密码错误！");
	            $this->display("enLogin");
	            return;
	        }
		}

	  	//注销登录
		public function loginOut(){
	        unset($_SESSION["ITUser"]);
	        $url=U('Index/index');
	        $this->success('退出登录成功',$url,1);
    	}
	}
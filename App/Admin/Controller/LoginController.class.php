<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    //加载登陆界面
    public function index(){
        $this->display();
    }

    //执行登录验证
    public function checkLogin(){
        //校验验证码
        $verify = new \Think\Verify();
        if(!$verify->check($_POST['code'])){
            $this->assign("errorinfo","验证码错误！");
            $this->display("index");
            return;
        }
        //登录账号验证
        $mod = M("admin");
        $where['admin_name']=$_POST['name'];
        //$where['is_lock']=0;
        $user = $mod->where($where)->find();
        if(empty($user)){
            $this->assign("errorinfo","登录账户不存在或被禁用！");
            $this->display("index");
            return;
        }
        
        //密码验证
        if($user['admin_password']==md5($_POST['password'])){
            //将登陆者信息放入session
            $_SESSION['adminuser'] = $user;
            $username=$user['admin_name'];
            //$_SESSION[C('ADMIN_LOGIN_USER')] = $user;
            //更改登录者信息
            //$user['logincount']=$user['logincount']+1;
            $user['last_login']=time();
            $user['login_ip']=get_client_ip();
            $mod->save($user);
            
            // 识别身份
            session_start();
            session('username',$username);
            session(C('USER_AUTH_KEY'),$user['id']);
            if($_SESSION['username'] == C('RBAC_SUPERADMIN')){
                session(C('ADMIN_AUTH_KEY'),true);
            }
            
            // RBAC
            $rbac = new \Org\Util\Rbac();
            $rbac::saveAccessList();
            // var_dump($_SESSION);
            $this->redirect('Admin/Index/index');
        }else{
            $this->assign("errorinfo","登录密码错误！");
            $this->display("index");
            return;
        }
        
    }

    //验证码的提供
    public function verify(){
        $verify = new \Think\Verify();
        $verify->fontSize = 50;
        $verify->length   = 4;
        $verify->useNoise = true;
        $verify->useCurve = false;
        // $verify->imageH = 170;
        $verify->entry();
    }
    
    //执行退出
    public function loginOut(){
        unset($_SESSION['adminuser']);
        unset($_SESSION['username']);
        unset($_SESSION[C('USER_AUTH_KEY')]);
        session_destroy();
        $this->redirect("Login/index");
    }
}
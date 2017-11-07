<?php
	namespace Home\Controller;
	class JobhunterController extends CommonController {

		//加载个人中心主页
		public function index(){
			$mod = M("resume");
			$id=$_SESSION['ITUser']['id'];
			$user = $mod->find($id);
			$this->assign("resume",$user);
			$this->display("resume");
		}

		//加载更新简历
		public function updateResume(){
			//查看简历
			$mod = M("resume");
			$id=$_SESSION['ITUser']['id'];
			$user = $mod->find($id);
			$this->assign("resume",$user);
			//查看二级城市信息
			$where['name']=$user['city'];
			$city = M('City')->field('upid')->where($where)->find();
			$upid['upid']=$city['upid'];
			$pro = M('City')->where($upid)->select();
			$this->assign("city",$pro);

			//查看三级城市信息
			$where['name']=$user['county'];
			$county = M('City')->field('upid')->where($where)->find();
			$upid['upid']=$county['upid'];
			$pro = M('City')->where($upid)->select();
			$this->assign("county",$pro);

			$this->display();
		}

		//更新简历
		public function checkResume(){
			//判断是否有图片上传
			if(!empty($_FILES) && $_FILES["photo"]["error"]==0){
				$this->_upload();

				//删除原图
	            $model = M("Resume");
	            $id = $_SESSION['ITUser']["id"];
	            $ob = $model->find($id);
	            if(!empty($ob)){
	                @unlink('./Public/Home/uploads/jobhunter/photo/'.$ob['photo']);
	            }
			}
			$mod = M("resume");
			$id = $_SESSION['ITUser']['id'];
			$list = $mod->find($id); 
			
			if(empty($list)){
				$_POST['id']=$id;
				$mod->add($_POST);
			}else{
				$where['id']=$id;
				$mod->where($where)->save($_POST);
			}
			
			
			$this->success("修改成功");
		}
		//加载职位管理
		public function applyList(){
			$uid = $_SESSION['ITUser']['id'];
			
			//查看投递简历信息表
			$mod = M("resume_apply");
			//查看投递简历状态
			$where['uid']=$uid;
			//判断有没有传过来的简历状态
			if(!empty($_GET['feedback_status'])){
			$where['feedback_status']=$_GET['feedback_status'];
			}

			//查看投递总数
			$count = M("resume_apply")->join('it_apply as a ON it_resume_apply.aid = a.id')->where($where)->count();
			$this->assign("count",$count);

			//查看现在的页数
			$page = empty($_GET['page'])?1:$_GET['page'];
			//查看总页数
			$total = ceil($count/5);
			$this->assign("total",$total);
			//判断上一页
			if($page<1){
				$page=1;
			}
			//判断下一页
			if($page>$total){
				$page=$total;
			}
			$this->assign("page",$page);
			$list=$mod->field("a.id,a.en_name,a.job_name,a.work_province,a.salary,it_resume_apply.time,it_resume_apply.id raid,it_resume_apply.feedback_time,it_resume_apply.feedback_status")
			->join('it_apply as a ON it_resume_apply.aid = a.id')->where($where)->page($page,5)->order('time desc')->select();
			$this->assign("list",$list);

			

			$this->display("applylist");
		}
		//删除职位信息
		public function delApply($id=0){
			$mod = M("resume_apply");
			$mod->delete($id);
			$this->success("删除成功！");
		}

		//加载收藏列表
		public function favoritesJob(){
			//产看当前用户收藏
			$mod = M("collection");
			$uid = $_SESSION['ITUser']['id'];
			
			//收藏数
			$where['uid']=$uid;
			$count=$mod->where($where)->count();
			$this->assign("count",$count);
			//总共多少页
			$total = ceil($count/10);
			//现在页
			$page = empty($_GET['page'])?1:$_GET['page'];
			//判断上一页
			if($page<1){
				$page = 1;
			}
			//判断下一页
			if($page>$total){
				$page=$total;
			}

			$this->assign("page",$page);
			$user=$mod->table("it_apply ap,it_collection co")
					  ->field('co.id,co.aid,ap.job_name,ap.en_name,co.collection_time,ap.apply_type,ap.work_province,ap.work_city,ap.salary')
					  ->where('ap.id=co.aid and co.uid='.$uid)->page("$page,10")->select();
			$this->assign("list",$user);
			$this->display("favoritesjob");
		}
		//删除收藏
		public function delCollection(){
			$mod = M("collection");
			$where['id']=$_GET['id'];
			$mod->where($where)->delete();
			$this->success("删除成功！");
		}

		//加载修改密码
		public function updatePw(){
			$this->display("updatepw");
		}

		//修改密码
		public function checkPassword(){
			$mod = M("user");
			$where['id']=$_GET['id'];
			$user = $mod->where($where)->find();

			if($user['password']==MD5($_POST['password'].'IT')){
				if($_POST['newPassword']==$_POST['againPassword']){
					unset($_POST[againPassword]);
					$u['password']=MD5($_POST['newPassword'].'IT');
					$mod->where($where)->save($u);
					$this->success('修改成功!');
				}
			}else{
				$this->error("密码错误！");
			}
		}

		//文件上传
		protected function _upload(){
			 $upload = new \Think\Upload();// 实例化上传类   
			 $upload->maxSize   =     3145728 ;// 设置附件上传大小  
			 $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型   
			 $upload->rootPath  =      './Public/Home/uploads/jobhunter/photo/'; // 设置附件上传目录 
			 $upload->autoSub = false;  
			 // 上传文件    
			 $info   =   $upload->upload();   
			 if(!$info) {
			 // 上传错误提示错误信息  

	           $this->error($upload->getError());   
	         }else{
	         	
		         //取得成功上传的文件信息
	            $uploadList = array_values($info);
	            $picname = $uploadList[0]['savename'];
	            
	            $image = new \Think\Image();

	            $image->open('./Public/Home/uploads/jobhunter/photo/'.$picname);
	            $image->thumb(160, 160,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/jobhunter/photo/'.$picname);
	            $_POST['photo']  =$picname;
	            $_SESSION['ITUser']['photo']=$picname;
	            
	      	 }
		}

		//查看级联信息表
		public function doload($pid=0){
			$mod = M("City");
			$list = $mod->where("upid={$pid}")->select();
			die(json_encode($list));
		}
	}
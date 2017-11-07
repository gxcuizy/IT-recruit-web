<?php
////图片友情链接信息管理控制器
namespace Admin\Controller;

class SlidesController extends CommonController {
    
    //删除图片信息
    public function del(){
        $model = M("Slides");
        if (! empty ( $model )) {
            $id = $_REQUEST ["id"];
            $mySlides = $model->find($id);
            if(!empty($mySlides)){
                @unlink('./Public/Home/uploads/slides/'.$mySlides['image']);
                //@unlink('./Public/uploads/links/s_'.$mylink['logo']);
            }
            parent::del();
        }
    }
    
    //数据添加
    public function insert() {
        //验证图片位置是否存在
        $post = $_REQUEST["img_position"];
        $where["img_position"]=$post;
        $position = M("Slides")->where($where)->select();
        if(!empty($position)){
           $this->error("此位置已存在！");
        }

        if(!empty($_FILES)) {
            //如果有文件上传 上传附件
             $this->_upload();
        }
        parent::insert();
    }
    //执行修改
    public function update() {

        if(!empty($_FILES) && $_FILES["uploadpic"]["error"]==0){
            //如果有文件上传 上传附件
             $this->_upload();
            //$this->forward();
            //删除原图
            $model = D("Slides");
            $id = $_REQUEST ["id"];
            $ob = $model->find($id);
            if(!empty($ob)){
                @unlink('./Public/Home/uploads/slides/'.$ob['image']);
            }
        }
        parent::update();
    }
    
    // 文件上传
    protected function _upload()
    {   
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 5120000 ;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif','png','jpeg','pjpeg');// 设置附件上传类型 
        $upload->rootPath = './Public/Home/uploads/slides/'; // 设置附件上传目录    
        $upload->autoSub = false; // 设置不创建子目录
        
        $info = $upload->upload();
        if(!$info) {
            $this->error($upload->getError());
        }else {
            //取得成功上传的文件信息
            
            $uploadList = array_values($info);
            $picname = $uploadList[0]['savename'];
            
            $image = new \Think\Image();

            $image->open('./Public/Home/uploads/slides/'.$picname);
            $image->thumb(1140, 300,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Home/uploads/slides/'.$picname);
            $_POST['image']  =$picname;
        }
    }
}
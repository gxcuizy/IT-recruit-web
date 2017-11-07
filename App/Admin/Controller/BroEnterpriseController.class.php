<?php
namespace Admin\Controller;

class BroEnterpriseController extends CommonController {
    // 模糊搜索
    public function _filter(&$map){
        $name = $_POST['en_name'];
        $map['en_name']=array('like',"%$name%");
    }

    //添加合作企业信息
    public function insert(){
        if(!empty($_FILES)) {
            //如果有文件上传,上传企业图标
             $this->_uploadLogo();
        }
        $_POST['add_time']=time();
        parent::insert();
    }
    
   

    //删除合作企业同时删除残留的图标
    public function del(){
        $mod=M("Bro_enterprise");
        $id=$_REQUEST["id"];
        $logo=$mod->field('logo')->find($id);
        if(!empty($logo)){
            @unlink('./Public/Admin/uploads/broen/logo/'.$logo['logo']);
        }
        parent::del();
    }

    //修改合作企业信息
    public function update() {
        //如果有文件上传,上传企业图标
        if(!empty($_FILES) && $_FILES["logo"]["error"]==0){
             $this->_uploadLogo();
            //删除原来的logo图片
            $mod = M("Bro_enterprise");
            $id = $_REQUEST ["id"];
            $logo = $mod->field('logo')->find($id);
            if(!empty($logo)){
                @unlink('./Public/Admin/uploads/broen/logo/'.$logo['logo']);
            }
        }
        parent::update();
    }

     // 上传合作企业图标
    protected function _uploadLogo(){   
        $upload = new \Think\Upload();
        $upload->maxSize=3145728 ;
        $upload->exts=array('jpg', 'gif','png','jpeg');     // 设置附件上传类型 
        $upload->rootPath='./Public/Admin/uploads/broen/logo/'; // 设置附件上传目录    
        $upload->autoSub=false;                           // 设置不创建子目录
        
        $logoInfo=$upload->upload();
        if(!$logoInfo) {
            $this->error($upload->getError());
        }else {
            $uploadList=array_values($logoInfo);
            $logoName=$uploadList[0]['savename'];
            //把上传的图标处理成230*80的大小
            $image = new \Think\Image();
            $image->open('./Public/Admin/uploads/broen/logo/'.$logoName);
            $image->thumb(230, 80,\Think\Image::IMAGE_THUMB_FIXED)->save('./Public/Admin/uploads/broen/logo/'.$logoName);
            $_POST['logo']  =$logoName;
        }
    }
}
<?php
namespace Admin\Controller;

class ResumeController extends CommonController {
    // 模糊搜索
    public function _filter(&$map){
        $name = $_POST['name'];
        $map['name']=array('like',"%$name%");
    }

    //执行修改
    public function update(){
        $mod = M("Resume");
        $id = $_POST['id'];
        $resume = $mod->find($id);
        if($resume['is_show']==1){
            $mod->create();
            $mod->save();
            //$mod->save($_POST['is_recommend']);            
        }else{
            $this->error("该简历为不公开,您不能设置推荐!");
        }

        parent::update();
    }
}
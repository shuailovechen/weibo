<?php

// 首页控制器
class IndexAction extends CommonAction {
    
    //首页视图
    public function index() {
        
        $this->display();
    }
    
    //退出登录处理
    public function loginOut(){
        echo 11111111;
    }



}

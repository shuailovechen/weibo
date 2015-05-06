<?php

/* 
 *公用控制器
 */
Class CommonAction extends Action {
    
    //自动运行的方法
    public function _initialize(){
        //处理自动登录
        if(isset($_COOKIE['auto']) && !isset($_SESSION['uid'])){
            $value = explode('|',enctyption($_COOKIE['auto'],1));
            $ip = get_client_ip();
            
            //本次登录IP与上一次登录IP一致时
            if($ip == $value[1]){
                $account = $value[0];
                $where =array('account' => $account);
                $user =D('user') ->where($where) ->find();
                
                //检索出用户信息并且该用户没有被锁定，保存登录状态
                if($user && !$user['lock']){
                    session('uid',$user['id']);
                }
            }
        }
        //判断用户是否已登录
        if (!isset($_SESSION['uid'])) {
            redirect(U('Login/index'));
        }
    }
} 

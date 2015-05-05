<?php
//注册与登录控制器
class LoginAction extends Action {
    //登录页面
	public function index(){
		$this->display();
    }
	//注册页面
	public function register(){
		$this->display();
	}
	//获取验证码
	public function verify(){
    import('ORG.Util.Image');
    Image::buildImageVerify();
	}
}
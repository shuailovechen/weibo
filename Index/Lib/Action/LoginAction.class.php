<?php
//注册与登录控制器
class LoginAction extends Action {
        //登录页面
	public function index(){
		$this->display();
        }
        //登录表单处理
	public function login(){
            if(!$this->isPost()){
               halt('页面不存在');
           }
           //接收表单信息
           $account = $this->_post('account');
           $pwd = $this->_post('pwd','md5');
           $where =array(
               'account' =>$account,
           );
           $user = D('user') ->where($where)->find();
           if(!$user || $user['password'] !=$pwd){
               $this->error('用户名或者密码不正确');
           }
           if($user['lock']){
               $this->error('用户被锁定');
           }
           //处理下一次自动登录
           if(isset($_POST['auto'])){
               $account = $user['account'];
               $ip = get_client_ip();
               $value =$account . '|' .$ip;
               $value=enctyption($value);
               @setcookie('auto',$value,C('AUTO_LOGIN_TIME'),'/');
           }              
           //登陆成功写入session并且跳转到首页
           session('uid',$user['id']);
           header('Content-Type:text/html;Charset=UTF-8');
           redirect(__APP__,2,'登录成功,正在为您跳转......');
        }
	//注册页面
	public function register(){
		$this->display();
	}
        //注册表单处理
        public function runRegis(){
           if(!$this->isPost()){
               halt('页面不存在');
           }
           if($_SESSION['verify']!=  md5($_POST['verify'])){
               $this->error('验证码错误');
           }
           if($_POST['pwd']!=$_POST['pwded']){
               $this->error('两次密码不一致');
           }
           //提取post数据
           $data = array(
               'account' => $this->_post('account'),
               'password' => $this->_post('pwd','md5'),
               'registime' => $_SERVER['REQUEST_TIME'], //这样取时间比直接用time()取时间能快一点
               'userinfo' =>array(
                   'username' => $this->_post('uname'),
               )
           );
            $id = D('UserRelation')->insert($data);
            if ($id){
                //插入数据成功后把用户ID写入seesion
                session('uid',$id);
                //跳转到首页
                header('Content-Type:text/html;Charset=UTF-8');
                redirect(__APP__,2,'注册成功，正在为你跳转。。。');
            }else{
                $this->error('注册失败，请重试。。。');
            }
        }
        //获取验证码
	public function verify(){
            import('ORG.Util.Image');
            Image::buildImageVerify();
	}
        //异步验证帐号是否存在
        public function checkAccount(){
            if(!$this->isAjax()){
                halt('页面不存在');
            }
            $account = $this->_post('account');
            $where = array('account' => $account);
            if(M('user')->where($where)->getField('id')){
                echo 'false';
            }else{
                echo 'true';
            }
        }
         //异步验证昵称是否存在
        public function checkUname(){
            if(!$this->isAjax()){
                halt('页面不存在');
            }
            $username = $this->_post('uname');
            $where = array('username' => $username);
            if(M('userinfo')->where($where)->getField('id')){
                echo 'false';
            }else{
                echo 'true';
            }
        }
         //异步验证验证码
        public function checkVerify(){
            if(!$this->isAjax()){
                halt('页面不存在');
            }
            $verify = $this->_post('verify');
            if($_SESSION['verify'] != md5($verify)) {
                echo 'false';
            }else{
                echo 'true';
                }
        }
}
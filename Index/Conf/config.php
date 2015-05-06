<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置
	'DB_HOST' => 'localhost',//数据库服务器地址
	'DB_USER' => 'root',//数据库连接用户名
	'DB_PWD'  => 'root',//数据库链接密码
	'DB_NAME' => 'weibo',//数据库名称
	'DB_PREFIX' => 'hd_',//数据库表前缀
	
	'DEFAULT_THEME' => 'default',//默认主题模版
    
        'URL_MODEL' => 1, //url访问方式
        'TOKEN_ON' => false, //令牌验证关闭
        //用于异位或加密的KEY
        'ENCTYPTION_KEY' => 'www.shuai.com',
        //自动登录保存时间
        'AUTO_LOGIN_TIME'=>  time()+3600*24*7, //一个星期
);
?>
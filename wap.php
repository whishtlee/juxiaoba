<?php
header("Content-type: text/html; charset=utf-8");
if($_SERVER['HTTP_HOST'] == '1003.com') {
	header('Location: http://www.1003.com');
	die();
}else if($_SERVER['HTTP_HOST'] == 'www.1003.com/wap.php') {
	header('Location: http://www.1003.com/');
	die();
}else if($_SERVER['HTTP_HOST'] == 'm.1003.com/wap.php') {
	header('Location: http://m.1003.com/');
	die();
}

/*$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'MicroMessenger') === false){
	header("Content-type: text/html; charset=utf-8");
	echo '请在微信中打开';
	die();
}*/

if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value){
		$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value); 
		return $value; 
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE); 
}


//nginx设置
/*if(!$_SERVER['PATH_INFO']) {
	$_SERVER['PATH_INFO'] = $_GET['pathinfo'];
	unset($_GET['pathinfo']);
}*/

//关闭缓存，开发模式
define('APP_DEBUG',true);

define('HTML_CACHE_ON','false');

define('DB_FIELD_CACHE','false');

// APP项目名称
define('APP_NAME', 'juxiaoba');

// 上传文件保存目录
define('UPLOAD_PATH','./Uploads/');

// 绑定Home模块到当前入口文件
define('BIND_MODULE','Home');

// 定义应用目录
define('APP_PATH','./Wap/');

require './ThinkPHP/ThinkPHP.php';
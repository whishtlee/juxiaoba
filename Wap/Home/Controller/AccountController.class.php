<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends BaseController {
	private $user_mod;
	protected function _initialize() {
		parent :: _initialize();
		$this -> user_mod = D('user');
	} 
	public function checkemail() {
		if (IS_AJAX) {
			$email = $_POST['email'];
			$count = $this -> user_mod -> where('email="' . $email . '"') -> count();
			if ($count) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '邮箱已存在!'));
			} 
			$this -> ajaxReturn(array('err' => 1, 'msg' => '可以注册!'));
		} 
	} 
	public function checkusername() {
		if (IS_AJAX) {
			$username = $_POST['username'];
			$count = $this -> user_mod -> where('username="' . $username . '"') -> count();
			if ($count) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '昵称已存在!'));
			} 
			$this -> ajaxReturn(array('err' => 1, 'msg' => '可以注册!'));
		} 
	} 
	public function login() {
		if ($this -> user)header('Location:/user');
		if (IS_AJAX) {
			$username = trim($_POST['username']);
			$password = $_POST['password'];
			if (trim($username) == '' || $password == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '请填写用户名或密码!'));
			} 
			if (strlen($password) < 6 || strlen($password) > 12) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '密码格式不正确!'));
			} 
			$user = $this -> user_mod -> where("(username='" . $username . "' or phone='" . $username . "' or email='" . $username . "') and password='" . $this -> substr_pwd($password) . "'") -> find();
			if (!$user) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '用户名或密码错误!'));
			} 
			if ($user['status'] == C('USER_STATUS_DISABLE')) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '此用户已被禁用!'));
			} 
			if ($user['status'] == C('USER_STATUS_UNACTIVATE')) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '该账号未激活!'));
			} 
			$login_time = time();
			if (isset($_POST['is_save']) && $_POST['is_save'] == 30) {
				$day = 30;
				$key = md5($user['id'] . $user['username'] . $login_time);
				cookie('user[id]', $user['id'], 3600 * 24 * $day);
				cookie('user[username]', $user['username'], 3600 * 24 * $day);
				cookie('user[login_time]', $login_time, 3600 * 24 * $day);
				cookie('user[key]', $key, 3600 * 24 * $day);
			} 
			if ($this -> user_mod -> where('id=' . $user['id']) -> save(array('last_login_ip' => $_SERVER['REMOTE_ADDR'], 'last_login_time' => $login_time))) {
				$_SESSION['xj_id'] = $user['id'];
				$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
				$_SESSION['start_time'] = time();
				$this -> ajaxReturn(array('err' => 1, 'msg' => '登录成功!'));
			} 
		} 
		$this -> assign('title', '用户登录');
		$this -> display();
	} 
	public function register() {
		if ($this -> user)header('Location:/user');
		if (IS_AJAX) {
			$data = $this -> user_mod -> create();
			$code = trim($_POST['code']);
			$verify = new \Think\Verify();
			if (!$verify -> check($code)) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '验证码错误!'));
			} 
			if (trim($data['username']) == '' || trim($data['email']) == '' || $data['password'] == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '请完善注册信息!'));
			} 
			if (strlen($data['password']) < 6 || strlen($data['password']) > 12) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '密码长度为6-12个字符!'));
			} 
			if ($data['password'] != $_POST['confirm_password']) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '两次密码不一样!'));
			} 
			if (mb_strlen($data['username'], 'utf8') < 2 || mb_strlen($data['username'], 'utf8') > 8) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '昵称长度为2-8个字符!'));
			} 
			if ($this -> user_mod -> where("username='" . trim($data['username']) . "' or email='" . trim($data['email']) . "'") -> count()) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '昵称或邮箱已存在!'));
			} 
			$time = time();
			$data['password'] = $this -> substr_pwd($data['password']);
			$data['created_time'] = $time;
			$data['register_ip'] = $_SERVER['REMOTE_ADDR'];
			$data['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
			$data['last_login_time'] = $time;
			$data['level'] = C('USER_DEFAULT_LEVEL');
			$data['status'] = C('USER_STATUS_UNACTIVATE');
			$data['money'] = C('USER_DEFAULT_MONEY');
			$data['avatar'] = '/Uploads/avatar/avatar_' . $data['sex'] . '.png';
			if ($user_id = $this -> user_mod -> add($data)) {
				$user = D('user') -> find($user_id);
				$address = $data['email'];
				$title = '恭喜您注册成功！';
				$token = md5($user['id'] . $user['username'] . $user['email'] . $user['created_time']);
				$url = $this -> setting["site_domain"] . '/account/activate/email/' . $data['email'] . '/token/' . $token;
				$content = '请点击该链接<a href="' . $url . '"> ' . $url . '</a> ，完成您的注册，激活该账号！';
				$this -> send_email($address, $title, $content);
				$this -> ajaxReturn(array('err' => 1, 'msg' => $this -> setting["site_domain"] . '/account/registersuccess/email/' . $data['email']));
			} 
		} 
		$this -> assign('title', '用户注册');
		$this -> display();
	} 
	public function registersuccess() {
		$email = isset($_GET['email'])? trim($_GET['email']): '';
		if ($email) {
			$url = 'mail.' . substr($email, strpos($email, '@') + 1);
			$this -> assign('email', $email);
			$this -> assign('url', $url);
			$this -> assign('title', '注册成功');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function activate() {
		$email = isset($_GET['email'])? trim($_GET['email']): '';
		$token = isset($_GET['token'])? trim($_GET['token']): '';
		if ($email && $token) {
			$user = $this -> user_mod -> where("email='" . $email . "'") -> find();
			$k = md5($user['id'] . $user['username'] . $user['email'] . $user['created_time']);
			if ($token == $k) {
				if ($user && $user['status'] == C('USER_STATUS_UNACTIVATE')) {
					$this -> user_mod -> where('id=' . $user['id']) -> save(array('status' => C('USER_STATUS_NORMAL')));
				} 
				$this -> assign('title', '激活账户');
				$this -> display();
			} 
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function forgetpassword() {
		if ($this -> user)header('Location:/user');
		if (IS_AJAX) {
			$email = trim($_POST['email']);
			$code = trim($_POST['code']);
			$verify = new \Think\Verify();
			if ($email == '' || $code == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '邮箱和验证码不能为空!'));
			} 
			$user = $this -> user_mod -> where('email="' . $email . '"') -> count();
			if (!$user) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '邮箱不存在!'));
			} 
			if (!$verify -> check($code)) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '验证码错误!'));
			} 
			$password = $this -> rand_six_num();
			$address = $email;
			$title = '找回密码！';
			$content = '以下是系统随机为您生成的临时密码，登陆后请修改！您的密码：' . $password;
			$this -> send_email($address, $title, $content);
			$this -> user_mod -> where('id=' . $user['id']) -> save(array('password' => $this -> substr_pwd($password)));
			$this -> ajaxReturn(array('err' => 1, 'msg' => '邮件已发送，请前往您的邮箱查收！'));
		} 
		$this -> assign('title', '找回密码');
		$this -> display();
	} 
	public function qqlogin() {
		$type = isset($_REQUEST['type'])? $_REQUEST['type'] : 'callback';
		$_SESSION['state'] = md5(uniqid(rand(), true));
		$redirect_uri = C('M_SITE_DOMAIN') . "/account/qq" . $type;
		$login_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" . $this -> setting['mqq_app_key'] . "&redirect_uri=" . urlencode($redirect_uri) . "&state=" . $_SESSION['state'];
		header("Location:$login_url");
	} 
	public function qqcallback() {
		$user_openid_mod = D('user_openid');
		if ($_REQUEST['state'] == $_SESSION['state']) {
			$token_url = "https://graph.qq.com/oauth2.0/token";
			$aGetParam = array("grant_type" => "authorization_code", "client_id" => $this -> setting['mqq_app_key'], "client_secret" => $this -> setting['mqq_app_secret'], "code" => $_REQUEST["code"], "redirect_uri" => C('M_SITE_DOMAIN') . "/account/qqcallback");
			$res = $this -> get_url($token_url, $aGetParam);
			if (trim($res) == '') {
				exit('无法获取认证！<br/>');
			} 
			if (strpos($res, "callback") !== false) {
				$lpos = strpos($res, "(");
				$rpos = strrpos($res, ")");
				$res = substr($res, $lpos + 1, $rpos - $lpos -1);
				$msg = json_decode($res);
				if (isset($msg -> error)) {
					echo "<h3>error:</h3>" . $msg -> error;
					echo '<h3>msg  :</h3>' . $msg -> error_description;
					exit;
				} 
			} 
			parse_str($res, $res);
			$_SESSION["access_token"] = $res['access_token'];
		} 
		$url = "https://graph.qq.com/oauth2.0/me";
		$str = $this -> get_url($url, array('access_token' => $_SESSION['access_token']));
		if (strpos($str, "callback") !== false) {
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str = substr($str, $lpos + 1, $rpos - $lpos -1);
		} 
		$res = json_decode($str);
		$_SESSION['openid'] = $res -> openid;
		$user_openid = $user_openid_mod -> where("openid='" . $res -> openid . "' and type='qq'") -> find();
		$is_new = false;
		if ($user_openid) {
			$user = D('user') -> where('openid="' . $res -> openid . '"') -> find();
			if (count($user) > 0) {
				$_SESSION['xj_id'] = $user['id'];
				$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
				if (D('user') -> where('id=' . $user['id']) -> save(array('last_login_ip' => $_SERVER['REMOTE_ADDR'], 'last_login_time' => $last_time))) {
					header('Location:' . C('M_SITE_DOMAIN'));
				} 
			} else {
				$user_openid_mod -> where("openid='" . $res -> openid . "'") -> delete();
				$is_new = true;
			} 
		} else {
			$is_new = true;
		} 
		if ($is_new) {
			$url = "https://graph.qq.com/user/get_user_info";
			$param = array('access_token' => $_SESSION['access_token'], "openid" => $_SESSION['openid'], "oauth_consumer_key" => $this -> setting['mqq_app_key'], "format" => 'json',);
			$res = $this -> get_url($url, $param);
			if ($res == false) {
				exit('获取用户信息失败！');
			} 
			$res = json_decode($res);
			$qq_info = array('user_info' => $res);
			$data = array('username' => $res -> nickname, 'openid' => $_SESSION['openid'], 'avatar' => $res -> figureurl_2, 'last_login_time' => time(), 'last_login_ip' => $_SERVER['REMOTE_ADDR'], 'created_time' => time(), 'status' => 2, 'register_ip' => $_SERVER['REMOTE_ADDR'], 'level' => C('USER_DEFAULT_LEVEL'), 'money' => C('USER_DEFAULT_MONEY'),);
			$user_id = $this -> user_mod -> add($data);
			$_SESSION['xj_id'] = $user_id;
			$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
			$data = array('type' => 'qq', 'uname' => $data['username'], 'openid' => $_SESSION['openid'], 'info' => serialize($qq_info),);
			$user_openid_mod -> add($data);
		} 
		header('Location:/');
		exit;
	} 
	public function wblogin() {
		$type = isset($_REQUEST['type'])? $_REQUEST['type'] : 'callback';
		$_SESSION['state'] = md5(uniqid(rand(), true));
		$redirect_uri = C('M_SITE_DOMAIN') . "/account/wb" . $type;
		$login_url = "https://api.weibo.com/oauth2/authorize?client_id=" . $this -> setting['msina_app_key'] . "&response_type=code&redirect_uri=" . urlencode($redirect_uri) . "&state=" . $_SESSION['state'];
		header("Location:$login_url");
	} 
	public function wbcallback() {
		$user_openid_mod = D('user_openid');
		if ($_REQUEST['state'] == $_SESSION['state']) {
			$token_url = "https://api.weibo.com/oauth2/access_token";
			$aGetParam = array("grant_type" => "authorization_code", "client_id" => $this -> setting['msina_app_key'], "client_secret" => $this -> setting['msina_app_secret'], "code" => $_REQUEST["code"], "redirect_uri" => C('M_SITE_DOMAIN') . "/account/wbcallback");
			$res = $this -> post_url($token_url, $aGetParam);
			if (trim($res) == '') {
				exit('无法获取认证！<br/>');
			} 
			$res = json_decode($res);
			$_SESSION["access_token"] = $res -> access_token;
		} 
		$_SESSION['openid'] = $res -> uid;
		$user_openid = $user_openid_mod -> where("openid='" . $res -> uid . "' and type='wb'") -> find();
		$is_new = false;
		if ($user_openid) {
			$user = D('user') -> where('openid="' . $res -> uid . '"') -> find();
			if (count($user) > 0) {
				$_SESSION['xj_id'] = $user['id'];
				$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
				if (D('user') -> where('id=' . $user['id']) -> save(array('last_login_ip' => $_SERVER['REMOTE_ADDR'], 'last_login_time' => $last_time))) {
					header('Location:' . C('M_SITE_DOMAIN'));
				} 
			} else {
				$user_openid_mod -> where("openid='" . $res -> uid . "'") -> delete();
				$is_new = true;
			} 
		} else {
			$is_new = true;
		} 
		if ($is_new) {
			$url = "https://api.weibo.com/2/users/show.json";
			$param = array('access_token' => $_SESSION['access_token'], "uid" => $_SESSION['openid'],);
			$res = $this -> get_url($url, $param);
			if ($res == false) {
				exit('获取用户信息失败！');
			} 
			$res = json_decode($res);
			$wb_info = array('user_info' => $res);
			$data = array('username' => $res -> name, 'openid' => $_SESSION['openid'], 'avatar' => $res -> avatar_large, 'last_login_time' => time(), 'last_login_ip' => $_SERVER['REMOTE_ADDR'], 'created_time' => time(), 'status' => 2, 'register_ip' => $_SERVER['REMOTE_ADDR'], 'level' => C('USER_DEFAULT_LEVEL'), 'money' => C('USER_DEFAULT_MONEY'),);
			$user_id = $this -> user_mod -> add($data);
			$_SESSION['xj_id'] = $user_id;
			$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
			$data = array('type' => 'wb', 'uname' => $data['username'], 'openid' => $_SESSION['openid'], 'info' => serialize($wb_info),);
			$user_openid_mod -> add($data);
		} 
		header('Location:/');
		exit;
	} 
	public function logout() {
		unset($_SESSION['xj_id']);
		unset($_SESSION['xj_expire']);
		cookie('user[id]', null);
		cookie('user[username]', null);
		cookie('user[login_time]', null);
		cookie('user[key]', null);
		echo '<script>location=\'/\';</script>';
	} 
	private function get_url($sUrl, $aGetParam) {
		$oCurl = curl_init();
		if (stripos($sUrl, "https://") !== false) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
		} 
		$aGet = array();
		foreach($aGetParam as $key => $val) {
			$aGet[] = $key . "=" . urlencode($val);
		} 
		curl_setopt($oCurl, CURLOPT_URL, $sUrl . "?" . join("&", $aGet));
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if (intval($this -> config["debug"]) === 1) {
			echo "<tr><td class='narrow-label'>请求地址:</td><td><pre>" . $sUrl . "</pre></td></tr>";
			echo '<tr><td class=\'narrow-label\'>GET参数:</td><td><pre>' . var_export($aGetParam, true) . "</pre></td></tr>";
			echo '<tr><td class=\'narrow-label\'>请求信息:</td><td><pre>' . var_export($aStatus, true) . "</pre></td></tr>";
			if (intval($aStatus["http_code"]) == 200) {
				echo "<tr><td class='narrow-label'>返回结果:</td><td><pre>" . $sContent . "</pre></td></tr>";
				if ((@$aResult = json_decode($sContent, true))) {
					echo "<tr><td class='narrow-label'>结果集合解析:</td><td><pre>" . var_export($aResult, true) . "</pre></td></tr>";
				} 
			} 
		} 
		if (intval($aStatus["http_code"]) == 200) {
			return $sContent;
		} else {
			return false;
		} 
	} 
	private function post_url($sUrl, $aPOSTParam) {
		$oCurl = curl_init();
		if (stripos($sUrl, "https://") !== false) {
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
		} 
		$aPOST = array();
		foreach($aPOSTParam as $key => $val) {
			$aPOST[] = $key . "=" . urlencode($val);
		} 
		curl_setopt($oCurl, CURLOPT_URL, $sUrl);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POST, true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, join("&", $aPOST));
		$sContent = curl_exec($oCurl);
		$aStatus = curl_getinfo($oCurl);
		curl_close($oCurl);
		if (intval($this -> config["debug"]) === 1) {
			echo "<tr><td class='narrow-label'>请求地址:</td><td><pre>" . $sUrl . "</pre></td></tr>";
			echo '<tr><td class=\'narrow-label\'>POST参数:</td><td><pre>' . var_export($aPOSTParam, true) . "</pre></td></tr>";
			echo '<tr><td class=\'narrow-label\'>请求信息:</td><td><pre>' . var_export($aStatus, true) . "</pre></td></tr>";
			if (intval($aStatus["http_code"]) == 200) {
				echo "<tr><td class='narrow-label'>返回结果:</td><td><pre>" . $sContent . "</pre></td></tr>";
				if ((@$aResult = json_decode($sContent, true))) {
					echo "<tr><td class='narrow-label'>结果集合解析:</td><td><pre>" . var_export($aResult, true) . "</pre></td></tr>";
				} 
			} 
		} 
		if (intval($aStatus["http_code"]) == 200) {
			return $sContent;
		} else {
			echo '<tr><td class=\'narrow-label\'>返回出错:</td><td><pre>' . $aStatus["http_code"] . ",请检查参数或者确实是腾讯服务器出错咯。</pre></td></tr>";
			return false;
		} 
	} 
} 

<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends BaseController {
	private $user_trace_mod;
	protected function _initialize() {
		parent :: _initialize();
		$this -> check_login();
		$this -> user_trace_mod = D('user_trace');
		$mtrace = $this -> get_trace();
		$this -> assign('mtrace', $mtrace);
		$next_level = $this -> get_next_level();
		$this -> assign('next_level', $next_level);
		$user_list = $this -> get_rand_user();
		$this -> assign('user_list', $user_list);
		$good_num = $this -> get_joke_goodnum($this -> user['id']);
		$this -> assign('good_num', $good_num);
	} 
	public function index() {
		$this -> assign('title', '个人中心');
		$this -> display();
	} 
	public function feed() {
		$type = isset($_GET['type'])? trim($_GET['type']): 'all';
		$where = 'user_id=' . $this -> user['id'];
		if ($type == 'week') {
			$start = strtotime('-7 day');
			$where .= ' and created_time >=' . $start;
		} 
		if ($type == 'month') {
			$start = strtotime('-1 month');
			$where .= ' and created_time >=' . $start;
		} 
		if ($type == 'income') {
			$where .= ' and type=' . C('TRACE_STATUS_INCOME');
		} 
		if ($type == 'cost') {
			$where .= ' and type=' . C('TRACE_STATUS_COST');
		} 
		$count = $this -> user_trace_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$trace = $this -> user_trace_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
		$this -> assign('trace', $trace);
		$page_str = str_replace('/home/user/Index', '/user', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> assign('type', $type);
		$this -> assign('title', '我的信息');
		$this -> display();
	} 
	public function joke() {
		$type = isset($_GET['type'])? (int)($_GET['type']): 'all';
		$where = 'user_id=' . $this -> user['id'];
		if ($type != 'all' && $type > 0) {
			$where .= ' and status=' . $type;
		} 
		$user_joke_mod = D('user_joke');
		$count = $user_joke_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$joke = $user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
		$this -> assign('joke', $joke);
		$page_str = str_replace('/home/user/joke', '/user/joke', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> assign('type', $type);
		$this -> assign('title', '我的投稿');
		$this -> display();
	} 
	public function review() {
		$where = 'user_id=' . $this -> user['id'] . ' and at_user_id > 0';
		$user_review_mod = D('user_review');
		$count = $user_review_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$review = $user_review_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
		foreach ($review as $key => $value) {
			$at_user = D('user') -> where('id=' . $value['at_user_id']) -> find();
			$review[$key]['user_info'] = $at_user;
			$user_joke = D('user_joke') -> where('id=' . $value['joke_id']) -> find();
			$review[$key]['joke_info'] = $user_joke;
		} 
		$this -> assign('review', $review);
		$page_str = str_replace('/home/user/review', '/user/review', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> assign('title', '我的评论');
		$this -> display();
	} 
	public function gift() {
		$where = 'user_id=' . $this -> user['id'];
		$user_gift_mod = D('user_gift');
		$count = $user_gift_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$gift = $user_gift_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
		foreach ($gift as $key => $value) {
			$gift[$key]['gift_info'] = json_decode($value['gift_info'], true);
		} 
		$this -> assign('gift', $gift);
		$page_str = str_replace('/home/user/gift', '/user/gift', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> assign('title', '我的礼品');
		$this -> display();
	} 
	public function info() {
		$this -> assign('title', '个人资料');
		$this -> display();
	} 
	public function setpassword() {
		if (IS_AJAX) {
			if ($_POST['password'] != $_POST['confirm_password']) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '两次密码不一样!'));
			} 
			$user_mod = D('user');
			$user = $user_mod -> where('id=' . $this -> user['id']) -> find();
			$password = $this -> substr_pwd($_POST['password']);
			if ($user && $this -> substr_pwd($_POST['old_password']) == $user['password']) {
				if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('password' => $password))) {
					$this -> ajaxReturn(array('err' => 1, 'msg' => '修改成功!'));
				} else {
					$this -> ajaxReturn(array('err' => 0, 'msg' => '修改失败!'));
				} 
			} else {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '原密码不正确!'));
			} 
		} 
	} 
	public function setqq() {
		if (IS_AJAX) {
			if (trim($_POST['qq']) == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => 'QQ不能为空!'));
			} 
			$user_mod = D('user');
			if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('qq' => $_POST['qq']))) {
				$this -> ajaxReturn(array('err' => 1, 'msg' => '修改成功!'));
			} else {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '修改失败!'));
			} 
		} 
	} 
	public function setphone() {
		if (IS_AJAX) {
			if (trim($_POST['phone']) == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '手机号不能为空!'));
			} 
			$user_mod = D('user');
			if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('phone' => $_POST['phone']))) {
				$this -> ajaxReturn(array('err' => 1, 'msg' => '修改成功!'));
			} else {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '修改失败!'));
			} 
		} 
	} 
	public function setavatar() {
		if (IS_AJAX) {
			$x = $_POST['x'];
			$y = $_POST['y'];
			$w = $_POST['width'];
			$h = $_POST['height'];
			$url = $_POST['url'];
			if (trim($x) == '' || trim($y) == '' || trim($w) == '' || trim($h) == '' || trim($url) == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '参数不能为空!'));
			} 
			$img = $this -> cut_img('.' . $url, $x, $y, $w, $h);
			$user_mod = D('user');
			if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('avatar' => substr($img, 1)))) {
				$this -> ajaxReturn(array('err' => 1, 'msg' => $img));
			} else {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '修改失败!'));
			} 
		} 
	} 
	public function followlist() {
		$where = 'uid=' . $this -> user['id'];
		$result = D('user_fans') -> where($where) -> find();
		$count = 0;
		$follow = array();
		$page_str = '';
		if ($result && trim($result['follow_uids']) != '') {
			$follow_uids = substr($result['follow_uids'], 1, strlen($result['follow_uids']) - 2);
			$follow_uids = explode('|', $follow_uids);
			$count = count($follow_uids);
			$page = new \Think\Page($count, 10);
			$start = $page -> firstRow;
			$end = $start + $page -> listRows > $count ? $count : $page -> listRows;
			$follow = array_slice($follow_uids, $start, $end);
			foreach ($follow as $key => $value) {
				$user = D('user') -> where('id=' . $value) -> find();
				$follow[$key] = $user;
			} 
			$page_str = $page -> show();
		} 
		$this -> assign('page', $page_str);
		$this -> assign('follow', $follow);
		$this -> assign('title', '我的关注');
		$this -> display();
	} 
	public function fanslist() {
		$user_id = $this -> user['id'];
		$where = 'follow_uids like "%|' . $user_id . '|%"';
		$count = D('user_fans') -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$follow = D('user_fans') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		foreach ($follow as $key => $value) {
			$user = D('user') -> find($value['uid']);
			$follow[$key] = $user;
		} 
		$page_str = $page -> show();
		$this -> assign('follow', $follow);
		$this -> assign('page', $page_str);
		$this -> assign('title', '我的粉丝');
		$this -> display();
	} 
	public function msg() {
		$where = 'to_uid=' . $this -> user['id'];
		$user_msg_mod = D('user_msg');
		$count = $user_msg_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$msg = $user_msg_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
		foreach ($msg as $key => $value) {
			$msg[$key]['user'] = D('user') -> find($value['send_uid']);
		} 
		$this -> assign('msg', $msg);
		$page_str = str_replace('/home/user/msg', '/user/msg', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> assign('title', '我的信息');
		$this -> display();
	} 
	public function followinfo() {
		$result = D('user_fans') -> where('uid=' . $this -> user['id']) -> find();
		if ($result) {
			if (trim($result['follow_uids']) != '') {
				$follow_uids = substr($result['follow_uids'], 1, strlen($result['follow_uids']) - 2);
				$follow_uids = str_replace('|', ',', $follow_uids);
				$where = 'user_id in(' . $follow_uids . ') and status=2';
				$user_joke_mod = D('user_joke');
				$count = $user_joke_mod -> where($where) -> count();
				$page = new \Think\Page($count, 10);
				$joke = $user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
				foreach ($joke as $key => $value) {
					$u = D('user') -> find($value['user_id']);
					$joke[$key]['user_info'] = $u;
				} 
				$this -> assign('joke', $joke);
				$page_str = str_replace('/home/user/followinfo', '/user/followinfo', strtolower($page -> show()));
				$this -> assign('page', $page_str);
			} 
		} 
		$this -> assign('title', '关注动态');
		$this -> display();
	} 
	private function get_trace() {
		$start = strtotime(date('Y-m', time()) . '-01');
		$where = 'user_id = ' . $this -> user['id'] . ' and created_time >=' . $start . ' and type > 0';
		$trace = $this -> user_trace_mod -> where($where) -> select();
		$income = $cost = 0;
		foreach ($trace as $key => $value) {
			if ($value['type'] == C('TRACE_STATUS_INCOME')) {
				$income += $value['value'];
			} 
			if ($value['type'] == C('TRACE_STATUS_COST')) {
				$cost += $value['value'];
			} 
		} 
		return array('income' => $income, 'cost' => $cost);
	} 
	private function cut_img($image, $x, $y, $w, $h) {
		$path = pathinfo($image);
		$type = $path['extension'];
		switch ($type) {
			case 'jpg' : $image = imagecreatefromjpeg($image);
				break;
			case 'jpeg' : $image = imagecreatefromjpeg($image);
				break;
			case 'png' : $image = imagecreatefrompng($image);
				break;
			case 'gif' : $image = imagecreatefromgif($image);
				break;
			default: $this -> ajaxReturn(array('err' => 0, 'msg' => '不支持的格式!'));
				exit;
		} 
		$copy = $this -> image_crop($image, $x, $y, $w, $h);
		$filename = $path['basename'];
		$cutPicfolder = $path['dirname'] . '/';
		$newName = 'cut_' . $filename;
		$targetPic = $cutPicfolder . $newName;
		if (false === imagejpeg($copy, $targetPic)) {
			$this -> ajaxReturn(array('err' => 0, 'msg' => '生成裁剪图片失败！请确认保存路径存在且可写！'));
		} 
		@unlink($image);
		return $targetPic;
	} 
	private function image_crop($image, $x, $y, $w, $h) {
		$tw = imagesx($image);
		$th = imagesy($image);
		if ($x > $tw || $y > $th || $w > $tw || $h > $th)return false;
		$temp = imagecreatetruecolor($w, $h);
		imagecopyresampled($temp, $image, 0, 0, $x, $y, $w, $h, $w, $h);
		return $temp;
	} 
} 

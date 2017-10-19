<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	protected $user = false;
	protected $setting;
	protected $flink;
	protected $level;
	protected $tags;
	protected $seo;
	protected function _initialize() {
		$this -> get_setting();
		if ($this -> setting['site_status']) {
			echo $this -> setting['site_colse_desc'];
			die();
		} 
		$this -> get_seo();
		$this -> get_adv();
		$this -> get_flink();
		$this -> get_tags();
		$this -> get_level();
		$this -> get_user();
		$this -> assign('is_sign', 0);
		if ($this -> user['sign_time'] > strtotime(date('Y-m-d', time()) . ' 00:00:00')) {
			$this -> assign('is_sign', 1);
		} 
		if ($this -> user && $this -> user['level'] < 99) {
			if (isset($_SESSION['start_time'])) {
				$start_time = $_SESSION['start_time'];
				$time = time();
				$t = $time - $start_time;
				if ($t > 60) {
					$t = floor($t / 60);
					$next_level = $this -> get_next_level();
					if ($this -> user['online_time'] + $t >= $next_level['minute']) {
						$t = abs($next_level['minute'] - ($this -> user['online_time'] + $t));
						$level = $this -> user['level'] + 1;
						$money = $this -> user['money'] + $next_level['award'];
						$online_time = $t;
						$params = array('user_id' => $this -> user['id'], 'value' => $next_level['award'], 'type' => C('TRACE_STATUS_INCOME'), 'content' => '升到 ' . $level . ' 级 ，获得 ' . $next_level['award'] . ' 囧币', 'created_time' => time());
						D('user_trace') -> add($params);
						D('user') -> where('id=' . $this -> user['id']) -> save(array('level' => $level, 'money' => $money, 'online_time' => $online_time));
					} else {
						D('user') -> where('id=' . $this -> user['id']) -> setField(array('online_time' => array('exp', "(online_time + {$t})")));
					} 
					$t = $_SESSION['start_time'] + ($t * 60);
					$_SESSION['start_time'] = $t;
				} 
			} 
		} 
	} 
	private function get_adv() {
		$adv_mod = D('adv');
		$adv_list = $adv_mod -> select();
		$adv = array();
		foreach ($adv_list as $val) {
			$adv[$val['name']] = $val['code'];
		} 
		$this -> adv = $adv;
		$this -> assign('adv', $this -> adv);
	} 
	private function get_user() {
		$id = 0;
		if (isset($_SESSION['xj_id']) && isset($_SESSION['xj_expire'])) {
			if ($_SESSION['xj_expire'] <= time()) {
				unset($_SESSION['xj_id']);
				unset($_SESSION['xj_expire']);
			} else {
				$id = $_SESSION['xj_id'];
				$_SESSION['xj_expire'] = time() + C('SESSION_EXPIRE');
			} 
		} else {
			if (isset($_COOKIE['user']['id'])) {
				$id = $_COOKIE['user']['id'];
				if (!isset($_SESSION['start_time'])) {
					$_SESSION['start_time'] = time();
				} 
			} 
		} 
		$user_mod = D('user');
		$this -> user = $user_mod -> where('id=' . $id) -> find();
		if ($this -> user) {
			unset($this -> user['password']);
			$this -> assign('user', $this -> user);
		} 
	} 
	private function get_setting() {
		$setting_mod = D('setting');
		$setting = $setting_mod -> select();
		foreach ($setting as $val) {
			$set[$val['name']] = $val['data'];
		} 
		$this -> setting = $set;
		$this -> assign('setting', $this -> setting);
	} 
	private function get_seo() {
		$seo_mod = D('seo');
		$seo = $seo_mod -> select();
		$this -> seo = $seo;
		$this -> assign('seo', $this -> seo);
	} 
	private function get_flink() {
		if (S('flink')) {
			$flink = S('flink');
		} else {
			$flink_mod = D('flink');
			$flink = $flink_mod -> order('ordid asc') -> select();
			S('flink', $flink, '3600');
		} 
		$this -> flink = $flink;
		$this -> assign('flink', $this -> flink);
	} 
	private function get_tags() {
		if (S('tags')) {
			$tags = S('tags');
		} else {
			$tags_mod = D('tags');
			$tags = $tags_mod -> order('sort asc') -> select();
			S('tags', $tags, '3600');
		} 
		$this -> tags = $tags;
		$this -> assign('tags', $this -> tags);
	} 
	private function get_level() {
		if (S('level')) {
			$level = S('level');
		} else {
			$level_mod = D('level');
			$level = $level_mod -> order('level asc') -> select();
			S('level', $level, '3600');
		} 
		$this -> level = $level;
		$this -> assign('level', $this -> level);
	} 
	protected function getseo($alias, $page = '') {
		foreach ($this -> seo as $key => $value) {
			if ($value['alias'] == $alias) {
				$this -> assign('title', $value['title'] . $page);
				$this -> assign('keywords', $value['keywords']);
				$this -> assign('description', $value['description']);
			} 
		} 
	} 
	protected function get_curr_level() {
		$level = array();
		foreach ($this -> level as $key => $value) {
			if ($value['level'] == $this -> user['level']) {
				$level = $value;
			} 
		} 
		return $level;
	} 
	protected function get_next_level() {
		$level = array();
		foreach ($this -> level as $key => $value) {
			if ($value['level'] == $this -> user['level'] + 1) {
				$level = $value;
			} 
		} 
		return $level;
	} 
	protected function get_good_joke($type) {
		$user_joke_mod = D('user_joke');
		$where = 'type = ' . $type . ' and status = ' . C('JOKE_STATUS_AUDIT');
		$user_joke = $user_joke_mod -> where($where) -> order('good_num desc') -> limit('0,10') -> select();
		return $user_joke;
	} 
	protected function get_audit_day_user() {
		$time = strtotime(date('Y-m-d', time()));
		return $this -> get_audit_user($time);
	} 
	protected function get_audit_week_user() {
		$day = date('w');
		if ($day == 0)$day = 7;
		$time = strtotime(date('Y-m-d', strtotime("-{$day} day")) . ' 23:59:59');
		return $this -> get_audit_user($time);
	} 
	private function get_audit_user($time) {
		$where = "j.status=" . C('JOKE_STATUS_AUDIT') . ' and a.type < 4 and a.created_time >=' . $time;
		$field = "j.id,j.status,a.joke_id,a.user_id";
		$join = "a left join jxb_user_joke j on a.joke_id=j.id";
		$audit = D('user_audit') -> field($field) -> join($join) -> where($where) -> select();
		$user_list = array();
		foreach ($audit as $key => $value) {
			if (isset($user_list[$value['user_id']])) {
				$user_list[$value['user_id']] += 1;
			} else {
				$user_list[$value['user_id']] = 1;
			} 
		} 
		arsort($user_list);
		foreach ($user_list as $key => $value) {
			$user = D('user') -> find($key);
			$user_list[$key] = $user;
			$user_list[$key]['day_audit_num'] = $value;
		} 
		return $user_list;
	} 
	protected function get_rand_user() {
		$user_mod = D('user');
		$user = $user_mod -> where('status=1') -> order('rand()') -> limit('0,12') -> select();
		return $user;
	} 
	protected function reduce_money($money) {
		if ($money && $this -> user['money'] >= $money) {
			$user_mod = D('user');
			$m = $this -> user['money'] - $money;
			if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('money' => $m))) {
				return true;
			} 
		} 
		return false;
	} 
	protected function add_money($money) {
		if ($money) {
			$user_mod = D('user');
			$m = $this -> user['money'] + $money;
			if ($user_mod -> where('id=' . $this -> user['id']) -> save(array('money' => $m))) {
				return true;
			} 
		} 
		return false;
	} 
	protected function get_record($joke_id) {
		if ($this -> user) {
			$user_id = $this -> user['id'];
		} else {
			$user_id = session_id();
		} 
		$user_record_mod = D('user_record');
		$user_record = $user_record_mod -> where('user_id="' . $user_id . '" and joke_id=' . $joke_id) -> find();
		$user_joke = D('user_joke') -> where('id=' . $joke_id) -> find();
		if ($user_joke && $user_joke['package_user_id'] > 0) {
			$p_user = D('user') -> where('id=' . $user_joke['package_user_id']) -> find();
			$user_record['package_info'] = $p_user;
		} 
		return $user_record;
	} 
	protected function get_review($joke_id, $page = 1) {
		$user_review_mod = D('user_review');
		$where = 'joke_id=' . $joke_id . ' and status=' . C('REVIEW_STATUS_AUDIT');
		$count = $user_review_mod -> where($where) -> count();
		$pagesize = 5;
		$start = ($page - 1) * $pagesize;
		$user_review = $user_review_mod -> where($where) -> limit($start . ',' . $pagesize) -> order('id desc') -> select();
		foreach ($user_review as $key => $value) {
			$user_review[$key]['user_info'] = D('user') -> where('id=' . $value['user_id']) -> find();
		} 
		return $user_review;
	} 
	protected function msg($info, $msg) {
		$this -> assign('info', $info);
		$this -> assign('msg', $msg);
		$this -> display('Public:Index_msg');
		exit;
	} 
	protected function send_email($address, $title, $message) {
		vendor('PHPMailer.PHPMailer');
		$mail = new \PHPMailer();
		$mail -> IsHTML(true);
		$mail -> IsSMTP();
		$mail -> CharSet = 'UTF-8';
		$mail -> AddAddress($address);
		$mail -> Body = $message;
		$mail -> From = $this -> setting['mail_send_address'];
		$mail -> FromName = $this -> setting['mail_fromname'];
		$mail -> Subject = $title;
		$mail -> Host = $this -> setting['mail_smtp'];
		$mail -> Port = '465';
		$mail -> SMTPSecure = 'ssl';
		$mail -> SMTPAuth = true;
		$mail -> Username = $this -> setting['mail_smtp_address'];
		$mail -> Password = $this -> setting['mail_smtp_password'];
		return($mail -> Send());
	} 
	protected function substr_pwd($pwd) {
		$pwd = md5($pwd);
		if (strlen($pwd) == 32) {
			return substr($pwd, 8, 16);
		} 
		return $pwd;
	} 
	protected function rand_six_num() {
		return mt_rand(100000, 999999);
	} 
	protected function check_login() {
		if (!$this -> user) {
			if (IS_AJAX) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '请先登录!'));
			} 
			echo '<script>window.location="/account/login";</script>';
			exit();
		} 
	} 
	protected function check_word($content) {
		$word = $this -> setting['sensitive'];
		$word = explode(',', $word);
		foreach ($word as $key => $value) {
			if (strpos($content, $value) > -1) {
				return true;
			} 
		} 
		return false;
	} 
	protected function get_joke_goodnum($uid) {
		$joke = D('user_joke') -> field('sum(good_num) as good_num') -> where('user_id=' . $uid . ' and status=2') -> find();
		return (int)$joke['good_num'];
	} 
} 

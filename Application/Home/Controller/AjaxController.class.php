<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends UserController {
	protected function _initialize() {
		parent :: _initialize();
	} 
	public function award() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			$fee = (int)$_POST['fee'];
			$user_joke_mod = D('user_joke');
			$user_joke = $user_joke_mod -> where('id=' . $id) -> find();
			if ($user_joke) {
				if ($user_joke['user_id'] == $this -> user['id']) {
					$this -> ajaxReturn(array('err' => 0, 'msg' => '自己不能打赏自己!'));
				} 
				$user_record_mod = D('user_record');
				$user_record = $user_record_mod -> where('joke_id=' . $id . ' and user_id=' . $this -> user['id']) -> find();
				if ($user_record && $user_record['award'] == 1) {
					$this -> ajaxReturn(array('err' => 0, 'msg' => '您已打赏过了!'));
				} 
				if ($this -> reduce_money($fee)) {
					$params = array('user_id' => $this -> user['id'], 'value' => $fee, 'type' => C('TRACE_STATUS_COST'), 'content' => '打赏了 ' . $user_joke['title'] . ' ，花了 ' . $fee . ' 囧币', 'created_time' => time());
					D('user_trace') -> add($params);
					if (!$user_record) {
						$data = array();
						$data['type'] = '';
						$data['joke_id'] = $id;
						$data['user_id'] = $this -> user['id'];
						$data['award'] = 1;
						$data['created_time'] = time();
						$user_record_mod -> add($data);
					} else {
						$user_record_mod -> where('id=' . $user_record['id']) -> save(array('award' => 1));
					} 
				} else {
					$this -> ajaxReturn(array('err' => 0, 'msg' => '囧币不足!'));
				} 
				$user_id = $user_joke['user_id'];
				if ($user_joke['is_package'] == 1 && $user_joke['package_user_id'] > 0) {
					$user_id = $user_joke['package_user_id'];
				} 
				$joke_user = D('user') -> where('id=' . $user_id) -> find();
				$m = $joke_user['money'] + $fee;
				D('user') -> where('id=' . $user_id) -> save(array('money' => $m));
				$params = array('user_id' => $user_id, 'value' => $fee, 'type' => C('TRACE_STATUS_INCOME'), 'content' => $user_joke['title'] . ' 被打赏了，获得 ' . $fee . ' 囧币', 'created_time' => time());
				D('user_trace') -> add($params);
				D('user_joke') -> where('id=' . $id) -> setField(array('award_num' => array('exp', "(award_num + {$fee})")));
				$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
	public function review() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			$content = $_POST['content'];
			if (mb_strlen($content, 'utf8') > 140) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '评论内容请保持140个字符!'));
			} 
			if ($this -> check_word($content)) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '不能有非法字符!'));
			} 
			$user_review_mod = D('user_review');
			$data = array();
			$data['at_user_id'] = (int)$_POST['at_user_id'];
			$data['joke_id'] = $id;
			$data['user_id'] = $this -> user['id'];
			$data['content'] = $content;
			$data['created_time'] = time();
			$data['status'] = C('REVIEW_STATUS_UNAUDIT');
			if ($user_review_mod -> add($data)) {
				$review = $this -> get_review($id);
				$this -> ajaxReturn(array('err' => 1, 'msg' => $review));
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
	public function package() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			$user_joke_mod = D('user_joke');
			$user_joke = $user_joke_mod -> where('id=' . $id) -> find();
			if ($user_joke && $user_joke['is_package'] == 0) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '此笑话不可包养!'));
			} 
			if ($user_joke && $user_joke['package_user_id'] > 0) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '很遗憾，您下手晚了!'));
			} 
			if ($user_joke && $user_joke['user_id'] == $this -> user['id']) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '自己不能包养自己!'));
			} 
			$user_record_mod = D('user_record');
			$user_record = $user_record_mod -> where('joke_id=' . $id . ' and user_id=' . $this -> user['id']) -> find();
			if ($user_record && $user_record['package'] == 1) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '您已包养过了!'));
			} 
			if ($user_joke && $user_joke['is_package'] == 1 && $user_joke['package_user_id'] == 0 && $user_joke['user_id'] != $this -> user['id']) {
				$fee = $user_joke['package_fee'];
				if ($this -> reduce_money($fee)) {
					$params = array('user_id' => $this -> user['id'], 'value' => $fee, 'type' => C('TRACE_STATUS_COST'), 'content' => '包养了 ' . $user_joke['title'] . ' ，花了 ' . $fee . ' 囧币', 'created_time' => time());
					D('user_trace') -> add($params);
					$user_joke_mod -> where('id=' . $id) -> save(array('package_user_id' => $this -> user['id']));
					if (!$user_record) {
						$data = array();
						$data['type'] = '';
						$data['joke_id'] = $id;
						$data['user_id'] = $this -> user['id'];
						$data['package'] = 1;
						$data['created_time'] = time();
						$user_record_mod -> add($data);
					} else {
						$user_record_mod -> where('id=' . $user_record['id']) -> save(array('package' => 1));
					} 
					$joke_user = D('user') -> where('id=' . $user_joke['user_id']) -> find();
					$m = $joke_user['money'] + $fee;
					D('user') -> where('id=' . $user_joke['user_id']) -> save(array('money' => $m));
					$params = array('user_id' => $user_joke['user_id'], 'value' => $fee, 'type' => C('TRACE_STATUS_INCOME'), 'content' => $user_joke['title'] . ' 被包养了，获得 ' . $fee . ' 囧币', 'created_time' => time());
					D('user_trace') -> add($params);
					$this -> ajaxReturn(array('err' => 1, 'msg' => array('id' => $this -> user['id'], 'username' => $this -> user['username'])));
				} 
				$this -> ajaxReturn(array('err' => 0, 'msg' => '囧币不足!'));
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
	public function sign() {
		if (IS_AJAX) {
			$day = date('Y-m-d', time());
			$time = strtotime($day . ' 00:00:00');
			if ($this -> user['sign_time'] > $time) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '不能重复签到!'));
			} else {
				$money = $this -> user['money'] + C('SIGN_MONEY');
				if (D('user') -> where('id=' . $this -> user['id']) -> save(array('sign_time' => time(), 'money' => $money))) {
					$params = array('user_id' => $this -> user['id'], 'value' => C('SIGN_MONEY'), 'type' => C('TRACE_STATUS_INCOME'), 'content' => $day . ' 日签到，获得 ' . C('SIGN_MONEY') . ' 囧币', 'created_time' => time());
					D('user_trace') -> add($params);
					$this -> ajaxReturn(array('err' => 1, 'msg' => '签到成功!'));
				} 
			} 
		} 
	} 
	public function follow() {
		if (IS_AJAX) {
			$uid = (int)I('post.uid');
			if ($uid == $this -> user['id']) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '不能关注自己!'));
			} 
			$check = check_follow($this -> user['id'], $uid);
			if ($check) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '已关注!'));
			} 
			$user_fans_mod = D('user_fans');
			$user = D('user') -> find($uid);
			$fans = $user_fans_mod -> where('uid=' . $this -> user['id']) -> find();
			if (!$fans) {
				$data = array('uid' => $this -> user['id'], 'follow_uids' => '|' . $uid . '|');
				$user_fans_mod -> add($data);
			} else {
				if (trim($fans['follow_uids']) != '') {
					$follow_uids = $fans['follow_uids'] . $uid . '|';
				} else {
					$follow_uids = '|' . $uid . '|';
				} 
				$user_fans_mod -> where('uid=' . $this -> user['id']) -> save(array('follow_uids' => $follow_uids));
			} 
			D('user') -> where('id=' . $this -> user['id']) -> setField(array('follows' => array('exp', "(follows + 1)")));
			D('user') -> where('id=' . $uid) -> setField(array('fans' => array('exp', "(fans + 1)")));
			$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
		} 
		$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
	} 
	public function cancelfollow() {
		if (IS_AJAX) {
			$uid = (int)I('post.uid');
			$user_fans_mod = D('user_fans');
			$fans = $user_fans_mod -> where('uid=' . $this -> user['id']) -> find();
			if ($fans) {
				$array = array();
				$uids = explode('|', $fans['follow_uids']);
				array_shift($uids);
				array_pop($uids);
				foreach ($uids as $key => $value) {
					if ($value != $uid) {
						array_push($array, $value);
					} 
				} 
				if (count($array) > 0) {
					$uids = implode('|', $array);
					$uids = '|' . $uids . '|';
				} else {
					$uids = '';
				} 
				$user_fans_mod -> where('uid=' . $this -> user['id']) -> save(array('follow_uids' => $uids));
				D('user') -> where('id=' . $this -> user['id']) -> setField(array('follows' => array('exp', "(follows - 1)")));
				D('user') -> where('id=' . $uid) -> setField(array('fans' => array('exp', "(fans - 1)")));
				$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
			} 
		} 
		$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
	} 
	public function send_msg() {
		if (IS_AJAX) {
			$uid = (int)I('post.uid');
			$user_msg_mod = D('user_msg');
			$data = $user_msg_mod -> create();
			$data['send_uid'] = $this -> user['id'];
			$data['to_uid'] = $uid;
			$data['created_time'] = time();
			if ($user_msg_mod -> add($data)) {
				$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
} 

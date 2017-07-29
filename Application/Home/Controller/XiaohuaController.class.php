<?php
namespace Home\Controller;
use Think\Controller;
class XiaohuaController extends BaseController {
	public function index() {
		$id = isset($_GET['id'])? (int)$_GET['id'] : '';
		if ($id) {
			$user_joke_mod = D('user_joke');
			$user_joke = $user_joke_mod -> where('id=' . $id) -> find();
			if ($user_joke && $user_joke['status'] == C('JOKE_STATUS_AUDIT')) {
				$user_joke['record'] = $this -> get_record($user_joke['id']);
				$user = D('user') -> where('id=' . $user_joke['user_id']) -> find();
				$user_joke['user_info'] = $user;
				$review = $this -> get_review($id);
				$count = D('user_review') -> where('joke_id=' . $id) -> count();
				$rel_joke = $this -> get_rel_joke($id);
				$this -> assign('count', $count);
				$this -> assign('review', $review);
				$this -> assign('user_joke', $user_joke);
				$this -> assign('rel_joke', $rel_joke);
				$text = $this -> get_good_joke(C('JOKE_TYPE_TEXT'));
				$this -> assign('text', $text);
				$pic = $this -> get_good_joke(C('JOKE_TYPE_PIC'));
				$this -> assign('pic', $pic);
				$video = $this -> get_good_joke(C('JOKE_TYPE_VIDEO'));
				$this -> assign('video', $video);
				$gif = $this -> get_good_joke(C('JOKE_TYPE_GIF'));
				$this -> assign('gif', $gif);
				$this -> assign('title', $user_joke['title']);
				$joke_tags = array();
				$tags_id = explode('|', $user_joke['tags_id']);
				$send_week_user = $this -> get_send_week_user();
				$audit_week_user = $this -> get_audit_week_user();
				$this -> assign('audit_week_user', $audit_week_user);
				$this -> assign('send_week_user', $send_week_user);
				if (count($tags_id) > 1) {
					array_shift($tags_id);
					array_pop($tags_id);
					$tags_id = implode(',', $tags_id);
					$joke_tags = D('tags') -> field('id,name') -> where('id in(' . $tags_id . ')') -> select();
				} 
				$this -> assign('joke_tags', $joke_tags);
				$this -> display();
				exit;
			} else {
				$this -> error('您所需要查找的内容未审核或审核末通过！', '/');
			} 
		} 
		$this -> error('参数错误', '/');
	} 
	public function record() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			$type = $_POST['type'];
			if ($this -> user) {
				$user_id = $this -> user['id'];
			} else {
				$user_id = session_id();
			} 
			$user_record_mod = D('user_record');
			$user_record = $user_record_mod -> where('joke_id=' . $id . ' and user_id="' . $user_id . '"') -> find();
			if (!$user_record) {
				$data = array();
				$data['type'] = $type;
				$data['joke_id'] = $id;
				$data['user_id'] = $user_id;
				$data['created_time'] = time();
				if ($user_record_mod -> add($data)) {
					if ($type == 'good') {
						D('user_joke') -> where('id=' . $id) -> setField(array('good_num' => array('exp', "(good_num + 1)")));
					} 
					if ($type == 'bad') {
						D('user_joke') -> where('id=' . $id) -> setField(array('bad_num' => array('exp', "(bad_num + 1)")));
					} 
					$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
				} 
			} else {
				if ($user_record['type'] == '') {
					$user_record_mod -> where('joke_id=' . $id . ' and user_id="' . $user_id . '"') -> save(array('type' => $type));
					if ($type == 'good') {
						D('user_joke') -> where('id=' . $id) -> setField(array('good_num' => array('exp', "(good_num + 1)")));
					} 
					if ($type == 'bad') {
						D('user_joke') -> where('id=' . $id) -> setField(array('bad_num' => array('exp', "(bad_num + 1)")));
					} 
					$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
				} 
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
	public function reviewrecord() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			if ($this -> user) {
				$user_id = $this -> user['id'];
			} else {
				$user_id = session_id();
			} 
			$user_review_record_mod = D('user_review_record');
			$user_review_record = $user_review_record_mod -> where('review_id=' . $id . ' and user_id="' . $user_id . '"') -> find();
			if (!$user_review_record) {
				$data = array();
				$data['review_id'] = $id;
				$data['user_id'] = $user_id;
				$data['created_time'] = time();
				if ($user_review_record_mod -> add($data)) {
					D('user_review') -> where('id=' . $id) -> setField(array('good_num' => array('exp', "(good_num + 1)")));
					$god_reply = D('user_review') -> where('id=' . $id . ' and good_num > 10') -> find();
					if ($god_reply) {
						D('user_joke') -> where('id=' . $god_reply['joke_id']) -> save(array('god_reply' => 1));
					} 
					$this -> ajaxReturn(array('err' => 1, 'msg' => '操作成功!'));
				} 
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '操作失败!'));
		} 
	} 
	public function getreview() {
		if (IS_AJAX) {
			$id = (int)$_POST['id'];
			$p = (int)$_POST['p'];
			$review = $this -> get_review($id, $p);
			$this -> ajaxReturn(array('err' => 1, 'msg' => $review));
		} 
	} 
	private function get_rel_joke($joke_id) {
		$where = 'status=' . C('JOKE_STATUS_AUDIT');
		$user_joke_mod = D('user_joke');
		$pre_joke = $user_joke_mod -> where($where . ' and id > ' . $joke_id) -> order('id asc') -> find();
		$next_joke = $user_joke_mod -> where($where . ' and id < ' . $joke_id) -> order('id desc') -> find();
		$pre_joke_id = $pre_joke ? $pre_joke['id'] : 0;
		$next_joke_id = $next_joke ? $next_joke['id'] : 0;
		return array('pre_joke_id' => $pre_joke_id, 'next_joke_id' => $next_joke_id);
	} 
} 

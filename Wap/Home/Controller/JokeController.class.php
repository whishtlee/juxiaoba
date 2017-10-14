<?php
namespace Home\Controller;
use Think\Controller;
class JokeController extends BaseController {
	public function search() {
		$k = isset($_GET['key'])? $_GET['key'] : '';
		if ($k) {
			$user_joke_mod = D('user_joke');
			$where = '(title like "%' . $k . '%" or (content like "%' . $k . '%" and type=' . C('JOKE_TYPE_TEXT') . ')) and status = ' . C('JOKE_STATUS_AUDIT');
			$count = $user_joke_mod -> where($where) -> count();
			$page = new \Think\Page($count, 10);
			$user_joke = $user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
			foreach ($user_joke as $key => $value) {
				$record = $this -> get_record($value['id']);
				$user_joke[$key]['record'] = $record;
				$user = D('user') -> find($value['user_id']);
				$user_joke[$key]['user_info'] = $user;
			} 
			$this -> assign('user_joke', $user_joke);
			$page_str = str_replace('/home/joke/search/key/' . urlencode($k) . '/p/', '', strtolower($page -> show()));
			$page_str = str_replace('.html', '', $page_str);
			$page_str = str_replace('href="', 'href="/joke/search?key=' . urlencode($k) . '&p=', $page_str);
			$this -> assign('page', $page_str);
			$this -> assign('count', $count);
			$this -> assign('key', $k);
			$this -> assign('title', '笑话搜索');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function publish() {
		$this -> check_login();
		$user_joke_mod = D('user_joke');
		$time = strtotime(date('Y-m-d', time()));
		$count = $user_joke_mod -> where('user_id=' . $this -> user['id'] . ' and created_time>=' . $time) -> count();
		$level = $this -> get_curr_level();
		if (IS_AJAX) {
			$user_joke = $user_joke_mod -> create();
			if (trim($_POST['title']) == '') {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '标题不能为空!'));
			} 
			if (isset($_POST['is_video']) && $_POST['is_video'] == 1) {
				if (trim($_POST['vedio_type']) == 1) {
					if (trim($_POST['url']) == '') {
						$this -> ajaxReturn(array('err' => 0, 'msg' => '外链URL地址不能为空!'));
					} 
				} else {
					if (trim($_POST['vedio_url']) == '') {
						$this -> ajaxReturn(array('err' => 0, 'msg' => '请上传视频后提交!'));
					} 
				} 
				$user_joke['type'] = C('JOKE_TYPE_video');
				$user_joke['content'] = $_POST['url'];
				if ($_POST['vedio_type'] == 2 && trim($_POST['vedio_url']) == '') {
					$this -> ajaxReturn(array('err' => 0, 'msg' => '请上传视频!'));
				} 
				$user_joke['type'] = C('JOKE_TYPE_video');
				$user_joke['image'] = trim($_POST['image']);
				$user_joke['content'] = $_POST['vedio_type'] == 1 ? $_POST['url'] : $_POST['vedio_url'];
				$user_joke['status'] = C('JOKE_STATUS_UNAUDIT');
				$user_joke['audit_time'] = time();
			} 
			if ($this -> check_word($user_joke['title']) || $this -> check_word($user_joke['content'])) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '不能有非法字符!'));
			} 
			if (trim($user_joke['title']) != '' || trim($user_joke['content']) != '') {
				if ($user_joke['is_package'] == 0) {
					$user_joke['package_fee'] = 0;
				} 
				$user_joke['user_id'] = $this -> user['id'];
				$user_joke['created_time'] = time();
				$user_joke['status'] = C('JOKE_STATUS_UNAUDIT');
				if (count($user_joke['tags_id']) > 0) {
					$tags_id = '|' . implode('|', $user_joke['tags_id']) . '|';
				} else {
					$tags_id = '';
				} 
				$user_joke['tags_id'] = $tags_id;
				if ($user_joke_mod -> add($user_joke)) {
					$this -> ajaxReturn(array('err' => 1, 'msg' => '发布成功，请等待审核！'));
				} 
			} 
		} 
		$this -> assign('allow', 1);
		$model = M('tags');
		$list = $model -> where('sort' < 10) -> select();
		$this -> assign('list', $list);
		$this -> assign('title', '发布笑话');
		$this -> display();
	} 
	public function audit() {
		$this -> check_login();
		$user_audit_mod = D('user_audit');
		$user_joke_mod = D('user_joke');
		$user_audit = $user_audit_mod -> where('user_id=' . $this -> user['id']) -> select();
		$count = count($user_audit);
		$joke_ids = array();
		$week_count = 0;
		$week = strtotime('-7 day');
		foreach ($user_audit as $key => $value) {
			if ($value['created_time'] >= $week) {
				$week_count++;
			} 
			array_push($joke_ids, $value['joke_id']);
		} 
		if (IS_AJAX) {
			$joke_id = (int)$_POST['joke_id'];
			$type = (int)$_POST['type'];
			if (in_array($joke_id, $joke_ids)) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '该笑话已您审稿!'));
			} 
			$data = $user_audit_mod -> create();
			$data['joke_id'] = $joke_id;
			$data['user_id'] = $this -> user['id'];
			$data['created_time'] = time();
			$data['type'] = $type;
			$user_audit_mod -> add($data);
			if ($type < 4) {
				$user_joke_mod -> where('id=' . $joke_id) -> setField(array('audit_num' => array('exp', "(audit_num + 1)")));
				D('user') -> where('id=' . $this -> user['id']) -> setField(array('audit_num' => array('exp', "(audit_num + 1)")));
			} 
			$this -> ajaxReturn(array('err' => 1, 'msg' => '审稿成功!'));
		} 
		if (count($joke_ids) > 0) {
			$joke_ids = implode(',', $joke_ids);
		} else {
			$joke_ids = 0;
		} 
		$joke = $user_joke_mod -> where('id not in(' . $joke_ids . ') and status = 1') -> order('id desc') -> find();
		$this -> assign('count', $count);
		$this -> assign('week_count', $week_count);
		$this -> assign('joke', $joke);
		$this -> assign('title', '审稿');
		$this -> display();
	} 
} 

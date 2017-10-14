<?php
namespace Home\Controller;
use Think\Controller;
class MainController extends BaseController {
	protected function _initialize() {
		parent :: _initialize();
		$next_level = $this -> get_next_level();
		$this -> assign('next_level', $next_level);
		$user_list = $this -> get_rand_user();
		$this -> assign('user_list', $user_list);
	} 
	public function index() {
		$user_id = isset($_GET['user_id'])? (int)$_GET['user_id'] : 0;
		if ($user_id) {
			$user_info = D('user') -> where('id=' . $user_id) -> find();
			$user_info['good_num'] = $this -> get_joke_goodnum($user_id);
			$where = 'user_id=' . $user_id . ' and status=' . C('JOKE_STATUS_AUDIT');
			$user_joke_mod = D('user_joke');
			$count = $user_joke_mod -> where($where) -> count();
			$page = new \Think\Page($count, 10);
			$user_joke = $user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
			foreach ($user_joke as $key => $value) {
				$user_joke[$key]['record'] = $this -> get_record($value['id']);
				$user = D('user') -> find($value['user_id']);
				$user_joke[$key]['user_info'] = $user;
			} 
			$level = array();
			foreach ($this -> level as $key => $value) {
				if ($value['level'] == $user_info['level'] + 1) {
					$level = $value;
				} 
			} 
			$page_str = str_replace('/home/main/index/user_id/', '/user/', strtolower($page -> show()));
			$this -> assign('count', $count);
			$this -> assign('user_joke', $user_joke);
			$this -> assign('user_info', $user_info);
			$this -> assign('user_level', $level);
			$this -> assign('page', $page_str);
			$this -> assign('title', $user_info['username'] . '用户主页');
			$this -> assign('keywords', $user_info['username'] . '用户主页');
			$this -> assign('description', $user_info['username'] . '用户主页');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function follows() {
		$user_id = isset($_GET['user_id'])? (int)$_GET['user_id'] : 0;
		if ($user_id) {
			$user_info = D('user') -> where('id=' . $user_id) -> find();
			$user_info['good_num'] = $this -> get_joke_goodnum($user_id);
			$where = 'uid=' . $user_id;
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
			$level = array();
			foreach ($this -> level as $key => $value) {
				if ($value['level'] == $user_info['level'] + 1) {
					$level = $value;
				} 
			} 
			$page_str = str_replace('/home/main/follows/user_id/', '/user/follows/', strtolower($page_str));
			$this -> assign('count', $count);
			$this -> assign('follow', $follow);
			$this -> assign('user_info', $user_info);
			$this -> assign('user_level', $level);
			$this -> assign('page', $page_str);
			$this -> assign('title', $user_info['username'] . '关注列表');
			$this -> assign('keywords', $user_info['username'] . '关注列表');
			$this -> assign('description', $user_info['username'] . '关注列表');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function fans() {
		$user_id = isset($_GET['user_id'])? (int)$_GET['user_id'] : 0;
		if ($user_id) {
			$user_info = D('user') -> where('id=' . $user_id) -> find();
			$user_info['good_num'] = $this -> get_joke_goodnum($user_id);
			$where = 'follow_uids like "%|' . $user_id . '|%"';
			$count = D('user_fans') -> where($where) -> count();
			$page = new \Think\Page($count, 10);
			$follow = D('user_fans') -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
			foreach ($follow as $key => $value) {
				$user = D('user') -> find($value['uid']);
				$follow[$key] = $user;
			} 
			$page_str = $page -> show();
			$level = array();
			foreach ($this -> level as $key => $value) {
				if ($value['level'] == $user_info['level'] + 1) {
					$level = $value;
				} 
			} 
			$page_str = str_replace('/home/main/fans/user_id/', '/user/fans/', strtolower($page_str));
			$this -> assign('count', $count);
			$this -> assign('follow', $follow);
			$this -> assign('user_info', $user_info);
			$this -> assign('user_level', $level);
			$this -> assign('page', $page_str);
			$this -> assign('title', $user_info['username'] . '粉丝列表');
			$this -> assign('keywords', $user_info['username'] . '粉丝列表');
			$this -> assign('description', $user_info['username'] . '粉丝列表');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
} 

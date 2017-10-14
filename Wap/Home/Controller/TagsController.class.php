<?php
namespace Home\Controller;
use Think\Controller;
class TagsController extends BaseController {
	private $tags_mod;
	protected function _initialize() {
		parent :: _initialize();
		$this -> tags_mod = D('tags');
	} 
	public function index() {
		$this -> getseo('tags');
		$this -> display();
	} 
	public function info() {
		if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
			$id = (int)$_GET['id'];
			$tag_info = array();
			foreach ($this -> tags as $key => $value) {
				if ($value['id'] == $id) {
					$tag_info = $value;
				} 
			} 
			$this -> assign('tag_info', $tag_info);
			$user_joke_mod = D('user_joke');
			$tags_id = '|' . $id . '|';
			$where = 'status = ' . C('JOKE_STATUS_AUDIT') . ' and tags_id like "%' . $tags_id . '%"';
			$count = $user_joke_mod -> where($where) -> count();
			$page = new \Think\Page($count, 10);
			$user_joke = $user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('id desc') -> select();
			foreach ($user_joke as $key => $value) {
				$user_joke[$key]['record'] = $this -> get_record($value['id']);
				$user = D('user') -> find($value['user_id']);
				$user_joke[$key]['user_info'] = $user;
			} 
			$this -> assign('user_joke', $user_joke);
			$page_str = str_replace('/home/tags/info/id/' . $id . '/p/', '/tags/' . $id . '_', strtolower($page -> show()));
			$this -> assign('page', $page_str);
			$this -> assign('count', $count);
			$day_count = 0;
			$time = strtotime(date('Y-m-d', time()));
			foreach ($user_joke as $key => $value) {
				if ($value['created_time'] >= $time) {
					$day_count++;
				} 
			} 
			$this -> assign('day_count', $day_count);
			$text = $this -> get_tags_by_type($tags_id, C('JOKE_TYPE_TEXT'));
			$this -> assign('text', $text);
			$pic = $this -> get_tags_by_type($tags_id, C('JOKE_TYPE_PIC'));
			$this -> assign('pic', $pic);
			$this -> assign('title', $tag_info['seo_title']);
			$this -> assign('keywords', $tag_info['seo_keywords']);
			$this -> assign('description', $tag_info['seo_description']);
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	private function get_tags_by_type($tags_id, $type) {
		$user_joke_mod = D('user_joke');
		$where = 'type = ' . $type . ' and status = ' . C('JOKE_STATUS_AUDIT') . ' and tags_id like "%' . $tags_id . '%"';
		$user_joke = $user_joke_mod -> where($where) -> order('good_num desc') -> limit('0,10') -> select();
		return $user_joke;
	} 
} 

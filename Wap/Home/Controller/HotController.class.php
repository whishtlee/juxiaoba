<?php
namespace Home\Controller;
use Think\Controller;
class HotController extends BaseController {
	private $user_joke_mod;
	protected function _initialize() {
		parent :: _initialize();
		$this -> user_joke_mod = D('user_joke');
		$text = $this -> get_good_joke(C('JOKE_TYPE_TEXT'));
		$this -> assign('text', $text);
		$pic = $this -> get_good_joke(C('JOKE_TYPE_PIC'));
		$this -> assign('pic', $pic);
		$audit_day_user = $this -> get_audit_day_user();
		$audit_week_user = $this -> get_audit_week_user();
		$this -> assign('audit_day_user', $audit_day_user);
		$this -> assign('audit_week_user', $audit_week_user);
	} 
	public function index() {
		$time = time() - (8 * 3600);
		$where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and created_time >=' . $time;
		$count = $this -> user_joke_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$user_joke = $this -> user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('good_num desc') -> select();
		foreach ($user_joke as $key => $value) {
			$record = $this -> get_record($value['id']);
			$user_joke[$key]['record'] = $record;
			$user = D('user') -> find($value['user_id']);
			$user_joke[$key]['user_info'] = $user;
		} 
		$this -> assign('user_joke', $user_joke);
		$page_str = str_replace('/home/hot/index/p/', '/hotjoke/index_', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> getseo('hot');
		$this -> display();
	} 
	public function week() {
		$time = strtotime('-7 day');
		$where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and created_time >=' . $time;
		$count = $this -> user_joke_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$user_joke = $this -> user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('good_num desc') -> select();
		foreach ($user_joke as $key => $value) {
			$record = $this -> get_record($value['id']);
			$user_joke[$key]['record'] = $record;
			$user = D('user') -> find($value['user_id']);
			$user_joke[$key]['user_info'] = $user;
		} 
		$this -> assign('user_joke', $user_joke);
		$page_str = str_replace('/home/hot/week/p/', '/hotjoke/week_', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> getseo('week');
		$this -> display();
	} 
	public function month() {
		$time = strtotime('-1 month');
		$where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and created_time >=' . $time;
		$count = $this -> user_joke_mod -> where($where) -> count();
		$page = new \Think\Page($count, 10);
		$user_joke = $this -> user_joke_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> order('good_num desc') -> select();
		foreach ($user_joke as $key => $value) {
			$record = $this -> get_record($value['id']);
			$user_joke[$key]['record'] = $record;
			$user = D('user') -> find($value['user_id']);
			$user_joke[$key]['user_info'] = $user;
		} 
		$this -> assign('user_joke', $user_joke);
		$page_str = str_replace('/home/hot/month/p/', '/hotjoke/month_', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$this -> getseo('month');
		$this -> display();
	} 
} 

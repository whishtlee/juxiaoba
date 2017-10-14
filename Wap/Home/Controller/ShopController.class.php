<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends BaseController {
	private $shop_cate_mod;
	private $shop_gift_mod;
	protected function _initialize() {
		parent :: _initialize();
		$this -> shop_cate_mod = D('shop_cate');
		$this -> shop_gift_mod = D('shop_gift');
		$user_gift = $this -> get_new_exchange();
		$this -> assign('user_gift', $user_gift);
	} 
	public function index() {
		$where = 'status=1';
		$cate_id = 0;
		if (isset($_GET['cate_id']) && (int)$_GET['cate_id'] > 0) {
			$cate_id = (int)$_GET['cate_id'];
			$where = 'cate_id=' . $cate_id;
		} 
		$count = $this -> shop_gift_mod -> where($where) -> count();
		$page = new \Think\Page($count, 12);
		$gift = $this -> shop_gift_mod -> where($where) -> limit($page -> firstRow . ',' . $page -> listRows) -> select();
		$this -> assign('gift', $gift);
		$page_str = str_replace('/home/shop/index/', '/shop/', strtolower($page -> show()));
		$this -> assign('page', $page_str);
		$cate = $this -> shop_cate_mod -> order('sort asc') -> select();
		$this -> assign('cate', $cate);
		$this -> getseo('shop');
		$this -> display();
	} 
	public function detail() {
		if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
			$id = (int)$_GET['id'];
			$gift = $this -> shop_gift_mod -> where('id=' . $id) -> find();
			$this -> assign('gift', $gift);
			$this -> assign('title', $gift['title']);
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function exchange() {
		if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
			$id = (int)$_GET['id'];
			$gift = $this -> shop_gift_mod -> where('id=' . $id) -> find();
			$this -> assign('gift', $gift);
			$this -> assign('title', '礼品兑换');
			$this -> display();
		} else {
			$this -> msg('错误提示', '非法访问！');
		} 
	} 
	public function order() {
		if (IS_AJAX) {
			$gift = $this -> shop_gift_mod -> where('id=' . (int)$_POST['gift_id']) -> find();
			$amount = $gift['price'] * (int)$_POST['num'];
			if ($this -> user['money'] >= $amount) {
				$user_gift_mod = D('user_gift');
				$user_gift = $user_gift_mod -> create();
				$user_gift['order_id'] = time() . $this -> rand_six_num();
				$user_gift['created_time'] = time();
				$user_gift['amount'] = $amount;
				$user_gift['user_id'] = $this -> user['id'];
				$gift_info = array('id' => $gift['id'], 'title' => $gift['title'], 'image' => $gift['image'], 'price' => $gift['price']);
				$user_gift['gift_info'] = json_encode($gift_info);
				if ($this -> reduce_money($amount) && $user_gift_mod -> where('id=' . $this -> user['id']) -> add($user_gift)) {
					$params = array('user_id' => $this -> user['id'], 'value' => $amount, 'type' => C('TRACE_STATUS_COST'), 'content' => '兑换 ' . $gift['title'] . ' 礼品，花了 ' . $amount . ' 囧币', 'created_time' => time());
					D('user_trace') -> add($params);
					$this -> ajaxReturn(array('err' => 1, 'msg' => '兑换成功!'));
				} 
			} 
			$this -> ajaxReturn(array('err' => 0, 'msg' => '当前囧币不够!'));
		} 
	} 
	private function get_new_exchange() {
		$user_gift_mod = D('user_gift');
		$user_gift = $user_gift_mod -> order('id desc') -> limit('0,6') -> select();
		foreach ($user_gift as $key => $value) {
			$user_gift[$key]['gift_info'] = json_decode($value['gift_info'], true);
			$user = D('user') -> where('id=' . $value['user_id']) -> find();
			$user_gift[$key]['user_info'] = $user;
		} 
		return $user_gift;
	} 
} 

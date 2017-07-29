<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends BaseController {
	public function jianjie() {
		$this -> assign('title', $this -> setting["site_name"] . '简介');
		$this -> display();
	} 
	public function gonggao() {
		$this -> assign('title', $this -> setting["site_name"] . '公告');
		$this -> display();
	} 
	public function shengming() {
		$this -> assign('title', $this -> setting["site_name"] . '免责声明');
		$this -> display();
	} 
	public function feedback() {
		if (IS_AJAX) {
			$feedback_mod = D('guestbook');
			$feedback = $feedback_mod -> create();
			if ($this -> check_word($feedback['content'])) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '内容不能有非法字符!'));
			} 
			if ($this -> check_word($feedback['contact'])) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '联系方式不能有非法字符!'));
			} 
			$code = trim($_POST['code']);
			$verify = new \Think\Verify();
			if (!$verify -> check($code)) {
				$this -> ajaxReturn(array('err' => 0, 'msg' => '验证码错误!'));
			} 
			$feedback['created_time'] = time();
			if ($feedback_mod -> add($feedback)) {
				$this -> ajaxReturn(array('err' => 1, 'msg' => '感谢您的参与!'));
			} 
		} 
		$this -> assign('title', '反馈意见');
		$this -> display();
	} 
	public function tougao() {
		$this -> assign('title', '投稿规则');
		$this -> display();
	} 
	public function shengao() {
		$this -> assign('title', '审稿规则');
		$this -> display();
	} 
	public function shengji() {
		$this -> assign('title', '升级规则');
		$this -> display();
	} 
	public function jifen() {
		$this -> assign('title', '积分规则');
		$this -> display();
	} 
} 

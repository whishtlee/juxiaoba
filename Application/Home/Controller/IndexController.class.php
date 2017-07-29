<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends BaseController
{
    private $user_joke_mod;

    protected function _initialize()
    {
        parent:: _initialize();
        $this->user_joke_mod = D('user_joke');
        $text = $this->get_good_joke(C('JOKE_TYPE_TEXT'));
        $this->assign('text', $text);
        $pic = $this->get_good_joke(C('JOKE_TYPE_PIC'));
        $this->assign('pic', $pic);
        $video = $this->get_good_joke(C('JOKE_TYPE_VIDEO'));
        $this->assign('video', $video);
        $gif = $this->get_good_joke(C('JOKE_TYPE_GIF'));
        $this->assign('gif', $gif);
        $send_week_user = $this->get_send_week_user();
        $audit_week_user = $this->get_audit_week_user();
        $this->assign('audit_week_user', $audit_week_user);
        $this->assign('send_week_user', $send_week_user);
    }

    public function index()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/index/p/', '/index_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('index', $p);
        $this->display();
    }

    public function text()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and type=' . C('JOKE_TYPE_TEXT');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/text/p/', '/text_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('text', $p);
        $this->display();
    }

    public function pic()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and type=' . C('JOKE_TYPE_PIC');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/pic/p/', '/pic_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('pic', $p);
        $this->display();
    }

    public function gif()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and type=' . C('JOKE_TYPE_GIF');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/gif/p/', '/gif_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('gif', $p);
        $this->display();
    }

    public function video()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and type=' . C('JOKE_TYPE_video');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/video/p/', '/video_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('video', $p);
        $this->display();
    }

    public function hotjoke()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT');
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('good_num desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user = D('user')->find($value['user_id']);
            $user_joke[$key]['user_info'] = $user;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/hotjoke/p/', '/hotjoke_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('hotjoke', $p);
        $this->display();
    }

    public function godreply()
    {
        $where = 'status=' . C('JOKE_STATUS_AUDIT') . ' and god_reply=1';
        $count = $this->user_joke_mod->where($where)->count();
        $page = new \Think\Page($count, 10);
        $user_joke = $this->user_joke_mod->where($where)->limit($page->firstRow . ',' . $page->listRows)->order('audit_time desc')->select();
        foreach ($user_joke as $key => $value) {
            $record = $this->get_record($value['id']);
            $user_joke[$key]['record'] = $record;
            $user_joke[$key]['user_info'] = D('user')->where('id=' . $value['user_id'])->find();
            $user_review_mod = D('user_review');
            $user_review = $user_review_mod->where('joke_id=' . $value['id'])->order('good_num desc')->find();
            $user_review['user_info'] = D('user')->where('id=' . $user_review['user_id'])->find();
            $user_joke[$key]['god_reply_info'] = $user_review;
        }
        $this->assign('user_joke', $user_joke);
        $page_str = str_replace('/home/index/godreply/p/', '/godreply_', strtolower($page->show()));
        $this->assign('page', $page_str);
        $p = '';
        if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
            $p = '第' . $_GET['p'] . '页';
        }
        $this->getseo('godreply', $p);
        $this->display();
    }

    public function rss()
    {
        echo '<?xml version="1.0" encoding="utf-8"?>
		<rss version="2.0">
		<channel>
		<title>' . $this->setting['site_name'] . '</title>
		<link>' . $this->setting['site_domain'] . '</link>
		<description>' . $this->setting['site_description'] . '</description>
		<language>zh_cn</language>
		<generator>' . $this->setting['site_name'] . '</generator>
		<webmaster>50042748@qq.com</webmaster> ';
        $where = 'status=' . C('JOKE_STATUS_AUDIT');
        $user_joke = $this->user_joke_mod->where($where)->limit('0,500')->order('id desc')->select();
        foreach ($user_joke as $key => $value) {
            $type = '';
            if ($value['type'] == C('JOKE_TYPE_TEXT')) {
                $type = '段子';
            }
            if ($value['type'] == C('JOKE_TYPE_PIC')) {
                $type = '趣图';
            }
            if ($value['type'] == C('JOKE_TYPE_GIF')) {
                $type = '动图';
            }
            if ($value['type'] == C('JOKE_TYPE_video')) {
                $type = '视频';
            }
            echo '  <item>
			<title><![CDATA[' . $value['title'] . ']]></title>
			<link>' . $this->setting['site_domain'] . '/xiaohua/' . $value['id'] . '.html</link>
			<category>' . $type . '</category>
			<pubdate>' . date('D, d M Y H:i:s T', $value['audit_time']) . '</pubdate>
			<description><![CDATA[' . $value['title'] . ']]></description>
			</item>';
        }
        echo '</channel>
			</rss>';
    }

    public function app()
    {
        $this->display();
    }
}

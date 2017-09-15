<?php
// 网站路由配置
return array(
	/*路由设置*/
	'URL_MODEL' 			=>	2,				//URL访问模式
	'URL_ROUTER_ON'   		=> true, 			//开启路由
	'URL_HTML_SUFFIX'		=>'html',			//伪静态后缀
	'URL_ROUTE_RULES' 	=> array( 	//定义路由规则
		'rss'  => 'index/rss',
		//最新笑话
		'/^text_(\d*)$/'  => 'index/text?p=:1',
		'text'  => 'index/text',

		'/^pic_(\d*)$/'  => 'index/pic?p=:1',
		'pic'  => 'index/pic',

		'/^gif_(\d*)$/'  => 'index/gif?p=:1',
		'gif'  => 'index/gif',

		'/^video_(\d*)$/'  => 'index/video?p=:1',
		'video'  => 'index/video',

		'/^godreply_(\d*)$/'  => 'index/godreply?p=:1',
		'godreply'  => 'index/godreply',

		'/^hotjoke_(\d*)$/'  => 'index/hotjoke?p=:1',
		'hotjoke'  => 'index/hotjoke',

		'/^index_(\d*)$/'  => 'index/index?p=:1',
		'app' => 'index/app',
		//'index'  => 'Newjokes/Index/index',

		//热门
		'/^hot\/month_(\d*)$/'  => 'Hot/month?p=:1',
		'hot/month'  => 'Hot/month',
		'/^hot\/week_(\d*)$/'  => 'Hot/week?p=:1',
		'hot/week'  => 'Hot/week',
		'/^hot\/index_(\d*)$/'  => 'Hot/index?p=:1',
		'hot'  => 'Hot/index',

		//标签
		'/^tags\/(\d*)_(\d*)$/'  => 'Tags/info?id=:1&p=:2',
		'tags'  => 'Tags/index',
		//礼品商城
		'/^shop\/index\/cate_id\/(\d*)$/' => 'Shop/index?cate_id=:1',
		'/^shop\/index\/cate_id\/(\d*)\/p\/(\d*)$/' => 'Shop/index?cate_id=:1&p=:2',
		'/^shop\/detail_(\d*)$/'  => 'Shop/detail?id=:1',
		'/^shop\/exchange_(\d*)$/'  => 'Shop/exchange?id=:1',
		'shop/order'  => 'Shop/order',
		'/^shop\/list_(\d*)$/'  => 'Shop/index?p=:1',
		'shop'  => 'Shop/index',

		//关于juxiaoba
		'about/jianjie'  => 'About/jianjie',
		'about/gonggao'  => 'About/gonggao',
		'about/shengming'  => 'About/shengming',
		'about/feedback'  => 'About/feedback',
		'about/tougao'  => 'About/tougao',
		'about/shengao'  => 'About/shengao',
		'about/shengji'  => 'About/shengji',
		'about/jifen'  => 'About/jifen',
		'about'  => 'About/index',
		//投稿 审稿
		'joke/execute'  => 'Joke/execute',
		'joke/jiekou'  => 'Joke/jiekou',
		'joke/publish3'  => 'Joke/publish3',
		'joke/publish2'  => 'Joke/publish2',
		'joke/publish'  => 'Joke/publish',
		'joke/audit'  => 'Joke/audit',
		'/^joke\/search\/key\/(.*)\/p\/(\d*)$/'  => 'Joke/search?key=:1&p=:2',
		'joke/search'  => 'Joke/search',
		'joke'  => 'Joke/index',
		//ajax
		'ajax/award'  => 'Ajax/award',
		'ajax/review'  => 'Ajax/review',
		'ajax/package'  => 'Ajax/package',
		'ajax/sign' => 'Ajax/sign',
		'ajax/follow' => 'Ajax/follow',
		'ajax/cancelfollow' => 'Ajax/cancelfollow',
		'ajax/send_msg' => 'Ajax/send_msg',

		//笑话
		'xiaohua/reviewrecord' => 'Xiaohua/reviewrecord',
		'xiaohua/record'  => 'Xiaohua/record',
		'xiaohua/getreview'  => 'Xiaohua/getreview',
		'xiaohua/:id\d'  => 'Xiaohua/index',

		//用户中心
		'user/feed'  => 'User/feed',
		'user/joke'  => 'User/joke',
		'user/review'  => 'User/review',
		'user/gift'  => 'User/gift',
		'user/info'  => 'User/info',
		'user/followlist'  => 'User/followlist',
		'user/fanslist'  => 'User/fanslist',
		'user/followinfo'  => 'User/followinfo',
		'user/msg'  => 'User/msg',
		'user/setpassword'  => 'User/setpassword',
		'user/setqq'  => 'User/setqq',
		'user/setphone'  => 'User/setphone',
		'user/setavatar'  => 'User/setavatar',
		'user/follows/:user_id\d'  => 'Main/follows',
		'user/fans/:user_id\d'  => 'Main/fans',
		'user/:user_id\d'  => 'Main/index',

		'user'  => 'User/index',
		//账号操作
		'account/qqlogin'  => 'Account/qqlogin',
		'account/qqcallback'  => 'Account/qqcallback',
		'account/wblogin'  => 'Account/wblogin',
		'account/wbcallback'  => 'Account/wbcallback',
		'account/checkemail'  => 'Account/checkemail',
		'account/checkusername'  => 'Account/checkusername',
		'account/registersuccess'  => 'Account/registersuccess',
		'account/activate'  => 'Account/activate',
		'account/forgetpassword'  => 'Account/forgetpassword',
		'account/login'  => 'Account/login',
		'account/register'  => 'Account/register',
		'account/logout'  => 'Account/logout',
		'account'  => 'Account/index',
		//公共
		'Public/token' => 'Public/token',
		'Public/uploadify'  => 'Public/uploadify',
		'Public/uploadimg'  => 'Public/uploadimg',
		'Public/uploadvedio'  => 'Public/uploadvedio',
		'Public/uploadfile'  => 'Public/uploadfile',
		'Public/verify' => 'Public/verify',
		'Public'  => 'Public/index',
	),
);
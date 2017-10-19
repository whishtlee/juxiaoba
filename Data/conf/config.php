<?php
return array(
	'DB_CHARSET'		=>  'utf8', // 数据库编码默认采用utf8
	'URL_CASE_INSENSITIVE'	=>  Ture, //url地址大小写不敏感设置

	'SHOW_PAGE_TRACE'	=> false, //让页面显示追踪日志信息
	'APP_AUTOLOAD_PATH'	=> '@.ORG',
	'OUTPUT_ENCODE'		=> true, //页面压缩输出
	'PAGE_NUM'			=> 15,

	/*Cookie配置*/
	'COOKIE_PATH'		=> '/',// Cookie路径
	'COOKIE_PREFIX'		=> '', // Cookie前缀 避免冲突

	/*定义模版标签*/
	'TMPL_L_DELIM'		=>'{', //模板引擎普通标签开始标记
	'TMPL_R_DELIM'		=>'}',				//模板引擎普通标签结束标记

	'DEFAULT_MODULE'		=> 'Home',  // 默认模块
	'DEFAULT_CONTROLLER'	=> 'Index', // 默认控制器名称
	'DEFAULT_ACTION'		=> 'index', // 默认操作名
	'APP_AUTOLOAD_PATH'	    => '@.TagLib', // 自动加载的路径
	'SESSION_EXPIRE' 		=> 600,
	'SITE_DOMAIN' 		    => 'http://www.q600.net',

    //'SHOW_PAGE_TRACE'	=>true,


);
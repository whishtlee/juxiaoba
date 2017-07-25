<?php
return array (
//通用的状态
'STATUS_ZERO'  => 0,    //否
'STATUS_ONE' => 1,	 //是

'SITE_DOMAIN' => 'http://www.2426.net',
'M_SITE_DOMAIN' => 'http://m.2426.net',

//用户身份
'USER_DEFAULT_LEVEL' => 1,  //默认等级
'USER_STATUS_DISABLE' => 0,    //禁用
'USER_STATUS_UNACTIVATE' => 0, //默认状态，未激活
'USER_STATUS_NORMAL' => 1,  //正常状态
'USER_DEFAULT_MONEY' => 30, //默认笑豆
'SIGN_MONEY' => 30, //签到送积分

//笑话状态
'JOKE_STATUS_UNAUDIT' => 1, //未审核
'JOKE_STATUS_AUDIT' => 2,   //通过
'JOKE_STATUS_FAIL' => 3,    //未通过

//评论状态
'REVIEW_STATUS_UNAUDIT' => 1, //未审核
'REVIEW_STATUS_AUDIT' => 2,   //通过
'REVIEW_STATUS_FAIL' => 3,    //未通过  

//我的信息状态
'TRACE_STATUS_INCOME' => 1, //收入
'TRACE_STATUS_COST' => 2,  //消费

//笑话归类
'JOKE_TYPE_TEXT' => 1,
'JOKE_TYPE_PIC' => 2,
'JOKE_TYPE_GIF' => 3,
'JOKE_TYPE_video' => 4,
 
);
?>
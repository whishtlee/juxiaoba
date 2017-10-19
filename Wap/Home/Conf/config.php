<?php
/**
 *项目公共配置
 **/
$db = require('./Data/conf/db.php');
$tp = require('./Data/conf/config.php');
$mail = require('./Data/conf/mail.php');
$route = require('./Data/conf/route.php');
$constants = require('./Data/conf/constants.php');
$tpl = require('./Data/conf/tpl.php');

//$array = array('TMPL_FILE_DEPR' => '_', 'DEFAULT_THEME' => 'juxiaoba');
$array = array('DEFAULT_THEME' => 'juxiaoba');
return array_merge($db, $tp, $route, $mail, $constants, $tpl, $array);

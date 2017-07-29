<?php
// 项目公共配置
$db = require('./Data/conf/db.php'); // 数据配置
$tp = require('./Data/conf/config.php'); // 配置选项
$mail = require('./Data/conf/mail.php'); // 邮件配置
$route = require('./Data/conf/route.php'); // 网站路由配置
$constants = require('./Data/conf/constants.php'); // 等级配置
$tpl = require('./Data/conf/tpl.php'); // 模板配置


$array = array(
    // 'TMPL_FILE_DEPR' => '_' // 简化模板的目录层次

);

return array_merge($db, $tp, $route, $mail, $constants, $tpl, $array);

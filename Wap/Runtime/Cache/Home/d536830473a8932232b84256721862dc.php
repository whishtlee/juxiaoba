<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo ($title); ?> - 聚笑吧 - 触屏版 - 聚天下笑,博君一尿</title>
    <meta name="copyright" content="Copyright Juxiaoba.com 版权所有">
    <meta name="keywords" content="<?php if($keywords != NULL): echo ($keywords); else: echo ($title); endif; ?>" />
    <meta name="description" content="<?php if($description != NULL): echo ($description); else: echo ($title); endif; ?>" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="imagemode" content="force">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="applicable-device" content="mobile">

    <?php echo htmlspecialchars_decode($setting['mqq_code']); echo htmlspecialchars_decode($setting['msina_code']); ?>


    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/Public/m/css/basic.css?v=201710195200">
    <link rel="stylesheet" type="text/css" href="/Public/wap/js/layer.mobile-v1.7/need/layer.css">
    <link rel="stylesheet" type="text/css" href="/Public/wap/js/swiper/css/swiper.min.css">
    <script>
        //document.getElementsByTagName("html")[0].style.fontSize=window.screen.width / 8 + "px";
    </script>
</head>
<body <?php if($user == NULL): ?>id="loginture"<?php endif; ?>>
    <header class="ui-header"><a href="javascript:history.go(-1);" class="ui-back">犯贱志</a>
        <h1 class="ui-header-title"> <b>登录</b> </h1>
        <div class="ui-header-wapper">
            <div class="ui-header-item"> <a href="http://m.fanjian.net/user/forget" class="ui-header-a">忘记密码</a> </div>
        </div>
    </header>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit" />
  <title><?php echo ($setting["site_name"]); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
	body{color:#222;font:16px/1.7 'Helvetica Neue',Helvetica,Arial,Sans-serif;background:#eff2f5;}a{text-decoration:none;color:#105cb6;}a:hover{text-decoration:underline;}.error{margin:169px auto 0;width:404px;}.error-wide{width:500px;}.error .header{overflow:hidden;font-size:1.8em;line-height:1.2;margin:0 0 .33em .33em;}.error .header img{vertical-align:text-bottom;}.error .header .mute{color:#999;font-size:.5em;}.error hr{margin:1.3em 0;}.error p{margin:0 0 1.7em;color:#999;}.error p:last-child{margin-bottom:0;}.error strong{font-size:1.1em;color:#000;}.error .content{padding:2em 1.25em;border:1px solid #babbbc;border-radius:5px;background:#f7f7f7;text-align:center;}.error .content .single{margin:3em 0;font-size:1.1em;color:#666;}.copyright{text-align:center;}
  </style>
</head>

<body>
<div class="page">
  <div class="error">
    <h1 class="header">
      <a href="/" class="logo">
        <?php echo ($setting["site_name"]); ?>
      </a>
      - 404
    </h1>
    <div class="content">
     <p>
       <strong>你访问的页面不存在</strong>
     </p>
     <p>随机推荐段子</p>
     <hr>
     <p>
       <a href="/">返回首页</a>
       <span>或者</span>
       <a href="javascript:;" id="js-history-back">返回上页</a>
     </p>
   </div>
  </div>
  <div class="copyright">copyright &copy; <?php echo (str_replace('http://www.','',$setting['site_url'])); ?></div>
</div>
</body>
</html>
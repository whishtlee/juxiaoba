<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta name="imagemode" content="force">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8" />
<title><?php echo ($title); ?> - juxiaoba手机版</title>
<meta name="keywords" content="<?php if($keywords != NULL): echo ($keywords); else: echo ($title); endif; ?>" />
<meta name="description" content="<?php if($description != NULL): echo ($description); else: echo ($title); endif; ?>" />
<?php echo htmlspecialchars_decode($setting['mqq_code']); echo htmlspecialchars_decode($setting['msina_code']); ?>
<link rel="stylesheet" type="text/css" href="/Public/wap/css/main.css">
<link rel="stylesheet" type="text/css" href="/Public/wap/js/layer.mobile-v1.7/need/layer.css">
<link rel="stylesheet" type="text/css" href="/Public/wap/js/swiper/css/swiper.min.css">
<script>
	//document.getElementsByTagName("html")[0].style.fontSize=window.screen.width / 8 + "px";
</script>
</head>
<body <?php if($user == NULL): ?>id="loginture"<?php endif; ?>>
<div class="warp">
<div id="header">
	<header class="header menu-header">
		<a class="h-user" href="/user"><i></i></a>
		<h1><a href="<?php echo ($setting['site_murl']); ?>">juxiaoba</a></h1>
		<a class="h-menu right" href="javascript:void(0);" rel="nofollow"><i></i></a>
<ul class="h-menu-list">
	<li><a class="newsjoke" href="/"><i></i>最新笑话</a></li>
	<li><a class="hotjoke" href="/hotjoke"><i></i>热门笑话</a></li>
	<li><a class="godreply" href="/godreply"><i></i>神&nbsp;&nbsp;回&nbsp;&nbsp;复</a></li>
	<li><a class="tagsfl" href="/tags"><i></i>笑点大全</a></li>
	<li><a class="followinfo" href="/user/followinfo"><i></i>好友动态</a></li>
	<li><a class="publish" href="/joke/publish/"><i></i>我要投稿</a></li>
	<li><a class="audit" href="/joke/audit/"><i></i>我要审稿</a></li>
	<li><a class="usercenter" href="/user"><i></i>个人中心</a></li>
</ul>
	</header>
	<?php $url = $_SERVER['PHP_SELF']; ?>
<nav class="nav clearfix">
    <a<?php if(strpos($url,'wap') > 0){echo ' class="active"';} ?> href="/">全部</a>
    <a<?php if(strpos($url,'pic') > 0){echo ' class="active"';} ?> href="/pic">图片</a>
    <a<?php if(strpos($url,'text') > 0){echo ' class="active"';} ?> href="/text">段子</a>
    <a<?php if(strpos($url,'gif') > 0){echo ' class="active"';} ?> href="/gif">动图</a>
	<a<?php if(strpos($url,'video') > 0){echo ' class="active"';} ?> href="/video">视频</a>
    <a<?php if(strpos($url,'tags') > 0){echo ' class="active"';} ?> href="/tags">笑点</a>
</nav>
</div>
	<script type="text/javascript" src="http://7xl3wn.com2.z0.glb.qiniucdn.com/socket.io.min.js"></script>
<script type="text/javascript" src="http://7xjfim.com2.z0.glb.qiniucdn.com/Iva.js"></script>
<ul class="joke-list">
<?php if(is_array($user_joke)): $i = 0; $__LIST__ = $user_joke;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jd): $mod = ($i % 2 );++$i;?><li data-j-id="<?php echo ($jd["id"]); ?>">
	<div class="u-info">
		<a class="j-u-avatar" href="/user/<?php echo ($jd["user_info"]["id"]); ?>"><img src="<?php echo ($jd["user_info"]["avatar"]); ?>"></a>
		<p class="j-u-name">
			<a href="/user/<?php echo ($jd["user_info"]["id"]); ?>"><?php echo ($jd["user_info"]["username"]); ?></a>
			<span class="fr"><?php echo (date('Y-m-d H:i:s',$jd['audit_time'])); ?></span>
		</p>
		<p class="j-title"><a href="/xiaohua/<?php echo ($jd["id"]); ?>.html"><?php echo ($jd["title"]); ?></a></p>
	</div>
	<div class="j-content<?php if($jd['type'] == 3 || $jd['type'] == 2){echo ' content-pic'; } ?>"<?php if($jd['type'] != 4){ ?> onclick="javascript:location.href='/xiaohua/<?php echo ($jd['id']); ?>.html'"<?php } ?>>
		<?php
 if($jd['type'] == 3) { $content = htmlspecialchars_decode(stripcslashes($jd['content'])); $image = str_replace('m_','',$jd['image']); $image = str_replace('/w5','',$image); $content = str_replace('src="'.$image.'"','class="gifimg" gifimg="'.$image.'" alt="'.$jd['title'].'" src="'.$jd['image'].'"',$content); echo $content; echo '<span class="gif-play-btn">播放GIF</span>'; }else if($jd['type'] == 2){ $content = htmlspecialchars_decode(stripcslashes($jd['content'])); $content = str_replace('src="'.$image.'"','alt="'.$jd['title'].'" src="'.$jd['image'].'"',$content); $pattern="/<img\s[^<>]*?src=[\'\"]([^\'\"<>]+?)[\'\"][^<>]*?>/i"; preg_match_all($pattern,$content,$match); $count = count($match[0]); if($count > 1){ echo '<div class="swiper-content">' . "\r\n"; echo '	<div class="swiper-container gallery-top">' . "\r\n"; echo '		<div class="swiper-wrapper">' . "\r\n"; for($i=0;$i<$count;$i++){ echo '<div class="swiper-slide"><img src="'.$match[1][$i].'"></div>' . "\r\n"; } echo '		</div>' . "\r\n"; echo '	</div>' . "\r\n"; echo '	<div class="swiper-container gallery-thumbs">' . "\r\n"; echo '		<div class="swiper-wrapper">' . "\r\n"; for($i=0;$i<$count;$i++){ echo '<div class="swiper-slide" style="background-image:url('.$match[1][$i].')"></div>' . "\r\n"; } echo '		</div>' . "\r\n"; echo '	</div>' . "\r\n"; echo '</div>' . "\r\n"; }else{ $content = htmlspecialchars_decode(stripcslashes($jd['content'])); $content = str_ireplace("alt=\"\"" ,"alt=\"".$jd['title']."\" ",$content); echo $content; } }else if($jd['type'] == 4){ preg_match('#sid/(.*?)/v\.swf#i',htmlspecialchars_decode($jd['content']),$matches); ?>
				<div id="video-<?php echo ($jd["id"]); ?>" style="width:100%;height:5rem"></div>
			<?php
 }else{ if(strlen(htmlspecialchars_decode(stripcslashes($jd['content']))) > 400) { echo mb_substr(strip_tags(htmlspecialchars_decode(stripcslashes($jd['content']))),0,400,'utf-8').'……'; echo '<br/>'; echo '<div><a href="/xiaohua/'.$jd['id'].'.html" style="text-decoration:underline;"> >>查看更多</a></div>'; }else { echo htmlspecialchars_decode(stripcslashes($jd['content'])); } } ?>
	</div>
	<div class="j-access-score">
		<?php if(($jd["record"] == NULL) OR ($jd['record']['award'] == 0)): ?><!-- 打赏 -->
			<a href="javascript:void(0)" rel="nofollow" class="j-maryane" total-score="0" user-score="<?php echo ($jd["award_num"]); ?>">打赏</a><?php endif; ?>
		<?php if(($jd["record"] != NULL) AND ($jd['record']['award'] > 0)): ?><a class="rewarded" href="javascript:void(0)">已打赏</a><?php endif; ?>
		<?php if(($jd["is_package"] == 1) AND ($jd["package_user_id"] == 0)): ?><!-- 包养 -->
			<a href="javascript:void(0)" rel="nofollow" class="j-kept" data-id="<?php echo ($jd["id"]); ?>" data-fee="<?php echo ($jd["package_fee"]); ?>">包养</a><?php endif; ?>

		<?php if(($jd["is_package"] == 1) AND ($jd["package_user_id"] > 0)): ?><!-- 已被包养 -->
			<div class="kepted">
				<a href="/user/<?php echo ($jd['record']['package_info']['id']); ?>"><?php echo ($jd['record']['package_info']['username']); ?></a>
				<span>包养了Ta</span>
			</div><?php endif; ?>
				<?php if($user != NULL): if($user['id'] != $jd['user_info']['id']): ?><span class="fr">
        <a href="javascript:void(0);" title="私信" data-username="<?php echo ($jd["user_info"]["username"]); ?>" data-userid="<?php echo ($jd["user_info"]["id"]); ?>" class="user-dm">私信</a>
        <?php
 if(check_follow($user['id'],$jd['user_info']['id']) == 0){ ?>
        <a href="javascript:void(0);" data-ajax="follow" data-userid="<?php echo ($jd["user_info"]["id"]); ?>" class="user-follow"><i class="icon icon10 icon-add-h"></i>关注</a>
        <?php
 }else{ ?>
        <a href="javascript:void(0);" data-ajax="follow" data-userid="<?php echo ($jd["user_info"]["id"]); ?>" class="user-follow user-cancelfollow"><i class="icon icon10 icon-cut"></i>已关注</a>
        <?php }?>
        </span><?php endif; endif; ?>
	</div>
	<div class="j-vote">
		<a href="javascript:void(0)" rel="nofollow" class="<?php if(($jd["record"] != NULL) AND ($jd['record']['type'] == 'good')): ?>j-gooded<?php else: ?>j-good<?php endif; ?>" title="顶"><i><?php echo ($jd["good_num"]); ?></i></a>
		<a href="javascript:void(0)" rel="nofollow" class="<?php if(($jd["record"] != NULL) AND ($jd['record']['type'] == 'bad')): ?>j-baded<?php else: ?>j-bad<?php endif; ?>" title="踩"><i><?php echo ($jd["bad_num"]); ?></i></a>
		<a href="/xiaohua/<?php echo ($jd["id"]); ?>.html" class="j-comment" title="评论"><i><?php echo (review($jd["id"])); ?></i></a>
		<a href="javascript:void(0)" rel="nofollow" class="j-share" title="分享" data-title="<?php echo ($jd["title"]); ?>" data-pic="<?php echo ($jd["image"]); ?>" data-url="<?php echo ($setting['site_murl']); ?>/xiaohua/<?php echo ($jd["id"]); ?>.html"><i></i></a>
	</div>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<!--视频播放api-->
<script type="text/javascript"><?php if(is_array($user_joke)): $i = 0; $__LIST__ = $user_joke;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if($val['type'] == 4): ?>var ivaInstance = new Iva('video-<?php echo ($val["id"]); ?>',{appkey: '<?php echo ($setting["site_appkey"]); ?>',live: false,video: '<?php echo ($val["content"]); ?>',title: '<?php echo ($val["title"]); ?>',cover:'<?php echo ((isset($val["image"]) && ($val["image"] !== ""))?($val["image"]):"/Public/images/fengmian.png"); ?>'});<?php endif; endforeach; endif; else: echo "" ;endif; ?></script>
	<div class="j-page">
	<?php $p = $_GET['p']; if($p == '' || $p == 1){ $p = 1; } $count = count($user_joke); if($count >= 10){ $p = $p + 1; echo '<a href="/index_'.$p.'.html" class="joke j-page-next-a">下一页</a>'; } ?>
	</div>
	<footer>
	<nav class="clearfix">
		<a class="friends" href="/user/followinfo"><i></i>好友</a>
		<a class="godReply" href="/godreply"><i></i>神回复</a>
		<a class="release" href="/joke/publish/"><i></i>投稿</a>
		<a class="reviewers" href="/joke/audit/"><i></i>审稿</a>
		<a class="my" href="/account/login"><i></i>我的</a>
	</nav>
</footer>
<input id="hidPage" type="hidden" value="1">
<input id="hidScrollY" type="hidden" value="0">
	<section class="footer">
			<p><a href="/about/feedback">意见反馈</a></p>
			<p>Copyright 2013-2016 juxiaoba 版权所有</p>
		</section>
	</section>
</section>
<a href="javascript:void(0)" class="goTop" id="goTop"><span></span></a>
<div style="display:none"><?php echo (htmlspecialchars_decode($setting["site_tongji_code"])); ?></div>
<script type="text/javascript" src="/Public/wap/js/sea.js"></script>
<script type="text/javascript" src="/Public/wap/js/sea_config.js"></script>
<script type="text/javascript">
var cpro_id="u2722752";
(window["cproStyleApi"] = window["cproStyleApi"] || {})[cpro_id]={at:"3",pat:"15",tn:"template_inlay_all_mobile_lu_native",rss1:"#FFFFFF",titFF:"%E5%BE%AE%E8%BD%AF%E9%9B%85%E9%BB%91",titFS:"12",rss2:"#000000",ptFS:"16",ptFC:"#000000",ptFF:"%E5%BE%AE%E8%BD%AF%E9%9B%85%E9%BB%91",ptFW:"1",conpl:"0",conpr:"1",conpt:"0",conpb:"0",cpro_h:"60",ptn:"1",ptp:"0",itecpl:"10",piw:"0",pih:"0",ptDesc:"0",ptLogo:"0"}
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/cm.js" type="text/javascript"></script>
<!--自动推送-开始-->
<?php include_once("baidu_js_push.php") ?>
<script>
(function(){
   var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?8c811979a758314502d6401ddde55d35":"https://jspassport.ssl.qhimg.com/11.0.1.js?8c811979a758314502d6401ddde55d35";
   document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>
<!--自动推送-结束-->
<?php echo ($adv['m_bottom']); ?> <?php echo ($adv['m_top']); ?> <?php echo ($adv['m_chaping']); ?>
</div>
	<script type="text/javascript">
seajs.use(['app','index'],function(app,index) {
	index.list();
});
</script>
</body>
</html>
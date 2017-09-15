<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="copyright" content="Copyright (c) FanJian">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php echo ($title); ?> - <?php echo ($setting["site_name"]); ?></title>

    <meta name="keywords" content="<?php if($keywords != NULL): echo ($keywords); else: echo ($title); endif; ?>"/>
    <meta name="description" content="<?php if($description != NULL): echo ($description); else: echo ($title); endif; ?>"/>

    <link rel="alternate" type="application/rss+xml" title="<?php echo ($setting["site_name"]); ?>" href="<?php echo (str_replace('http://www.','',$setting['site_url'])); ?>/rss"/>

    <link rel="apple-touch-icon" href="" sizes="152x152">
    <link rel="apple-touch-icon" href="" sizes="120x120">
    <link rel="apple-touch-icon" href="" sizes="76x76">
    <link rel="apple-touch-icon" href="" sizes="60x60">

    <link rel="stylesheet" href="/Public/css/basis.css?201706021919">
    <link rel="stylesheet" href="/Public/css/list.css?201706021919">
    <link rel="stylesheet" href="/Public/css/shop.css?201706021919">
    <link rel="stylesheet" href="/Public/css/swiper.min.css">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- QQ WeiBo -->
    <?php echo (htmlspecialchars_decode($setting['qq_code'])); ?>
    <?php echo (htmlspecialchars_decode($setting['sina_code'])); ?>

    <script type="text/javascript">
        var siteUrl = 'http://www.juxaoba.com/';
    </script>

    <script type="text/javascript">
        <!--跳m站-->
        function getCookie(nm) {
            var arr, reg = new RegExp("(^| )" + nm + "=([^;]*)(;|$)");
            if (arr = document.cookie.match(reg)) {
                return unescape(arr[2]);
            } else {
                return null;
            }
        }
        if ((navigator.userAgent.match(/(iPhone|iPod|Android|Windows Phone)/i))) {
            if (getCookie('juxiaoba') == null) {
                var url = window.location.href;
                url = url.replace('http://www.', 'http://m.');
                url = url.replace('https://www.', 'http://m.');
                location.replace(url);
            }
        }
    </script>

    <?php
 $url = $_SERVER["REQUEST_URI"]; ?>
</head>

<!-- 头部导航 -->
<body>
<div class="all-top">
    <div class="all-top-box clearfix">
        <a href="<?php echo ($setting['site_domain']); ?>" target="_self" class="all-top-logo">犯贱志</a>
        <ul class="all-top-nav clearfix">
            <li><a href="/shop" target="_blank">商城</a><sup class="sup-new">new</sup></li>
            <li><a href="http://www.fanjian.net/jbk" target="_self">贱百科</a></li>
            <li><a href="http://www.fanjian.net/laosiji" target="_self">老司机</a></li>
            <li><a href="http://zb.fanjian.net" target="_blank">装B神器</a></li>
            <li><a href="http://app.fanjian.net" target="_blank">犯贱APP</a></li>
        </ul>
        <ul class="all-top-act clearfix">
            <?php if($user == NULL): ?><li class="unland"><a class="quick-land">登录</a><span class="sp">|</span><a href="http://www.fanjian.net/user/reg" target="_self">注册</a></li>
            <?php else: ?>
                <li class="message"><a href="http://www.fanjian.net/user/login" target="_blank" class="icon-top" title="消息"><i>消息</i><span class=" icon iconfont">&#xe60c;</span></a></li>
                <li><a href="http://www.fanjian.net/user/login" target="_blank" class="icon-top" title="历史"><i>历史</i><span class="icon iconfont">&#xe617;</span></a></li>
                <li><a href="http://www.fanjian.net/user/login" target="_blank" class="icon-top" title="收藏"><i>收藏</i><span class="icon iconfont">&#xe603;</span></a></li>
                <li><a href="http://app.fanjian.net" target="_blank" class="icon-top" title="App"><i>App</i><span class="icon iconfont">&#xe60f;</span></a></li>
                <li><a href="http://www.fanjian.net/user/login" target="_blank" class="icon-top" title="投稿"><i>投稿</i><span class="icon iconfont">&#xe614;</span></a></li><?php endif; ?>
        </ul>
        <div class="all-top-search">
            <form method="get" class="clearfix" action="http://www.fanjian.net/search" target="_blank">
                <fieldset>
                    <legend class="hidden">犯贱志搜索</legend>
                    <label class="hidden">搜索关键字</label>
                    <input type="text" class="input-text all-top-search-input" name="k" placeholder="搜索">
                    <input type="submit" value="&#xe605;" title="搜索" class="icon iconfont submit-button all-top-search-button">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- 头部导航 -->
<script type="text/javascript" src="http://7xl3wn.com2.z0.glb.qiniucdn.com/socket.io.min.js"></script>
<script type="text/javascript" src="http://7xjfim.com2.z0.glb.qiniucdn.com/Iva.js"></script>
<!-- 主体内容-开始 -->

<div class="main clearfix" style="position:relative;">
    <div class="main-left fl xiaoxie_info" id="j-main-list">

        <!-- 详细-开始 -->

        <dl class="main-list">
            <dt> <a href="/user/<?php echo ($user_joke["user_info"]["id"]); ?>" target="_blank"> <img src="<?php echo ($user_joke["user_info"]["avatar"]); ?>" alt="<?php echo ($user_joke["user_info"]["username"]); ?>"> </a>
            <p class="user">
                <a href="/user/<?php echo ($user_joke["user_info"]["id"]); ?>" title="<?php echo ($user_joke["user_info"]["username"]); ?>"><?php echo ($user_joke["user_info"]["username"]); ?></a>
                <a href="/about/shengji.html" class="level_icon icon_lv<?php echo (level($user_joke["user_info"]["username"])); ?>" title="<?php echo (levelname($user_joke["user_info"]["username"])); ?>" target="_blank"></a>

                <span class="fr">
					<?php if($user != NULL): if($user['id'] != $user_joke['user_info']['id']): ?><a href="javascript:void(0);" title="私信" data-username="<?php echo ($user_joke["user_info"]["username"]); ?>" data-userid="<?php echo ($user_joke["user_info"]["id"]); ?>" class="user-dm">私信</a>
                <?php
 if(check_follow($user['id'],$user_joke['user_info']['id']) == 0){ ?>
                <a href="javascript:void(0);" data-ajax="follow" data-userid="<?php echo ($user_joke["user_info"]["id"]); ?>" class="user-follow"><i class="icon icon10 icon-add-h"></i>关注</a>
                <?php
 }else{ ?>
                <a href="javascript:void(0);" data-ajax="follow" data-userid="<?php echo ($user_joke["user_info"]["id"]); ?>" class="user-follow user-cancelfollow"><i class="icon icon10 icon-cut"></i>已关注</a>
                <?php } endif; endif; ?>&nbsp;<?php echo (date('Y-m-d H:i:s',$user_joke['audit_time'])); ?>
          </span>
            </p>
            <span class="title"><?php echo ($user_joke["title"]); ?></span> </dt>
            <dd class="content<?php if($user_joke['type'] == 3 || $user_joke['type'] == 2){echo ' content-pic'; } ?>">
                <?php
 if($user_joke['type'] == 3) { $content = htmlspecialchars_decode(stripcslashes($user_joke['content'])); $content = str_replace('alt=""','alt="'.$user_joke['title'].'"',$content); echo $content; }else if($user_joke['type'] == 4) { echo '<div id="video" style="width:600px;height:340px; margin-left:auto; margin-right:auto"></div>'; }else if($user_joke['type'] == 2){ $content = htmlspecialchars_decode(stripcslashes($user_joke['content'])); $content = str_replace('alt=""','alt="'.$user_joke['title'].'"',$content); $pattern="/<img\s[^<>]*?src=[\'\"]([^\'\"<>]+?)[\'\"][^<>]*?>/i"; preg_match_all($pattern,$content,$match); $count = count($match[0]); if($count > 1){ echo '<div class="article-content">' . "\r\n"; echo '  <div class="multiple-article-wrapper">' . "\r\n"; echo '    <div class="multiple-article-zone clearfix">' . "\r\n"; echo '      <div class="multiple-article-arrow prev"> <a href="javascript:;" class="deactive"> <i class="icon-left-open-big"></i> </a> </div>' . "\r\n"; echo '      <div class="multiple-pics-wrapper">' . "\r\n"; echo '        <div class="multiple-pics-zone">' . "\r\n"; echo '          <ul class="multiple-pics-list">' . "\r\n"; for($i=0;$i<$count;$i++){ if($i == 0){ echo '<li class="active">'.$match[0][$i].'</li>' . "\r\n"; }else{ echo '<li>'.$match[0][$i].'</li>' . "\r\n"; } } echo '</ul>' . "\r\n"; echo '        </div>' . "\r\n"; echo '      </div>' . "\r\n"; echo '      <div class="multiple-article-arrow next"> <a href="javascript:;"> <i class="icon-right-open-big"></i> </a> </div>' . "\r\n"; echo '    </div>' . "\r\n"; echo '    <div class="multiple-thumbnail-zone clearfix">' . "\r\n"; echo '      <div class="multiple-thumbnail-arrow thumbprev"> <a href="javascript:;" class="deactive"> <i class="icon-left-open-big"></i> </a> </div>' . "\r\n"; echo '      <div class="multiple-thumbnail-area">' . "\r\n"; echo '        <ul class="multiple-thumbnail-list">' . "\r\n"; echo '</ul>' . "\r\n"; echo '      </div>' . "\r\n"; echo '      <div class="multiple-thumbnail-arrow thumbnext"> <a href="javascript:;"> <i class="icon-right-open-big"></i> </a> </div>' . "\r\n"; echo '    </div>' . "\r\n"; echo '  </div>' . "\r\n"; echo '</div>' . "\r\n"; }else{ $content = htmlspecialchars_decode(stripcslashes($user_joke['content'])); $content = str_replace('alt=""','alt="'.$user_joke['title'].'"',$content); echo $content; } }else{ echo htmlspecialchars_decode($user_joke['content']); }?>
    </dd>
    <dd class="x_tags">
        看点：<?php if(is_array($joke_tags)): $i = 0; $__LIST__ = $joke_tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><a href="/tags/<?php echo ($tag["id"]); ?>_1.html" target="_blank"><?php echo ($tag["name"]); ?></a>&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
    </dd>
    <dd class="direction clearfix">
        <?php if($rel_joke['pre_joke_id'] > 0): ?><a href="/xiaohua/<?php echo ($rel_joke['pre_joke_id']); ?>.html" class="fl direction-before" title="上一条"></a><?php endif; ?>
        <?php if($rel_joke['next_joke_id'] > 0): ?><a href="/xiaohua/<?php echo ($rel_joke['next_joke_id']); ?>.html" class="fr direction-after" title="下一条"></a><?php endif; ?>
    </dd>
    <dd class="operation clearfix">
        <div class="operation-btn"> <a href="javascript:void(0);" data-id="<?php echo ($user_joke["id"]); ?>" class="ding <?php if(($user_joke["record"] != NULL) AND ($user_joke['record']['type'] == 'good')): ?>ding-hover<?php endif; ?>
            " title="顶">
            <div class="dingcai"> <span></span> <i><?php echo ($user_joke["good_num"]); ?></i> </div>
            </a>
            <div class="operation-line"></div>
        </div>
        <div class="operation-btn"> <a href="javascript:void(0);" data-id="<?php echo ($user_joke["id"]); ?>" class="cai <?php if(($user_joke["record"] != NULL) AND ($user_joke['record']['type'] == 'bad')): ?>cai-hover<?php endif; ?>
            " title="踩">
            <div class="dingcai"> <span></span> <i><?php echo ($user_joke["bad_num"]); ?></i> </div>
            </a>
            <div class="operation-line"></div>
        </div>
        <div class="operation-btn"> <a href="javascript:void(0);" data-id="<?php echo ($user_joke["id"]); ?>" class="detail-comment comment" title="评论">
            <div class="dingcai"><span></span><i><?php echo (review($user_joke["id"])); ?></i></div>
        </a>
            <div class="operation-line"></div>
        </div>
        <div class="share-box">
						<span class="action-btn sharebtn" data-id="<?php echo ($user_joke["id"]); ?>"><img src="/Public/images/fen.png" h_src="/Public/images/fen-h.png" alt="分享" style="height: 18px;">
							<div style="display:none" id="sharedata-<?php echo ($user_joke["id"]); ?>"><?php echo ($user_joke["title"]); ?>（来自:<?php echo ($setting["site_name"]); ?>）|#|<?php echo ($setting["site_domain"]); ?>/xiaohua/<?php echo ($user_joke["id"]); ?>.html|#|<?php echo ($user_joke['image']); ?>|#|<?php echo ($setting["site_domain"]); ?>/xiaohua/<?php echo ($user_joke["id"]); ?>.html</div>
							<span class="bdsharebuttonbox bdsharebtn" style="display:none">
								<a href="javascript:void(0);" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
								<a href="javascript:void(0);" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
								<a href="javascript:void(0);" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
								<a href="javascript:void(0);" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
							</span>
						</span>
        </div>
        <?php if(($user_joke["record"] == NULL) OR ($user_joke['record']['award'] == 0)): ?><a class="reward" href="javascript:void(0)" data-award="<?php echo ($user_joke["award_num"]); ?>" data-id="<?php echo ($user_joke["id"]); ?>">打赏</a><?php endif; ?>
        <?php if(($user_joke["record"] != NULL) AND ($user_joke['record']['award'] > 0)): ?><a class="rewarded" href="javascript:void(0)">已打赏</a><?php endif; ?>
        <?php if(($user_joke["is_package"] == 1) AND ($user_joke["package_user_id"] == 0)): ?><a class="buy" href="javascript:void(0)" data-id="<?php echo ($user_joke["id"]); ?>" data-fee="<?php echo ($user_joke["package_fee"]); ?>">包养</a><?php endif; ?>
        <?php if(($user_joke["is_package"] == 1) AND ($user_joke["package_user_id"] > 0)): ?><div class="kepted"> <a href="/user/<?php echo ($user_joke['record']['package_info']['id']); ?>"><?php echo ($user_joke['record']['package_info']['username']); ?></a> <span>包养了Ta</span> </div><?php endif; ?>
    </dd>
    </dl>

    <!-- 详细-结束 -->

    <div class="object-comment comment" id="object-comment" >
        <div class="title" id="comment-num-data" total="0" ><?php echo ($setting["site_name"]); ?>评论(<span><?php echo (review($user_joke["id"])); ?></span>条评论)</div>
        <div class="comment-input">
            <form id="comment">
                <textarea name="content" id="comment-content" class="comment-input-text" title="吐槽一下吧，您的神回复将名垂青史" style="color: rgb(201, 201, 201);"></textarea>
                <input type="hidden" name="id" id="joke_id" value="<?php echo ($user_joke["id"]); ?>" />
                <input type="hidden" name="at_user_id" class="at_user_id" />
                <p id="text-length" style="display:none;">0/140字</p>
                <div>
                    <p><span>发评论，奖积分，积分可以换礼品哦!</span><span class="message"></span></p>
                    <input type="button" id="comment-submit" value="评论" />
                </div>
            </form>
        </div>
        <?php if(review == NULL): ?><ul class="comment-list" id="comment-list">
                <li class="nocomment">还没有人评论过，赶快抢沙发吧！</li>
            </ul>
            <?php else: ?>
            <input type="hidden" id="Ccount" name="Ccount" value="<?php echo ($Ccount); ?>" >
            <div id="comment-box">
                <ul class="comment-list" id="comment-list">
                    <?php if(is_array($review)): $k = 0; $__LIST__ = $review;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?><li>
                            <div class="comment-content"> <a class="user_id" data-id="<?php echo ($val["user_info"]["id"]); ?>" href="/user/<?php echo ($val["user_info"]["id"]); ?>"><img src="<?php echo ($val["user_info"]["avatar"]); ?>" alt="<?php echo ($val["user_info"]["username"]); ?>" /><i></i></a>
                                <p class="comment-username"><a href="/user/<?php echo ($val["user_info"]["id"]); ?>"><?php echo ($val["user_info"]["username"]); ?></a></p>
                                <p class="p-content"><?php echo ($val["content"]); ?></p>
                            </div>
                            <div class="comment-ding">
                                <?php $num = ($Ccount - ((1 - 1) * 5))-($k-1); ?>
                                <span><?php echo ($num); ?> 楼</span> <a href="javascript:void(0);" class="comment-ding-icon" rel="nofollow" data-id="<?php echo ($val["id"]); ?>"><?php echo ($val["good_num"]); ?></a> <a class="comment-reply" href="javascript:void(0);" rel="nofollow">回复</a> </div>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="page"></div><?php endif; ?>
        <div class="joke-ba joke-ba-bottom clearfix">
            <?php if($rel_joke['pre_joke_id'] > 0): ?><a href="/xiaohua/<?php echo ($rel_joke['pre_joke_id']); ?>.html" class="joke-before" title="上一条"></a><?php endif; ?>
            <?php if($rel_joke['next_joke_id'] > 0): ?><a href="/xiaohua/<?php echo ($rel_joke['next_joke_id']); ?>.html" class="joke-after" title="下一条"></a><?php endif; ?>
        </div>
    </div>
    <div id="reward" class="joke-buy-box" style="display: none; top: 0; left: 0;"> </div>
</div>
<div class="main-right fr">
    
    
    
</div>

</div>

<!-- 主体内容-结束 -->


<?php if($user_joke['type'] == 4): ?><!--视频播放api--><script type="text/javascript">
    var ivaInstance = new Iva(
        'video',
        {
            appkey: '<?php echo ($setting["site_appkey"]); ?>',
            live: false,
            video: '<?php echo ($user_joke["content"]); ?>',
            title: '<?php echo ($user_joke["title"]); ?>',
            cover: '<?php echo ((isset($user_joke["image"]) && ($user_joke["image"] !== ""))?($user_joke["image"]):"/Public/images/fengmian.png"); ?>',
        }
    );
</script><!--End--><?php endif; ?>
<script type="text/javascript">
    seajs.use(['app','user','share','page','template'], function(App,user,share) {


        $(window).load(function(){
            user.jokeList(test);
        });

        var commentBox = $('#comment-box');
        commentBox.on('click','.comment-ding-icon',function(){
            var self = $(this),
                id = self.data('id');
            user.commentDing(self,id);
        });
        commentBox.on('click','.comment-reply',function(){
            var box = $('#comment'),
                input = $('#comment-content'),
                at_user = box.find('.at_user_id'),
                self = $(this).parents('li'),
                id = self.find('.user_id').data('id'),
                p = self.find('.p-content').text(),
                username = self.find('.comment-username a').text();
            var str = '//@'+username+' '+p+' ';
            at_user.val(id);
            input.val(str);
        });


        //分页
        var Ccount = $('#Ccount').val(),
            joke_id = $('#joke_id').val();
        if(Ccount>=5){
            $('.page').pagination(Ccount, {
                num_edge_entries: 1, //边缘页数
                num_display_entries: 4, //主体页数
                callback: view,
                items_per_page: 5, //每页显示1项
                prev_text: '前一页',
                next_text: '后一页'
            });
        };

        //评论
        var submit = $('#comment-submit'),
            form = $('#comment'),
            commentList = $('#comment-list');
        submit.click(function(){
            if(!user.isLogin()){
                user.loginDialog();
                return;
            };
            var data = form.serializeObject();
            if(!data.content || data.content.length > 150){
                App.alert('回复内容不能为空！最大长度150个字符！');
                return;
            };
            App.request({
                url : '/ajax/review',
                data : data,
                success : function(result){
                    var re = result || {};
                    if(re.err){
                        $('#comment-content').val('');
                        App.alert('评论成功，请耐心等待审核！');
                        return;
                        var obj = re.msg[0];
                        var _html = '<li>\
									<div class="comment-content">\
										<a class="user_id" href="/user/'+obj.user_info.id+'" data-id="'+obj.user_info.id+'"> <img src="'+obj.user_info.avatar+'" alt="'+obj.user_info.username+'" /><i></i> </a>\
										<p class="comment-username"><a href="/user/'+obj.user_info.id+'">'+obj.user_info.username+'</a></p>\
										<p class="p-content">'+obj.content+'</p>\
									</div>\
									<div class="comment-ding">\
										<span>'+(parseInt(Ccount)+1)+'楼</span>\
										<a href="javascript:void(0);" class="comment-ding-icon" data-id="'+obj.id+'">0</a>\
										<a class="comment-reply" href="javascript:void(0);">回复</a>\
									</div>\
							</li>';
                        commentList.prepend(_html);
                    }else{
                        App.alert(re.msg);
                    };
                }
            });
        });




        var flag = false,
            html = '<ul class="comment-list" id="comment-list">\
				<% for(var i in list) { %>\
				<li>\
					<div class="comment-content">\
						<a href="/user/<%=list[i].user_id%>"><img src="<%=list[i].user_info.avatar%>" alt="<%=list[i].user_info.username%>"><i></i></a>\
						<p class="comment-username"><a href="/user/<%=list[i].user_id%>"><%=list[i].user_info.username%></a></p>\
						<p><%=list[i].content%></p>\
					</div>\
					<div class="comment-ding">\
						<span><%=start--%> 楼</span>\
						<a href="javascript:void(0);" class="comment-ding-icon" rel="nofollow" data-id="<%=list[i].id%>"><%=list[i].good_num%></a>\
						<a class="comment-reply" href="javascript:void(0);" rel="nofollow">回复</a>\
					</div>\
				</li>\
				<% } %>\
				</ul>';
        function view(i,obj){
            if(!i && !flag) return;
            flag = true;
            App.request({
                url : '/xiaohua/getreview',
                data : {id : joke_id,p : i+1},
                success : function(result){
                    var re = result || {};
                    if(re.err){
                        var obj = {list : re.msg};
                        obj.start = Ccount - ((i) * 5);
                        commentBox.html(template.compile(html)(obj));
                    }else{
                        App.alert(re.msg);
                    };
                }
            });
        };

        window._bd_share_config={"common":{"bdSnsKey":{"tsina":"","tqq":""},"bdMini":"2","bdMiniList":false,"bdStyle":"1","bdSize":"16","onBeforeClick":function(cmd){if(cmd == 'weixin'){return {bdUrl:shareweixin};}return {bdUrl:shareurl,bdPic:sharepic,bdText:sharecon}},"bdCustomStyle":'/Public/images/bdshare.css'},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];$('.sharebtn').on({mouseover:function(){$(this).children('span').stop().fadeIn();$(this).children('img').attr('src','/Public/images/fen-h.png');shareid = $(this).attr('data-id');var data = $('#sharedata-'+shareid).text().split('|#|');sharecon = data[0];shareurl = data[1];sharepic = data[2];shareweixin = data[3];},mouseout:function(){$(this).children('img').attr('src','/Public/images/fen.png');$(this).children('span').stop().fadeOut();}});});
</script>
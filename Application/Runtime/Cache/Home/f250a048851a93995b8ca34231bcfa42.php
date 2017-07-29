<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
        <a href="http://www.fanjian.net/" target="_self" class="all-top-logo">犯贱志</a>
        <ul class="all-top-nav clearfix">
            <li><a href="http://www.fanjian.net/markets" target="_blank">商城</a><sup class="sup-new">new</sup></li>
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

<div class="page">
    <div class="page-nav">
        <ul class="nav-list">
            <li class="active"><a href="http://www.fanjian.net/" target="_self"><span>◆</span>首页</a></li>
            <li><a href="http://www.fanjian.net/jianwen" target="_self"><span>◆</span>贱文</a></li>
            <li><a href="http://www.fanjian.net/jiantu" target="_self"><span>◆</span>贱图</a></li>
            <li><a href="http://www.fanjian.net/jianwan" target="_self"><span>◆</span>贱玩</a></li>
            <li><a href="http://www.fanjian.net/huati" target="_self"><span>◆</span>话题</a></li>
            <li><a href="http://tv.fanjian.net/" target="_blank"><span>◆</span>TV</a></li>
            <li><a href="http://www.fanjian.net/duanzi" target="_self"><span>◆</span>段子</a></li>
            <li><a href="http://www.fanjian.net/huodong" target="_self"><span>◆</span>活动</a></li>
        </ul>
    </div>
    <div class="banner">
        <a href="http://www.fanjian.net/markets" target="_blank">
            <img class="lazy" src="/Public/images/logo-bg.jpg" alt="犯贱志积分商城" height="150" width="1920">
        </a>
    </div>
    <div class="page-body clearfix">
        <div class="main">
            <div class="box">
                <div class="h-tabpanel clearfix">
                    <div class="h-info clearfix">
                        <div class="h-updates">今日更新 <strong>21</strong></div>
                        <div class="h-time"><span class="year">2017</span> <span class="week">星期五</span><strong><i class="month">07</i>/<i class="day">21</i></strong></div>
                    </div>
                    <ul class="h-tablist fl clearfix">
                        <li class="h-tab active"><a href="/" target="_self" class="fc-gray">肛肛发的</a></li>
                        <li class="h-tab"><a href="/hot" target="_self" class="fc-gray">叫得最凶</a></li>
                        <li class="h-tab"><a href="/hot/week" target="_self" class="fc-gray">三伏天</a></li>
                        <li class="h-tab"><a href="/hot/month" target="_self" class="fc-gray">随便打望</a></li>
                    </ul>
                    <div class="h-reload fr"><a class="icon iconfont fc-gray reload" title="刷新页面">&#xe619;</a></div>
                </div>
                <div class="b">
                    <ul class="cont-list">
                        <li class="cont-item">
                            <div class="title-tag">贱原创</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118340" target="_blank"
                                                           title="一周热评|有什么临死愿望，说来我帮你实现" data-id="118340">一周热评|有什么临死愿望，说来我帮你实现</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-26
                                16:48<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/14802" target="_blank" title="枇杷膏"
                                   class="fc-gray cont-list-editor">枇杷膏</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 22710
                            </div>
                            <div class="cont-list-reward" rid="118340"><a href="http://www.fanjian.net/user/14802"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118340_4802" title="枇杷膏"><img
                                    src="http://ww1.rs.fanjian.net/a/1b/97/11/db1b45711a978d3dab11263205d36d10.gif"
                                    alt="枇杷膏" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p>一周热评又来啦，</p>
                                <p>今天翻牌翻的我腰痛。</p>
                                <p>认真看哟。</p>
                                <p>想被翻拍的小贱贱们，多留言多点赞~！</p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/4c/4f/78/ac4ce39bf24f9a80fe7854e7c28a0fee.gif"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118340" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/31971" target="_blank">一周热评</a>
                                    <a class="fc-gray" href="http://www.fanjian.net/tag/33419" target="_blank">愿望成真</a>
                                    <a class="fc-gray" href="http://www.fanjian.net/tag/173" target="_blank">球迷</a>
                                </div>
                                <div class="cont-list-tools" rid="118340" tid="118340"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>97</i></a> <a class="fc-gray unlike"
                                                                                             title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>0</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118340#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>29</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118340"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <div class="title-tag">贱原创</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118931" target="_blank"
                                                           title="一周热评|真相只有一个！侦探无数个!" data-id="118931">一周热评|真相只有一个！侦探无数个!</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-07-03
                                17:21<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/14802" target="_blank" title="枇杷膏"
                                   class="fc-gray cont-list-editor">枇杷膏</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 23281
                            </div>
                            <div class="cont-list-reward" rid="118931"><a href="http://www.fanjian.net/user/14802"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118931_4802" title="枇杷膏"><img
                                    src="http://ww1.rs.fanjian.net/a/1b/97/11/db1b45711a978d3dab11263205d36d10.gif"
                                    alt="枇杷膏" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p>这周的热评让我看到了无数贱友广阔的胸襟、缜密的斯文和一本正经胡说八道的本领！</p>
                                <p>让我呼吸紧凑，久久不能平静！</p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/b0/12/f1/52b0ff374412850096f1def7e3671730.gif"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118931" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/15779" target="_blank">贱友热评</a>
                                    <a class="fc-gray" href="http://www.fanjian.net/tag/31971" target="_blank">一周热评</a>
                                </div>
                                <div class="cont-list-tools" rid="118931" tid="118931"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>99</i></a> <a class="fc-gray unlike"
                                                                                             title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>1</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118931#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>22</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118931"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <div class="title-tag">贱原创</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118015" target="_blank"
                                                           title="犯贱大讲堂|那些乱七八糟奇奇怪怪的病症" data-id="118015">犯贱大讲堂|那些乱七八糟奇奇怪怪的病症</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-22
                                17:56<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/14802" target="_blank" title="枇杷膏"
                                   class="fc-gray cont-list-editor">枇杷膏</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 23563
                            </div>
                            <div class="cont-list-reward" rid="118015"><a href="http://www.fanjian.net/user/14802"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118015_4802" title="枇杷膏"><img
                                    src="http://ww1.rs.fanjian.net/a/1b/97/11/db1b45711a978d3dab11263205d36d10.gif"
                                    alt="枇杷膏" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/b1/1e/1e/a8b1cad7e61e82ac1e1e53584e76e93c.jpg"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118015" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/23007"
                                        target="_blank">犯贱大讲堂</a> <a class="fc-gray"
                                                                     href="http://www.fanjian.net/tag/3297"
                                                                     target="_blank">奇怪</a> <a class="fc-gray"
                                                                                               href="http://www.fanjian.net/tag/33171"
                                                                                               target="_blank">异手</a> <a
                                        class="fc-gray" href="http://www.fanjian.net/tag/33172" target="_blank">鬼压床</a>
                                </div>
                                <div class="cont-list-tools" rid="118015" tid="118015"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>104</i></a> <a class="fc-gray unlike"
                                                                                              title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>0</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118015#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>20</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118015"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <div class="title-tag">贱原创</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118639" target="_blank"
                                                           title="犯贱大讲堂|神奇天气在哪里？" data-id="118639">犯贱大讲堂|神奇天气在哪里？</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-29
                                18:54<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/14802" target="_blank" title="枇杷膏"
                                   class="fc-gray cont-list-editor">枇杷膏</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 23367
                            </div>
                            <div class="cont-list-reward" rid="118639"><a href="http://www.fanjian.net/user/14802"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118639_4802" title="枇杷膏"><img
                                    src="http://ww1.rs.fanjian.net/a/1b/97/11/db1b45711a978d3dab11263205d36d10.gif"
                                    alt="枇杷膏" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/08/73/cf/c1082cb4bd739cd601cf46721484debf.jpg"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118639" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/23007"
                                        target="_blank">犯贱大讲堂</a> <a class="fc-gray"
                                                                     href="http://www.fanjian.net/tag/3471"
                                                                     target="_blank">天气</a></div>
                                <div class="cont-list-tools" rid="118639" tid="118639"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>102</i></a> <a class="fc-gray unlike"
                                                                                              title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>0</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118639#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>14</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118639"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <div class="title-tag">贱原创</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/120495" target="_blank"
                                                           title="犯贱大讲堂|“巨乳”一词的来历" data-id="120495">犯贱大讲堂|“巨乳”一词的来历</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-07-20
                                18:17<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/14802" target="_blank" title="枇杷膏"
                                   class="fc-gray cont-list-editor">枇杷膏</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 8914
                            </div>
                            <div class="cont-list-reward" rid="120495"><a href="http://www.fanjian.net/user/14802"
                                                                          target="_blank" class="user-head"
                                                                          data-id="120495_4802" title="枇杷膏"><img
                                    src="http://ww1.rs.fanjian.net/a/1b/97/11/db1b45711a978d3dab11263205d36d10.gif"
                                    alt="枇杷膏" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/61/41/04/b161f8840d418e3f4004511dc75bcbf6.jpg"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/120495" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/35103" target="_blank">大讲堂</a>
                                    <a class="fc-gray" href="http://www.fanjian.net/tag/846" target="_blank">巨乳</a>
                                </div>
                                <div class="cont-list-tools" rid="120495" tid="120495"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>39</i></a> <a class="fc-gray unlike"
                                                                                             title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>1</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/120495#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>14</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/120495"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <div class="title-tag">贱友投稿</div>
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/117918" target="_blank"
                                                           title="美国流浪汉刺死中国留学生，被判无罪释放，网友拍手叫好？【长文】" data-id="117918">美国流浪汉刺死中国留学生，被判无罪释放，网友拍手叫好？【长文】</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-22
                                09:48<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/41408" target="_blank" title="云淡风轻41408"
                                   class="fc-gray cont-list-editor">云淡风轻41408</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 26121
                            </div>
                            <div class="cont-list-reward" rid="117918"><a href="http://www.fanjian.net/user/41408"
                                                                          target="_blank" class="user-head"
                                                                          data-id="117918_31408" title="云淡风轻41408"><img
                                    src="http://qzapp.qlogo.cn/qzapp/101267057/BC89EE2FDA416CBD7BA3DE383C1C28D7/100"
                                    alt="云淡风轻41408" height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/dd/12/7e/4fddddb96b126f0c1b7e05d207609215.jpg"
                                        alt=""/></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/117918" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/33103" target="_blank">这会真的是教你重新做人了</a>
                                </div>
                                <div class="cont-list-tools" rid="117918" tid="117918"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>110</i></a> <a class="fc-gray unlike"
                                                                                              title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>1</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/117918#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>147</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/117918"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118352" target="_blank"
                                                           title="今天我吃了一坨小黄屎【长图】" data-id="118352">今天我吃了一坨小黄屎【长图】</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-26
                                22:01<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jiantu" target="_blank" class="fc-gray">贱图</a><span
                                        class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span> <a
                                        href="http://www.fanjian.net/user/10004" target="_blank" title="小花妹妹"
                                        class="fc-gray cont-list-editor">小花妹妹</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 27114
                            </div>
                            <div class="cont-list-reward" rid="118352"><a href="http://www.fanjian.net/user/10004"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118352_4" title="小花妹妹"><img
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1f8frbmavjpj2050050aaf.jpg" alt="小花妹妹"
                                    height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p><img src="http://ww1.rs.fanjian.net/c/7d/de/35/d87d3a70e1de7b379135b62a505657b4.png"
                                        alt=""/></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118352" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/33428"
                                        target="_blank">佛山的小新寄的</a></div>
                                <div class="cont-list-tools" rid="118352" tid="118352"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>129</i></a> <a class="fc-gray unlike"
                                                                                              title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>0</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118352#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>144</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118352"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/119023" target="_blank"
                                                           title="【贱公告】在评论区满嘴生殖器的用户直接禁言" data-id="119023">【贱公告】在评论区满嘴生殖器的用户直接禁言</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-07-04
                                18:10<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/10001" target="_blank" title="一剑"
                                   class="fc-gray cont-list-editor">一剑</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 22995
                            </div>
                            <div class="cont-list-reward" rid="119023"><a href="http://www.fanjian.net/user/10001"
                                                                          target="_blank" class="user-head"
                                                                          data-id="119023_1" title="一剑"><img
                                    src="http://ww4.sinaimg.cn/large/8f40c578jw1fazd1mrf0jj205k05kaa7.jpg" alt="一剑"
                                    height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p>这几天收到私信我和举报里大量的谩骂评论，今天早上删了一部分，评论截图就不贴了。虽然大家都不是什么素质多高的人，但作为一名成年男性，骂人能不能不要这么LOW！</p>
                                <p>以后评论区就事论事讨论，可以开玩笑可以嘲讽，争论一件事的时候举例子说道理，争不过就认怂。</p>
                                <p>争不过或一言不合就开启喷子模式，先发制人的进行人身攻击和问候别人家人者，禁言一周。屡次或连续多条谩骂者禁永久。</p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/119023" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/15963"
                                        target="_blank">犯贱志公告</a> <a class="fc-gray"
                                                                     href="http://www.fanjian.net/tag/17910"
                                                                     target="_blank">禁言</a></div>
                                <div class="cont-list-tools" rid="119023" tid="119023"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>140</i></a> <a class="fc-gray unlike"
                                                                                              title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>4</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/119023#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>132</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/119023"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/120286" target="_blank"
                                                           title="地狱空荡荡，恶魔在人间。【多图】"
                                                           data-id="120286">地狱空荡荡，恶魔在人间。【多图】</a></h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-07-18
                                23:25<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jianwen" target="_blank"
                                        class="fc-gray">贱文</a><span class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span>
                                <a href="http://www.fanjian.net/user/10001" target="_blank" title="一剑"
                                   class="fc-gray cont-list-editor">一剑</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 19526
                            </div>
                            <div class="cont-list-reward" rid="120286"><a href="http://www.fanjian.net/user/10001"
                                                                          target="_blank" class="user-head"
                                                                          data-id="120286_1" title="一剑"><img
                                    src="http://ww4.sinaimg.cn/large/8f40c578jw1fazd1mrf0jj205k05kaa7.jpg" alt="一剑"
                                    height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p>
                                    陕西渭南6岁男童鹏鹏，在跟随生父和继母共同生活期间，被惨无人道地虐待，头骨缺失四分之三，很可能会双目失明。膝盖因整夜被罚跪而磨烂。虎毒尚不食子，鹏鹏的生父居然伙同后妻及后妻之子共同殴打亲生儿子鹏鹏。而鹏鹏的爷爷奶奶，因嫌弃鹏鹏母亲出身农村，唆使鹏鹏父母离婚。</p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/c0/cd/16/1fc06fa1efcdfaf624164d10e2be48ed.jpg"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/120286" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/34952" target="_blank">编辑完后心里堵得慌</a>
                                </div>
                                <div class="cont-list-tools" rid="120286" tid="120286"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>86</i></a> <a class="fc-gray unlike"
                                                                                             title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>0</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/120286#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>97</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/120286"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>
                        <li class="cont-item">
                            <h2 class="cont-list-title"><a href="http://www.fanjian.net/post/118035" target="_blank"
                                                           title="【贱问贱答】第一次与你啪啪啪的人现在跟你什么关系？" data-id="118035">【贱问贱答】第一次与你啪啪啪的人现在跟你什么关系？</a>
                            </h2>
                            <div class="cont-list-info fc-gray"><span class="icon iconfont">&#xe608;</span> 2017-06-22
                                23:42<span class="sp">&nbsp;</span><span class="icon iconfont">&#xe61f;</span> <a
                                        href="http://www.fanjian.net/jiantu" target="_blank" class="fc-gray">贱图</a><span
                                        class="sp">&nbsp;</span><span class="icon iconfont">&#xe62a;</span> <a
                                        href="http://www.fanjian.net/user/10004" target="_blank" title="小花妹妹"
                                        class="fc-gray cont-list-editor">小花妹妹</a><span class="sp">&nbsp;</span><span
                                        class="icon iconfont">&#xe620;</span> 26831
                            </div>
                            <div class="cont-list-reward" rid="118035"><a href="http://www.fanjian.net/user/10004"
                                                                          target="_blank" class="user-head"
                                                                          data-id="118035_4" title="小花妹妹"><img
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1f8frbmavjpj2050050aaf.jpg" alt="小花妹妹"
                                    height="180" width="180"></a></div>
                            <div class="cont-list-main">
                                <p>
                                <p><img class="lazy"
                                        data-src="http://ww1.rs.fanjian.net/c/bd/57/08/9ebd6f44dd5737b8e108cacfb65fc138.jpg"
                                        alt=""/></p></p>
                            </div>
                            <div class="cont-list-in"><a href="http://www.fanjian.net/post/118035" target="_blank"
                                                         class="fc-blue">浏览原文 &raquo;</a></div>
                            <div class="cont-list-sub clearfix">
                                <div class="cont-list-tags"><span class="icon iconfont fc-gray">&#xe612;</span><a
                                        class="fc-gray" href="http://www.fanjian.net/tag/33192" target="_blank">断了联系</a>
                                </div>
                                <div class="cont-list-tools" rid="118035" tid="118035"><a class="fc-gray like"
                                                                                          title="赞"><b
                                        class="icon iconfont ">&#xe600;</b> <i>97</i></a> <a class="fc-gray unlike"
                                                                                             title="踩"><b
                                        class="icon iconfont ">&#xe625;</b> <i>1</i></a> <a class="fc-gray" title="评论"
                                                                                            href="http://www.fanjian.net/post/118035#anchor-comment"
                                                                                            target="_blank"><b
                                        class="icon iconfont">&#xe611;</b> <i>90</i></a> <a
                                        class="icon iconfont fc-gray mark " title="收藏">&#xe603;</a> <a
                                        class="icon iconfont fc-gray report ts_report" title="投诉">&#xe62e;</a>
                                    <div class="bdsharebuttonbox share"><a href="http://www.fanjian.net/post/118035"
                                                                           class="bds_more" data-cmd="more"></a></div>
                                </div>
                            </div>
                        </li>


                    </ul>
                    <div class="pager"><a class="icon iconfont pager-before" href="#">&#xe610;</a><i>1</i><a
                            href="http://www.fanjian.net/hot-2">2</a><a href="http://www.fanjian.net/hot-3">3</a><a
                            href="http://www.fanjian.net/hot-4">4</a><a href="http://www.fanjian.net/hot-5">5</a><a
                            class="icon iconfont pager-next" href="http://www.fanjian.net/hot-2">&#xe618;</a><span
                            class="fc-gray">共208页，跳至<input type="text" class="input-text jump_page"
                                                           target="http://www.fanjian.net/hot-">页</span></div>
                </div>
            </div>
        </div>
        <div class="sub">
            <div class="box-m">
                <div class="weather-box">
                    <div class="signin"><a href="http://www.fanjian.net/user/login" target="_blank">每日签到</a></div>
                    <iframe src="http://www.thinkpage.cn/weather/weather.aspx?uid=UA80BDB7A5&cid=CHBJ000000&l=zh-CHS&p=SMART&a=1&u=C&s=12&m=2&x=1&d=0&fc=&bgc=&bc=&ti=0&in=0&li="
                            frameborder="0" scrolling="no" width="180" height="90" allowTransparency="true"></iframe>
                </div>
            </div>
            <div class="box-m">
                <!--        <div class="gd"> <a href="--><!--" target="_blank"><img src="--><!--"></a> </div>-->
                <!--        <div class="gd"> <a href="--><!--" target="_blank"><img src="--><!--"></a> </div>-->
                <div class="gd"><a href="http://app.fanjian.net" target="_blank"><img
                        src="http://ww1.rs.fanjian.net/i/62/5e/52/6862d9bb205e7b6a115221bfe9242761.jpg" height="100"
                        width="280"></a></div>
            </div>

            <div class="box-bgm">
                <div class="h-htc order">
                    <ul class="h-tablist-s htc-2 htc clearfix">
                        <li class="h-tab-s active" id="dayhot"><span>◆</span><a>今日最热</a></li>
                        <li class="h-tab-s" id="weekhot"><span>◆</span><a>本周最热</a></li>
                    </ul>
                </div>
                <div class="b">
                    <ul class="text-list dayhot">
                        <li class="text-overflow"><span class="text-list-num">1</span><a
                                href="http://www.fanjian.net/post/120512" target="_blank" title="升米恩，斗米仇。">升米恩，斗米仇。</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">2</span><a
                                href="http://www.fanjian.net/post/120475" target="_blank"
                                title="人类如果将来去了外星球的话，你觉得肉食来源会是______？">人类如果将来去了外星球的话，你觉得肉食来源会是______？</a></li>
                        <li class="text-overflow"><span class="text-list-num">3</span><a
                                href="http://www.fanjian.net/post/120486" target="_blank"
                                title="临沂车祸暴走团：地被广场舞占了，不想跟他们抢。">临沂车祸暴走团：地被广场舞占了，不想跟他们抢。</a></li>
                        <li class="text-overflow"><span class="text-list-num">4</span><a
                                href="http://tv.fanjian.net/120483.html" target="_blank"
                                title="​遵义一女子翻出9楼阳台坠亡，七旬老母曾苦拽十余分钟被挣脱">​遵义一女子翻出9楼阳台坠亡，七旬老母曾苦拽十余分钟被挣脱</a></li>
                        <li class="text-overflow"><span class="text-list-num">5</span><a
                                href="http://www.fanjian.net/post/120496" target="_blank"
                                title="手段极其残忍【多图】">手段极其残忍【多图】</a></li>
                        <li class="text-overflow"><span class="text-list-num">6</span><a
                                href="http://www.fanjian.net/post/120482" target="_blank" title="郭敬明与林志玲相拥，击破身矮传闻。">郭敬明与林志玲相拥，击破身矮传闻。</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">7</span><a
                                href="http://tv.fanjian.net/120445.html" target="_blank" title="这位丰田车主你是疯了吗？ ​​​​">这位丰田车主你是疯了吗？
                            ​​​​</a></li>
                        <li class="text-overflow"><span class="text-list-num">8</span><a
                                href="http://www.fanjian.net/post/120481" target="_blank" title="要分清是什么事">要分清是什么事</a>
                        </li>
                    </ul>
                    <ul class="text-list weekhot" style="display:none;">
                        <li class="text-overflow"><span class="text-list-num">1</span><a
                                href="http://www.fanjian.net/post/120286" target="_blank" title="地狱空荡荡，恶魔在人间。【多图】">地狱空荡荡，恶魔在人间。【多图】</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">2</span><a
                                href="http://www.fanjian.net/post/120129" target="_blank" title="夏日炎炎，只能选下列三样，你会怎么选？">夏日炎炎，只能选下列三样，你会怎么选？</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">3</span><a
                                href="http://www.fanjian.net/post/120361" target="_blank"
                                title="被狗咬伤后打四针疫苗，西安32岁女子狂犬病发作身亡。【多图】">被狗咬伤后打四针疫苗，西安32岁女子狂犬病发作身亡。【多图】</a></li>
                        <li class="text-overflow"><span class="text-list-num">4</span><a
                                href="http://tv.fanjian.net/120285.html" target="_blank"
                                title="女子骂交警并称“你只能拘我24小时” 然后她被拘留了3天">女子骂交警并称“你只能拘我24小时” 然后她被拘留了3天</a></li>
                        <li class="text-overflow"><span class="text-list-num">5</span><a
                                href="http://www.fanjian.net/post/120512" target="_blank" title="升米恩，斗米仇。">升米恩，斗米仇。</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">6</span><a
                                href="http://www.fanjian.net/post/119972" target="_blank"
                                title="【贱话题】你是宁愿呆在夏天酷暑冬天雾霾的大城市，还是四季如春环境优美的小城市？">【贱话题】你是宁愿呆在夏天酷暑冬天雾霾的大城市，还是四季如春环境优美的小城市？</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">7</span><a
                                href="http://www.fanjian.net/post/120120" target="_blank" title="我要看徐锦江版">我要看徐锦江版</a>
                        </li>
                        <li class="text-overflow"><span class="text-list-num">8</span><a
                                href="http://tv.fanjian.net/120095.html" target="_blank"
                                title="原来萨摩这么凶残，表示莫名的爽！泰日天翻车了！">原来萨摩这么凶残，表示莫名的爽！泰日天翻车了！</a></li>
                    </ul>
                </div>
            </div>
            <div class="box-bgm">
                <div class="bk-sub clearfix">
                    <a href="http://www.fanjian.net/jbk/nxklwgnnj.html" target="_blank" title="您辛苦了我给您捏肩">您辛苦了我给您捏肩</a>
                    <a href="http://www.fanjian.net/jbk/slbsq.html" target="_blank" title="算了不生气">算了不生气</a>
                    <a href="http://www.fanjian.net/jbk/yuanliangse.html" target="_blank" title="原谅色">原谅色</a>
                    <a href="http://www.fanjian.net/jbk/wszdhbc.html" target="_blank" title="我是真的很不错">我是真的很不错</a>
                </div>
            </div>
            <div class="box-bgm">
                <div class="h-b">
                    <h2 class="h-title">近期活跃贱友</h2>
                    <span class="h-more"></span>
                </div>
                <div class="b">
                    <ul class="user-list-s-v">
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/27913" target="_self"
                                                           title="生个屁眼没儿子的主页" class="user-head"><img
                                    src="http://rs.fanjian.net/a/75/4c/3f/03753e03de4cf952953fd357b6a3983f_small.jpg"
                                    alt="生个屁眼没儿子" height="180" width="180" title="生个屁眼没儿子"
                                    src="http://rs.fanjian.net/a/75/4c/3f/03753e03de4cf952953fd357b6a3983f_small.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/27913" target="_self"
                                                           title="生个屁眼没儿子的主页" class="text-overflow">生个屁眼没儿子</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/27913" target="_blank"
                                                             class="user-lv ul-3"><em>5.4cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/10607" target="_self"
                                                           title="fishwoo的主页" class="user-head"><img
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1fb5od4hye1j205k05kmxe.jpg" alt="fishwoo"
                                    height="180" width="180" title="fishwoo"
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1fb5od4hye1j205k05kmxe.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/10607" target="_self"
                                                           title="fishwoo的主页" class="text-overflow">fishwoo</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/10607" target="_blank"
                                                             class="user-lv ul-3"><em>6.2cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/31983" target="_self"
                                                           title="取个正常的昵称的主页" class="user-head"><img
                                    src="http://ww1.rs.fanjian.net/a/27/0b/03/3827c8784a0b0f59e003820b210f042a.gif"
                                    alt="取个正常的昵称" height="180" width="180" title="取个正常的昵称"
                                    src="http://ww1.rs.fanjian.net/a/27/0b/03/3827c8784a0b0f59e003820b210f042a.gif"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/31983" target="_self"
                                                           title="取个正常的昵称的主页" class="text-overflow">取个正常的昵称</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/31983" target="_blank"
                                                             class="user-lv ul-3"><em>5.4cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/11157" target="_self"
                                                           title="吕松的主页" class="user-head"><img
                                    src="http://ww4.sinaimg.cn/large/8f40c578jw1f94kn4thhqj205k05kglv.jpg" alt="吕松"
                                    height="180" width="180" title="吕松"
                                    src="http://ww4.sinaimg.cn/large/8f40c578jw1f94kn4thhqj205k05kglv.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/11157" target="_self"
                                                           title="吕松的主页" class="text-overflow">吕松</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/11157" target="_blank"
                                                             class="user-lv ul-4"><em>8.2cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/24026" target="_self"
                                                           title="Edmond的主页" class="user-head"><img
                                    src="http://wx3.sinaimg.cn/large/8f40c578ly1fdws8m5fr1j205k05kgmi.jpg" alt="Edmond"
                                    height="180" width="180" title="Edmond"
                                    src="http://wx3.sinaimg.cn/large/8f40c578ly1fdws8m5fr1j205k05kgmi.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/24026" target="_self"
                                                           title="Edmond的主页" class="text-overflow">Edmond</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/24026" target="_blank"
                                                             class="user-lv ul-1"><em>2.8cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/11284" target="_self"
                                                           title="贱兮兮的主页" class="user-head"><img
                                    src="http://ww1.rs.fanjian.net/a/04/bb/4d/8d04587216bb19d9604d3820f929548d.jpg"
                                    alt="贱兮兮" height="180" width="180" title="贱兮兮"
                                    src="http://ww1.rs.fanjian.net/a/04/bb/4d/8d04587216bb19d9604d3820f929548d.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/11284" target="_self"
                                                           title="贱兮兮的主页" class="text-overflow">贱兮兮</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/11284" target="_blank"
                                                             class="user-lv ul-2"><em>3.8cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/28676" target="_self"
                                                           title="飙车老司机的主页" class="user-head"><img
                                    src="http://ww1.sinaimg.cn/large/8f40c578jw1fa5qtx7ijqj205k05kjrn.jpg" alt="飙车老司机"
                                    height="180" width="180" title="飙车老司机"
                                    src="http://ww1.sinaimg.cn/large/8f40c578jw1fa5qtx7ijqj205k05kjrn.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/28676" target="_self"
                                                           title="飙车老司机的主页" class="text-overflow">飙车老司机</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/28676" target="_blank"
                                                             class="user-lv ul-1"><em>2.8cm</em></a></div>
                        </li>
                        <li>
                            <div class="user-list-head"><a href="http://www.fanjian.net/user/12881" target="_self"
                                                           title="0o雷锋o0的主页" class="user-head"><img
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1fb5onilolsj205k05kmxo.jpg" alt="0o雷锋o0"
                                    height="180" width="180" title="0o雷锋o0"
                                    src="http://ww2.sinaimg.cn/large/8f40c578jw1fb5onilolsj205k05kmxo.jpg"
                                    style="display: inline;"></a></div>
                            <div class="user-list-name"><a href="http://www.fanjian.net/user/12881" target="_self"
                                                           title="0o雷锋o0的主页" class="text-overflow">0o雷锋o0</a></div>
                            <div class="user-list-button"><a href="http://www.fanjian.net/user/12881" target="_blank"
                                                             class="user-lv ul-2"><em>4.6cm</em></a></div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="box-m">
                <div class="gd gd-shake"><a href="http://www.fanjian.net/star" target="_blank"><img
                        src="http://ww1.rs.fanjian.net/i/d7/59/59/d7d76d72f759f81e5359dcff0f7eb784.png" height="50"
                        width="280"></a></div>
            </div>
            <div class="box-bgm">
                <div class="h-b">
                    <h2 class="h-title">贱点标签</h2>
                    <span class="h-more"><!--<a href="#" target="_blank" class="fc-gray">所有标签 &raquo;</a>--></span>
                </div>
                <div class="b">
                    <div class="tags-list">
                        <a class="fc-blue" href="http://www.fanjian.net/tag/23" target="_blank">图片</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/24" target="_blank">视频</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/836" target="_blank">邪恶</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/80" target="_blank">漫画</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/2437" target="_blank">邪恶漫画</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/34" target="_blank">内涵</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/3396" target="_blank">没品新闻</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/421" target="_blank">搞笑</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/3529" target="_blank">动态图</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/3226" target="_blank">涨姿势</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/1617" target="_blank">微博段子</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/2541" target="_blank">屌丝</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/98" target="_blank">恶搞</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/584" target="_blank">段子</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/1492" target="_blank">亮点</a>
                        <a class="fc-blue" href="http://www.fanjian.net/tag/3724" target="_blank">贱问贱答</a>
                    </div>
                </div>
            </div>
            <div class="box-bgm">
                <div class="h-b">
                    <h2 class="h-title">日期归档</h2>
                    <!--<span class="h-more"><a href="#" target="_blank" class="fc-gray">更多 &raquo;</a></span>-->
                </div>
                <div class="b">
                    <div class="data-files" id="data-files"></div>
                </div>
            </div>
            <div class="box-bgm">
                <div class="h-b">
                    <h2 class="h-title">合作伙伴</h2>
                    <span class="h-more"><a href="http://www.fanjian.net/info/links" target="_blank" class="fc-gray">更多 &raquo;</a></span>
                </div>
                <div class="b">
                    <ul class="text-list text-list-float">
                        <li class="text-overflow"><a href="http://shuabao.net" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> 耍宝</a></li>
                        <li class="text-overflow"><a href="http://www.neihan8.com" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> 内涵吧</a></li>
                        <li class="text-overflow"><a href="http://www.gaoshouyou.com" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> 手机游戏</a></li>
                        <li class="text-overflow"><a href="http://www.hao123.com/?src=fanjian" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> hao123网址之家</a></li>
                        <li class="text-overflow"><a href="http://www.gaoshouvr.com" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> 高手VR</a></li>
                        <li class="text-overflow"><a href="http://h5.gaoshouyou.com" target="_blank"><span
                                class="icon iconfont">&#xe60d;</span> H5游戏</a></li>
                    </ul>
                </div>
            </div>

            <div class="box-bgm sub-follow">
                <div class="h-b">
                    <h2 class="h-title">关注我们</h2>
                    <span class="h-more"><a href="http://www.fanjian.net/info/about_us" target="_blank" class="fc-gray">了解犯贱志 &raquo;</a></span>
                </div>
                <div class="b">
                    <div class="sub-follow-show clearfix">
                        <div class="sub-follow-code fc-gray fl"><img
                                src="http://ww2.sinaimg.cn/large/bf2d8b8dgw1f86s3u19w8j204g04g74i.jpg" class="code">
                            犯贱志官方微信公众号
                        </div>
                        <div class="sub-follow-info">
                            <p><strong>壹群: </strong>477476620<a href="http://jq.qq.com/?_wv=1027&k=2Gj20YY" title="点击加群"
                                                                target="_blank"><img border="0"
                                                                                     src="http://pub.idqqimg.com/wpa/images/group.png"
                                                                                     alt="犯贱志壹群" title="犯贱志壹群"></a></p>
                        </div>
                        <div class="sub-follow-wb">
                            <p><img src="http://h5.sinaimg.cn/upload/2015/09/26/28/app/w-icon.png" title="新浪微博"> 官方微博:
                                <a href="http://weibo.com/fanjiannet" title="犯贱志新浪微博" target="_blank" class="fc-blue">@犯贱志</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-bgm">
                <div class="h-b">
                    <h2 class="h-title">站点公告</h2>
                    <!--<span class="h-more"><a href="#" target="_blank" class="fc-gray">了解犯贱志 &raquo;</a></span>-->
                </div>
                <div class="b">
                    <ul class="text-list dayhot">
                        <li class="text-overflow"><a href="http://www.fanjian.net/info/gg/detail/3" target="_blank"
                                                     title="犯贱志APP 3.1 发布">犯贱志APP 3.1 发布</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="foot">
    <div class="foot-box">
        <div class="foot-nav clearfix">
            <dl class="first">
                <dt class="fc-gray">犯贱志 FanJian.net</dt>
                <dd><a href="http://www.fanjian.net/info/about_us" target="_blank">关于我们</a></dd>
                <dd><a href="http://www.fanjian.net/info/contact_us" target="_blank">联系我们</a></dd>
                <dd><a href="http://www.fanjian.net/info/join_us" target="_blank">加入我们</a></dd>
                <dd><a href="http://www.fanjian.net/info/contract" target="_blank">用户协议</a></dd>
                <dd><a href="http://www.fanjian.net/info/disclaimer" target="_blank">免责声明</a></dd>
                <dd><a href="http://www.fanjian.net/info/bussiness" target="_blank">商务合作</a></dd>
            </dl>
            <dl>
                <dt class="fc-gray">帮助</dt>
                <dd><a href="http://www.fanjian.net/info/help" target="_blank">帮助中心</a></dd>
                <dd><a href="http://www.fanjian.net/info/sitemap" target="_blank">网站地图</a></dd>
                <dd><a href="http://www.fanjian.net/info/feedback" target="_blank">意见反馈</a></dd>
                <dd><a href="http://www.fanjian.net/info/tousu" target="_blank">内容投诉</a></dd>
            </dl>
            <dl class="short">
                <dt class="fc-gray">官方</dt>
                <dd><a href="http://weibo.com/fanjiannet" target="_blank">新浪微博</a></dd>
                <dd class="wx"><a>微信公众号</a>
                    <div class="wxshow"><img
                            src="http://ww2.sinaimg.cn/large/bf2d8b8dgw1f86s3u19w8j204g04g74i.jpg"><span>◆</span></div>
                </dd>
            </dl>
            <dl class="short last">
                <dt class="fc-gray">下载</dt>
                <dd><a href="http://app.fanjian.net/fjemoji01to03.rar" target="_blank">FJ表情包</a></dd>
                <dd><a href="http://app.fanjian.net" target="_blank">犯贱志App</a></dd>
            </dl>
        </div>
        <div class="foot-copyright"><a href="http://www.fanjian.net/" target="_self"><img
                src="http://ww2.sinaimg.cn/large/bf2d8b8dgw1f86s88d2ydj202i014743.jpg" width="90" height="40"></a>
            <p>Copyright © 2010-2016 犯贱志 保留所有权利.<span class="sp"></span>蜀ICP备16000981号-1<span class="sp"></span>蜀公网安备
                510114990608 <a href="http://www.fanjian.net/sitemap.xml">站点XML</a></p>
        </div>
    </div>
</div>
<div class="outwin cont-report">
    <div class="outwin-title"><strong>↖内容投诉</strong><a class="close">×</a></div>
    <div class="outwin-body">
        <form class="contReportForm tsForm" name="contReportForm" onsubmit="return false;">
            <fieldset>
                <legend>你认为<span class="report-id fc-red"></span>这篇内容有什么问题？</legend>
                <ul class="form-list">
                    <li class="form-line">
                        <label class="radio-label">
                            <input type="radio" name="t" value="1" datatype="*" nullmsg="请选择投诉类型">
                            内容违规：存在色情、暴力、反动等内容</label>
                        <label class="radio-label">
                            <input type="radio" name="t" value="2">
                            内容侵权：涉嫌侵犯他人版权</label>
                        <label class="radio-label">
                            <input type="radio" name="t" value="3">
                            恶意广告：有未明确标注的商业推广行为</label>
                        <label class="radio-label">
                            <input type="radio" name="t" value="4" class="other">
                            其他问题</label>
                        <label class="hidden">其他问题描述</label>
                        <textarea name="ReportTxt" rows="3" maxlength="200" class="input-text other-input hidden"
                                  placeholder="请填写你认为存在的其他问题，200字以内" datatype="*" nullmsg="请其他填写问题描述"></textarea>
                    </li>
                    <li class="form-bline">
                        <button type="submit" class="submit-button">提交</button>
                        <button type="button" class="cancel-button">取消</button>
                    </li>
                </ul>
            </fieldset>
        </form>
    </div>
</div>
<a href="http://www.fanjian.net/info/feedback" target="_blank" class="feedback icon iconfont fc-gray" title="意见反馈">&#xe601;<span>意见反馈</span></a>
<script type="text/javascript" src="./public/js/jquery-1.12.2.min.js?201706021919"></script>
<script type="text/javascript" src="./public/js/plugin/lazyload.min.js?201706021919"></script>
<script type="text/javascript" src="./public/js/plugin/jquery.slides.min.js?201706021919"></script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>
<script type="text/javascript" src="./public/js/plugin/Validform.js?201706021919"></script>
<script type="text/javascript" src="./public/js/main.js?201706021919"></script>
<script type="text/javascript" src="./public/js/plugin/swiper.jquery.min.js?201706021919"></script>
<script type="text/javascript" src="./public/js/page/shop.js?201706021919"></script>
<script type="text/javascript" src="./public/js/page/index.js?201706021919"></script>
<script type="text/javascript" src="./public/js/plugin/DatePicker/WdatePicker.js?201706021919"></script>
<script type="text/javascript">
    WdatePicker({
        eCont: 'data-files', skin: 'datafiles', maxDate: '%y-%M-%d', onpicked: function (dp) {
            //window.location.href = "http://www.fanjian.net/date/" + dp.cal.getDateStr();
            //           alert('你选择的日期是:' + dp.cal.getDateStr())
        }
    })
</script>
<script>window._bd_share_config = {
    "common": {
        "bdSnsKey": {},
        "bdText": "",
        "bdMini": "2",
        "bdMiniList": ["tsina", "tqq", "weixin", "sqq", "qzone", "linkedin", "fbook", "twi", "youdao", "copy"],
        "bdPic": "",
        "bdStyle": "2",
        "bdSize": "16"
    }, "share": {}
};
with (document)
    0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];</script>
<script type="text/javascript" src="http://www.fanjian.net/js/ac.js?201706021919"></script>
<div style="display: none">
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?51bc4db653a21320202015d6c36fb3cb";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</div>
<div class="outwin goll">
    <div class="outwin-title"><strong>欢迎回来犯贱志</strong><a class="close">×</a></div>
    <div class="outwin-body">
        <div class="goll-body">
            <form class="gollForm ajax_login" onsubmit="return false;" name="gollForm">
                <fieldset>
                    <legend>用户登录<a href="http://www.fanjian.net/user/reg" target="_self" class="fr fc-blue">立即注册
                        &#8250;</a></legend>
                    <ul class="form-list">
                        <li class="form-line">
                            <label class="hidden">登录帐号</label>
                            <input type="text" class="input-text goll-input" name="email" placeholder="用户名/邮箱/手机号码"
                                   datatype="na,s6-20|e|m" nullmsg="请输入登录用户名、邮箱或手机号码" errormsg="用户名、邮箱或手机号码格式错误">
                        </li>
                        <li class="form-line">
                            <label class="hidden">登录密码</label>
                            <input type="password" class="input-text goll-input" name="passwd" placeholder="登录密码"
                                   datatype="s6-20" nullmsg="请输入登录密码" errormsg="密码应为6-20位">
                        </li>
                        <li class="form-line clearfix">
                            <label class="fl">
                                <input type="checkbox" name="remember" value="1">
                                记住密码<span class="fc-gray">(非私人电脑请勿勾选)</span></label>
                            <a href="http://www.fanjian.net/user/forget" target="_self" class="fr">忘记密码？</a>
                        </li>
                        <li class="form-line">
                            <div id="popup_captcha" style="height: 42px;"></div>
                        </li>
                    </ul>
                </fieldset>
            </form>
            <ul class="form-list">
                <li class="form-tips fc-gray">使用第三方账号登录犯贱志：</li>
                <li class="form-line"><a href="javascript:;" target="_blank" class="login-other qq a-reg-qq">QQ</a> <a
                        href="javascript:;" target="_blank" class="login-other wb a-reg-wb">新浪微博</a> <a
                        href="javascript:;" target="_blank" class="login-other wx a-reg-wx">微信</a></li>
            </ul>
        </div>
    </div>
    <span class="Validform_checktip Validform_wrong"></span>
</div>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script>
    var handlerLoginPopup = function (captchaObj) {
        // 成功的回调
        captchaObj.onSuccess(function () {
            var validate = captchaObj.getValidate();
            var form = $("form.ajax_login");
            var data = form.serialize();
            var target = siteurl + "user/login?from=" + encodeURIComponent(window.location.href);
            $.post(target, data, function (d) {
                console.log(d);
                if (d.code == 400 && d.type) {
                    form.parent().parent().parent().find("span.Validform_checktip").removeClass('Validform_right').addClass('Validform_wrong').html(d.msg);
                }
                if (d.code == 200) {
                    if (d.goto) {
                        window.location.href = d.goto;
                    } else {
                        window.location.reload();
                    }
                }
            }, 'json');
        });
        captchaObj.appendTo("#popup_captcha");
        $("button.ll-button").click(function () {
            captchaObj.show();
        });
    };
    $(".quick-land").click(function () {
        $("#popup_captcha").empty();
        $.ajax({
            url: "http://www.fanjian.net/gt/st?t=" + (new Date()).getTime(),
            type: "get",
            dataType: "json",
            success: function (data) {
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    product: "float",
                    offline: !data.success,
                    width: '100%'
                }, handlerLoginPopup);
            }
        });
    });
</script>
<!--[if lte IE 9]>
<script type="text/javascript" src="http://www.fanjian.net/js/forie.js?201706021919"></script><![endif]-->
<script>
    (function () {
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script type="text/javascript">
    //    $(function() {
    //        eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('3(2.1("d")!=0){4(\'m\',\'d\')}3(2.1("i")!=0){4(\'k\',\'i\')}3(2.1("b")!=0){4(\'l\',\'b\')}3(2.1("9")!=0){4(\'j\',\'9\')}3(2.1("a")!=0){4(\'r\',\'a\')}3(2.1("c")!=0){4(\'5\',\'c\')}3(2.1("6")!=0){4(\'s\',\'6\')}3(2.1("8")!=0){4(\'5\',\'8\')}3(2.1("7")!=0){4(\'t\',\'7\')}3(2.1("h")!=0){4(\'q\',\'h\')}3(2.1("e")!=0){4(\'n\',\'e\')}3(2.1("g")!=0){4(\'o\',\'g\')}3(2.1("f")!=0){4(\'p\',\'f\')}',30,30,'undefined|getElementById|document|if|BAIDU_CLB_fillSlotAsync|u2721020|bbssapdea|bbssapf|bbssape|bbssapcd|bbssapd|bbssapc|bbssapde|bbssapa|bbssapfdb|bbssapzb|bbssapza|bbssapfda|bbssapb|u2900753|u2720975|u2900688|u2720971|u2900738|u2720899|u2900702|u2900732|u2900693|u2900713|u2900720'.split('|'),0,{}));
    //    });
    //    window.onerror=function(){return true;}
</script>
<div class="jumptom"><a href="javascript:;" class="mban"><i>点此切换到新移动版</i></a></div>
<script type="text/javascript">
    function setCookie(name, value, expiredays) {
        var exp = new Date();
        exp.setTime(exp.getTime() + expiredays);
        document.cookie = name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exp.toGMTString()) + ';path=/;domain=fanjian.net';
    }
    $(".mban").click(function () {
        setCookie('mfjian', false, null);
        var url = window.location.href;
        var url = url.replace('www.', 'm.');
        window.location.href = url;
        return false;
    });
</script>
</body>
</html>
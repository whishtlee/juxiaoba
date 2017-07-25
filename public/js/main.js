(function($){
	$(document).ready(function (){

	if ($(window).width() <= 800) {
		$("<link>")
			.attr({
				rel: "stylesheet",
				type: "text/css",
                href: "http://www.fanjian.net/css/fj-basis-t.css"
			})
			.appendTo("head");
	}
	
	$("img.lazy").lazyload({
		failure_limit :100,
		skip_invisible : false,
		threshold : 200,
		effect : "fadeIn",
		load:function(elements_left, settings) {
			if(!$(this).parents(".cont-list").hasClass("driver-list")){
				var $thismain =$(this).parents(".cont-list-main");
       			if($thismain.height()>=700 && $(window).width()>800){
				$thismain.addClass("cut").append("<div class='cont-list-main-more'><span>点击展开</span></div>");
			};
			$thismain.find(".cont-list-main-more").click(function(){
				$(this).hide();
				$thismain.removeClass("cut");
			});
			};
		}
	});
	
	$(".cont-list-main").each(function(index, element) {
		if($(this).find("img").length<1){
		var $thismain =$(this);
       	if($thismain.height()>=700 && $(window).width()>800){
			$thismain.addClass("cut").append("<div class='cont-list-main-more'><span>点击展开</span></div>");
		};
		$thismain.find(".cont-list-main-more").click(function(){
			$(this).hide();
			$thismain.removeClass("cut");
		});
		};    
    });

	$(".all-top-search").hover(function(){
		$(this).addClass("active");	
	},function(){
		if(!$(this).find(".all-top-search-input").hasClass("active")){
			$(this).removeClass("active");
		};		
	});
	
	$(".all-top-search-input").focus(function(){
		$(this).addClass("active").parents(".all-top-search").addClass("active");
	});
	
	$(".all-top-search-input").blur(function(){
		$(this).removeClass("active").parents(".all-top-search").removeClass("active");
	});
	
	$(".sup-message").each(function(index, element) {
		var $num=$(this).text();
		var $numm = parseInt($num);
        if($numm>99){
			$(this).text("99+");	
		} else if($numm==0){
			$(this).hide();
		};
    });
	
	if(!$(".goll").length==0){
		$(".quick-land").click(function(){
			$("body").append("<div class='btbg' />");
			$(".goll").fadeIn(200);
			if($("html").height()<$(window).height()){
				$(".btbg").height($(window).height());
				};
		});
	};
	
	$(".user-lv-line").each(function(index, element) {
        var n=$(this).find(".jn").text(),
			u=$(this).find(".ju").text(),
			b=n/u*100;
		$(this).find("p").find("i").css("width",b+"%")
    });
	
	$(".landed,.message").hover(function(){ 
			$(this).addClass("active").find(".all-top-hidden").stop(true,false).fadeIn(200);
	},function(){
		$(this).removeClass("active").find(".all-top-hidden").fadeOut(200);
	});
	
	$(".all-top-message li").each(function(index, element) {
        if($(this).find("strong").text()>=100){
			$(this).find("strong").text("99+").addClass("fc-red");	
		};
		if($(this).find("strong").text()>=1){
			$(this).find("strong").addClass("fc-red");	
		}else{
			$(this).find("strong").addClass("fc-gray")
		}
    });
	
	$(".outwin").find(":radio").click(function(){
			var $parent =$(this).parents(".outwin");
			if($parent.find(":radio.other").is(":checked")){
				 $parent.find(".input-text").removeClass("hidden");
			} else {
				 $parent.find(".input-text").addClass("hidden");	
			}
		});
	
	$(".outwin .close,.outwin .cancel-button").click(function(){
		var $win=$(this).parents(".outwin");
		$win.fadeOut(200);
		if($("body").find(".btbg").length==1){
			$(".btbg").remove();
		};
	});

	$(".pager").each(function(index, element) {
        if($(this).find("i").html()<5){
			$(this).find(".pager-before,.pager-first").hide();
			};
    });
	
	// $(".gollForm").Validform({
	// 	ignoreHidden:true,
	// 	dragonfly:false,
	// 	showAllError:false,
	// 	postonce:true,
	// 	datatype:{
	// 		"na":/^[a-zA-Z][a-zA-Z0-9\-_]{5,19}$/,
	// 		"nc":/^[a-zA-Z0-9\u4e00-\u9fa5]{2,8}$/,
	// 	},
	// 	tiptype:function(msg,o,cssctl){
	// 		if(!o.obj.is("form")){
	// 			if(o.obj.parents(".outwin").find(".Validform_checktip").length==0){
	// 				o.obj.parents(".outwin").append("<span class='Validform_checktip'></span>");}
	// 			var objtip=o.obj.parents(".outwin").find(".Validform_checktip");
	// 			cssctl(objtip,o.type);
	// 			objtip.text(msg);
	// 			}
	// 		}
	// });
	
	$(".htc li").click(function(){
		$(this).addClass("active").siblings().removeClass("active").parents(".h-htc").next(".b").find("."+$(this).attr("id")).show().siblings().hide();	
	});
	
	$(".password-check").click(function(){
		// $(this).html(["&#xe61c;","&#xe61b;"][this.hutia^=1]);
        $(this).html(["",""][this.hutia^=1]);
		if($(this).siblings(".input-text").attr("type")=="password"){
			$(this).siblings(".input-text").attr("type","text");	
		} else{
			$(this).siblings(".input-text").attr("type","password");		
		};
	});
	
	$(".goto").click(function(){
       		var ddIndex = $(this).stop().attr('href').replace("#","");
       		var windowTop = $("[id="+ddIndex+"]").offset().top;
			var hh=$(".all-top").height()+15;
        	$('body,html').animate({scrollTop: windowTop-hh}, 200);
			return false;
	});
	
	//导航浮动
	if(!$(".page-nav").length==0 && $(window).width()>=1000){
		var nav=$(".page-nav"),
			toph=$(".all-top").height(),
			navtop=nav.siblings(".page-body").offset().top;
			$(".page-nav").css("top",navtop+15);
		$(window).scroll(function(){
			if($(window).scrollTop()>navtop-toph-15){
				nav.addClass("active").css("top",toph+15);
			} else {
				nav.removeClass("active").css("top",navtop+15);	
			};	
		});		
	};
	
	//关注浮动
	if(!$(".sub-follow").length==0 && $(window).width()>=1000 && $(".sub-app").length==0){
		var follow=$(".sub-follow"),
			followh=follow.height(),
			toph=$(".all-top").height(),
			followtop=follow.offset().top-toph-15;
		$(window).scroll(function(){
			if($(window).scrollTop()>followtop){
				follow.parent(".sub").css("padding-bottom",followh+15);
				follow.addClass("active").css("left",follow.parent(".sub").offset().left).css("top",toph+15).css("width",follow.parent(".sub").width());
			} else {
				follow.removeClass("active").removeAttr("style");
				follow.parent(".sub").removeAttr("style");	
			};	
		});	
	} else if(!$(".sub-follow").length==0 && $(window).width()>=1000 && !$(".sub-app").length==0){
		var follow=$(".sub-app"),
			followh=follow.height(),
			toph=$(".all-top").height(),
			followtop=follow.offset().top-toph-15;
		$(window).scroll(function(){
			if($(window).scrollTop()>followtop){
				follow.parent(".sub").css("padding-bottom",followh+follow.siblings(".sub-follow").height()+30);
				follow.addClass("active").css("left",follow.parent(".sub").offset().left).css("top",toph+15).css("width",follow.parent(".sub").width());
				follow.siblings(".sub-follow").addClass("active").css("left",follow.parent(".sub").offset().left).css("top",toph+15+followh+15).css("width",follow.parent(".sub").width());
			} else {
				follow.removeClass("active").removeAttr("style").siblings(".sub-follow").removeClass("active").removeAttr("style");	
				follow.parent(".sub").removeAttr("style");	
			};	
		});		
	};
	
	//触屏判断
	if($(window).width()<800){
		$("body").find(".wumi-box").parent(".box-pm").hide();
		$("body").find(".sub").append("<div class='cover'/>");
		$(".cover").click(function(){
			$(this).hide().parent().css("height","auto");	
		});	
		$(".uc-articles-edit").parent().append("<div class='nothing fc-gray'>请登录犯贱志桌面网站进行投稿，谢谢</div>");
		$(".setting-head").parent().append("<div class='nothing fc-gray'>请登录犯贱志桌面网站进行头像上传及修改，谢谢</div>");
	}
	

	//capslock判断	
		$(".capslock-check").each(function() {
			var isCapslockOn;  
        function checkCapsLock_keyPress(e) {  
            var e = window.event || e;  
            var keyCode = e.keyCode || e.which;//按键的keyCode。  
            var isShift = e.shiftKey || (keyCode == 16) || false;//shift键是否按住。  
            if (  
            (keyCode >= 65 && keyCode <= 90 && !isShift)||(keyCode >= 97 && keyCode <= 122 && isShift)
			)
                {isCapslockOn = true;} 
        };
		
        function checkCapsLock_keydown(e) {
			var e = window.event || e;   
            var keyCode = e.keyCode || e.which;//按键的keyCode
            if (keyCode == 20 && isCapslockOn == true)  
                {isCapslockOn = false;}  
            else if (keyCode == 20 && isCapslockOn == false)  
                {isCapslockOn = true;}			
        }  

        //keyPress可以判断当前CapsLock状态，但不能捕获CapsLock键。  
        $(document).keypress(checkCapsLock_keyPress);  
        //keyDown可以捕获CapsLock键，但不能判断CapsLock的状态。  
        $(document).keydown(checkCapsLock_keydown);
			$(this).after("<span class='capslock-tip'>大写已锁定</span>");
            $(this).focus(function(){
				if( isCapslockOn==true){
						$(this).siblings(".capslock-tip").fadeIn(200);
					};
				$(this).keyup(function(){
					if( isCapslockOn==true){
						$(this).siblings(".capslock-tip").fadeIn(200);
					} else {
						$(this).siblings(".capslock-tip").fadeOut(200);	
					}
				})	
			});
			$(this).blur(function(){  
            	$(this).siblings(".capslock-tip").fadeOut();  
       		});
        });
	
	
	
	//返回顶部
	var $backToTopTxt = "返回顶部", $backToTopEle = $('<div class="icon iconfont backtotop fc-gray"></div>').appendTo($("body")).attr("title", $backToTopTxt).click(function() {
            $("html, body").animate({ scrollTop: 0 }, 200);
    }), $backToTopFun = function() {
        var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0)? $backToTopEle.show(): $backToTopEle.hide();    
        //IE6下的定位
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 200);    
        }
    };
    $(window).bind("scroll", $backToTopFun);
    $(function() { $backToTopFun(); });

	
	if($('.gd-slides').length>=1){
	$('.gd-slides').slidesjs({
        width: 280,
        height: 158,
        navigation: {
		  active: false,
          effect: "fade"
        },
        pagination: {
          effect: "fade"
        },
        effect: {
          fade: {
            speed: 400
          }
        },
		play: {
     	  active: false,
     	  effect: "fade",
      	  interval: 5000,
      	  auto: false,
      	  swap: false,
      	  pauseOnHover: true,
      	  restartDelay: 2500
 	   }
      });
	};
	
	$(".cont-list-reward,.comment-head,.view-editor-head,.uc-head,.cont-list-tvreward").each(function(index, element) {
        var $this=$(this);
		$this.append("<i class='headstyle hs0101' />")
    });
		
	$(".gd-fixed .close").click(function(){
		$(this).parent().remove();	
	});
	
});
})(window.jQuery);

//倒计时跳转
function delayURL(url) {
    var $delay = $(".auto-time").text();
    if ($delay > 0) {
        $delay--;
        $(".auto-time").text($delay)
    } else {
        window.top.location.href = url
    }
    setTimeout("delayURL('" + url + "')", 500)
	}

//textarea光标处插入内容
$.fn.extend({
   insertContent : function(myValue, t) {
   var $t = $(this)[0];
   if (document.selection) { // ie
    this.focus();
    var sel = document.selection.createRange();
    sel.text = myValue;
    this.focus();
    sel.moveStart('character', -l);
    var wee = sel.text.length;
    if (arguments.length == 2) {
    var l = $t.value.length;
    sel.moveEnd("character", wee + t);
    t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart( "character", wee - t - myValue.length);
    sel.select();
    }
   } else if ($t.selectionStart
    || $t.selectionStart == '0') {
    var startPos = $t.selectionStart;
    var endPos = $t.selectionEnd;
    var scrollTop = $t.scrollTop;
    $t.value = $t.value.substring(0, startPos)
     + myValue
     + $t.value.substring(endPos,$t.value.length);
    this.focus();
    $t.selectionStart = startPos + myValue.length;
    $t.selectionEnd = startPos + myValue.length;
    $t.scrollTop = scrollTop;
    if (arguments.length == 2) {
    $t.setSelectionRange(startPos - t,
     $t.selectionEnd + t);
    this.focus();
    }
   } else {
    this.value += myValue;
    this.focus();
   }
   }
  });
  
//滚动插件
$.fn.extend({ 
	textScroll:function(opt,callback){ 
	//参数初始化 
	if(!opt) var opt={}; 
	var _this=this.eq(0).find("ul:first"); 
	var lineH=_this.find("li:first").height(), //获取行高 
		line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), 
		//每次滚动的行数，默认为屏，即父容器高度 
		speed=opt.speed?parseInt(opt.speed,10):500, //卷动速度，数值越大，速度越慢（毫秒） 
		timer=opt.timer?parseInt(opt.timer,10):3000; //滚动的时间间隔（毫秒） 
	if(line==0) line=1; 
	var upHeight=0-line*lineH; 
	//滚动函数 
	scrollUp=function(){ 
		_this.animate({ 
		marginTop:upHeight 
		},speed,function(){ 
			for(i=1;i<=line;i++){ 
			_this.find("li:first").appendTo(_this); 
		} 
			_this.css({marginTop:0}); 
		}); 
	} 
	//鼠标事件绑定 
	_this.hover(function(){ 
		clearInterval(timerID); 
		},function(){ 
			timerID=setInterval("scrollUp()",timer); 
		}).mouseout(); 
	} 
}); 
		
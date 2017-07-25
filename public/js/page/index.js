(function($){
	$(document).ready(function (){
	
//	$('.index-slides').slidesjs({
//        width: 700,
//        height: 180,
//        navigation: {
//		  active: false,
//          effect: "fade"
//        },
//        pagination: {
//          effect: "fade"
//        },
//        effect: {
//          fade: {
//            speed: 400
//          }
//        },
//		play: {
//     	  active: false,
//     	  effect: "fade",
//      	  interval: 5000,
//      	  auto: true,
//      	  swap: false,
//      	  pauseOnHover: true,
//      	  restartDelay: 2500
// 	   }
//      });
	
	
		
	//$(".cont-list-main embed").each(function(){
//		var type=$(this).attr("type");
//		if(type=='application/x-shockwave-flash'){
//		$(this).attr("flashvars","playMovie=false&amp;auto=false&amp;autostart=false&amp;autoplay=false&amp;play=false&amp;autopause=true");
//		$(this).attr("width","100%");
//		$(this).attr("height",$(this).width()*9/16);
//		}
//	});

	$(".cont-list-main a").each(function(){
		var $html=$(this).text();
		if($html=='点击播放'||$html=='点此观看视频'||$html=='点此播放视频'){
		$(this).html("<span class='icon iconfont'>&#xe62b;</span>点击播放视频").addClass("videolink");
		};
	});
	
	$(".h-reload").click(function(){
		window.location.reload();	
	});

	$(".driver-card").each(function(index, element) {
		$(this).parent(".driver-show").width($(this).siblings("img").width());
        $(this).click(function(){
				$(this).siblings(".driver-cover").fadeOut(500);
				$(this).remove();
		});
    });

	//文章列表操作,文章标题赋值文章ID
	$(".cont-list-tools").each(function(index, element) {
		//投诉
        var $report=$(this).find(".report");
		var $id=$report.parents(".cont-item").find(".cont-list-title a").attr("data-id");
		$report.click(function(){
			var $html= $(".cont-report");
			if($('#cont-report-'+$id).is(":hidden")||$('#cont-report-'+$id).length==0){
			$html.attr("id","cont-report-"+$id).css({top:$report.offset().top,left:$report.offset().left}).find(".report-id").text($id);
			$html.fadeIn(200);
			$html.find(":radio").removeAttr("checked");
			$html.find(".Validform_checktip").remove();
			$html.find(".other-input").addClass("hidden");
			} else {
			$html.fadeOut(200);
			};
        });	
//		//赞
//		var $like=$(this).find(".like");
//		var $likenum=parseInt($like.find("i").text());
//		$like.click(function(){
//			if(!$like.hasClass("active")){
//				$(this).addClass("active").find("b").html("{已赞}").siblings("i").text($likenum+1);
//				$(this).append("<em class='little-tips lt-r'>赞+1</em>");
//				setTimeout(function () { 
//        			$like.find(".little-tips").remove();
//   				}, 1000);
//			}else{
//				$like.find(".little-tips").remove();
//				$(this).append("<em class='little-tips'>已赞</em>");
//			};
//		});	
//		
//		//踩
//		var $unlike=$(this).find(".unlike");
//		var $unlikenum=parseInt($unlike.find("i").text());
//		$unlike.click(function(){
//			if(!$unlike.hasClass("active")){
//				$(this).addClass("active").find("b").html("{已踩}").siblings("i").text($unlikenum+1);
//				$(this).append("<em class='little-tips lt-b'>踩+1</em>");
//				setTimeout(function () { 
//        			$unlike.find(".little-tips").remove();
//   				}, 1000);
//			}else{
//				$unlike.find(".little-tips").remove();
//				$(this).append("<em class='little-tips'>已踩</em>");	
//			};
//		});	
//		
//		//收藏
//		var $mark=$(this).find(".mark");
//		$mark.click(function(){
//			if(!$mark.hasClass("active")){
//				$(this).addClass("active").html("{已收藏}");
//				$(this).append("<em class='little-tips'>收藏成功</em>");
//			}else{
//				$mark.find(".little-tips").remove();
//				$(this).removeClass("active").html("{收藏}");
//				$(this).append("<em class='little-tips'>收藏取消</em>");	
//			};
//		});	
    });
	
	$(".contReportForm").Validform({
		ignoreHidden:true,
		dragonfly:false,
		showAllError:false,
		postonce:true,
		tiptype:function(msg,o,cssctl){
			if(!o.obj.is("form")){
				if(o.obj.parents(".outwin").find(".Validform_checktip").length==0){
					o.obj.parents(".outwin").append("<span class='Validform_checktip'></span>");}
				var objtip=o.obj.parents(".outwin").find(".Validform_checktip");
				cssctl(objtip,o.type);
				objtip.text(msg);
				}
			}
	});
		
});
})(window.jQuery);
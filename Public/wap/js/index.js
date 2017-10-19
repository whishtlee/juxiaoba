define(function(require, exports, module) {
	var App = require('app'),
			touch = require('touch'),
			uploadfile = require('uploadfile'),
			layer = require('layer'),
			swiper = require('swiper'),
			template = require('template'),
			page = require('page'),
			XJ = window.XJ || {};

	/*
	 *页面信息提示框
	 */
	XJ.tips=function(a){a=a||{};var opts={id:a.id||'xjTips',text:a.text||'',time:a.time||3000,y:a.y||($(window).height()-80)/2,color:a.color||'#ff7e69',bgcolor:a.bgcolor||'#303237'};var objId='#'+opts.id;if(opts.text!=''){if($(objId).length<=0){$('body').append('<div id="'+opts.id+'"></div>')}
$(objId).html('<p>'+opts.text+'</p>').css('background',opts.bgcolor).css('color',opts.color).css('top',opts.y+'px').css('left','50%');$(objId).animate({'opacity':1,'["-moz-opacity"]':1,'["filter"]':'alpha(opacity=100)'},300)
setTimeout(function(){$(objId).animate({'opacity':0,'["-moz-opacity"]':0,'["filter"]':'alpha(opacity=0)'},300)
$(objId).remove();},opts.time);}}

	/*
 	*滑出弹框
 	*/
	XJ.slideDialog=function(tthis,dtype){var type=dtype||1;if(type==1){if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg" class="dialogBg"></div>');}
$('#dialogBg').css('display','block').css('z-index','998').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');$('#dialogBg').animate({'opacity':0.5,'["-moz-opacity"]':0.5,'["filter"]':'alpha(opacity=50)'},300);tthis.animate({bottom:'0'},300);$('#dialogBg').on('tap',function(){XJ.closeDialog(tthis);});}else if(type==2){var winHeight=$(window).height();var tthisHeightt=tthis.height();var bottom=(winHeight-tthisHeightt)/2;tthis.css('bottom',bottom).css('border-radius','4px').css('width','96%').css('left','2%').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg" class="dialogBg"></div>');}
$('#dialogBg').css('display','block').css('z-index','998').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');$('#dialogBg').animate({'opacity':0.5,'["-moz-opacity"]':0.5,'["filter"]':'alpha(opacity=50)'},300);tthis.animate({'opacity':1,'["-moz-opacity"]':1,'["filter"]':'alpha(opacity=100)'},300);$('#dialogBg').on('tap',function(){XJ.closeDialog(tthis,type);});}}

	/**
	 * 关闭滑出弹框
	 */
	XJ.closeDialog=function(tthis,dtype){var type=dtype||1;if(type==1){tthis.animate({bottom:'-280px'},300)}else if(type==2){tthis.animate({'opacity':0,'["-moz-opacity"]':0,'["filter"]':'alpha(opacity=0)'},300)}
$('#dialogBg').animate({opacity:'0'},300)
setTimeout(function(){tthis.css('display','none');$('#dialogBg').css('display','none');},350);};
	/*
	 *顶踩的动画效果
	 */
	XJ.votingNum=function(content,tthis){var top=tthis.offset().top;var left=tthis.offset().left;if($('#votingNum').length<=0){$('body').append('<div id="votingNum"></div>');}
$('#votingNum').html(content).css('display','block').css('top',top).css('left',left).css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');$('#votingNum').animate({'z-index':90,'margin':0,'top':top-25,'opacity':1,'["-moz-opacity"]':1,'["filter"]':'alpha(opacity=100)'},300)
setTimeout(function(){$('#votingNum').html('').css('display','none');},310)};

	//判断获取图片大小是否超过上限
	XJ.handleFiles=function(obj){window.URL=window.URL||window.webkitURL;var fileElem=document.getElementById("fileElem");var imgSize;var files=obj.files,img=new Image();if(window.URL){imgSize=files[0].size;}else if(window.FileReader){var reader=new FileReader();reader.readAsDataURL(files[0]);reader.onload=function(e){imgSize=e.total;}}else{obj.select();obj.blur();var nfile=document.selection.createRange().text;document.selection.empty();img.onload=function(){imgSize=img.fileSize;}}
if(imgSize>5*1024*1024){XJ.tips({text:'文件不能超过5M'});}else{$('#textfield').val($('#fileElem').val());}};

	//搜索
	$('.search-submit').on('click',function(){search($(this));})
	$('#key').keyup(function(event){if(event.keyCode==13){search($(this));}});function search(_this){var key=_this.closest('.search').find('#key').val();if(key.length==''){App.alert('搜索关键字不能为空');return false;}window.location='/joke/search/key/'+key;}


	//导航菜单
	$('.joke-list').click(function(){$('.h-menu-list').fadeOut();});
	$('.h-menu').click(function(){var _this=$(this);hide_video(_this);var tthis=$('.h-menu-list');tthis.toggle();if($('#dialogBg').length<=0){$('body').append('<div id="dialogBg"></div>')};$('#dialogBg').css('display','block').css('z-index','9').css('opacity',0).css('-moz-opacity',0).css('filter','alpha(opacity=0)');$('#dialogBg').click(function(){show_video(_this);tthis.toggle();$('#dialogBg').animate({opacity:'0'},100);setTimeout(function(){tthis.css('display','none');$('#dialogBg').css('display','none')},110)})})

	//关注 取关
	$('body').delegate('a[data-ajax]','click',function(){if($('#loginture').length<0){window.location.href="/user/login";return;};var _t=$(this);var userid=_t.data('userid');if(userid){if(!_t.hasClass('user-cancelfollow')){App.request({url:'/ajax/follow',data:{uid:userid},success:function(re){if(re.err){_t.addClass('user-cancelfollow').html('<i class="icon icon10 icon-cut"></i>已关注');}else{layer.open({content:re.msg,time:1});}}})}else{App.request({url:'/ajax/cancelfollow',data:{uid:userid},success:function(re){if(re.err){_t.removeClass('user-cancelfollow').html('<i class="icon icon10 icon-add-h"></i>关注');}else{layer.open({content:re.msg,time:1});}}})}}})

	//私信
	$('body').delegate('.user-dm','click',function(){if($('#loginture').length<0){window.location.href="/user/login";return;};var _t=$(this);var username=_t.data('username');var userid=_t.data('userid');var dmHtml=$('<div class="alert-shadow"></div><div id="user-dm"><a href="javascript:void(0);" class="alert-close"></a><div class="umsg-box"><h5>发送给：'+username+'</h5><span class="comment-num" id="maxlen">140</span><textarea name="" id="dmcontent" cols="30" rows="10" class="umsg-box-in"></textarea><div class="comment-fun"><input type="submit" id="submit_dm" class="comment-btn" value="发送"></div></div></div>');dmHtml.appendTo('body');dmHtml.find('#dmcontent').on('keyup keypress change',function(){var maxlen=140;var val=this.value;var len=val.length;if(maxlen-len<0){this.value=val.substr(0,maxlen);}else{len=maxlen-len;dmHtml.find('#maxlen').html(len);}});dmHtml.find('.alert-close').click(function(){dmHtml.remove();})
dmHtml.find('#submit_dm').click(function(){var content=dmHtml.find('#dmcontent').val();if(content==''){layer.open({content:'私信内容不能为空',time:100});return false;}
App.request({url:'/ajax/send_msg',data:{uid:userid,content:content},loading:false,success:function(re){if(re.err){dmHtml.remove();layer.open({content:'私信发送成功',time:1});}else{layer.open({content:re.msg,time:1});}}})})})

	//签到
	$('#ysign-box').on('tap',function(){App.request({url:'/ajax/sign',loading:false,success:function(re){if (re.err){$('#ysign-box').hide();$('#nosign-box').show();XJ.tips({text:re.msg,color:'#fff'});}else{XJ.tips({text:re.msg,color:'#fff'});}}});})

	//分享
	$('.j-share').on('tap',function() {
			var htm, title, pic, url;
			title = $(this).attr('data-title');
			pic = $(this).attr('data-pic');
			url = $(this).attr('data-url');
			htm = '<dt>分享到</dt>';
			htm += '<dd class="share-channel">';
			htm += '<div class="bdsharebuttonbox">';
			htm += '<ul class="gb_resItms">';
			htm += '<li> <a title="分享到微信" href="#" class="bds_weixin s-sweixin" data-cmd="weixin" data-url="' + url + '"></a><p>微信好友</p></li>';
			htm += '<li> <a title="分享到QQ好友" href="#" class="bds_sqq s-sqq" data-cmd="sqq" data-url="' + url + '"></a><p>QQ好友</p></li>';
			htm += '<li> <a title="分享到QQ空间" href="#" class="bds_qzone s-qzone" data-cmd="qzone" data-url="' + url + '"></a><p>QQ空间</p></li>';
			htm += '<li> <a title="分享到腾讯微博" href="#" class="bds_tqq s-tqq" data-cmd="tqq" data-url="' + url + '"></a><p>腾讯微博</p></li>';
			htm += '<li> <a title="分享到新浪微博" href="#" class="bds_tsina s-tsina" data-cmd="tsina" data-url="' + url + '"></a><p>新浪微博</p></li>';
			htm += '<li> <a title="分享到人人网" href="#" class="bds_renren s-sms" data-cmd="renren" data-url="' + url + '"></a><p>人人网</p></li>';
			htm += '</ul>';
			htm += '</div>';
			htm += '</dd>';
			htm += '<dd class="share-close"><a href="javascript:void(0)">取消</a></dd>';
			if ($('#xiajiongShare').length <= 0) {
				$('body').append('<dl class="xj-share" id="xjShare"></dl>')
			};
			$('#xjShare').html(htm);
			$('#xjShare').css('display', 'block').css('position', 'fixed').css('bottom', '-3rem').css('z-index', '9999');
			XJ.slideDialog($('#xjShare'), 2);
			window._bd_share_config = {
				"common": {
					"bdSnsKey": {},
					"bdText": title,
					"bdMini": "2",
					"bdMiniList": false,
					"bdPic": pic,
					"bdStyle": "0",
					"bdSize": "16",
					"bdCustomStyle": '/Public/wap/css/bdshare.css'
				},
				"share": {},
				"image": {
					"viewList": ["qzone", "tsina", "tqq", "renren", "weixin", "sqq"],
					"viewText": "分享到：",
					"viewSize": "16"
				},
				"selectShare": {
					"bdContainerClass": null,
					"bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin", "sqq"]
				}
			};
			with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
			$('.share-close').on('tap',function() {
				$('#xjShare').remove();
				$('#dialogBg').remove();
				// $('.bdselect_share_bg').remove();
				// $('.bdselect_share_box').remove();
				// $('.sr-bdimgshare').remove();
				XJ.closeDialog($('#xjShare'), 2)
			})
		})

	//返回顶部
	if($('#goTop').length>0){$(window).scroll(function(){var top=$(window).scrollTop()/40;if(top>(300/40)){$('#goTop').css('display','block');}else{$('#goTop').css('display','none');}});$('#goTop').click(function(){$('body,html').animate({scrollTop:0},1000);})}

	//判断IOS访问终端
	if(/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)){$('html').addClass('ios');}


	/*
	*笑话顶踩提交
	*/
	XJ.jokeVote=function(tthis,type){var Jid=tthis.parent().parent('li').attr('data-j-id');var jokeType=tthis.parent().parent('li').attr('joke-type');tthis.find('i').text(Number(tthis.find('i').text())+1);tthis.parent().find('.j-bad').attr('class','j-baded').unbind('click');tthis.parent().find('.j-good').attr('class','j-gooded').unbind('click');App.request({url:'/xiaohua/record',data:{id:Jid,type:type},loading:false,success:function(ret){}})}

	//顶 、 踩
	$('.j-good').on('click',function(){var self=null;if(this.nodeName=='I'){self=this.parentNode;}else{self=this;};XJ.votingNum('<b style="color:#ff7e69;">+1</b>',$(self));XJ.jokeVote($(self),'good');})
	$('.j-bad').on('click',function(){var self=null;if(this.nodeName=='I'){self=this.parentNode;}else{self=this;};XJ.votingNum('<b style="color:#88cbea;">-1</b>',$(self));XJ.jokeVote($(self),'bad');})

	//解决video标签z-index值最大化遮挡其他元素问题
	function hide_video(obj){
		$('body').find('div[class^="container"]').hide();
	}
	function show_video(obj){
		$('body').find('div[class^="container"]').show();
	}

	//打赏
	var j_maryane=$('.j-maryane');touch.on(j_maryane,'tap',function(){var _this=$(this);hide_video(_this);var htm,jId,tthis,tScore,uScore;tthis=$(this);jId=$(this).parent().parent().attr('data-j-id');tScore=parseInt($(this).attr('total-score'));uScore=parseInt($(this).attr('user-score'));htm='<form id="form_maryane"><dl>';htm+='<dd>';if(uScore>0){htm+='<p>你给TA打赏了<em class="s-color-red">'+uScore+'</em>积分</p>';htm+='<p>只能打赏一次哦 ^_^</p>'}else{htm+='<a href="javascript:void(0);" data-id="5"><span>5积分</span></a>';htm+='<a href="javascript:void(0);" data-id="10" class="hover"><span>10积分</span></a>';htm+='<a href="javascript:void(0);" data-id="20"><span>20积分</span></a>';htm+='<a href="javascript:void(0);" data-id="30"><span>30积分</span></a>';htm+='<a href="javascript:void(0);" data-id="40"><span>40积分</span></a>';htm+='<a href="javascript:void(0);" data-id="50"><span>50积分</span></a>';htm+='<input name="id" type="hidden" id="id" value="'+jId+'">';htm+='<input name="fee" type="hidden" id="fee" value="10">'};htm+='</dd>';htm+='<dd class="j-m-message"></dd>';if(uScore>0){htm+='<dd class="j-m-btn"><button type="button" class="maryane-close">关闭</button></dd>'}else{htm+='<dd class="j-m-btn"><button type="button" class="maryane-submit">打赏</button><button type="button" class="maryane-close">不理他</button></dd>'};htm+='</dl></form>';if($('#jMaryane').length<=0){$('body').append('<div class="j-maryane-box" id="jMaryane"></div>')};$('#jMaryane').html(htm);$('#jMaryane').css('display','block').css('position','fixed').css('bottom','-280px').css('z-index','999');XJ.slideDialog($('#jMaryane'),2);var mc=$('.maryane-close');touch.on(mc,'tap',function(){XJ.closeDialog($('#jMaryane'),2);show_video(_this)});var jMaryane=$('#jMaryane a');touch.on(jMaryane,'tap',function(){var self=null;if(this.nodeName=='SPAN'){self=this.parentNode}else{self=this};$(self).addClass('hover').siblings().removeClass('hover');$('#fee').val($(self).attr('data-id'))});var ms=$('.maryane-submit');touch.on(ms,'tap',function(){$('.maryane-submit').attr("disabled",true).val('打赏中..').css('background','#bcbcbd');App.request({url:'/ajax/award',data:$('#form_maryane').serialize(),loading:false,success:function(ret){if(ret.err>0){XJ.tips({text:'打赏成功！',color:'#fff'});XJ.closeDialog($('#jMaryane'),2);tthis.removeClass('j-maryane').addClass('rewarded').html('已打赏');show_video(_this)}else{XJ.closeDialog($('#jMaryane'),2);XJ.tips({text:ret.msg,color:'#fff'});$('.j-m-message').html(ret.msg);$('.maryane-submit').attr("disabled",false).val('打赏').css('background','#ff845b');show_video(_this)}}})})});

	//包养
	var j_kept=$('.j-kept');touch.on(j_kept,'tap',function(){var _this=$(this);hide_video(_this);var htm,jId,score,tthis;tthis=$(this);score=$(this).data('fee');jId=$(this).data('id');htm='<div id="form_kept">';htm+='<div class="j-kept_1"><i></i></div>';htm+='<div class="j-k-content">';htm+='<p>包养我吧！只需<span class="s-color-red">'+score+'</span>积分哦！</p>';htm+='<p class="j-k-message"></p>';htm+='</div>';htm+='<div class="j-k-btn"><button type="submit" class="kept-submit">包养</button><button type="reset" class="kept-close">走开</button></div>';htm+='<input type="hidden" name="joke_id" value="'+jId+'"/>';htm+='</div>';if($('#jKept').length<=0){$('body').append('<div class="j-kept-box" id="jKept"></div>')};$('#jKept').html(htm);$('#jKept').css('display','block').css('position','fixed').css('bottom','-280px').css('z-index','999');XJ.slideDialog($('#jKept'),2);var kc=$('.kept-close');touch.on(kc,'tap',function(){XJ.closeDialog($('#jKept'),2);hide_video(_this)});var ks=$('.kept-submit');touch.on(ks,'tap',function(){$('.kept-submit').attr("disabled",true).val('包养中..').css('background','#bcbcbd');App.request({url:'/ajax/package',data:{id:jId},loading:false,success:function(ret){if(ret.err){$('.j-kept_1').attr('class','j-kept_2');$('.j-k-content').html('<p class="j-k-red">这条投稿被你承包了 ! </p><p class="j-k-red j-k-big">以后赚钱都归你 !!!</p>');$('.j-k-btn').html('<button type="reset" class="kept-close">了解</button>');setTimeout(function(){XJ.closeDialog($('#jKept'),2)},2000);tthis.after('<div class="kepted"><a href="/user/'+ret.msg.id+'">'+ret.msg.username+'</a><span>包养了Ta</span></div>');tthis.remove();hide_video(_this)}else{$('.j-k-message').html(ret.msg);$('.kept-submit').attr("disabled",false).val('包养').css('background','#ff845b');hide_video(_this)}}})})})
	var a=$(".swiper-content");var b=$('.j-content').width();$('.swiper-wrapper').width(b);a.each(function(){var c=$(this);var d=new Swiper(c.find('.gallery-top'),{spaceBetween:10,autoHeight:true});var e=new Swiper(c.find('.gallery-thumbs'),{spaceBetween:10,centeredSlides:true,slidesPerView:'auto',touchRatio:0.2,slideToClickedSlide:true});d.params.control=e;e.params.control=d})
	//头部 主菜单滚动定位
	function init(){
		eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)d[e(c)]=k[c]||e(c);k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1;};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p;}('3 a=$(\'#o\');3 b=(g/4);3 c;$(2).k(l(){c=($(2).8()/4);a.j($(2).8());f(c>b){$(\'#9\').5(\'e\').d(\'6\');$(\'7\').h(\'i\',\'0\')}n{$(\'#9\').d(\'e\').5(\'6\');$(\'7\').h(\'i\',\'-1.m\')};f(c>(g/4)){b=c}})',25,25,'||document|var|40|removeClass|slideOutUp|footer|scrollTop|header||||addClass|slideInDown|if|89|css|bottom|val|scroll|function|6rem|else|hidScrollY'.split('|'),0,{}))
  }
	var index = {
		list : function(){init();},
		/*
		登录
		*/
		login:function(){var ls=$('.l-submit');touch.on(ls,'tap',function(){var username=$('#username').val();var password=$('#password').val();var backurl=$('#backurl').val();if(username==''){XJ.tips({text:'邮箱/手机号/用户名不能为空',color:'#fff'});return false;}
if(password==''){XJ.tips({text:'密码不能为空',color:'#fff'});return false;}
App.request({url:'/account/login',data:$('#login_form').serializeObject(),success:function(ret){if(ret.err){location.href='/user/';}else{XJ.tips({text:ret.msg,color:'#fff'});}}})})},
		/*
		注册
		*/
		register:function(){var ls=$('.l-submit');touch.on(ls,'tap',function(){var username=$('#username').val(),password=$('#password').val(),password1=$('#confirm_password').val(),email=$('#email').val(),is_email=/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/,is_pass=/^[\w]{2,16}$/;if(!is_email.test(email)||email==''){XJ.tips({text:'邮箱不能为空或格式不正确！',color:'#fff'});return false;}else{App.request({url:'/account/checkemail',data:{email:email},loading:false,success:function(result){var re=result;if(re.err){is_email=true;}else{XJ.tips({text:re.msg,color:'#fff'});is_email=false;return false;};}});};if(username==''||username.length<2||username.length>20){XJ.tips({text:'用户名不能为空或长度不正确，长度2~16个字符！',color:'#fff'});return false;}else{App.request({url:'/account/checkusername',data:{username:username},loading:false,success:function(result){var re=result;if(re.err){is_email=true;}else{XJ.tips({text:re.msg,color:'#fff'});is_email=false;return false;};}});};if(password==''){XJ.tips({text:'密码不能为空',color:'#fff'});return false;}
			if(!is_pass.test($.trim(password))||!is_pass.test($.trim(password1))){XJ.tips({text:'密码错误，长度2~16个字符！',color:'#fff'});return false;}
			if(password!=password1){XJ.tips({text:'两次密码不一样',color:'#fff'});return false;}
			App.request({url: '/account/register',data:$('#register_form').serializeObject(),success:function(ret){if(ret.err){XJ.tips({text: '注册成功',color: '#fff'});setTimeout(function(){location.href = '/user'},1000);}else{XJ.tips({text:ret.msg,color:'#fff'});};}})})},
		/*
		投稿
		*/
		publishqiniu:function(url,type){var uploader=Qiniu.uploader({runtimes:'html5,flash,html4',browse_button:'fileuploader',uptoken_url:'/public/token',unique_names:true,save_key:true,domain:'http://qiniu-plupload.qiniudn.com/',get_new_uptoken:false,container:'container',max_file_size:'200mb',flash_swf_url:'/Public/js/plupload/Moxie.swf',max_retries:3,dragdrop:true,drop_element:'container',chunk_size:'200mb',auto_start:true,init:{'BeforeUpload':function(up,files){$('#fileuploader').html('上传中...<b></b>')},'FileUploaded':function(up,file,info){var data=eval("("+info+")");var image=url+data.key;$('#image').val(image+type);var imgHtml='<img src="'+image+'" alt="" val="'+image+'"  />';$('#content').append(imgHtml);$('#fileuploader').html('上传完成，还可以继续上传！')},'Error':function(up,err,errTip){$('#fileuploader').html(errTip)},UploadProgress:function(up,file){$('#fileuploader').find('b').html('<span>'+file.percent+"%</span>")}}});


			//视频封面
    	var vedio_cover=Qiniu.uploader({runtimes:'html5,flash,html4',browse_button:'vedio_cover',uptoken_url:'/public/token',unique_names:true,save_key:true,domain:'http://qiniu-plupload.qiniudn.com/',get_new_uptoken:false,container:'container2',max_file_size:'100mb',flash_swf_url:'__PUBLIC__/js/plupload/Moxie.swf',max_retries:3,dragdrop:true,drop_element:'container2',chunk_size:'200mb',auto_start:true,init:{'BeforeUpload':function(up,files){$('#vedio_cover').show().html('上传中...(<b></b>)')},'FileUploaded':function(up,file,info){var data=eval("("+info+")");var image=url+data.key;$('#image').val(image+type);$('#vedio_cover').show().html('上传完成').append('<span id="vedio_cover_url"><img src="'+image+'" width="100" /></span>');/*$('#vedio_cover_url').show().html('<img src="'+image+'" width="100" />')*/},'Error':function(up,err,errTip){$('#vedio_cover').show().html(errTip)},UploadProgress:function(up,file){$('#vedio_cover').find('b').html('<span>'+file.percent+"%</span>")}}});


			var fileuploadervedio=Qiniu.uploader({runtimes:'html5,flash,html4',browse_button:'fileuploadervedio',uptoken_url:'/public/token',unique_names:true,save_key:true,domain:'http://qiniu-plupload.qiniudn.com/',get_new_uptoken:false,container:'container3',max_file_size:'200mb',flash_swf_url:'__PUBLIC__/js/plupload/Moxie.swf',max_retries:3,dragdrop:true,drop_element:'container3',chunk_size:'200mb',multi_selection:!(mOxie.Env.OS.toLowerCase()==="ios"),auto_start:true,init:{'BeforeUpload':function(up,files){$('#fileuploadervedio').show().html('上传中...(<b></b>)')},'FileUploaded':function(up,file,info){var data=eval("("+info+")");var path=url+data.key;$('#vedio_url').val(path);$('#fileuploadervedio').show().html('上传完成')},'Error':function(up,err,errTip){$('#fileuploadervedio').show().html(errTip)},UploadProgress:function(up,file){$('#fileuploadervedio').find('b').html('<span>'+file.percent+"%</span>")}}});

			//类别
			$('#type').change(function(){var val=$(this).val();var u=navigator.userAgent;$('.message-content').html('');if(val==4){if(u.indexOf('UCBrowser')>-1||u.indexOf('iPhone')>-1){vedio_cover.init();fileuploadervedio.init()}$('.upvideo').show();$('#vedio_type').val(2);$('.vedio_link').hide();$('#is_video').val(1);$('#news').hide();$('#url').show()}else if(val==1){$('#is_video').val(0);$('#container').hide();$('#news').show();$('#url').hide()}else if(val==5){if(u.indexOf('UCBrowser')>-1||u.indexOf('iPhone')>-1){vedio_cover.init()}$('.vedio_link').show();$('.upvideo').hide();$('#is_video').val(1);$('#news').hide();$('#url').show();$('#vedio_type').val(1)}else{$('#is_video').val(0);$('#container').show();$('#news').show();$('#url').hide()}})
			//是否允许被包养
			$('.p-j-kept dt').on('click',function(){var htm,tthis,keptScore;tthis=$(this);if($('.p-j-kept dd').css('display')=='none'){$('.p-j-kept').addClass('p-j-kept-hover');$('.p-j-kept dd').css('display','block');$('.p-j-kept dd').find('a').eq(0).addClass('hover');$('#package_fee').val($('.p-j-kept dd').find('a').eq(0).attr('data-id'));$('.p-j-kept dd').find('a').on('click',function(){$('.p-j-kept dd').find('a').removeClass('hover');$(this).addClass('hover');$('#package_fee').val($(this).attr('data-id'))});$('#is_package').val(1)}else{$('.p-j-kept').removeClass('p-j-kept-hover');$('.p-j-kept dd').css('display','none');$('.p-j-kept dd').find('a').removeClass('hover');$('#is_package').val(0)}})

			var cp=$('.checkPublish');touch.on(cp,'tap',function(){var form=$('#publish_form');var data=form.serializeObject();data.content=$('#content').html();if(data.title.length<1){XJ.tips({text:'标题不能为空'});return false}if(!data.is_video){if(data.image==''&&data.content.length==0){XJ.tips({text:'图片或投稿内容不能为空'});return false}}if(parseInt(data.is_video)){if(data.vedio_type==1&&!data.url){XJ.tips({text:'视频URL不能为空！'});return}if(data.vedio_type==2&&!data.vedio_url){XJ.tips({text:'请上传视频！'});return}}else{if(!data.content){XJ.tips({text:'内容不能为空！'});return}}
			App.request({url:'/joke/publish',data:data,success:function(result){var re=result;if(re.err){XJ.tips({text:'投稿成功'});setTimeout(function(){location.href='/user/joke/type/all'},1000)}else{XJ.tips({text:re.msg})}}})
})
},

		/*
		投稿
		*/
		publish : function(){
			//类别
			$('#type').change(function(){var val=$(this).val();$('.message-content').html('');if(val==4){$('.upvideo').show();$('#vedio_type').val(2);$('.vedio_link').hide();$('#is_video').val(1);$('#news').hide();$('#url').show()}else if(val==1){$('#is_video').val(0);$('#container').hide();$('#news').show();$('#url').hide()}else if(val==5){$('.vedio_link').show();$('.upvideo').hide();$('#is_video').val(1);$('#news').hide();$('#url').show();$('#vedio_type').val(1)}else{$('#is_video').val(0);$('#container').show();$('#news').show();$('#url').hide()}})


		//上传图片
		$("#fileuploader").uploadFile({url:'/public/uploadimg/',fileName:"Filedata",dragDrop:false,doneStr:'使用',uploadStr:'插入图片',returnType:'json',showStatusAfterSuccess:false,allowedTypes:'jpg,jpeg,gif,png,bmp',acceptFiles:"image/",multiple:false,showDone:false,showError:true,showProgress:true,showAbort:false,maxFileCount:1,maxFileSize:10000*1024,onSubmit:function(files){$('#fileuploader').html('上传中...请稍候！')},onSuccess:function(files,data,xhr,pd){var image=data.url.substr(1,data.url.length);var m_image=data.m_url.substr(1,data.m_url.length);$('#image').val(m_image);var imgHtml='<img src="'+image+'" alt="" val="'+image+'"  />';$('#content').append(imgHtml);$('#fileuploader').html('上传完成，还可以继续上传！')}});

		//上传视频封面
		$("#vedio_cover").uploadFile({url:'/public/uploadimg/',fileName:"Filedata",dragDrop:false,doneStr:'使用',uploadStr:'上传封面',returnType:'json',showStatusAfterSuccess:false,allowedTypes:'jpg,jpeg,gif,png,bmp',acceptFiles:"image/",multiple:false,showDone:false,showError:false,showProgress:true,showAbort:false,onSubmit:function(files){$('#vedio_cover').show().html('上传中...')},onSuccess:function(files,data,xhr,pd){if(data.status==0){$('#vedio_cover').show().html(data.info)}else{var image=data.url.substr(1,data.url.length);var m_image=data.m_url.substr(1,data.m_url.length);$('#image').val(m_image);$('#vedio_cover').show().html('上传完成').append('<span id="vedio_cover_url"><img src="'+image+'" width="100" /></span>');/*$('#vedio_cover_url').show().html('<img src="'+image+'" width="100" />')*/}}});
		//上传视频
		var uploadObj=$("#fileuploadervedio").uploadFile({url:'/public/uploadvedio/',fileName:"Filedata",dragDrop:false,doneStr:'使用',uploadStr:'选择视频上传',returnType:'json',showStatusAfterSuccess:false,allowedTypes:'mp4,rmvb,mov,MOV',acceptFiles:"image/",multiple:false,showDone:false,showError:false,showProgress:true,showAbort:false,onSubmit:function(files){$('#fileuploadervedio').show().html('上传中...')},onSuccess:function(files,data,xhr,pd){if(data.status==0){$('#fileuploadervedio').show().html(data.info)}else{var url=data.url.substr(1,data.url.length);$('#vedio_url').val(url);$('#fileuploadervedio').show().html('上传完成')}}});


			//是否允许被包养
			var pd=$('.p-j-kept dt');touch.on(pd,'tap',function(){var htm,tthis,keptScore;tthis=$(this);if($('.p-j-kept dd').css('display')=='none'){$('.p-j-kept').addClass('p-j-kept-hover');$('.p-j-kept dd').css('display','block');$('.p-j-kept dd').find('a').eq(0).addClass('hover');$('#package_fee').val($('.p-j-kept dd').find('a').eq(0).attr('data-id'));$('.p-j-kept dd').find('a').on('touchend',function(){$('.p-j-kept dd').find('a').removeClass('hover');$(this).addClass('hover');$('#package_fee').val($(this).attr('data-id'))})}else{$('.p-j-kept').removeClass('p-j-kept-hover');$('.p-j-kept dd').css('display','none');$('.p-j-kept dd').find('a').removeClass('hover');$('#package_fee').val(0)}})

			var cp=$('.checkPublish');touch.on(cp,'tap',function(){var form=$('#publish_form');var data=form.serializeObject();data.content=$('#content').html();if(data.title.length<1){XJ.tips({text:'标题不能为空'});return false}if(!data.is_video){if(data.image==''&&data.content.length==0){XJ.tips({text:'图片或投稿内容不能为空'});return false}}if(parseInt(data.is_video)){if(data.vedio_type==1&&!data.url){XJ.tips({text:'视频URL不能为空！'});return}if(data.vedio_type==2&&!data.vedio_url){XJ.tips({text:'请上传视频！'});return}}else{if(!data.content){XJ.tips({text:'内容不能为空！'});return}}

			if(data.kept_level>0&&data.kept_level!=''){is_package=1;}
			App.request({url:'/joke/publish',data:data,success:function(result){var re=result;if(re.err){XJ.tips({text:'投稿成功'});setTimeout(function(){location.href='/user/joke/type/all';},1000);};}});})
		},

		/*
		审稿
		*/
		audit:function(){var abtn=$('.a-btn');touch.on(abtn,'tap',function(){var joke_id=$(this).attr('data-id');var type=$(this).attr('data-type');if(joke_id==''||typeof(joke_id)=='undefined'){joke_id=$(this).parent().data('id');type=$(this).parent().data('type');}
if(joke_id!=''||typeof(joke_id)=='undefined'){App.request({url:'/joke/audit',data:{joke_id:joke_id,type:type},success:function(ret){if(ret.err==1){location.reload();}}})}})},
		/*
		评论
		*/
		comment:function(){init();var js=$('.joke-c-submit');touch.on(js,'tap',function(){var id=$('#Jid').val(),content=$('#content').val(),btn=$('.joke-c-submit');if(!content){XJ.tips({text:'评论内容不能为空！'});return false};if(content.length<6){XJ.tips({text:'最小长度6个字符！'});return false};if(content.length>150){XJ.tips({text:'最大长度150个字符！'});return false};App.request({url:'/ajax/review',data:{id:id,content:content},success:function(ret){if(ret.err){$('#content').val('');btn.html('完成').css({'box-shadow':'rgb(174, 174, 175) 0px 3px 0px 0px','background':'rgb(188, 188, 189)'});XJ.tips({text:'评论成功，请耐心等待审核！'})}else{XJ.tips({text:ret.msg})}}})});var cg=$('.c-good');touch.on(cg,'tap',function(){var self=$(this);var id=$(this).data('id');App.request({url:'/xiaohua/reviewrecord',loading:false,data:{id:id},success:function(ret){if(ret.err){var v=self.text();self.text(parseInt(v)+1)}else{}}})});var count=$('#count').val(),joke_id=$('#Jid').val(),commentBox=$('#comment-box');if(count>=5){$('.page').pagination(count,{num_edge_entries:1,num_display_entries:4,callback:view,items_per_page:5,prev_text:'前一页',next_text:'后一页'})};var flag=false,html='<% for(var i in list) { %>				<dd>						<div class="c-l-user">							<a class="c-u-avatar" href="/user/<%=list[i].user_id%>"><img alt="<%=list[i].user_info.username%>" src="<%=list[i].user_info.avatar%>"></a>							<a class="c-u-name" href="/user/<%=list[i].user_id%>"><%=list[i].user_info.username%></a>							<a class="c-good" href="javascript:void(0)" data-id="<%=list[i].id%>"><%=list[i].good_num%></a>						</div>						<p class="c-l-content"><%=list[i].content%></p>					</dd>					<% } %>';function view(i,obj){if(!i&&!flag)return;flag=true;App.request({url:'/xiaohua/getreview',data:{id:joke_id,p:i+1},success:function(result){var re=result||{};if(re.err){var obj={list:re.msg};obj.start=count-((i)*5);commentBox.html(template.compile(html)(obj))}else{App.alert(re.msg)}}})}},

		/*
		兑换礼品 下单
		*/
		exchange:function(){if(document.getElementById('g_province')){_init_area();}
var es=$('.e-g-n-subtract');touch.on(es,'tap',function(){if(!isNaN($('#num').val())&&$('#num').val()>1){$('#num').val(Number($('#num').val())-1);}else{$('#num').val(1);}})
var ea=$('.e-g-n-add');touch.on(ea,'tap',function(){var gift_score=$(this).parent().attr('data-gift-score');var user_score=$(this).parent().attr('data-user-score');if(!isNaN($('#num').val())&&user_score>(Number($('#num').val())+1)*gift_score){$('#num').val(Number($('#num').val())+1);}else{XJ.tips({text:'你拥有的积分最多可兑换'+$('#num').val()+'件'});}})
$('#num').blur(function(){var gift_score=$(this).parent().attr('data-gift-score');var user_score=$(this).parent().attr('data-user-score');if(!isNaN($(this).val())){var num=parseInt($(this).val());if(num>0){if(user_score<num*gift_score){XJ.tips({text:'你拥有的积分最多可兑换'+parseInt(user_score/gift_score)+'件'});$(this).val(parseInt(user_score/gift_score));}else{$(this).val(num);}}else{$(this).val(1);}}else{XJ.tips({text:'请输入有效数字'});$(this).val(1);}})
var gs=$('.g_submit');touch.on(gs,'tap',function(){var province=$('#g_province').val(),city=$('#g_city').val(),area=$('#g_area').val(),address=$('.g_address').val(),name=$('.g_name').val(),phone_number=$('.g_phone_number').val()
isMobile=/^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/;if(province==''||city==''||area==''){XJ.tips({text:'所在地区不能为空'});return false;}
if(address==''){XJ.tips({text:'街道地址不能为空'});return false;}
if(name==''){XJ.tips({text:'收货人姓名不能为空'});return false;}
if(phone_number==''){XJ.tips({text:'收货人姓名不能为空'});return false;}
if(!isMobile.test(phone_number)){XJ.tips({text:'请输入正确的手机号'});return false;}
$('#form_gift').find(".g_submit").attr("disabled",true).val('提交中...').css('background','#bcbcbd');App.request({url:'/shop/order/',data:$('#form_gift').serialize(),success:function(ret){if(ret.err==1){$('#form_gift').find(".g_submit").val('提交成功');XJ.tips({text:'兑换信息提交成功！'});setTimeout(function(){window.location.href="/shop/";},2000);}else{XJ.tips({text:ret.msg});$('#form_gift').find(".g_submit").attr("disabled",false).val('兑换').css('background','#ff7e69');}}})})
$('.g_input_text').each(function(index,element){if($(this).val()!=''){$(this).parent().find('.g_value').hide();}});input_value_gift($('.form_gift'));function input_value_gift(t){t.find('input').focus(function(){if($(this).val()==$(this).attr('title')||$(this).val()==''){$(this).parent().find('.g_value').hide();}});t.find('input').blur(function(){if($(this).val()==$(this).attr('title')||$(this).val()==''){$(this).val('');$(this).parent().find('.g_value').show();}})}},
		/*
		意见反馈
		*/
		feedback:function(){$('.l-submit').on('click',function(){var email=$('.text-input').val(),content=$('.fankui').val(),code=$('#code').val();if(!/\w@\w*\.\w/.test(email)){XJ.tips({text:'请输入有效的邮箱地址！'});return;}
if(content==''){return false;}
if(content.length<6){XJ.tips({text:'内容最小长度6个字符！'});return false;};if(content.length>140){XJ.tips({text:'内容最大长度140个字符！'});return false;};if(code==''){XJ.tips({text:'验证码不能为空！'});return false;}
App.request({url:'/about/feedback',data:$('#fankui').serializeObject(),success:function(ret){if(ret.err){XJ.tips({text:ret.msg});setTimeout(function(){window.location.href="/";},2000);}else{XJ.tips({text:ret.msg});}}})})}
	};
	return index;
});
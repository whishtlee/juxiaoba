$(function(){
	$('.p-j-kept dt').click(function(){
		var htm , tthis , keptScore;
		
		tthis = $(this);
		if($('.p-j-kept dd').css('display') == 'none'){
			$('.p-j-kept').addClass('p-j-kept-hover');
			$('.p-j-kept dd').css('display','block');
			$('.p-j-kept dd').find('a').eq(0).addClass('hover');
			$('#kept_level').val($('.p-j-kept dd').find('a').eq(0).attr('data-id'));
			$('.p-j-kept dd').find('a').click(function(){
				$('.p-j-kept dd').find('a').removeClass('hover');
				$(this).addClass('hover');
				$('#kept_level').val($(this).attr('data-id'));
			});
		}else{
			$('.p-j-kept').removeClass('p-j-kept-hover');
			$('.p-j-kept dd').css('display','none');
			$('.p-j-kept dd').find('a').removeClass('hover');
			$('#kept_level').val(0);
		}
	})
	
})

//投稿的表单验证
MH.publishValidate = function(){

	//$('.p-j-submit input').attr("disabled",true).css('background','#f7745f');
	$('.p-j-submit').html('<img src="'+MH.staticDomain+'/m/default/img/loding.gif" />');
	var ispub = true;
	var cImg = $('#textfield').val();
	var cText = $('#p-j-text-content').val();
	var cTitle = $('.p-j-title').find('input').val();
	
	if(cImg == '' && cText == ''){
		//$('#p-message').html('投稿内容不能为空').css('display','block');
		MH.tips({text:'投稿内容不能为空'});
		$('#p-j-text-content').focus();
		ispub = false; 
	}
	if(cTitle.length>20 || cTitle.length<5){
		//$('#p-message').html('标题应为5-20个字').css('display','block');
		MH.tips({text:'标题应为5-20个字',y:($(window).height()-180)/2});
		$('.p-j-title').find('input').focus();
		ispub = false; 
	}
	
	if(ispub){
		//获取是否有敏感词
		$.ajax({
			url : publishSensitiveUrl,
			type : 'POST',
			dataType : "json",
			data : {
				'title' : cTitle,
				//'kept_level' : tthis.kept_level.value,
				'content' : cText
			},
			success : function(ret){
				if(ret.code > 0) {
					$('#publish_form').submit();
				}else{
					//$('#p-message').html(ret.message).css('display','block');
					MH.tips({text:ret.message});
					$('.p-j-submit').html('<input type="button" onclick="MH.publishValidate()" value="提交">');
					//$('.p-j-submit input').removeAttr("disabled").css('background','#ff7e69');
				}
			}
		})
	}else{
		$('.p-j-submit').html('<input type="button" onclick="MH.publishValidate()" value="提交">');
		//$('.p-j-submit input').removeAttr("disabled").css('background','#ff7e69');
	}
}
//判断获取图片大小是否超过上限
MH.handleFiles = function(obj) {
	window.URL = window.URL || window.webkitURL;
	var fileElem = document.getElementById("fileElem");
	var imgSize;
	var files = obj.files,
		img = new Image();
	if(window.URL){
		//File API
		imgSize = files[0].size;
	}else if(window.FileReader){
		//opera不支持createObjectURL/revokeObjectURL方法。我们用FileReader对象来处理
		var reader = new FileReader();
		reader.readAsDataURL(files[0]);
		reader.onload = function(e){
			imgSize = e.total;
		}
	}else{
		//ie
		obj.select();
		obj.blur();
		var nfile = document.selection.createRange().text;
		document.selection.empty();
		img.onload=function(){
			imgSize = img.fileSize;
		}
	}
	if(imgSize>5*1024*1024){
		MH.tips({text:'文件不能超过5M'});
	}else{
		$('#textfield').val($('#fileElem').val());
	}
}
//提交评审员申请
MH.auditApplyValidate = function(a){
	var len = a.qqtext.value.length;
	if(!isNaN(a.qqtext.value) &&　a.qqtext.value > 0 && len>4 && len<12){
		$.ajax({
			type : 'POST',
			url : auditPromptUrl,
			dataType : 'json',
			data : $('#applyAudit').serialize(),
			success : function(ret){
				if(ret.code > 0) {
					window.location.href=ret.data.url;
				} else if(ret.message!=''){
					MH.tips({text:ret.message});
				}
			}
		})
	}else{
		MH.tips({text:'请输入正确的QQ号'});
	}
	return false;
};


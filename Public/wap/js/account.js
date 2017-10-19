$(function(){
	//注册
	$('.gender-female').click(function(){
		$('.gender-male').find('span').removeClass('hover');
		$(this).find('span').addClass('hover');
		$('.gender').val(1);
	})
	$('.gender-male').click(function(){
		$('.gender-female').find('span').removeClass('hover');
		$(this).find('span').addClass('hover');
		$('.gender').val(2);
	})
	
})

MH.loginValidate = function(){
	$('.l-submit').attr("disabled",true).val('登录中..').css('background','#bcbcbd');
	var pswStr = $('#login_form .l-password').find('input').val();
	$('#login_form .l-password').find('input').val(MH.fiskerEncode(pswStr));
	$.ajax({
		url : loginUrl,
		type : 'POST',
		dataType : "json",
		data : $('#login_form').serialize(),
		success : function(ret){
			if(ret.code > 0) {
				if(ret.data.redirectUrl==''){
					window.location.reload();
				}else{
					window.location.href=ret.data.redirectUrl;
				}
			} else {
				MH.tips({text:ret.message});
				$('#login_form .l-password').find('input').val(pswStr);
				MH.postToken();
				//$('#l-message').html(ret.message).css('height','30px').css('background','#eb6877').css('margin-bottom','15px');
				$('.l-submit').removeAttr("disabled").val('登录').css('background','#04ce9b');
			}
		}
	})
	return false;
}

MH.registerValidate = function(){
	
	$('#register_form').find(".l-submit").attr("disabled", true).val('注册中...').css('background','#bcbcbd');
	var isRegister = true;
	var email = document.forms['register_form'].email;
	var nickName = document.forms['register_form'].nick_name;
	var psw = document.forms['register_form'].password;
	var psc = document.forms['register_form'].passconf;
	var gender = document.forms['register_form'].gender;
	
	if(nickName.value.length <2 || nickName.value.length >8){
		//nickName.focus();
		MH.tips({text:'昵称在2-8位'});
		setTimeout(function(){
			nickName.focus();
		},2000)
		isRegister = false;
	}
	if(psw.value != psc.value){
		//psc.focus();
		MH.tips({text:'两次密码输入不一致'});
		setTimeout(function(){
			psc.focus();
		},2000)
		isRegister = false;
	}
	if(psw.value.length<5){
		//psw.focus();
		MH.tips({text:'密码长度不得小于5位'});
		setTimeout(function(){
			psw.focus();
		},2000)
		isRegister = false;
	}
	if(gender.value != 1 && gender.value != 2){
		MH.tips({text:'请选择性别'});
		isRegister = false;
	}
	if(isRegister){
		var pswStr = psw.value;
		var pscStr = psc.value;
		psw.value = MH.fiskerEncode(pswStr);
		psc.value = MH.fiskerEncode(pscStr);
		$.ajax({
			type : 'POST',
			url : registerUrl,
			dataType : 'json',
			data : $('#register_form').serialize(),
			success : function(ret){
				if(ret.code > 0) {
					window.location.href = ret.data.redirectUrl;
				}else{
					psw.value = pswStr;
					psc.value = pscStr;
					MH.tips({text:ret.message});
					$('#register_form').find(".l-submit").removeAttr("disabled").val('注册').css('background','#FF7E69');
				}
			}
		})
	}else{
		$('#register_form').find(".l-submit").removeAttr("disabled").val('注册').css('background','#FF7E69');
	}
	return false;
}

/*
 *第三方登录完善信息
 */
MH.perfectUserNameValidate = function(){
	
	$('#perfect_username_form').find(".l-submit").attr("disabled", true).val('保存中...').css('background','#bcbcbd');
	var isRegister = true;
	var nickName = document.forms['perfect_username_form'].nick_name;
	var gender = document.forms['perfect_username_form'].gender;
	
	if(nickName.value.length <2 || nickName.value.length >8){
		MH.tips({text:'昵称在2-8位'});
		nickName.focus();
		isRegister = false;
	}
	if(gender.value != 1 && gender.value != 2){
		MH.tips({text:'请选择性别'});
		isRegister = false;
	}
	if(isRegister){
		$.ajax({
			type : 'POST',
			url : registerUrl,
			dataType : 'json',
			data : $('#perfect_username_form').serialize(),
			success : function(ret){
				if(ret.code > 0) {
					window.location.href = ret.data.redirectUrl;
				}else{
					MH.tips({text:ret.message});
					$('#perfect_username_form').find(".l-submit").removeAttr("disabled").val('保存').css('background','#04ce9b');
				}
			}
		})
	}else{
		$('#perfect_username_form').find(".l-submit").removeAttr("disabled").val('保存').css('background','#04ce9b');
	}
	return false;
}

/*
 *获取token
 */
MH.postToken = function(){
	$.ajax({
		url : MH.userDomain+'ajax/user/loginToken',
		dataType : 'json',
		success : function(ret){
			if(ret.code > 0) {
				$('#token').val(ret.data);
			}
		}
	})
}



















































define(function(require, exports, module) {

	var Upload = {
		uploadify:function(obj,savePath,type){
			var multi = false;
			var exts = '*.jpg;*.gif;*.png;*.jpeg';
			var desc = '图片类型(*.jpg;*.jpeg;*.gif;*.png)';
			if(type == 'video') {
				exts = '*.mp4;*.rmvb;*.mov;*.MOV;';
				desc = '视频类型(*.mp4;*.rmvb;*.MOV;*.mov;)';
			}
			if(type == 'soft') {
				exts = '*.rar;*.exe;';
				desc = '软件类型(*.rar;*.exe;)';
			}
			if(type == 'imglist') {
				multi = true;
			}
			require.async(['/Public/js/jquery.uploadify.min','/Public/js/uploadify/uploadify.css'], function() {
				$(obj).uploadify({
			      'formData'     : {
			        'savePath' : savePath
			      },
			      'buttonText': '本地上传',
		          'buttonClass': 'browser',
		          'dataType':'html',
		          'removeCompleted': false,
			      'swf'      : '/Public/js/uploadify/uploadify.swf',
			      'uploader' : '/public/uploadvedio/',
			      'multi' : multi,
			      'debug': false,
			      'height': 30,
			      'width':75,
			      'auto': true,
			      'fileTypeExts': exts,
			      'fileTypeDesc': desc,
			      'fileSizeLimit': '1024',
			      'progressData':'speed',
			      'removeCompleted':true,
			      'removeTimeout':0,
			      'requestErrors':true,
			      'onInit':function()
			      {

			      },
			      'onFallback':function()
			        {
			            alert("您的浏览器没有安装Flash");
			        },
			      'onUploadSuccess' : function (file, data, response) {
			          var result = $.parseJSON(data);
			          alert('f');
			      	}
			    });
			});
		},
		remove_img:function(obj) {
			var parent = $(obj).parent();
			var top = parent.parent();

			$(parent).remove();
			var img = $(top).find('img');
			var img_list = '';
			if(img) {
				if(img.length > 1) {
					for(var i in img) {
						img_list += $(img[i]).attr('src')+';';
					}
					img_list = img_list.substr(0,img_list.length - 1);
				}else {
					img_list = $(img).attr('src');
				}
			}
			//console.log(img_list);
			var input = top.find('input');
			$(input).val(img_list);
		}
	};

	return Upload;
});
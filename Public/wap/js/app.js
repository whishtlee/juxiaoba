
define(function(require, exports, module) {
	
	var App = {
		alert : function(str){
			alert(str);
		},
		loading: {
			ele: false,
			init: function() {
				if(!this.ele) {
					this.ele = $('<div id="loading" class="loading"><div class="loading_inner"><i class="loading_icon"></i> 请稍候...</div></div>');
					this.ele.appendTo('body');
				}
			},
			show: function() {
				this.init();
				return this.ele.show();
			},
			hide: function() {
				this.init();
				return this.ele.hide();
			}
		},
		request: function(opt) {
			if(opt['loading'] !== false) {
				App.loading.show();
			}
			var _conf = {
				error: function(xhr) {
					xhr.responseText && App.alert(xhr.responseText);
					if(opt['loading'] !== false) {
						App.loading.hide();
					}
				},
				complete: function() {},
				timeout: 10000,
				type : opt.type || 'POST',
				url : opt.url,
				data : opt.data || {},
				async : opt.async,
				dataType : opt.rtype || 'json'
			};
			_conf.beforeSend = function(xhr) {
				opt.prefn && opt.prefn();
			};
			if (opt.success) {
				_conf.success = function(result) {
					opt.success(result) || true;
					if(opt['loading'] !== false) {
						App.loading.hide();
					}
				};
			}
			$.ajax(_conf);
		},
		lazyload:function() {
			require.async(['/public/js/jquery.lazyload'], function() {
				$("img[original]").lazyload({
	                placeholder: "/public/index/images/load_img.png",
	                effect: "fadeIn"
	            });
			});
		},
		uploadify:function(obj,save_path) {
			require.async(['/public/js/jquery.uploadify.min','/public/js/uploadify/uploadify.css'], function() {
				$(obj).uploadify({
			      'formData'     : {
			        'save_path' : save_path
			      },
			      'buttonText': '上传图片',
		          'buttonClass': 'browser',
		          'dataType':'html',
		          'removeCompleted': false,
			      'swf'      : '/public/js/uploadify/uploadify.swf',
			      'uploader' : '/public/uploadify',
			      'multi' : false,
			      'debug': false,
			      'height': 30,
			      'width':75,
			      'auto': true,
			      'fileTypeExts': '*.jpg;*.gif;*.png;*.jpeg',
			      'fileTypeDesc': '图片类型(*.jpg;*.jpeg;*.gif;*.png)',
			      'fileSizeLimit': '1024',
			      'progressData':'speed',
			      'removeCompleted':true,
			      'removeTimeout':0,
			      'requestErrors':true,
			      'onInit':function() 
			      {
			      		var parent = $(obj).parent();
			            var children = parent.children();
			            if($(children[children.length - 1]).attr('src') != '') {
				            $(children[children.length - 1]).show();
				        }
			      },
			      'onFallback':function()
			        {
			            alert("您的浏览器没有安装Flash");
			        },
			      'onUploadSuccess' : function (file, data, response) {
			          var result = $.parseJSON(data);
			          if(result.err == 0) {
			             alert(result.msg);
			          }else {
			            var parent = $(obj).parent();
			            var children = parent.children();
			            $(children[children.length - 1]).attr('src',result.msg.substr(1,result.msg.length)).show();
			            $(children[children.length - 2]).val(result.msg.substr(1,result.msg.length));
			          }
			      }
			    });
			});
		},
		check_phone:function(phone) {
			var re = /^(13|14|15|17|18)[0-9]{9}/;
			 if(re.test(phone)) return true;
		     return false;
		}
	};

	// jq 
	$.fn.serializeObject = function() {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [ o[this.name] ];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
	return App;
});
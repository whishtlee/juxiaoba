define(['/public/js/ueditor/ueditor.config',
		'/public/js/ueditor/ueditor.all.min'], function(require, exports) {
	require('/public/js/ueditor/lang/zh-cn/zh-cn');

	UE.registerUI('vyicooimage', function (editor, uiName) {
		  //注册按钮执行时的command命令，使用命令默认就会带有回退操作
		  editor.registerCommand(uiName, {
		    execCommand: function () {
		    	require.async('res', function(res) {
		    		var t = $('<div data-multi="10"></div');
		    		res.selectPic(false, t, function(images) {
		    			var _html = [];
		    			for(var i in images) {
		    				_html.push("<div><img src='" + images[i].path + "' class='vyicoo_pic'></div>");
		    			}
		    			editor.execCommand('inserthtml', _html.join(''));
		    		});
		    	})
		    }
		  });
		  //创建一个button
		  var btn = new UE.ui.Button({
			index: 12,
		    name: uiName,
		    title: '选择图片',
		    cssRules: 'background-position: -725px -77px;',
		    onclick: function () {
		    	editor.execCommand(uiName);
		    }
		  });
		  //当点到编辑内容上时，按钮要做的状态反射
		  editor.addListener('selectionchange', function () {
		    var state = editor.queryCommandState(uiName);
		    if (state == - 1) {
		      btn.setDisabled(true);
		      btn.setChecked(false);
		    } else {
		      btn.setDisabled(false);
		      btn.setChecked(state);
		    }
		  });
		  return btn;
		}
		//,[3]
		/*index 指定添加到工具栏上的那个位置，默认时追加到最后,editorId 指定这个UI是那个编辑器实例上的，默认是页面上所有的编辑器都会添加这个按钮*/
	);
});
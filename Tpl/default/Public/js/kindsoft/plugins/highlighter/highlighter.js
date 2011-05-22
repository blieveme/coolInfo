KE.lang['highlighter'] = "插入高亮代码";
KE.lang['invalidHighligh'] = "请输入代码";
KE.plugin['highlighter'] = {
	click : function(id) {
		KE.util.selection(id);
		var dialog = new KE.dialog({
			id : id,
			cmd : 'highlighter',
			file : 'highlighter/highlighter.html',
			width : 550,
			height : 250,
			title : KE.lang['highlighter'],
			yesButton : KE.lang['yes'],
			noButton : KE.lang['no']
		});
		dialog.show();
	},
	check : function(id) {
		var dialogDoc = KE.util.getIframeDoc(KE.g[id].dialog);
		var highligh_code = KE.$('highligh_code', dialogDoc).value;
		
		if (highligh_code == '') {
			alert(KE.lang['invalidHighligh']);
			window.focus();
			KE.g[id].yesButton.focus();
			return false;
		}
		return true;
	},
	exec : function(id) {
		KE.util.select(id);
		var iframeDoc = KE.g[id].iframeDoc;
		var dialogDoc = KE.util.getIframeDoc(KE.g[id].dialog);
		if (!this.check(id)) return false;
		var highligh_code = KE.$('highligh_code', dialogDoc).value;
		var highligh_type = KE.$('highligh_type', dialogDoc).value;
		this.insert(id, highligh_code,highligh_type);
	},
	insert : function(id, highligh_code,highligh_type) {
		var html = '<pre class="brush: '+highligh_type+'">' + highligh_code + '</pre>';
		
		KE.util.insertHtml(id, html);
		KE.layout.hide(id);
		KE.util.focus(id);
	}
};
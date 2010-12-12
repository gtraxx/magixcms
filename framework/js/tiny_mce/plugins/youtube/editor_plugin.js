(function(){
	tinymce.PluginManager.requireLangPack('youtube');
	tinymce.create('tinymce.plugins.YouTubePlugin',{
		init:function(ed,url){ed.addCommand('mceYouTube',function(){
			ed.windowManager.open({
				file:url+'/youtube.htm',width:320+parseInt(ed.getLang('youtube.delta_width',0)),
				height:220+parseInt(ed.getLang('youtube.delta_height',0)),
				inline:1
			},
			{
				plugin_url:url,
				some_custom_arg:'custom arg'
			});
		});
		ed.addButton('youtube',{
			title:'youtube.desc',
			cmd:'mceYouTube',
			image:url+'/img/youtube.gif'
		});
		ed.onNodeChange.add(function(ed,cm,n){
			cm.setActive('youtube',n.nodeName=='IMG');
		});
		},createControl:function(n,cm){
			return null;
		},getInfo:function(){return{
			longname:'YouTube plugin',
			author:'Gerits Aurelien',
			authorurl:'http://www.magix-cms.com',
			infourl:'http://www.magix-cms.com',
			version:"1.0"};
		}});
	tinymce.PluginManager.add('youtube',tinymce.plugins.YouTubePlugin);
})();
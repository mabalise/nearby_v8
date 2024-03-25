/**
 *
 *
 * @author Josh Lobe
 * http://ultimatetinymcepro.com
 */
 
jQuery(document).ready(function($) {


	tinymce.PluginManager.add('calltoaction', function(editor, url) {
		
		
		editor.addButton('calltoaction', {
			
			image: url + '/images/youtube.png',
			tooltip: 'YouTube Video',
			onclick: open_youTube
		});
		
		function open_youTube() {
			
			editor.windowManager.open({
					
				title: 'Select YouTube Video',
				width: 900,
				height: 655,
				url: url+'/youTube.php'
			})
		}
		
	});
});
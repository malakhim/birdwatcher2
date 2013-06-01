/* previewer-description:text_fancybox */

$.loadCss(['/lib/js/fancybox/jquery.fancybox-1.3.4.css']);
$.getScript(current_path + '/' + 'lib/js/fancybox/jquery.fancybox-1.3.4.pack.js');

$.fn.cePreviewerMethods = {
	display: function(elm) {
		var inited = elm.data('inited');
		
		if (inited != true) {
			var rel = elm.attr('rel');
			var elms = $('a[rel="' + rel + '"]');
			elms.data('inited', true);
			
			elms.fancybox({
				titlePosition: 'inside',
				titleFormat: function (title, cArray, cIndex, cOpts) {
					return '<div id="tip7-title">' + (cArray.length > 1 ? ((cIndex + 1) + '/' + cArray.length) : '') + (title && title.length ? '&nbsp;&nbsp;&nbsp;<b>' + title + '</b>' : '' ) + '</div>';
				},
				onStart: function() {
					$.popupStack.add({
						name: 'fancybox',
						close: function() {
							$.fancybox.close();
						}
					});
				},
				onComplete: function() {
					$.popupStack.remove('fancybox');
					$.popupStack.add({
						name: 'fancybox',
						close: function() {
							$.fancybox.close();
						}
					});
				},
				onClosed: function() {
					$.popupStack.remove('fancybox');
				}
			});
			
			elm.click();
		}
	}
}
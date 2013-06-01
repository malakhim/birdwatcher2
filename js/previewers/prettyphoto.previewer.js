/* previewer-description:text_prettyphoto */

$.loadCss(['/lib/js/prettyphoto/css/prettyPhoto.css']);
$.getScript(current_path + '/' + 'lib/js/prettyphoto/js/jquery.prettyPhoto.js');

$.fn.cePreviewerMethods = {
	display: function(elm) {
		
		var inited = elm.data('inited');
		
		if (inited != true) {
			var rel = elm.attr('rel');
			var elms = $('a[rel="' + rel + '"]');
			elms.data('inited', true);
			
			elms.prettyPhoto({
				keyboard_shortcuts: false,
				gallery_markup: '',
				callback: function() {
					$.popupStack.remove('prettyPhoto');
				}
			});

			elms.each(function() {
				$(this).click(function() {
					$.popupStack.remove('prettyPhoto');
					$.popupStack.add({
						name: 'prettyPhoto',
						close: function() {
							$.prettyPhoto.close();
						}
					});
				});
			});

			elm.click();

			$(document).keydown(function(e){
				switch(e.keyCode) {
					case 37:
						$.prettyPhoto.changePage('previous');
						break;
					case 39:
						$.prettyPhoto.changePage('next');
						break;
				};
			});

		}
	}
}
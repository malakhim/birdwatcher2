/* previewer-description:text_light_box */

$.loadCss(['/lib/js/lightbox/css/jquery.lightbox-0.5.css']);
$.getScript(current_path + '/' + 'lib/js/lightbox/js/jquery.lightbox-0.5.min.js');

$.fn.cePreviewerMethods = {
	display: function(elm) {
		
		var inited = elm.data('inited');
		
		if (inited != true) {
			var rel = elm.attr('rel');
			var elms = $('a[rel="' + rel + '"]');
			elms.data('inited', true);
			
			elms.lightBox({
				imageLoading: current_path + '/lib/js/lightbox/images/lightbox-ico-loading.gif',
				imageBtnPrev: current_path + '/lib/js/lightbox/images/lightbox-btn-prev.gif',
				imageBtnNext: current_path + '/lib/js/lightbox/images/lightbox-btn-next.gif',
				imageBtnClose: current_path + '/lib/js/lightbox/images/lightbox-btn-close.gif',
				imageBlank: current_path + '/lib/js/lightbox/images/lightbox-blank.gif',
				keyToClose: String.fromCharCode(27).toLowerCase() // workaround to fix bug with esc key in lightbox
			});
			
			elm.click();
		}
	}
}
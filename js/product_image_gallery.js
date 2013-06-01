(function($) {
	$.ceProductImageGallery = function(pth) {
		if (pth.parents('.jcarousel-skin:first').length) {
			return;
		}

		var VISIBLE_THUMBNAILS = 3;
		var th_len = $('li', pth).length;

		if (th_len > VISIBLE_THUMBNAILS)	{
			if (!$().jcarousel) {
				$.getScript(current_path + '/lib/js/jcarousel/jquery.jcarousel.js', function(){
					$.ceProductImageGallery(pth);
				});
				return false;
			}


			(function($){
				$.fn.load_carousel = function() {
					var i_width = $(this).parents('.cm-thumbnails-mini:first').outerWidth(true);
					var c_width = i_width * VISIBLE_THUMBNAILS;
					var i_height = $('.cm-thumbnails-mini:first', pth).outerHeight(true);

					pth.jcarousel({
						scroll: 1,
						wrap: 'circular',
						animation: 'fast',
						initCallback: $.ceScrollerMethods.init_callback,
						// Obsolete code for new jCaroucel
						/*itemVisibleOutCallback: {
						onAfterAnimation: $.ceScrollerMethods.next_callback, 
						onBeforeAnimation: $.ceScrollerMethods.prev_callback
						},*/
						itemFallbackDimension: i_width,
						item_width: i_width,
						item_height: i_height,
						clip_width: c_width,
						clip_height: i_height,
						buttonNextHTML: '<div></div>',
						buttonPrevHTML: '<div></div>',
						buttonNextEvent: 'click',
						buttonPrevEvent: 'click',
						size: th_len
					});
	
					pth.parents('.jcarousel-skin:first').css({
						'width': c_width + $('.jcarousel-prev-horizontal').outerWidth() * 2 + 'px'
					});
					
					$.ceDialog('reload_parent', {'jelm': pth});
				},
				$.fn.check_load_carousel = function() {
					var imgs = $('img', pth);
					var elm;

					for (k = 0; k < imgs.length; k++) {
						elm = $(imgs[k]);
						if (elm.parents('.cm-thumbnails-mini:first').outerWidth() == 0) {
							elm.load(function() {
								$(this).check_load_carousel();
							});
							return false;
						}
					}
	
					$(this).load_carousel();
					return true;
				}
			})(jQuery);

			$('img:first', pth).check_load_carousel();
		}
	
		pth.click(function(e) {
			var jelm = $(e.target);
			var pjelm;
			
			// Check elm clicking
			var in_elm = jelm.parents('li') || jelm.parents('div.cm-thumbnails-mini') ? true : false;
			
			if (in_elm && !jelm.is('img') && !jelm.is('embed') && !jelm.parents('.swf-thumb').length) { // Check if the object is image or SWF embed object or parent is SWF-container
				return false;
			}
			if (jelm.hasClass('cm-thumbnails-mini') || (pjelm = jelm.parents('a:first.cm-thumbnails-mini'))) {
				jelm = (pjelm && pjelm.length) ? pjelm : jelm;
	
				var jc_box = $(this).parents('.jcarousel-skin:first');
				var image_box = (jc_box.length) ? jc_box.parents(':first') : $(this).parents(':first');

				$('.cm-image-previewer', image_box).each(function() {
					if ($(this).hasClass('cm-thumbnails-mini')) {
						return;
					}
					var id = $(this).attr('id');
					var c_id = jelm.attr('id').str_replace('_mini', '');
					
					if (id == c_id || id == c_id.replace('det_img_link_', '')) {
						
						$('.cm-thumbnails-mini', pth).removeClass('cm-cur-item');
						jelm.addClass('cm-cur-item');
						$(this).show();
						$('div', $(this)).show(); // Special for Flash containers
						$('#box_' + id).show();
					} else {
						
						$(this).hide();
						$('div', $(this)).hide(); // Special for Flash containers
						$('#box_' + id).hide();
					}
				});
			}
		});
	
		pth.show();
	}
})(jQuery)
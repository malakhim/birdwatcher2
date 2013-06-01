/* editior-description:text_ckeditor */

$.extend({
	ceEditorMethods: {
		runEditor: function(elm) {
			CKEDITOR_BASEPATH = current_path + '/lib/js/ckeditor/';
			
			if (typeof(window.CKEDITOR) == 'undefined') {
				$.ceEditor('state', 'loading');
				return $.getScript(current_path + '/lib/js/ckeditor/ckeditor.js', function() {
					$.ceEditor('state', 'loaded');
					elm.ceEditor('run');
				});
			}
				
			CKEDITOR.replace(elm.attr('id'), {
				toolbar: 'Custom',
				toolbar_Custom: [['Format','Font','FontSize', 'Bold','Italic','Underline','TextColor','BGColor','-','Link','Image','-','NumberedList','BulletedList','Indent','Outdent','JustifyLeft','JustifyCenter','JustifyRight','-','Source']],
				bodyClass: 'wysiwyg-content',
				contentsCss: [customer_skin_path + '/customer/styles.css', current_path + '/skins/' + skin_name + '/admin/wysiwyg_reset.css'],
				filebrowserBrowseUrl : current_path + '/lib/js/elfinder/elfinder.ckeditor.html',
				filebrowserWindowWidth : '600',
				filebrowserWindowHeight : '500'
			});

		},

		destroyEditor: function(elm) {
			if (typeof(CKEDITOR.instances[elm.attr('id')]) != 'undefined') {
				CKEDITOR.instances[elm.attr('id')].destroy();
			}
		},

		recoverEditor: function(elm) {
			$.ceEditorMethods.runEditor(elm);
		},

		updateTextFields: function(elm) {
			if (typeof(window.CKEDITOR) != 'undefined') {
				if (typeof(CKEDITOR.instances[elm.attr('id')]) != 'undefined') {
					CKEDITOR.instances[elm.attr('id')].updateElement();
				}
			}
		}
	}
});

// FIXME: when jQuery UI will be updated from 1.8.11 version, remove the code below.

/***
* Pacth for dialog-fix ckeditor problem [ by ticket #4727 ]
* http://dev.jqueryui.com/ticket/4727
*/

$.extend($.ui.dialog.overlay, { create: function(dialog) {
	if (this.instances.length === 0) {
		// prevent use of anchors and inputs
		// we use a setTimeout in case the overlay is created from an
		// event that we're going to be cancelling (see #2804)
		
		setTimeout(function() {
			// handle $(el).dialog().dialog('close') (see #4065)
			if ($.ui.dialog.overlay.instances.length) {
				$(document).bind($.ui.dialog.overlay.events, function(event) {
					var parentDialog = $(event.target).parents('.ui-dialog');
					
					if (parentDialog.length > 0) {
						var parentDialogZIndex = parentDialog.css('zIndex') || 0;
						return (parentDialogZIndex > $.ui.dialog.overlay.maxZ);
					}
					
					var aboveOverlay = false;
					$(event.target).parents().each(function() {
						var currentZ = $(this).css('zIndex') || 0;
						if (currentZ > $.ui.dialog.overlay.maxZ) {
							aboveOverlay = true;
							return;
						}
					});
					
					return aboveOverlay;
				});
			}
		}, 1);
		
		// allow closing by pressing the escape key
		$(document).bind('keydown.dialog-overlay', function(event) {
			(dialog.options.closeOnEscape && event.keyCode && event.keyCode == $.ui.keyCode.ESCAPE && dialog.close(event));
		});
		
		// handle window resize
		$(window).bind('resize.dialog-overlay', $.ui.dialog.overlay.resize);
	}
	
	var $el = $('<div></div>').appendTo(document.body).addClass('ui-widget-overlay').css({
		width: this.width(),
		height: this.height()
	});
	
	(dialog.options.stackfix && $.fn.stackfix && $el.stackfix());
	this.instances.push($el);
	
	return $el;
}});
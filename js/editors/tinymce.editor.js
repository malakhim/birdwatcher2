/* editior-description:text_tinymce */

$.extend({
	ceEditorMethods: {
		runEditor: function(elm) {
			if (typeof($.fn.tinymce) == 'undefined') {
				$.ceEditor('state', 'loading');
				return $.getScript(current_path + '/lib/js/tinymce/jquery.tinymce.js', function() {
					$.ceEditor('state', 'loaded');
					elm.ceEditor('run');
				});
			}
			
			// You have to change this array if you want to add a new lang pack.
			var support_langs = ['ar', 'az', 'be', 'bg', 'bn', 'br', 'bs', 'ca', 'ch', 'cs', 'cy', 'da', 'de', 'dv', 'el', 'en', 'es', 'et', 'eu', 'fa', 'fi', 'fr', 'gl', 'gu', 'he', 'hi', 'hr', 'hu', 'hy', 'ia', 'id', 'ii', 'is', 'it', 'ja', 'ka', 'kl', 'ko', 'lb', 'lt', 'lv', 'mk', 'ml', 'mn', 'ms', 'nb', 'nl', 'nn', 'no', 'pl', 'ps', 'pt', 'ro', 'ru', 'sc', 'se', 'si', 'sk', 'sl', 'sq', 'sr', 'sv', 'ta', 'te', 'th', 'tr', 'tt', 'tw', 'uk', 'ur', 'vi', 'zh', 'zu'];
			
			var lang = fn_get_listed_lang(support_langs);
			
			elm.tinymce({
				script_url : current_path + '/lib/js/tinymce/tiny_mce.js',

				plugins : 'safari,style,advimage,advlink,xhtmlxtras,inlinepopups',
				theme_advanced_buttons1: 'formatselect,fontselect,fontsizeselect,bold,italic,underline,forecolor,backcolor,|,link,image,|,numlist,bullist,indent,outdent,justifyleft,justifycenter,justifyright,|,code',
				theme_advanced_buttons2: '',
				theme_advanced_buttons3: '',
				theme_advanced_toolbar_location : 'top',
				theme_advanced_toolbar_align : 'left',
				theme_advanced_statusbar_location : 'bottom',
				theme_advanced_resizing : true,
				theme_advanced_resize_horizontal : false,
				theme : 'advanced',
				language: lang,
				strict_loading_mode: true,
				convert_urls: false,
				remove_script_host: false,
				body_class: 'wysiwyg-content',
				content_css: customer_skin_path + '/customer/styles.css,' + current_path + '/skins/' + skin_name + '/admin/wysiwyg_reset.css',

				file_browser_callback : function(field_name, url, type, win) {
					tinyMCE.activeEditor.windowManager.open({
						file : current_path + '/lib/js/elfinder/elfinder.tinymce.html',
						width : 600,
						height : 450,
						resizable : 'yes',
						inline : 'yes',
						close_previous : 'no',
						popup_css : false // Disable TinyMCE's default popup CSS
					}, {
						'window': win,
						'input': field_name,
						'current_location': current_location + '/',
						'connector_url': fn_url('elf_connector.images?ajax_custom=1')
					});	
				}
			});
		},

		destroyEditor: function(elm) {
			if (!$.browser.msie) {
				tinyMCE.execCommand('mceRemoveControl', false, elm.attr('id'));
			}
		},

		recoverEditor: function(elm) {
			tinyMCE.execCommand('mceAddControl', false, elm.attr('id'));
		},

		updateTextFields: function(elm) {
			return true;
		}
	}
});
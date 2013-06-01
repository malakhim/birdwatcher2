/* disabled:Y */
/* editior-description:text_elrte */

$.extend({
	ceEditorMethods: {
		runEditor: function(elm) {
			if (typeof(elRTE) == 'undefined') {
				$.ceEditor('state', 'loading');
				$.loadCss(['/lib/js/elrte/css/elrte.full.css', '/lib/js/elfinder/css/elfinder.css']);

				var lang_code = cart_language.toLowerCase();
				$.when($.getScript(current_path + '/lib/js/elrte/js/elrte.min.js'), $.getScript(current_path + '/lib/js/elfinder/js/elfinder.min.js')).then(function() {
					if (lang_code != 'en') {
						$.getScript(current_path + '/lib/js/elrte/js/i18n/elrte.' + lang_code + '.js', function() {
							$.ceEditor('state', 'loaded');
							elm.ceEditor('run');
						});
					} else {
						$.ceEditor('state', 'loaded');
						elm.ceEditor('run');
					}
				});

				return true;
			}

			elRTE.prototype.options.panels.tyPanel1 = ['formatblock', 'fontname', 'fontsize', 'bold', 'italic', 'underline', 'forecolor', 'hilitecolor'];
			elRTE.prototype.options.panels.tyPanel2 = ['link', 'image'];
			elRTE.prototype.options.panels.tyPanel3 = ['insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'justifyleft', 'justifycenter', 'justifyright'];
			elRTE.prototype.options.toolbars.tyToolbar = ['tyPanel1', 'tyPanel2', 'tyPanel3'];

			var opts = {
				lang: 'ru',
				styleWithCSS: false,
				toolbar: 'tyToolbar',
				absoluteURLs: false,
				height: 200,
				fmAllow: true,
				fmOpen : function(callback) {
					$('<div id="myelfinder" />').elfinder({
						url : fn_url('elf_connector.images?ajax_custom=1'),
						lang : 'en',
						dialog: {width: 900, modal: true, title: lang.file_browser, closeOnEscape: true},
						closeOnEditorCallback : true,
						cutURL: current_location + '/',
						editorCallback : callback
					})
				},
				cssfiles: [current_path + '/skins/' + skin_name_customer + '/customer/styles.css', current_path + '/skins/' + skin_name + '/admin/wysiwyg_reset.css']
			};

			// create editor
			elm.elrte(opts);
			
			// Add wysiwyg class to iframe body (should be done via editor instance, but is not supported yet)
			$('iframe', elm.parent()).contents().find('body').addClass('wysiwyg-content');
		},

		destroyEditor: function(elm) {
			var content = $('iframe', elm.parent()).contents().find('body.wysiwyg-content').first().html();
			elm.parents('.el-rte').first().replaceWith(elm.clone(false).val(content));
		},

		recoverEditor: function(elm) {
			$.ceEditorMethods.runEditor(elm);
		},

		updateTextFields: function(elm) {
			return true;
		}
	}
});
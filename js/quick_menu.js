(function($) {
	var url_prefix = 'http://';
	var methods = {
		dispatch_quick_menu_event: function(e) {
			var jelm = $(e.target);

			if (e.type == 'click' && $.browser.mozilla && e.which != 1) {
				return true;
			}

			if (e.type == 'click') {
				if (jelm.hasClass('cm-delete-section') && jelm.parents('#quick_menu').length) {
					var root = jelm.parents('tr:first');

					$.ajaxRequest(fn_url('tools.remove_quick_menu_item'), {data: {id: root.attr('item'), parent_id: root.attr('parent_id')}, result_ids: 'quick_menu', callback: fn_quick_menu_content_switch_callback});

				} else if (jelm.hasClass('cm-add-link') && jelm.parents('#quick_menu').length) {
					methods.show_quick_box('', jelm.parents('tr:first').attr('item'), '', url_prefix, '');
					return false;

				} else if (jelm.hasClass('cm-add-section') && jelm.parents('#quick_menu').length) {
					methods.show_quick_box('', 0, '', '', '');
					return false;

				} else if (jelm.hasClass('cm-update-item') && jelm.parents('#quick_menu').length) {
					var root = jelm.parents('tr:first');
					var name_holder = $('.cm-qm-name:first', root);

					methods.show_quick_box(root.attr('item'), Number(root.attr('parent_id')), name_holder.text(), (name_holder.attr('href') ? name_holder.attr('href') : ''), root.attr('pos'));
					return false;

				} else if (jelm.attr('id') == 'qm_current_link') {
					$('#qm_item_link').val(location.href);
					return false;

				} else if (jelm.hasClass('cm-lang-link') && jelm.parents('.cm-select-list').length) {
					methods.change_language(jelm.attr('name'));
					$.ajaxRequest(jelm.attr('href'), {data: {id: $('#qm_item_id').val()}, caching: false, callback: methods.change_quick_box});

					jelm.parents('.cm-popup-box:first').hide();
					return false;
				}
			}
		},

		change_language: function(lang_code) {
			var sl = $('#quick_menu_language_selector');
			if (sl.children().length) {
				var jelm = $('a[name=' + lang_code +']', sl);
				var icon = jelm.css('background-image');
				icon = icon.str_replace('url(', '');
				icon = icon.str_replace(')', '');
				icon = $.ltrim(icon, '"');
				icon = $.rtrim(icon, '"');

				$('img.icons', sl).attr('src', icon); // set new image
				$('a.cm-combination', sl).text(jelm.text()); // set new text
				$('#qm_descr_sl').val(lang_code); // change descriptions language
			}
		},

		change_quick_box: function(data) {
			$('#qm_item_name').val(data.description);
		},

		show_quick_box: function(id, parent_id, name, url, pos) {
			var quick_box = $('#quick_box');
			var title = '';

			$('#qm_item_id').val(id);
			$('#qm_item_parent').val(parent_id);
			$('#qm_item_name').val(name);
			$('#qm_item_link').val(url);
			$('#qm_item_position').val(pos);

			methods.change_language(cart_language);

			var sl = $('#quick_menu_language_selector');
			if (sl.children().length) {
				$('ul.cm-select-list a', sl).addClass('cm-lang-link');
			}

			var link_holder = $('#qm_item_link').parents('.form-field:first');

			if (parent_id) {
				link_holder.show();
				$('label', link_holder).addClass('cm-required');
				$('#qm_current_link').parents('.form-field:first').show();
				title = lang.editing_quick_menu_link;
			} else {
				link_holder.hide();
				$('label', link_holder).removeClass('cm-required');
				$('#qm_current_link').parents('.form-field:first').hide();
				title = lang.editing_quick_menu_section;
			}

			quick_box.ceDialog('open', {
				title: title,
				height: 'auto',
				width: 'auto'
			});
		}
	}

	$(document).bind('click', function(e) {
		return methods.dispatch_quick_menu_event(e);
	});

	$.ajaxRequest(fn_url('tools.show_quick_menu.edit'), {data: {popup: true}, result_ids: 'quick_menu', callback: fn_quick_menu_content_switch_callback});


})(jQuery)

function fn_callback_quick_menu_form(data) 
{
	$('#quick_box').hide();
	fn_quick_menu_content_switch_callback();
}
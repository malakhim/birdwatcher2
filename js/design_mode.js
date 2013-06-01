window['_translate_lang_code'] = '';


function fn_show_translate_box()
{
	window['_translate_obj'].edited = true;
	var trans_box = $('#translate_box');
	$('#translate_link').hide();

	var sl = $('#translate_box_language_selector');
	if (sl.children().length) {
		$('ul.cm-select-list a', sl).addClass('cm-lang-link');
	}

	if (!window['_translate_lang_code']) {
		window['_translate_lang_code'] = cart_language;
	}

	fn_tb_change_language(window['_translate_lang_code']);
	fn_switch_langvar(window['_translate_lang_code']);

	trans_box.ceDialog('open', {
		title: $('ul a.cm-lang-link', sl).html(),
		height: 'auto',
		width: 'auto'
	});	
}

function fn_change_phrase()
{
	if (cart_language == window['_translate_lang_code']) {
		fn_set_phrase($('#trans_val').val());
	}
}

function fn_set_phrase(new_phrase)
{
	$('.lang_' + window['_translate_obj'].var_name).each(function(){
		var jelm = $(this);
		if (jelm.is('font.cm-translate') || jelm.is('option')) {
			jelm.html(new_phrase);
		} else if (jelm.is(':checkbox')) {
			jelm.attr('title', new_phrase);
		} else if (jelm.is(':image') || jelm.is('img')) {
			jelm.attr('title', new_phrase);
			jelm.attr('alt', new_phrase);
		} else {
			jelm.val(new_phrase);
		}
	});
}

function fn_save_phrase()
{
	$.ajaxRequest(fn_url('design_mode.update_langvar'), {method: 'post', data: {langvar_name: window['_translate_obj'].var_name, langvar_value: $('#trans_val').val(), lang_code: window['_translate_lang_code']}});
	window['_translate_obj'] = null;
	$('#translate_box').dialog('close');
}


function fn_tb_change_language(lang_code) {
	var sl = $('#translate_box_language_selector');
	var old_lang_code = window['_translate_lang_code'].toLowerCase();
	if (sl.children().length) {
		var jelm = $('a[name=' + lang_code +']', sl);
		$('i.flag-' + old_lang_code, sl).first().removeClass('flag-' + old_lang_code).addClass('flag-' + lang_code.toLowerCase());
		
		$('a.cm-combination', sl).text(jelm.text()); // set new text
	}

	window['_translate_lang_code'] = lang_code;
}


function fn_switch_langvar(cur_lang)
{
	if ((cart_language == cur_lang) && !$(window['_translate_obj'].target_obj).hasClass('cm-pre-ajax') && !$('option[value="' + window['_translate_obj'].target_obj.val() + '"]', window['_translate_obj'].target_obj).hasClass('cm-pre-ajax')) {
		$('#trans_val').val(window['_translate_obj'].phrase);
		$('#orig_phrase').text(window['_translate_obj'].phrase);

	} else {
		$('#trans_val').val('');
		$('#orig_phrase').html('&nbsp;');
		fn_set_phrase(window['_translate_obj'].phrase);
		$.ajaxRequest(fn_url('design_mode.get_langvar'), {data:{langvar_name: window['_translate_obj'].var_name, lang_code: cur_lang}, callback: fn_swith_langvar_callback});
	}
}

function fn_swith_langvar_callback(data)
{
	var phrase = data.langvar_value.indexOf('[lang') == 0 ? data.langvar_value.substring(data.langvar_value.indexOf(']') + 1, data.langvar_value.lastIndexOf('[')) : data.langvar_value;
	$('#trans_val').val(phrase);
	$('#orig_phrase').text(phrase);
}

function fn_get_offset(elem, skip_relative)
{
	var w = elem.offsetWidth;
	var h = elem.offsetHeight;

	var l = 0;
	var t = 0;

	while (elem) {
		if (skip_relative && $(elem).css('position') == 'relative') {
			break;
		}
		l += elem.offsetLeft;
		t += elem.offsetTop;
		elem = elem.offsetParent;
	}

	return {"left": l, "top": t, "width": w, "height": h};
};

function fn_set_overlay(template)
{
	template.each(function(){
		$(this).css('display', 'block');
		var template_offset = fn_get_offset(this);
		$(this).css('display', '');

		var w = template_offset.width;
		var h = template_offset.height;
		var x = template_offset.left;
		var y = template_offset.top;
		$(this).contents().add($(this)).each(function(){
			if (this.nodeName.indexOf('#') == -1) {
				var dimens = fn_get_offset(this);
				if (dimens.width > w) {
					w = dimens.width;
				}
				if (dimens.height > h) {
					h = dimens.height;
				}
				if (dimens.left != 0 && dimens.left < x) {
					x = dimens.left;
				}
				if (dimens.top != 0 && dimens.top < y) {
					y = dimens.top;
				}
			}
		});
		
		var template_over = $('<div class="cm-template-over"></div>').appendTo(document.body);
		template_over.css({'opacity': 0.5, 'left': x, 'top': y, 'height': h + 'px', 'width': w + 'px'});
		template_over.fadeIn('fast');
	});
}

$.extend({
	dispatch_design_mode_event: function(e)
	{
		var jelm = $(e.target);

		if (e.type == 'click' && $.browser.mozilla && e.which != 1) {
			return true;
		}

		if (e.type == 'mouseover') {
			if ((jelm.hasClass('cm-translate') || jelm.parents('.cm-translate').length) && !jelm.parents('#translate_link').length && !$('#translate_box:visible').length) {
				var over_elm = jelm.hasClass('cm-translate') ? jelm : jelm.parents('.cm-translate').eq(0);
				var classes = over_elm.is('select') ? $('option[value="' + over_elm.val() + '"]', over_elm).attr('class').split(' ')[0] : over_elm.attr('class').split(' ')[1];
				var jelm_offset = over_elm.offset();
				var phrase = '';

				if (over_elm.is('font.cm-translate')) {
					phrase = over_elm.html();
				} else if (over_elm.is('select')) {
					phrase = $('option[value="' + over_elm.val() + '"]', over_elm).html();
				} else if (!over_elm.is(':checkbox') && !over_elm.is(':image') && !over_elm.is('img')) {
					phrase = over_elm.val();
				} else {
					phrase = over_elm.attr('title');
				}

				window['_translate_obj'] = {'var_name': classes.substr(5, classes.length), 'phrase': phrase, 'target_obj': over_elm, 'edited': false};
				$('#translate_link').show();
				$('#translate_link').css({'top': (jelm_offset.top - 10) + 'px', 'left': (jelm_offset.left - 6) + 'px'});
			} else if (jelm.parents('#template_list_menu').length && jelm.parent('ul').length) {
				clearTimeout(window['template_timer_id']);
				var main_template = $('#' + $('#template_list_menu ul').attr('owner'));
				var dest_template = main_template.attr('template') == jelm.text() ? main_template : $('span[template="' + jelm.text() + '"]', main_template);
				fn_set_overlay(dest_template);
			} else if (jelm.hasClass('cm-template-icon')) {
				var template = $('#' + jelm.attr('owner'));
				fn_set_overlay(template);

				var w = $.get_window_sizes();
				var dest = $('#template_list_menu ul').eq(0);
				dest.attr('owner', jelm.attr('owner'));
				dest.empty();
				dest.append('<li>' + template.attr('template') + '</li>');
				var inners = [template.attr('template')];
				fn_build_branch(template, dest, inners, 0, 10, true);
				var icon_offset = fn_get_offset(jelm.get(0));
				var l = icon_offset.left + icon_offset.width + $('#template_list_menu').width() + 12 > w.offset_x + w.view_width ? icon_offset.left - $('#template_list_menu').width() - 12 : icon_offset.left + icon_offset.width;
				var t = icon_offset.top + $('#template_list_menu').height() + 12 > w.offset_y + w.view_height ? icon_offset.top - $('#template_list_menu').height() - 12 : icon_offset.top;
				$('#template_list_menu').css({'left': l, 'top': t});
				clearTimeout(window['template_timer_id']);
				$('#template_list_menu').hide();
				window['template_timer_id'] = setTimeout("$('#template_list_menu').fadeIn('fast');", 300);

			} else if (jelm.attr('id') == 'template_list_menu' || jelm.parents('#template_list_menu').length) {
				clearTimeout(window['template_timer_id']);
			}
			return true;

		} else if (e.type == 'click') {
			if (((jelm.hasClass('cm-popup-switch') || jelm.parents('.cm-popup-switch').length) && jelm.parents('#translate_box').length || !jelm.parents('#translate_box').length) && window['_translate_obj'] && window['_translate_obj'].edited && !$('#translate_box:visible').length) {
				fn_set_phrase(window['_translate_obj'].phrase);
				window['_translate_obj'].edited = false;
			} else if (!jelm.hasClass('cm-cur-template') && jelm.parent('#template_list').length) {
				if ($('#template_text').hasClass('cm-item-modified')) {
					if (!confirm(lang.text_page_changed)) {
						return false;
					}
				}
				$.ajaxRequest(fn_url('design_mode.get_content'), {data: {file: jelm.text()}, callback: fn_set_editor_value});
				$('#template_list li').removeClass('cm-cur-template');
				jelm.addClass('cm-cur-template');
			} else if (jelm.parents('#template_list_menu').length && jelm.parent('ul').length) {
				var main_template = $('#' + $('#template_list_menu ul').attr('owner'));
				var dest_template = main_template.attr('template') == jelm.text() ? main_template : $('span[template="' + jelm.text() + '"]', main_template).eq(0);
				fn_build_tree(dest_template, $('#template_list'));
				$('#template_list_menu').fadeOut('fast');
				$.ajaxRequest(fn_url('design_mode.get_content'), {data: {file: jelm.text()}, callback: fn_show_template_editor});
				return false;
			} else if (jelm.hasClass('cm-popup-switch')) {
				if ($('#template_text').hasClass('cm-item-modified')) {
					if (confirm(lang.text_template_changed)) {
						fn_save_template();
					}
				}
			} else if (jelm.hasClass('cm-lang-link') && jelm.parents('.cm-select-list').length) {
					fn_tb_change_language(jelm.attr('name'));
					$.ajaxRequest(jelm.attr('href'), {data: {langvar_name: window['_translate_obj'].var_name}, caching: false, callback: fn_swith_langvar_callback});
					jelm.parents('.cm-popup-box:first').hide();
					return false;
			}

		} else if (e.type == 'mouseout') {
			if ($('.cm-template-icon').length && jelm.hasClass('cm-template-icon') || jelm.attr('id') == 'template_list_menu' || jelm.parents('#template_list_menu').length && jelm.parent('ul').length) {
				$('.cm-template-over').fadeOut('fast', function() {
					$(this).remove();
				});
				clearTimeout(window['template_timer_id']);
				window['template_timer_id'] = setTimeout("$('#template_list_menu').fadeOut('fast');", 300);
			}
		}
	}
});

function fn_build_tree(box, dest_obj)
{
	var dest = $(dest_obj);
	dest.empty();
	var pad = 10;
	var level = box.parents('.cm-template-box').length - 1;
	box.parents('.cm-template-box').each(function(i){
		dest.prepend('<li' + (i == level ? ' class="first"' : '') + ' style="margin-left: ' + ((level - i) * pad) + 'px">' + $(this).attr('template') + '</li>');
	});
	level++;
	dest.append('<li style="margin-left: ' + (level * pad) + 'px" class="cm-cur-template">' + box.attr('template') + '</li>');
	var inners = [box.attr('template')];
	fn_build_branch(box, dest, inners, level, pad, true);
}

function fn_build_branch(obj, dest, exist_array, level, margin, increase)
{
	if (increase) {
		level++;
	}
	obj.children().each(function(){
		if ($(this).hasClass('cm-template-box')) {
			var tm_name = $(this).attr('template');
			if ($.inArray(tm_name, exist_array) == -1) {
				exist_array.push(tm_name);
				$('li:contains("' + $(this).parents('.cm-template-box').eq(0).attr('template') + '")', dest).after('<li style="margin-left: ' + (level * margin) + 'px">' + tm_name + '</li>');
			}
			fn_build_branch($(this), dest, exist_array, level, margin, true);
		} else {
			fn_build_branch($(this), dest, exist_array, level, margin, false);
		}
	});
}

function fn_show_template_editor(data, params)
{
	fn_adjust_template_editor(350);
	$('#template_editor').data('callback', fn_adjust_template_editor);
	if ($('#template_editor .cm-img-preview').length) {
		$('#template_editor .cm-img-preview').remove();
		$('#template_editor .cm-popup-content-footer').children().show();
	}

	$('#template_editor_content').ceDialog('open', {'height': 'auto'});

	$('.template-editor-highlight').removeClass('cm-passed');
	if (data.img) {
		$('#template_editor .cm-popup-content-footer').children().hide();
		$('#template_editor .cm-popup-content-footer').append('<div class="cm-img-preview"><img src="' + data.img + '" /></div>');
	} else {
		data.filename = params.data.file ? params.data.file : '';
		if (params.show_editor) {
			fn_set_editor_value(data);
		} else {
			$('#template_text').val(data.content);
			$('#template_text').change(function() {
				fn_change_callback('template_text');
			});
			$.toggleStatusBox('hide');
		}
	}
}

function fn_hide_template_editor()
{
	var id = 'template_text';
	if (editAreas[id]) {
		editAreaLoader.delete_instance(id);
	}
}

function fn_adjust_template_editor(h)
{
	$('#template_editor').css('display', 'block');
	var new_height = $('#template_editor_content').height();
	var diff = $('#template_list').parents('td:first').outerHeight() - $('#template_list').parents('td:first').height();
	if (h) {
		new_height = h;
		if ($('#template_list').height() + diff > new_height) {
			new_height = $('#template_list').height() + diff;
		}
		$('#template_editor').css('visibility', 'hidden');
	}
	$('#template_text').height(new_height);
	if ($('#frame_template_text').length) {
		$('#frame_template_text').height(new_height);
	}
	var holder = $('#template_list').parents('div:first');
	holder.height(new_height - diff - holder.outerHeight() + holder.height());
}

function fn_adjust_template_list(new_height)
{
	var diff = $('#template_list').parents('td:first').outerHeight() - $('#template_list').parents('td:first').height();
	var holder = $('#template_list').parents('div:first');
	holder.height(new_height - diff - holder.outerHeight() + holder.height());
	$('#frame_template_text').css('width', '100%');
}

function fn_set_editor_value(data)
{
	if (1||!$('#frame_template_text').length) {
		var support_langs = ['pl', 'ru', 'fr', 'ja', 'sk', 'mk', 'es', 'cs', 'dk', 'it', 'pt', 'hr', 'nl', 'de', 'en'];
		var syntax = 'html';
		
		if (data.filename) {
			var extension = data.filename.split('.').pop();
			var supported_synt = editAreaLoader.default_settings.syntax_selection_allow.split(',');
			if ($.inArray(extension, supported_synt) != -1) {
				syntax = extension;
			}
		}
		
		editAreaLoader.init({
			id : 'template_text',
			syntax: syntax,
			min_height: 350,
			start_highlight: true,
			allow_resize: 'no',
			allow_toggle: false,
			font_size: 10,
			display: 'later',
			EA_load_callback: 'fn_editor_load_callback',
			language: fn_get_listed_lang(support_langs)
		});
		$('#template_text').val(data.content);
		editAreaLoader.start('template_text');
	} else {
		window.frames['frame_template_text'].editArea.previous = new Array();
		window.frames['frame_template_text'].editArea.next = new Array();
		if ($('#template_editor:visible').length && !$('#template_editor').hasClass('cm-dashed-box')) {
			editAreaLoader.setValue('template_text', data.content);
			//editAreaLoader.setSelectionRange('template_text', 0, 0);
			$('#template_text').removeClass('cm-item-modified');
		}
	}
}

function fn_editor_load_callback(id)
{
	$.toggleStatusBox('hide');
	window.frames['frame_' + id].editArea.settings['change_callback'] = 'fn_change_callback';
}

function fn_save_template()
{
	if ($('#template_text').hasClass('cm-item-modified')) {
		$('#template_text').removeClass('cm-item-modified');
		if (typeof(template_editor) != 'undefined' && template_editor.selected_file) {
			$.ajaxRequest(fn_url('template_editor.edit'), {data: {file: template_editor.selected_file, file_content: editAreaLoader.getValue('template_text')}, method: 'post'});
		} else {
			var cur_template = $('.cm-cur-template').eq(0).text();
			var result_ids = [];
			$('span[template="' + cur_template + '"]').each(function(){
				result_ids.push(this.id);
			});
			$.ajaxRequest(fn_url('design_mode.save_template'), {data: {file: cur_template, current_url: current_url, content: editAreaLoader.getValue('template_text')}, method: 'post', result_ids: result_ids.join(','), callback: fn_save_template_callback, full_render: true});
		}
	}
}

function fn_save_template_callback()
{
	$('.cm-template-box').each(function(){
		var elm = $(this);
		var icon = $('.cm-template-icon', elm).eq(0);
		var _id = elm.attr('id');
		
		icon.attr('owner', _id);
		$('#' + _id).css('display', 'block');
		var template_offset = fn_get_offset($('#' + _id).get(0), true);
		$('#' + _id).css('display', '');
		icon.css({'left': template_offset.left, 'top': template_offset.top});
		if (!icon.parents('#template_editor_content').length) {
			icon.removeClass('hidden');
		}
	});
}

function fn_restore_template()
{
	if (confirm(lang.text_restore_question)) {
		var cur_template = $('.cm-cur-template').eq(0).text();
		var result_ids = [];
		$('span[template="' + cur_template + '"]').each(function(){
			result_ids.push(this.id);
		});
		$.ajaxRequest(fn_url('design_mode.restore_template'), {data: {file: cur_template, current_url: current_url}, result_ids: result_ids.join(','), caching: false});
	}
}

function fn_change_callback(id)
{
	$('#' + id).addClass('cm-item-modified');
}

$.extend({
	initDesignMode: function() 
	{
		$(document).bind('click', function(e) {
			return $.dispatch_design_mode_event(e);
		});

		$(document).bind('mouseover', function(e) {
			return $.dispatch_design_mode_event(e);
		});

		$('#design_mode_panel').draggable({
			drop: function(e, ui) {
				var offset = ui.offset();
				$.cookie.set('design_mode_panel_offset', 'left: ' + offset.left + 'px; top:' + offset.top + 'px;');
			}
		});

		$('.cm-translate').parents('.cm-button-main').removeClass('cm-button-main');
		$('.cm-translate:has(p,div,ul)').css('display', 'block');
		if ($.browser.msie) {
			$('.cm-translate:has(p)').each(function() {
				$(this).html($(this).html());
			});
		}
		$('option.cm-translate').removeClass('cm-translate').parents('select').addClass('cm-translate');
	
		if ($('.cm-template-box').length) {
			$('.cm-hidden-wrapper.hidden').removeClass('hidden');

			$('.cm-template-box').each(function() {
				var elm = $(this);
				var icon = $('.cm-template-icon', elm).eq(0);
				var _id = elm.attr('id');
				icon.attr('owner', _id);
			
				$('#' + _id).css('display', 'block');
				var template_offset = fn_get_offset($('#' + _id).get(0), true);
				$('#' + _id).css('display', '');
				icon.css({'left': template_offset.left, 'top': template_offset.top});
				if (!icon.parents('#template_editor_content').length) {
					icon.removeClass('hidden');
				}
			});

			$(document).bind('mouseout', function(e) {
				return $.dispatch_design_mode_event(e);
			});
		}
	}
});

$(function()
{
	$.initDesignMode();
});
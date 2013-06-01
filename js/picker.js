$.extend({
	pickers_stack: [],

	update_comma_ids: function(ids_obj, delete_id)
	{
		var ids = ids_obj.val().split(',');
		var prod_id = delete_id.split('_');
		for(var i = 0; i < ids.length; i++) {
			if (ids[i] == delete_id || ids[i].indexOf(prod_id[0] + '=') == 0) {
				ids.splice(i, 1);
				i--;
			}
		}
		ids_obj.val(ids.join(','));
	},

	delete_js_item: function(root_id, delete_id, prefix)
	{
		var last_picker = this.pickers_stack[this.pickers_stack.length - 1];
		var jid = '#' + root_id;
		var jdest = $(jid);

		if (delete_id == 'delete_all') {
			$('.cm-js-item:visible', jdest).remove();
		} else {
			var obj_id = root_id + '_' + delete_id;
			$('#' + obj_id, jdest).remove();
		}

		var ids_id = '#' + prefix + root_id + '_ids';
		var ids_obj = $(ids_id);
		if (ids_obj.length) {
			if (delete_id == 'delete_all') {
				ids_obj.val('');
			} else {
				this.update_comma_ids(ids_obj, delete_id);
			}
		}

		var no_item_id = '#' + root_id + '_no_item';
		var no_item = $(no_item_id);
		if ($('.cm-js-item', jdest).length <= 1 && no_item.length) {
			if (!jdest.find('#' + root_id + '_no_item').length) {
				jdest.hide();
			}
			no_item.show();
		}
		$('.cm-js-item:visible:first .cm-comma', jdest).hide();
		$('#opener_inner_' + root_id).text($('.cm-js-item', jdest).length - 1);
	},

	mass_delete_js_item: function(items_str, target_id)
	{
		var items = items_str.split(',');
		for (var id in items) {
			var parts = items[id].split(':');
			$.delete_js_item(target_id, parts[1], parts[0]);
		}
	},

	add_js_item: function(root_id, js_items, prefix, exception_message)
	{
		var jid = '#' + root_id;
		var jroot = $(jid);

		var root = jroot.get(0);
		var ids_obj = $('#' + prefix + root_id + '_ids');

		if (ids_obj.length) {
			var ids = ids_obj.val() != "" ? ids_obj.val().split(',') : [];
		}

		for(var id in js_items) {
			if (jroot.hasClass('cm-display-radio')) {
				$('input.cm-picker-value', jroot).val(id);
				$('input.cm-picker-value-description', jroot).val(js_items[id]);
			} else {
				var child_id = root_id + '_' + id;
				var child = $('#' + child_id);
				var ids_item = id;

				if (!child.length && root){
					var append_obj = $('.cm-clone', jroot).clone(true).appendTo(jroot).attr('id', child_id).removeClass('hidden cm-clone');
					var append_obj_content = '';

					if (prefix == 'u') {
						append_obj_content = unescape(append_obj.html()).str_replace('{email}', js_items[id].email).str_replace('{user_name}', js_items[id].user_name).str_replace('{user_id}', id);
					} else if (prefix == 'o') {
						// for use in js-object window
						append_obj_content = unescape(append_obj.html()).str_replace('{order_id}', id);
						for (var index in js_items[id]) {
							append_obj_content = append_obj_content.str_replace('{' + index + '}', js_items[id][index]);
						}
					} else if (prefix == 'a') {
						append_obj_content = unescape(append_obj.html()).str_replace('{page_id}', id).str_replace('{page}', js_items[id]);
					} else if (prefix == 'c') {
						append_obj_content = unescape(append_obj.html()).str_replace('{category_id}', id).str_replace('{category}', js_items[id]);
					} else if (prefix == 'm') {
						append_obj_content = unescape(append_obj.html()).str_replace('{company_id}', id).str_replace('{company}', js_items[id]);
					} else if (prefix == 'p') {
						if (!jroot.hasClass('cm-picker-options')) {
							append_obj_content = unescape(append_obj.html()).str_replace('{delete_id}', id).str_replace('{product}', js_items[id]);
						} else {
							var options_combination = id;
							for(var ind in js_items[id].option.path) {
								options_combination += "_" + ind + "_" + js_items[id].option.path[ind];
							}
							var product_id = $.crc32(options_combination);
							if (!$('#' + root_id + "_" + product_id).length) {
								var input_prefix = $('input', append_obj).attr('name').str_replace('[{product_id}][amount]', '[' + product_id + ']');
								var inputs = '<input type="hidden" name="' + input_prefix + '[product_id]' + '" value="' + id + '" />';
								js_items[id]['product_id'] = product_id;
								
								for(var ind in js_items[id].option.path) {
									inputs += '<input type="hidden" name="' + input_prefix + '[product_options][' + ind + ']' + '" value="' + js_items[id].option.path[ind] + '" />';
								}
								$('input[name*=\'amount\']', append_obj).val(1);
								append_obj.attr('id', root_id + "_" + product_id);
								append_obj_content = unescape(append_obj.html()).str_replace('{product}', js_items[id].value).str_replace('{options}', js_items[id].option.desc + inputs).str_replace('{root_id}', root_id).str_replace('{delete_id}', product_id).str_replace('{product_id}', product_id);
							}
							if (exception_message) {
								fn_alert(exception_message);
							}
						}
					}

					var hook_data = {
						'append_obj_content': append_obj_content,
						'var_prefix': prefix,
						'object_html': unescape(append_obj.html()),
						'var_id': id,
						'item_id': js_items[id]
					};
					fn_set_hook('add_js_item', hook_data);
					append_obj_content = hook_data.append_obj_content;

					if (append_obj_content) {
						append_obj.html(append_obj_content);
						if (ids_obj.length) {
							ids.push(ids_item);
						}
					} else {
						append_obj.remove();
					}
					$('input', append_obj).removeAttr('disabled');
					var comma = $('.cm-comma', append_obj);
					if ($('.cm-js-item', jroot).length > 2 && comma.length) {
						comma.show();
					}
				}
				if (ids_obj.length) {
					var ids_str = ids.join(',');
					ids_obj.val(ids_str);
				}
			}
		}

		$('#opener_inner_' + root_id).text($('.cm-js-item', jroot).length - 1);

		if ($('.cm-js-item', jroot).length > 1) {
			jroot.show();
			$('#' + root_id + '_no_item').hide();
		}
	}
});
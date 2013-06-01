var template_editor = {

	selected_file: '',

	// Refresh directory tree
	refresh: function(data)
	{
		if (data && data.message) {
			this.show_status(data.action_type, data.message);
		}
		$.ajaxRequest(fn_url('template_editor.browse'), {callback: [this, 'show_list'], cache: false});
	},

	// Change directory in file browser
	chdir: function(dir)
	{
		if (dir.length==0) {
			return;
		}

		$.ajaxRequest(fn_url('template_editor.browse?dir=' + dir), {callback: [this, 'show_list'], cache: false});
		this.selected_file = '';
		$('#actions_table').toggleBy(true);
	},

	// Show file content
	show_content: function(file)
	{
		if (!file) {
			file = this.selected_file;
		}
		if (!$('.template-editor-highlight').hasClass('cm-passed')) {
			$.ajaxRequest(fn_url('template_editor.edit'), {
				data: {file: file},
				keep_status_box: true,
				callback: function(data,params) {
					$('#enabled_template_editor').val(file);
					if (typeof(data.content) == 'undefined') {
						params.show_editor = false;
						fn_hide_template_editor();
						$.toggleStatusBox('hide');
					} else {
						if (data.content.length <= 30000) {
							$('#enabled_template_editor').attr('checked', true);
							params.show_editor = true;
						} else {
							$('#enabled_template_editor').removeAttr('checked');
							params.show_editor = false;
							fn_hide_template_editor();
						}
						fn_show_template_editor(data, params);
					}
				}
			});
			$('.template-editor-highlight').addClass('cm-passed');
		}
	},

	change_status_editor: function(file) {
		if ($('#template_text').val()) {
			$.toggleStatusBox('show');
			if ($('#enabled_template_editor').is(':checked')) {
				var data = {
					filename: file,
					content: $('#template_text').val()
				};
				fn_set_editor_value(data);
			} else {
				fn_hide_template_editor();
				$.toggleStatusBox('hide');
			}
		}
	},
	
	save_content: function()
	{
		fn_save_template();
	},
	
	show_list: function(data)
	{
		this.directory_data = data.directory_data;

		$('#filelist').html(data.files_list);
		$('path').html(data.current_path);
//		$('#legend').toggleBy(!data.show_legend);

		var exploded_path = data.current_path.split('/');
		var result = '';
		var tmp = '';

		exploded_path = exploded_path.reverse(); // FIXME!!! - very bad code
		if (exploded_path[0] != '') {
			exploded_path.unshift('');
		}
		for (k in exploded_path) {
			if (exploded_path[k] == '') {
				continue;
			}
			if (k != '') {
				tmp = '';
				for (i=0; i<k-1;i++) {
					tmp += '../';
				}
				result = (exploded_path[k] == '[ROOT]' ? '' : '/') + "<a href=\"javascript: template_editor.chdir('" + tmp + "')\">" + exploded_path[k] + "</a>" + result;
			}
		}
		$('#path').html(result);

		$('#dialog_bg').hide();
	},

	// Select file
	select_file: function(file, type, id)
	{
		this.selected_file = file;

		if (file != '..') {
			$('#selected_file').html(file);
			$('#file_actions').toggleBy((type != 'F'));
		} else {
			$('#selected_file').html('');
		}

		$('#actions_table').toggleBy(file == '..');

		$('td', document.getElementById('row_' + file)).addClass('template-editor-highlight');
		if (file != '..') {
			$('.cm-delete-file', document.getElementById('row_' + file)).show();
		}
		if (type == 'F') {
			$('.cm-download', document.getElementById('row_' + file)).show();
		}

		for (var k in this.directory_data) {
			if (file != k) {
				$('td', document.getElementById('row_' + k)).removeClass('template-editor-highlight cm-passed');
				$('.cm-download', document.getElementById('row_' + k)).hide();
				$('.cm-delete-file', document.getElementById('row_' + k)).hide();
			}
		}
	},

	// Rename file or directory
	rename: function()
	{
		if (this.selected_file.length > 0) {
			var rename_to = prompt(lang.text_enter_filename, this.selected_file);
			if (rename_to) {
				$.ajaxRequest(fn_url('template_editor.rename_file?file=' + this.selected_file + '&rename_to=' + rename_to), {callback: [this, 'refresh'], cache: false});
			}
		}
	},

	// Delete file or directory
	delete_file: function()
	{
		if (this.selected_file.length > 0) {
			if (confirm(lang.text_are_you_sure_to_delete_file)) {
				$.ajaxRequest(fn_url('template_editor.delete_file?file=' + this.selected_file), {callback: [this, 'refresh'], cache: false});
			}
		}
	},

	// Create file or directory
	create_file: function(file, is_dir)
	{
		if (file.length > 0) {
			var action = (is_dir == true) ? 'create_directory' : 'create_file';
			$.ajaxRequest(fn_url('template_editor.' + action + '?file=' + file), {callback: [this, 'refresh'], cache: false});
		}
	},

	// Download selected file
	get_file: function()
	{
		$.redirect(fn_url('template_editor.get_file?file='+this.selected_file));
	},

	// Change file/directory permissions
	chmod: function(perms, recursive)
	{
		if (this.selected_file.length > 0) {
			if (perms) {
				$.ajaxRequest(fn_url('template_editor.chmod?file=' + this.selected_file + '&perms=' + perms + '&r=' + recursive), {callback: [this, 'refresh'], cache: false});
			}
		}
	},

	show_status: function(type, message, window_handle)
	{
		var wh = $((window_handle) ? window_handle : document);

		if (!message) {
			$('#error_box', wh).hide();
			$('#status_box', wh).hide();
		} else {
			if (type == 'error') {
				$('#error_status', wh).html(message);
				$('#status_box', wh).hide();
				$('#error_box', wh).show();
			} else {
				$('#status', wh).html(message);
				$('#error_box', wh).hide();
				$('#status_box', wh).show();
			}
		}
		return true;
	},

	// Restore file from the repository
	restore_file: function()
	{
		if (confirm(lang.text_restore_question)) {
			$.ajaxRequest(fn_url('template_editor.restore?file=' +this.selected_file), {callback: [this, 'refresh'], cache: false});
		}
	},

	parse_permissions: function()
	{
		var perms = this.directory_data[this.selected_file].perms;

		$('#o_read').attr('checked', (perms.charAt(0) == '-') ? false : true);
		$('#o_write').attr('checked', (perms.charAt(1) == '-') ? false : true);
		$('#o_exec').attr('checked', (perms.charAt(2) == '-') ? false : true);
		$('#g_read').attr('checked', (perms.charAt(3) == '-') ? false : true);
		$('#g_write').attr('checked', (perms.charAt(4) == '-') ? false : true);
		$('#g_exec').attr('checked', (perms.charAt(5) == '-') ? false : true);
		$('#w_read').attr('checked', (perms.charAt(6) == '-') ? false : true);
		$('#w_write').attr('checked', (perms.charAt(7) == '-') ? false : true);
		$('#w_exec').attr('checked', (perms.charAt(8) == '-') ? false : true);
	},

	set_perms: function()
	{
		var mode = 0;
		mode = $('#o_read').attr('checked') ? mode + 400 : mode;
		mode = $('#o_write').attr('checked') ? mode + 200 : mode;
		mode = $('#o_exec').attr('checked') ? mode + 100 : mode;
		mode = $('#g_read').attr('checked') ? mode + 40 : mode;
		mode = $('#g_write').attr('checked') ? mode + 20 : mode;
		mode = $('#g_exec').attr('checked') ? mode + 10 : mode;
		mode = $('#w_read').attr('checked') ? mode + 4 : mode;
		mode = $('#w_write').attr('checked') ? mode + 2 : mode;
		mode = $('#w_exec').attr('checked') ? mode + 1 : mode;
		this.chmod(mode, $('#chmod_recursive').attr('checked'));
	}
}
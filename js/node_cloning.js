$.fn.extend({
	//
	// Adds the tag
	//
	// @level - level in variable name that should be replaced
	// @clone - if set, the field values will be copied
	// E.g. (replace on '30')
	// level = 1, varname = data[20][sub][50] - after replacement data[30][sub][50]
	// level = 3, varname = data[20][sub][50] - after replacement data[20][sub][30]

	cloneNode: function(level, clone, before)
	{
		var before = before || false;
		var clone = clone || false;

		var self = $(this);
		var regex = new RegExp('((?:\\[\\w+\\]){' + (level - 1) + '})\\[(\\d+)\\]');
		var image_regex = new RegExp('((?:\\[\\w+\\]){0})\\[(\\d+)\\]');

		if (window['_counter']) {
			window['_counter']++;
		} else {
			window['_counter'] = 1;
		}
		new_id = self.attr('id') + '_' + window['_counter'];

		var new_node = self.clone();
		new_node.attr('id', new_id);

		$('select', new_node).each(function(ind) { // copy values of selectboxes
			$(this).val($('select', self).eq(ind).val());
		});

		$('textarea', new_node).each(function(ind) { // copy values of textareas
			$(this).val($('textarea', self).eq(ind).val());
		});

		// Remove all script tags
		$('script', new_node).remove();

		// Remove all picker tags
		$('.cm-picker', new_node).remove();

		// Correct Ids
		var changes = [];
		$('[id],[for],[rev],[result_elm]', new_node).each(function() {
			var self = $(this);
			var attrs = ['id', 'for', 'rev', 'result_elm'];
			var id = '';

			for (var k in attrs) {
				id = self.attr(attrs[k]);
				if (id) {
					// if it is wrapper, change id correctly (id + counter + _wrap_) 
					if (attrs[k] == 'id' && id.indexOf('_wrap_') != -1) {
						var tmp_id = id.substr(0, id.indexOf('_wrap_'));
						var tmp_id2 = id.substr(id.indexOf('_wrap_'));
						self.attr(attrs[k], tmp_id + '_' + window['_counter'] + tmp_id2);
						changes[id] = tmp_id + '_' + window['_counter'] + tmp_id2;
					} else {
						self.attr(attrs[k], id + '_' + window['_counter']);
						changes[id] = id + '_' + window['_counter'];
					}
				}
			}
		});

		// Check if the clone object is link. If so, convert the href path.
		$('[href]', new_node).each(function() {
			var self = $(this);
			var href = self.attr('href');

			for (k in changes) {
				var expr = new RegExp(k + '(?=&|$)');
				href = href.replace(expr, changes[k]);
			}

			self.attr('href', href);
		});

		// Move "clone" objects to main content
		$('[id*=clone_]', new_node).each(function() {
			var node = $(this).clone();
			var new_id = node.attr('id').replace('clone_', '');
			if ($('#' + new_id, new_node).length == 0) {
				node.attr('id', new_id);
				node.insertAfter($(this));
			}
		});

		// Update elements
		$('[name]', new_node).each(function() {
			var self = $(this);
			var name = self.attr('name');
			var it = 0;
			var matches = name.match(/(\[\d+\]+)/g);

			// Increment array index
			if (matches) {
				name = name.replace(self.hasClass('cm-image-field') ? image_regex : regex, '$1[#HASH#]'); // Magic... parseInt does not work for $2 in replace method...
				self.attr('name', name.str_replace('#HASH#', parseInt(RegExp.$2) + window['_counter']));
			}

			// Set default values
			if (clone == false) {
				if (self.is(':checkbox,:radio')) {
					self.attr('checked', self.get(0).defaultChecked ? 'checked' : '');
				} else if (self.is(':input') && self.attr('type') != 'hidden') {
					if (self.attr('name') != 'submit') {
						self.val('');

						// reset select box
						if (self.attr('tagName').toLowerCase() == 'select') {
							self.attr('selectedIndex', '');
						}
					}
				}
			}

			// Display enabled remove button
			if (name == 'remove') {
				self.addClass('hidden');
				self.next().removeClass('hidden');
			}
		});

		// magic increment for checkbox element classes like add-0 -> add-1 (to fix check_all microformat work)
		$(':checkbox[class]', new_node).each(function() {
			if (this.name == 'check_all') {
				var m = this.className.match(/cm-check-items-([\w]*)-(\d+)/);
				$(this).removeClass('cm-check-items-' + m[1] + '-' + m[2]).addClass('cm-check-items-' + m[1] + '-' + (parseInt(m[2]) + window['_counter']));

				$(':checkbox.cm-item-' + m[1] + '-' + m[2], new_node).each(function() {
					$(this).removeClass('cm-item-' + m[1] + '-' + m[2]).addClass('cm-item-' + m[1] + '-' + (parseInt(m[2]) + window['_counter']));
				});

				return false;
			}
		});

		// Insert node into the document
		if (before == true) {
			self.before(new_node);
		} else {
			self.after(new_node);
		}

		// if node has file uploader, process it
		$('[id^=clean_selection]', new_node).each(function() {

			var type_id = this.id.str_replace('clean_selection', 'type');
			if ($('#' + type_id).val() == 'local' || clone == false){
				fileuploader.clean_selection(this.id);
			}
		});

		// if node has ajax content loader, init it
		$('.cm-ajax-content-more', new_node).each(function() {
			var self = $(this);
			$('#' + self.attr('rev')).empty();
			self.show();
			self.appear(function() {
				$.loadAjaxContent(self);
			}, {
				one: false,
				container: '#scroller_' + self.attr('rev')
			});
		});

		// init calendar
		$('.cm-calendar', new_node).each(function () {
			$(this).removeClass('hasDatepicker').datepicker(window.calendar_config || {});
		});

		return new_id;
	},

	//
	// Remove the tag
	//
	removeNode: function()
	{
		var self = $(this);
		if (!self.prev().length || self.hasClass('cm-first-sibling')) {
			return false;
		}

		self.remove();
	}
});
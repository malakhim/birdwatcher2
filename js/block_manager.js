

// Class Block manager Menu
function BlockManager_Class()
{
	// Private variables
	_event = {};
	_hover_element = {};
	_init_params = {};
	_self = this;
	
	// Public variables
	this.menu_type = ''; //container, grid, block
	this.menu_status = 'H'; // "H"idden; "D"isplayed;
	this.inited = false;
	
	// Private functions
	var _setEvent = function(event)
	{
		_event = event;
	};

	var _determineElementType = function(element)
	{
		element = element || _hover_element;
		var type =  '';

		if (element.hasClass(_init_params.container_class)) {
			type = 'container';
		} else if (element.hasClass(_init_params.grid_class)) {
			type = 'grid';
		} else {
			type = 'block';
		}

		return {type: type, id: element.attr('id')};
	};

	var _parseResponse = function(data, params)
	{
		// If we received "id" - apply this id to new element
		if (typeof(data.id) != 'undefined') {
			var new_id = '';
			if (data.mode == 'grid') {
				new_id = 'grid_' + data.id;
			} else if (data.mode == 'snapping') {
				new_id = 'snapping_' + data.id;
			}

			$('#new_element').attr('id', new_id);
		}

		_self.calculateLevels();
	};

	var _snapBlocks = function(block)
	{
		var snapping = {};
		var blocks = block.parent().find('.block');
		
		blocks.each(function() {
			var _block = $(this);
			var id = _block.index();

			snapping[id] = {};

			snapping[id].grid_id =_block.parent().attr('id').replace('grid_', '');
			snapping[id].order = _block.index();
			
			if (_block.hasClass('base-block')) {
				snapping[id].block_id = _block.attr('id').replace('block_', '');
				snapping[id].action = 'add';

				_block.attr('id', 'new_element');
				_block.removeClass('base-block');

			} else {
				snapping[id].snapping_id = _block.attr('id').replace('snapping_', '');
				snapping[id].action = 'update';
			}
		});

		_self.sendRequest('snapping', '', {snappings: snapping});
	};

	var _executeAction = function(action)
	{
		// Init local variables
		var container_title, contanier, prop_container, href, max_width, container_id;

		// Determine element (container, grid, block)
		var element_type = _determineElementType().type;
		
		// Hide element control menu and execute "action"
		_hover_element.parent().find('.cm-popup-box').hide();

		switch (action) {
			case 'properties':
				if (element_type == 'block') {
					href = 'block_manager.update_block?';
						href += 'snapping_data[snapping_id]=' + _hover_element.attr('id').replace('snapping_', '');
						href += '&content_data[grid_id]=' + _hover_element.parent().attr('id').replace('grid_', '');
						href += '&selected_location=' + (typeof(selected_location) == 'undefined' ? 0 : selected_location);
						href += '&dynamic_object[object_type]=' + (typeof(dynamic_object_type) == 'undefined' ? '' : dynamic_object_type);
						href += '&dynamic_object[object_id]=' + (typeof(dynamic_object_id) == 'undefined' ? 0 : dynamic_object_id);

					prop_container = 'prop_' + _hover_element.attr('id');

					if ($('#' + prop_container).length == 0) {
						// Create properties container
						container_title = _hover_element.find('.block-header > h4').text();

						if (container_title.length > 0) {
							container_title = lang.editing_block + ': ' + container_title;
						} else {
							container_title = lang.editing_block;
						}
						
						contanier = $('<div id="' + prop_container + '" title="' + _escape(container_title) + '"></div>').appendTo('body');
					}

				} else if (element_type == 'grid') {
					max_width = _self.getMaxWidth();
					prop_container = 'grid_properties_' + _hover_element.attr('id').replace('grid_', '');

					href = 'block_manager.update_grid?' + 'grid_data[grid_id]=' + _hover_element.attr('id').replace('grid_', '');
						href += '&grid_data[max_width]=' + max_width;
						href += '&grid_data[container_id]=' + _hover_element.parents('.container').attr('id').replace('container_', '');
					
					if ($('#' + prop_container).length == 0) {
						// Create properties container
						contanier = $('<div id="' + prop_container + '" title="' + _escape(lang.editing_grid) + '"></div>').appendTo('body');
					}

				} else if (element_type == 'container') {
					container_title = _hover_element.find('> .grid-control-menu > .grid-control-title').text();

					href = 'block_manager.update_container?';
						href += '&container_id=' + _hover_element.attr('id').replace('container_', '');

					prop_container = 'container_properties_' + _hover_element.attr('id').replace('container_', '');

					if ($('#' + prop_container).length == 0) {
						// Create properties container
						contanier = $('<div id="' + prop_container + '" title="' + _escape(lang.editing_container) + ': ' + container_title + '"></div>').appendTo('body');
					}
				}

				$('#' + prop_container).ceDialog('open', {href: fn_url(href)});
				break;

			case 'add-grid':
				max_width = _self.getMaxWidth();
				prop_container = 'grid_properties_new';
				href = 'block_manager.update_grid?';
					href += 'grid_data[max_width]=' + max_width;

				if (element_type == 'container') {
					container_id = _hover_element.attr('id').replace('container_', '');

					href += '&grid_data[container_id]=' + container_id;
					href += '&grid_data[parent_id]=0';

					prop_container += '_' + container_id + '_0';

				} else {
					container_id = _hover_element.parents('.container').attr('id').replace('container_', '');
					var parent_id = _hover_element.attr('id').replace('grid_', '');

					href += '&grid_data[container_id]=' + container_id;
					href += '&grid_data[parent_id]=' + parent_id;

					prop_container += '_' + container_id + '_' + parent_id;
				}

				if ($('#' + prop_container).length == 0) {
					// Create properties container
					contanier = $('<div id="' + prop_container + '" title="' + _escape(lang.adding_grid) + '"></div>').appendTo('body');
				}
				
				$('#' + prop_container).ceDialog('open', {href: fn_url(href)});
				break;

			case 'add-block':
				href = 'block_manager.block_selection?';
					href += '&grid_id=' + _hover_element.attr('id').replace('grid_', '');
                    href += '&selected_location=' + (typeof(selected_location) == 'undefined' ? 0 : selected_location);
                contanier = $('<div id="block_selection" title="' + _escape(lang.adding_block_to_grid) + '"></div>').appendTo('body');

				$('#block_selection').ceDialog('open', {href: fn_url(href)});
				break;

			case 'delete':
				if (confirm(lang.text_are_you_sure_to_proceed) != false) {
					if (element_type == 'grid') {
						var data = {
							snappings: _self.deleteStructure(_hover_element)
						};

						_self.sendRequest('grid', 'update', data);

					} else if (element_type == 'block'){
						var data = {
							snappings: _self.deleteStructure(_hover_element)
						};

						_self.sendRequest('snapping', 'delete', data);
					}
				}

				break;
			case 'manage-blocks':
				href = 'block_manager.block_selection?manage=Y';
				contanier = $('<div id="block_managing" title="' + _escape(lang.manage_blocks) + '"></div>').appendTo('body');

				$('#block_managing').ceDialog('open', {href: fn_url(href)});
				break;

			case 'switch':
				var button = $('.bm-action-switch', _hover_element);
				var status = (button.hasClass('switch-off')) ? 'A' : 'D';
				var dynamic_object = (button.hasClass('bm-dynamic-object')) ? button.attr('rel') : 0;

				if (button.hasClass('bm-confirm')) {
					var text = button.find(".confirm-message").text();

					if (text == "" || text == 'undefined') {
						text =lang.text_are_you_sure_to_proceed;
					}

					if (confirm(text) == false) {
						return false;
					} else {
						button.removeClass("bm-confirm");
					}
				}

				var data = {
					snapping_id: _hover_element.attr('id').replace('snapping_', ''),
					object_id: dynamic_object,
					object_type: dynamic_object_type,
					status: status
				};

				$.ajaxRequest(fn_url('block_manager.update_status'), {
					data: data,
					callback: _parseResponse,
					method: 'get'
				});

				if (status == 'A') {
					button.removeClass('switch-off');
					_hover_element.removeClass('block-off');
				} else {
					button.addClass('switch-off');
					_hover_element.addClass('block-off');
				}

				break;
			
			case 'control-menu':
				_hover_element.find('> .bm-control-menu .bm-drop-menu').show();
				break;

			default: break;
		}

	};
	
	var _escape = function(str)
	{
		return str
			.replace(/&/g, "&amp;")
			.replace(/</g, "&lt;")
			.replace(/>/g, "&gt;")
			.replace(/"/g, "&quot;")
			.replace(/'/g, "&#039;");
	};

	// Public functions
	this.init = function(containers, params)
	{
		if (this.inited) {
			return true;
		}
		
		this.inited = true;
		$(containers).disableSelection();
		
		params.update = function(event, ui)
		{
			if (ui.sender == null) {
				_snapBlocks($(ui.item));
				_self.checkMenuItems($(ui.item).parent());
			}

			if (ui.sender) {
				var placeholder = $(this);
				ui.item.removeClass('float-left').removeClass('float-right');

				if (placeholder.hasClass('bm-left-align')) {
					ui.item.addClass('float-left');
					ui.item.width(150);
					if (ui.item.width() > ui.item.parent().width()) {
						ui.item.width(ui.item.parent().width() - 10);
					}
					
				} else if (placeholder.hasClass('bm-right-align')) {
					ui.item.addClass('float-right');
					ui.item.width(150);
					if (ui.item.width() > ui.item.parent().width()) {
						ui.item.width(ui.item.parent().width() - 10);
					}
				} else {
					ui.item.width(ui.item.parent().width() - 10);
				}

				_self.checkMenuItems($(ui.sender));
			}

			_self.setBlockHeaderWidth(ui.item);
		};

		params.start = function(event, ui)
		{
			ui.item.addClass('ui-draggable-block');

			// Workaround fix for FireFox relative positions
			if ($.ua.browser == 'Firefox') {
				ui.item.css('margin-stored', ui.item.css('margin-top'));
				ui.item.css('margin-top', $(window).scrollTop());
			}

			ui.item.css('max-width', '300px');

			fn_ui_update_placeholder(ui, $(this));
		};

		params.beforeStop = function(event, ui)
		{
			ui.item.removeClass('ui-draggable-block');
			ui.item.css('max-width', '');

			// Workaround fix for FireFox relative positions
			if ($.ua.browser == 'Firefox') {
				ui.item.css('margin-top', ui.item.css('margin-stored'));
			}
		};

		params.over = function(event, ui)
		{
			fn_ui_update_placeholder(ui, $(this));
		};

		params.stop = function(event, ui)
		{
			_self.buildMenu(ui.item);
		};
		
		_init_params = params;
		_init_params.containers = containers;
		
		/*
			We have 2 function to parse actions:
				1) Block manager control elements, like "Add grid", "Properties", etc. 
					Controls by class: cm-action

				2) When we click "Add block" or "Manage blocks". Process clicking on block in a new popup window with blocks. 
					Controls by class: cm-add-block
		*/

		$('.cm-action').live('click', function(e) {
			jelm = $(e.currentTarget).parents('.bm-control-menu').parent();
			
			_hover_element = jelm;
			_setEvent(e);

			var action = $(e.currentTarget).attr('class').match(/bm-action-([0-9a-zA-Z-]+)/i)[1];

			_executeAction(action);

			// Prevent following by link
			return false;
		});

		$('.cm-remove-block').live('click', function(e) {
			if (confirm(lang.text_are_you_sure_to_proceed) != false) {
				var block_id = $(this).parent().find('input[name="block_id"]').attr('value');
	
				_self.sendRequest('block', 'delete', {block_id: block_id});

				$(this).parent().remove();
			}

			return false;
		});

		$('.cm-add-block').live('click', function(e) {
			/*
				Adding new block functionality
			*/
			var action = $(this).attr('class').match(/bm-action-([a-zA-Z0-9-_]+)/)[1];
			
			if (action == 'new-block') {
				var is_manage = $(this).hasClass('bm-manage');
				var block_type = $(this).find('input[name="block_data[type]"]').attr('value');

				if (is_manage) {
					var grid_id = 0;
				} else {
					var grid_id = _hover_element.attr('id').replace('grid_', '');
				}

				var href = 'block_manager.update_block?';
					href += 'block_data[type]=' + block_type;
					href += '&snapping_data[grid_id]=' + grid_id;
					href += '&selected_location=' + (typeof(selected_location) == 'undefined' ? 0 : selected_location);

				var prop_container = 'new_block_' + block_type + '_' + grid_id;
				
				if ($('#' + prop_container).length == 0) {
					// Create properties container
					var contanier = $('<div id="' + prop_container + '"></div>').appendTo('body');
				}

				$('#' + prop_container).ceDialog('open', {href: fn_url(href), title: lang.add_block + ': ' + $(this).find('strong').text()});

			} else if (action == 'existing-block') {
				var is_manage = $(this).hasClass('bm-manage');
				var block_id = $(this).find('input[name="block_id"]').attr('value');
				var block_type = $(this).find('input[name="type"]').attr('value');
				var grid_id = $(this).find('input[name="grid_id"]').attr('value');
				var block_title = $(this).find('.select-block-description > strong').text();

				if (is_manage) {
					var href = 'block_manager.update_block?';
						href += 'block_data[type]=' + block_type;
						href += '&block_data[block_id]=' + block_id;
						href += '&selected_location=' + (typeof(selected_location) == 'undefined' ? 0 : selected_location);

					var prop_container = 'new_block_' + block_type + '_block_' + block_id;
					
					if ($('#' + prop_container).length == 0) {
						// Create properties container
						var contanier = $('<div id="' + prop_container + '"></div>').appendTo('body');
					}

					$('#' + prop_container).ceDialog('open', {href: fn_url(href), title: lang.editing_block + ': ' + $(this).find('strong').text()});

				} else {
					var elm = $('<div class="block base-block" id="block_' + block_id + '">' + $('.base-block').html() + '</div>');
					$('.block-header-title', elm).text(block_title);

					if (_hover_element.find('.block:last').length) {
						elm.insertAfter(_hover_element.find('>.block:last'));
					} else {
						elm.prependTo(_hover_element);
					}

					_snapBlocks(elm);

					if (_hover_element.hasClass('bm-right-align')) {
						elm.addClass('float-right');
					} else if (_hover_element.hasClass('bm-left-align')) {
						elm.addClass('float-left');
					}

					_self.buildMenu(elm);
					_self.checkMenuItems(elm.parent());

					$.ceDialog('get_last').ceDialog('close');
				}
			}

			
		});

		// Init sortable zones
		_self.calculateLevels();

		// Correct control menues
		_self.checkMenuItems($('.' + params.grid_class));

		$('.' + _init_params.block_class).each(function(){
			_self.setBlockHeaderWidth($(this));
		});
	};
	
	this.sendRequest = function(mode, action, data)
	{
		if (mode == 'grid') {
			// Re-create "clear" divs to make correct grid lines
			var clears_data = {
				containers: {},
				grids: {}
			};

			// Remove all "clear" div's
			$('.' + _init_params.container_class + ' > div.clear').remove();

			// We need only first element of each grid blocks
			$('.' + _init_params.grid_class + ':first-child').each(function(){
				var jelm = $(this);
				var parent_type = _determineElementType(jelm.parent());

				if (parent_type.type == 'container') {
					var max_width = parseInt(jelm.parent().attr('class').match(/container_([0-9]+)/i)[1]);
				} else {
					var max_width = parseInt(jelm.parent().attr('class').match(/grid_([0-9]+)/i)[1]);
				}

				var current_width = 0;
				var last_grid = {};

				jelm.parent().find('>.' + _init_params.grid_class).each(function(){
					var grid = $(this);
					var grid_width = parseInt(grid.attr('class').match(/grid_([0-9]+)/i)[1]);
					var grid_prefix = grid.attr('class').match(/prefix_([0-9]+)/i);
					var grid_suffix = grid.attr('class').match(/suffix_([0-9]+)/i);
					
					grid_prefix = (grid_prefix == null) ? 0 : parseInt(grid_prefix[1]);
					grid_suffix = (grid_suffix == null) ? 0 : parseInt(grid_suffix[1]);

					grid_width += grid_prefix + grid_suffix;
					
					if (current_width + grid_width > max_width) {
						if (grid.prev().length > 0) {
							var clear_id = grid.prev().attr('id').replace('grid_', '');

							if (clear_id != '') {
								clears_data.grids[clear_id] = true;
							}
							$('<div class="clear"></div>').insertBefore(grid);
						}

						current_width = grid_width;

					} else {
						current_width += grid_width;
					}

					last_grid = grid;
				});

				if (last_grid.length > 0) {
					var clear_id = last_grid.attr('id').replace('grid_', '');
					if (typeof(clears_data.grids[clear_id]) == 'undefined') {
						clears_data.grids[clear_id] = true;
						$('<div class="clear"></div>').insertAfter(last_grid);
					}
				}
				
			});

			$('.' + _init_params.container_class).each(function(){
				var container_id = $(this).attr('id').replace('container_', '');
				clears_data.containers[container_id] = true;
			});

			//$('<div class="clear"></div>').insertBefore($('.grid-control-menu, .block-control-menu'));
			data.clears_data = clears_data;
		}
		
		var controller = typeof(data['controller']) == 'undefined' ? 'block_manager.' : data['controller'] + '.';

		// Hide all active tooltips
		$('.cm-tooltip').data('tooltip').hide();
		$('.tooltip').hide();

		$.ajaxRequest(fn_url(controller + mode + '.' + action), {
			data: data,
			callback: _parseResponse,
			method: 'post'
		});
	};

	this.calculateLevels = function()
	{
		// Re-init sortable zones
		$(_init_params.containers).sortable('destroy');

		$('.' + _init_params.grid_class).each(function(){
			var jelm = $(this);
			var level = _self.getLevel($(this));

			jelm.attr('class', jelm.attr('class').replace(/level-[0-9]+/, ''));
			jelm.addClass('level-' + level);
			
			if (level > 0) {
				_self.calculateAlphaOmega(jelm);
			}

			if (jelm.find('.grid').length == 0) {
				jelm.addClass('cm-sortable-grid');
			} else {
				jelm.removeClass('cm-sortable-grid');
			}
		});
		
		// Re-init droppable zone
		$('.cm-sortable-grid').sortable(_init_params);
	};
	
	this.getLevel = function(elm)
	{
		var level = 1;
		while (!elm.parent().hasClass(_init_params.container_class)) {
			elm = elm.parent();
			level++;
		}
		
		return level;
	};
	
	this.calculateAlphaOmega = function(block)
	{
		var items = block.children('.' + _init_params.grid_class);
		var width = block.attr('class').match(/grid_([0-9]+)/i)[1];
		
		var line_width = 0;
		var index = 1;
		var alpha = false;
		var omega = false;
		
		items.each(function(){
			var jelm = $(this);
			
			var elm_width = parseInt(jelm.attr('class').match(/grid_([0-9]+)/i)[1]);
			var elm_prefix = jelm.attr('class').match(/prefix_([0-9]+)/i);
			var elm_suffix = jelm.attr('class').match(/suffix_([0-9]+)/i);
			
			elm_prefix = (elm_prefix == null) ? 0 : parseInt(elm_prefix[1]);
			elm_suffix = (elm_suffix == null) ? 0 : parseInt(elm_suffix[1]);
			
			elm_width += elm_prefix + elm_suffix;
			
			jelm.removeClass('alpha').removeClass('omega');
			
			if (!alpha) {
				jelm.addClass('alpha');
				alpha = true;
			}
			
			if ((line_width + elm_width) == width) {
				jelm.addClass('omega');
				alpha = false;
				
				line_width = 0;

			} else if ((line_width + elm_width) > width) {
				jelm.addClass('alpha');

				if (elm_width != width) {
					alpha = true;
				} else {
					alpha = false;
				}

				line_width = 0;

			} else {
				line_width += elm_width;
			}

			if (index == items.length) {
				jelm.addClass('omega');
			}

			index++;
		});
	};
	
	this.getPropertyValue = function(property, elm)
	{
		var value = '';
		elm = elm || _hover_element;
		
		if (property == 'columns') {
			value = elm.attr('class').match(/container_/) ? parseInt(elm.attr('class').match(/container_([0-9]+)/i)[1]) : 0;
			
		} else if (property == 'width') {
			value = elm.attr('class').match(/grid_/) ? parseInt(elm.attr('class').match(/grid_([0-9]+)/i)[1]) : 0;
			
		} else if (property == 'alpha') {
			value = elm.attr('class').match(/alpha/i) ? '1' : '0';
			
		} else if (property == 'omega') {
			value = elm.attr('class').match(/omega/i) ? '1' : '0';
		
		} else if (property == 'prefix') {
			value = elm.attr('class').match(/prefix_/) ? parseInt(elm.attr('class').match(/prefix_([0-9]+)/i)[1]) : 0;
			
		} else if (property == 'suffix') {
			value = elm.attr('class').match(/suffix_/) ? parseInt(elm.attr('class').match(/suffix_([0-9]+)/i)[1]) : 0;

		} else if (property == 'user_class') {
			value = elm.attr('user_class');
		}
		
		return value;
	};
	
	this.saveProperties = function(type, data)
	{
		switch (type) {
			case 'grid':
				if (typeof(data['grid_id']) == 'undefined') {
					elm = $('<div class="grid" id="new_element">' + $('.base-grid').html() + '</div>');
					if (_hover_element.find('.grid:last').length) {
						elm.insertAfter(_hover_element.find('>.grid:last'));
					} else {
						elm.prependTo(_hover_element);
					}
				} else {
					elm = _hover_element;
				}

				for (var key in data) {
					var value = data[key];
					if (key == 'width') {
						var elm_class = elm.attr('class').replace(/grid_[0-9]+/, ''); //Get element class without "grid_N" class
						elm_class += ' grid_' + value;
						elm.attr('class', elm_class);

					} else if (key == 'prefix') {
						var elm_class = elm.attr('class').replace(/prefix_[0-9]+/, ''); //Get element class without "prefix_N" class
						if (value > 0) {
							elm_class += ' prefix_' + value;
						}
						elm.attr('class', elm_class);

					} else if (key == 'suffix') {
						var elm_class = elm.attr('class').replace(/suffix_[0-9]+/, ''); //Get element class without "suffix_N" class
						if (value > 0) {
							elm_class += ' suffix_' + value;
						}
						elm.attr('class', elm_class);

					} else if (key == 'content_align') {
						blocks = elm.find('.' + _init_params.block_class);
						if (value == 'LEFT') {
							blocks.removeClass('float-right').addClass('float-left');

						} else if (value == 'RIGHT') {
							blocks.removeClass('float-left').addClass('float-right');

						} else {
							blocks.removeClass('float-left').removeClass('float-right');
						}
					}
				}

				// Rebuild menu for new element according to the new settings
				_self.buildMenu(elm);
				_self.checkMenuItems(elm.parent());

				break;

			case 'container':
				for (var key in data) {
					var value = data[key];

					if (key == 'container_data[width]') {
						var elm_class = _hover_element.attr('class').replace(/container_[0-9]+/, ''); //Get element class without "container_N" class
						elm_class += ' container_' + value;
						_hover_element.attr('class', elm_class);
					}
				}
				break;
			
			default: break;
		}

		_self.calculateLevels();
		_self.buildMenu(_hover_element);

		$('.' + _init_params.block_class, _hover_element).each(function(){
			_self.buildMenu($(this));
			_self.setBlockHeaderWidth($(this));
		});

		return data;
	};

	this.deleteStructure = function(element)
	{
		element = element || _hover_element;
		var elm_data = _determineElementType(element);

		if (elm_data.type == 'grid') {
			var snappings = {};
			var grids = $(element).parent().find('.' + _init_params.grid_class);

			grids.each(function(){
				jelm = $(this);
				var grid_id = jelm.attr('id').replace('grid_', '');
				var action = (grid_id == element.attr('id').replace('grid_', '')) ? 'delete' : 'update';

				snappings[grid_id] = {
					action: action,
					grid_data: {
						grid_id: grid_id
					}
				};


			});
			
			// Delete grid and recalculate levels and alpha/omega parameters
			var parent_grid = element.parent();

			element.remove();
			_self.calculateLevels();
			_self.checkMenuItems(parent_grid);

			for (var i in snappings) {
				if (snappings[i].action == 'delete') {
					$('#grid_' + snappings[i].grid_data.grid_id).remove();
				} else {
					jelm = $('#grid_' + snappings[i].grid_data.grid_id);
					if (jelm.length > 0) {
						// We can remove parent grid with other grids inside
						snappings[i].grid_data.alpha = _self.getPropertyValue('alpha', jelm);
						snappings[i].grid_data.omega = _self.getPropertyValue('omega', jelm);
					}
				}
			}
			
			return snappings;

		} else if (elm_data.type == 'block') {
			var snappings = {
				0: {
					action: 'delete',
					snapping_id: element.attr('id').replace('snapping_', '')
				}
			};

			var parent_grid = $('#snapping_' + snappings[0].snapping_id).parent();
			$('#snapping_' + snappings[0].snapping_id).remove();
			
			_self.checkMenuItems(parent_grid);

			return snappings;
		}

		return false;
	};
	
	this.getMaxWidth = function(elm, is_new)
	{
		var width = 0;

		elm = elm || _hover_element;
		is_new = is_new || false;

		if (elm.hasClass(_init_params.block_class)) {
			elm = elm.parent();
		}
		
		if (elm.hasClass(_init_params.container_class)) {
			width = parseInt(elm.attr('class').match(/container_([0-9]+)/i)[1]);
			
		} else if (elm.hasClass(_init_params.grid_class)) {
			if (is_new) {
				width = parseInt(elm.attr('class').match(/grid_([0-9]+)/i)[1]);
			} else {
				if (elm.parent().hasClass('container')) {
					width = parseInt(elm.parent().attr('class').match(/container_([0-9]+)/i)[1]);
				} else {
					width = parseInt(elm.parent().attr('class').match(/grid_([0-9]+)/i)[1]);
				}
			}
		}
		
		return width;
	};

	this.snapGrid = function(grid)
	{
		if (typeof(grid.grid_id) == 'undefined') {
			var selector = '#new_element';
		} else {
			var selector = '#grid_' + grid.grid_id;
		}

		var snapping = {};
		var grids = $(selector).parent().find('>.grid');
		
		grids.each(function() {
			var _grid = $(this);
			var id = _grid.index();

			snapping[id] = {};
			snapping[id].grid_data = {};

			if (_grid.attr('id') == 'new_element') {
				snapping[id].action = 'add';
				for (var i in grid) {
					snapping[id].grid_data[i] = grid[i];
				}
			} else {
				if (grid['grid_id'] == _grid.attr('id').replace('grid_', '')) {
					// Move data from form to updating snapping data
					snapping[id].grid_data = grid;
				}

				snapping[id].action = 'update';
				snapping[id].grid_data.grid_id = _grid.attr('id').replace('grid_', '');

			}
			
			snapping[id].grid_data.alpha = _self.getPropertyValue('alpha', _grid);
			snapping[id].grid_data.omega = _self.getPropertyValue('omega', _grid);
		});

		return {snappings: snapping};
	};

	this.buildMenu = function(element)
	{
		// You must control this functionality when changing anything in control menu

		// Rebuild menu if width of element doesn't allow to use "full width" menu
		var type = _determineElementType(element).type;

		var width = 0;
		if (type == 'grid') {
			width = _self.getPropertyValue('width', element);

			// Change header title from "GRID X" to "GRID Y"
			var title = $('> .grid-control-menu > .grid-control-title', element).html();

			title = title.replace(/[0-9]+/, width);
			$('> .grid-control-menu > .grid-control-title', element).html(title);

		} else if (type == 'block') {
			width = _self.getPropertyValue('width', element.parent());
		}

		if (width >= 1 && width <= 2) {
			$('> .bm-full-menu', element).hide();
			$('> .bm-compact-menu', element).show();
			$('> .grid-control-title', element).hide();
		} else if (width > 0) {
			$('> .bm-full-menu', element).show();
			$('> .bm-compact-menu', element).hide();
			$('> .grid-control-title', element).show();
		}
		
		return true;
	};

	this.checkMenuItems = function(elements)
	{
		elements.each(function(){
			var jelm = $(this);

			var has_blocks = $('> .block', jelm).length > 0 ? true : false;
			var has_grids = $('> .grid', jelm).length > 0 ? true : false;
			
			$('> .bm-control-menu .bm-action-add-block, > .bm-control-menu .bm-action-add-grid', jelm).show();
			if (has_blocks) {
				$('> .bm-control-menu .bm-action-add-grid', jelm).hide();
			}

			if (has_grids) {
				$('> .bm-control-menu .bm-action-add-block', jelm).hide();
			}
		});
	};

	this.setBlockHeaderWidth = function(block)
	{
		var grid = block.parent().attr('class').match(/grid_([0-9]+)/i);
		if (grid !== null) {
			var width = parseInt(grid[1]);
			
			if (width == 1) {
				$('.block-header-icon,.block-header-title', block).hide();
			} else {
				$('.block-header-icon,.block-header-title', block).show();
			}

			$('.block-header-title', block).css('width', block.width() - 55 + 'px');
		}
	};
}

// We need external function to be able to call them in callbacks
// Grid updating
function fn_form_post_grid_update_form(frm, c_elm)
{
	var form_data = $(frm).serializeObject();
	form_data = BlockManager.saveProperties('grid', form_data);

	var grids_snapping = BlockManager.snapGrid(form_data);

	BlockManager.sendRequest('grid', 'update', grids_snapping);

	return false;
}

// Container updating
function fn_form_post_container_update_form(frm, c_elm)
{
	var form_data = $(frm).serializeObject();
	form_data = BlockManager.saveProperties('container', form_data);

	BlockManager.sendRequest('container', 'update', form_data);

	return false;
}

function fn_ui_update_placeholder(ui, element)
{
	ui.placeholder.removeClass('float-right').removeClass('float-left');

	if (element.hasClass('bm-right-align')) {
		ui.placeholder.addClass('float-right');
	} else if (element.hasClass('bm-left-align')) {
		ui.placeholder.addClass('float-left');
	}

	return true;
}
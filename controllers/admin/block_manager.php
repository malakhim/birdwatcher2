<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

if ( !defined('AREA') )	{ die('Access denied');	}

$default_location = Bm_Location::instance()->get_default(DESCR_SL);

if (isset($_REQUEST['selected_location']) 
	&& !empty($_REQUEST['selected_location']) 
	&& (PRODUCT_TYPE != 'ULTIMATE' || PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID') && Bm_Location::check_owner($_REQUEST['selected_location'], COMPANY_ID))) {
	
	$selected_location = Bm_Location::instance()->get_by_id($_REQUEST['selected_location'], DESCR_SL);
} else {
	$selected_location = $default_location;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (defined('AJAX_REQUEST')) {
		$result = false;
		if ($mode == 'block') {
			if ($action == 'update' && isset($_REQUEST['block_data'])) {
				$result = Bm_Block::instance()->update($_REQUEST['block_data']);
			} elseif ($action == 'delete' && isset($_REQUEST['block_id'])) {
				$result = Bm_Block::instance()->remove($_REQUEST['block_id']);
			}
		} 

		if ($mode == 'location') {
			if ($action == 'update' && isset($_REQUEST['location_data'])) {
				$result = Bm_Location::instance()->update($_REQUEST['location_data']);
			} elseif ($action == 'delete' && isset($_REQUEST['location_id'])) {
				$result = Bm_Location::instance()->remove($_REQUEST['location_id']);
			}
		}

		if ($mode == 'grid' && isset($_REQUEST['snappings']) && is_array($_REQUEST['snappings'])) {
			foreach($_REQUEST['snappings'] as $snapping_data) {
				if (!empty($snapping_data['action'])) {
					
					if ($snapping_data['action'] == 'update' || $snapping_data['action'] == 'add') {
						$result = Bm_Grid::update($snapping_data['grid_data']);

						if (is_numeric($result)) {
							$ajax->assign('id', intval($result));
						}
					} elseif ($snapping_data['action'] == 'delete' && !empty($snapping_data['grid_data']['grid_id'])) {
						$result = Bm_Grid::remove($snapping_data['grid_data']['grid_id']);
					}
				}
			}
		}

		if ($mode == 'container') {
			if (
				$action == 'update' 
				&& isset($_REQUEST['container_data']['container_id']) 
				&& isset($_REQUEST['container_data']['width'])
			) {
				$result = Bm_Container::instance()->update($_REQUEST['container_data']);
			}
		}

		if ($mode == 'snapping' && isset($_REQUEST['snappings']) && is_array($_REQUEST['snappings'])) {
			foreach($_REQUEST['snappings'] as $snapping_data) {
				if (!empty($snapping_data['action'])) {
					if ($snapping_data['action'] == 'update' || $snapping_data['action'] == 'add') {
						$snapping_id = Bm_Block::instance()->update_snapping($snapping_data);

						if ($snapping_data['action'] == 'add') {
							$result = $snapping_id;
						}
					} elseif ($snapping_data['action'] == 'delete' && !empty($snapping_data['snapping_id'])) {
						$result = Bm_Block::instance()->remove_snapping($snapping_data['snapping_id']);
					}
				}
			}
		}

		if (!empty($_REQUEST['clears_data'])) {
			Bm_Grid::set_clear_divs($_REQUEST['clears_data']);
		}
	}

	fn_trusted_vars(
		'block',
		'block_items',
		'block_data'
	);

	$suffix = '';

	if ($mode == 'update_block') {
		$description = array();
		if (!empty($_REQUEST['block_data']['description'])) {
			$_REQUEST['block_data']['description']['lang_code'] = DESCR_SL;
			$description = $_REQUEST['block_data']['description'];
		}
		
		if (!empty($_REQUEST['block_data']['content_data'])) {
			$_REQUEST['block_data']['content_data']['lang_code'] = DESCR_SL;
			if (isset($_REQUEST['block_data']['content'])) {
				$_REQUEST['block_data']['content_data']['content'] = $_REQUEST['block_data']['content'];
			}
		}

		if (!empty($_REQUEST['dynamic_object']['object_id']) && $_REQUEST['dynamic_object']['object_id'] > 0) {
			unset($_REQUEST['block_data']['properties']);
		}

		$block_id = Bm_Block::instance()->update($_REQUEST['block_data'], $description);

		if (!empty($_REQUEST['snapping_data'])) {
			// If block was newly created, and it must be snapped to grid, do it
			$snapping_data = $_REQUEST['snapping_data'];
			$snapping_data['block_id'] = $block_id;

			Bm_Block::instance()->update_snapping($snapping_data);
		}

		if (defined('AJAX_REQUEST')) {
			if (!empty($_REQUEST['dynamic_object'])) {
				$dynamic_object = $_REQUEST['dynamic_object'];
			} else {
				$dynamic_object = array();
			}

			$block_data = Bm_Block::instance()->get_by_id($block_id, 0, $dynamic_object, DESCR_SL);

			if (!empty($_REQUEST['assign_to'])) {
				$view->assign('block_data', $block_data);
				$view->assign('external_render', true);
				$ajax->assign_html($_REQUEST['assign_to'], $view->fetch('views/block_manager/render/block.tpl'));
			}

			$result = $block_id;
		} else {
			if (!empty($_REQUEST['r_url'])) {
				return array(CONTROLLER_STATUS_OK, $_REQUEST['r_url']);
			}

			// Redirect to dynamic object edit page
			if (!empty($_REQUEST['dynamic_object']['object_id']) && !empty($_REQUEST['dynamic_object']['object_type'])) {
				$scheme = Bm_SchemesManager::get_dynamic_object_by_type($_REQUEST['dynamic_object']['object_type']);
				$return_url = $scheme['admin_dispatch'] .
					'?' . $scheme['key'] . '=' . $_REQUEST['dynamic_object']['object_id'];
				
				if (!empty($_REQUEST['tab_redirect'])) {
					$return_url .= '&selected_section=product_tabs';
				} else {
					$return_url .= '&selected_section=blocks';
				}
					
				return array(CONTROLLER_STATUS_OK, $return_url);
			}
			
			$suffix .= "&selected_location=" . $selected_location['location_id'];
		}
	}

	if ($mode == 'update_location') {
		$_REQUEST['location_data']['lang_code'] = DESCR_SL;
		$location_id = Bm_Location::instance()->update($_REQUEST['location_data']);
		
		$suffix .= "&selected_location=" . $location_id;
	}

	if ($mode == 'export_locations') {
		$location_ids = isset($_REQUEST['location_ids']) ? $_REQUEST['location_ids'] : array();

		$content = Bm_Exim::instance()->export($location_ids, $_REQUEST);

		$filename = empty($_REQUEST['filename']) ? date_format(TIME, "%m%d%Y") . 'xml' : $_REQUEST['filename'];

		if (defined('COMPANY_ID')) {
			$filename = COMPANY_ID . '/' . $filename;
		}

		fn_mkdir(dirname(DIR_ROOT . '/var/layouts/' . $filename));
		file_put_contents(DIR_ROOT . '/var/layouts/' . $filename, $content);

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_exim_data_exported'));

		// Direct download
		if ($_REQUEST['output'] == 'D') {
			fn_redirect(fn_url('block_manager.manage?meta_redirect_url=block_manager.get_file%26filename=' . $_REQUEST['filename']));

		// Output to screen
		} elseif ($_REQUEST['output'] == 'C') {
			fn_redirect(fn_url('block_manager.get_file?to_screen=Y&filename=' . $_REQUEST['filename']));
		}

	} elseif ($mode == 'import_locations') {
		$data = fn_filter_uploaded_data('filename');
		
		if (!empty($data[0]['path'])) {
			$result = Bm_Exim::instance()->import_from_file($data[0]['path'], $_REQUEST);

			if ($result) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_exim_data_imported_clear'));
			}
		}
	}

	if (defined('AJAX_REQUEST')) {
		if ($result === true) {
			$ajax->assign('status', 'OK');
		} elseif (is_numeric($result)) {
			$ajax->assign('id', intval($result));
			$ajax->assign('status', 'OK');
		} else {
			$ajax->assign('status', 'FAIL');
		}

		$ajax->assign('mode', $mode);
		$ajax->assign('action', $action);

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_changes_saved'));

		exit;
	}

	return array(CONTROLLER_STATUS_OK, "block_manager.manage" . $suffix);
}

if ($mode == 'manage' || $mode == 'manage_in_tab') {
	if (!(PRODUCT_TYPE == 'MULTIVENDOR' && defined('SELECTED_COMPANY_ID') && SELECTED_COMPANY_ID != 'all') && isset($_REQUEST['dynamic_object']['object_type'])) {
		$dynamic_object = Bm_SchemesManager::get_dynamic_object_by_type($_REQUEST['dynamic_object']['object_type']);
	} else {
		$dynamic_object = '';
	}

	if (!empty($dynamic_object)) {
		// If it is some dynamic object, such as product with some id
		$dynamic_object_data = array();
		if (!empty($_REQUEST['dynamic_object'])) {
			$dynamic_object_data = $_REQUEST['dynamic_object'];
		}

		$selected_location = Bm_Location::instance()->get($dynamic_object['customer_dispatch'], $dynamic_object_data, DESCR_SL);
		$view->assign('location', $selected_location);
		
		$view->assign('dynamic_object', $dynamic_object_data);
		$view->assign('dynamic_object_scheme', $dynamic_object);
	} else {
		// If it is all another block manager
		$locations = Bm_Location::instance()->get_list(array('*'), '', ' ORDER BY is_default DESC, name ASC', DESCR_SL);
		$view->assign('locations', $locations);

		// Set tabs content
		// [Page sections]
		if (!empty($locations)) {
			foreach ($locations as $location => $_location) {
				Registry::set("navigation.tabs.location_". $_location['location_id'], array (
					'title' => $_location['name'],
					'href' => "block_manager.manage?selected_location=" . $_location['location_id']
				));
			}
		}
		// [/Page sections]
	}

	$view->assign('location', $selected_location);

	if (!empty($_REQUEST['dynamic_object'])) {
		$view->assign('dynamic_object', $_REQUEST['dynamic_object']);
	}
	$view->assign('dynamic_object_scheme', Bm_SchemesManager::get_dynamic_object($selected_location['dispatch'], 'C'));	

} elseif ($mode == 'update_block') {
	$snapping_data = array();

	$editable_content = true;
	$editable_template_name = true;
	$editable_wrapper = false;

	if (!empty($_REQUEST['dynamic_object'])) {
		$dynamic_object = $_REQUEST['dynamic_object'];
		$editable_template_name = false;
	} else {
		$dynamic_object = array();
	}

	if (!empty($_REQUEST['snapping_data']['snapping_id'])) {
		$snapping_data = Bm_Block::instance()->get_snapping_data(
			array('?:bm_blocks.type as type', '?:bm_blocks.block_id as block_id', '?:bm_snapping.*'), 
			$_REQUEST['snapping_data']['snapping_id']
		);
		$type = isset($snapping_data['type']) ? $snapping_data['type'] : 'html_block';
		$block_id = isset($snapping_data['block_id']) ? $snapping_data['block_id'] : 0;
		$snapping_id = $_REQUEST['snapping_data']['snapping_id'];
	} else {		
		$block_id = isset($_REQUEST['block_data']['block_id']) ? $_REQUEST['block_data']['block_id'] : 0;

		if (!empty($_REQUEST['snapping_data'])) {
			$snapping_data = $_REQUEST['snapping_data'];
		}
		$snapping_id = 0;
	}	
	
	$content = array();
	
	if (!empty($_REQUEST['block_data']['content_data'])) {
		$content = $_REQUEST['block_data']['content_data'];
	}

	// If edit block
	if ($block_id > 0) {
		if (!empty($_REQUEST['snapping_data']['snapping_id'])) {
			$editable_wrapper = true;
		}

		$block_data = Bm_Block::instance()->get_by_id($block_id, $snapping_id, $dynamic_object, DESCR_SL);

		if (!empty($block_data['content']) && empty($content['content'])) {
			$content['content'] = $block_data['content'];
		}

		$type = $block_data['type'];
		$view->assign('changed_content_stat', Bm_Block::instance()->get_changed_contents_count($block_id, true));
	} else {
		$type = isset($_REQUEST['block_data']['type']) ? $_REQUEST['block_data']['type'] : 'html_block';

		$block_data = array(
			'type' => $type,
			'block_id' => 0
		);
	}
	
	if (!empty($_REQUEST['block_data']['description']['name'])) {
		$block_data['name'] = $_REQUEST['block_data']['description']['name'];
	}

	if (!empty($_REQUEST['block_data']['properties'])) {
		$block_data['properties'] = $_REQUEST['block_data']['properties'];
	}

	if (!empty($_REQUEST['block_data']['content'])) {
		$block_data['content'] = $_REQUEST['block_data']['content'];
	}
	
	$block_scheme =  Bm_SchemesManager::get_block_scheme($type, isset($_REQUEST['block_data']) ? $_REQUEST['block_data'] : $block_data, true);

	// Set template as first default from scheme
	if (empty($block_data['properties']['template']) && isset($block_scheme['templates'])) {
		if (is_array($block_scheme['templates'])) {
			$block_data['properties']['template'] = current(array_keys($block_scheme['templates']));
		} else {
			$block_data['properties']['template'] = $block_scheme['templates'];			
		}
		$block_scheme['content'] = Bm_SchemesManager::prepare_content($block_scheme, $block_data);
	}	
	
	// Set content_type as first default from scheme
	if (empty($block_data['properties']['content_type']) && !empty($block_scheme['content'])) {
		$block_data['properties']['content_type'] = current(array_keys($block_scheme['content']));
	} 

	// Set filing as first default from scheme
	if (isset($block_scheme['content']) && is_array($block_scheme['content'])) {
		foreach($block_scheme['content'] as $name => $scheme) {		
			if (isset($scheme['type']) && $scheme['type'] == 'enum') {
				$fillings = array_keys($scheme['fillings']);
				if ((!empty($block_data['content'][$name]['filling']) && array_search($block_data['content'][$name]['filling'], $fillings) === FALSE) || empty($block_data['content'][$name]['filling']))  {
					$block_data['content'][$name]['filling'] = current($fillings);
				}
			}
		}
	}

	$view->assign('dynamic_object_scheme', Bm_SchemesManager::get_dynamic_object($selected_location['dispatch'], 'C'));	
	
	if (!empty($_REQUEST['hide_status'])) {		
		$view->assign('hide_status', 1);
	}

	$view->assign('location', $selected_location);
	$view->assign('editable_content', $editable_content);
	$view->assign('editable_template_name', $editable_template_name);
	$view->assign('editable_wrapper', $editable_wrapper);

	$view->assign('block', $block_data);
	$view->assign('snapping_data', $snapping_data);
	$view->assign('block_scheme', $block_scheme);
	if (defined('AJAX_REQUEST')) {
		$view->display('views/block_manager/update_block.tpl');
		exit;
	} 
} elseif ($mode == 'update_grid') {
	if (!empty($_REQUEST['grid_data']['grid_id'])) {
		// Update existing grid
		$grid = Bm_Grid::get_by_id($_REQUEST['grid_data']['grid_id'], DESCR_SL);

		$view->assign('grid', $grid);
	}

	$view->assign('params', $_REQUEST['grid_data']);

} elseif ($mode == 'update_container') {
	if (!empty($_REQUEST['container_id'])) {
		// Update existing container
		$container = Bm_Container::instance()->get_by_id($_REQUEST['container_id']);

		$view->assign('container', $container);
	}

} elseif ($mode == 'update_location') {

	$location_data = array(
		'dispatch' => ''
	);

	if (!empty($_REQUEST['location'])) {
		$location_data = Bm_Location::instance()->get_by_id($_REQUEST['location'], DESCR_SL);
	}

	if (isset($_REQUEST['location_data']['dispatch'])) {
		$location_data['dispatch'] = $_REQUEST['location_data']['dispatch'];
		$location_data['object_ids'] = "";
	}

	$view->assign('location', $location_data);
	$view->assign('dynamic_object_scheme', Bm_SchemesManager::get_dynamic_object($location_data['dispatch'], 'C'));	
	$view->assign('dispatch_descriptions', Bm_SchemesManager::get_dispatch_descriptions());

	if (defined('AJAX_REQUEST')) {
		$view->display('views/block_manager/update_location.tpl');
		exit;
	} 
} elseif ($mode == 'delete_location' && !empty($_REQUEST['location_id'])) {
	Bm_Location::instance()->remove($_REQUEST['location_id']);
	
	fn_redirect('block_manager.manage');

} elseif ($mode == 'block_selection') {
	if (!empty($_REQUEST['on_product_tabs'])) {
		$selected_location['dispatch'] = 'product_tabs';
	}

	$unique_blocks = Bm_SchemesManager::filter_by_location(Bm_Block::instance()->get_all_unique(DESCR_SL), $selected_location);
	$block_types = Bm_SchemesManager::filter_by_location(Bm_SchemesManager::get_block_types(DESCR_SL), $selected_location);

	if (!empty($_REQUEST['grid_id'])) {
		$view->assign('grid_id', $_REQUEST['grid_id']);	
	}

	if (!empty($_REQUEST['extra_id'])) {
		$view->assign('extra_id', $_REQUEST['extra_id']);	
	}

	$view->assign('block_types', $block_types);	
	$view->assign('unique_blocks', $unique_blocks);

} elseif ($mode == 'export_locations') {
	$locations = Bm_Location::instance()->get_list(array('*'), '', ' ORDER BY is_default DESC', DESCR_SL);
	$view->assign('locations', $locations);

} elseif ($mode == 'get_file' && !empty($_REQUEST['filename'])) {
	$file = fn_basename($_REQUEST['filename']);
	if (defined('COMPANY_ID')) {
		$file = COMPANY_ID . '/' . $file;
	}

	if (!empty($_REQUEST['to_screen'])) {
		header("Content-type: text/xml");
		readfile(DIR_ROOT . '/var/layouts/' . $file);
		exit;

	} else {
		fn_get_file(DIR_ROOT . '/var/layouts/' . $file);
	}

} elseif ($mode == 'show_objects') {
	if (!empty($_REQUEST['object_type']) && !empty($_REQUEST['block_id'])) {
		$view->assign('object_type', $_REQUEST['object_type']);
		$view->assign('block_id', $_REQUEST['block_id']);
		$view->assign('object_ids', Bm_Block::instance()->get_changed_contents_ids($_REQUEST['object_type'], $_REQUEST['block_id']));
		$view->assign('params', array('type' => 'links'));
		$view->assign('dynamic_object_scheme', Bm_SchemesManager::get_dynamic_object_by_type($_REQUEST['object_type']));
	}

} elseif ($mode == 'update_status') {
	
	Bm_Block::instance()->update_status($_REQUEST);
	
	exit;

}

function fn_get_parent_group($block_id, $object_id, $location)
{
	fn_generate_deprecated_function_notice('fn_get_parent_group()', 'Block Manager classes');
}

function fn_update_block($block, $selected_location = 'all_pages', $current_location = 'all_pages')
{
	fn_generate_deprecated_function_notice('fn_update_block()', 'Block Manager classes');
}

function fn_delete_block($block_id)
{
	fn_generate_deprecated_function_notice('fn_delete_block()', 'Block Manager classes');
}

function fn_save_block_location($positions, $block_id = 0, $object_id = 0, $user_choice = 'N', $section = 'all_pages')
{
	fn_generate_deprecated_function_notice('fn_save_block_location()', 'Block Manager classes');
}

function fn_block_bulk_actions($block_id, $action)
{
	fn_generate_deprecated_function_notice('fn_block_bulk_actions()', 'Block Manager classes');
}

function fn_get_block_data($block_id, $lang_code = CART_LANGUAGE, $descr = false, $location = '')
{
	fn_generate_deprecated_function_notice('fn_get_block_data()', 'Block Manager classes');
}

function fn_process_specific_settings($settings, $section = '', $object = '')
{
	fn_generate_deprecated_function_notice('fn_process_specific_settings()', 'Block Manager classes');
}
?>
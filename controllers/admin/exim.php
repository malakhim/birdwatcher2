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


if ( !defined('AREA') ) { die('Access denied'); }

// Set line endings autodetection
ini_set('auto_detect_line_endings', true);
set_time_limit(3600);

if (empty($_SESSION['export_ranges'])) {
	$_SESSION['export_ranges'] = array();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$suffix = '';

	$layout_data = !empty($_REQUEST['layout_data']) ? $_REQUEST['layout_data'] : array();
	//
	// Select layout
	//
	if ($mode == 'set_layout') {
		db_query("UPDATE ?:exim_layouts SET active = 'N' WHERE pattern_id = ?s", $layout_data['pattern_id']);
		db_query("UPDATE ?:exim_layouts SET active = 'Y' WHERE layout_id = ?i", $layout_data['layout_id']);
		return array(CONTROLLER_STATUS_OK, "exim.export?section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]");
	}

	//
	// Store layout
	//
	if ($mode == 'store_layout') {
		if (!empty($layout_data['cols'])) {
			$layout_data['cols'] = implode(',', $layout_data['cols']);
			$_data = fn_check_table_fields($layout_data, 'exim_layouts', 'main', 'layout_id');

			// Update current layout
			if ($action == 'save_as') {
				if (!empty($layout_data['name'])) {
					db_query("UPDATE ?:exim_layouts SET active = 'N' WHERE pattern_id = ?s", $layout_data['pattern_id']);
					$_data['active'] = 'Y';
					db_query("INSERT INTO ?:exim_layouts ?e", $_data);

					return array(CONTROLLER_STATUS_OK, "exim.export?section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]");
				}
			} else {
				if (!empty($layout_data['layout_id'])) {
					unset($_data['name']);
					db_query("UPDATE ?:exim_layouts SET ?u WHERE layout_id = ?i", $_data, $layout_data['layout_id']);
				}
			}
		}
		$suffix = ".export?section=$_REQUEST[section]&pattern_id=$layout_data[pattern_id]";
	}

	//
	// Perform export
	//
	if ($mode == 'export') {
		$_suffix = '';
		if (!empty($layout_data['cols'])) {
			$pattern = fn_get_pattern_definition($layout_data['pattern_id'], 'export');
			
			if (empty($pattern)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_not_found'));
				exit;
			}

			if (!empty($_SESSION['export_ranges'][$pattern['section']])) {
				if (empty($pattern['condition'])) {
					$pattern['condition'] = array();
				}

				$pattern['condition'] = fn_array_merge($pattern['condition'], $_SESSION['export_ranges'][$pattern['section']]['data']);
			}
			
			if (fn_export($pattern, $layout_data['cols'], $_REQUEST['export_options']) == true) {

				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_exim_data_exported'));

				// Direct download
				if ($_REQUEST['export_options']['output'] == 'D') {
					$url = fn_url("exim.get_file?filename=" . $_REQUEST['export_options']['filename']);

				// Output to screen
				} elseif ($_REQUEST['export_options']['output'] == 'C') {
					$url = fn_url("exim.get_file?to_screen=Y&filename=" . $_REQUEST['export_options']['filename']);
				}

				if (defined('AJAX_REQUEST') && !empty($url)) {
					$ajax->assign('force_redirection', $url);

					exit;
				}

				$url = empty($url) ? fn_url('exim.export?section=' . $_REQUEST['section']) : $url;

				return array(CONTROLLER_STATUS_OK, $url);

			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_no_data_exported'));
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_fields_not_selected'));
		}

		exit;
	}

	//
	// Perform import
	//
	if ($mode == 'import') {
		$file = fn_filter_uploaded_data('csv_file');

		if (!empty($file)) {
			if (empty($_REQUEST['pattern_id'])) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_not_found'));
			} else {
				$pattern = fn_get_pattern_definition($_REQUEST['pattern_id'], 'import');
				
				if (($data = fn_get_csv($pattern, $file[0]['path'], $_REQUEST['import_options'])) != false) {

					fn_import($pattern, $data, $_REQUEST['import_options']);
				}
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_no_file_uploaded'));
		}

		return array(CONTROLLER_STATUS_OK, "exim.import?section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]");
	}

	exit;
}


//
// Delete layout
//
if ($mode == 'delete_layout') {
	db_query("DELETE FROM ?:exim_layouts WHERE layout_id = ?i", $_REQUEST['layout_id']);

	return array(CONTROLLER_STATUS_OK, "exim.export?section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]");

} elseif ($mode == 'export') {

	if (empty($_REQUEST['section'])) {
		$_REQUEST['section'] = 'products';
	}

	list($sections, $patterns) = fn_get_patterns($_REQUEST['section'], 'export');
	
	if (empty($sections) && empty($patterns) || (isset($_REQUEST['section']) && empty($sections[$_REQUEST['section']]))) {
		return array(CONTROLLER_STATUS_DENIED);
	}
	
	$pattern_id = empty($_REQUEST['pattern_id']) ? key($patterns) : $_REQUEST['pattern_id'];

	foreach ($patterns as $p_id => $p) {
		Registry::set('navigation.tabs.' . $p_id, array (
			'title' => $p['name'],
			'href' => "exim.export?pattern_id=" . $p_id . '&section=' . $_REQUEST['section'],
			'ajax' => true
		));
	}

	if (!empty($_SESSION['export_ranges'][$pattern_id])) {
		$key = key($_SESSION['export_ranges'][$pattern_id]['data']);
		if (!empty($key)) {
			$view->assign('export_range', count($_SESSION['export_ranges'][$patterns[$pattern_id]['section']]['data'][$key]));
		}
	}

	// Get available layouts
	$layouts = db_get_array("SELECT * FROM ?:exim_layouts WHERE pattern_id = ?s", $pattern_id);

	// Extract columns information
	foreach ($layouts as $k => $v) {
		$layouts[$k]['cols'] = explode(',', $v['cols']);
	}

	// Get export files
	$export_files = fn_get_dir_contents(DIR_EXIM, false, true);
	$result = array();
	foreach ($export_files as $file) {
		$result[] = array (
			'name' => $file,
			'size' => filesize(DIR_EXIM . $file),
		);
	}

	Registry::set('navigation.dynamic.sections', $sections);
	Registry::set('navigation.dynamic.active_section', $_REQUEST['section']);

	$view->assign('export_files', $result);

	$view->assign('pattern', $patterns[$pattern_id]);
	$view->assign('layouts', $layouts);

} elseif ($mode == 'import') {

	if (empty($_REQUEST['section'])) {
		$_REQUEST['section'] = 'products';
	}

	list($sections, $patterns) = fn_get_patterns($_REQUEST['section'], 'import');

	if (empty($sections) && empty($patterns) || (isset($_REQUEST['section']) && empty($sections[$_REQUEST['section']]))) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$pattern_id = empty($_REQUEST['pattern_id']) ? key($patterns) : $_REQUEST['pattern_id'];

	foreach ($patterns as $p_id => $p) {
		Registry::set('navigation.tabs.' . $p_id, array (
			'title' => $p['name'],
			'href' => "exim.import?pattern_id=" . $p_id . '&section=' . $_REQUEST['section'],
			'ajax' => true
		));
	}

	Registry::set('navigation.dynamic.sections', $sections);
	Registry::set('navigation.dynamic.active_section', $_REQUEST['section']);

	$view->assign('pattern', $patterns[$pattern_id]);
	$view->assign('sections', $sections);

} elseif ($mode == 'get_file' && !empty($_REQUEST['filename'])) {
	$file = fn_basename($_REQUEST['filename']);

	if (!empty($_REQUEST['to_screen'])) {
		header("Content-type: text/plain");
		readfile(DIR_EXIM . $file);
		exit;
	} else {
		fn_get_file(DIR_EXIM . $file);
	}

} elseif ($mode == 'delete_file' && !empty($_REQUEST['filename'])) {
	$file = fn_basename($_REQUEST['filename']);
	fn_rm(DIR_EXIM . $file);

	return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'delete_range') {
	unset($_SESSION['export_ranges'][$_REQUEST['section']]);

	return array(CONTROLLER_STATUS_REDIRECT, "exim.export?section=$_REQUEST[section]&pattern_id=$_REQUEST[pattern_id]");

} elseif ($mode == 'select_range') {
	$_SESSION['export_ranges'][$_REQUEST['section']] = array (
		'pattern_id' => $_REQUEST['pattern_id'],
		'data' => array(),
	);
	$pattern = fn_get_pattern_definition($_REQUEST['pattern_id']);

	return array(CONTROLLER_STATUS_REDIRECT, $pattern['range_options']['selector_url']);
	
}

// --------- ExIm core functions ------------------


//
// Import data using pattern
// Parameters:
// @pattern - import/export pattern
// @import_data - data to import
// @options - import options

function fn_import($pattern, $import_data, $options)
{
	$ajax = Registry::get('ajax');
	$processed_data = array (
		'E' => 0, // existent
		'N' => 0, // new
		'S' => 0, // skipped
	);
	
	fn_set_hook('import_pre_moderation', $pattern, $import_data, $options, $processed_data);

	$alt_keys = array();
	$primary_fields = array();
	$table_groups = array();
	$processing_groups = array();
	$default_groups = array();
	$converting_groups = array();
	$pre_inserting_groups = array();
	$post_inserting_groups = array();
	$add_fields = array();
	$primary_object_ids = array();
	$required_fields = array();

	if (!empty($pattern['pre_processing'])) {
		foreach ($pattern['pre_processing'] as $function => $args){
			foreach ($args as $k => $v) {
				if (strpos($v, '@') !== false) {
					$_opt = str_replace('@', '', $v);
					$args[$k] = isset($options[$_opt]) ? $options[$_opt] : '';
				}
				if (strpos($v, '$') !== false) {
					$_opt = str_replace('$', '', $v);
					$args[$k] = isset($$_opt) ? $$_opt : '';
				}
			}

			call_user_func_array($function, $args);
		}
	}

	if (!empty($pattern['references'])) {
		foreach ($pattern['references'] as $table => $data) {
			$table_groups[$table] = $data;
		}
	}

	// Get keys to detect primary record
	foreach ($pattern['export_fields'] as $field => $data) {

		$_db_field = (empty($data['db_field']) ? $field : $data['db_field']);

		// Collect fields with default values
		if (isset($data['default'])) {
			if (is_array($data['default'])) {
				$default_groups[$_db_field] = call_user_func_array(array_shift($data['default']), $data['default']);
			} else {
				$default_groups[$_db_field] = $data['default'];
			}
		}

		// Get alt keys for primary table
		if (!empty($data['alt_key'])) {
			$alt_keys[$field] = $_db_field;
		}

		if (!empty($data['required']) && $data['required'] = true) {
			$required_fields[] = $_db_field;
		}

		if (!isset($data['linked']) || $data['linked'] == true) {
			// Get fields for primary table
			if (empty($data['table']) || $data['table'] == $pattern['table']) {
				$primary_fields[$field] = $_db_field;
			}

			// Group fields by tables
			if (!empty($data['table'])) {
				$table_groups[$data['table']]['fields'][$_db_field] = true;
			}
		}

		// Create set with fields that must be added to data import if they are not exist
		// %'s are for compatibility with %% field type in "process_put" key
		if (!empty($data['use_put_from'])) {
			$_f = str_replace('%', '', $data['use_put_from']);
			$_f = !empty($pattern['export_fields'][$_f]['db_field']) ? $pattern['export_fields'][$_f]['db_field'] : $_f;
			$add_fields[$_f][] = $_db_field;
		}

		// Generate processing groups
		if (!empty($data['process_put'])) {
			$args = $data['process_put'];
			$function = array_shift($args);
			$processing_groups[] = array (
				'function' => $function,
				'args' => $args,
				'this_field' => $_db_field,
				'table' => !empty($data['table']) ? $data['table'] : '',
				'return_result' => !empty($data['return_result']) ? $data['return_result'] : false,
			);
		}

		// Generate converting groups
		if (!empty($data['convert_put'])) {
			$args = $data['convert_put'];
			$function = array_shift($args);
			$converting_groups[] = array (
				'function' => $function,
				'this_field' => $_db_field,
				'args' => $args,
			);
		}

		//Generate pre inserting groups
		if (!empty($data['pre_insert'])) {
			$args = $data['pre_insert'];
			$function = array_shift($args);
			$pre_inserting_groups[] = array (
				'function' => $function,
				'this_field' => $_db_field,
				'args' => $args,
			);
		}

		//Generate post inserting groups
		if (!empty($data['post_insert'])) {
			$args = $data['post_insert'];
			$function = array_shift($args);
			$post_inserting_groups[] = array (
				'function' => $function,
				'this_field' => $_db_field,
				'args' => $args,
			);
		}
	}

	fn_set_progress('total', sizeof($import_data));
	foreach ($import_data as $k => $v) {
		//If the required field is empty skip this record
		foreach ($required_fields as $field) {
			if (empty($v[$field]) && $v[$field] !== 0) {
				$processed_data['S']++;
				continue 2;
			}
		}

		$_alt_keys = array();
		$object_exists = true;

		// Check if converting groups exist and convert fields if it is so
		if (!empty($converting_groups)) {
			foreach ($converting_groups as $group) {
				if (!isset($v[$group['this_field']])) {
					continue;
				}
				
				$params = array();
				$params[] = $v[$group['this_field']];

				foreach ($group['args'] as $arg) {
					if (strpos($arg, '@') !== false) {
						$_opt = str_replace('@', '', $arg);
						$params[] = isset($options[$_opt]) ? $options[$_opt] : '';
					}
				}

				$v[$group['this_field']] = call_user_func_array($group['function'], $params);
			}
		}

		foreach ($alt_keys as $import_field => $real_field) {
			if (!isset($v[$real_field])) {
				continue;
			}
			$_alt_keys[$real_field] = $v[$real_field];
		}

		foreach ($primary_fields as $import_field => $real_field) {
			if (!isset($v[$real_field])) {
				continue;
			}
			$_primary_fields[$real_field] = $v[$real_field];
		}

		$skip_get_primary_object_id = false;
		/**
		 * Hook is used for changing query that selects primary object ID.
		 *
		 * @param array $pattern Array with import pattern data
		 * @param array $_alt_keys Array with key=>value data of possible primary object (used for 'where' condition)
		 * @param array $v Array with importing data (one row)
		 * @param boolean $skip_get_primary_object_id Skip or not getting Primary object ID
		 */
		fn_set_hook('import_get_primary_object_id', $pattern, $_alt_keys, $v, $skip_get_primary_object_id);
		if ($skip_get_primary_object_id) {
			$primary_object_id = array();
		} else {
			$primary_object_id = db_get_row('SELECT ' . implode(', ', $pattern['key']) . ' FROM ?:' . $pattern['table'] . ' WHERE ?w', $_alt_keys);
		}
		$primary_object_ids[] = $primary_object_id;
		$skip_record = false;

		fn_set_hook('import_process_data', $primary_object_id, $v, $pattern, $options, $processed_data, $processing_groups, $skip_record);

		if (!empty($pre_inserting_groups)) {
			foreach ($pre_inserting_groups as $group) {
				if (!isset($v[$group['this_field']])) {
					continue;
				}
				$params = array();
				foreach ($group['args'] as $arg) {
					if (strpos($arg, '@') !== false) {
						$_opt = str_replace('@', '', $arg);
						$params[] = isset($options[$_opt]) ? $options[$_opt] : '';
					} elseif ($arg == '#this') {
						$params[] = $v;
					}
				}
				$params[] = & $skip_record;
				$v[$group['this_field']] = call_user_func_array($group['function'], $params);
			}
		}

		if ($skip_record) {
			continue;
		}
		
		if (!(isset($pattern['import_skip_db_processing']) && $pattern['import_skip_db_processing'])) {

			fn_set_progress('echo', fn_get_lang_var('importing_data'));
			if (empty($primary_object_id)) {

				// If scheme is used for update objects only, skip this record
				if (!empty($pattern['update_only'])) {
					$_a = array();
					foreach ($alt_keys as $_d => $_v) {
						if (!isset($v[$_v])) {
							continue;
						}
						$_a[] = $_d . ' = ' . $v[$_v];
					}
					fn_set_progress('echo', fn_get_lang_var('object_does_not_exist') . ' (' . implode(', ', $_a) . ')...', false);

					$processed_data['S']++;
					continue;
				}

				$object_exists = false;
				$processed_data['N']++;

				// For new objects - fill the default values
				if (!empty($default_groups)) {
					foreach ($default_groups as $field => $value) {
						if (empty($v[$field])) {
							$v[$field] = $value;
						}
					}
				}
			} else {
				$processed_data['E']++;
			}

			$_data = fn_check_table_fields($v, $pattern['table']);

			if ($object_exists == true) {
				fn_set_progress('echo', fn_get_lang_var('updating') . ' ' . $pattern['name'] . ' <b>' . implode(',', $primary_object_id) . '</b>. ', false);
				db_query('UPDATE ?:' . $pattern['table'] . ' SET ?u WHERE ?w', $_data, $primary_object_id);
			} else {
				$o_id = db_query('INSERT INTO ?:' . $pattern['table'] . ' ?e', $_data);

				if ($o_id !== true) {
					$primary_object_id = array(reset($pattern['key']) => $o_id);
				} else {
					foreach ($pattern['key'] as $_v) {
						$primary_object_id[$_v] = $_data[$_v];
					}
				}

				fn_set_progress('echo', fn_get_lang_var('creating') . ' ' . $pattern['name'] . ' <b>' . implode(',', $primary_object_id) . '</b>. ', false);

			}
		}

		$skip_db_processing_record = false;

		if (!empty($post_inserting_groups)) {
			foreach ($post_inserting_groups as $group) {
				if (!isset($v[$group['this_field']])) {
					continue;
				}
				$params = array();
				foreach ($group['args'] as $arg) {
					if (strpos($arg, '@') !== false) {
						$_opt = str_replace('@', '', $arg);
						$params[] = isset($options[$_opt]) ? $options[$_opt] : '';
					} elseif ($arg == '#this') {
						$params[] = $v;
					}
				}
				$params[] = & $skip_db_processing_record;
				$v[$group['this_field']] = call_user_func_array($group['function'], $params);
			}
		}

		fn_set_hook('import_after_process_data', $primary_object_id, $v, $pattern, $options, $processed_data, $processing_groups, $skip_db_processing_record);

		if ($skip_db_processing_record) {
			continue;
		}

		if (!empty($processing_groups)) {
			foreach ($processing_groups as $group) {
				$args = array();
				$use_this_group = true;
				$_refs = array();
				foreach ($group['args'] as $ak => $av) {
					if ($av == '#key') {
						$args[$ak] = (sizeof($primary_object_id) == 1) ? reset($primary_object_id) : $primary_object_id;
					} elseif ($av == '#this') {
						// If we do not have this field in the import data, do not apply the function
						$this_id = $group['this_field'];

						if (!isset($v[$this_id])) {
							$is_empty_data = true;
							if (!empty($add_fields[$this_id])) {
								foreach($add_fields[$this_id] as $from_field) {
									if (isset($v[$from_field])) {
										$is_empty_data = false;
									}
								}
							}
								
							if ($is_empty_data) {
								$use_this_group = false;
								break;
							}
						}
						$args[$ak] = $v[$group['this_field']];
					} elseif ($av == '#counter') {
						$args[$ak] = &$processed_data;
					} elseif (strpos($av, '%') !== false) {
						$_ref = str_replace('%', '', $av);
						$_ref = !empty($pattern['export_fields'][$_ref]['db_field']) ? $pattern['export_fields'][$_ref]['db_field'] : $_ref; // FIXME!!! Move to code, which builds processing_groups
						$args[$ak] = isset($v[$_ref]) ? $v[$_ref] : '';
						$_refs[] = $_ref;
					} elseif (strpos($av, '@') !== false) {
						$_opt = str_replace('@', '', $av);
						$args[$ak] = $options[$_opt];
					} else {
						$args[$ak] = $av;
					}
				}

				if ($use_this_group == false) {
					continue;
				}

				$result = call_user_func_array($group['function'], $args); // FIXME - add checking for returned value

				if ($group['return_result'] == true) {
					$v[$group['this_field']] = $result;
				} else {
					// Remove processed fields from table groups
					if (!empty($group['table'])) {
						unset($table_groups[$group['table']]['fields'][$group['this_field']]);
						foreach ($_refs as $_ref) {
							unset($table_groups[$group['table']]['fields'][$_ref]);
						}
					}
				}
			}
		}

		if (!(isset($pattern['import_skip_db_processing']) && $pattern['import_skip_db_processing'])) {
			// Update referenced tables
			fn_set_progress('echo', fn_get_lang_var('updating_links') . '... ', false);

			foreach ($table_groups as $table => $tdata) {
				if (isset($tdata['import_skip_db_processing']) && $tdata['import_skip_db_processing']) {
					break;
				}
				$_data = array();

				// First, build condition
				$where_insert = array();

				// If alternative key is defined, use it
				if (!empty($tdata['alt_key'])) {
					foreach ($tdata['alt_key'] as $akey) {
						if (strval($akey) == '#key') {
							$where_insert = fn_array_merge($where_insert, $primary_object_id);
						} elseif (strpos($akey, '@') !== false) {
							$_opt = str_replace('@', '', $akey);
							$where_insert[$akey] = $options[$_opt];
						} else {
							$where_insert[$akey] = $v[$akey];
						}
					}
				// Otherwise - link by reference fields
				} else {
					foreach ($tdata['reference_fields'] as $field => $value) {
						if (strval($value) == '#key') {
							$_val = ((sizeof($primary_object_id) >= 1) ? reset($primary_object_id) : $primary_object_id);
						} elseif (strpos($value, '@') !== false) {
							$_opt = str_replace('@', '', $value);
							$_val = $options[$_opt];
						} else {
							$_val = $value;
						}
						$where_insert[$field] = $_val;
					}
				}

				// Now, build update fields array
				foreach ($tdata['fields'] as $import_field => $set) {
					if (!isset($v[$import_field])) {
						continue;
					}
					$_data[$import_field] = $v[$import_field];
				}

				// Check if object exists
				$is_exists = db_get_field("SELECT COUNT(*) FROM ?:$table WHERE ?w", $where_insert);
				if ($is_exists == true && !empty($_data)) {
					db_query("UPDATE ?:$table SET ?u WHERE ?w", $_data, $where_insert);
				} elseif (empty($is_exists)) { // if reference does not exist, we should insert it anyway to avoid inconsistency
					$_data = fn_array_merge($_data, $where_insert);

					if (substr($table, -13) == '_descriptions' && isset($_data['lang_code'])){
						// add description for all cart languages when adding object data
						foreach ((array)Registry::get('languages') as $_data['lang_code'] => $lang_v) {
							db_query("REPLACE INTO ?:$table ?e", $_data);
						}
					
					}else{
						db_query("INSERT INTO ?:$table ?e", $_data);
					}
				}
			}
		}
	}


	if (!empty($pattern['post_processing'])) {
		$func = $pattern['post_processing'];
		$function = array_shift($func);
		$args = $func;

		foreach ($args as $k => $v) {
			if (strpos($v, '@') !== false) {
				$_opt = str_replace('@', '', $v);
				$args[$k] = isset($options[$_opt]) ? $options[$_opt] : '';
			}
			if (strpos($v, '$') !== false) {
				$_opt = str_replace('$', '', $v);
				$args[$k] = isset($$_opt) ? $$_opt : '';
			}	
		}

		call_user_func_array($function, $args);
	}

	fn_set_hook('import_complete');

	$msg = fn_get_lang_var('text_exim_data_imported');
	$msg = str_replace('[new]', $processed_data['N'], $msg);
	$msg = str_replace('[exist]', $processed_data['E'], $msg);
	$msg = str_replace('[skipped]', $processed_data['S'], $msg);
	$msg = str_replace('[total]', $processed_data['E'] + $processed_data['N'] + $processed_data['S'], $msg);

	fn_set_notification('W', fn_get_lang_var('important'), $msg);

	return true;
}

//
// Export data using pattern
// Parameters:
// @pattern - import/export pattern
// @export_fields - export defined fields only
// @options - export options
// FIXME: add export conditions

function fn_export($pattern, $export_fields, $options)
{
	$ajax = Registry::get('ajax');
	$can_continue = true;

	fn_set_hook('export_pre_moderation', $pattern, $export_fields, $options, $can_continue);

	if (!$can_continue) {
		return false;
	}

	if (!empty($pattern['pre_processing'])) {
		foreach ($pattern['pre_processing'] as $function => $args) {
			foreach ($args as $k => $v) {
				if (strpos($v, '@') !== false) {
						$_opt = str_replace('@', '', $v);
						$args[$k] = isset($options[$_opt]) ? $options[$_opt] : '';
				}
				
				if (strpos($v, '$') !== false) {
						$_opt = str_replace('$', '', $v);
						$args[$k] = isset($$_opt) ? $$_opt : '';
				}
			}
			
			call_user_func_array($function, $args);
		}
	}
	
	if (isset($options['fields_names'])) {
		if ($options['fields_names']) {
			$fields_names = $export_fields;
			$export_fields = array_keys($export_fields);
		}
	}
	
	$primary_key = $pattern['key'];
	array_walk($primary_key, 'fn_attach_value_helper', $pattern['table'].'.');

	$table_fields = $primary_key;
	$joins = array();
	$processes = array();
	$conditions = array();

	// Build list of fields that should be retrieved from the database
	foreach ($pattern['export_fields'] as $field => $data) {
		if (!in_array($field, $export_fields)) {
			continue;
		}

		// Do no link this field
		if (isset($data['linked']) && $data['linked'] == false) {
			// do something?
		}
		// Primary object table
		elseif (empty($data['table']) || $data['table'] == $pattern['table']) {
			$table_fields[] = $pattern['table'] . '.' . (!empty($data['db_field']) ? $data['db_field'] . ' as "' .$field. '"' : $field);
		// Linked object tables
		} else {
			$table_fields[] = $data['table'] . '.' . (!empty($data['db_field']) ? $data['db_field'] . ' as "' .$field. '"' : $field);
		}

		if (!empty($data['process_get'])) {
			$processes[$field]['function'] = array_shift($data['process_get']);
			$processes[$field]['args'] = $data['process_get'];
		}
	}

	// Build the list of joins
	if (!empty($pattern['references'])) {
		foreach ($pattern['references'] as $table => $data) {
			$ref = array();
			foreach ($data['reference_fields'] as $k => $v) {
				if (strval($v) == 'key' || strval($v) == '#key') {
					$_val = (sizeof($primary_key) == 1) ? reset($primary_key) : '';
				} elseif (substr($v, 0, 1) == '&') {
					$_val = $pattern['table'] . '.' . substr($v, 1);
				} elseif (strpos($v, '@') !== false) {
					$_opt = str_replace('@', '', $v);
					$_val = "'" . $options[$_opt] . "'";
				} else {
					$_val = "'$v'";
				}
				$ref[] = "$table.$k = $_val"; // fixme
			}

			$joins[] = $data['join_type'] . ' JOIN ?:' . $table . " as $table ON " . implode(' AND ', $ref);
		}
	}

	// Add retrieve conditions
	if (!empty($pattern['condition'])) {
		$_cond = array();
		foreach ($pattern['condition'] as $field => $value) {
			if (is_array($value)) {
				$_val = implode("','", $value);
			} elseif (strpos($value, '@') !== false) {
				$_opt = str_replace('@', '', $value);
				$_val = $options[$_opt];
			} else {
				$_val = $value;
			}
			
			if (strpos($field, '&') !== false) {
				$_field = substr($field, 1);
			} else {
				$_field= $pattern['table'] . '.' .$field;
			}
			$_cond[] = "$_field IN ('$_val')";
		}
		$conditions[] = implode(' AND ', $_cond);
	}
	
	fn_set_hook('export_process', $pattern, $export_fields, $options, $conditions, $joins, $table_fields, $processes);
	
	// Build main query
	$query = "SELECT " . implode(', ', $table_fields) . " FROM ?:" . $pattern['table'] . " as " . $pattern['table'] .' '. implode(' ', $joins) . (!empty($conditions) ? ' WHERE ' . implode(' AND ', $conditions) : '');
	
	$total = db_get_field("SELECT COUNT(*) FROM ?:" . $pattern['table'] . " as " . $pattern['table'] .' '. implode(' ', $joins) . (!empty($conditions) ? ' WHERE ' . implode(' AND ', $conditions) : ''));

	fn_set_progress('total', $total);

	$step = 30; // define number of rows to get from database
	$iterator = 0; // start retrieving from
	$data_exported = false;
	while ($data = db_get_array($query . " LIMIT $iterator, $step")) {

		$data_exported = true;
		$result = array();
		foreach ($data as $k => $v) {
			fn_set_progress('echo', fn_get_lang_var('exporting_data') . ':&nbsp;<b>' . ($iterator + $k + 1)  .'</b>');
			$result[$k] = fn_array_key_intersect($v, $pattern['export_fields']);
			foreach ($processes as $field => $process_data) {
				$args = array();

				foreach ($process_data['args'] as $ak => $av) {
					if ($av === '#this') {
						$args[$ak] = $v[$field];
					} elseif ($av === '#key') {
						$args[$ak] = (sizeof($pattern['key']) == 1) ? $v[reset($pattern['key'])] : '';
					} elseif (strpos($av, '@') !== false) {
						$_opt = str_replace('@', '', $av);
						$args[$ak] = $options[$_opt];
					} elseif ($av === '#field') {
						$args[$ak] = $field;
					} else {
						$args[$ak] = $av;
					}
				}
				$result[$k][$field] = call_user_func_array($process_data['function'], $args);
			}
		}

		// Sort result array
		$_result = array();
		
		foreach ($result as $k => $v) {
			foreach ($export_fields as $field) {
				if (isset($fields_names[$field])) {
					$_result[$k][$fields_names[$field]] = $v[$field];
				} else {
					$_result[$k][$field] = $v[$field];
				}
			}
		}
		unset($result);

		// Put data
		$enclosure = (isset($pattern['enclosure'])) ? $pattern['enclosure'] : '"';
		fn_echo(' .');

		if (isset($pattern['func_save_content_to_file']) && is_callable($pattern['func_save_content_to_file'])) {
			call_user_func($pattern['func_save_content_to_file'], $_result, $options, $enclosure);
		} else {
			fn_put_csv($_result, $options, $enclosure);
		}

		unset($_result);
		$iterator += $step;
	}

	if (!empty($pattern['post_processing'])) {
		fn_set_progress('echo', fn_get_lang_var('processing'), false);
		$func = $pattern['post_processing'];
		if (file_exists(DIR_EXIM . $options['filename'])) {
			$function = array_shift($func);
			$args = $func;

			foreach ($args as $k => $v) {
				if (strpos($v, '@') !== false) {
					$_opt = str_replace('@', '', $v);
					$args[$k] = $options[$_opt];
				}
			}

			$data_exported = call_user_func_array($function, $args);
		}
	}
	return $data_exported;
}

//
// Process csv file using pattern
// Parameters:
// @pattern - import/export pattern
// @file - path to csv file on filesystem
// @options - processing options

function fn_get_csv($pattern, $file, $options)
{
	$max_line_size = 16384;
	$result = array();

	if ($options['delimiter'] == 'C') {
		$delimiter = ',';
	} elseif ($options['delimiter'] == 'T') {
		$delimiter = "\t";
	} else  {
		$delimiter = ';';
	}

	if (!empty($file) && file_exists($file)) {
			
		$encoding = fn_detect_encoding($file, 'F', !empty($options['lang_code']) ? $options['lang_code'] : CART_LANGUAGE);
		
		if (!empty($encoding)){		
			 $file = fn_convert_encoding($encoding, 'UTF-8', $file, 'F');
		}else{
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('text_exim_utf8_file_format'));
		}
		
		$f = false;
		if ($file !== false){
			$f = fopen($file, 'rb');
		}	

		if ($f) {
			// Get import schema
			$import_schema = fgetcsv($f, $max_line_size, $delimiter);
			if (empty($import_schema)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_cant_read_file'));
				return false;
			}

			// Check if we selected correct delimiter
			// If line was read without delimition, array size will be == 1.
			if (sizeof($import_schema) == 1) {
				// we could export one column if it is correct, otherwise show error
				if (!in_array($import_schema[0], array_keys($pattern['export_fields']))) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_incorrent_delimiter'));
					return false;
				}
			}

			// Analyze schema - check for required fields
			if (fn_analyze_schema($import_schema, $pattern) == false) {
				return false;
			}

			// Collect data
			$schema_size = sizeof($import_schema);
			$skipped_lines = array();
			$line_it = 1;
			while (($data = fn_fgetcsv($f, $max_line_size, $delimiter)) !== false) {

				$line_it ++;
				if (fn_is_empty($data)) {
					continue;
				}

				if (sizeof($data) != $schema_size) {
					$skipped_lines[] = $line_it;
					continue;
				}

				$result[] = array_combine($import_schema, fn_strip_slashes($data));
			}

			if (!empty($skipped_lines)) {
				$msg = fn_get_lang_var('error_exim_incorrect_lines');
				$msg = str_replace('[lines]', implode(', ', $skipped_lines), $msg);
				fn_set_notification('W', fn_get_lang_var('warning'), $msg);
			}

			return $result;
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_cant_open_file'));
			return false;
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_file_doesnt_exist'));
		return false;
	}
}

//
// Analyze import schema and convert fields using pattern
// Parameters:
// @schema - import schema
// @pattern - import/export pattern

function fn_analyze_schema(&$schema, $pattern)
{
	$failed_fields = array();
	$schema_match = false;
	array_walk($schema, 'fn_trim_helper');

	foreach ($pattern['export_fields'] as $field => $data) {
		if (!empty($data['required']) && $data['required'] == true && !in_array($field, $schema)) {
			$failed_fields[] = $field;
		}

		if (in_array($field, $schema)) {
			$schema_match = true;
		}

		// Replace fields aliases with database representation
		if (!empty($data['db_field'])) {
			$key = array_search($field, $schema);
			if ($key !== false) {
				$schema[$key] = $data['db_field'];
			}
		}
	}

	if (!empty($failed_fields)) {
		$msg = fn_get_lang_var('error_exim_pattern_required_fields');
		$msg = str_replace('[fields]', implode(', ', $failed_fields), $msg);
		fn_set_notification('E', fn_get_lang_var('error'), $msg);
		return false;
	}

	if ($schema_match == false) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_dont_match'));
		return false;
	}


	return true;
}

//
// Put data to csv file
// Parameters:
// @data - export data
// @options - options

function fn_put_csv(&$data, &$options, $enclosure)
{
	static $output_started = false;

	$eol = "\n";

	if ($options['delimiter'] == 'C') {
		$delimiter = ',';
	} elseif ($options['delimiter'] == 'T') {
		$delimiter = "\t";
	} else  {
		$delimiter = ';';
	}

	fn_mkdir(DIR_EXIM);

	foreach ($data as $k => $v) {
		foreach ($v as $name => $value) {
			$data[$k][$name] = $enclosure . str_replace(array("\r","\n","\t",$enclosure), array('','','',$enclosure.$enclosure), $value) . $enclosure;
		}
	}

	if ($output_started == false || isset($options['force_header'])) {
		Registry::get('view')->assign('fields', array_keys($data[0]));
	} else {
		Registry::get('view')->clear_assign('fields');
	}

	Registry::get('view')->assign('export_data', $data);
	Registry::get('view')->assign('delimiter', $delimiter);
	Registry::get('view')->assign('eol', $eol);

	$csv = Registry::get('view')->display('views/exim/components/export_csv.tpl', false);
	$fd = fopen(DIR_EXIM . $options['filename'], ($output_started && !isset($options['force_header'])) ? 'ab' : 'wb');
	if ($fd) {
		fwrite($fd, $csv, strlen($csv));
		fclose($fd);
		@chmod(DIR_EXIM . $options['filename'], DEFAULT_FILE_PERMISSIONS);
	}

	if ($output_started == false) {
		$output_started = true;
	}
	
	unset($options['force_header']);

	return true;
}

//
// Helper function: attaches prefix to value
//
function fn_attach_value_helper(&$value, $key, $attachment)
{
	$value = $attachment . $value;

	return true;
}


// -------------- ExIm utility functions ---------------------

/**
 * Export image (moves to selected directory on filesystem)
 *
 * @param int $image_id ID of the image
 * @param string $object object to export image for (product, category, etc...)
 * @param string $backup_path path to export image
 * @return string path to the exported image
 */
function fn_export_image($image_id, $object, $backup_path = '')
{
	$images_path = (!empty($backup_path) ? fn_strip_slashes($backup_path) : (DIR_IMAGES . 'images_backup')) . '/' . $object . '/';

	// if backup dir does not exist then try to create it
	fn_mkdir($images_path);

	$image_data = db_get_row("SELECT image_id, image_path FROM ?:images WHERE image_id = ?i", $image_id);
	if (empty($image_data)) {
		return '';
	}
	
	$alt_data = db_get_hash_single_array("SELECT lang_code, description FROM ?:common_descriptions WHERE ?:common_descriptions.object_id = ?i AND ?:common_descriptions.object_holder = 'images'", array('lang_code', 'description'), $image_id);
	$alt_text = '{';
	if (!empty($alt_data)) {
		foreach ($alt_data as $lang_code => $text) {
			$alt_text .= '[' . $lang_code . ']:' . $text . ';';
		}
	}
	$alt_text .= '}';

	$path = $images_path . fn_basename($image_data['image_path']);
	$orig_path = DIR_IMAGES . $object . '/' . floor($image_id / MAX_FILES_IN_DIR) . '/' . $image_data['image_path'];

	if (is_file($orig_path)) {
		fn_copy($orig_path, $path);
	}

	return $path . (!empty($alt_data) ? '#' . $alt_text : '');
}

/**
 * Import image pair
 *
 * @param string $prefix path prefix
 * @param string $image_file thumbanil path or filename
 * @param string $detailed_path detailed image path or filename
 * @param string $position image position
 * @param string $type pair type
 * @param int $object_id ID of object to attach images to
 * @param string $object name of object to attach images to
 * @return boolean true if images were imported
 */
function fn_import_images($prefix, $image_file, $detailed_file, $position, $type, $object_id, $object)
{
	static $updated_products = array();
	
	if (!empty($object_id)) {
		
		if (empty($updated_products[$object_id]) && !empty($_REQUEST['import_options']['remove_images']) && $_REQUEST['import_options']['remove_images'] == 'Y') {
			$updated_products[$object_id] = true;
			
			fn_delete_image_pairs($object_id, $object, 'A');
		}
		
		$_REQUEST["server_import_image_icon"] = '';
		$_REQUEST["type_import_image_icon"] = '';

		// Get image alternative text if exists
		if (!empty($image_file) && strpos($image_file, '#') !== false) {
			list ($image_file, $image_alt) = explode('#', $image_file);
		}

		if (!empty($detailed_file) && strpos($detailed_file, '#') !== false) {
			list ($detailed_file, $detailed_alt) = explode('#', $detailed_file);
		}

		if (!empty($image_alt)) {
			preg_match_all('/\[([A-Za-z]+?)\]:(.*?);/', $image_alt, $matches);
			if (!empty($matches[1]) && !empty($matches[2])) {
				$image_alt = array_combine(array_values($matches[1]), array_values($matches[2]));
			}
		}
		
		if (!empty($detailed_alt)) {
			preg_match_all('/\[([A-Za-z]+?)\]:(.*?);/', $detailed_alt, $matches);
			if (!empty($matches[1]) && !empty($matches[2])) {
				$detailed_alt = array_combine(array_values($matches[1]), array_values($matches[2]));
			}
		}
		
		$_REQUEST["type_import_image_icon"] = array ('server');
		$_REQUEST["type_import_image_detailed"] = array ('server');

		if (($image_file = fn_find_file($prefix, $image_file)) !== false) {
			$_REQUEST["file_import_image_icon"] = array (str_ireplace(DIR_ROOT, '', $image_file));
		} else {
			$_REQUEST["file_import_image_icon"] = array ();
		}

		if (($detailed_file = fn_find_file($prefix, $detailed_file)) !== false) {
			$_REQUEST["file_import_image_detailed"] = array (str_ireplace(DIR_ROOT, '', $detailed_file));

		} else {
			$_REQUEST["file_import_image_detailed"] = array ();
		}

		$_REQUEST['import_image_data'] = array(
			array(
				'type' => $type,
				'image_alt' => empty($image_alt) ? '' : $image_alt,
				'detailed_alt' => empty($detailed_alt) ? '' : $detailed_alt,
				'position' => empty($position) ? 0 : $position,
			)
		);

		return fn_attach_image_pairs('import', $object, $object_id);
	}
}

//
// Converts timestamp to human-readable date
//

function fn_timestamp_to_date($timestamp)
{
	return date('d M Y H:i:s', $timestamp);
}

//
// Converts human-readable date to timestamp
//

function fn_date_to_timestamp($date)
{
	return strtotime($date);
}

//
// Get absolute url to the image
// Parameters:
// @image_id - Id of image
// @object_type - type of image object

function fn_exim_get_image_url($product_id, $object_type, $pair_type, $get_icon, $get_detailed, $get_flash, $lang_code)
{
	$image_pair = fn_get_image_pairs($product_id, $object_type, $pair_type, $get_icon, $get_detailed, $lang_code);
	$valid_image_path = fn_find_valid_image_path($image_pair, $object_type, $get_flash, $lang_code);
	return !empty($valid_image_path) ? 'http://' . Registry::get('config.http_host') . $valid_image_path : '';
}

//
// Get pattern definition by its id
// Parameters:
// @pattern_id - pattern ID
function fn_get_pattern_definition($pattern_id, $get_for = '')
{
	// First, check basic patterns
	$schema = fn_get_schema('exim', $pattern_id, 'php', false);
	if (empty($schema)) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_not_found'));
		return false;
	}
	
	if ((!empty($schema['export_only']) && $get_for == 'import') || (!empty($schema['import_only']) && $get_for == 'export')) {
		return array();
	}

	$has_alt_keys = false;

	foreach ($schema['export_fields'] as $field_id => $field_data) {
		if (!empty($field_data['table'])) {
			// Table exists in export fields, but doesn't exist in references definition
			if (empty($schema['references'][$field_data['table']])) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_definition_references'));
				return false;
			}
		}

		// Check if schema has alternative keys to import basic data
		if (!empty($field_data['alt_key'])) {
			$has_alt_keys = true;
		}
		
		if ((!empty($field_data['export_only']) && $get_for == 'import') || (!empty($field_data['import_only']) && $get_for == 'export')) {
			unset($schema['export_fields'][$field_id]);
		}
	}

	if ($has_alt_keys == false) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_exim_pattern_definition_alt_keys'));
		return false;
	}
	
	return $schema;
}

//
// Get all available patterns for the section
// Parameters:
// @section - section to get patterns for
// @get_for - get import or export patterns
function fn_get_patterns($section, $get_for)
{
	// Get core patterns
	$files = fn_get_dir_contents(DIR_SCHEMAS . 'exim', false, true, '.php');

	foreach	(Registry::get('addons') as $k => $v) {
		if ($v['status'] != 'A') {
			continue;
		}

		if (is_dir(DIR_ADDONS . $k . '/schemas/exim')) {
			$_files = fn_get_dir_contents(DIR_ADDONS . $k . '/schemas/exim', false, true, '.php');
			foreach ($_files as $k => $v) {
				if (strpos($v, '.post.php') !== false) {
					unset($_files[$k]);
				}
			}

			if (!empty($_files)) {
				$files = fn_array_merge($files, $_files, false);
			}
		}
	}

	$patterns = array();
	$sections = array();
	
	foreach ($files as $k => $v) {
		$pattern_id = str_replace('.php', '', $v);
		$pattern = fn_get_pattern_definition($pattern_id, $get_for);
		
		if (empty($pattern)) {
			continue;
		}

		$sections[$pattern['section']] = array (
			'title' => fn_get_lang_var($pattern['section']),
			'href' => 'exim.' . MODE . '?section=' . $pattern['section'],
		);
		if ($pattern['section'] == $section) {
			$patterns[$pattern_id] = $pattern;
		}
	}
	
	if (defined('COMPANY_ID')) {
		$schema = fn_get_schema('permissions', 'vendor');
		
		// Check if the selected section is available
		if (isset($schema[$get_for]['sections'][$section]['permission']) && !$schema[$get_for]['sections'][$section]['permission']) {
			return array('', '');
		}
		
		if (!empty($schema[$get_for]['sections'])) {
			foreach ($schema[$get_for]['sections'] as $section_id => $data) {
				if (isset($data['permission']) && !$data['permission']) {
					unset($sections[$section_id]);
				}
			}
		}
		
		if (!empty($schema[$get_for]['patterns'])) {
			foreach ($schema[$get_for]['patterns'] as $pattern_id => $data) {
				if (isset($data['permission']) && !$data['permission']) {
					unset($patterns[$pattern_id]);
				}
			}
		}
	}
	
	ksort($sections, SORT_STRING);
	uasort($patterns, 'fn_sort_patterns');

	return array($sections, $patterns);
}

/**
 * Patterns sort function
 *
 * @param array $a scheme array
 * @param array $b scheme array
 * @return int
 */
function fn_sort_patterns($a, $b)
{
	$s1 = isset($a['order']) ? $a['order'] : $a['pattern_id'];
	$s2 = isset($b['order']) ? $b['order'] : $b['pattern_id'];
	if ($s1 == $s2) {
		return 0;
	}
	return ($s1 < $s2) ? -1 : 1;
}

/**
 * Finds file and return real path to it
 *
 * @param string $prefix path to search in
 * @param string $file Filename, can be URL, absolute or relative path
 * @return mixed String path to the file or false if file is not found.
 */
function fn_find_file($prefix, $file)
{

	$file = fn_strip_slashes($file);

	// Absolute path
	if (is_file($file)) {
		return realpath($file);
	}

	// Path is relative to prefix
	if (is_file($prefix . '/' . $file)) {
		return realpath($prefix . '/' . $file);
	}

	// Url
	if (strpos($file, '://') !== false) {
		$content = fn_get_contents($file);
		if (!empty($content)) {
			$fname = fn_create_temp_file();
			if (fn_put_contents($fname, $content)) {
				return $fname;
			}
		}
	}

	return false;
}

//
// Get product url
// Parameters:
// @product_id - product ID
function fn_exim_get_product_url($product_id, $lang_code = '')
{
    if (PRODUCT_TYPE == 'ULTIMATE') {
    	if (defined('COMPANY_ID')) {
    		$company_id = COMPANY_ID;
    	} else {
        	$company_id = db_get_field('SELECT company_id FROM ?:products WHERE product_id = ?i', $product_id);
    	}
        $company_url = '&company_id=' . $company_id;
    } else {
        $company_url = '';
    }

    $url = fn_url('products.view?product_id=' . $product_id . $company_url, 'C', 'http', '&', $lang_code);

	fn_set_hook('exim_get_product_url', $url, $product_id, $options, $lang_code);

	return $url;
}

/**
 * Convert price to it representation with selected decimal separator
 *
 * @param float $price price
 * @return converted price
 */
function fn_exim_export_price($price, $decimals_separator)
{
	if ($decimals_separator == '.') {
		return $price;
	}
	
	return str_replace('.', $decimals_separator, $price);
}

/**
 * Convert price to float with dot decimal separator
 *
 * @param float $price price
 * @return converted price
 */
function fn_exim_import_price($price, $decimals_separator)
{
	if ($decimals_separator == '.') {
		return $price;
	}
	
	return str_replace($decimals_separator, '.', $price);
}

?>
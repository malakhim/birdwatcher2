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

fn_define('DB_MAX_ROW_SIZE', 10000);
fn_define('DB_ROWS_PER_PASS', 140);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update_quick_menu_item') {
		$_data = $_REQUEST['item'];

		if (empty($_data['position'])) {
			$_data['position'] = db_get_field("SELECT max(position) FROM ?:quick_menu WHERE parent_id = ?i", $_data['parent_id']);
			$_data['position'] = $_data['position'] + 10;
		}

		$_data['user_id'] = $auth['user_id'];

		// remove admin index script from the begining of the URL
		$exclude = array(Registry::get('config.https_location') . '/' . INDEX_SCRIPT, Registry::get('config.http_location') . '/' . INDEX_SCRIPT, INDEX_SCRIPT);
		foreach ($exclude as $e) {
			if (strpos($_data['url'], $e) === 0) {
				$_data['url'] = substr_replace($_data['url'], '[admin_index]', 0, strlen($e));
				break;
			}
		}

		if (empty($_data['id'])) {
			$id = db_query("INSERT INTO ?:quick_menu ?e", $_data);

			$_data = array (
				'object_id' => $id,
				'description' => $_data['name'],
				'object_holder' => 'quick_menu'
			);

			foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
				db_query("INSERT INTO ?:common_descriptions ?e", $_data);
			}
		} else {
			db_query("UPDATE ?:quick_menu SET ?u WHERE menu_id = ?i", $_data, $_data['id']);

			$__data = array(
				'description' => $_data['name']
			);
			db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $__data, $_data['id'], DESCR_SL);
		}

		return array(CONTROLLER_STATUS_OK, "tools.show_quick_menu.edit");
	} elseif ($mode == 'view_changes') {

	    if (!empty($_REQUEST['compare_data']['db_name'])) {
		fn_db_snapshot_create();
		fn_db_snapshot_create($_REQUEST['compare_data']['db_name']);
	    }

	    return array(CONTROLLER_STATUS_OK, "tools.view_changes?db_ready=Y");
	}

	return;
}

if ($mode == 'phpinfo') {
	phpinfo();
	exit;

} elseif ($mode == 'show_quick_menu') {
	if (ACTION == 'edit') {
		$view->assign('edit_quick_menu', true);
	} else {
		$view->assign('expand_quick_menu', true);
	}

	if (!empty($_REQUEST['popup'])) {
		$view->assign('show_quick_popup', true);
	}

	$view->display('common_templates/quick_menu.tpl');
	exit;

} elseif ($mode == 'get_quick_menu_variant') {
	$ajax->assign('description', db_get_field("SELECT description FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $_REQUEST['id'], DESCR_SL));
	exit;

} elseif ($mode == 'remove_quick_menu_item') {
	$where = '';
	if (intval($_REQUEST['parent_id']) == 0) {
		$where = db_quote(" OR parent_id = ?i", $_REQUEST['id']);
		$delete_ids = db_get_fields("SELECT menu_id FROM ?:quick_menu WHERE parent_id = ?i", $_REQUEST['id']);
		db_query("DELETE FROM ?:common_descriptions WHERE object_id IN (?n) AND object_holder = 'quick_menu'", $delete_ids);
	}

	db_query("DELETE FROM ?:quick_menu WHERE menu_id = ?i ?p", $_REQUEST['id'], $where);
	db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu'", $_REQUEST['id']);

	$view->assign('edit_quick_menu', true);
	$view->assign('quick_menu', fn_get_quick_menu_data());
	$view->display('common_templates/quick_menu.tpl');
	exit;

} elseif ($mode == 'update_quick_menu_handler') {
	if (!empty($_REQUEST['enable'])) {
		CSettings::instance()->update_value('show_menu_mouseover', $_REQUEST['enable']);

		return array(CONTROLLER_STATUS_REDIRECT, "tools.show_quick_menu.edit");
	}
	exit;

} elseif ($mode == 'cleanup_history') {
	$_SESSION['last_edited_items'] = array();
	fn_save_user_additional_data('L', '');
	$view->assign('last_edited_items', '');
	$view->display('common_templates/last_viewed_items.tpl');
	exit;

} elseif ($mode == 'update_status') {

	fn_tools_update_status($_REQUEST);

	exit;

// Open/close the store
} elseif ($mode == 'store_mode') {

	fn_set_store_mode($_REQUEST['state']);

	$view->assign('settings', Registry::get('settings'));
	$view->display('bottom.tpl');
	exit;

} elseif ($mode == 'store_optimization') {

	fn_set_store_mode($_REQUEST['state']);

	$view->assign('settings', Registry::get('settings'));
	$view->display('bottom.tpl');
	exit;

} elseif ($mode == 'update_position') {

	if (preg_match("/^[a-z_]+$/", $_REQUEST['table'])) {
		$table_name = $_REQUEST['table'];
	} else {
		die;
	}

	$id_name = $_REQUEST['id_name'];
	$ids = explode(',', $_REQUEST['ids']);
	$positions = explode(',', $_REQUEST['positions']);

	foreach ($ids as $k => $id) {
		db_query("UPDATE ?:$table_name SET position = ?i WHERE ?w", $positions[$k], array($id_name => $id));
	}

	fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('positions_updated'));

	exit;

} elseif ($mode == 'view_changes') {

	$results = array();

	$snapshot_filename = '/var/snapshots/' . fn_strtolower(PRODUCT_NAME . '_' . PRODUCT_VERSION . '_' . (PRODUCT_STATUS ? (PRODUCT_STATUS . '_') : '') . PRODUCT_TYPE);

	$dist_filename = "{$snapshot_filename}_dist.php";
	$snapshot_filename .= '.php';

	if (is_file(DIR_ROOT . $dist_filename)) {

		if (is_file(DIR_ROOT . $snapshot_filename)) {

			include(DIR_ROOT . $snapshot_filename);
			include(DIR_ROOT . $dist_filename);

			list($added, $changed, $deleted) = fn_snapshot_diff($snapshot, $snapshot_dist);

			foreach ($snapshot['skins'] as $skin_name => $data) {
				$data_dist = fn_snapshot_build_skin($skin_name, $snapshot_dist);
				list($skin_added, $skin_changed, $skin_deleted) = fn_snapshot_diff($data, $data_dist);
				fn_snapshot_array_merge($added, $skin_added);
				fn_snapshot_array_merge($changed, $skin_changed);
				fn_snapshot_array_merge($deleted, $skin_deleted);
			}

			$tree = fn_snapshot_build_tree(array('added' => $added, 'changed' => $changed, 'deleted' => $deleted));

			$tables = db_get_fields('SHOW TABLES');



			$view->assign('creation_time', $snapshot['time']);
			$view->assign('changes_tree', $tree);

			if (!empty($snapshot_dist['db_scheme'])) {
			    $db_scheme = '';
			    foreach ($tables as $k => $table) {
				$db_scheme .= "\nDROP TABLE IF EXISTS " . $table . ";\n";
				$__scheme = db_get_row("SHOW CREATE TABLE $table");

				$__scheme = array_pop($__scheme);
				$replaced_scheme = preg_replace('/ AUTO_INCREMENT=[0-9]*/i', '', $__scheme);
				if (!empty($replaced_scheme) && is_string($replaced_scheme)) {
				    $__scheme = $replaced_scheme;
				}
				$db_scheme .= $__scheme . ";\n\n";
			    }

			    $db_scheme = str_replace('default', 'DEFAULT', $db_scheme);
			    $snapshot_dist['db_scheme'] = str_replace('default', 'DEFAULT', $snapshot_dist['db_scheme']);

			    $view->assign('db_diff', fn_text_diff_($snapshot_dist['db_scheme'], $db_scheme));
			}
			if (isset($_REQUEST['db_ready']) && $_REQUEST['db_ready'] == 'Y') {
			    $snapshot_dir = DIR_ROOT . '/var/snapshots/';
			    $s_r = fn_get_contents($snapshot_dir . 'cmp_release.sql');
			    $s_c = fn_get_contents($snapshot_dir . 'cmp_current.sql');

			    @ini_set('memory_limit', '255M');
			    $view->assign('db_d_diff', fn_text_diff_($s_r, $s_c));
			}


		} else {
			$view->assign('creation_time', 0);
			$view->assign('changes_tree', array());
		}
	} else {
		$view->assign('dist_filename', $dist_filename);
		$view->assign('changes_tree', array());
	}

} elseif ($mode == 'create_snapshot') {

	fn_snapshot_create();

	return array(CONTROLLER_STATUS_OK, CONTROLLER . '.view_changes');
}

function fn_text_diff_($source, $dest, $side_by_side = false)
{
	fn_init_diff();

	$diff = new Text_Diff('auto', array(explode("\n", $source), explode("\n", $dest)));
	$renderer = new Text_Diff_Renderer_inline();
	$renderer->_leading_context_lines = 3;
	$renderer->_trailing_context_lines = 3;

	if ($side_by_side == false) {
		$renderer->_split_level = 'words';
	}

	$res = $renderer->render($diff);

	if ($side_by_side == true) {
		$res = $renderer->sideBySide($res);
	}

	return $res;
}

function fn_db_snapshot_create($db_name = '')
{

    $snapshot_dir = DIR_ROOT . '/var/snapshots/';

    $dbdump_filename = empty($db_name) ? 'cmp_current.sql' : 'cmp_release.sql';

		if (!fn_mkdir($snapshot_dir)) {
			$err_msg = str_replace('[directory]', $snapshot_dir, fn_get_lang_var('text_cannot_create_directory'));
			fn_set_notification('E', fn_get_lang_var('error'), $err_msg);
			return false;
		}
		$dump_file = $snapshot_dir . $dbdump_filename;
		if (is_file($dump_file)) {
			if (!is_writable($dump_file)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('dump_file_not_writable'));
				return false;
			}
		}

		$fd = @fopen($snapshot_dir . $dbdump_filename, 'w');
		if (!$fd) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('dump_cant_create_file'));
			return false;
		}

		$db_pref = '';
		if (!empty($db_name)) {
		    $db_pref = 'tmp#';
		    $db_conn = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), $db_name, 'tmp');
		}
		// set export format
		db_query($db_pref . "SET @SQL_MODE = 'MYSQL323'");

		fn_start_scroller();
		$create_statements = array();
		$insert_statements = array();

		$status_data = db_get_array($db_pref . "SHOW TABLE STATUS");

		 $dbdump_tables = array();
		foreach ($status_data as $k => $v) {
		    $dbdump_tables[] = $v['Name'];
		}

		// get status data
		$t_status = db_get_hash_array($db_pref . "SHOW TABLE STATUS", 'Name');

		foreach ($dbdump_tables as $k => $table) {

			fn_echo('<br />' . fn_get_lang_var('backupping_data') . ': <b>' . $table . '</b>&nbsp;&nbsp;');
			$total_rows = db_get_field($db_pref . "SELECT COUNT(*) FROM $table");

			$index = db_get_array($db_pref . "SHOW INDEX FROM $table");
			$order_by = array();
			foreach ($index as $kk => $vv){
			    if ($vv['Key_name'] == 'PRIMARY') {
				$order_by[] = '`' . $vv['Column_name'] . '`';
			    }
			}

			if (!empty($order_by)) {
			    $order_by = 'ORDER BY ' . implode(',', $order_by);
			} else {
			    $order_by = '';
			}
			// Define iterator
			if (!empty($t_status[$table]) && $t_status[$table]['Avg_row_length'] < DB_MAX_ROW_SIZE) {
				$it = DB_ROWS_PER_PASS;
			} else {
				$it = 1;
			}
			for ($i = 0; $i < $total_rows; $i = $i + $it) {
				$table_data = db_get_array($db_pref . "SELECT * FROM $table $order_by LIMIT $i, $it");
				foreach ($table_data as $_tdata) {
					$_tdata = fn_add_slashes($_tdata, true);
					$values = array();
					foreach ($_tdata as $v) {
						$values[] = ($v !== null) ? "'$v'" : 'NULL';
					}
					fwrite($fd, "INSERT INTO $table (`" . implode('`, `', array_keys($_tdata)) . "`) VALUES (" . implode(', ', $values) . ");\n");
				}

				fn_echo(' .');
			}

		}
		fn_stop_scroller();
		if (!empty($db_name)) {
		    $save = Registry::get('runtime.dbs.main');
		    Registry::set('runtime.dbs.main',Registry::get('runtime.dbs.tmp'));
		    CSettings::instance()->reload_sections();
		}

		if (PRODUCT_TYPE == 'ULTIMATE') {
		    $companies = fn_get_short_companies();
		    asort($companies);
		    $settings['company_root'] = CSettings::instance()->get_list();
		    foreach ($companies as $k=>$v) {
			$settings['company_'.$k] = CSettings::instance()->get_list(0, 0, $k);
		    }
		} else {
		    $settings['company_root'] = CSettings::instance()->get_list();
		}
		if (!empty($db_name)) {
		    Registry::set('runtime.dbs.main',$save);
		}

		$settings = processSettings($settings, '');
		$settings = formatSettings($settings['data']);
		ksort($settings);
		
		$data = print_r($settings, true);
		fwrite($fd,$data);

		fclose($fd);
		@chmod($snapshot_dir . $dbdump_filename, DEFAULT_FILE_PERMISSIONS);

		/*if (!empty($db_name)) {
		    $db_conn = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), Registry::get('config.db_name'));
		}*/
		return true;
}


function processSettings($data, $key)
{
    $res = array();

    foreach ($data as $k=>$v) {
	if (is_array($v)) {
	    $tmp = processSettings($v, $k);
	    $res[$tmp['key']] = $tmp['data'];
	} else {
	    if ($k == 'name') {
		$key = $v;
	    }
	    //remove dynamic data
	    if ($k != 'object_id' &&
		$k != 'section_id' &&
		$k != 'section_tab_id')
	    {
		$res[$k] = $v;
	    }
	}

    }
  
    return array('key'=>$key, 'data'=>$res);
}

function formatSettings($data, $path = array(), $lev = 0)
{
    $res = array();

    foreach ($data as $k=>$v) {
	if (is_array($v) && $lev < 3) {
	    $path[$lev] = $k;
	    $tmp = formatSettings($v, $path, $lev + 1);
	    $res = array_merge($res, $tmp);
	} elseif ($lev == 3) {
	    $path[$lev] = $k;
	    $res[implode('.', $path)] = $v;
	}
    }

    return $res;
}

function fn_snapshot_create($dir_root = DIR_ROOT, $dist = false)
{
	$folders = array('addons', 'controllers', 'core', 'js', 'lib', 'payments', 'schemas', 'shippings');
	if ($dist) {
		$skins_dir = $dir_root . '/var/skins_repository';
		$skins_dir_to = $dir_root . '/skins';
	} else {
		$skins_dir = $dir_root . '/skins';
	}
	$skins = fn_get_dir_contents($skins_dir);

	$snapshot = array('time' => time(), 'files' => array(), 'dirs' => array(), 'skins' => array());

	if ($dist) {
	    $snapshot['db_scheme'] = fn_get_contents($dir_root . '/install/database/scheme.sql');
	}

	$new_snapshot = fn_snapshot_make($dir_root, $folders, array('config.local.php'));
	fn_snapshot_array_merge($snapshot, $new_snapshot);

	foreach ($folders as $folder_name) {
		$path = $dir_root . '/' . $folder_name;
		$new_snapshot = fn_snapshot_make($path);
		fn_snapshot_array_merge($snapshot, $new_snapshot);
	}

	foreach ($skins as $skin_name) {
		$path = "$skins_dir/$skin_name";
		if ($dist) {
			$new_snapshot = fn_snapshot_make($path, array(), array(), array($skins_dir => $skins_dir_to), true);
		} else {
			$new_snapshot = fn_snapshot_make($path, array(), array(), array(), true);
		}
		$snapshot['skins'][$skin_name]['files'] = $snapshot['skins'][$skin_name]['dirs'] = array();
		fn_snapshot_array_merge($snapshot['skins'][$skin_name], $new_snapshot);
	}

	fn_mkdir($dir_root . '/var/snapshots');

	$snapshot_filename = fn_strtolower(PRODUCT_NAME . '_' . PRODUCT_VERSION . '_' . (PRODUCT_STATUS ? (PRODUCT_STATUS . '_') : '') . PRODUCT_TYPE . ($dist ? '_dist' : ''));
	$snapshot_filecontent = '<?php $snapshot' . ($dist ? '_dist' : ''). ' = ' . var_export($snapshot, true) . '; ?>';

	fn_put_contents("$dir_root/var/snapshots/{$snapshot_filename}.php", $snapshot_filecontent);
}

function fn_snapshot_array_merge(&$array, $additional)
{
	foreach ($array as $key => $v) {
		if (is_array($array[$key])) {
			$array[$key] = array_merge($array[$key], !empty($additional[$key]) ? $additional[$key] : array());
		}
	}
}

function fn_snapshot_build_tree($changes)
{
	$tree = array();

	foreach ($changes as $action => $dataset) {
		foreach ($dataset as $types => $data) {

			$type = substr($types, 0, -1);

			foreach($data as $path) {
				$parent = '';
				$dirs = explode('/', $path);
				$dirs_size = count($dirs);
				$elm = & $tree;
				$level = 1;
				foreach ($dirs as $key => $name) {
					if ($name == '') {
						$name = '/';
					}
					if ($key + 1 < $dirs_size) {
						$new_key = md5("dir-$name-$parent");
						if (!isset($elm[$new_key]['content'])) {
							$elm[$new_key] = array(
								'name' => $name,
								'type' => 'dir',
								'level' => $level,
								'content' => array(),
							);
						}
						$elm = & $elm[$new_key]['content'];
					}
					if ($key + 1 == $dirs_size) {
						$new_key = md5("$type-$name-$parent");
						$elm[$new_key]['name'] = $name;
						$elm[$new_key]['type'] = $type;
						$elm[$new_key]['level'] = $level;
						$elm[$new_key]['action'] = $action;
					}
					$parent = $new_key;
					$level++;
				}
			}
		}
	}

	fn_snapshot_sort_tree($tree);

	return $tree;
}

function fn_snapshot_sort_tree(&$tree)
{
	foreach ($tree as $key => &$elm) {
		if (!empty($elm['content'])) {
			if (count($elm['content'] > 1)) {
				uasort($tree[$key]['content'], 'fn_snapshot_cmp');
			}
			fn_snapshot_sort_tree($tree[$key]['content']);
		}
	}
}

function fn_snapshot_cmp($a, $b)
{
	$a1 = (!empty($a['type']) ? $a['type'] : 'file') . (!empty($a['name']) ? $a['name'] : '');
	$b1 = (!empty($b['type']) ? $b['type'] : 'file') . (!empty($b['name']) ? $b['name'] : '');
    if ($a1 == $b1) {
        return 0;
    }
    return ($a1 < $b1) ? -1 : 1;
}

function fn_snapshot_make($path, $dirs_list = array(), $skip_files = array(), $path_replace = array(), $skins = false)
{
	$results = array('files' => array(), 'dirs' => array());
	$dir_root_strlen = strlen(DIR_ROOT);

	if (is_dir($path)) {
		if ($dh = opendir($path)) {

			while (($file = readdir($dh)) !== false) {
				if ($file == '.' || $file == '..' || $file{0} == '.') {
					continue;
				}

				$full_file_path = $_full_file_path = $path . '/' . $file;
				if ($path_replace) {
					$_find = key($path_replace);
					$_replace = $path_replace[$_find];
					if (substr($full_file_path, 0, strlen($_find)) == $_find) {
						$_full_file_path = substr_replace($full_file_path, $_replace, 0, strlen($_find));
					}
				}
				$short_file_path = $_short_file_path = substr($_full_file_path, $dir_root_strlen);
				if ($skins) {
					$_ar = explode('/', $short_file_path);
					$_short_file_path = implode('/', array_slice($_ar, 3));
				}
				if (is_file($full_file_path) && !in_array($file, $skip_files)) {
					$results['files'][md5($_short_file_path . md5_file($full_file_path))] = $short_file_path;
				} elseif (is_dir($full_file_path)) {
					$hash = md5($_short_file_path);
					if (!empty($dirs_list)) {
						if (in_array($file, $dirs_list)) {
							$results['dirs'][$hash] = $short_file_path;
						}
					} else {
						$results['dirs'][$hash] = $short_file_path;
						$new_results = fn_snapshot_make($full_file_path, array(), array(), $path_replace, $skins);
						fn_snapshot_array_merge($results, $new_results);
					}
				}
			}
			closedir($dh);
		}
	}

	return $results;
}

function fn_snapshot_diff($current, $dist)
{
	$deleted = $added = array('files' => array(), 'dirs' => array());
	$changed['files'] = array();

	$deleted['files'] = array_diff($dist['files'], $current['files']);
	$deleted['dirs'] = array_diff($dist['dirs'], $current['dirs']);

	$added['files'] = array_diff($current['files'], $dist['files']);
	$added['dirs'] = array_diff($current['dirs'], $dist['dirs']);

	$tmp['files'] = array_diff_assoc($current['files'], $dist['files']);

	$changed['files'] = array_diff($tmp['files'], $added['files']);

	return array($added, $changed, $deleted);
}

function fn_snapshot_build_skin($skin_name, &$snapshot_dist)
{
	$skin = !empty($snapshot_dist['skins'][$skin_name]) ? $snapshot_dist['skins'][$skin_name] : array('files' => array(), 'dirs' => array());

	$base = $snapshot_dist['skins']['basic'];
	$len = strlen('/skins/basic');

	foreach ($base as $type => $dataset) {
		foreach ($dataset as $key => $filename) {
			$base[$type][$key] = substr_replace($filename, '/skins/' . $skin_name, 0, $len);
			if (in_array($base[$type][$key], $skin[$type])) {
				unset($base[$type][$key]);
			}
		}
	}

	fn_snapshot_array_merge($base, $skin);

	return $base;
}

?>
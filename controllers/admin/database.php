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
fn_define('DB_ROWS_PER_PASS', 40);

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

	set_time_limit(3600);

	// Backup database
	if ($mode == 'backup') {

		$dbdump_filename = empty($_REQUEST['dbdump_filename']) ? 'dump_' . date('mdY') . '.sql' : fn_basename($_REQUEST['dbdump_filename']);

		if (!fn_mkdir(DIR_DATABASE . 'backup')) {
			$err_msg = str_replace('[directory]', DIR_DATABASE . 'backup',fn_get_lang_var('text_cannot_create_directory'));
			fn_set_notification('E', fn_get_lang_var('error'), $err_msg);
			exit;
		}

		$dump_file = DIR_DATABASE . 'backup/' . $dbdump_filename;

		if (is_file($dump_file)) {
			if (!is_writable($dump_file)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('dump_file_not_writable'));
				exit;
			}
		}

		$dbdump_tables = empty($_REQUEST['dbdump_tables']) ? array() : $_REQUEST['dbdump_tables'];
		$dbdump_schema = !empty($_REQUEST['dbdump_schema']) && $_REQUEST['dbdump_schema'] == 'Y';
		$dbdump_data = !empty($_REQUEST['dbdump_data']) && $_REQUEST['dbdump_data'] == 'Y';

		db_export_to_file(DIR_DATABASE . 'backup/' . $dbdump_filename, $dbdump_tables, $dbdump_schema, $dbdump_data);

		if ($_REQUEST['dbdump_compress'] == 'Y') {
			fn_set_progress('echo', '<br />' . fn_get_lang_var('compressing_backup') . '...', false);

			fn_compress_files($dbdump_filename . '.tgz', $dbdump_filename, dirname($dump_file));
			unlink($dump_file);
		}

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('done'));
	}

	// Restore
	if ($mode == 'restore') {

		if (!empty($_REQUEST['backup_files'])) {
			fn_restore_dump($_REQUEST['backup_files']);
		}

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('done'));
	}

	if ($mode == 'delete') {
		if (!empty($_REQUEST['backup_files'])) {
			foreach ($_REQUEST['backup_files'] as $file) {
				@unlink(DIR_DATABASE . 'backup/' . fn_basename($file));
			}
		}
	}

	if ($mode == 'upload') {
		$sql_dump = fn_filter_uploaded_data('sql_dump');

		if (!empty($sql_dump)) {
			$sql_dump = array_shift($sql_dump);
			if (fn_copy($sql_dump['path'], DIR_DATABASE . 'backup/' . $sql_dump['name'])) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('done'));
			} else {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('dump_cant_create_file'));
			}
		} else {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('cant_upload_file'));
		}
	}

	if ($mode == 'optimize') {
		// Log database optimization
		fn_log_event('database', 'optimize');

		$all_tables = db_get_fields("SHOW TABLES");

		fn_set_progress('total', sizeof($all_tables));

		foreach ($all_tables as $table) {
			fn_set_progress('echo', fn_get_lang_var('optimizing_table') . "&nbsp;<b>$table</b>...<br />");

			db_query("OPTIMIZE TABLE $table");
			db_query("ANALYZE TABLE $table");
			$fields = db_get_hash_array("SHOW COLUMNS FROM $table", 'Field');

			if (!empty($fields['is_global'])) { // Sort table by is_global field
				fn_echo('.');
				db_query("ALTER TABLE $table ORDER BY is_global DESC");
			}
			elseif (!empty($fields['position'])) { // Sort table by position field
				fn_echo('.');
				db_query("ALTER TABLE $table ORDER BY position");
			}
		}

		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('done'));
	}


	return array(CONTROLLER_STATUS_OK, "database.manage");
}


if ($mode == 'getfile' && !empty($_REQUEST['file'])) {
	fn_get_file(DIR_DATABASE . 'backup/' . fn_basename($_REQUEST['file']));

} elseif ($mode == 'manage') {

	Registry::set('navigation.tabs', array (
		'backup' => array (
			'title' => fn_get_lang_var('backup'),
			'js' => true
		),
		'restore' => array (
			'title' => fn_get_lang_var('restore'),
			'js' => true
		),
		'maintenance' => array (
			'title' => fn_get_lang_var('maintenance'),
			'js' => true
		),
	));

	// Calculate database size and fill tables array
	$status_data = db_get_array("SHOW TABLE STATUS");
	$database_size = 0;
	$all_tables = array();
	foreach ($status_data as $k => $v) {
		$database_size += $v['Data_length'] + $v['Index_length'];
		$all_tables[] = $v['Name'];
	}

	$view->assign('database_size', $database_size);
	$view->assign('all_tables', $all_tables);

	$files = fn_get_dir_contents(DIR_DATABASE . 'backup', false, true, array('.sql', '.tgz'));
	sort($files, SORT_STRING);
	$backup_files = array();
	if (is_array($files)) {
		foreach ($files as $file) {
			$backup_files[$file]['size'] = filesize(DIR_DATABASE . 'backup/' . $file);
			$backup_files[$file]['type'] = strpos($file, '.tgz')===false ? 'sql' : 'tgz';
		}
	}

	$view->assign('backup_files', $backup_files);
	$view->assign('backup_dir', DIR_DATABASE . 'backup/');

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['backup_file'])) {
		@unlink(DIR_DATABASE . 'backup/' . $_REQUEST['backup_file']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "database.manage?selected_section=restore");
}

function fn_restore_dump($files)
{
	if (empty($files)) {
		return false;
	}
	// Log database restore
	fn_log_event('database', 'restore');

	fn_set_progress('parts', sizeof($files));

	foreach ($files as $file) {

		if (strpos($file, '.tgz') !== false) {
			fn_decompress_files($file, DIR_DATABASE . '/backup');
			$file = substr($file, 0, strpos($file, '.tgz'));
		}

		db_import_sql_file(DIR_DATABASE . 'backup/' . $file);
	}

	fn_set_hook('database_restore', $files);

	fn_clear_cache();

	return true;
}

?>
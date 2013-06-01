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

/**
 * Execute query and format result as associative array with column names as keys
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_array($query)
{
	$args = func_get_args();

	if ($_result = call_user_func_array('db_query', $args)) {

		while ($arr = driver_db_fetch_array($_result)) {
			$result[] = $arr;
		}

		driver_db_free_result($_result);
	}

	return !empty($result) ? $result : array();
}

/**
 * Execute query and format result as associative array with column names as keys and index as defined field
 *
 * @param string $query unparsed query
 * @param string $field field for array index
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_hash_array($query, $field)
{
	$args = array_slice(func_get_args(), 2);
	array_unshift($args, $query);

	if ($_result = call_user_func_array('db_query', $args)) {
		while ($arr = driver_db_fetch_array($_result)) {
			if (isset($arr[$field])) {
				$result[$arr[$field]] = $arr;
			}
		}

		driver_db_free_result($_result);
	}

	return !empty($result) ? $result : array();
}

/**
 * Execute query and format result as associative array with column names as keys and then return first element of this array
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_row($query)
{
	$args = func_get_args();

	if ($_result = call_user_func_array('db_query', $args)) {

		$result = driver_db_fetch_array($_result);

		driver_db_free_result($_result);

	}

	return is_array($result) ? $result : array();
}

/**
 * Execute query and returns first field from the result
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_field($query)
{
	$args = func_get_args();

	if ($_result = call_user_func_array('db_query', $args)) {
	
		$result = driver_db_fetch_row($_result);

		driver_db_free_result($_result);

	}

	return (isset($result) && is_array($result)) ? $result[0] : NULL;
}

/**
 * Execute query and format result as set of first column from all rows
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_fields($query)
{
	$args = func_get_args();

	if ($__result = call_user_func_array('db_query', $args)) {

		$_result = array();
		while ($arr = driver_db_fetch_array($__result)) {
			$_result[] = $arr;
		}

		driver_db_free_result($__result);

		if (is_array($_result)) {
			$result = array();
			foreach ($_result as $k => $v) {
				array_push($result, reset($v));
			}
		}

	}

	return is_array($result) ? $result : array();
}

/**
 * Execute query and format result as one of: field => array(field_2 => value), field => array(field_2 => row_data), field => array([n] => row_data)
 *
 * @param string $query unparsed query
 * @param array $params array with 3 elements (field, field_2, value)
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_hash_multi_array($query, $params)
{
	@list($field, $field_2, $value) = $params;

	$args = array_slice(func_get_args(), 2);
	array_unshift($args, $query);

	if ($_result = call_user_func_array('db_query', $args)) {
		while ($arr = driver_db_fetch_array($_result)) {
			if (!empty($field_2)) {
				$result[$arr[$field]][$arr[$field_2]] = !empty($value) ? $arr[$value] : $arr;
			} else {
				$result[$arr[$field]][] = $arr;
			}
		}

		driver_db_free_result($_result);

	}

	return !empty($result) ? $result : array();
}

/**
 * Execute query and format result as key => value array
 *
 * @param string $query unparsed query
 * @param array $params array with 2 elements (key, value)
 * @param mixed ... unlimited number of variables for placeholders
 * @return array structured data
 */
function db_get_hash_single_array($query, $params)
{
	@list($key, $value) = $params;

	$args = array_slice(func_get_args(), 2);
	array_unshift($args, $query);

	if ($_result = call_user_func_array('db_query', $args)) {
		while ($arr = driver_db_fetch_array($_result)) {
			$result[$arr[$key]] = $arr[$value];
		}

		driver_db_free_result($_result);
	}

	return !empty($result) ? $result : array();
}

/**
 * Execute query
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return boolean always true, dies if problem occured
 */
function db_query($query)
{
	fn_set_hook('db_query', $query);
	
	Registry::set('runtime.database.long_query', false);

	$args = func_get_args();
	$dbc_name = Registry::if_get('runtime.database.current_connect', 'main');
	
	if (preg_match("/^(\w+)#/", $query, $m)) {
		$query = substr($query, strlen($m[0]));
		if (Registry::is_exist('runtime.dbs.' . $m[1])) {
			$dbc_name = $m[1];
		}
	}

	$query = db_process($query, array_slice($args, 1), true, $dbc_name);

	fn_set_hook('db_query_process', $query, $dbc_name);

	if (empty($query)) {
		return false;
	}

	if (defined('DEBUG_QUERIES')) {
		fn_print_r($query);
	}
	
	$time_start = microtime(true);
	$result = driver_db_query($query, $dbc_name);
	$time_exec = microtime(true) - $time_start;
	
	if (defined('PROFILER')) {
		Profiler::set_query($query, $time_exec);
	}
	
	// Get last inserted ID
	$i_id = driver_db_insert_id($dbc_name);
	
	fn_set_hook('db_query_executed', $query, $result, $dbc_name);
	
	// Check if query updates data in the database

	if ($time_exec > LONG_QUERY_TIME) {
		Registry::set('runtime.database.long_query', true);
		Registry::set('runtime.database.last_query', $query);
	}

	if ($result === true) { // true returns for success insert/update/delete query
	
		// Check if it was insert statement with auto_increment value
		if (Registry::is_exist('revisions') && ($i_id = Registry::get('revisions.db_insert_id')) && !Registry::get('revisions.working')) {
			Registry::set('revisions.db_insert_id', null);
			return $i_id;

		} elseif ($i_id) {
			return $i_id;
		}
	}

	db_error($result, $query, $dbc_name);

	return $result;
}

/**
 * Parse query and replace placeholders with data
 *
 * @param string $query unparsed query
 * @param mixed ... unlimited number of variables for placeholders
 * @return parsed query
 */
function db_quote()
{
	$args = func_get_args();
	$pattern = array_shift($args);

	return db_process($pattern, $args, false);
}

/**
 * Parse query and replace placeholders with data
 *
 * @param string $query unparsed query
 * @param array $data data for placeholders
 * @param string $dbc_name database connection name
 * @return parsed query
 */
function db_process($pattern, $data = array(), $replace = true, $dbc_name = 'main')
{
	static $session_vars_updated = false;
	$command = 'get';
	$group_concat_len = 3000; // 3Kb

	// Check if query updates data in the database
	if (preg_match("/^(UPDATE|INSERT INTO|REPLACE INTO|DELETE FROM) \?\:(\w+) /", $pattern, $m)) {
		$table_name = $m[2];//str_replace(TABLE_PREFIX, '', $m[2]);
		Registry::set_changed_tables($table_name);

		$command = ($m[1] == 'DELETE FROM') ? 'delete' : 'set';
		
	}

	if (strpos($pattern, 'GROUP_CONCAT(') !== false && $session_vars_updated == false) {
		db_query($dbc_name . '#SET SESSION group_concat_max_len = ?i', $group_concat_len);
		$session_vars_updated = true;
	}

	// Replace table prefixes
	if ($replace) {
		$pattern = str_replace('?:', Registry::get('runtime.db_prefixes.' . $dbc_name), $pattern);
	}

	if (!empty($data) && preg_match_all("/\?(i|s|l|d|a|n|u|e|p|w|f)+/", $pattern, $m)) {
		$offset = 0;
		foreach ($m[0] as $k => $ph) {
			if ($ph == '?u' || $ph == '?e') {
				$data[$k] = fn_check_table_fields($data[$k], $table_name, $dbc_name);

				if (empty($data[$k])) {
					return false;
				}
			}

			if ($ph == '?i') { // integer
				$pattern = db_str_replace($ph, db_intval($data[$k]), $pattern, $offset); // Trick to convert int's and longint's

			} elseif ($ph == '?s') { // string
				$pattern = db_str_replace($ph, "'" . addslashes($data[$k]) . "'", $pattern, $offset);

			} elseif ($ph == '?l') { // string for LIKE operator
				$pattern = db_str_replace($ph, "'" . addslashes(str_replace("\\", "\\\\", $data[$k])) . "'", $pattern, $offset);

			} elseif ($ph == '?d') { // float
				$pattern = db_str_replace($ph, sprintf('%01.2f', $data[$k]), $pattern, $offset);

			} elseif ($ph == '?a') { // array FIXME: add trim
				$data[$k] = !is_array($data[$k]) ? array($data[$k]) : $data[$k];
				$pattern = db_str_replace($ph, "'" . implode("', '", array_map('addslashes', $data[$k])) . "'", $pattern, $offset);

			} elseif ($ph == '?n') { // array of integer FIXME: add trim
				$data[$k] = !is_array($data[$k]) ? array($data[$k]) : $data[$k];
				$pattern = db_str_replace($ph, !empty($data[$k]) ? implode(', ', array_map('db_intval', $data[$k])) : "''", $pattern, $offset);

			} elseif ($ph == '?u' || $ph == '?w') { // update/condition with and
				$q = '';
				$clue = ($ph == '?u') ? ', ' : ' AND ';
				foreach($data[$k] as $field => $value) {
					$q .= ($q ? $clue : '') . '`' . db_field($field) . "` = '" . addslashes($value) . "'";
				}
				$pattern = db_str_replace($ph, $q, $pattern, $offset);

			} elseif ($ph == '?e') { // insert
				$pattern = db_str_replace($ph, '(`' . implode('`, `', array_map('addslashes', array_keys($data[$k]))) . "`) VALUES ('" . implode("', '", array_map('addslashes', array_values($data[$k]))) . "')", $pattern, $offset);

			} elseif ($ph == '?f') { // field/table/database name
				$pattern = db_str_replace($ph, db_field($data[$k]), $pattern, $offset);

			} elseif ($ph == '?p') { // prepared statement
				$pattern = db_str_replace($ph, db_table_prefix_replace('?:', Registry::get('runtime.db_prefixes.' . $dbc_name), $data[$k]), $pattern, $offset);
			}
		}
	}

	if ($replace) {

		if (Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
			if (strpos($pattern, 'SELECT') === 0) {
				fn_revisions_process_select($pattern);
			}

			if (strpos($pattern, 'UPDATE') === 0) {
				fn_revisions_process_update($pattern);
			}

			if ((strpos($pattern, 'INSERT') === 0 || strpos($pattern, 'REPLACE') === 0)) {
				Registry::set('revisions.db_insert_id', 0);
				fn_revisions_process_insert($pattern);
			}

			if (strpos($pattern, 'DELETE') === 0) {
				fn_revisions_process_delete($pattern);
			}
		}
	}

	return $pattern;
}

/**
 * Placeholder replace helper
 *
 * @param string $needle string to replace
 * @param string $replacement replacement
 * @param string $subject string to search for replace
 * @param int $offset offset to search from
 * @return string with replaced fragment
 */
function db_str_replace($needle, $replacement, $subject, &$offset)
{
	$pos = strpos($subject, $needle, $offset);
	$offset = $pos + strlen($replacement);
	return substr_replace($subject, $replacement, $pos, 2);
}

/**
 * Function finds $needle and replace it by $replacement only when $needle is not in quotes.
 * For example in sting "SELECT ?:products ..." ?: will be replaced,
 * but in "... WHERE name = '?:products'" ?: will not be replaced by table_prefix
 * 
 * @param string $needle string to replace
 * @param string $replacement replacement
 * @param string $subject string to search for replace
 * @return string
 */
function db_table_prefix_replace($needle, $replacement, $subject)
{
	// check that needle exists
	if (($pos = strpos($subject, $needle)) === false) {
		return $subject;
	}
	
	// if there are no ', replace all occurrences
	if (strpos($subject, "'") === false) {
		return str_replace($needle, $replacement, $subject);
	}
	
	$needle_len = strlen($needle);
	// find needle
	while (($pos = strpos($subject, $needle, $pos)) !== false) {
		// get the first part of string
		$tmp = substr($subject, 0, $pos);
		// remove slashed single quotes
		$tmp = str_replace("\'", '', $tmp);
		// if we have even count of ', it means that we are not in the quotes
		if (substr_count($tmp, "'") % 2 == 0) {
			// so we should make a replacement
			$subject = substr_replace($subject, $replacement, $pos, $needle_len);
		} else {
			// we are in the quotes, skip replacement and move forward
			$pos += $needle_len;
		}
	}

	return $subject;
}

/**
 * Convert variable to int/longint type
 *
 * @param mixed $int variable to convert
 * @return mixed int/intval variable
 */
function db_intval($int)
{
	return $int + 0;
}

/**
 * Check if variable is valid database table name, table field or database name
 *
 * @param mixed $int variable to convert
 * @return mixed int/intval variable
 */
function db_field($field)
{
	if (preg_match("/([\w]+)/", $field, $m) && $m[0] == $field) {
		return $field;
	}

	return '';
}

/**
 * Get column names from table
 *
 * @param string $table_name table name
 * @param array $exclude optional array with fields to exclude from result
 * @param boolean $wrap_quote optional parameter, if true, the fields will be enclosed in quotation marks
 * @param string $dbc_name database connection name
 * @return array columns array
 */
function fn_get_table_fields($table_name, $exclude = array(), $wrap = false, $dbc_name = 'main')
{	
	static $table_fields_cache = array();
	
	if (!isset($table_fields_cache[$table_name])) {
		$table_fields_cache[$table_name] = db_get_fields("$dbc_name#SHOW COLUMNS FROM ?:$table_name");
	}
	
	$fields = $table_fields_cache[$table_name];
	if (!$fields) {
		return false;
	}
	
	if ($exclude) {
		$fields = array_diff($fields, $exclude);	
	}
	
	if ($wrap) {
		foreach($fields as &$v) {
			$v = "`$v`";
		}
	}
	
	return $fields;
}

/**
 * Check if passed data corresponds columns in table and remove unnecessary data
 *
 * @param array $data data for compare
 * @param array $table_name table name
 * @param string $dbc_name database connection name
 * @return mixed array with filtered data or false if fails
 */
function fn_check_table_fields($data, $table_name, $dbc_name = 'main')
{
	$_fields = fn_get_table_fields($table_name, array(), false, $dbc_name);
	if (is_array($_fields)) {
		foreach ($data as $k => $v) {
			if (!in_array($k, $_fields)) {
				unset($data[$k]);
			}
		}
		if (func_num_args() > 3) {
			for ($i = 3; $i < func_num_args(); $i++) {
				unset($data[func_get_arg($i)]);
			}
		}
		return $data;
	}
	return false;
}

/**
 * Remove value from set (e.g. remove 2 from "1,2,3" results in "1,3")
 *
 * @param string $field table field with set
 * @param string $value value to remove
 * @return string database construction for removing value from set
 */
function fn_remove_from_set($field, $value)
{
    return db_quote("TRIM(BOTH ',' FROM REPLACE(CONCAT(',', $field, ','), CONCAT(',', ?s, ','), ','))", $value);
}

/**
 * Add value to set (e.g. add 2 from "1,3" results in "1,3,2")
 *
 * @param string $field table field with set
 * @param string $value value to add
 * @return string database construction for add value to set
 */
function fn_add_to_set($field, $value)
{
    return db_quote("TRIM(BOTH ',' FROM CONCAT_WS(',', ?p, ?s))", fn_remove_from_set($field, $value), $value);
}

/**
 * Create set from php array
 *
 * @param array $set_data values array
 * @return string database construction for creating set
 */
function fn_create_set($set_data = array())
{
	return empty($set_data) ? '' : implode(',', $set_data);
}

function fn_find_array_in_set($arr, $set, $find_empty = false)
{
	$conditions = array();
	if ($find_empty) {
		$conditions[] = "$set = ''";
	}
	if (!empty($arr)) {
		foreach ($arr as $val) {
			$conditions[] = db_quote("FIND_IN_SET(?i, $set)", $val);
		}
	}

	return empty($conditions) ? '' : implode(' OR ', $conditions);
}

/**
 * Display database error
 *
 * @param resource $result result, returned by database server
 * @param string $query SQL query, passed to server
 * @param string $dbc_name database connection name
 * @return mixed false if no error, dies with error message otherwise
 */
function db_error($result, $query, $dbc_name = 'main')
{
	if (!empty($result) || driver_db_errno($dbc_name) == 0) {
		// it's ok
	} else {
		$error = array (
			'message' => driver_db_error($dbc_name) . ' <b>(' . driver_db_errno($dbc_name) . ')</b>',
			'query' => $query,
		);

		if (Registry::get('runtime.database.skip_errors') == true) {
			Registry::push('runtime.database.errors', $error);
		} else {
			fn_error(debug_backtrace(), $error);
		}
	}

	return false;
}

/**
 * Connect to database server and select database
 *
 * @param string $host database host
 * @param string $user database user
 * @param string $password database password
 * @param string $name database name
 * @param string $dbc_name database connection name
 * @param string $table_prefix database tables prefix
 * @param string $names set names charset
 * @return resource database connection identifier, false if error occurred
 */
function db_initiate($host, $user, $password, $name, $dbc_name = 'main', $table_prefix = '', $names = 'utf8')
{
	Registry::set('runtime.db_prefixes.' . $dbc_name, $dbc_name == 'main' ? TABLE_PREFIX : $table_prefix);
	
	$db_conn = driver_db_connect($host, $user, $password, $dbc_name);
	if (!empty($db_conn)) {
		if (!empty($names)) {
			db_query("$dbc_name#SET NAMES ?s", $names);
		}
		Registry::set('runtime.database.skip_errors', false);
		return driver_db_select($name, $dbc_name) ? $db_conn : false;
	}

	return false;
}

/**
 * Change database connect to default
 * 
 * @return bool Always true
 */
function db_connect_to_main() 
{
	db_connect_to('main', Registry::get('config.db_name'));

	return true;
}

/**
 * Change default connect to $dbc_name 
 * 
 * @param string $dbc_name Alias for database connection that was passed to db_initiate
 * @param string $name Database name
 * @return bool True on success false otherwise
 */
function db_connect_to($dbc_name, $name) 
{	
	$db_conn = Registry::get('runtime.dbs.' . $dbc_name);

	if ($db_conn != null) {
		Registry::set('runtime.database.current_connect', $dbc_name);
		
		return driver_db_select($name, $dbc_name) ? $db_conn : false;
	}

	return false;
}

/**
 * Get the number of found rows from the last query
 * 
 */
function db_get_found_rows()
{
	$count = db_get_field("SELECT FOUND_ROWS()");

	return $count;
}

/**
 * Exports database to file
 *
 * @param string $file_name path to file will be created
 * @param array $dbdump_tables List of tables to be exported
 * @param boolean $dbdump_schema Export database schema
 * @param boolean $dbdump_data Export tatabase data
 * @param boolean $log Log database export action
 * @param boolean $show_progress Show or do not show process by printing ' .'
 * @param boolean $move_progress_bar Move COMET progress bar or not on show progress
 * @return false, if file is not accessible
 */
function db_export_to_file($file_name, $dbdump_tables, $dbdump_schema, $dbdump_data, $log = true, $show_progress = true, $move_progress_bar = true)
{
	$fd = @fopen($file_name, 'w');
	if (!$fd) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('dump_cant_create_file'));
		return false;
	}

	if ($log) {
		// Log database backup
		fn_log_event('database', 'backup');
	}

	// set export format
	db_query("SET @SQL_MODE = 'MYSQL323'");

	$create_statements = array();
	$insert_statements = array();

	if ($show_progress && $move_progress_bar) {
		fn_set_progress('total', sizeof($dbdump_tables) * ((int)$dbdump_schema + (int)$dbdump_data));
	}

	// get status data
	$t_status = db_get_hash_array("SHOW TABLE STATUS", 'Name');

	foreach ($dbdump_tables as $k => $table) {
		if ($dbdump_schema) {
			if ($show_progress) {
				fn_set_progress('echo', '<br />' . fn_get_lang_var('backupping_schema') . ': <b>' . $table . '</b>', $move_progress_bar);
			}
			fwrite($fd, "\nDROP TABLE IF EXISTS " . $table . ";\n");
			$__scheme = db_get_row("SHOW CREATE TABLE $table");
			fwrite($fd, array_pop($__scheme) . ";\n\n");
		}

		if ($dbdump_data) {
			if ($show_progress) {
				fn_set_progress('echo', '<br />' . fn_get_lang_var('backupping_data') . ': <b>' . $table . '</b>&nbsp;&nbsp;', $move_progress_bar);
			}

			$total_rows = db_get_field("SELECT COUNT(*) FROM $table");

			// Define iterator
			if (!empty($t_status[$table]) && $t_status[$table]['Avg_row_length'] < DB_MAX_ROW_SIZE) {
				$it = DB_ROWS_PER_PASS;
			} else {
				$it = 1;
			}
			for ($i = 0; $i < $total_rows; $i = $i + $it) {
				$table_data = db_get_array("SELECT * FROM $table LIMIT $i, $it");
				foreach ($table_data as $_tdata) {
					$_tdata = fn_add_slashes($_tdata, true);
					$values = array();
					foreach ($_tdata as $v) {
						$values[] = ($v !== null) ? "'$v'" : 'NULL';
					}
					fwrite($fd, "INSERT INTO $table (`" . implode('`, `', array_keys($_tdata)) . "`) VALUES (" . implode(', ', $values) . ");\n");
				}

				if ($show_progress) {
					fn_echo(' .');
				}
			}
		}
	}
	
	fclose($fd);

	@chmod($file_name, DEFAULT_FILE_PERMISSIONS);

	return true;
}

/**
 * Fuctnions parses SQL file and import data from it
 *
 * @param string $file File for import
 * @param integer $buffer Buffer size for fread function
 * @param booleand $show_status Show or do not show process by printing ' .'
 * @param integer $show_create_table 0 - Do not print the name of created table, 1 - Print name and get lang_var('create_table'), 2 - Print name without getting lang_var
 * @param boolean $check_prefix Check table prefix and replace it with the installed in config.php
 * @param boolean $track Use queries cache. Do not execute queries that already are executed.
 * @param boolean $skip_errors Skip errors or not
 * @param boolean $move_progress_bar Move COMET progress bar or not on show progress
 * @return false, if file is not accessible
 */
function db_import_sql_file($file, $buffer = 16384, $show_status = true, $show_create_table = 1, $check_prefix = false, $track = false, $skip_errors = false, $move_progress_bar = true)
{
	if (file_exists($file)) {
		
		$path = dirname($file);
		$file_name = fn_basename($file);
		$tmp_file = $path . "/$file_name.tmp";

		$executed_queries = array();
		if ($track && file_exists($tmp_file)) {
			$executed_queries = unserialize(fn_get_contents($tmp_file));
		}

		if ($skip_errors) {
			$_skip_errors = Registry::get('runtime.database.skip_errors');
			Registry::set('runtime.database.skip_errors', true);
		}

		$fd = fopen($file, 'r');
		if ($fd) {
			$ret = array();
			$rest = '';
			$fs = filesize($file);

			if ($show_status && $move_progress_bar) {
				fn_set_progress('total', ceil($fs / $buffer));
			}

			$br = (defined('CONTROLLER') && CONTROLLER == 'upgrade_center') ? '<br />' : '';

			while (!feof($fd)) {
				$str = $rest.fread($fd, $buffer);

				$rest = fn_parse_queries($ret, $str);

				if ($show_status) {
					fn_set_progress('echo', $br . fn_get_lang_var('importing_data'), $move_progress_bar);
				}

				if (!empty($ret)) {
					foreach ($ret as $query) {
						if (!in_array($query, $executed_queries)) {
							if ($show_create_table && preg_match('/CREATE\s+TABLE\s+`?(\w+)`?/i', $query, $matches)) {
								if ($show_create_table == 1) {
									$_text = fn_get_lang_var('creating_table');
								} elseif ($show_create_table == 2) {
									$_text = 'Creating table';
								}
								$table_name = $check_prefix ? fn_check_db_prefix($matches[1]) : $matches[1];
								if ($show_status) {
									fn_set_progress('echo', $br . $_text . ': <b>' . $table_name . '</b>', false);
								}
							}

							if ($check_prefix) {
								$query = fn_check_db_prefix($query);
							}
							db_query($query);

							if ($track) {
								$executed_queries[] = $query;
								fn_put_contents($tmp_file, serialize($executed_queries));
							}

							if ($show_status) {
								fn_echo(' .');
							}
						}
					}
					$ret = array();
				}
			}

			fclose($fd);
			return true;
		}

		if ($skip_errors) {
			Registry::set('runtime.database.skip_errors', $_skip_errors);
		}
	}

	return false;
}

/**
 * Get auto increment value for table
 *
 * @param string $table - database table
 * @return integer - auto increment value
 */
function db_get_next_auto_increment_id($table)
{
	$table_status = db_get_row("SHOW TABLE STATUS LIKE '?:$table'");

	return !empty($table_status['Auto_increment'])? $table_status['Auto_increment'] : $table_status['AUTO_INCREMENT'];
}

/**
 *
 * Prepare data and execute REPLACE INTO query to DB
 * If one of $data element is null function unsets it before querry
 *
 * @param string $table  Name of table that condition generated. Must be in SQL notation without placeholder.
 * @param array  $data   Array of key=>value data of fields need to insert/update
 * @return db_result
 */
function db_replace_into($table, $data)
{
	if (!empty($data)) {
		return db_query('INSERT INTO ?:' . $table . ' ?e ON DUPLICATE KEY UPDATE ?u', $data, $data);
	} else {
		return false;
	}
}

/**
 * Function removes all records in child table with no parent records
 * Table names must be in SQL notation without placeholder.
 * @param string $child_table Name of table for removing records.
 * @param string $child_foreign_key Name of field in child table with parent record id
 * @param string $parent_table Name of table with parent records.
 * @param string $parent_primary_key primary key in parent table, if empty will be equal $child_foreign_key
 */
function db_remove_missing_records($child_table, $child_foreign_key, $parent_table, $parent_primary_key = '')
{
	if ($parent_primary_key == '') {
		$parent_primary_key = $child_foreign_key;
	}
	db_query("DELETE FROM ?:$child_table WHERE $child_foreign_key NOT IN (SELECT $parent_primary_key FROM ?:$parent_table)");
}
?>
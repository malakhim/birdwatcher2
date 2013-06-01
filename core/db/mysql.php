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

//
// Database function wrappers (mySQL)
//

// Returns connection ID or false on failure
function driver_db_connect($db_host, $db_user, $db_password, $dbc_name = 'main')
{
	$db_conn = mysql_connect($db_host, $db_user, $db_password, true);
	if (!empty($db_conn)) {
		Registry::set('runtime.dbs.' . $dbc_name, $db_conn);
	}
	
	return $db_conn;
}

// Returns connection ID or false on failure
function driver_db_select($db_name, $db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	if (@mysql_select_db($db_name, $db_conn)) {
		return $db_conn;
	}

	return false;
}

function driver_db_create($db_name)
{
	return driver_db_query("CREATE DATABASE IF NOT EXISTS `$db_name`");
}

function driver_db_query($query, $db = '')
{
	$db = (!empty($db) && Registry::get('runtime.dbs.' . $db)) ? $db : 'main';
	$db_conn = & Registry::get('runtime.dbs.' . $db);

	static $reconnect_attempts = 0;

	$result = mysql_query($query, $db_conn);

	if (empty($result)) {
		// Lost connection, try to reconnect (max - 3 times)
		if ((mysql_errno($db_conn) == 2013 || mysql_errno($db_conn) == 2006) && $reconnect_attempts < 3) {
			driver_db_close($db);
			$db_conn = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), Registry::get('config.db_name'));
			$reconnect_attempts++;
			$result = driver_db_query($query, $db);

		// Assume that the table is broken
		// Try to repair
		} elseif (preg_match("/'(\S+)\.(MYI|MYD)/", mysql_error($db_conn), $matches)) {
			$result = mysql_query("REPAIR TABLE $matches[1]", $db_conn);
		}
	}

	return $result;
}

function driver_db_query_nocheck($query, $db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	$result = mysql_query($query, $db_conn);
	return $result;
}

function driver_db_result($result, $offset)
{
	return mysql_result($result, $offset);
}

function driver_db_fetch_row($result)
{
	return mysql_fetch_row($result);
}

function driver_db_fetch_array($result, $flag = MYSQL_ASSOC)
{
	return mysql_fetch_array($result, $flag);
}

function driver_db_free_result($result)
{
	@mysql_free_result($result);
}

function driver_db_num_rows($result)
{
	return mysql_num_rows($result);
}

function driver_db_insert_id($db = '') 
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	return mysql_insert_id($db_conn);
}

function driver_db_affected_rows($db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	return mysql_affected_rows($db_conn);
}

function driver_db_errno($db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	static $skip_error_codes = array (
		1091, // column exists/does not exist during alter table
		1176, // key does not exist during alter table
		1050, // table already exist 
		1060  // column exists
	);

	$errno = mysql_errno($db_conn);

	return in_array($errno, $skip_error_codes) ? 0 : $errno;
}

function driver_db_error($db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	return mysql_error($db_conn);
}

function driver_db_close($db = '')
{
	$db_conn = & Registry::get('runtime.dbs.' . (!empty($db) && Registry::get('runtime.dbs.' . $db) ? $db : 'main'));

	return @mysql_close($db_conn);
}

?>
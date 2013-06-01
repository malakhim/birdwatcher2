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

if (!defined('AREA')) { die('Access denied'); }

/**
 * Cache backend class, implements 4 methods:
 * get - get data from the cache storage
 * set - set data to the cache storage
 * clear - clear expired data
 * save_handlers - save cache handlers
 * cleanup - delete all cached data
 */
class CacheBackend_Sqlite {

	static private $db;
	static private $db_fetch;
	static private $db_class;
	static private $_cache_handlers = array();
	static private $_cache_handlers_are_updated = false;
	static private $company_id = 0;

	static private $sqlite_timeout = 60000;

	static function set($name, $data, $condition, $cache_level = NULL)
	{
		$fname = $name . '.' . $cache_level;

		if (!empty($data)) {
			self::$db->query("REPLACE INTO cache"
				. " (name, company_id, data, tags, expiry) VALUES ("
					. "'$fname', "
					. self::$company_id . ", "
					. self::_db_escape(serialize($data)) . ", "
					. "'$name', "
					. (($cache_level == CACHE_LEVEL_TIME) ? TIME + $condition : 0)
				. ")"
			);

			if ($cache_level != CACHE_LEVEL_TIME) {
				foreach ($condition as $table) {
					if (empty(self::$_cache_handlers[$table])) {
						self::$_cache_handlers[$table] = array();
					}

					self::$_cache_handlers[$table][$name] = true;
					self::$_cache_handlers_are_updated = true;
				}
			}
		}

	}

	static function get($name, $cache_level = NULL)
	{
		$fname = $name . '.' . $cache_level;

		$expiry_condition = ($cache_level == CACHE_LEVEL_TIME) ? db_quote(" AND expiry > ?i", TIME) : '';
		$res = self::_db_fetch("SELECT data, expiry FROM cache WHERE name = '$fname' AND company_id = " . self::$company_id . $expiry_condition);

		if (!empty($name) && !empty($res)) {
			$_cache_data = (!empty($res['data'])) ? @unserialize($res['data']) : false;
			if ($_cache_data !== false) {
				return array($_cache_data);
			}

			// clean up the cache
			self::$db->query("DELETE FROM cache WHERE name = '$fname' AND company_id = " . self::$company_id);
		}


		return false;
	}

	static function clear($changed_tables)
	{
		$tags = array();
		foreach ($changed_tables as $table => $flag) {
			if (!empty(self::$_cache_handlers[$table])) {
				$tags = array_merge($tags, array_keys(self::$_cache_handlers[$table]));
			}
		}



		$tags = array_unique($tags);

		if (!empty($tags)) {
			self::$db->query("DELETE FROM cache WHERE tags IN ('" . implode("', '", $tags) . "')");
		}

		return true;
	}

	static function save_handlers()
	{
		if (self::$_cache_handlers_are_updated == true) {
			self::$db->query("REPLACE INTO cache (name, company_id, data) VALUES ("
					. "'cache_handlers', "
					. self::$company_id . ", "
					. self::_db_escape(serialize(self::$_cache_handlers))
				. ")"
			);
			self::$_cache_handlers_are_updated = false;
		}
		return true;
	}

	static function cleanup()
	{
		$all_stores_selected = (!defined('SELECTED_COMPANY_ID') || defined('SELECTED_COMPANY_ID') && SELECTED_COMPANY_ID == 'all');

		if (PRODUCT_TYPE != 'ULTIMATE' || PRODUCT_TYPE == 'ULTIMATE' && $all_stores_selected) {
			// clear all stores cache
			fn_rm(DIR_CACHE_REGISTRY, false);
		} else {
			//clear cache only for one store
			self::init();
			self::$db->query("DELETE FROM cache WHERE company_id = " . SELECTED_COMPANY_ID);
		}

		return true;
	}

	static function init($dir_cache = DIR_CACHE_REGISTRY)
	{
		fn_mkdir($dir_cache);

		$init_db = false;
		if (!file_exists($dir_cache . 'cache.db')) {
			$init_db = true;
		}

		self::$db = self::_db_init($dir_cache);
		self::_set_timeout(self::$sqlite_timeout);

		if ($init_db == true) { 
			self::$db->query('CREATE TABLE cache (name varchar(128), company_id int, data text, expiry int, tags varchar(64), PRIMARY KEY(name, company_id))');
			self::$db->query('CREATE INDEX tags ON cache (tags)');
			self::$db->query('CREATE INDEX company_id ON cache (company_id)');
			self::$db->query('CREATE INDEX exp ON cache (name, company_id, expiry)');
		}

		if (defined('SELECTED_COMPANY_ID')) {
			self::$company_id = intval(SELECTED_COMPANY_ID);
		}

		$ch = self::_db_fetch("SELECT data FROM cache WHERE name = 'cache_handlers' AND company_id = " . self::$company_id);
		self::$_cache_handlers = !empty($ch['data']) ? @unserialize($ch['data']) : array();

		return true;
	}

	static function _db_fetch($query)
	{
		$res = self::$db->query($query);
		$fe = array();
		if (!empty($res)) {
			if (self::$db_class == 'SQLite3') {
				$fe = $res->fetchArray(self::$db_fetch);
			} else {
				$fe = $res->fetch(self::$db_fetch);
			}
		}

		return $fe;
	}

	static function _db_escape($string)
	{
		if (self::$db_class == 'SQLite3') {
			return "'" . SQLite3::escapeString($string) . "'";
		} elseif (self::$db_class == 'SQLiteDatabase') {
			return "'" . sqlite_escape_string($string) . "'";
		} else {
			return self::$db->quote($string);
		}
	}

	static function _db_close()
	{
		if (self::$db_class == 'SQLite3') {
			return self::$db->close();
		} elseif (self::$db_class == 'PDO') {
			self::$db = null;
			return true;
		} elseif (self::$db_class == 'SQLiteDatabase') {
			return sqlite_close(self::$db);
		} else {
			return false;
		}
	}
	
	function _db_init($dir_cache = DIR_CACHE_REGISTRY)
	{
		$pdo_sqlite = false;
		if (!class_exists('SQLite3') && class_exists('PDO')) {
			$drivers = PDO::getAvailableDrivers();
			if (!empty($drivers)) {
				foreach ($drivers as $driver) {
					if (strpos($driver, 'sqlite') !== false) {
						$pdo_sqlite = true;
						break;
					}
				}
			}
		}
		
		$init_prefix = '';
		if (class_exists('SQLite3')) {
			self::$db_class = 'SQLite3';
			self::$db_fetch = SQLITE3_ASSOC;

		} elseif (class_exists('PDO') && $pdo_sqlite) {
			self::$db_class = 'PDO';
			self::$db_fetch = PDO::FETCH_ASSOC;
			$init_prefix = 'sqlite://';

		} elseif (class_exists('SQLiteDatabase')) {
			self::$db_class = 'SQLiteDatabase';
			self::$db_fetch = SQLITE_ASSOC;
		} else {
			die('SQLITE cache data storage is not supported. Please choose another one.');
		}

		return new self::$db_class($init_prefix . $dir_cache . 'cache.db');
	}

	/**
	 * Sets timeout for waiting if SQLite database is busy.
	 * @param int $msec Timeout in milliseconds
	 * @return boolean
	 */
	function _set_timeout($msec)
	{
		$result = false;
		
		if ((self::$db_class == 'SQLite3' || self::$db_class == 'SQLiteDatabase') && method_exists(self::$db, 'busyTimeout')) {
			$result = self::$db->busyTimeout($msec);
		} elseif (self::$db_class == 'PDO') {
			$result = self::$db->setAttribute(PDO::ATTR_TIMEOUT, ($msec / 1000));
		}

		return $result;
	}
}

?>
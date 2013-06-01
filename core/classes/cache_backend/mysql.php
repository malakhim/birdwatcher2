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
class CacheBackend_Mysql {

	static private $_cache_handlers = array();
	static private $_cache_handlers_are_updated = false;
	static private $company_id = 0;

	static function set($name, $data, $condition, $cache_level = NULL)
	{
		$fname = $name . '.' . $cache_level;

		if (!empty($data)) {
			db_query("REPLACE INTO ?:cache ?e", array(
				'name' => $fname,
				'company_id' => self::$company_id,
				'data' => serialize($data),
				'tags' => $name,
				'expiry' => ($cache_level == CACHE_LEVEL_TIME) ? TIME + $condition : 0
			));

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

		Registry::set('runtime.database.skip_cache', true);
		$expiry_condition = ($cache_level == CACHE_LEVEL_TIME) ? db_quote(" AND expiry > ?i", TIME) : '';
		$res = db_get_row("SELECT data, expiry FROM ?:cache WHERE name = ?s AND company_id = ?i ?p", $fname, self::$company_id, $expiry_condition);
		Registry::set('runtime.database.skip_cache', false);

		if (!empty($name) && !empty($res)) {
			$_cache_data = (!empty($res['data'])) ? @unserialize($res['data']) : false;
			if ($_cache_data !== false) {
				return array($_cache_data);
			}

			// clean up the cache
			db_query("DELETE FROM ?:cache WHERE name = ?s AND company_id = ?i", $fname, self::$company_id);
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

		db_query("DELETE FROM ?:cache WHERE tags IN (?a)", $tags);

		return true;
	}

	static function save_handlers()
	{
		if (self::$_cache_handlers_are_updated == true) {
			db_query("REPLACE INTO ?:cache ?e", array(
				'name' => 'cache_handlers',
				'company_id' => self::$company_id,
				'data' => serialize(self::$_cache_handlers)
			));
			self::$_cache_handlers_are_updated = false;
		}
		return true;
	}

	static function cleanup()
	{
		Registry::set('runtime.database.skip_errors', true);

		$all_stores_selected = (!defined('SELECTED_COMPANY_ID') || defined('SELECTED_COMPANY_ID') && SELECTED_COMPANY_ID == 'all');

		if (PRODUCT_TYPE != 'ULTIMATE' || PRODUCT_TYPE == 'ULTIMATE' && $all_stores_selected) {
			// clear all stores cache
			db_query("TRUNCATE ?:cache");
		} else {
			// clear cache only for one store
			db_query("DELETE FROM ?:cache WHERE company_id = ?i", SELECTED_COMPANY_ID);
		}

		Registry::set('runtime.database.skip_errors', false);

		return true;
	}


	static function init()
	{
		Registry::set('runtime.database.skip_cache', true);
		if (!db_get_field("SHOW TABLES LIKE '?:cache'")) {
			Registry::set('runtime.database.skip_errors', true);
			$res = db_query('CREATE TABLE ?:cache (name varchar(255), company_id int(11) unsigned not null default \'0\', data mediumtext, expiry int, tags varchar(255), PRIMARY KEY(name, company_id), KEY (tags), KEY (name, company_id, expiry), KEY (company_id)) Engine=MyISAM DEFAULT CHARSET UTF8');

			Registry::set('runtime.database.skip_errors', false);
			if ($res == false) {
				die('MySQL cache data storage is not supported. Please choose another one.');
			}
		}

		if (defined('SELECTED_COMPANY_ID')) {
			self::$company_id = intval(SELECTED_COMPANY_ID);
		}

		$ch = db_get_field("SELECT data FROM ?:cache WHERE name = 'cache_handlers' AND company_id = ?i", self::$company_id);
		self::$_cache_handlers = !empty($ch) ? @unserialize($ch) : array();
		Registry::set('runtime.database.skip_cache', false);

		return true;
	}
}

?>
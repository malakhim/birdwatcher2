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
class CacheBackend_File {
	static private $_handlers_name = 'cache_update_handlers';
	static private $_cache_handlers = array();
	static private $_cache_handlers_are_updated = false;
	static private $_company_id = '0';

	static function set($name, $data, $condition, $cache_level = NULL)
	{
		if (!empty($data)) {
			$dir_cache = DIR_CACHE_REGISTRY . $name . '/' . self::$_company_id;
			fn_mkdir($dir_cache);
			fn_put_contents("$dir_cache/$cache_level.csc", serialize(array(
				'data' => $data,
				'expiry' => $cache_level == CACHE_LEVEL_TIME ? TIME + $condition : 0
			)));

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
		$fname = DIR_CACHE_REGISTRY . $name . '/' . self::$_company_id . '/' . $cache_level . '.csc';

		if (!empty($name) && is_readable($fname)) {
			$_cache_data = @unserialize(fn_get_contents($fname));
			if (!empty($_cache_data) && ($cache_level != CACHE_LEVEL_TIME || ($cache_level == CACHE_LEVEL_TIME && $_cache_data['expiry'] > TIME))) {

				return array($_cache_data['data']);

			} else { // clean up the cache
				fn_rm($fname);
			}
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

		foreach ($tags as $tag) {
			fn_rm(DIR_CACHE_REGISTRY . $tag, true);
		}

		return true;
	}

	static function save_handlers()
	{
		if (self::$_cache_handlers_are_updated == true) {
			fn_put_contents(DIR_CACHE_REGISTRY . self::$_handlers_name . '_' . self::$_company_id . '.csc', serialize(self::$_cache_handlers));
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
			fn_rm(DIR_CACHE_REGISTRY . self::$_handlers_name . '_' . SELECTED_COMPANY_ID . '.csc');
			$dirs = fn_get_dir_contents(DIR_CACHE_REGISTRY);
			foreach ($dirs as $dir) {
				fn_rm(DIR_CACHE_REGISTRY . '/' . $dir . '/' . SELECTED_COMPANY_ID, true);
			}
		}

		return true;
	}

	static function init()
	{
		fn_mkdir(DIR_CACHE_REGISTRY);

		if (defined('SELECTED_COMPANY_ID')) {
			self::$_company_id = intval(SELECTED_COMPANY_ID);
		}

		$ch = fn_get_contents(DIR_CACHE_REGISTRY . self::$_handlers_name . '_' . self::$_company_id . '.csc');
		self::$_cache_handlers = !empty($ch) ? @unserialize($ch) : array();

		return true;
	}

}

?>
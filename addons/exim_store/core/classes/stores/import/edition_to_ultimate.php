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

abstract class Stores_Import_EditionToUltimate extends Stores_Import_Base
{
	public function import()
	{
		return true;
	}

	public function getExpectSettings()
	{
		return array (
			'Appearance.default_products_layout',
			'Appearance.default_products_layout_templates',
			'Appearance.default_products_sorting',
			'Upgrade_center.license_number',
		);
	}

	protected function _importAddon($addon_data, $company_id)
	{
		$status = Registry::get('addons.' . $addon_data['addon'] . '.status');
		Stores_Import_General::connectToOriginalDB();

		if (fn_install_addon($addon_data['addon'], false)) {
			$this->_importAddonSettings($addon_data);

			$this->importObject('addon_' . $addon_data['addon'], $company_id);

			if (empty($status)) {
				fn_disable_addon($addon_data['addon'], '', false);
			}
		}
	}

	public function getCompanies()
	{
		$companies = array();

		$new_db = Stores_Import_General::connectToImportedDB($this->store_data);

		if ($new_db != null) {

			$company = $this->getCompanyData();
			
			$companies[] = array(
	            'status' => 'A',
	            'company' => $company['company_name'],
	            'lang_code' => DEFAULT_LANGUAGE,
	            'address' =>  $company['company_address'],
	            'city' =>  $company['company_city'],
	            'state' =>  $company['company_state'],
	            'country' =>  $company['company_country'],
	            'zipcode' =>  $company['company_zipcode'],
	            'email' =>  $company['company_site_administrator'],
	            'phone' =>  $company['company_phone'],
	            'fax' =>  $company['company_fax'],
	            'url' =>  $company['company_website'],
	            'shippings' => ''
			);
		}

		return $companies;
	}

	public function saveObjectIds($object_id, $table_data)
	{
		$store_data = $this->store_data;

		Stores_Import_General::connectToImportedDB($store_data);

		$total = db_get_field('SELECT COUNT(*) FROM ?:' . $table_data['name']);
		$start = 0;
		$step = $this->limit_step_small_data;

		while ($start < $total) {
			Stores_Import_General::connectToImportedDB($store_data);

			$condition = $this->_prepareObjectCondition($table_data);
			$ids = db_get_fields('SELECT ' . $table_data['key'] . ' FROM ?:' . $table_data['name'] . ' WHERE 1 ' . $condition . ' LIMIT ?i, ?i', $start, $step);

			if (empty($ids)) {
				break;
			}

			$query = array();
			foreach ($ids as $id) {
				$query[] = db_quote('(?s, ?s, ?s)', $id, 0, $object_id);
			}

			Stores_Import_General::connectToOriginalDB($store_data);
			db_query('INSERT INTO ?:upgrade_objects VALUES ' . implode(',', $query));

			$start += $step;
		}
	}

	protected function _prepareObjectCondition($table_data)
	{
		$condition = '';

		if (!empty($table_data['condition'])) {
			$condition = ' AND ' . implode(' AND ', $table_data['condition']);

			preg_match_all('/%(.*?)%/', $condition, $variables);
			foreach ($variables[1] as $variable) {
				$variable = fn_strtolower($variable);
				$var = $$variable;
				if (is_array($var)) {
					$var = implode(', ', $var);
				}

				$condition = preg_replace('/%(.*?)%/', $var, $condition, 1);
			}
		}

		return $condition;
	}

	public function importObject($object, $company_id)
	{
		fn_set_progress('echo', fn_get_lang_var('es_import_object') . ': ' . $object);

		$scheme = $this->scheme;
		$store_data = $this->store_data;

		if (!isset($scheme[$object])) {
			// Clone scheme not found
			return false;
		}

		if (!empty($scheme[$object]['tables']) && !$this->_tablesExist($scheme[$object]['tables'])) {
			// Some tables not found
			return false;
		}

		if (!empty($scheme[$object]['tables'])) {
			foreach ($scheme[$object]['tables'] as $table_data) {
				$this->saveObjectIds($table_data['name'], $table_data);

				$result = $this->cloneTableData($table_data, array(), 0, $company_id);
				$new_data = db_get_hash_single_array("SELECT new_object_id, object_id FROM ?:upgrade_objects WHERE object = ?s", array('object_id', 'new_object_id'), $table_data['name']);

				if (!empty($new_data) && !empty($table_data['use_objects_sharing'])) {
					// Clone object found in sharing scheme. Share new object as well
					Stores_Import_General::connectToOriginalDB();
					foreach ($new_data as $old_id => $new_id) {
						db_query('REPLACE INTO ?:ult_objects_sharing (share_object_id, share_object_type, share_company_id) VALUES (?s, ?s, ?i)', $new_id, $table_data['name'], $company_id);
					}
				}
			}
		}

		if (!empty($scheme[$object]['function'])) {
			call_user_func(array($this, $scheme[$object]['function']), $scheme[$object], $company_id, $store_data);
		}

		return true;
	}

	public function cloneTableData($table_data, $clone_data, $start, $company_id)
	{
		$scheme = $this->scheme;
		$store_data = $this->store_data;

		$cloned_ids = array();
		$clone_id = $table_data['name'];

		$step = $this->limit_step_big_data;
		$return = array();

		$total = 0;
		if (empty($clone_data)) {
			Stores_Import_General::connectToOriginalDB();

			$total = db_get_field('SELECT COUNT(*) FROM ?:upgrade_objects WHERE object = ?s', $table_data['name']);
			if ($start < $total) {
				unset($cloned_ids);
				unset($data);
				unset($_data);
			}
		}

		do {
			$condition = $this->_prepareObjectCondition($table_data);

			Stores_Import_General::connectToImportedDB($store_data);

			if (!empty($table_data['dependence_tree'])) {
				$ids = $this->buildDependenceTree($table_data['name'], $table_data['key'], $parent = 'parent_id');

				$_data = db_get_hash_array('SELECT * FROM ?:' . $table_data['name'] . ' WHERE 1 ' . $condition . ' AND ' . $table_data['key'] . ' IN (?a)', $table_data['key'], $ids);
				$data = array();

				foreach ($ids as $id) {
					if (isset($_data[$id])) {
						$data[] = $_data[$id];
					}
				}

				unset($_data, $ids);

				$start = db_get_field('SELECT COUNT(*) FROM ?:' . $table_data['name'], $company_id);

			} elseif (empty($clone_data)) {
				Stores_Import_General::connectToOriginalDB();
				$ids = db_get_fields('SELECT object_id FROM ?:upgrade_objects WHERE (new_object_id = ?s || new_object_id = ?s) AND object = ?s ORDER BY ABS(object_id) ASC LIMIT ?i', '0', '', $table_data['name'], $step);

				Stores_Import_General::connectToImportedDB($store_data);
				$data = db_get_array('SELECT * FROM ?:' . $table_data['name'] . ' WHERE ' . $table_data['key'] . ' IN (?a) ' . $condition . ' ORDER BY ABS(' . $table_data['key'] . ') ASC', $ids);
			} else {
				$data = db_get_array('SELECT * FROM ?:' . $table_data['name'] . ' WHERE ' . $table_data['key'] . ' IN (?a) ' . $condition, array_keys($clone_data));
			}

			Stores_Import_General::connectToOriginalDB();

			if (!empty($data)) {
				foreach ($data as $id => $row) {
					fn_echo('.');

					if (!empty($table_data['key'])) {
						$key = $row[$table_data['key']];

						if (empty($table_data['permanent_key'])) {
							if (empty($clone_data)) {
								unset($row[$table_data['key']]);
							} else {
								$row[$table_data['key']] = $clone_data[$row[$table_data['key']]];
							}
						}
					}

					$row['company_id'] = $company_id;

					if (!empty($table_data['exclude'])) {
						foreach ($table_data['exclude'] as $exclude_field) {
							unset($row[$exclude_field]);
						}
					}

					if (!empty($table_data['pre_process'])) {
						call_user_func(array($this, $table_data['pre_process']), $table_data, $row, $clone_data, $cloned_ids, $store_data);
					}

					if (!empty($table_data['check_fields'])) {
						foreach ($table_data['check_fields'] as $field) {
							$new_object_id = $this->getNewObjectId($field[0], $field[1]);
							if (empty($new_object_id)) {
								continue;
							}
						}
					}

					$new_key = db_query('REPLACE INTO ?:' . $table_data['name'] . ' ?e', $row);

					if (!empty($table_data['permanent_key'])) {
						$new_key = $key;
					}

					if (!empty($key)) {
						$cloned_ids[$key] = $new_key;
					}

					db_query('UPDATE ?:upgrade_objects SET new_object_id = ?s WHERE object = ?s AND object_id = ?s', $new_key, $table_data['name'], $key);

					if (!empty($table_data['return_clone_data'])) {
						if (count($table_data['return_clone_data']) == 1 && reset($table_data['return_clone_data']) == $table_data['key']) {
							$return[$table_data['key']][$key] = $new_key;
						} else {
							$_key = !empty($table_data['return_clone_data']) ? reset($table_data['return_clone_data']) : $table_data['key'];
							$new_data = db_get_row('SELECT ' . implode(', ', $table_data['return_clone_data']) . ' FROM ?:' . $table_data['name'] . ' WHERE `' . $_key . '` = ?s', $new_key);

							foreach ($table_data['return_clone_data'] as $field) {
								$return[$field][$data[$id][$field]] = $new_data[$field];
							}
						}
					}

					if (!empty($table_data['post_process'])) {
						call_user_func(array($this, $table_data['post_process']), $new_key, $table_data, $row, $clone_data, $cloned_ids, $store_data);
					}
				}

				if (!empty($table_data['children'])) {
					$__data = !empty($table_data['return_clone_data']) ? reset($return) : $cloned_ids;
					
					unset($cloned_ids);

					foreach ($table_data['children'] as $child_data) {
						$this->cloneTableData($child_data, $__data, 0, $company_id);
					}
				}
			}

			$start += $step;

		} while (($start - $step) < $total);

		return $return;
	}

	public function buildDependenceTree($table, $key, $parent = 'parent_id', $tree = array(), $from_ids = array())
	{
		if (!empty($from_ids)) {
			$parent_id = $from_ids;
		} else {
			$parent_id = array(0);
		}

		$from_ids = db_get_fields('SELECT ' . $key . ' FROM ?:' . $table . ' WHERE ' . $parent . ' IN (?a)', $parent_id);

		if (!empty($from_ids)) {
			foreach ($from_ids as $id) {
				array_push($tree, $id);
			}
		}

		if (!empty($from_ids)) {
			$tree = $this->buildDependenceTree($table, $key, $parent, $tree, $from_ids);
		}

		return $tree;
	}

	abstract protected function _getImportScheme();

	protected function getNewObjectId($old_object_id, $object)
	{
		return db_get_field('SELECT new_object_id FROM ?:upgrade_objects WHERE object_id = ?s AND object = ?s', $old_object_id, $object);
	}

	protected function getOldObjectId($new_object_id, $object)
	{
		return db_get_field('SELECT object_id FROM ?:upgrade_objects WHERE new_object_id = ?s AND object = ?s', $new_object_id, $object);
	}

	protected function getNewUsergroupId($old_object_id)
	{
		if ($old_object_id < 3) {
			// do not touch hardcoded usergroup ids 0, 1, 2
			return $old_object_id;
		} else {
			return $this->getNewObjectId($old_object_id, 'usergroups');
		}
	}

	/**
	 * gets new usergroups ids
	 *
	 * @param string $old_usergroup_ids Comma-separated list of usergroup ids
	 */
	protected function getNewUsergroupIds($old_usergroup_ids)
	{
		$new_usergroup_ids = '';

		if (!empty($old_usergroup_ids)) {
			$old_usergroup_ids = explode(',', $old_usergroup_ids);
			$new_usergroup_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object_id IN(?a) AND object = ?s', $old_usergroup_ids, 'usergroups');

			$hardcoded_usergroup_ids = array('2', '1', '0');

			foreach ($hardcoded_usergroup_ids as $hard_ugid) {
				if (in_array($hard_ugid, $old_usergroup_ids)) {
					array_unshift($new_usergroup_ids, $hard_ugid);
				}

			}

			$new_usergroup_ids = implode(',', $new_usergroup_ids);
		}

		return $new_usergroup_ids;
	}

	protected function _tablesExist($tables_scheme)
	{
		$store_data = $this->store_data;
		$table_prefix = $store_data['table_prefix'];

		$tables = array();

		foreach ($tables_scheme as $table) {
			$tables[] = $table_prefix . $table['name'];
			if (!empty($table['children'])) {
				foreach ($table['children'] as $child_table) {
					$tables[] = $table_prefix . $child_table['name'];
				}
			}
		}

		Stores_Import_General::connectToImportedDB($store_data);
		$all_db_tables = $this->getTables();

		$res = array_diff($tables, $all_db_tables);
		if (defined('DEVELOPMENT') && !empty($res)) {
			Stores_Import_General::connectToOriginalDB();
			fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[tables]', trim(implode(', ', $res)), fn_get_lang_var('es_tables_not_found')));
		}

		return empty($res);
	}

	public function copyCurrencies($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);

		// Get all available languages and compare its with existing.
		$currencies = db_get_hash_array('SELECT * FROM ?:currencies', 'currency_code');
		$currency_descr = db_get_array('SELECT * FROM ?:currency_descriptions');
		$old_primary_currency = db_get_field('SELECT currency_code FROM ?:currencies WHERE is_primary = ?s', 'Y');

		Stores_Import_General::connectToOriginalDB();
		$existing = db_get_hash_array('SELECT * FROM ?:currencies', 'currency_code');
		$current_primary_currency = db_get_field('SELECT currency_code FROM ?:currencies WHERE is_primary = ?s', 'Y');

        if ($old_primary_currency != $current_primary_currency) {
            fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('es_different_primary_currencies'));
        }

		$new_currencies = array_diff_key($currencies, $existing);

		if (!empty($new_currencies)) {
			// We have to create new currencies
			foreach ($new_currencies as $currency_code => $currency_data) {
				$currency_data['is_primary'] = 'N';

				db_query("INSERT INTO ?:currencies ?e", $currency_data);

				foreach ($currency_descr as $descr) {
					if ($descr['currency_code'] == $currency_code) {
						db_query("INSERT INTO ?:currency_descriptions ?e", $descr);
					}
				}
			}
		}

		// Share languages to new company
		foreach ($currencies as $currency_code => $currency_data) {
			db_query('INSERT IGNORE INTO ?:ult_objects_sharing (share_company_id, share_object_id, share_object_type) VALUES (?i, ?s, ?s)', $company_id, $currency_code, 'currencies');
		}
	}

	public function copyProducts($object, $company_id, $store_data)
	{
		// Process products/categories links
		$total = db_get_field('SELECT COUNT(*) FROM ?:upgrade_objects WHERE object = ?s', 'products');
		$start = 0;
		$step = $this->limit_step_small_data;

		$cids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'object_id', 'categories');

		while ($start < $total) {
			$pids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s LIMIT ?i, ?i', 'object_id', 'products', $start, $step);
			$start += $step;

			Stores_Import_General::connectToImportedDB($store_data);
			$links = db_get_array('SELECT * FROM ?:products_categories WHERE product_id IN (?a)', array_keys($pids));
			$global_options_links = db_get_array('SELECT * FROM ?:product_global_option_links WHERE product_id IN (?a)', array_keys($pids));

			if (!empty($links)) {
				$query = array();
				foreach ($links as $link) {
					if (!isset($pids[$link['product_id']]) || !isset($cids[$link['category_id']])) {
						continue;
					}
					$query[] = db_quote('(?i, ?i, ?s, ?i)', $pids[$link['product_id']]['new_object_id'], $cids[$link['category_id']]['new_object_id'], $link['link_type'], $link['position']);
				}

				Stores_Import_General::connectToOriginalDB();
				db_query('REPLACE INTO ?:products_categories VALUES ' . implode(', ', $query));
			}

			if (!empty($global_options_links)) {
				$links = array();
				foreach ($global_options_links as $link) {
					$links[$link['option_id']] = $link['product_id'];
				}

				$oids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_options', array_keys($links));

				$query = array();
				foreach ($links as $option_id => $product_id) {
					$query[] = db_quote('(?i, ?i)', $oids[$option_id]['new_object_id'], $pids[$product_id]['new_object_id']);
				}

				Stores_Import_General::connectToOriginalDB();
				db_query('REPLACE INTO ?:product_global_option_links VALUES ' . implode(', ', $query));
			}
		}

		$cids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'categories');
		fn_update_product_count($cids);

		// Release memory
		unset($cids, $pids, $links, $query);

		$this->processProductOptionsInventory($company_id, $store_data);
	}

	public function copyBestsellers($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$total = db_get_field('SELECT COUNT(*) FROM ?:product_sales');
		$start = 0;
		$step = $this->limit_step_big_data;

		Stores_Import_General::connectToOriginalDB();
		$category_new_ids = db_get_hash_single_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s', array('object_id', 'new_object_id'), 'categories');

		while ($start < $total) {
			Stores_Import_General::connectToImportedDB($store_data);
			$data = db_get_hash_array('SELECT * FROM ?:product_sales LIMIT ?i, ?i', 'product_id', $start, $step);
			$product_old_ids = array_keys($data);

			Stores_Import_General::connectToOriginalDB();
			$product_new_ids = db_get_hash_single_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', array('object_id', 'new_object_id'), $product_old_ids, 'products');

			foreach ($data as $row) {
				if (!isset($category_new_ids[$row['category_id']]) || !isset($product_new_ids[$row['product_id']])) {
					db_query('DELETE FROM ?:product_sales WHERE category_id = ?i AND product_id = ?i', $row['category_id'], $row['product_id']);

					continue;
				}

				$row['category_id'] = $category_new_ids[$row['category_id']];
				$row['product_id'] = $product_new_ids[$row['product_id']];

				db_query('REPLACE INTO ?:product_sales ?e', $row);
			}

			unset($product_new_ids);

			$start += $step;
		}

		unset($category_new_ids);
	}

	public function copyCustomersAlsoBought($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$total = db_get_field('SELECT COUNT(*) FROM ?:also_bought_products');
		$start = 0;
		$step = $this->limit_step_small_data;

		while ($start < $total) {
			Stores_Import_General::connectToImportedDB($store_data);
			$data = db_get_array('SELECT * FROM ?:also_bought_products LIMIT ?i, ?i', $start, $step);

			$product_old_ids = array();
			foreach ($data as $row) {
				$product_old_ids[$row['product_id']] = 0;
				$product_old_ids[$row['related_id']] = 0;
			}
			$product_old_ids = array_keys($product_old_ids);

			Stores_Import_General::connectToOriginalDB();
			$product_new_ids = db_get_hash_single_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', array('object_id', 'new_object_id'), $product_old_ids, 'products');

			$replace_data = array();

			foreach ($data as $row) {
				if (!empty($product_new_ids[$row['product_id']]) && !empty($product_new_ids[$row['related_id']])) {
					$row['product_id'] = $product_new_ids[$row['product_id']];
					$row['related_id'] = $product_new_ids[$row['related_id']];

					$replace_data[] = '(' . implode(',', $row) . ')';
				}
			}

			if (!empty($replace_data)) {
				db_query('REPLACE INTO ?:also_bought_products (' . implode(',', array_keys($data[0])) . ') VALUES ' . implode(',', $replace_data));
			}

			unset($product_new_ids);
			unset($replace_data);

			$start += $step;
		}
	}

	/**
	 * Post processes static data after main import, manually copy not shared static data (menu links)
	 *
	 * @param array $object Imported object scheme
	 * @param int $company_id Company identifier
	 * @param array $store_data Imported store data (path, configuration, etc.)
	 */
	public function copyStaticData($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToOriginalDB();

		//set company to NULL for shared static data
		db_query('UPDATE ?:static_data SET company_id = NULL WHERE company_id = ?i', $company_id);

		Stores_Import_General::connectToImportedDB($store_data);

		// get links data
		$links_data = db_get_hash_multi_array('SELECT * FROM ?:static_data WHERE section IN (?a)', array('section', 'param_id'), array('A', 'N'));

		Stores_Import_General::connectToOriginalDB();
		// create menus
		$menu_titles =  array (
			'A' => fn_get_lang_var('es_top_menu'),
			'N' => fn_get_lang_var('es_quick_links')
		);

		$clone_ids = array();
		$id_paths = array();
		$parent_ids = array();
		foreach ($links_data as $section => $links) {
			// create menu
			$menu_data = array (
				'name' => $menu_titles[$section],
				'company_id' => $company_id,
				'status' => 'A',
				'lang_code' => CART_LANGUAGE
			);

			$menu_id = Menu::update($menu_data);
			foreach ($links as $param_id => $link) {

				unset($link['param_id']);
				$link['company_id'] = $company_id;
				$link['section'] = 'A';
				$link['param_5'] = $menu_id;

				$new_param_id = db_query('REPLACE INTO ?:static_data ?e', $link);
				$clone_ids[$param_id] = $new_param_id;

				if (!empty($link['parent_id'])) {
					$parent_ids[$new_param_id] = $link;
				}

			}
		}

		// update link parents and paths
		foreach ($parent_ids as $param_id => $link) {
			$path_ids = explode('/', $link['id_path']);
			$id_path = '';
			foreach ($path_ids as $link_id) {
				if (!empty($link_id)) {
					$id_path .= '/' . (!empty($clone_ids[$link_id]) ? $clone_ids[$link_id] : '');
				}
			}

			$parent_id = !empty($clone_ids[$link['parent_id']]) ? $clone_ids[$link['parent_id']] : '';
			db_query('UPDATE ?:static_data SET parent_id = ?i, id_path = ?s WHERE param_id = ?i', $parent_id, $id_path, $param_id);
		}

		//clone links descriptions
		$table_data = array(
			'name' => 'static_data_descriptions',
			'key' => 'param_id',
		);

		$this->cloneTableData($table_data, $clone_ids, 0, $company_id);

	}

	public function copyPollsData($object, $company_id, $store_data)
	{
		$clone_ids = array();
		Stores_Import_General::connectToImportedDB($this->store_data);
		$polls = db_get_array('SELECT * FROM ?:polls');
		$poll_descriptions = db_get_hash_multi_array('SELECT * FROM ?:poll_descriptions WHERE type IN ("H", "F", "R")', array('page_id'));
		$answers = db_get_array("SELECT * FROM ?:polls_answers");

		Stores_Import_General::connectToOriginalDB();

		$new_page_ids = array();
		if (!empty($polls)) {
			foreach ($polls as $poll) {
				$old_page_id = $poll['page_id'];
				$poll['page_id'] = $this->getNewObjectId($poll['page_id'], 'pages');
				$new_page_ids[] = $poll['page_id'];
				if ($poll['show_results'] == 'Y') {
					$poll['show_results'] = 'V';
				}

				db_query("INSERT INTO ?:polls ?e", $poll);

				if (!empty($poll_descriptions[$old_page_id])) {
					foreach ($poll_descriptions[$old_page_id] as $descr) {
						$descr['page_id'] = $poll['page_id'];
						$descr['object_id'] = $poll['page_id'];
						db_query("INSERT INTO ?:poll_descriptions ?e", $descr);
					}
				}
			}
		}

		foreach ($answers as $answer) {
			$answer['vote_id'] = $this->getNewObjectId($answer['vote_id'], 'polls_votes');
			$answer['item_id'] = $this->getNewObjectId($answer['item_id'], 'poll_items');
			if (!empty($answer['answer_id'])) {
				$answer['answer_id'] = $this->getNewObjectId($answer['answer_id'], 'poll_items');
			}

			db_query('REPLACE INTO ?:polls_answers ?e', $answer);
		}

		// Correct item parents
		$items = db_get_array('SELECT * FROM ?:poll_items WHERE page_id IN (?a)', $new_page_ids);
		foreach ($items as $item) {
			if ($item['type'] == 'Q') {
				$item['parent_id'] = $item['page_id'];
			} else {
				$item['parent_id'] = $this->getNewObjectId($item['parent_id'], 'poll_items');
			}
			db_query('UPDATE ?:poll_items SET ?u WHERE item_id = ?i', $item, $item['item_id']);
		}
	}

	public function processPollItems($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();
		$new_page_id = $this->getNewObjectId($row['page_id'], 'pages');

		if (!empty($new_page_id)) {
			db_query('UPDATE ?:poll_items SET page_id = ?i WHERE item_id = ?i', $new_page_id, $new_key);
		}
	}

	public function processPollDescriptions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_page_id = $this->getNewObjectId($row['page_id'], 'pages');

		if (!empty($new_page_id)) {
			db_query('UPDATE ?:poll_descriptions SET page_id = ?i WHERE object_id = ?i AND lang_code = ?s AND type = ?s', $new_page_id, $row['object_id'], $row['lang_code'], $row['type']);
		}
	}

	public function processPollsVotes($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_data = array();
		$new_data['page_id'] = $this->getNewObjectId($row['page_id'], 'pages');
		$new_data['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:polls_votes SET ?u WHERE vote_id = ?i', $new_data, $new_key);
	}

	public function processProductOptions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_product_id = $this->getNewObjectId($row['product_id'], 'products');

		if (!empty($new_product_id)) {
			db_query('UPDATE ?:product_options SET product_id = ?i WHERE option_id = ?i', $new_product_id, $new_key);
		}
	}

	public function processProductOptionVariants($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_option_id = $this->getNewObjectId($row['option_id'], 'product_options');

		if (!empty($new_option_id)) {
			db_query('UPDATE ?:product_option_variants SET option_id = ?i WHERE variant_id = ?i', $new_option_id, $new_key);
		}
	}

	public function processProductOptionsExceptions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_product_id = $this->getNewObjectId($row['product_id'], 'products');

		$options = $row['combination'];
		if (!empty($options)) {
			$options = unserialize($row['combination']);
			$_oids = $_vids = array();

			foreach ($options as $option_id => $variant_id) {
				$_oids[] = $option_id;
				$_vids[] = $variant_id;
			}

			$new_oids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_options', $_oids);
			$new_vids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_option_variants', $_vids);

			$combination = array();
			foreach ($options as $option_id => $variant_id) {
				if (isset($new_oids[$option_id]['new_object_id'])) {
					$option_id = $new_oids[$option_id]['new_object_id'];
				}
				if (isset($new_vids[$variant_id]['new_object_id'])) {
					$variant_id = $new_vids[$variant_id]['new_object_id'];
				}
				$combination[$option_id] = $variant_id;
			}

		} else {
			$combination = array();
		}

		if (!empty($new_product_id)) {
			db_query('UPDATE ?:product_options_exceptions SET product_id = ?i, combination = ?s WHERE exception_id = ?i', $new_product_id, serialize($combination), $new_key);
		}
	}

	public function processProductOptionsInventory($company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);

		$total = db_get_field('SELECT COUNT(*) FROM ?:product_options_inventory');
		$start = 0;
		$step = $this->limit_step_small_data;

		while ($start < $total) {
			Stores_Import_General::connectToImportedDB($store_data);
			$combinations = db_get_array('SELECT * FROM ?:product_options_inventory LIMIT ?i, ?i', $start, $step);

			if (!empty($combinations)) {
				foreach ($combinations as $combination) {
					Stores_Import_General::connectToOriginalDB();

					$new_product_id = $this->getNewObjectId($combination['product_id'], 'products');

					$options = $combination['combination'];

					if (!empty($options)) {
						$options = fn_get_product_options_by_combination($options);
						$_oids = $_vids = array();

						foreach ($options as $option_id => $variant_id) {
							$_oids[] = $option_id;
							$_vids[] = $variant_id;
						}

						$new_oids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_options', $_oids);
						$new_vids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_option_variants', $_vids);

						$new_combination = $hash = array();
						foreach ($options as $option_id => $variant_id) {
							if (isset($new_oids[$option_id]['new_object_id'])) {
								$option_id = $new_oids[$option_id]['new_object_id'];
							}
							if (isset($new_vids[$variant_id]['new_object_id'])) {
								$variant_id = $new_vids[$variant_id]['new_object_id'];
							}
							$new_combination[] = $option_id . '_' . $variant_id;
							$hash[$option_id] = $variant_id;
						}
						$new_combination = implode('_', $new_combination);

					} else {
						$new_combination = '';
						$hash = array();
					}

					$new_hash = fn_generate_cart_id($new_product_id, array('product_options' => $hash), true);

					if (!empty($new_product_id)) {
						db_query('REPLACE INTO ?:upgrade_objects (object_id, new_object_id, object) VALUES (?s, ?s, ?s)', $combination['combination_hash'], $new_hash, 'product_options_inventory');

						$combination['product_id'] = $new_product_id;
						$combination['combination'] = $new_combination;
						$combination['combination_hash'] = $new_hash;
						
						db_query('INSERT INTO ?:product_options_inventory ?e', $combination);
					}
				}
			}

			$start += $step;
		}
	}

	public function processProductFiles($new_key, $table_data, $row, $clone_data, $cloned_ids, $store_data)
	{
		$new_product_id = $this->getNewObjectId($row['product_id'], 'products');

		// FIXME: Download path can be different. We should determine constant value
		$import_path = $store_data['path'] . '/var/downloads/' . $row['product_id'] . '/';
		$destination_path = DIR_DOWNLOADS . $new_product_id . '/';
		fn_mkdir($destination_path);

		fn_copy($import_path . $row['file_path'], $destination_path . $row['file_path']);
		fn_copy($import_path . $row['preview_path'], $destination_path . $row['preview_path']);

		db_query('UPDATE ?:product_files SET product_id = ?i WHERE file_id = ?i', $new_product_id, $new_key);
	}

	public function processProductSubscriptions($new_key, $table_data, $row, $clone_data, $cloned_ids, $store_data)
	{
		$row['subscription_id'] = $new_key;
		$row['product_id'] = $this->getNewObjectId($row['product_id'], 'products');
		$row['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('REPLACE INTO ?:product_subscriptions ?e', $row);
	}

	public function copyStates($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($this->store_data);
		$states = db_get_array('SELECT * FROM ?:states');
		Stores_Import_General::connectToOriginalDB();

		foreach ($states as $state) {
			$state_id = db_get_field('SELECT state_id FROM ?:states WHERE country_code = ?s AND code = ?s', $state['country_code'], $state['code']);

			if (!empty($state_id)) {
				db_query('REPLACE INTO ?:upgrade_objects (`object_id`, `new_object_id`, `object`) VALUES (?s, ?s, ?s)', $state['state_id'], $state_id, 'states');

			} else {
				$old_state_id = $state['state_id'];
				unset($state['state_id']);
				$new_state_id = db_query('INSERT INTO ?:states ?e', $state);

				db_query('REPLACE INTO ?:upgrade_objects (`object_id`, `new_object_id`, `object`) VALUES (?s, ?s, ?s)', $old_state_id, $new_state_id, 'states');

				Stores_Import_General::connectToImportedDB($this->store_data);
				$description = db_get_array('SELECT * FROM ?:state_descriptions WHERE state_id = ?i', $old_state_id);
				Stores_Import_General::connectToOriginalDB();

				foreach ($description as $state_descr) {
					$state_descr['state_id'] = $new_state_id;
					db_query('INSERT INTO ?:state_descriptions ?e', $state_descr);
				}
			}
		}

		// Update state_id in destination elements
		$elements = db_get_array('SELECT * FROM ?:destination_elements WHERE element_type = ?s', 'S');
		foreach ($elements as $element) {
			$element['element'] = $this->getNewObjectId($element['element'], 'states');

			if (!empty($element['element'])) {
				db_query('UPDATE ?:destination_elements SET ?u WHERE element_id = ?i', $element, $element['element_id']);
			}
		}
	}

	public function copyStatuses($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);

		$statuses = db_get_array('SELECT status, type FROM ?:statuses');

		foreach ($statuses as $status) {
			Stores_Import_General::connectToOriginalDB();
			// Check if status already exists
			$exists = db_get_field('SELECT COUNT(*) FROM ?:statuses WHERE status = ?s AND type = ?s', $status['status'], $status['type']);
			
			if (empty($exists)) {
				Stores_Import_General::connectToImportedDB($store_data);
				$_new = array(
					'status' => db_get_row('SELECT * FROM ?:statuses WHERE status = ?s AND type = ?s', $status['status'], $status['type']),
					'data' => db_get_row('SELECT * FROM ?:status_data WHERE status = ?s AND type = ?s', $status['status'], $status['type']),
					'description' => db_get_row('SELECT * FROM ?:status_descriptions WHERE status = ?s AND type = ?s', $status['status'], $status['type']),
				);
				
				Stores_Import_General::connectToOriginalDB();
				db_query('INSERT INTO ?:statuses ?e', $_new['status']);
				db_query('INSERT INTO ?:status_data ?e', $_new['data']);
				db_query('INSERT INTO ?:status_descriptions ?e', $_new['description']);
			}
		}
	}

	public function processDestinations($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToOriginalDB();

		// Get new destinations
		$destinations = db_get_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'destinations');

		// Check if the new destination is not unique and remove it.
		foreach ($destinations as $destination) {
			$dest_ids = array();
			$elements = db_get_array('SELECT * FROM ?:destination_elements WHERE destination_id = ?i', $destination['new_object_id']);

			$unique = false;
			$collision_dest_id = 0;
			$unique_ids = array();

			if (!empty($elements)) {
				foreach ($elements as $element) {
					$ids = db_get_fields('SELECT destination_id FROM ?:destination_elements WHERE element = ?s AND element_type = ?s', $element['element'], $element['element_type']);

					if (count($ids) == 1) {
						$unique = true;
					}

					foreach ($ids as $id) {
						if (!isset($unique_ids[$id])) {
							$unique_ids[$id] = 0;
						}

						$unique_ids[$id] += 1;
					}
				}

				if (!empty($unique_ids)) {
					foreach ($unique_ids as $dest_id => $collision) {
						if ($dest_id != $destination['new_object_id'] && count($elements) == $collision) {
							// Check if count of elements the same with the collision destination
							$collision_elements = db_get_field('SELECT COUNT(*) FROM ?:destination_elements WHERE destination_id = ?i', $dest_id);
							if ($collision_elements == count($elements)) {
								$unique = false;
								$collision_dest_id = $dest_id;
								break;
							}
						}
					}
				}
			}

			if (!$unique && !empty($collision_dest_id)) {
				db_query('REPLACE INTO ?:upgrade_objects VALUES (?i, ?i, ?s)', $destination['object_id'], $collision_dest_id, 'destinations');
				db_query('DELETE FROM ?:destinations WHERE destination_id = ?i', $destination['new_object_id']);
				db_query('DELETE FROM ?:destination_descriptions WHERE destination_id = ?i', $destination['new_object_id']);
				db_query('DELETE FROM ?:destination_elements WHERE destination_id = ?i', $destination['new_object_id']);
			}
		}

	}

	public function processShippingRates($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_dest_id = $this->getNewObjectId($row['destination_id'], 'destinations');

		if (!empty($new_dest_id)) {
			db_query('UPDATE ?:shipping_rates SET destination_id = ?i WHERE rate_id = ?i', $new_dest_id, $new_key);
		}
	}

	public function processTaxRates($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_dest_id = $this->getNewObjectId($row['destination_id'], 'destinations');

		if (!empty($new_dest_id)) {
			db_query('UPDATE ?:tax_rates SET destination_id = ?i WHERE rate_id = ?i', $new_dest_id, $new_key);
		}
	}

	public function processSitemapLinks($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		db_query('UPDATE ?:sitemap_links SET section_id = ?i WHERE link_id = ?i', $this->getNewObjectId($row['section_id'], 'sitemap_sections'), $new_key);
	}

	public function processPages($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$this->processIdPath($new_key, $table_data, $row, $clone_data, $cloned_ids);

		db_query('UPDATE ?:pages SET usergroup_ids = ?s WHERE page_id = ?i', $this->getNewUsergroupIds($row['usergroup_ids']), $new_key);
	}

	public function processCategories($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$this->processIdPath($new_key, $table_data, $row, $clone_data, $cloned_ids);

		db_query('UPDATE ?:categories SET product_count = 0, usergroup_ids = ?s WHERE category_id = ?i', $this->getNewUsergroupIds($row['usergroup_ids']), $new_key);
	}

	public function processPayments($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		db_query('UPDATE ?:payments SET usergroup_ids = ?s WHERE payment_id = ?i', $this->getNewUsergroupIds($row['usergroup_ids']), $new_key);
	}

	public function processShippings($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		db_query('UPDATE ?:shippings SET usergroup_ids = ?s WHERE shipping_id = ?i', $this->getNewUsergroupIds($row['usergroup_ids']), $new_key);
	}

	public function processProductPrices($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		db_query('UPDATE ?:product_prices SET usergroup_id = ?s WHERE product_id = ?i AND lower_limit = ?s AND usergroup_id = ?i', $this->getNewUsergroupIds($row['usergroup_id']), $new_key, $row['lower_limit'], $row['usergroup_id']);
	}

	public function processFeatures($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$parent_id = 0;
		if (!empty($row['parent_id'])) {
			$parent_id = $this->getNewObjectId($row['parent_id'], 'product_features');
		}

		$categories_path = array();
		if (!empty($row['categories_path'])) {

			$new_cids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', 'object_id', explode(',', $row['categories_path']), 'categories');
			$cids = explode(',', $row['categories_path']);
			foreach ($cids as $category_id) {
				if (!empty($new_cids[$category_id])) {
					$categories_path[] = $new_cids[$category_id]['new_object_id'];
				}
			}
		}

		db_query('UPDATE ?:product_features SET parent_id = ?i, categories_path = ?s WHERE feature_id = ?i', $parent_id, implode(',', $categories_path), $new_key);
	}

	public function processFeatureVariants($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_feature_id = $this->getNewObjectId($row['feature_id'], 'product_features');

		db_query('UPDATE ?:product_feature_variants SET feature_id = ?i WHERE variant_id = ?i', $new_feature_id, $new_key);
	}

	public function copyFeatureValues($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$total = db_get_field('SELECT COUNT(*) FROM ?:product_features_values');
		$start = 0;
		$step = 500;

		while ($start < $total) {
			fn_echo('.');

			Stores_Import_General::connectToImportedDB($store_data);
			$records = db_get_array('SELECT * FROM ?:product_features_values LIMIT ?i, ?i', $start, $step);

			if (!empty($records)) {
				Stores_Import_General::connectToOriginalDB();

				foreach ($records as $record) {
					$record['feature_id'] = $this->getNewObjectId($record['feature_id'], 'product_features');
					$record['product_id'] = $this->getNewObjectId($record['product_id'], 'products');
					$record['variant_id'] = $this->getNewObjectId($record['variant_id'], 'product_feature_variants');

					db_query('INSERT INTO ?:product_features_values ?e', $record);
				}
			}

			$start += $step;
		}
	}

	public function processFilters($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$feature_id = $this->getNewObjectId($row['feature_id'], 'product_features');

		$categories_path = array();
		if (!empty($row['categories_path'])) {

			$new_cids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', 'object_id', explode(',', $row['categories_path']), 'categories');
			$cids = explode(',', $row['categories_path']);
			foreach ($cids as $category_id) {
				if (!empty($new_cids[$category_id])) {
					$categories_path[] = $new_cids[$category_id]['new_object_id'];
				}
			}
		}

		db_query('UPDATE ?:product_filters SET feature_id = ?i, categories_path = ?s WHERE filter_id = ?i', $feature_id, implode(',', $categories_path), $new_key);
	}

	public function processFilterRanges($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['feature_id'] = $this->getNewObjectId($row['feature_id'], 'product_features');

		db_query('UPDATE ?:product_filter_ranges SET ?u WHERE range_id = ?i', $new_data, $new_key);
	}

	public function processRecurringPlans($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$product_ids = array();
		if (!empty($row['product_ids'])) {
			$_product_ids = explode(',', $row['product_ids']);
			foreach ($_product_ids as $product_id) {
				$product_ids[] = $this->getNewObjectId($product_id, 'products');
			}
		}
		$product_ids = implode(',', $product_ids);

		db_query('UPDATE ?:recurring_plans SET product_ids = ?s WHERE plan_id = ?i', $product_ids, $new_key);
	}

	public function processRecurringSubscriptions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['plan_id'] = $this->getNewObjectId($row['plan_id'], 'recurring_plans');
		$new_data['order_id'] = $this->getNewObjectId($row['order_id'], 'orders');
		$new_data['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:recurring_subscriptions SET ?u WHERE subscription_id = ?i', $new_data, $new_key);
	}

	public function processRecurringEvents($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['subscription_id'] = $this->getNewObjectId($row['subscription_id'], 'recurring_subscriptions');

		db_query('UPDATE ?:recurring_events SET ?u WHERE event_id = ?i', $new_data, $new_key);
	}

	public function processIdPath($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		if (!empty($row['id_path'])) {
			$path = explode('/', $row['id_path']);
			$new_path = array();
			$new_ids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', $table_data['name'], $path);

			foreach ($path as $id) {
				$new_path[] = isset($new_ids[$id]) ? $new_ids[$id]['new_object_id'] : $id;
			}
			$path = implode('/', $new_path);
			$parent_id = isset($new_ids[$row['parent_id']]) ? $new_ids[$row['parent_id']]['new_object_id'] : 0;

			db_query('UPDATE ?:' . $table_data['name'] . ' SET id_path = ?s, parent_id = ?i WHERE ' . $table_data['key'] . ' = ?i', $path, $parent_id, $new_key);
		}
	}

	public function processAttachments($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$objects_mapping = array(
			'product' => 'products',
		);

		$new_data = array();

		if (!empty($objects_mapping[$row['object_type']])) {
			$new_data['object_id'] = $this->getNewObjectId($row['object_id'], $objects_mapping[$row['object_type']]);
		}

		if (!empty($row['usergroup_ids'])) {
			$new_data['usergroup_ids'] = $this->getNewUsergroupIds($row['usergroup_ids']);
		}

		if (!empty($new_data['object_id'])) {
			$import_path = $this->store_data['path'] . '/var/attachments/' . $row['object_type'] . '/' . $row['object_id'] . '/';
			$destination_path = DIR_ATTACHMENTS . '/' . $row['object_type'] . '/' . $new_data['object_id'] . '/';
			fn_mkdir($destination_path);
			fn_copy($import_path . $row['filename'], $destination_path);
		}

		if (!empty($new_data)) {
			db_query('UPDATE ?:attachments SET ?u WHERE attachment_id = ?i', $new_data, $new_key);
		}
	}

	public function processRewardPointChanges($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:reward_point_changes SET ?u WHERE change_id = ?i', $new_data, $new_key);
	}

	public function processProductPointPrices($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['product_id'] = $this->getNewObjectId($row['product_id'], 'products');
		$new_data['usergroup_id'] = $this->getNewUsergroupId($row['usergroup_id']);

		if (!empty($new_data['product_id'])) {
			db_query('UPDATE ?:product_point_prices SET ?u WHERE point_price_id = ?i', $new_data, $new_key);
		}
	}

	public function processRewardPoints($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$objects_mapping = array(
			'C' => 'categories',
			'P' => 'products',
		);

		$new_data = array();
		if (!empty($objects_mapping[$row['object_type']])) {
			$new_data['object_id'] = $this->getNewObjectId($row['object_id'], $objects_mapping[$row['object_type']]);
		}
		$new_data['usergroup_id'] = $this->getNewUsergroupId($row['usergroup_id']);

		db_query('UPDATE ?:reward_points SET ?u WHERE reward_point_id = ?i', $new_data, $new_key);
	}

	public function processRmaReturns($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();
		$new_order_id = $this->getNewObjectId($row['order_id'], 'orders');

		db_query('UPDATE ?:rma_returns SET order_id = ?i WHERE return_id = ?i', $new_order_id, $new_key);
	}

	public function processRmaReturnProducts($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$start = 0;
		$step = $this->limit_step_small_data;
		$total = db_get_field('SELECT COUNT(*) FROM ?:rma_return_products');

		while ($start < $total) {
			fn_echo('.');

			Stores_Import_General::connectToImportedDB($store_data);
			$records = db_get_array('SELECT * FROM ?:rma_return_products LIMIT ?i, ?i', $start, $step);

			if (!empty($records)) {
				Stores_Import_General::connectToOriginalDB();

				foreach ($records as $record) {
					$record['return_id'] = $this->getNewObjectId($record['return_id'], 'rma_returns');
					$record['product_id'] = $this->getNewObjectId($record['product_id'], 'products');

					db_query('INSERT INTO ?:rma_return_products ?e', $record);
				}
			}

			$start += $step;
		}
	}

	public function processTagLinks($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$objects_mapping = array(
			'A' => 'pages',
			'P' => 'products',
		);

		$new_data = array();
		$object_type = $objects_mapping[$row['object_type']];

		$new_data['object_id'] = $this->getNewObjectId($row['object_id'], $object_type);
		$new_data['user_id'] = $this->getNewObjectId($row['user_id'], 'users');
		db_query('UPDATE ?:tag_links SET ?u WHERE tag_id = ?i AND object_type = ?s AND object_id = ?i AND user_id = ?i', $new_data, $row['tag_id'], $row['object_type'], $row['object_id'], $row['user_id']);
	}

	public function processBuyTogether($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$products = unserialize($row['products']);
		$new_products = $_ids = array();

		if (!empty($products) && is_array($products)) {
			foreach ($products as $product) {
				$_ids[] = $product['product_id'];
			}
		}

		$new_pids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'products', $_ids);

		if (!empty($products) && is_array($products)) {
			foreach ($products as $product) {
				if (!isset($new_pids[$product['product_id']])) {
					db_query('DELETE FROM ?:buy_together WHERE chain_id = ?i', $new_key);
					db_query('DELETE FROM ?:buy_together_descriptions WHERE chain_id = ?i', $new_key);

					return false;
				}

				$product['product_id'] = $new_pids[$product['product_id']]['new_object_id'];
				$cart_id = fn_generate_cart_id($product['product_id'], array());

				$new_products[$cart_id] = $product;
			}
		}

		$new_products = serialize($new_products);
		$new_product_id = $this->getNewObjectId($row['product_id'], 'products');

		db_query('UPDATE ?:buy_together SET product_id = ?i, products = ?s WHERE chain_id = ?i', $new_product_id, $new_products, $new_key);
	}

	public function processBuyTogetherDescriptions($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$start = 0;
		$step = $this->limit_step_small_data;
		$total = db_get_field('SELECT COUNT(*) FROM ?:buy_together_descriptions');

		while ($start < $total) {
			fn_echo('.');

			Stores_Import_General::connectToImportedDB($store_data);
			$records = db_get_array('SELECT * FROM ?:buy_together_descriptions LIMIT ?i, ?i', $start, $step);

			if (!empty($records)) {
				Stores_Import_General::connectToOriginalDB();

				foreach ($records as $record) {
					$record['chain_id'] = $this->getNewObjectId($record['chain_id'], 'buy_together');

					db_query('INSERT INTO ?:buy_together_descriptions ?e', $record);
				}
			}

			$start += $step;
		}
	}

	public function processGiftCertificates($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$products = unserialize($row['products']);
		$new_products = $_pids = $_oids = $_vids = array();

		$order_ids = explode(',', $row['order_ids']);

		if (!empty($products) && is_array($products)) {
			foreach ($products as $product) {
				$_pids[] = $product['product_id'];
				if (!empty($product['product_options'])) {
					foreach ($product['product_options'] as $option => $variant) {
						$_oids[] = $option;
						$_vids[] = $variant;
					}
				}
			}
		}

		$new_pids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'products', $_pids);
		$new_oids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_options', $_oids);
		$new_vids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_option_variants', $_vids);

		$new_order_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'orders', $order_ids);

		if (!empty($products) && is_array($products)) {
			foreach ($products as $product) {
				$_product = $product;
				$_product['product_id'] = $new_pids[$product['product_id']]['new_object_id'];
				$_product['product_options'] = array();
				if (!empty($product['product_options'])) {
					foreach ($product['product_options'] as $option => $variant) {
						$_product['product_options'][$new_oids[$option]['new_object_id']] = $new_vids[$variant]['new_object_id'];
					}
				}
				$cart_id = fn_generate_cart_id($_product['product_id'], array('product_options' => $_product['product_options']));

				$new_products[$cart_id] = $_product;
			}
		}

		$new_products = serialize($new_products);
		$new_order_ids = implode(',', $new_order_ids);

		db_query('UPDATE ?:gift_certificates SET order_ids = ?s, products = ?s WHERE gift_cert_id = ?i', $new_order_ids, $new_products, $new_key);
	}

	public function processGiftCertificatesLog($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$fields = array('products', 'debit_products');

		foreach ($fields as $field) {
			$products = unserialize($row[$field]);

			if (is_array($products)) {
				$new_products = $_pids = $_oids = $_vids = array();

				foreach ($products as $product) {
					$_pids[] = $product['product_id'];
					if (!empty($product['product_options'])) {
						foreach ($product['product_options'] as $option => $variant) {
							$_oids[] = $option;
							$_vids[] = $variant;
						}
					}
				}

				$new_pids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'products', $_pids);
				$new_oids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_options', $_oids);
				$new_vids = db_get_hash_array('SELECT object_id, new_object_id FROM ?:upgrade_objects WHERE object = ?s AND object_id IN (?a)', 'object_id', 'product_option_variants', $_vids);

				foreach ($products as $product) {
					$_product = $product;
					$_product['product_id'] = $new_pids[$product['product_id']]['new_object_id'];
					$_product['product_options'] = array();
					if (!empty($product['product_options'])) {
						foreach ($product['product_options'] as $option => $variant) {
							$_product['product_options'][$new_oids[$option]['new_object_id']] = $new_vids[$variant]['new_object_id'];
						}
					}
					$cart_id = fn_generate_cart_id($_product['product_id'], array('product_options' => $_product['product_options']));

					$new_products[$cart_id] = $_product;
				}

				$new_fields[$field] = serialize($new_products);
			} else {
				$new_fields[$field] = $row[$field];
			}
		}

		$new_user_id = $this->getNewObjectId($row['user_id'], 'users');
		$new_order_id = $this->getNewObjectId($row['order_id'], 'orders');

		db_query('UPDATE ?:gift_certificates_log SET order_id = ?i, user_id = ?i, products = ?s, debit_products = ?s WHERE log_id = ?i', $new_order_id, $new_user_id, $new_fields['products'], $new_fields['debit_products'], $new_key);
	}

	public function processRequiredProducts($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);
		$start = 0;
		$step = $this->limit_step_small_data;
		$total = db_get_field('SELECT COUNT(*) FROM ?:product_required_products');

		while ($start < $total) {
			fn_echo('.');

			Stores_Import_General::connectToImportedDB($store_data);
			$records = db_get_array('SELECT * FROM ?:product_required_products LIMIT ?i, ?i', $start, $step);

			if (!empty($records)) {
				Stores_Import_General::connectToOriginalDB();

				foreach ($records as $record) {
					$record['product_id'] = $this->getNewObjectId($record['product_id'], 'products');
					$record['required_id'] = $this->getNewObjectId($record['required_id'], 'products');

					if (empty($record['product_id']) || empty($record['required_id'])) {
						continue;
					}

					db_query('INSERT INTO ?:product_required_products ?e', $record);
				}
			}

			$start += $step;
		}
	}

	public function processUsergroupLinks($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$user_id = $this->getNewObjectId($row['user_id'], 'users');
		$usergroup_id = $this->getNewUsergroupId($row['usergroup_id']);

		db_query('UPDATE ?:usergroup_links SET user_id = ?i, usergroup_id = ?i WHERE link_id = ?i', $user_id, $usergroup_id, $new_key);
	}

	public function processUsergroups($object, $company_id, $store_data)
	{
		//Transfer root user in objects
		$root = array('object' => 'users');
		Stores_Import_General::connectToImportedDB($store_data);
		$root['object_id'] = db_get_field("SELECT user_id FROM ?:users WHERE user_type = 'A' AND is_root = 'Y'");

		Stores_Import_General::connectToOriginalDB();
		$root['new_object_id'] = db_get_field("SELECT user_id FROM ?:users WHERE user_type = 'A' AND is_root = 'Y'");

		db_query('INSERT INTO ?:upgrade_objects ?e', $root);

		// We need to delete duplicate groups
		$group_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'usergroups');
		$groups = db_get_hash_array('SELECT usergroup_id, usergroup FROM ?:usergroup_descriptions WHERE usergroup_id IN (?a) AND lang_code = ?s', 'usergroup_id', $group_ids, CART_LANGUAGE);

		foreach ($groups as $group_id => $group) {
			$count = db_get_field('SELECT COUNT(*) FROM ?:usergroup_descriptions WHERE usergroup = ?s AND lang_code = ?s', $group['usergroup'], CART_LANGUAGE);

			if ($count > 1) {
				$old_usergroup_id = db_get_field('SELECT usergroup_id FROM ?:usergroup_descriptions WHERE usergroup = ?s AND lang_code = ?s AND usergroup <> ?i', $group['usergroup'], CART_LANGUAGE, $group_id);
				// Remove new group and link users to the already existing group
				db_query('DELETE FROM ?:usergroups WHERE usergroup_id = ?i', $group_id);
				db_query('DELETE FROM ?:usergroup_descriptions WHERE usergroup_id = ?i', $group_id);
				db_query('DELETE FROM ?:usergroup_privileges WHERE usergroup_id = ?i', $group_id);

				db_query('UPDATE ?:usergroup_links SET usergroup_id = ?i WHERE usergroup_id = ?i', $old_usergroup_id, $group_id);
				db_query('UPDATE ?:upgrade_objects SET new_object_id = ?i WHERE new_object_id = ?i AND object = ?s', $old_usergroup_id, $group_id, 'usergroups');
			}
		}
		
		if (Registry::get('settings.Stores.share_users') == 'Y') {
			// Users Sharing was enabled, so we need to remove users with the same emails
			// Get the same emails
			$double_emails = array_keys(db_get_hash_array('SELECT COUNT(*) AS users_count, email FROM ?:users GROUP BY email HAVING users_count > 1', 'email'));
			
			if (!empty($double_emails)) {
				$new_user_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'users');
				$users = db_get_array('SELECT user_id, email FROM ?:users WHERE email IN (?a) AND user_id IN (?a)', $double_emails, $new_user_ids);
				
				if (!empty($users)) {
					// We should delete duplicate users from DB
					foreach ($users as $user) {
						$current_user_id = db_get_field('SELECT user_id FROM ?:users WHERE email = ?s AND user_id <> ?i', $user['email'], $user['user_id']);

						db_query('DELETE FROM ?:users WHERE user_id = ?i', $user['user_id']);
						db_query('DELETE FROM ?:user_data WHERE user_id = ?i', $user['user_id']);
						db_query('DELETE FROM ?:user_profiles WHERE user_id = ?i', $user['user_id']);
						db_query('DELETE FROM ?:usergroup_links WHERE user_id = ?i', $user['user_id']);

						db_query('UPDATE ?:upgrade_objects SET new_object_id = ?i WHERE new_object_id = ?i AND object = ?s', $current_user_id, $user['user_id'], 'users');
					}
				}
			}
		}

		$total = db_get_field('SELECT COUNT(*) FROM ?:upgrade_objects WHERE object = ?s', 'products');
		$start = 0;
		$step = $this->limit_step_small_data;

		while ($start < $total) {
			$pids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s LIMIT ?i, ?i', 'products', $start, $step);
			$start += $step;

			// Process products usergroups
			$new_products = db_get_array('SELECT product_id, usergroup_ids FROM ?:products WHERE product_id IN (?a)', $pids);
			foreach ($new_products as $product) {
				if (!empty($product['usergroup_ids']) && $product['usergroup_ids'] != '0') {
					$product['usergroup_ids'] = $this->getNewUsergroupIds($product['usergroup_ids']);

					db_query('UPDATE ?:products SET usergroup_ids = ?s WHERE product_id = ?i', $product['usergroup_ids'], $product['product_id']);
				}
			}
		}
	}

	public function processUserProfiles($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();
		$row['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:user_profiles SET ?u WHERE profile_id = ?i', $row, $new_key);
	}

	public function processDataFeeds($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$store_data = $this->store_data;
		$product_ids = array();
		$category_ids = array();
		$export_options = array();
		$save_dir = '';
		$new_data = array();

		if (!empty($row['categories'])) {
			$_category_ids = explode(',', $row['categories']);
			foreach ($_category_ids as $category_id) {
				$category_ids[] = $this->getNewObjectId($category_id, 'categories');
			}
		}
		$new_data['categories'] = implode(',', $category_ids);

		if (!empty($row['products'])) {
			$_products_ids = explode(',', $row['products']);
			foreach ($_products_ids as $product_id) {
				$product_ids[] = $this->getNewObjectId($product_id, 'products');
			}
		}
		$new_data['products'] = implode(',', $product_ids);
		//If the export options are set to default values, change them, otherwise show notification

		if (!empty($row['export_options'])) {
			$export_options = unserialize($row['export_options']);
			if (strpos($export_options['images_path'], $store_data['path'] . '/images/backup') !== false) {
				$export_options['images_path'] = DIR_ROOT . '/images/backup';
			} else {
				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('es_data_feed_check_images'));
			}
			if (strpos($export_options['files_path'], $store_data['path'] . '/var/downloads/backup') !== false) {
				$export_options['files_path'] = DIR_ROOT . '/var/downloads/backup';
			} else {
				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('es_data_feed_check_files'));
			}
		}
		$new_data['export_options'] = serialize($export_options);

		if (!empty($row['save_dir'])) {
			if (strpos($row['save_dir'], $store_data['path'] . '/var/exim/') !== false) {
				$save_dir = DIR_ROOT . '/var/exim/';
			} else {
				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('es_data_feed_check_server'));
			}
		}
		$new_data['save_dir'] = $save_dir;
		db_query('UPDATE ?:data_feeds SET ?u WHERE datafeed_id = ?i', $new_data, $new_key);
	}

	public function processGiftregEvents($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_data = array();
		$new_data['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:giftreg_events SET ?u WHERE event_id = ?i', $new_data, $new_key);
	}

	public function processGiftregEventProducts($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$item_id = $row['item_id'];
		$row['product_id'] = $this->getNewObjectId($row['product_id'], 'products');

		if (!empty($row['extra'])) {
			$extra = unserialize($row['extra']);
			$row['extra'] = serialize($this->_getNewProductOptions($extra));
		}
		$row['item_id'] = fn_generate_cart_id($row['product_id'], array("product_options" => (!empty($row['extra']) ? unserialize($row['extra']) : array())), false);

		db_query('UPDATE ?:giftreg_event_products SET ?u WHERE item_id = ?i AND event_id = ?i', $row, $item_id, $row['event_id']);
	}

	private function _getNewProductOptions($options)
	{
		$new_data = array();
		foreach ($options as $option_id => $value) {
			$new_option_id = $this->getNewObjectId($option_id, 'product_options');
			$new_value = $this->getNewObjectId($value, 'product_option_variants');
			$new_data[$new_option_id] = ($new_value !== false) ? $new_value : $value;
		}

		return $new_data;
	}

	public function processGiftregEventFields($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_data = array();
		$new_data['event_id'] = $this->getNewObjectId($row['event_id'], 'giftreg_events');

		// check if there is corresponding variant for selected field
		$variant_id = db_get_field('SELECT variant_id FROM ?:giftreg_field_variants WHERE field_id = ?i AND variant_id = ?i', $row['field_id'], $row['value']);
		if ($variant_id !== false) {
			$new_data['value'] = $variant_id;
		}

		db_query('UPDATE ?:giftreg_event_fields SET ?u WHERE field_id = ?i AND event_id = ?i', $new_data, $new_key, $row['event_id']);
	}

	public function processAffiliatePayouts($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_partner_id = $this->getNewObjectId($row['partner_id'], 'users');

		db_query('UPDATE ?:affiliate_payouts SET partner_id = ?i WHERE payout_id = ?i', $new_partner_id, $new_key);
	}

	public function processAffiliatePlans($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$product_ids = array();
		$category_ids = array();
		$promotion_ids = array();

		if (!empty($row['product_ids'])) {
			$_products_ids = unserialize($row['product_ids']);
			foreach ($_products_ids as $product_id => $product_data) {
				$new_product_id = $this->getNewObjectId($product_id, 'products');
				$product_ids[$new_product_id] = $product_data;
			}
		}
		$new_data['product_ids'] = serialize($product_ids);

		if (!empty($row['category_ids'])) {
			$_category_ids = unserialize($row['category_ids']);
			foreach ($_category_ids as $category_id => $category_data) {
				$new_category_id = $this->getNewObjectId($category_id, 'categories');
				$category_ids[$new_category_id] = $category_data;
			}
		}
		$new_data['category_ids'] = serialize($category_ids);

		if (!empty($row['promotion_ids'])) {
			$_promotion_ids = unserialize($row['promotion_ids']);
			foreach ($_promotion_ids as $promotion_id => $promotion_data) {
				$new_promotion_id = $this->getNewObjectId($promotion_id, 'promotions');
				$promotion_ids[$new_promotion_id] = $promotion_data;
			}
		}
		$new_data['promotion_ids'] = serialize($promotion_ids);

		db_query('UPDATE ?:affiliate_plans SET ?u WHERE plan_id = ?i', $new_data, $new_key);
	}

	public function processAffPartnerProfiles($object, $company_id, $store_data)
	{
		$new_data = array();

		Stores_Import_General::connectToImportedDB($this->store_data);

		$partner_profiles = db_get_array('SELECT * FROM ?:aff_partner_profiles');
		$user_data_emails = array();
		foreach ($partner_profiles as $profile_data) {
			$user_data_emails[] = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i", $profile_data['user_id']);
		}

		Stores_Import_General::connectToOriginalDB();

		if (Registry::get('settings.Stores.share_users') == 'Y') {
			$double_user_ids = db_get_fields("SELECT user_id FROM ?:users WHERE email IN (?a)", $user_data_emails);
		}

		foreach ($partner_profiles as $profile_data) {
			$new_data['user_id'] = $this->getNewObjectId($profile_data['user_id'], 'users');
			if (empty($double_user_ids) || !in_array($new_data['user_id'], $double_user_ids)) {
				$new_data['plan_id'] = $this->getNewObjectId($profile_data['plan_id'], 'affiliate_plans');
				$new_data['approved'] = $profile_data['approved'];
				$new_data['balance'] = $profile_data['balance'];
				$new_data['referrer_partner_id'] = $this->getNewObjectId($profile_data['referrer_partner_id'], 'users');

				db_query('REPLACE INTO ?:aff_partner_profiles ?e', $new_data);
			}
		}
	}

	public function processAffPartnerActions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['banner_id'] = $this->getNewObjectId($row['banner_id'], 'aff_banners');
		$new_data['partner_id'] = $this->getNewObjectId($row['partner_id'], 'users');
		$new_data['plan_id'] = $this->getNewObjectId($row['plan_id'], 'affiliate_plans');
		$new_data['customer_id'] = $this->getNewObjectId($row['customer_id'], 'users');
		$new_data['payout_id'] = $this->getNewObjectId($row['payout_id'], 'affiliate_payouts');

		db_query('UPDATE ?:aff_partner_actions SET ?u WHERE action_id = ?i', $new_data, $new_key);
	}

	public function processNewsletters($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		if (!empty($row['campaign_id'])) {
			Stores_Import_General::connectToOriginalDB();

			$new_data = array();
			$new_data['campaign_id'] = $this->getNewObjectId($row['campaign_id'], 'newsletter_campaigns');

			db_query('UPDATE ?:newsletters SET ?u WHERE newsletter_id = ?i', $new_data, $new_key);
		}
	}

	public function processNewsletterLinks($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		if (!empty($row['campaign_id'])) {
			Stores_Import_General::connectToOriginalDB();

			$new_data = array();
			$new_data['campaign_id'] = $this->getNewObjectId($row['campaign_id'], 'newsletter_campaigns');

			db_query('UPDATE ?:newsletter_links SET ?u WHERE link_id = ?i', $new_data, $new_key);
		}
	}

	public function processMailingLists($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		if (!empty($row['register_autoresponder'])) {
			Stores_Import_General::connectToOriginalDB();

			$new_data = array();
			$new_data['register_autoresponder'] = $this->getNewObjectId($row['register_autoresponder'], 'newsletters');

			db_query('UPDATE ?:mailing_lists SET ?u WHERE list_id = ?i', $new_data, $new_key);
		}
	}

	public function processFormOptions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$new_data = array();
		$new_data['page_id'] = $this->getNewObjectId($row['page_id'], 'pages');
		$new_data['parent_id'] = $this->getNewObjectId($row['parent_id'], 'form_options');

		db_query('UPDATE ?:form_options SET ?u WHERE element_id = ?i', $new_data, $new_key);
	}

	public function processConfGroups($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$group_id = end(array_keys($cloned_ids));

		Stores_Import_General::connectToImportedDB($this->store_data);
		$group_product_ids = db_get_fields('SELECT product_id FROM ?:conf_group_products WHERE group_id = ?i', $group_id);
		$product_groups = db_get_array('SELECT * FROM ?:conf_product_groups WHERE group_id = ?i', $group_id);

		Stores_Import_General::connectToOriginalDB();

		// copy group products
		$new_data = array();
		$new_data['group_id'] = $new_key;
		foreach ($group_product_ids as $product_id) {
			$new_data['product_id'] = $this->getNewObjectId($product_id, 'products');
			db_query('REPLACE INTO ?:conf_group_products ?e', $new_data);
		}

		// copy product groups
		foreach ($product_groups as $new_data) {
			$new_data['group_id'] = $new_key;
			$new_data['product_id'] = $this->getNewObjectId($new_data['product_id'], 'products');

			if (!empty($new_data['default_product_ids'])) {
				$default_product_ids = array();
				$old_product_ids = explode(':', $new_data['default_product_ids']);

				foreach ($old_product_ids as $product_id) {
					$default_product_ids[] = $this->getNewObjectId($product_id, 'products');
				}
				$new_data['default_product_ids'] = implode(':', $default_product_ids);
			}

			db_query('REPLACE INTO ?:conf_product_groups ?e', $new_data);
		}

		// update step identifier
		if ($step_id = $this->getNewObjectId($row['step_id'], 'conf_steps')) {
			$new_data = array();
			$new_data['step_id'] = $step_id;
			db_query('UPDATE ?:conf_groups SET ?u WHERE group_id = ?i', $new_data, $new_key);
		}
	}

	public function processConfClasses($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$class_id = end(array_keys($cloned_ids));

		Stores_Import_General::connectToImportedDB($this->store_data);
		$class_product_ids = db_get_fields('SELECT product_id FROM ?:conf_class_products WHERE class_id = ?i', $class_id);
		$slave_class_ids = db_get_fields('SELECT slave_class_id FROM ?:conf_compatible_classes WHERE master_class_id = ?i', $class_id);

		Stores_Import_General::connectToOriginalDB();

		// copy class products
		$new_data = array();
		$new_data['class_id'] = $new_key;
		foreach ($class_product_ids as $product_id) {
			$new_data['product_id'] = $this->getNewObjectId($product_id, 'products');
			db_query('REPLACE INTO ?:conf_class_products ?e', $new_data);
		}

		// copy compatible classes
		$new_data = array();
		$new_data['master_class_id'] = $new_key;
		foreach ($slave_class_ids as $class_id) {
			$new_data['slave_class_id'] = $this->getNewObjectId($class_id, 'conf_classes');
			db_query('REPLACE INTO ?:conf_compatible_classes ?e', $new_data);
		}

		// update group identifier
		if ($group_id = $this->getNewObjectId($row['group_id'], 'conf_groups')) {
			$new_data = array();
			$new_data['group_id'] = $group_id;
			db_query('UPDATE ?:conf_classes SET ?u WHERE class_id = ?i', $new_data, $new_key);
		}
	}

	public function copySeoData ($object, $company_id, $store_data)
	{
		$new_db = Stores_Import_General::connectToImportedDB($this->store_data);

		$names = db_get_array("SELECT * FROM ?:seo_names");
		$seo_object_types = array (
			'p' => 'products',
			'c' => 'categories',
			'a' => 'pages',
			'e' => 'product_feature_variants',
			'm' => 'companies',
			'n' => 'news',
		);

		Stores_Import_General::connectToOriginalDB();

		foreach ($names as $seo_name) {
			if ($seo_name['object_id'] > 0) {
				$seo_name['object_id'] = $this->getNewObjectId($seo_name['object_id'], $seo_object_types[$seo_name['type']]);
			}

			$seo_name['company_id'] = $company_id;

			db_query('REPLACE INTO ?:seo_names ?e', $seo_name);
		}
	}

	public function processProfileFieldValues($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$new_data = array();
		$new_data['field_id'] = $this->getNewObjectId($row['field_id'], 'profile_fields');

		db_query('UPDATE ?:profile_field_values SET ?u WHERE value_id = ?i', $new_data, $new_key);
	}

	public function processProfileFields($object, $company_id, $store_data)
	{
		// We need to delete duplicate fields
		Stores_Import_General::connectToOriginalDB();

		$field_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object = ?s', 'profile_fields');
		$fields = db_get_hash_array('SELECT fields.field_id, fields.section, description.description FROM ?:profile_fields AS fields LEFT JOIN ?:profile_field_descriptions AS description ON (fields.field_id = description.object_id) WHERE fields.field_id IN (?a) AND description.lang_code = ?s', 'field_id', $field_ids, CART_LANGUAGE);

		foreach ($fields as $field_id => $field) {
			$count = db_get_field('SELECT COUNT(*) FROM ?:profile_fields AS fields LEFT JOIN ?:profile_field_descriptions AS descriptions ON (fields.field_id = descriptions.object_id) WHERE descriptions.description = ?s AND descriptions.lang_code = ?s AND fields.section = ?s', $field['description'], CART_LANGUAGE, $field['section']);

			if ($count > 1) {
				$old_field_id = db_get_field('SELECT field_id FROM ?:profile_fields AS fields LEFT JOIN ?:profile_field_descriptions AS descriptions ON (fields.field_id = descriptions.object_id) WHERE descriptions.description = ?s AND descriptions.lang_code = ?s AND fields.field_id <> ?i AND fields.section = ?s', $field['description'], CART_LANGUAGE, $field_id, $field['section']);

				// Remove new group and link users to the already existing group
				db_query('DELETE FROM ?:profile_fields WHERE field_id = ?i', $field_id);
				db_query('DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type = ?s', $field_id, 'F');

				// Process field values before deleting
				$value_ids = db_get_fields('SELECT value_id FROM ?:profile_field_values WHERE field_id = ?i', $field_id);
				if (!empty($value_ids)) {
					$value_ids = db_get_array('SELECT * FROM ?:upgrade_objects WHERE object = ?s AND new_object_id IN (?a)', 'profile_field_values', $value_ids);
					foreach ($value_ids as $value) {
						db_query('UPDATE ?:upgrade_objects SET new_object_id = ?i WHERE object_id = ?i AND object = ?s', $value['object_id'], $value['object_id'], $value['object']);
					}
					
				}
				db_query('DELETE FROM ?:profile_field_values WHERE field_id = ?i', $field_id);
				db_query('DELETE FROM ?:ult_objects_sharing WHERE share_object_id = ?i AND share_company_id = ?i AND share_object_type', $field_id, $company_id, 'profile_fields');

				db_query('UPDATE ?:upgrade_objects SET new_object_id = ?s WHERE object = ?s AND new_object_id = ?s', $old_field_id, 'profile_fields', $field_id);

				
				db_query('REPLACE INTO ?:ult_objects_sharing SET share_object_id = ?i, share_company_id = ?i, share_object_type = ?s', $old_field_id, $company_id, 'profile_fields');
			}
		}

		// Process profile_fields_data table
		Stores_Import_General::connectToImportedDB($store_data);
		$total = db_get_field('SELECT COUNT(*) FROM ?:profile_fields_data');
		$start = 0;
		$step = $this->limit_step_big_data;

		while ($start < $total) {
			fn_echo('.');

			Stores_Import_General::connectToImportedDB($store_data);
			$data = db_get_array('SELECT * FROM ?:profile_fields_data LIMIT ?i, ?i', $start, $step);
			Stores_Import_General::connectToOriginalDB();

			if (!empty($data)) {
				foreach ($data as $row) {
					$object_type = $row['object_type'] == 'P' ? 'user_profiles' : 'orders';
					
					$row['object_id'] = $this->getNewObjectId($row['object_id'], $object_type);
					$row['field_id'] = $this->getNewObjectId($row['field_id'], 'profile_fields');

					$field_type = db_get_field('SELECT field_type FROM ?:profile_fields WHERE field_id = ?i', $row['field_id']);

					if (in_array($field_type, array('S', 'R'))) {
						$row['value'] = $this->getNewObjectId($row['value'], 'profile_field_values');
					}
					
					db_query('REPLACE INTO ?:profile_fields_data ?e', $row);
				}
			}

			$start += $step;
		}

	}

	public function processImages($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$store_data = $this->store_data;
		$old_key = $this->getOldObjectId($new_key, 'images');
		Stores_Import_General::connectToImportedDB($store_data);
		$pairs = db_get_array('SELECT object_type, image_id, detailed_id FROM ?:images_links WHERE image_id = ?i OR detailed_id = ?i', $old_key, $old_key);

		Stores_Import_General::connectToOriginalDB();
		$new_path = $row['company_id'] . '_' . $row['image_path'];

		$detailed_imported_path = $store_data['path'] . '/images/detailed/' . floor($old_key / MAX_FILES_IN_DIR) . '/';
		$detailed_original_path = DIR_IMAGES . 'detailed/' . floor($new_key / MAX_FILES_IN_DIR) . '/';

		fn_mkdir($detailed_original_path);

		foreach ($pairs as $pair) {
			if ($pair['detailed_id'] == $old_key) {
				if (is_file($detailed_imported_path . $row['image_path'])) {
					fn_copy($detailed_imported_path . $row['image_path'], $detailed_original_path . $new_path);
				}
			}
			if ($pair['image_id'] == $old_key) {
				$import_path = $store_data['path'] . '/images/' . $pair['object_type'] . '/' . floor($old_key / MAX_FILES_IN_DIR) . '/';
				$destination_path = DIR_IMAGES . $pair['object_type'] . '/' . floor($new_key / MAX_FILES_IN_DIR) . '/';

				if (is_file($import_path . $row['image_path'])) {
					fn_mkdir($destination_path);
					fn_copy($import_path . $row['image_path'], $destination_path . $new_path);
				}
			}
		}

		db_query('UPDATE ?:images SET image_path = ?s WHERE image_id = ?i', $new_path, $new_key);
	}

	public function copyImagesLinks($object, $company_id, $store_data)
	{
		Stores_Import_General::connectToImportedDB($store_data);

		//transfer logo titles
		$areas = fn_get_manifest_definition();

		$addons = $this->getAddons();
		foreach ($addons as $addon_data) {
			if (function_exists('fn_' . $addon_data['addon'] . '_get_manifest_definition')) {
				call_user_func_array('fn_' . $addon_data['addon'] . '_get_manifest_definition', array(&$areas));
			}
		}

		foreach ($areas as $area => $logo) {
			$areas[$area] = $logo['name'];
		}

		if (!in_array('A', array_keys($areas))) {
			$areas['A'] = 'Admin_logo';
		}

		$logo_titles = db_get_hash_multi_array('SELECT * FROM ?:common_descriptions WHERE object_holder IN (?a) AND object_id = 0', array('object_holder', 'lang_code'), array_values($areas));

		foreach ($areas as $area => $name) {
			$areas[$area] = !empty($logo_titles[$name]) ? $logo_titles[$name] : array();
		}

		//transfer images links
		$start = 0;
		$step = $this->limit_step_small_data;
		$total = db_get_field('SELECT COUNT(*) FROM ?:images_links');

		Stores_Import_General::connectToOriginalDB();
		foreach ($areas as $langs) {
			foreach ($langs as $title) {
				if ($title) {
					$title['object_id'] = $company_id;
					db_query('REPLACE INTO ?:common_descriptions ?e', $title);
				}
			}
		}

		$object_types = array(
			'category' => 'categories',
			'conf_group' => 'conf_groups',
			'product' => 'products',
			'product_option' => 'product_options_inventory',
			'promo' => 'banners',
			'variant_image' => 'product_option_variants',
			'payment' => 'payments',
			'aff_banners' => 'aff_banners',
			'shipping' => 'shippings',
			'feature_variant' => 'feature_variants',
			'credit_card' => 'static_data',
		);

		while ($start < $total) {
			fn_echo('.');
			
			Stores_Import_General::connectToImportedDB($store_data);
			$records = db_get_array('SELECT * FROM ?:images_links LIMIT ?i, ?i', $start, $step);

			if (!empty($records)) {
				Stores_Import_General::connectToOriginalDB();

				foreach ($records as $record) {

					unset($record['pair_id']);
					$record['image_id'] = $record['image_id'] != 0 ? $this->getNewObjectId($record['image_id'], 'images') : 0;
					$record['detailed_id'] = $record['detailed_id'] != 0 ? $this->getNewObjectId($record['detailed_id'], 'images') : 0;
					$record['object_id'] = $this->getNewObjectId($record['object_id'], $object_types[$record['object_type']]);

					db_query('INSERT INTO ?:images_links ?e', $record);
				}
			}

			$start += $step;
		}
	}

	public function processOrders($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();
		if (!empty($row['parent_order_id'])) {
			$row['parent_order_id'] = $this->getNewObjectId($row['parent_order_id'], 'orders');
		}

		$row['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		if (!empty($row['shipping_ids'])) {
			$shipping_ids = explode(',', $row['shipping_ids']);
			$new_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', $shipping_ids, 'shippings');
			$row['shipping_ids'] = implode(',', $new_ids);
		}

		if (!empty($row['promotion_ids'])) {
			$promotion_ids = explode(',', $row['promotion_ids']);
			$new_ids = db_get_fields('SELECT new_object_id FROM ?:upgrade_objects WHERE object_id IN (?a) AND object = ?s', $promotion_ids, 'promotions');
			$row['promotion_ids'] = implode(',', $new_ids);

			if (!empty($row['promotions'])) {
				// Convert saved promotions
				$_promo = array();
				$promotions = unserialize($row['promotions']);
				foreach ($promotions as $promotion_id => $promotion) {
					$new_id = $this->getNewObjectId($promotion_id, 'promotions');
					$_promo[$new_id] = $promotion;

					if (!empty($promotion['bonuses'])) {
						foreach ($promotion['bonuses'] as $bonus_id => $bonus) {
							if (!empty($bonus['promotion_id'])) {
								$_promo[$new_id]['bonuses'][$bonus_id]['promotion_id'] = $this->getNewObjectId($bonus['promotion_id'], 'promotions');
							}
						}
					}
				}

				$row['promotions'] = serialize($_promo);
			}
		}

		$row['payment_id'] = $this->getNewObjectId($row['payment_id'], 'payments');
		$row['localization_id'] = 0;

		db_query('UPDATE ?:orders SET ?u WHERE order_id = ?i', $row, $new_key);
	}

	public function processOrderData($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		switch ($row['type']) {
			case 'L':
				if (!empty($row['data'])) {
					$data = unserialize($row['data']);
					$_data = array();
					if (!empty($data)) {
						foreach ($data as $shipping_id => $shipping) {
							$new_shipping_id = $this->getNewObjectId($shipping_id, 'shippings');
							$_data[$new_shipping_id] = $shipping;
						}
					}

					$row['data'] = $_data;
				}
				break;
			case 'T':
				if (!empty($row['data'])) {
					$data = unserialize($row['data']);
					$_data = array();
					foreach ($data as $tax_id => $tax) {
						$new_tax_id = $this->getNewObjectId($tax_id, 'taxes');
						$_data[$new_tax_id] = $tax;
					}

					$row['data'] = $_data;
				}
				break;

			db_query('UPDATE ?:order_data SET ?u WHERE order_id = ?i AND type = ?s', $row['order_id'], $row['type']);
		}
	}

	public function processOrderDetails($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$row['product_id'] = $this->getNewObjectId($row['product_id'], 'products');

		if (!empty($row['extra'])) {
			$row['extra'] = unserialize($row['extra']);
			if (!empty($row['extra']['product_options'])) {
				$options = array();
				foreach ($row['extra']['product_options'] as $option_id => $variant_id) {
					$option_id = $this->getNewObjectId($option_id, 'product_options');
					$variant_id = $this->getNewObjectId($variant_id, 'product_option_variants');
					$options[$option_id] = $variant_id;
				}
				$row['extra']['product_options'] = $options;
			}

			if (!empty($row['extra']['product_options_value'])) {
				$options = array();
				foreach ($row['extra']['product_options_value'] as $option_data) {
					$option_data['option_id'] = $this->getNewObjectId($option_data['option_id'], 'product_options');
					if (!in_array($option_data['option_type'], array('I', 'T', 'F'))) {
						$option_data['value'] = $this->getNewObjectId($option_data['value'], 'product_option_variants');
					}

					$options[] = $option_data;
				}
				$row['extra']['product_options_value'] = $options;
			}

			$row['extra'] = serialize($row['extra']);
		}

		db_query('UPDATE ?:order_details SET ?u WHERE order_id = ?i AND item_id = ?i', $row, $row['order_id'], $row['item_id']);
	}

	public function processShipments($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		db_query('UPDATE ?:shipments SET shipping_id = ?i WHERE shipment_id = ?i', $this->getNewObjectId($row['shipping_id'], 'shippings'), $new_key);
	}

	public function processShipmentItems($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		$row['order_id'] = $this->getNewObjectId($row['order_id'], 'orders');
		$row['product_id'] = $this->getNewObjectId($row['product_id'], 'products');

		db_query('UPDATE ?:shipment_items SET ?u WHERE item_id = ?i AND shipment_id = ?i', $row, $row['item_id'], $row['shipment_id']);
	}

	public function processPromotions($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		if (!empty($row['conditions'])) {
			$row['conditions'] = unserialize($row['conditions']);
			$row['conditions'] = $this->convertPromotionConditions($row['conditions']);
			$row['conditions'] = serialize($row['conditions']);
		}

		if (!empty($row['bonuses'])) {
			$row['bonuses'] = unserialize($row['bonuses']);
			$row['bonuses'] = $this->convertPromotionBonuses($row['bonuses']);
			$row['bonuses'] = serialize($row['bonuses']);
		}

		db_query('UPDATE ?:promotions SET ?u WHERE promotion_id = ?i', $row, $new_key);
	}

	public function convertPromotionConditions($conditions)
	{
		if (!empty($conditions['conditions'])) {
			$conditions['conditions'] = $this->convertPromotionConditions($conditions['conditions']);

			return $conditions;
		}

		foreach ($conditions as $id => $condition) {
			if (!empty($condition['conditions'])) {
				$conditions[$id]['conditions'] = $this->convertPromotionConditions($condition['conditions']);

				continue;
			}

			if (empty($condition['value'])) {
				continue;
			}

			switch ($condition['condition']) {
				case 'categories':
					$category_ids = explode(',', $condition['value']);
					$condition['value'] = array();

					foreach ($category_ids as $category_id) {
						$condition['value'][] = $this->getNewObjectId($category_id, 'categories');
					}

					$condition['value'] = implode(',', $condition['value']);

					break;
				case 'products':
					$products = array();
					if (is_array($condition['value'])) {
						foreach ($condition['value'] as $cart_id => $product_data) {
							$product_data['product_id'] = $this->getNewObjectId($product_data['product_id'], 'products');
							if (!empty($product_data['product_options'])) {
								$options = array();
								foreach ($product_data['product_options'] as $option_id => $variant_id) {
									$option_id = $this->getNewObjectId($option_id, 'product_options');
									$variant_id = $this->getNewObjectId($variant_id, 'product_option_variants');
									$options[$option_id] = $variant_id;
								}

								$product_data['product_options'] = $options;
							}

							$options = empty($product_data['product_options']) ? array() : $product_data['product_options'];
							$new_cart_id = fn_generate_cart_id($product_data['product_id'], array('product_options' => $options));

							$products[$new_cart_id] = $product_data;
						}

					} else {
						$product_ids = explode(',', $condition['value']);

						foreach ($product_ids as $product_id) {
							$products[] = $this->getNewObjectId($product_id, 'products');
						}

						$products = implode(',', $products);
					}

					$condition['value'] = $products;

					break;
				case 'users':
					$user_ids = explode(',', $condition['value']);
					$condition['value'] = array();

					foreach ($user_ids as $user_id) {
						$condition['value'][] = $this->getNewObjectId($user_id, 'users');
					}

					$condition['value'] = implode(',', $condition['value']);

					break;

				case 'feature':
					$condition['condition_element'] = $this->getNewObjectId($condition['condition_element'], 'product_features');
					$condition['value'] = $this->getNewObjectId($condition['value'], 'product_feature_variants');

					break;

				case 'usergroup':
					$condition['value'] = $this->getNewUsergroupId($condition['value']);

					break;

				case 'payment':
					$condition['value'] = $this->getNewObjectId($condition['value'], 'payments');
					break;
			}

			$conditions[$id] = $condition;
		}

		return $conditions;
	}

	public function convertPromotionBonuses($bonuses)
	{
		if (!empty($bonuses)) {
			foreach ($bonuses as $bonus_id => $bonus) {
				if (empty($bonus['value'])) {
					continue;
				}

				switch ($bonus['bonus']) {
					case 'discount_on_products':
						$product_ids = explode(',', $bonus['value']);
						$bonus['value'] = array();

						foreach ($product_ids as $product_id) {
							$bonus['value'][] = $this->getNewObjectId($product_id, 'products');
						}

						$bonus['value'] = implode(',', $bonus['value']);

						break;

					case 'discount_on_categories':
						$category_ids = explode(',', $bonus['value']);
						$bonus['value'] = array();

						foreach ($category_ids as $category_id) {
							$bonus['value'][] = $this->getNewObjectId($category_id, 'categories');
						}

						$bonus['value'] = implode(',', $bonus['value']);

						break;

					case 'give_usergroup':
						$bonus['value'] = $this->getNewObjectId($bonus['value'], 'usergroups');
						break;

					case 'give_coupon':
						$bonus['value'] = $this->getNewObjectId($bonus['value'], 'promotions');
						break;

					case 'free_shipping':
						$bonus['value'] = $this->getNewObjectId($bonus['value'], 'shippings');
						break;

					case 'free_products':
						$products = array();
						foreach ($bonus['value'] as $cart_id => $product_data) {
							$product_data['product_id'] = $this->getNewObjectId($product_data['product_id'], 'products');
							if (!empty($product_data['product_options'])) {
								$options = array();
								foreach ($product_data['product_options'] as $option_id => $variant_id) {
									$option_id = $this->getNewObjectId($option_id, 'product_options');
									$variant_id = $this->getNewObjectId($variant_id, 'product_option_variants');
									$options[$option_id] = $variant_id;
								}

								$product_data['product_options'] = $options;
							}

							$options = empty($product_data['product_options']) ? array() : $product_data['product_options'];
							$new_cart_id = fn_generate_cart_id($product_data['product_id'], array('product_options' => $options));

							$products[$new_cart_id] = $product_data;
						}

						$bonus['value'] = $products;
						break;
				}

				$bonuses[$bonus_id] = $bonus;
			}
		}

		return $bonuses;
	}

	public function processDiscussion($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$object_types = array(
			'P' => 'products',
			'C' => 'categories',
			'A' => 'pages',
			'O' => 'orders',
			'M' => 'companies'
		);

		if (!empty($object_types[$row['object_type']])) {
			$row['object_id'] = $this->getNewObjectId($row['object_id'], $object_types[$row['object_type']]);

			if (empty($row['object_id'])) {
				db_query('DELETE FROM ?:discussion WHERE thread_id = ?i', $new_key);

				return false;
			}
		}

		db_query('UPDATE ?:discussion SET ?u WHERE thread_id = ?i', $row, $new_key);
	}

	public function processDiscussionPosts($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$row['thread_id'] = $this->getNewObjectId($row['thread_id'], 'discussion');
		$row['user_id'] = $this->getNewObjectId($row['user_id'], 'users');

		db_query('UPDATE ?:discussion_posts SET ?u WHERE post_id = ?i', $row, $new_key);
	}

	public function processDiscussionMessages($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$row['thread_id'] = $this->getNewObjectId($row['thread_id'], 'discussion');

		db_query('UPDATE ?:discussion_messages SET ?u WHERE post_id = ?i', $row, $row['post_id']);
	}

	public function processDiscussionRating($new_key, $table_data, $row, $clone_data, $cloned_ids)
	{
		Stores_Import_General::connectToOriginalDB();

		$row['thread_id'] = $this->getNewObjectId($row['thread_id'], 'discussion');

		db_query('UPDATE ?:discussion_rating SET ?u WHERE post_id = ?i', $row, $row['post_id']);
	}

	public function replaceObjectIdsInBlocks($company_id) 
	{
		$blocks = db_get_array(
			"SELECT * FROM ?:bm_blocks_content "
				. "LEFT JOIN ?:bm_blocks ON ?:bm_blocks.block_id = ?:bm_blocks_content.block_id "
			. "WHERE company_id = ?i",
			$company_id
		);

		foreach ($blocks as $block) {
			$content = unserialize($block['content']);

			if ($block['object_id'] > 0) {
	 			$new_id = $this->getNewObjectId($block['object_id'], $block['object_type']);

	 			db_query(
	 				"UPDATE ?:bm_blocks_content SET object_id = ?i WHERE object_id = ?i AND object_type = ?s AND block_id = ?i", 
	 				$new_id, $block['object_id'], $block['object_type'], $block['block_id']
	 			);

	 			$block['object_id'] = $new_id;
	 		}

			if (!empty($content['items']['filling']) && $content['items']['filling'] == 'manually') {
		 		$item_ids = explode(',', $content['items']['item_ids']);

		 		foreach ($item_ids as $key => $id) {
		 			$item_ids[$key] = $this->getNewObjectId($id, $block['type']);
		 		}

		 		$content['items']['item_ids'] = implode(',', $item_ids);

		 		db_query(
	 				"UPDATE ?:bm_blocks_content SET content = ?s WHERE object_id = ?i AND object_type = ?s AND block_id = ?i AND lang_code = ?s", 
	 				serialize($content), $block['object_id'], $block['object_type'], $block['block_id'], $block['lang_code']
	 			);
			}
		}

		// Correct block snapping
		$snappings = db_get_array(
			'SELECT ?:bm_block_statuses.snapping_id, object_ids, object_type FROM ?:bm_block_statuses '
				. 'LEFT JOIN ?:bm_snapping ON ?:bm_block_statuses.snapping_id = ?:bm_snapping.snapping_id '
				. 'LEFT JOIN ?:bm_blocks ON ?:bm_blocks.block_id = ?:bm_snapping.block_id '
				. 'WHERE company_id = ?i AND object_ids != 0', $company_id
		);

		if (!empty($snappings)) {
			foreach ($snappings as $snapping) {
				$_ids = explode(',', $snapping['object_ids']);
				$new_ids = array();
				foreach ($_ids as $old_object_id) {
					$new_ids[] = $this->getNewObjectId($old_object_id, $snapping['object_type']);
				}

				db_query('UPDATE ?:bm_block_statuses SET object_ids = ?s WHERE snapping_id = ?i', implode(',', $new_ids), $snapping['snapping_id']);
			}
		}
	}

	public function importBlocks($company_id)
	{
		$destination_skin = fn_get_skin_path('[skins]/basic', 'customer', $company_id);
		$source_skin = fn_get_skin_path('[repo]/basic', 'customer', $company_id);

		fn_copy($source_skin, $destination_skin, false);

		// Clear skin names cache
		Registry::set('runtime.skin_names', '');

		CSettings::instance()->update_value('skin_name_customer', 'basic', '', true, $company_id);

		parent::importBlocks($company_id);

		$this->replaceObjectIdsInBlocks($company_id);
	}

	protected function _patchProfileFields($company_id)
	{
		Stores_Import_General::connectToOriginalDB();
		// Update email field
		$field_id = db_get_field("SELECT field_id FROM ?:profile_fields WHERE field_name = 'email' AND section = 'C'");

		db_query("DELETE FROM ?:profile_fields WHERE field_id = ?i ", $field_id);
		db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type = 'F'", $field_id);

		// Share new fields to new company
		$field_ids = db_get_fields("SELECT field_id FROM ?:profile_fields WHERE field_name = 'email'");
		foreach ($field_ids as $field_id) {
			db_query('REPLACE INTO ?:ult_objects_sharing (`share_company_id`, `share_object_id`, `share_object_type`) VALUES (?i, ?i, ?s)', $company_id, $field_id, 'profile_fields');
		}
	}
}
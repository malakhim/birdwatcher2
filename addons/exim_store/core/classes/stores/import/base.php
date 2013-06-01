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

abstract class Stores_Import_Base
{
	protected $store_data = array();

	// you can increase (up to 2-10 times) this values if you have powerful server (do not forget increase memory limit)
	protected $limit_step_small_data = 1000; // step for limit statement if processed data is small
	protected $limit_step_big_data = 200; // step for limit statement if processed data is huge

	protected $temporary = ''; // comment this line in case using temporary tables
	//protected $temporary = 'TEMPORARY'; // uncomment to use temporary table with links old_object_id -> new_object_id

	
	public function __construct($store_data)
	{
		$this->store_data = $store_data;

		//@ini_set('memory_limit', '512M');
	}

	/**
	 * Replaces old layouts by new
	 * @return Always true
	 */
	protected function _normalizeProductViews()
	{
		db_query(
			"UPDATE ?:products SET details_layout = 'default_template' "
			. "WHERE details_layout IN ('modern_template', 'old_style_template')"
		);

		db_query(
			"UPDATE ?:categories SET product_details_layout = 'default_template' "
			. "WHERE product_details_layout IN ('modern_template', 'old_style_template')"
		);

		db_query(
			"UPDATE ?:categories SET default_layout = 'products_multicolumns' "
			. "WHERE default_layout IN ('products', 'products_grid', 'products_multicolumns2', 'products_multicolumns3')"
		);

		// Prepare data for multicheckbox field
		$selected_layouts = fn_get_products_views();
		foreach($selected_layouts as $key => $value) {
			$selected_layouts[$key] = $key;
		}

		db_query(
			"UPDATE ?:categories SET selected_layouts = ?s WHERE selected_layouts <> '' ",
			serialize($selected_layouts)
		);

		return true;
	}

	/**
	 * Set empty usergroup fields as zero
	 * @return Always true
	 */
	protected function _normalizeUserGroupIds()
	{
		db_query("UPDATE ?:products SET usergroup_ids = 0 WHERE usergroup_ids ='' ");
		return true;
	}

	/**
	 * Imports list of product tabs to edition
	 *
	 * @param array $product_tabs List of product tabs data
	 * @param int $company_id company identifier
	 * @return type
	 */
	protected function importProductTabs($product_tabs, $company_id = 0)
	{
		foreach ($product_tabs as $product_tab) {
			$block_id = 0;

            if (!empty($product_tab['product_ids']) && method_exists($this, 'getNewObjectId')) {
                $_ids = explode(',', $product_tab['product_ids']);
                $_new_ids = array();
                foreach ($_ids as $_id) {
                    $_new_ids[] = $this->getNewObjectId($_id, 'products');
                }

                $product_tab['product_ids'] = implode(',', $_new_ids);
            }

			if (!empty($product_tab['block'])) {
				$block_id = Bm_Block::instance($company_id)->update($product_tab['block']);

				if (!empty($product_tab['block']['translations']) && is_array($product_tab['block']['translations'])) {
					foreach ($product_tab['block']['translations'] as $translation) {
						Bm_Block::instance($company_id)->update(
							array(
								'block_id' => $block_id,
								'type' => $product_tab['block']['type']
							),
							$translation
						);
					}
				}

				if (!empty($product_tab['block']['contents']) && is_array($product_tab['block']['contents'])) {
					foreach ($product_tab['block']['contents'] as $content) {
						Bm_Block::instance($company_id)->update(
							array(
								'block_id' => $block_id,
								'type' => $product_tab['block']['type'],
								'content_data' => $content
							)
						);
					}
				}

			}

			$tab_id = Bm_ProductTabs::instance($company_id)->update($product_tab);

			if (!empty($product_tab['translations']) && is_array($product_tab['translations'])) {
				foreach ($product_tab['translations'] as $translation) {
					$translation['tab_id'] = $tab_id;
					$translation['block_id'] = $block_id;
					Bm_ProductTabs::instance($company_id)->update($translation);
				}
			}

		}
	}

	/**
	 * Returns list of product tabs from 2.2.x database
	 *
	 * @param string $lang_code 2 letters language code
	 * @return array List of tabs
	 */
	protected function getProductTabs($lang_code)
	{
		Stores_Import_General::connectToOriginalDB();

		Stores_Import_General::connectToImportedDB($this->store_data);
		$bm = new Stores_Import_Blocks($this->store_data);

		$tabs = array();

		$tabs_group = db_get_row("SELECT * FROM ?:blocks WHERE ?:blocks.block_type = 'G' AND ?:blocks.text_id='product_details'");
		$blocks = db_get_hash_array(
			 "SELECT ?:blocks.text_id, ?:block_positions.group_id, ?:blocks.block_id, ?:blocks.location, "
				."?:blocks.disabled_locations, ?:blocks.status, ?:block_descriptions.lang_code, "
				."?:blocks.properties, ?:block_descriptions.description, ?:block_positions.position FROM ?:blocks "
			. "LEFT JOIN ?:block_descriptions "
				. "ON ?:blocks.block_id = ?:block_descriptions.block_id AND ?:block_descriptions.object_type = 'B' "
				."AND ?:block_descriptions.lang_code = ?s "
			. "LEFT JOIN ?:block_positions "
				   . "ON ?:blocks.block_id = ?:block_positions.block_id AND (?:block_positions.location = ?s)"
		   . "WHERE block_type = 'B' AND (?:blocks.location = ?s OR ?:blocks.location = 'all_pages') "
					. "AND ?:block_positions.group_id =?i GROUP BY ?:block_positions.block_id ORDER BY ?:block_positions.position ASC",
		   'block_id', $lang_code, 'products', 'products', $tabs_group['block_id']
		);

		foreach ($blocks as $block_id => $block) {
			$_block = $bm->getBlockData($block, $lang_code);

			$translations = db_get_array(
				"SELECT * FROM ?:block_descriptions WHERE block_id = ?i AND object_text_id = '' AND object_type  = 'B'",
				$block['block_id']
			);

			foreach ($translations as $translation) {
				$_block['translations'][] = array(
					'name' => $translation['description'],
					'lang_code' => $translation['lang_code']
				);
			}

			$contents = array_merge(
				db_get_array(
					"SELECT * FROM ?:block_links WHERE block_id = ?i AND item_ids != '' AND location = ?s AND object_id > 0",
					$block['block_id'], 'products'
				),
				db_get_array (
					"SELECT * FROM ?:block_descriptions "
						. "LEFT JOIN ?:block_links ON ?:block_links.block_id = ?:block_descriptions.block_id "
						. "AND ?:block_links.object_id = ?:block_descriptions.object_id "
					. "WHERE ?:block_descriptions.block_id = ?i AND object_text_id = 'block_text'",
					$block['block_id']
				)
			);

			foreach ($contents as $content) {
				if (isset($content['lang_code'])) {
					$_content = array(
						'content' => $content['description']
					);
				} else {
					$_content['items'] = array (
						'filling' => $_block['properties']['fillings'],
						'item_ids' => $content['item_ids']
					);
				}

				$_block['contents'][] = array(
					'object_type' => (isset($content['object_id']) && $content['object_id'] > 0) ? $content['location'] : '',
					'object_id' => isset($content['object_id']) ? $content['object_id'] : '',
					'lang_code' => isset($content['lang_code']) ? $content['lang_code'] : '',
					'content' => $_content
				);
			}

			$_pids = !empty($_block['statuses']) && !empty($_block['statuses']['products']) ? $_block['statuses']['products'] : '';

			$tabs[] = array(
			 	'tab_type' => 'B',
				'status' => $_block['status'],
				'name' => $block['description'],
				'lang_code' => $block['lang_code'],
				'block' => $_block,
				'translations' => $_block['translations'],
				'product_ids' => $_pids,
			);
		}

		return $tabs;
	}

	/**
	 * Returns companies list
	 *
	 * @return array Companies list
	 */
	public function getCompanies()
	{
		$companies = array();

		$new_db = Stores_Import_General::connectToImportedDB($this->store_data);

		if ($new_db != null) {
			$companies = db_get_hash_array('SELECT * FROM ?:companies', 'company_id');
		}

		return $companies;
	}

	/**
	 * Returns list of tables in database
	 *
	 * @return array List of tables
	 */
	public function getTables()
	{
		return db_get_fields('SHOW TABLES');
	}

	/**
	 * Imports company
	 *
	 * @param array $company_data
	 * @return int|bool New company id on success, false otherwise
	 */
	public function importCompany($company_data)
	{
		Stores_Import_General::connectToOriginalDB();

		$company_data['shippings'] = explode(',',  $company_data['shippings'] );
		$company_data['storefront'] = $this->store_data['storefront'];
		$company_data['secure_storefront'] = $this->store_data['secure_storefront'];

		$company_id = fn_update_company($company_data);

		return $company_id;
	}

	/**
	 * Imports blocks
	 *
	 * @param int $company_id Company identifier
	 * @return bool True on success false, otherwise
	 */
	public function importBlocks($company_id = null)
	{
		if ($company_id === null) {
			$company_id = "";
		}

		$blocks = new Stores_Import_Blocks($this->store_data);
		$structure = $blocks->getXmlLocationsScheme();

		Stores_Import_General::connectToOriginalDB();

		return Bm_Exim::instance($company_id)->import($structure, array('override_by_dispatch' => true));
	}

	public function copyLanguages($company_id)
	{
		$store_data = $this->store_data;
		Stores_Import_General::connectToImportedDB($store_data);

		// Get all available languages and compare its with existing.
		$languages = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		Stores_Import_General::connectToOriginalDB();
		$existing = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		$new_languages = array_diff_key($languages, $existing);

		if (!empty($new_languages)) {
			// We have to create new languages
			foreach ($new_languages as $lang_code => $language_data) {
				db_query("INSERT INTO ?:languages ?e", $language_data);
				fn_clone_language($language_data['lang_code'], CART_LANGUAGE);
			}
		}

		// Share languages to new company
		foreach ($languages as $lang_code => $language_data) {
			db_query('INSERT INTO ?:ult_objects_sharing (share_company_id, share_object_id, share_object_type) VALUES (?i, ?s, ?s)', $company_id, $lang_code, 'languages');
		}

		Stores_Import_General::connectToImportedDB($store_data);
		$total_lang_vars = db_get_field('SELECT COUNT(*) FROM ?:language_values');
		$index = 0;
		$step = $this->limit_step_small_data;

		while ($index < $total_lang_vars) {
			Stores_Import_General::connectToImportedDB($store_data);
			$lang_vars = db_get_array('SELECT * FROM ?:language_values LIMIT ?i, ?i', $index, $step);

			if (!empty($lang_vars)) {
				$_data = $_ult_data = array();

				foreach ($lang_vars as $var) {
					$_data[] = db_quote('(?s, ?s, ?s)', $var['lang_code'], $var['name'], $var['value']);
					$_ult_data[] = db_quote('(?s, ?s, ?s, ?i)', $var['lang_code'], $var['name'], $var['value'], $company_id);
				}

				$query = 'INSERT IGNORE INTO ?:language_values (`lang_code`, `name`, `value`) VALUES ' . implode(',', $_data);
				$query_ult = 'INSERT IGNORE INTO ?:ult_language_values (`lang_code`, `name`, `value`, `company_id`) VALUES ' . implode(',', $_ult_data);

				Stores_Import_General::connectToOriginalDB();
				db_query($query);
				db_query($query_ult);
			}

			$index += $step;
		}

		$languages = db_get_hash_array("SELECT * FROM ?:languages", 'lang_code');
		Registry::set('languages', $languages);

		if (PRODUCT_TYPE == 'ULTIMATE') {
			$lang_vars = array(
				'add_companies', 'add_companies_and_close', 'vendors_menu_description', 'vendor_account_balance_menu_description', 'product_approval_menu_description', 'all_vendors', 'text_commercial_promotion', 'vendors', 'error_admin_not_created_email_already_used', 'text_list_of_vendors', 'add_vendor', 'new_vendor', 'editing_vendor', 'no_vendor', 'do_not_assign_vendor', 'available_for_vendor', 'vendor_pages', 'search_by_vendor', 'search_by_owner', 'error_vendor_exists', 'create_administrator_account', 'view_vendor_products', 'view_vendor_users', 'view_vendor_orders', 'vendor_account_balance', 'vendor_commission', 'displayed_vendors', 'charge_to_vendor_account', 'apply_for_vendor_account', 'text_not_approved_vendors', 'text_company_status_new_to_active_subj', 'text_company_status_new_to_active', 'text_company_status_new_to_pending', 'text_company_status_pending_to_active', 'text_company_status_new_to_disable_subj', 'text_company_status_new_to_disable',  'notify_vendors_by_email',  'new_payout',  'unable_delete_vendor_orders_exists',  'vendor_approval_pending',  'ult_overwrite_variables',  'text_select_vendor', 'view_vendor_categories', 'vendor', 'supplier', 'suppliers', 
			);

			db_query('DELETE FROM ?:ult_language_values WHERE company_id = ?i AND name IN (?a)', $company_id, $lang_vars);
		}
	}

	/**
	 * Returns list of settings
	 *
	 * @return array List of settings
	 */
	public function getSettings()
	{
		return db_get_array('SELECT * FROM ?:settings');
	}

	/**
	 * Imports settings
	 *
	 * @param array $settings List of settings
	 * @param int $company_id Company identifier
	 * @return bool Always true
	 */
	public function importSettings($settings, $company_id = null)
	{
		$expected_settings = $this->getExpectSettings();

		Stores_Import_General::connectToOriginalDB();

		foreach ($settings as $setting) {
			if (array_search($setting['section_id'] . '.' . $setting['option_name'], $expected_settings) === false) {
				CSettings::instance()->update_value($setting['option_name'], $setting['value'], $setting['section_id'], false, $company_id);
			}
		}

		return true;
	}

	/**
	 * Returns list of addons that can be installed
	 *
	 * @return array List of add-on names
	 */
	public function getExcludedAddons()
	{
		return array (
			'searchanise',
			'twigmo'
		);
	}

	/**
	 * Return list of installed add-ons
	 *
	 * @return array List af add-ons
	 */
	public function getAddons()
	{
		$addons = db_get_hash_array("SELECT * FROM ?:addons ORDER BY priority", 'addon');

		return $addons;
	}

	/**
	 * Imports add-ons
	 *
	 * @param array $addons list of add-ons
	 * @param int $company_id Company identifier
	 * @return bool Always true
	 */
	public function importAddons($addons, $company_id = null)
	{
		$expected = $this->getExcludedAddons();

		foreach ($addons as $addon_data) {
			if (array_search($addon_data['addon'], $expected) === false) {
				$this->_importAddon($addon_data, $company_id);
			}
		}

		fn_install_addon('exim_store', false);

		return true;
	}

	/**
	 * Imports add-on settings
	 *
	 * @param array $addon_data List of add-on data
	 * @return bool Always true
	 */
	protected function _importAddonSettings($addon_data)
	{
		if (!empty($addon_data['options'])) {
			$options = unserialize($addon_data['options']);

			foreach ($options as $option_name => $option_value) {
				CSettings::instance()->update_value($option_name, $option_value, $addon_data['addon']);
			}
		}

		return true;
	}

	/**
	 * Creates add-on tabs
	 *
	 * @param Addons_XmlScheme $addon_scheme
	 * @return bool Always true
	 */
	protected function _createAddonTabs ($addon_scheme)
	{
		if (PRODUCT_TYPE == 'ULTIMATE') {
			foreach (fn_get_all_companies_ids() as $company) {
				Bm_ProductTabs::instance($company)->create_addon_tabs($addon_scheme->get_id(), $addon_scheme->get_tab_order());
			}
		} else {
			Bm_ProductTabs::instance()->create_addon_tabs($addon_scheme->get_id(), $addon_scheme->get_tab_order());
		}

		return true;
	}

	/**
	 * Copies addon templates from SKINS_REPOSITORY to SKINS
	 *
	 * @param string $addon_name Addons name to copy templates for
	 * @return bool Always true
	 */
	protected function _installAddonTemplates($addon_name)
	{
		$areas = array('customer', 'admin', 'mail');
		if (PRODUCT_TYPE == 'ULTIMATE') {
			foreach (fn_get_all_companies_ids() as $company) {
				$installed_skins = fn_get_dir_contents(DIR_ROOT . '/' . DIR_STORES . $company . '/skins');
				foreach ($installed_skins as $skin_name) {
					foreach ($areas as $area) {
						if (is_dir(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name)) {
							fn_copy(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name, DIR_ROOT . '/' . DIR_STORES . $company . '/skins/' . $skin_name . '/' . $area . '/addons/' . $addon_name);
						}
					}
				}
			}
		} else {
			$installed_skins = fn_get_dir_contents(DIR_SKINS);
			foreach ($installed_skins as $skin_name) {
				foreach ($areas as $area) {
					if (is_dir(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name)) {
						fn_copy(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name, DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon_name);
					}
				}
			}
		}

		return true;
	}

	public function getCompanyData()
	{
		$company = db_get_hash_single_array('SELECT value, option_name FROM ?:settings WHERE section_id = "Company"', array('option_name', 'value'));

		return $company;
	}

	/**
	 * Imports store data
	 *
	 * @abstract
	 * @return bool True on success, false otherwise
	 */
	abstract public function import();

	/**
	 * Gets list of settings that cannot be imported
	 *
	 * @abstract
	 * @return bool True on success, false otherwise
	 */
	abstract public function getExpectSettings();

	/**
	 * Imports one add-on
	 *
	 * @abstract
	 * @param array $addon_data Add-on data
	 * @param int $company_id Company identifier
	 * @return bool True on success, false otherwise
	 */
	abstract protected function _importAddon($addon_data, $company_id);
}

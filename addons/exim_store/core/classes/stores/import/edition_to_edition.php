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

class Stores_Import_EditionToEdition extends Stores_Import_Base
{
	public function import()
	{
		$export_old_database_text =	fn_get_lang_var('es_export_old_database');

		$cart_language = Registry::get("settings.Appearance.admin_default_language");

		Stores_Import_General::connectToImportedDB($this->store_data);

		fn_define('DB_MAX_ROW_SIZE', 10000);
		fn_define('DB_ROWS_PER_PASS', 40);

		$tables = $this->getTables();
		$except_tables = $this->_getExceptTables();
		foreach ($tables as $k => $table) {
			if (in_array($table, $except_tables)) {
				unset($tables[$k]);
			}
		}

		fn_set_progress('total', 10);
		fn_set_progress('echo', '<br />' . $export_old_database_text);

		db_export_to_file(DIR_DATABASE . 'backup/export.sql', $tables, true, true, false, true, false);

		$default_language = db_get_field(
			"SELECT value FROM ?:settings WHERE option_name = 'customer_default_language' AND section_id = 'Appearance'"
		);

		$addons = $this->getAddons();
		$settings = $this->getSettings();
		$productTabs = $this->getProductTabs($default_language);

		Stores_Import_General::connectToOriginalDB();

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_old_database'));
		db_import_sql_file(DIR_DATABASE . 'backup/export.sql', 16384, true, true, false, false, false, false);
		
		$this->_applayPatches();
		
		$tabs = db_get_array("SELECT * FROM ?:product_tabs WHERE tab_type = 'B' OR addon <> ''");
		foreach ($tabs as $tab) {
			Bm_ProductTabs::instance()->delete($tab['tab_id'], true);
		}

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_languages'));
		$this->copyLanguages($cart_language);

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_settings'));
		$this->importSettings($settings);

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_add_ons'));
		$this->importAddons($addons);

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_menus_and_blocks'));
		$this->_importMenu();

		$this->importBlocks();
		foreach (Registry::get('languages') as $lang_code => $value) {
			fn_clone_language_values("bm_blocks_content", $lang_code, $cart_language);
			fn_clone_language_values("bm_blocks_descriptions", $lang_code, $cart_language);
		}

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_product_tabs'));
		$this->importProductTabs($productTabs);

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_files'));
		$this->copyFiles();

		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_images'));
		$this->copyImages();

		$this->_patchProfileFields(0);

		$this->_normalizeProductViews();

		$this->_normalizeUserGroupIds();

		$this->_fixLanguagesMissedInImported($default_language);

		return true;
	}

	protected function _fixLanguagesMissedInImported($copy_from_language)
	{
		Stores_Import_General::connectToImportedDB($this->store_data);

		// Get all available languages and compare its with existing.
		$languages = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		Stores_Import_General::connectToOriginalDB();
		$existing = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		$missed_languages = array_diff_key($existing, $languages);

		if (!empty($missed_languages)) {
			// We have to create new languages
			foreach ($missed_languages as $lang_code => $language_data) {
				fn_clone_language($language_data['lang_code'], $copy_from_language);
			}
		}
	}

	protected function _applayPatches()
	{
		fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_patch_database'));
		db_import_sql_file(DIR_ADDONS . 'exim_store/database/' . $this->getSqlPatchName() . '.sql', 16384, true, true, false, false, false, false);
	}

	protected function _patchProfileFields($company_id)
	{
		Stores_Import_General::connectToOriginalDB();
		// Update email field
		$field_id = db_get_field("SELECT field_id FROM ?:profile_fields WHERE field_name = 'email' AND section = 'C'");

		$billing_email_id = db_query(
			"INSERT INTO ?:profile_fields (field_name, profile_show, profile_required, checkout_show, checkout_required, "
				. "partner_show, partner_required, field_type, position, is_default, section, matching_id, class) "
			. "VALUES ('email', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'E', '105', 'Y', 'B', '33', 'billing-email')"
		);

		$shipping_email_id = db_query(
			"INSERT INTO ?:profile_fields (field_name, profile_show, profile_required, checkout_show, checkout_required, "
				. "partner_show, partner_required, field_type, position, is_default, section, matching_id, class) "
			. "VALUES ('email', 'N', 'N', 'N', 'N', 'N', 'N', 'E', '205', 'Y', 'S', ?i, 'shipping-email')",
			$billing_email_id
		);

		db_query(
			"INSERT INTO ?:profile_field_descriptions (object_id, description, object_type, lang_code) "
			. "VALUES (?i, 'E-mail', 'F', ?s);",
			$billing_email_id, DEFAULT_LANGUAGE
		);

		foreach (Registry::get('languages') as $lang_code => $value) {
			db_query(
				"REPLACE INTO ?:profile_field_descriptions (object_id, description, object_type, lang_code) "
				. "VALUES (?i, 'E-mail', 'F', ?s), (?i, 'E-mail', 'F', ?s);",
				$shipping_email_id, $lang_code, $billing_email_id, $lang_code
			);
		}

		db_query(
			"UPDATE ?:profile_fields SET matching_id = ?i WHERE field_id = ?i ", $shipping_email_id, $billing_email_id
		);

		db_query("DELETE FROM ?:profile_fields WHERE field_id = ?i ", $field_id);
		db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type='F'", $field_id);
	}

	protected function copyFiles()
	{
		if (is_dir($this->store_data['path'] . '/var/attachments')) {
			fn_copy($this->store_data['path'] . '/var/attachments', DIR_ROOT . '/var/attachments', false);
		}

		fn_copy($this->store_data['path'] . '/var/downloads', DIR_DOWNLOADS, false);
	}

	protected function copyImages()
	{
		$images_dirs = fn_get_dir_contents($this->store_data['path'] . '/images', true, false, '', $this->store_data['path'] . '/images/');

		foreach ($images_dirs as $dir) {
			fn_copy($dir, DIR_IMAGES . fn_basename($dir), false);
		}
	}

	protected function _importMenu()
	{
		Stores_Import_General::connectToOriginalDB();
		db_query("DELETE FROM ?:menus");

		$top_menu_id = Menu::update(array(
			'lang_code' => DEFAULT_LANGUAGE,
			'name' => 'Top menu',
			'status' => 'A'
		));

		db_query("UPDATE ?:static_data SET param_5 = ?i WHERE section = 'A'", $top_menu_id);

		$quick_menu_id = Menu::update(array(
			'lang_code' => DEFAULT_LANGUAGE,
			'name' => 'Quick menu',
			'status' => 'A'
		));

		db_query("UPDATE ?:static_data SET param_5 = ?i WHERE section = 'N'", $quick_menu_id);
		db_query("UPDATE ?:static_data SET section = 'A' WHERE section = 'N'");

		$blocks = db_get_array(
			"SELECT ?:bm_blocks_content.block_id, content FROM ?:bm_blocks_content "
				. "LEFT JOIN ?:bm_blocks ON ?:bm_blocks.block_id = ?:bm_blocks_content.block_id "
			. "WHERE type = 'menu'"
		);

		foreach ($blocks as $block) {
			$content = unserialize($block['content']);

			if (isset($content['menu'])) {
				$content['menu'] = $quick_menu_id;
				db_query("UPDATE ?:bm_blocks_content SET content = ?s WHERE block_id = ?i", serialize($content), $block['block_id']);
			}
		}
	}

	protected function _getExceptTables()
	{
		return array(
			$this->store_data['table_prefix'] . 'settings',
			$this->store_data['table_prefix'] . 'settings_descriptions',
			$this->store_data['table_prefix'] . 'settings_variants',
			$this->store_data['table_prefix'] . 'settings_sections',
			$this->store_data['table_prefix'] . 'addons',
			$this->store_data['table_prefix'] . 'addon_descriptions',
			$this->store_data['table_prefix'] . 'quick_search',
			$this->store_data['table_prefix'] . 'language_values',
			$this->store_data['table_prefix'] . 'languages',
			$this->store_data['table_prefix'] . 'payment_processors'
		);
	}

	public function copyLanguages($copy_from_language)
	{
		Stores_Import_General::connectToImportedDB($this->store_data);

		// Get all available languages and compare its with existing.
		$languages = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		Stores_Import_General::connectToOriginalDB();
		$existing = db_get_hash_array('SELECT * FROM ?:languages', 'lang_code');

		$new_languages = array_diff_key($languages, $existing);

		if (!empty($new_languages)) {
			// We have to create new languages
			foreach ($new_languages as $lang_code => $language_data) {
				db_query("INSERT INTO ?:languages ?e", $language_data);
				fn_clone_language($language_data['lang_code'], $copy_from_language);
			}
		}

		Stores_Import_General::connectToImportedDB($this->store_data);
		$total_lang_vars = db_get_field('SELECT COUNT(*) FROM ?:language_values');
		$index = 0;
		$step = $this->limit_step_small_data;

		while ($index < $total_lang_vars) {
			Stores_Import_General::connectToImportedDB($this->store_data);
			$lang_vars = db_get_array('SELECT * FROM ?:language_values LIMIT ?i, ?i', $index, $step);

			if (!empty($lang_vars)) {
				$_data = array();

				foreach ($lang_vars as $var) {
					$_data[] = db_quote('(?s, ?s, ?s)', $var['lang_code'], $var['name'], $var['value']);
				}

				$query = 'REPLACE INTO ?:language_values (`lang_code`, `name`, `value`) VALUES ' . implode(',', $_data);

				Stores_Import_General::connectToOriginalDB();
				db_query($query);
			}

			$index += $step;
		}

		$languages = db_get_hash_array("SELECT * FROM ?:languages", 'lang_code');
		Registry::set('languages', $languages);
	}

	protected function _importAddon($addon_data, $company_id)
	{
		$addon = $addon_data['addon'];
		$addon_scheme = Addons_SchemesManager::get_scheme($addon_data['addon']);

		if ($addon_scheme != false) {
			// Register custom classes
			fn_register_custom_classes(DIR_ADDONS . $addon . '/core/classes', '');

			$_data = array (
				'addon' => $addon_scheme->get_id(),
				'priority' =>  $addon_scheme->get_priority(),
				'dependencies' => implode(',', $addon_scheme->get_dependencies()),
				'conflicts' => implode(',', $addon_scheme->get_conflicts()),
				'version' => $addon_scheme->get_version(),
				'separate' => ($addon_scheme->get_settings_layout() == 'separate') ? 1 : 0,
				'status' => 'D' // addon is disabled by default when installing
			);

			$addon_scheme->call_custom_functions('before_install');

			// Add optional language variables
			$addon_scheme->install_language_values();

			fn_update_addon_settings($addon_scheme);

			db_query("REPLACE INTO ?:addons ?e", $_data);

			foreach ($addon_scheme->get_addon_translations() as $translation) {
				db_query("REPLACE INTO ?:addon_descriptions ?e", array(
					'lang_code' => $translation['lang_code'],
					'addon' =>  $addon_scheme->get_id(),
					'name' => $translation['value'],
					'description' => $translation['description']
				));
			}

			$this->_installAddonTemplates($addon);
			$this->_createAddonTabs($addon_scheme);

			// Execute custom functions
			$addon_scheme->call_custom_functions('install');

			// If we need to activate addon after install, call "update status" procedure
			if ($addon_data['status'] == 'A') {
				fn_update_addon_status($addon, 'A', false, true);
			}

			db_import_sql_file(DIR_ADDONS . 'exim_store/database/addons/' . $addon . '_' . $this->getSqlPatchName() . '.sql');

			$this->_importAddonSettings($addon_data);

			return true;
		} else {
			return false;
		}

	}

	public function getExpectSettings()
	{
		return array (
			'Appearance.default_products_layout',
			'Appearance.default_products_layout_templates',
			'Appearance.default_products_sorting',
			'.skin_name_customer',
			'.skin_name_admin',
			'Upgrade_center.license_number',
		);
	}

	public function getSqlPatchName ()
	{
		return strtolower(Stores_Import_General::getImportName($this->store_data));
	}
}

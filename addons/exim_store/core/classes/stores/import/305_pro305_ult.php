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

class Stores_Import_305Pro305Ult extends Stores_Import_EditionToUltimate
{
	public $scheme;

	public function import()
	{
		Stores_Import_General::connectToImportedDB($this->store_data);

		$default_language = CSettings::instance()->get_value('customer_default_language', 'Appearance');
		$cart_language = Registry::get("settings.Appearance.admin_default_language");

		$this->scheme = $this->_getImportScheme();

		$companies = $this->getCompanies();
		$addons = $this->getAddons();

		foreach ($companies as $company_data) {
			$company_id = $this->importCompany($company_data, $this->store_data);

			if (empty($company_id)) {
				return false;
			}

			Stores_Import_General::connectToOriginalDB();

			db_query("DROP TABLE IF EXISTS ?:upgrade_objects");
			db_query(
				"CREATE $this->temporary TABLE ?:upgrade_objects ("
					. "`object_id` varchar(15) NOT NULL default '', "
					. "`new_object_id` varchar(15) NOT NULL default '', "
					. "`object` varchar(255) NOT NULL default '', "
					. "PRIMARY KEY (`object_id`,`object`), "
					. "KEY (`new_object_id`,`object`) "
				. ") ENGINE=MyISAM DEFAULT CHARSET UTF8 "
			);

			fn_set_progress('total', 25); // Copy Languages + ImportObjets + Blocks + Settings + Addons and Images

			fn_set_progress('echo', fn_get_lang_var('es_copy_languages'));
			$this->copyLanguages($company_id);


			$this->importObject('currencies', $company_id);
			$this->importObject('payments', $company_id);
			$this->importObject('destinations', $company_id);
			$this->importObject('shippings', $company_id);
			$this->importObject('taxes', $company_id);
			$this->importObject('countries', $company_id);
			$this->importObject('states', $company_id);
			$this->importObject('pages', $company_id);
			$this->importObject('categories', $company_id);
			$this->importObject('products', $company_id);
			$this->importObject('product_features', $company_id);
			$this->importObject('product_filters', $company_id);
			$this->importObject('users', $company_id);
			$this->importObject('static_data', $company_id);
			$this->importObject('promotions', $company_id);
			$this->importObject('orders', $company_id);
			$this->importObject('profile_fields', $company_id);
			$this->importObject('sitemap', $company_id);
			$this->importObject('statuses', $company_id);

			fn_set_progress('echo', fn_get_lang_var('es_import_settings'));
			$this->importSettings($company_id);

			fn_set_progress('echo', fn_get_lang_var('es_import_add_ons'));
			$this->importAddons($addons, $company_id);

			fn_set_progress('echo', fn_get_lang_var('es_import_blocks'));
			$this->importBlocks($company_id);
			
			foreach (Registry::get('languages') as $lang_code => $value) {
				fn_clone_language_values("bm_blocks_content", $lang_code, $cart_language);
				fn_clone_language_values("bm_blocks_descriptions", $lang_code, $cart_language);
			}

			fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_product_tabs'));
			Stores_Import_General::connectToOriginalDB();
			Bm_ProductTabs::instance($company_id)->create_default_tabs();
			$this->importProductTabs($company_id);

			$this->importObject('images', $company_id);
			fn_set_progress('echo', fn_get_lang_var('es_import_images'));

			$this->_normalizeProductViews();
		}

		$this->_normalizeUserGroupIds();

		return true;
	}

	public function getCompanyData()
	{
		$company = CSettings::instance()->get_values('Company');

		return $company;
	}

	public function getSettings()
	{
		$company = CSettings::instance()->get_values('Company');

		return $company;
	}

	public function getExceptSettings()
	{
		return array (
			'default_products_layout',
			'default_products_layout_templates',
			'default_products_sorting',
		);
	}

	public function importSettings($company_id)
	{
		Stores_Import_General::connectToImportedDB($this->store_data);
		
		$old_settings = db_get_array('SELECT object_id, name, value, section_id FROM ?:settings_objects');
		$excepted_settings = $this->getExceptSettings();
		
		Stores_Import_General::connectToOriginalDB();

		foreach ($old_settings as $setting) {
			if (array_search($setting['name'], $excepted_settings) === false) {
				CSettings::instance()->update_value($setting['name'], $setting['value'], '', false, $company_id);
			}
		}

		return true;
	}

	public function importBlocks($company_id)
	{
		$destination_skin = fn_get_skin_path('[skins]/basic', 'customer', $company_id);
		$source_skin = fn_get_skin_path('[repo]/basic', 'customer', $company_id);

		fn_copy($source_skin, $destination_skin, false);

		CSettings::instance()->update_value('skin_name_customer', 'basic');

		Stores_Import_General::connectToImportedDB($this->store_data);
		$xml_schema = Bm_Exim::instance()->export();
		$structure = simplexml_load_string($xml_schema, 'ExSimpleXmlElement', LIBXML_NOCDATA);

		Stores_Import_General::connectToOriginalDB();
		Bm_Exim::instance($company_id)->import($structure);

		$this->replaceObjectIdsInBlocks($company_id);

		return true;
	}

	public function importProductTabs($company_id)
	{
		Stores_Import_General::connectToImportedDB($this->store_data);
		$tabs = db_get_array('SELECT * FROM ?:product_tabs WHERE tab_type = ?s', 'B');
		if (!empty($tabs)) {
			foreach ($tabs as $id => $tab) {
				$_tab_data = $tab;
				// Process product_ids
				Stores_Import_General::connectToOriginalDB();
				$product_ids = array();

				if (!empty($tab['product_ids'])) {
					$_product_ids = explode(',', $tab['product_ids']);
					
					foreach ($_product_ids as $product_id) {
						$product_ids[] = $this->getNewObjectId($product_id, 'products');
					}
				}
				$_tab_data['product_ids'] = implode(',', $product_ids);

				Stores_Import_General::connectToImportedDB($this->store_data);

				$block = Bm_Block::instance()->get_by_id($tab['block_id']);
				$_tab_data['block_id'] = Bm_Block::instance($company_id)->update($block);

				Stores_Import_General::connectToOriginalDB();
				
				unset($_tab_data['tab_id']);
				$_tab_data['company_id'] = $company_id;
				$new_tab_id = db_query('INSERT INTO ?:product_tabs ?e', $_tab_data);

				Stores_Import_General::connectToImportedDB($this->store_data);
				$descriptions = db_get_array('SELECT * FROM ?:product_tabs_descriptions WHERE tab_id = ?i', $tab['tab_id']);

				Stores_Import_General::connectToOriginalDB();
				foreach ($descriptions as $description) {
					$description['tab_id'] = $new_tab_id;
					db_query('INSERT INTO ?:product_tabs_descriptions ?e', $description);
				}
			}
		}

		return true;
	}

	protected function _getImportScheme()
	{
		$scheme = fn_get_schema('import', 'stores_22x_pro');

		return $scheme;
	}

}

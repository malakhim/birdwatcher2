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

class Stores_Import_224Com302Ult extends Stores_Import_EditionToUltimate
{
	public $scheme;

	public function import()
	{
		Stores_Import_General::connectToImportedDB($this->store_data);

		$default_language = db_get_field(
			"SELECT value FROM ?:settings WHERE option_name = 'customer_default_language' AND section_id = 'Appearance'"
		);
		$cart_language = Registry::get("settings.Appearance.admin_default_language");

		$this->scheme = $this->_getImportScheme();

		$companies = $this->getCompanies();
		$addons = $this->getAddons();
		$settings = $this->getSettings();

		foreach ($companies as $company_data) {
			$productTabs = $this->getProductTabs($default_language);

			$company_id = $this->importCompany($company_data, $this->store_data);
			if (empty($company_id)) {
				continue;
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

			fn_set_progress('total', 24); // Copy Languages + ImportObjets + Blocks + Settings + Addons and Images
			
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

			$this->importSettings($settings, $company_id);
			fn_set_progress('echo', fn_get_lang_var('es_import_settings'));
			
			$this->importAddons($addons, $company_id);
			fn_set_progress('echo', fn_get_lang_var('es_import_add_ons'));

			fn_set_progress('echo', fn_get_lang_var('es_import_blocks'));
			$this->importBlocks($company_id);
			foreach (Registry::get('languages') as $lang_code => $value) {
				fn_clone_language_values("bm_blocks_content", $lang_code, $cart_language);
				fn_clone_language_values("bm_blocks_descriptions", $lang_code, $cart_language);
			}

			fn_set_progress('echo', '<br />' . fn_get_lang_var('es_import_product_tabs'));
			Bm_ProductTabs::instance($company_id)->create_default_tabs();
			$this->importProductTabs($productTabs, $company_id);


			$this->importObject('images', $company_id);
			fn_set_progress('echo', fn_get_lang_var('es_import_images'));

			$this->_patchProfileFields($company_id);
			$this->_normalizeProductViews();
		}

		return true;
	}

	protected function _getImportScheme()
	{
		$scheme = fn_get_schema('import', 'stores_22x_com');

		return $scheme;
	}

	public function processUsergroups($object, $company_id, $store_data)
	{
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
					}
				}
			}


		}
	}
}

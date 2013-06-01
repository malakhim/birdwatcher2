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
 * Returns addon's setting variants (similar to fn_get_settings_variants)
 * 
 * @deprecated deprecated since version 3.0
 * @param string $addon Addon name to get option for
 * @param string $option_name Option name
 * @param string $lang_code 2-letter language code (e.g. 'EN', 'RU', etc.)
 * @return array Variants list
 */
function fn_get_addon_option_variants($addon, $option_name, $lang_code = CART_LANGUAGE)
{
	fn_generate_deprecated_function_notice('fn_get_addon_option_variants', 'Settings::instance->get_variants()');
	return CSettings::instance()->get_variants($addon, $option_name, '', null, $lang_code);
}

/**
 * Updates addon setting
 * 
 * @deprecated deprecated since version 3.0
 * @param string $option Option name
 * @param string $value New option value
 * @param string $addon Addon name to update option for
 * @return bool Always true
 */
function fn_update_addon_option($option, $value, $addon)
{
	fn_generate_deprecated_function_notice('fn_update_addon_option', 'Settings::instance->update_value()');
	CSettings::instance()->update_value($option, $value, $addon);
	return true;
}

/**
 * Updates addon settings
 *
 * @param string $settings Array of add-on's settings to be updated
 * @return bool Always true
 */
function fn_update_addon($settings)
{
	if (is_array($settings)) {
		foreach ($settings['options'] as $setting_id => $value) {
			CSettings::instance()->update_value_by_id($setting_id, $value);

			if (!empty($_REQUEST['update_all_vendors'][$setting_id])) {
				CSettings::instance()->reset_all_vendors_settings($setting_id);
			}
		}
	}
	return true;
}

/**
 * Uninstalles addon
 * 
 * @param string $addon_name Addon name to be uninstalled
 * @param bool $show_message If defined as true, additionally show notification
 * @return bool True if addons uninstalled successfully, false otherwise
 */
function fn_uninstall_addon($addon_name, $show_message = true)
{
	$addon_scheme = Addons_SchemesManager::get_scheme($addon_name);

	if ($addon_scheme != false) {
		// Check dependencies
		$dependencies = Addons_SchemesManager::get_uninstall_dependencies($addon_name);
		if (!empty($dependencies)) {
			$msg = fn_get_lang_var('text_addon_uninstall_dependencies');
			fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[addons]', implode(',', $dependencies), $msg));
			return false;
		}

		// Execute custom functions for uninstall
		$addon_scheme->call_custom_functions('uninstall');

		$addon_description = db_get_field(
			"SELECT name FROM ?:addon_descriptions WHERE addon = ?s and lang_code = ?s", 
			$addon_name, CART_LANGUAGE
		);

		// Delete options
		db_query("DELETE FROM ?:addons WHERE addon = ?s", $addon_name);
		db_query("DELETE FROM ?:addon_descriptions WHERE addon = ?s", $addon_name);

		// Delete settings
		$section = CSettings::instance()->get_section_by_name($addon_name, CSettings::ADDON_SECTION);
		if (isset($section['section_id'])){
			CSettings::instance()->remove_section($section['section_id']);
		}

		// Delete language variables
		$addon_scheme->uninstall_language_values();

		// Revert database structure
		$addon_scheme->process_queries('uninstall', DIR_ADDONS . $addon_name);

		// Remove product tabs
		Bm_ProductTabs::instance()->delete_addon_tabs($addon_name);

		fn_uninstall_addon_templates(fn_basename($addon_name));

		if (file_exists(DIR_ADDONS . $addon_name . '/layouts.xml')) {
			$xml = simplexml_load_file(DIR_ADDONS . $addon_name . '/layouts.xml', 'ExSimpleXmlElement', LIBXML_NOCDATA);
			foreach ($xml->location as $location) {

					Bm_Location::instance()->remove_by_dispatch((string) $location['dispatch']);

			}
		}

		if ($show_message) {
			$msg = fn_get_lang_var('text_addon_uninstalled');
			fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[addon]', $addon_scheme->get_name(), $msg));
		}

		// Clean cache
		fn_clear_cache();

		return true;
	} else {
		return false;
	}
}

/**
 * Disables addon
 * 
 * @param string $addon_name Addons name to be disabled
 * @param string $caller_addon_name TODO: NOT USED. Must be refactored.
 * @param bool $show_notification
 * @return bool Always true
 */
function fn_disable_addon($addon_name, $caller_addon_name, $show_notification = true)
{
	$func = 'fn_settings_actions_addons_' . $addon_name;
	if (function_exists($func)) {
		$new_status = 'D';
		$old_status = 'A';
		$func($new_status, $old_status);
	}
	db_query("UPDATE ?:addons SET status = ?s WHERE addon = ?s", 'D', $addon_name);

	if ($show_notification == true) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
	}

	return true;
}

/**
 * Installes addon
 *
 * @param string $addon Addon to install
 * @param bool $show_notification Display notification if set to true
 * @param bool $install_demo If defined as true, addon's demo data will be installed
 * @return bool True if addons installed successfully, false otherwise
 */
function fn_install_addon($addon, $show_notification = true, $install_demo = false)
{
	$status = db_get_field("SELECT status FROM ?:addons WHERE addon = ?s", $addon);
	// Return true if addon is instaleld
	if (!empty($status)) {
		return true;
	}

	$addon_scheme = Addons_SchemesManager::get_scheme($addon);

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

		$dependencies = Addons_SchemesManager::get_install_dependencies($_data['addon']);
		if (!empty($dependencies)) {
			$msg = fn_get_lang_var('text_addon_install_dependencies');
			$msg = str_replace('[addon]', implode(',', $dependencies), $msg);
			fn_set_notification('W', fn_get_lang_var('warning'), $msg);
			return false;
		}

		if ($addon_scheme->call_custom_functions('before_install') == false) {
			fn_uninstall_addon($addon, false);
			return false;
		}

		// Add optional language variables
		$addon_scheme->install_language_values();

		// Add add-on to registry
		Registry::set('addons.' . $addon, array(
			'status' => 'D',
			'priority' => $_data['priority'],
		));

		// Execute optional queries
		if ($addon_scheme->process_queries('install', DIR_ADDONS . $addon) == false) {
			fn_uninstall_addon($addon, false);
			return false;
		}

		if (fn_update_addon_settings($addon_scheme) == false) {
			fn_uninstall_addon($addon, false);
			return false;
		}

		db_query("REPLACE INTO ?:addons ?e", $_data);

		foreach ($addon_scheme->get_addon_translations() as $translation) {
			db_query("REPLACE INTO ?:addon_descriptions ?e", array(
				'lang_code' => $translation['lang_code'],
				'addon' =>  $addon_scheme->get_id(),
				'name' => $translation['value'],
				'description' => $translation['description']
			));
		}

		// Install templates
		fn_install_addon_templates($addon_scheme->get_id());


			Bm_ProductTabs::instance()->create_addon_tabs($addon_scheme->get_id(), $addon_scheme->get_tab_order());


		// Put this addon settings to the registry
		$settings = CSettings::instance()->get_values($addon_scheme->get_id(), CSettings::ADDON_SECTION, false);
		if (!empty($settings)) {
			Registry::set('settings.' . $addon, $settings);	
			$addon_data = Registry::get('addons.' . $addon);	
			Registry::set('addons.' . $addon, fn_array_merge($addon_data, $settings));	
		}

		// Execute custom functions
		if ($addon_scheme->call_custom_functions('install') == false) {
			fn_uninstall_addon($addon, false);
			return false;
		}

		if ($show_notification == true) {
			$msg = fn_get_lang_var('text_addon_installed');
			fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[addon]', $addon_scheme->get_name(), $msg));
		}

		// If we need to activate addon after install, call "update status" procedure
		if ($addon_scheme->get_status() == 'A') {
			fn_update_addon_status($addon, 'A', false, true);
		}

		if (file_exists(DIR_ADDONS . $addon . '/layouts.xml')) {

				Bm_Exim::instance()->import_from_file(DIR_ADDONS . $addon . '/layouts.xml');

		}

		// Clean cache
		fn_clear_cache();



		if ($install_demo) {
			$addon_scheme->process_queries('demo', DIR_ADDONS . $addon);
		}

		return true;
	} else {
		// Addon was not installed because scheme is not exists.
		return false;
	}
}

/**
 * Installs addon demo data
 *
 * @param $addon_name Addon name to install demo data for
 * @return bool True in success, false otherwise
 */
function fn_install_demo_data($addon_name)
{
	if (file_exists(DIR_ADDONS . $addon_name . '/demo.sql')) {
		Registry::set('runtime.database.skip_errors', true);

		db_import_sql_file(DIR_ADDONS . $addon_name . '/demo.sql', 16384, false);

		Registry::set('runtime.database.skip_errors', false);

		$errors = Registry::get('runtime.database.errors');
		if (!empty($errors)) {
			$error_text = '';
			foreach($errors as $error) {
				$error_text .= '<br/>' . $error['message'] . ': <code>'. $error['query'] . '</code>';
			}
			$error_text = $error_text . '<br/>' . DIR_ADDONS . $addon_name . '/demo.sql';
			fn_set_notification('E', fn_get_lang_var('addon_sql_error'), $error_text);
			return false;
		}

		return true;
	}
}

/**
 * Copies addon templates from SKINS_REPOSITORY to SKINS
 *
 * @param string $addon_name Addons name to copy templates for
 * @return bool Always true
 */
function fn_install_addon_templates($addon_name)
{
	$areas = array('customer', 'admin', 'mail');
	if (PRODUCT_TYPE == 'ULTIMATE') {
		foreach(fn_get_all_companies_ids() as $company) {
			$installed_skins = fn_get_dir_contents(DIR_ROOT . '/' . DIR_STORES . $company . '/skins');
			foreach ($installed_skins as $skin_name) {
				foreach ($areas as $area) {
					if (is_dir(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name)) {
						fn_copy(DIR_SKINS_REPOSITORY . 'basic/' . $area . '/addons/' . $addon_name, DIR_ROOT . '/' . DIR_STORES . $company . '/skins/' . $skin_name . '/' . $area . '/addons/' . $addon_name);
					}
				}

				if (is_dir(DIR_SKINS_REPOSITORY . 'basic/admin/addons/' . $addon_name)) {
					fn_copy(DIR_SKINS_REPOSITORY . 'basic/admin/addons/' . $addon_name, DIR_SKINS . $skin_name . '/admin/addons/' . $addon_name);
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

/**
 * Removes addon's templates from skin folder
 * 
 * @param string $addon Addon name to remove templates for
 * @return bool Always true
 */
function fn_uninstall_addon_templates($addon)
{
	$areas = array('customer', 'admin', 'mail');
	if (PRODUCT_TYPE == 'ULTIMATE') {
		foreach(fn_get_all_companies_ids() as $company) {
			$installed_skins = fn_get_dir_contents(DIR_ROOT . '/' . DIR_STORES . $company . '/skins');
			foreach ($installed_skins as $skin_name) {
				foreach ($areas as $area) {
					if (is_dir(DIR_ROOT . '/' . DIR_STORES . $company . '/skins/' . $skin_name . '/' . $area . '/addons/' . $addon)) {
						if (!defined('DEVELOPMENT')) {
							fn_rm(DIR_ROOT . '/' . DIR_STORES . $company . '/skins/' . $skin_name . '/' . $area . '/addons/' . $addon);
						}
					}
				}
			}
		}
	} 

	$installed_skins = fn_get_dir_contents(DIR_SKINS);
	foreach ($installed_skins as $skin_name) {
		foreach ($areas as $area) {
			if (is_dir(DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon)) {
				if (!defined('DEVELOPMENT')) {
					fn_rm(DIR_SKINS . $skin_name . '/' . $area . '/addons/' . $addon);
				}
			}
		}
	}

	return true;
}

/**
 * Updates addon settings in database
 * 
 * @param Addons_XmlScheme1|Addons_XmlScheme2 $addon_scheme Data from addon.xml file
 * @return bool True in success, false otherwise
 */
function fn_update_addon_settings($addon_scheme)
{
	$tabs = $addon_scheme->get_sections();

	// If isset section settings in xml data and that addon settings is not exists
	if (!empty($tabs)) {
		Registry::set('runtime.database.skip_errors', true);

		// Create root settings section
		$addon_section_id = CSettings::instance()->update_section(array(
			'parent_id'    => 0,
			'edition_type' => $addon_scheme->get_edition_type(),
			'name'         => $addon_scheme->get_id(),
	 		'type'         => CSettings::ADDON_SECTION,
		));

		foreach($tabs as $tab_index => $tab) {
			// Add addon tab as setting section tab
			$section_tab_id = CSettings::instance()->update_section(array(
				'parent_id'    => $addon_section_id,
				'edition_type' => $tab['edition_type'],
				'name'         => $tab['id'],
				'position'     => $tab_index * 10,
	 			'type'         => isset($tab['separate']) ? CSettings::SEPARATE_TAB_SECTION : CSettings::TAB_SECTION,
			));

			// Import translations for tab
			if (!empty($section_tab_id)) {
				fn_update_addon_settings_descriptions($section_tab_id, CSettings::SECTION_DESCRIPTION, $tab['translations']);
				$settings = $addon_scheme->get_settings($tab['id']);

				foreach ($settings as $k => $setting) {
					if (!empty($setting['id'])) {
						$setting_id = CSettings::instance()->update(array(
							'name' =>           $setting['id'],
		  	  				'section_id' =>     $addon_section_id,
		  	  				'section_tab_id' => $section_tab_id,
		  	  				'type' =>           $setting['type'],
							'position' =>       isset($setting['position']) ? $setting['position'] : $k * 10,
							'edition_type' =>   $setting['edition_type'],
							'is_global' =>      'N',
							'handler' =>        $setting['handler']
						));

						if (!empty($setting_id)) {
							CSettings::instance()->update_value_by_id($setting_id, $setting['default_value']);

							fn_update_addon_settings_descriptions($setting_id, CSettings::SETTING_DESCRIPTION, $setting['translations']);

							if (isset($setting['variants'])) {
								foreach ($setting['variants'] as $k => $variant) {
									$variant_id = CSettings::instance()->update_variant(array(
										'object_id'  => $setting_id,
										'name'       => $variant['id'],
			 							'position'   => isset($variant['position']) ? $variant['position'] : $k * 10,
									));
									
									if (!empty($variant_id)) {
										fn_update_addon_settings_descriptions($variant_id, CSettings::VARIANT_DESCRIPTION, $variant['translations']);
									}
								}
							}
						}
					}
				}
			}
		}
		Registry::set('runtime.database.skip_errors', false);

		$errors = Registry::get('runtime.database.errors');
		if (!empty($errors)) {
			$error_text = '';
			foreach($errors as $error) {
				$error_text .= '<br/>' . $error['message'] . ': <code>'. $error['query'] . '</code>';
			}
			fn_set_notification('E', fn_get_lang_var('addon_sql_error'), $error_text);
			return false;
		}
	}

	return true;
}

/**
 * Updates addon settings descriptions
 * @param array $translations List of descriptions @see CSettings::update_description()
 * @return bool Always true
 */
function fn_update_addon_settings_descriptions($object_id, $object_type, $translations)
{
	if (!empty($translations)) {
		foreach($translations as $translation) {
			$translation['object_type'] = $object_type;
			$translation['object_id'] = $object_id;
			CSettings::instance()->update_description($translation);
		}
	}

	return true;
}

/**
 * Updates addon status
 * @param string $addon Addon to update status for
 * @param string $status Status to change to
 * @param bool $show_notification Display notification if set to true
 * @param bool $on_install If status was changed on after ionstall process
 * @return bool|string True on success, old status ID if status was not changed
 */
function fn_update_addon_status($addon, $status, $show_notification = true, $on_install = false)
{
	$old_status = db_get_field("SELECT status FROM ?:addons WHERE addon = ?s", $addon);
	$new_status = $status;

	if ($old_status != $new_status) {

		// Check if addon can be enabled
		$conflicts = db_get_fields("SELECT addon FROM ?:addons WHERE status = 'A' AND FIND_IN_SET(?s, conflicts)", $addon);
		if ($new_status == 'A' && !empty($conflicts)) {
			$scheme = Addons_SchemesManager::get_scheme($addon);
			$msg = fn_get_lang_var('text_addon_cannot_enable');
			$msg = str_replace('[addons]', implode(', ', Addons_SchemesManager::get_names($conflicts)), $msg);
			$msg = str_replace('[addon_name]', $scheme->get_name(), $msg);
			fn_set_notification('W', fn_get_lang_var('warning'), $msg);

			return $old_status;
		}

		fn_get_schema('settings', 'actions', 'php', false, true, true);

		$func = 'fn_settings_actions_addons_' . $addon;

		if (function_exists($func)) {
			$func($new_status, $old_status, $on_install);
		}

		// If status change is allowed, update it
		if ($old_status != $new_status) {
			if ($new_status == 'A') {
				// Check that addon have conflicts
				$scheme = Addons_SchemesManager::get_scheme($addon);

				$conflicts = db_get_field("SELECT conflicts FROM ?:addons WHERE addon = ?s", $addon);

				if (!empty($conflicts)) {
					$conflicts = explode(',', $conflicts);

					$msg = fn_get_lang_var('text_addon_confclicts_on_install');

					if (!$on_install) {
						foreach ($conflicts as $conflict) {
							fn_disable_addon($conflict, $scheme->get_name(), $show_notification);
						}

						$msg = fn_get_lang_var('text_addon_confclicts');
					}

					$msg = str_replace('[addons]', implode(', ', Addons_SchemesManager::get_names($conflicts)), $msg);
					$msg = str_replace('[addon_name]', $scheme->get_name(), $msg);
					fn_set_notification('W', fn_get_lang_var('warning'), $msg);

					// On install we cannot enable addon with conflicts automaticly
					if ($on_install) {
						return $old_status;
					}
				}
			}

			db_query("UPDATE ?:addons SET status = ?s WHERE addon = ?s", $status, $addon);

			$func = 'fn_settings_actions_addons_post_' . $addon;

			if (function_exists($func)) {
				$func($status);
			}

			if ($show_notification == true) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
			}

			// Enable/disable tabs for addon
			Bm_ProductTabs::instance()->update_addon_tab_status($addon, $new_status);
		} else {
			return $old_status;
		}
	}

	// Clean cache
	fn_clear_cache();

	return true;
}

/**
 * Returns addon's version
 * @param string $addon Addon name to return version for
 * @return string Addon's version
 */
function fn_get_addon_version($addon)
{
	return db_get_field("SELECT version FROM ?:addons where addon=?s", $addon);
}
?>

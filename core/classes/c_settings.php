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

if (!defined('AREA') ) { die('Access denied');}

/**
 *
 * Settings manager
 *
 */
class CSettings
{
    /**
     * Instance of class
     * @static
     * @var Settings
     */
	private static $_instance;

	/**
	 *
	 * Section data array
	 * @var array
	 */
	private $sections;

	/**
	 * Name of new edition (used in editions upgrades)
	 * @var string
	 */
	private $new_edition;

	/**
     * Loads sections data and settings schema from DB
     */
	private function __construct()
	{
		$this->reload_sections();
	}

 	/**
 	 * Reloads some sections datainto internal storage
 	 *
 	 * @return Always true
 	 */
 	public function reload_sections()
 	{
 		$this->sections = $this->_get_sections('', 0, true, false);

 		return true;
 	}

	/**
	 * Returns static object of Settings class or create it if it is not exists.
	 *
	 * @static
	 * @return CSettings Instance of class
	 */
	public static function instance()
	{
		if (empty(self::$_instance)) {
			self::$_instance = new CSettings();
		}

		return self::$_instance;
	}

	/**
	 * Constants defines sections
	 *
	 * @var string
	 */
	const CORE_SECTION  = 'CORE';
	const ADDON_SECTION = 'ADDON';
	const TAB_SECTION   = 'TAB';
	const SEPARATE_TAB_SECTION = 'SEPARATE_TAB';

	/**
	 * Prefixes defines
	 *
	 * @var string
	 */
	const NONE   = 'NONE';
	const ROOT   = 'ROOT';
	const VENDOR = 'VENDOR';
	const VENDORONLY = 'VENDORONLY';

	/**
	 * Object types for settings descriptions
	 *
	 * @var string
	 */
	const VARIANT_DESCRIPTION = 'V';
	const SETTING_DESCRIPTION = 'O';
	const SECTION_DESCRIPTION = 'S';

	/**
	 * Sets new edition for correct reinstalling addons settings after edition upgrade.
	 *
	 * @param string $edition Full edition name (new value of const PRODUCT_TYPE)
	 */
	public function set_new_edition($edition)
	{
		$this->new_edition = $edition;
	}

	/**
	 * Returns current edtition acronym
	 *
	 * @return string Edtition acronym
	 */
	private function get_current_edition()
	{
		$editions = $this->get_edition_names();
		$current_edition = empty($this->new_edition) ? PRODUCT_TYPE : $this->new_edition;
		return $editions[$current_edition];
	}

	/**
	 * Prefixes defines edition type
	 *
	 * @return array
	 */
	private function get_edition_names()
	{
		return array(
			'COMMUNITY'    => 'COM:',
			'PROFESSIONAL' => 'PRO:',
			'MULTIVENDOR'  => 'MVE:',
			'ULTIMATE'    => 'ULT:',
		);
	}

	/**
	 * Returns true if array $sections have item with key $section_name
	 *
	 * @param array $sections List of sections
	 * @param string $section_name Section name to find in sections list
	 * @return bool True if section exists, false otherwise
	 */
	public function section_exists($sections, $section_name)
	{
		foreach ($sections as $section) {
			if ($section['name'] == $section_name) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Gets all core setting sections
	 *
	 * @return array List of setting sections
	 */
	public function get_core_sections()
	{
		$_sections = $this->_get_sections(CSettings::CORE_SECTION, 0, true, true, CART_LANGUAGE);
		$sections = Array();

		foreach ($_sections as &$section) {
			$sections[$section['name']] = $section;
			if (isset($section['name'])) {
				$sections[$section['name']]['section_id'] = $section['name'];
			}
			$sections[$section['name']]['object_type'] = 'S';
			if (isset($section['description'])) {
				$sections[$section['name']]['title'] =  $section['description'];
			}
			unset ($sections[$section['name']]['name']);
		}

		ksort($sections);

		return $sections;
	}

	/**
	 * Gets all addon setting sections
	 *
	 * @return array List of setting sections
	 */
	public function get_addons()
	{
		return $this->_get_sections(CSettings :: ADDON_SECTION);
	}

	/**
	 * Gets setting section tabs
	 *
	 * @param int $parent_section_id Parent section identifier
	 * @param string $lang_code 2 letters language code
	 * @return array List of tab sections
	 */
	public function get_section_tabs($parent_section_id, $lang_code = CART_LANGUAGE)
	{
		fn_get_schema('settings', 'actions', 'php', false, true, true);

		$_tabs = $this->_get_sections(array(CSettings::TAB_SECTION, CSettings::SEPARATE_TAB_SECTION), $parent_section_id, false, true, $lang_code);
		$tabs = Array();

		foreach ($_tabs as $tab) {
			if (isset($this->sections[$parent_section_id]['name'])) {
				$func_name = 'fn_is_tab_' . fn_strtolower($this->sections[$parent_section_id]['name']) . '_' . $tab['name'] . '_available';

				if (function_exists($func_name) && $func_name() === false) {
					continue;
				}
			}

			$tabs[$tab['name']] = $tab;
			$tabs[$tab['name']]['parent_id'] = $parent_section_id;
		}

		return $tabs;
	}

	/**
	 * Gets section data by name and type
	 *
	 * @param string $name Section name
	 * @param string $type Type of section. Use Settings class constant to set this value
	 * @param bool $use_access_level Use or ignore edition and type access conditions (ROOT, VENDOR, etc...)
	 * @return array Section data
	 */
	public function get_section_by_name($name, $type = CSettings::CORE_SECTION, $use_access_level = true)
	{
		return db_get_row(
			"SELECT * FROM ?:settings_sections "
			. "WHERE name = ?s AND type = ?s ?p",
			$name, $type, $this->generate_edition_condition('?:settings_sections', $use_access_level)
		);
	}

	/**
	 * Gets translated section name by id
	 *
	 * @param int $section_id Section identifier
	 * @param string $lang_code 2 letters language code
	 * @return string Section name
	 */
	public function get_section_name($section_id, $lang_code = CART_LANGUAGE)
	{
		return db_get_field(
			"SELECT ?:settings_descriptions.value FROM ?:settings_sections "
			. "LEFT JOIN ?:settings_descriptions "
				."ON ?:settings_descriptions.object_id = ?:settings_sections.section_id AND object_type = ?s "
			. "WHERE section_id = ?i AND ?:settings_descriptions.lang_code = ?s",
			CSettings::SECTION_DESCRIPTION, $section_id, $lang_code
		);
	}

	/**
	 * Gets internal section name by section id
	 *
	 * @param string $section_id Section identifier
	 * @return string Section name
	 */
	public function get_section_text_id($section_id)
	{
		return $this->sections[$section_id]['name'];
	}

	/**
	 * Returns sections
	 *
	 * @param mixed $section_type Section type (one or several sections can be passed as string or array). Use constants of Settings class to set this value.
	 * @param int $parent_id Id of parent section
	 * @param bool $generate_href Generate href to core section // FIXME: Bad style
	 * @param bool $use_access_level Use or ignore edition and type access conditions (ROOT, MSE:VENDOR, etc...)
	 * @param string $lang_code 2 letters language code
	 * @return array List of sections
	 */
	private function _get_sections($section_type = '', $parent_id = 0, $generate_href = true, $use_access_level = true, $lang_code = '')
	{
		$condition = $this->generate_edition_condition('?:settings_sections', $use_access_level);
		$values = '';
		$join = '';

		if ($parent_id != 0) {
			$condition .= db_quote(" AND ?:settings_sections.parent_id = ?i", $parent_id);
		}
		if (!empty($section_type)) {
			$section_type = is_array($section_type) ? $section_type : array($section_type);
			$condition .= db_quote(" AND ?:settings_sections.type IN (?a)", $section_type);
		}

		if (!empty($lang_code)) {
			$join =  db_quote(
				" LEFT JOIN ?:settings_descriptions "
					. "ON ?:settings_descriptions.object_id = ?:settings_sections.section_id "
						. "AND object_type = ?s AND ?:settings_descriptions.lang_code = ?s",
				CSettings::SECTION_DESCRIPTION, $lang_code
			);
			$values .= ', ?:settings_descriptions.value as description, object_id, object_type';
		} else {
			$values .= ', ?:settings_sections.name as description';
		}

		//TODO: Fix generating link for core sections
		if ($generate_href) {
			$values .= ', CONCAT(\'settings.manage?section_id=\', ?:settings_sections.name) as href ';
		}

		$sections = db_get_hash_array(
			'SELECT ?:settings_sections.name, ?:settings_sections.section_id, '
			. '?:settings_sections.position, ?:settings_sections.type ?p '
			. 'FROM ?:settings_sections ?p'
			. "WHERE 1 ?p ORDER BY ?:settings_sections.position",
			'section_id',
			$values,
			$join,
			$condition
		);

		return $sections;
	}

	/**
	 * Updates settings section
	 *
	 * Section data must be array in this format (example):
	 * Array (
	 * 		'section_id'   => 1,
	 * 		'parent_id'    => 3,
	 * 		'edition_type' => 'ROOT,VENDOR',
	 * 		'name'         => 'Appearance',
	 * 		'position'     => 10,
	 * 		'type'         => 'CORE',
	 * );
	 *
	 * If some parameter will be skipped and function not update it field.
	 * If section_id skipped function adds new variant and retuns id of new record.
	 *
	 * @param string $section_data Aray of section data
	 * @return bool|int Section identifier if section was created, true un success update, false otherwise
	 */
	public function update_section($section_data)
	{
		if (!$this->check_edition($section_data)) {
			return false;
		}

		$section_id = db_replace_into ('settings_sections', $section_data);
		$this->sections = $this->_get_sections();

		return $section_id;
	}

	/**
	 * Removes setting section.
	 *
	 * @param int $section_id Section identifier
	 * @return bool true or false if $name or $lang_code or value is empty
	 */
	public function remove_section($section_id)
	{
		if (!empty($section_id)) {
			$sections = db_get_fields("SELECT section_id FROM ?:settings_sections WHERE section_id = ?i OR parent_id = ?i", $section_id, $section_id);
			db_query("DELETE FROM ?:settings_sections WHERE section_id IN (?n)", $sections);
			db_query("DELETE FROM ?:settings_descriptions WHERE object_id IN (?n) AND object_type = ?s", $sections, CSettings::SECTION_DESCRIPTION);

			$setting_ids = db_get_fields("SELECT object_id FROM ?:settings_objects WHERE section_id IN (?n)", $sections);
			db_query("DELETE FROM ?:settings_descriptions WHERE object_id IN (?n) AND object_type = ?s", $setting_ids, CSettings::SETTING_DESCRIPTION);

			$variants_ids =  db_get_fields("SELECT object_id FROM ?:settings_variants WHERE object_id IN (?n)",$setting_ids);
			db_query("DELETE FROM ?:settings_variants WHERE object_id IN (?n)", $setting_ids);
			db_query("DELETE FROM ?:settings_descriptions WHERE object_id IN (?n) AND object_type = ?s", $variants_ids, CSettings::VARIANT_DESCRIPTION);

			if (PRODUCT_TYPE == 'ULTIMATE') {
				db_query("DELETE FROM ?:settings_vendor_values WHERE object_id IN (?n)", $setting_ids);
			}

			db_query("DELETE FROM ?:settings_objects WHERE object_id IN (?n)", $setting_ids);

			$this->sections = $this->_get_sections();
		} else {
			$this->generate_error(fn_get_lang_var('unable_to_delete_setting_description'), fn_get_lang_var('empty_key_value'));
			return false;
		}
		return true;
	}

	/**
	 * Gets list of settings including all information
	 *
	 * @param int $section_id Section identifier
	 * @param int $section_tab_id Section tab identifier
	 * @param int $company_id Company identifier
	 * @param string $lang_code 2 letters language code
	 * @return array List of settings
	 */
	public function get_list($section_id = 0, $section_tab_id = 0, $company_id = null, $lang_code = CART_LANGUAGE)
	{
		$settings = Array();

		$edition_condition = $this->generate_edition_condition('?:settings_objects', true);

		$_settings = $this->_get_list(
			array(
				'?:settings_objects.object_id as object_id',
				'?:settings_objects.name as name',
				'section_id',
				'section_tab_id',
				'type',
				'edition_type',
				'position',
				'is_global',
				'handler'
			),
			$section_id, $section_tab_id, false, $edition_condition, false, $company_id, $lang_code
		);

		$_sections = $this->sections;

		foreach ($_settings as $setting) {

			// Execute custom function for generate info from handler if it exists
			if (!empty($setting['handler'])) {
				$args = explode(',', $setting['handler']);
				$func = array_shift($args);
				if (function_exists($func)) {
					$setting['info'] = call_user_func_array($func, $args);
				} else {
					$setting['info'] = "Something goes wrong";
				}
			}

			$setting['section_name'] = ($setting['section_id'] == 0 && !isset($_sections[$setting['section_id']])) ? 'General' : $_sections[$setting['section_id']]['name'];
			$setting['section_tab_name'] = ($setting['section_tab_id'] == 0 && !isset($_sections[$setting['section_tab_id']])) ? 'main' : $_sections[$setting['section_tab_id']]['name'];

			// Check if this options may be updated for all vendors
			$edition_type = explode(',', $setting['edition_type']);
			if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID') && (in_array('ULT:VENDOR', $edition_type) || in_array('VENDOR', $edition_type))) {
				$setting['update_for_all'] = true;
			}

			$setting['variants'] = CSettings::instance()->get_variants($setting['section_name'], $setting['name'], $setting['section_tab_name'], $setting['object_id'], $lang_code);

			$force_parse = $setting['type'] == 'N' ? true : false;
			$setting['value'] = $this->unserialize($setting['value'], $force_parse);

			if (($section_tab_id != 0) && ($section_id != 0)) {
				$settings[$setting['object_id']] = $setting;
			} elseif (($section_id != 0)) {
				$settings[$setting['section_tab_name']][$setting['object_id']] = $setting;
			} else {
				$settings[$setting['section_name']][$setting['section_tab_name']][$setting['object_id']] = $setting;
			}
		}
		return $settings;
	}

	/**
	 * Gets settings values from db applying all permission and edition filters
	 *
	 * @param string $section_name Section name
	 * @param string $section_type Section type. Use CSettings class constants
	 * @param bool $hierarchy If it's false settings will be returned as plain list
	 * @param int $company_id Company identifier
	 * @return array|bool List of settings values on success, false otherwise
	 */
	public function get_values($section_name = '', $section_type = CSettings::CORE_SECTION, $hierarchy = true, $company_id = null)
	{
		$settings = array();

		$section_id = '';
		$section_tab_id = '';

		if ($section_name) {
			$section = $this->get_section_by_name($section_name, $section_type, false);

			if (!isset($section['section_id'])) {
				return false;
			}

			if ($section['parent_id'] != 0) {
				$section_id = $section['parent_id'];
				$section_tab_id = $section['section_id'];
			} else {
				$section_id = $section['section_id'];
			}
		}
		$_result = $this->_get_list(
			array(
				'?:settings_objects.object_id as object_id',
				'name',
				'section_id',
				'section_tab_id',
				'type',
				'position',
				'is_global'
			), $section_id, $section_tab_id, true, false, false, $company_id
		);

		$_sections = $this->sections;

		if ($_result) {
			foreach ($_result as $_row) {
				$section_name = ($_row['section_id'] != 0 && isset($_sections[$_row['section_id']])) ? $_sections[$_row['section_id']]['name'] : '';
				$section_tab_name = ($_row['section_tab_id'] != 0 && isset($_sections[$_row['section_tab_id']])) ? $_sections[$_row['section_tab_id']]['name'] : '';

				$force_parse = $_row['type'] == 'N' ? true : false;
				if (!empty($_row['section_tab_id']) && $hierarchy) {
					$settings[$section_name][$section_tab_name][$_row['name']] = $this->unserialize($_row['value'], $force_parse);
				} elseif (!empty($_row['section_id']) && $hierarchy) {
					$settings[$section_name][$_row['name']] = $this->unserialize($_row['value'], $force_parse);
				} else {
					$settings[$_row['name']] = $this->unserialize($_row['value'], $force_parse);
				}
			}

			if (empty($section_id) || !$hierarchy) {
				return $settings;
			} elseif (!empty($section_id) && empty($section_tab_id)) {
				return $settings[$section_name];
			} elseif (!empty($section_tab_id)) {
				return $settings[$section_id][$section_tab_id];
			}
		}

		return $settings;
	}

	/**
	 * Gets setting value from database
	 *
	 * @param string $setting_name Setting name
	 * @param string $section_name Section name
	 * @param int $company_id Company identifier
	 *
	 * @return mixed|bool Setting value on success, false otherwise
	 */
	public function get_value($setting_name, $section_name, $company_id = null)
	{
		if (!empty($setting_name)) {
			$id = $this->get_id ($setting_name, $section_name);
			$condition = db_quote(' AND ?:settings_objects.object_id = ?i', $id);
			$_setting = $this->_get_list(
				array('?:settings_objects.object_id as object_id', '?:settings_objects.type as object_type'),
				'', '', false, $condition, false, $company_id
			);

			if (isset($_setting[0]['value'])) {
				$force_parse = $_setting[0]['object_type'] == 'N' ? true : false;
				$value = $this->unserialize($_setting[0]['value'], $force_parse);
			} else {
				return false;
			}

			return $value;
		} else {
			return false;
		}
	}

	/**
	 * Gets setting data for setting id
	 *
	 * @param int $object_id Setting object identifier
	 * @return array|bool Setting data on success, false otherwise
	 */
	private function get_data($object_id, $company_id = null)
	{
		if (!empty($object_id)) {
			$condition = db_quote(' AND ?:settings_objects.object_id = ?i', $object_id);
			$_setting = $this->_get_list(
				array(
					'?:settings_objects.object_id as object_id',
					'section_id',
					'section_tab_id',
					'name'
				),
				'', '', false, $condition, false, $company_id
			);

			if (!isset($_setting[0])) {
				return false;
			}
			$_setting = $_setting[0];
			$_setting['section_id'] = ($_setting['section_id'] == 0) ? 'General' : $this->sections[$_setting['section_id']]['name'];
			$_setting['section_tab_id'] = ($_setting['section_tab_id'] == 0) ? 'main' : $this->sections[$_setting['section_tab_id']]['name'];
			return $_setting;
		} else {
			return false;
		}
	}

	/**
	 * Gets setting id for section name and setting name
	 *
	 * @param string $section_name Setting name
	 * @param string $setting_name Section name
	 * @return int|bool Setting ID or false if $section_name or $setting_name are empty
	 */
	public function get_id($setting_name, $section_name = '')
	{
		if (!empty($setting_name)) {
			if (!empty($section_name)) {
				$section_condition = db_quote(" AND ?:settings_sections.name = ?s", $section_name);
			} else {
				$section_condition = '';
			}

			return db_get_field(
				"SELECT object_id FROM ?:settings_objects "
				. "LEFT JOIN ?:settings_sections ON ?:settings_objects.section_id = ?:settings_sections.section_id "
				. "WHERE ?:settings_objects.name = ?s ?p",
				$setting_name,
				$section_condition
			);
		} else {
			return false;
		}
	}

	/**
	 * Updates all setting paramentrs include descriptions and variants.
	 *
	 * @param array $setting_data List of setting data @see CSettings::_update
	 * @param array $variants List of variants data to update with seting @see CSettings::update_variant
	 * @param array $descriptions List of descriptions data to update with seting @see CSettings::update_description description type will be setted automaticly
	 * @param bool $force_cache_cleanup Force registry cleanup after setting was updated
	 * @return int Setting identifier if it was created, true un success update, false otherwise
	 */
	public function update($setting_data, $variants = null, $descriptions = null, $force_cache_cleanup = false)
	{
		$id = $this->_update($setting_data);

		if (!empty($id)) {
			if (is_array($variants)) {
				foreach ($variants as $variant_data) {
					$variant_data['object_id'] = $id;
					$this->update_variant($variant_data);
				}
			}

			if (is_array($descriptions)) {
				foreach ($descriptions as $description_data) {
					$description_data['object_type'] = 'S';
					$description_data['object_id'] = $id;

					$this->update_description($description_data);
				}
			}
		}

		if ($force_cache_cleanup) {
			Registry::cleanup();
		}

		return $id;
	}

	/**
	 * Updates setting
	 * Settings data must be array in this format (example):
	 *
	 * Array (
	 * 		'object_id' =>      2,
	 *		'name' =>           'use_shipments',
	 * 		'section_id' =>     2,
	 * 		'section_tab_id' => 0,
	 * 		'type' =>           'C',
	 * 		'position' =>       55,
	 * 		'is_global' =>      'Y'
	 * )
	 *
	 * If some parameter will be skipped and function not update it field.
	 * If object_id skipped function adds new setting and retuns id of new record.
	 *
	 * For update setting value please use specific functions
	 *
	 * @param array $setting_data Array of setting fields
	 * @return int Setting identifier if section was created, true un success update, false otherwise
	 */
	private function _update($setting_data)
	{
		if (!$this->check_edition($setting_data)) {
			return false;
		}

		$data = $setting_data;

		// Delete value if exist
		if (!empty($data['value'])) {
			unset($data['value']);
		}

		$object_id = db_replace_into('settings_objects', $data);

		return $object_id;
	}

	/**
	 * Updates value of setting by section name and setting name
	 *
	 * @param string $section_name Section name
	 * @param string $setting_name Setting name
	 * @param string $setting_value Setting value
	 * @param bool $force_cache_cleanup Force registry cleanup after setting was updated
	 * @param int $company_id Company identifier
	 * @return bool Always true
	 */
	public function update_value($setting_name, $setting_value, $section_name = '', $force_cache_cleanup = false, $company_id = null)
	{
		if (!empty($setting_name)) {
			$object_id = $this->get_id($setting_name, $section_name);
			$this->update_value_by_id($object_id, $setting_value, $company_id);

			if ($force_cache_cleanup) {
				Registry::cleanup();
			}
		}

		return true;
	}

	/**
	 * Updates setting value. If $value and $object_id is empty function return false and generate error notification.
	 *
	 * @param int $object_id Setting identifier
	 * @param string $value New value
	 * @param string $company_id Company identifier
	 * @return bool True on success, false otherwise
	 */
	public function update_value_by_id($object_id, $value, $company_id = null)
	{
		if (!empty($object_id)) {
			fn_get_schema('settings', 'actions', 'php', false, true, true);

			$value = $this->serialize($value);

			$edition_types = db_get_field('SELECT edition_type FROM ?:settings_objects WHERE object_id = ?i', $object_id);

			$table = "";
			$data = array(
				'object_id' => $object_id,
				'value'     => $value,
			);

			if (PRODUCT_TYPE == 'ULTIMATE' && (defined('COMPANY_ID') || $company_id !== null)) {
				$need_edition_types = array(
					CSettings::VENDOR,
					$this->get_current_edition() . CSettings::VENDOR,
					$this->get_current_edition() . CSettings::VENDORONLY,
				);
				if (array_intersect($need_edition_types, explode(',', $edition_types))) {
					$table = "settings_vendor_values";
					$data['company_id'] = (intval($company_id) > 0) ? $company_id : COMPANY_ID;
				}
			} else {
				if (strpos($edition_types, $this->get_current_edition() . CSettings::NONE) === false) {
					$table = "settings_objects";
				}
			}

			if (!empty($table)) {
				$old_data = $this->get_data($object_id, $company_id);

				// Value types should be converted to the same one to compare
				if (!is_array($old_data['value'])) {
					$old_data['value'] = (string) $old_data['value'];
				}

				if (!is_array($value)) {
					$value = (string) $value;
				}

				// If option value was changed execute user function if it exists
				if (isset($old_data['value']) && $old_data['value'] !== $value) {
					$core_func_name = 'fn_settings_actions_' . fn_strtolower($old_data['section_id']) . '_' . (!empty($old_data['section_tab_id']) && $old_data['section_tab_id'] != 'main' ? $old_data['section_tab_id'] . '_' : '') . $old_data['name'];
					if (function_exists($core_func_name)) {
						$core_func_name($data['value'], $old_data['value']);
					}

					$addon_func_name  = 'fn_settings_actions_addons_'  . fn_strtolower($old_data['section_id']) . '_' . fn_strtolower($old_data['name']);
					if (function_exists($addon_func_name)) {
						$addon_func_name($data['value'], $old_data['value']);
					}

					db_replace_into($table, $data);
				}

			} else {
				$message = fn_get_lang_var('unable_to_update_setting_value') . ' (' . $object_id . ')';
				$this->generate_error($message, fn_get_lang_var('you_have_no_permissions'));
				return false;
			}
		} else {
			return false;
		}
		return true;
	}

	/**
	 * Check if setting exists
	 *
	 * @param string $section_name Setting name
	 * @param string $setting_name Section name
	 * @return bool True if setting exists, false otherwise
	 */
	public function is_exists($setting_name, $section_name = '')
	{
		return ($this->get_id($setting_name, $section_name) === false) ? false : true;
	}

	/**
	 * Removes setting and all related data
	 *
	 * @param string $section_name Setting name
	 * @param string $setting_name Section name
	 * @return bool Always true
	 */
	public function remove($setting_name, $section_name = '')
	{
		return $this->remove_by_id($this->get_id($setting_name, $section_name));
	}

	/**
	 * Removes setting and all related data by id
	 *
	 * @param $setting_id Setting identifier
	 * @return bool Always true
	 */
	public function remove_by_id($setting_id)
	{
		db_query('DELETE FROM ?:settings_objects WHERE object_id = ?i', $setting_id);
		$this->remove_description($setting_id, CSettings::SETTING_DESCRIPTION);
		$this->remove_setting_variants($setting_id);

		if (PRODUCT_TYPE == 'ULTIMATE') {
			$this->reset_all_vendors_settings($setting_id);
		}

		return true;
	}

	/**
	 * Removes all settings values for vendor
	 *
	 * @param $company_id Company identifier
	 * @return bool Always true
	 */
	public function remove_vendor_settings($company_id)
	{
		return db_query('DELETE FROM ?:settings_vendor_values WHERE company_id = ?i', $company_id);
	}

	/**
	 * Removes all vendors values of setting
	 *
	 * @param $object_id Setting object identifier
	 * @return bool Always true
	 */
	public function reset_all_vendors_settings($object_id)
	{
		return db_query('DELETE FROM ?:settings_vendor_values WHERE object_id = ?i', $object_id);
	}

	/**
	 * Function retuns variants for setting objects
	 *
	 * Usage (examples):
	 *	// Addons
	 *	Settings::instance->get_variants('affiliate', 'payment_period');
	 *
	 *	// Core same as addons but if $section_tab_name is empty it will be setted to 'main'
	 *	Settings::instance->get_variants('general', 'feedback_type');
	 *
	 *	// Return variants only by setting id, but function not check custom variant functions
	 *	Settings::instance->get_variants('', '', '', 40);
	 *
	 *	// Return variants only by setting id, and checks custom variant functions
	 *	Settings::instance->get_variants('affiliate', 'payment_period', '', 40);
	 *
	 * @param string $section_name Setting name
	 * @param string $setting_name Section name
	 * @param string $section_tab_name Section tab name
	 * @param int    $object_id Id of setting in setting_objects table
	 * @param string $lang_code 2 letters language code
	 * @return array Array of variants or empty array if this setting have no variants
	 */
	public function get_variants($section_name, $setting_name, $section_tab_name = '', $object_id = null, $lang_code = CART_LANGUAGE)
	{
		fn_get_schema('settings', 'variants', 'php', true, true);

		$variants = array();

		// Generate custom variants
		$addon_variant_func = 'fn_settings_variants_addons_'  . fn_strtolower($section_name) . '_' . fn_strtolower($setting_name);

		$core_variant_func = (
			'fn_settings_variants_'
			. fn_strtolower($section_name) . '_'
			. ($section_tab_name != 'main' ? fn_strtolower($section_tab_name) . '_' : '')
			. fn_strtolower($setting_name)
		);

		if (function_exists($addon_variant_func)) {
			$variants = $addon_variant_func();
		} elseif (function_exists($core_variant_func)) {
			$variants = $core_variant_func();
		} else {
			// If object id is 0 try to get it from section name and setting name
			if ($object_id === null || $object_id === 0) {
				$object_id = $this->get_id($setting_name, $section_name);
			}

			if ($object_id !== null && $object_id !== 0) {
				$_variants = db_get_array(
					"SELECT ?:settings_variants.*, ?:settings_descriptions.value, ?:settings_descriptions.object_type "
					. "FROM ?:settings_variants "
						. "INNER JOIN ?:settings_descriptions "
							."ON ?:settings_descriptions.object_id = ?:settings_variants.variant_id AND object_type = ?s "
					. "WHERE ?:settings_variants.object_id = ?i AND ?:settings_descriptions.lang_code = ?s ORDER BY ?:settings_variants.position"
					, CSettings::VARIANT_DESCRIPTION, $object_id, $lang_code
				);

				fn_update_lang_objects('variants', $_variants);

				foreach ($_variants as $variant) {
					$variants[$variant['name']] = $variant['value'];
				}
			} else {
				if (defined('DEVELOPMENT') && DEVELOPMENT == true) {
					$message = str_replace("[option_id]", $setting_name, fn_get_lang_var('setting_has_no_variants'));
					fn_set_notification('E', fn_get_lang_var('error'), $message);
				}

				return $variants;
			}
		}

		return $variants;
	}

	/**
	 * Updates variant of setting.
	 *
	 * Variant data must be array in this format (example):
	 * Array (
	 * 		'variant_id' => 1
	 * 		'object_id'  => 3,
	 * 		'name'       => 'hide',
	 * 		'position'   => 10,
	 * );
	 *
	 * If some parameter will be skipped and function not update it field.
	 * If variant_id skipped function adds new variant and retuns id of new record.
	 *
	 * @param  string  $variant_data Aray of variant data
	 * @return bool|int Variant identifier if variant was created, true un success update, false otherwise
	 */
	public function update_variant($variant_data)
	{
		return db_replace_into ('settings_variants', $variant_data);
	}

	/**
	 * Removes variant by id
	 * If $variant_id is empty function return false and generate error notification.
	 *
	 * @param int $variant_id  Variant identifier
	 * @return bool true or false if $variant_id or value is empty
	 */
	public function remove_variant($variant_id)
	{
		if (!(empty($variant_id))) {
			db_query("DELETE FROM ?:settings_variants WHERE variant_id = ?i", $variant_id);
			$this->remove_description($variant_id, CSettings::VARIANT_DESCRIPTION);
		} else {
			$this->generate_error(fn_get_lang_var('unable_to_delete_setting_variant'), fn_get_lang_var('empty_key_value'));
			return false;
		}

		return true;
	}

	/**
	 * Removes all setting variants
	 *
	 * @param string $setting_id Setting identifier
	 * @return bool true or false if $setting_id is empty
	 */
	public function remove_setting_variants($setting_id)
	{
		if (!(empty($setting_id))) {
			$variants = db_get_fields("SELECT variant_id FROM ?:settings_variants WHERE object_id = ?i", $setting_id);

			foreach ($variants as $variant_id) {
				$this->remove_variant($variant_id);
			}
		} else {
			$this->generate_error(fn_get_lang_var('unable_to_delete_setting_variant'), fn_get_lang_var('empty_key_value'));
			return false;
		}

		return true;
	}

	/**
	 * Get setting description
	 *
	 * @param int $object_id Identifier of object that has description
	 * @param string $object_type Type of object (Use CSettings *_DESCRIPTION constants)
	 * @param string $lang_code @ letters language code
	 * @return array|bool|string Setting ID or false if $section_name or $setting_name are empty
	 */
	public function get_description($object_id, $object_type, $lang_code = CART_LANGUAGE)
	{
		if (!empty($object_id) && !empty($object_type) && !empty($lang_code)) {
			return db_get_field(
				"SELECT value FROM ?:settings_descriptions "
				. "WHERE object_id = ?i AND object_type = ?s AND lang_code = ?s",
				$object_id, $object_type, $lang_code
			);
		} else {
			return false;
		}
	}

	/**
	 * Updates settings description.
	 * If $object_id, $object_type or $lang_code or value is empty function return false and generate error notification.
	 *
	 * Description data must be array in this format (example):
	 *	array(
	 *		'value'     => 'General',
	 *		'tooltip'   => 'General tab',
	 * 		'object_id' => '1',
	 *		'object_type' => 'S',
	 *		'lang_code' => 'EN'
	 *	)
	 *
	 * If some parameter will be skipped and function not update it field.
	 * If name or lang_code skipped function adds new description and returns true.
	 *
	 * @param  array $description_data Description data
	 * @return bool True on success, false otherwise
	 */
	public function update_description($description_data)
	{
		if (!(empty($description_data['object_type']) || empty($description_data['object_id']) || empty($description_data['lang_code']))) {
			db_replace_into ('settings_descriptions', $description_data);
		} else {
			$this->generate_error(fn_get_lang_var('unable_to_update_setting_description'), fn_get_lang_var('empty_key_value'));
			return false;
		}

		return true;
	}

	/**
	 * Removes description of some setting object
	 * If $name or $lang_code or value is empty function return false and generate error notification.
	 *
	 * @param string $object_id Setting object id
	 * @param string $object_type Type of object to remove variant
	 * @param string $lang_code 2 letters language code
	 * @return bool true or false if $name or $lang_code or value is empty
	 */
	public function remove_description($object_id, $object_type, $lang_code = '')
	{
		if (!empty($object_id) && !empty($object_type)) {
			$lang_condition = "";
			if (!empty($lang_code)) {
				$lang_condition = db_quote("AND lang_code = ?s", $lang_code);
			}

			db_query(
				"DELETE FROM ?:settings_descriptions WHERE object_id = ?i AND object_type = ?s ?p",
				$object_id, $object_type, $lang_condition
			);
		} else {
			$this->generate_error(fn_get_lang_var('unable_to_delete_setting_description'), fn_get_lang_var('empty_key_value'));
			return false;
		}

		return true;
	}

	/**
	 * Generates error notification
	 *
	 * @param $action Action thae was happen
	 * @param $reason Reason, why the error notification must be showed
	 * @param string $table Table name (optional)
	 * @return bool Always true
	 */
	private function generate_error($action, $reason, $table = '')
	{
		$message = str_replace("[reason]", $reason, $action);
		if (!empty($table)) {
			$message = str_replace("[table]", $table, $message);
		}

		fn_log_event('settings', 'error', $message);

		if (defined('DEVELOPMENT') && DEVELOPMENT == true) {
			fn_set_notification('E', fn_get_lang_var('error'), $message);
		}

		return true;
	}

	/**
	 * Returns plain list of settings
	 *
	 * @param mixed $fields String in SQL format with fields to get from db
	 * @param string $section_id If defined function returns list of option for this section
	 * @param string $section_tab_id If defined function returns list of option for this tab of section
	 * @param bool $no_headers If true function gets all settings that type is not 'H'
	 * @param string $extra_condition Extra SQL condition
	 * @param bool $is_global If true return oly global options
	 * @param int $company_id Company identifier
	 * @param string $lang_code 2 letters language code
	 * @return array|bool List of settings on success, false otherwise
	 */
	private function _get_list($fields, $section_id = '', $section_tab_id = '', $no_headers = false, $extra_condition = '', $is_global = true, $company_id = null, $lang_code = '')
	{
		$global_condition = $is_global ? " AND is_global = 'Y'" : '';
		$condition = (!empty($section_id)) ? db_quote(" AND section_id = ?s", $section_id) : $global_condition;
		$condition .= (!empty($section_tab_id)) ? db_quote(" AND section_tab_id = ?s", $section_tab_id) : '';
		$condition .= $this->generate_edition_condition('?:settings_objects', false);
		if ($no_headers) {
			$condition .= " AND ?:settings_objects.type <> 'H'";
		}

		$join = '';
		$value = '?:settings_objects.value AS value';

		if (PRODUCT_TYPE == 'ULTIMATE' && (defined('SELECTED_COMPANY_ID') && SELECTED_COMPANY_ID != 'all' || $company_id !== null)) {
			$company_id = ($company_id !== null) ? $company_id : intval(SELECTED_COMPANY_ID);
			$join .= db_quote('LEFT JOIN ?:settings_vendor_values ON ?:settings_vendor_values.object_id = ?:settings_objects.object_id AND company_id = ?i ', $company_id);

			$value = 'IF(?:settings_vendor_values.value IS NULL, ?:settings_objects.value, ?:settings_vendor_values.value) as value';
		}

		if (!empty($lang_code)) {
			$join .= db_quote(
				"LEFT JOIN ?:settings_descriptions "
				. "ON ?:settings_descriptions.object_id = ?:settings_objects.object_id "
					. "AND ?:settings_descriptions.object_type = ?s AND lang_code = ?s",
				'O', $lang_code
			);
			$fields[] = db_quote('?:settings_descriptions.value as description');
			$fields[] = db_quote('?:settings_descriptions.tooltip as tooltip');
			$fields[] = db_quote('?:settings_descriptions.object_type as object_type');
		} else {
			$fields[] = db_quote('?:settings_objects.name as description');
		}

		$fields[] = $value;
		$fields = implode(', ', $fields);

		return db_get_array('SELECT ?p FROM ?:settings_objects ?p WHERE 1 ?p ORDER BY ?:settings_objects.position', $fields, $join, $condition.$extra_condition);
	}

	/**
	 * Generate SQL condition for edition types
	 *
	 * @param string $table Name of table that condition generated. Must be in SQL notation with placeholder for place database prefix.
	 * @param bool $use_access_level Use or ignore edition and type access conditions (ROOT, MSE:VENDOR, etc...)
	 * @return string SQL condition
	 */
	private function generate_edition_condition($table, $use_access_level = true)
	{
		$edition_names = $this->get_edition_names();
		$edition_conditions = $_edition_conditions = array();

		if ($use_access_level && defined('COMPANY_ID') && PRODUCT_TYPE == 'ULTIMATE') {
			$_edition_conditions[] = 'VENDOR';
		} else {
			$_edition_conditions[] = 'ROOT';
			if (PRODUCT_TYPE == 'ULTIMATE') {
				$_edition_conditions[] = 'VENDOR';
			}
		}

		foreach ($_edition_conditions as $edition_condition) {
			$edition_conditions[] = "FIND_IN_SET('$edition_condition', $table.edition_type)";
			$edition_conditions[] = "FIND_IN_SET('" . $this->get_current_edition() . $edition_condition."', $table.edition_type)";
		}

		return ' AND ('.implode(' OR ', $edition_conditions).')';
	}

	/**
	 * Unpacks setting value
	 *
	 * @param mixed $value Setting value
	 * @return mixed Unpacked value
	 */
	private function unserialize($value, $force_parse = false)
	{
		if (strpos($value, '#M#') === 0) {
			parse_str(str_replace('#M#', '', $value), $value);
		} elseif ($force_parse) {
			parse_str($value, $value);
		}
		return $value;
	}

	/**
	 * Packs setting value
	 *
	 * @param mixed $value Setting value
	 * @return mixed Packed value
	 */
	private function serialize($value)
	{
		if (is_array($value)) {
			$value = '#M#' . implode('=Y&', $value) . '=Y';
		}

		return $value;
	}

	/**
	 * Checks that this setting or section may be updated in current edition
	 *
	 * @param array $object Some setting object data to check
	 * @return true on success, false otherwise
	 */
	private function check_edition($object)
	{
		$allow = true;

		if (!empty($object['edition_type'])) {
			$edition_names = $this->get_current_edition();
			$setting_editions = explode(",", $object['edition_type']);

			if(array_search("ROOT", $setting_editions) === false
				&& array_search("VENDOR", $setting_editions) === false
				&& array_search($this->get_current_edition() . "ROOT", $setting_editions) === false
				&& array_search($this->get_current_edition() . "VENDOR", $setting_editions) === false
			) {
				$allow = false;
			}
		}

		return $allow;
	}
}

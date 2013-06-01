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

class Addons_SchemesManager {
	static $schemas;

	/**
	 * @static
	 * @param $addon_id
	 * @return Addons_XMLScheme object
	 */
	static function get_scheme($addon_id, $path = DIR_ADDONS)
	{
		libxml_use_internal_errors(true);

		if (!isset (self::$schemas[$addon_id])) {
			$_xml = self::read_xml($path . $addon_id . '/addon.xml');
			if ($_xml !== FALSE) {
				$versions = self::get_version_definition();
				$version = (isset($_xml['scheme'])) ? (string)$_xml['scheme'] : '1.0';
				self::$schemas[$addon_id] = new $versions[$version]($_xml);
			} else {
				$errors = libxml_get_errors();

				$text_errors = array();
				foreach ($errors as $error) {
					$text_errors[] = self::display_xml_error($error, $_xml);
				}

				libxml_clear_errors();
				if (!empty($text_errors)) {
					fn_set_notification('E', fn_get_lang_var('xml_error'), '<br/>' . implode('<br/>' , $text_errors));
				}

				return false;
			}
		}
		return self::$schemas[$addon_id];
	}

	/**
	 * Loads xml
	 * @param $filename
	 * @return bool
	 */
	private static function read_xml($filename)
	{
		if (file_exists($filename)) {
			return simplexml_load_file($filename);
		}
		
		return false;
	}

	/**
	 * Returns the scheme in which a class processing any certain xml scheme version is defined.
	 * @static
	 * @return array
	 */
	private static function get_version_definition()
	{
		return array(
			'1.0' => 'Addons_XmlScheme1',
			'2.0' => 'Addons_XmlScheme2',
		);
	}

	/**
	 * Returns list of addons that will not be worked correctly without it
	 * @static
	 * @param $addon_id
	 * @param $lang_code
	 * @return array
	 */
	static function get_install_dependencies($addon_id, $lang_code = CART_LANGUAGE)
	{
		$scheme = self::get_scheme($addon_id);
		$dependencies = array();

		if ($scheme !== false) {
			$addons = $scheme->get_dependencies();
			$dependencies = self::get_names($addons, false, $lang_code);
		}

		return $dependencies;
	}

	/**
	 * Returns list of addons that will not be worked correctly without it
	 * @static
	 * @param $addon_id
	 * @param $lang_code
	 * @return array
	 */
	static function get_uninstall_dependencies($addon_id, $lang_code = CART_LANGUAGE)
	{
		$addons = db_get_fields('SELECT addon FROM ?:addons WHERE dependencies LIKE ?l', '%' . $addon_id . '%');
		$dependencies = self::get_names($addons, true, $lang_code);

		return $dependencies;
	}

	/**
	 * Convert addon's ids list to to array of addon names as addon_id => addon_name;
	 * @static
	 * @param $addons array of addon id's
	 * @param $lang_code 2digits lang code
	 * @return array
	 */
	static function get_names($addons, $with_installed = true, $lang_code = CART_LANGUAGE)
	{
		$addon_names = Array();

		foreach($addons as $addon_id){
			if (!empty($addon_id) && (Registry::get('addons.' . $addon_id) == null || $with_installed)){
				$scheme = self::get_scheme($addon_id);
				if ($scheme !== false) {
					$addon_names[$addon_id] = $scheme->get_name($lang_code);
				}
			}
		}

		return $addon_names;
	}

	private static function display_xml_error($error, $xml)
	{
		$return  = $xml[$error->line - 1] . "\n";

		switch ($error->level) {
			case LIBXML_ERR_WARNING:
				$return .= '<b>'. fn_get_lang_var('warning') . " $error->code:</b> ";
				break;
			 case LIBXML_ERR_ERROR:
				$return .= '<b>'. fn_get_lang_var('error') . " $error->code:</b> ";
				break;
			case LIBXML_ERR_FATAL:
				$return .= '<b>'. fn_get_lang_var('error') . " $error->code:</b> ";
				break;
		}

		$return .= trim($error->message) . '<br/>  <b>' . fn_get_lang_var('line') . "</b>: $error->line" . '<br/>  <b>' . fn_get_lang_var('column') . "</b>: $error->column";

		if ($error->file) {
			$return .= '<br/> <b>' . $error->file . '</b>';
		}

		return "$return<br/>";
	}
}
?>
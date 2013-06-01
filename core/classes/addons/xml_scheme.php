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

abstract class Addons_XmlScheme {
	protected $_xml;

	/**
	 * Returns array of types for addons setting
	 * @return array
	 */
	protected function _get_types()
	{
		return array (
			'input' => 'I',
			'textarea' => 'T',
			'radiogroup' => 'R',
			'selectbox' => 'S',
			'password' => 'P',
			'checkbox' => 'C',
			'multiple select' => 'M',
			'multiple checkboxes' => 'N',
			'countries list' => 'X',
			'states list' => 'W',
			'file' => 'F',
			'info' => 'O',
			'header' => 'H',
			'selectable_box' => 'B',
			'template' => 'E',
			'permanent_template' => 'Z',
			'hidden' => 'D'
		);
	}

	/**
	 * @param $addon_xml SimpleXMLObject with addon scheme
	 */
	public function __construct($addon_xml)
	{
		$this->_xml = $addon_xml;
	}

	/**
	 * Returns text id of addon from xml
	 * @return string
	 */
	public function get_id()
	{
		return (string)$this->_xml->id;
	}

	/**
	 * Returns addons text name from xml.
	 * @param string $lang_code
	 * @return string
	 */
	public function get_name($lang_code = CART_LANGUAGE)
	{
		$name = $this->_get_translation($this->_xml, 'name', $lang_code);

		return ($name == '') ? (string)$this->_xml->name : $name;
	}

	/**
	 * Returns addons text description from xml.
	 * @param string $lang_code
	 * @return string
	 */
	public function get_description($lang_code = CART_LANGUAGE)
	{
		$description = $this->_get_translation($this->_xml, 'description', $lang_code);

		return ($description == '') ? (string)$this->_xml->description : $description;
	}

	/**
	 * Returns priority of addon from xml
	 * @return int
	 */
	public function get_priority()
	{
		return (isset($this->_xml->priority)) ? (int)$this->_xml->priority  : 0;
	}

	/**
	 * Returns priority of addon from xml
	 * @return string
	 */
	public function get_status()
	{
		return (isset($this->_xml->status) && (string)$this->_xml->status == 'active') ? 'A' : 'D';
	}

	/**
	 * Returns array of addon's ids
	 * @return array
	 */
	public function get_dependencies()
	{
		return (isset($this->_xml->dependencies)) ? explode(',', (string)$this->_xml->dependencies) : array();
	}
	
	/**
	 * Return assray of names of conflicted addons
	 */
	public function get_conflicts()
	{
		$conflicts = array();
		foreach ($this->_xml->xpath('//conflicts') as $addon) {
			$conflicts[] = (string) $addon;
		}
		return $conflicts;
	}
	
	/**
	 * Returns array of editions
	 * @return array
	 */
	public function auto_install_for()
	{
		return (isset($this->_xml->auto_install)) ? explode(',', (string)$this->_xml->auto_install) : array();
	}

	/**
	 * Returns comma separated list of editions for addon section
	 * @return string
	 */
	public function get_edition_type()
	{
		return $this->_get_edition_type($this->_xml->settings);
	}

	/**
	 * Returns way how will be displayed addon settings list.
	 * popup - in popup box
	 * separate - in new window
	 * @return string
	 */
	public function get_settings_layout()
	{
		return "popup";
	}

	/**
	 * Executes queries from addon scheme.
	 * @param string $mode
	 * @return bool
	 */
	public function process_queries($mode = 'install', $addon_path)
	{
		Registry::set('runtime.database.skip_errors', true);

		$languages = Registry::get('languages');
		$queries = $this->get_queries($mode);

		$lang_queries = array();

		if (!empty($queries) && is_array($queries)) {
			foreach ($queries as $query) {
				if (!empty($query['lang']) && !empty($query['table'])) {
					$lang_queries[(string) $query['table']][(string) $query['lang']][] = $query;
				} else {
					$this->_execute_query($query, $addon_path);
				}
			}
		}

		$default_lang = $this->get_default_language();
		foreach($lang_queries as $table_name => $queries) {
			// Check and execute default language queries
			if (isset($queries[$default_lang])) {
				// Actions with default language
				foreach ($queries[$default_lang] as $default_query) {
					$this->_execute_query($default_query, $addon_path);

					// Clone default values to all other languages
					foreach ($languages as $lang_code => $lang_data) {
						fn_clone_language_values((string) $default_query['table'], $lang_code, (string) $default_query['lang']);
					}
				}
			}

			// execute other languages queries
			foreach ($languages as $lang_code => $lang_data) {
				if (isset($queries[$lang_code])) {
					foreach ($queries[$lang_code] as $query) {
						$this->_execute_query($query, $addon_path);
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
		} else {
			return true;
		}
	}

	/**
	 * Executes query from addon xml scheme
	 * @return bool always true
	 */
	private function _execute_query($query, $addon_path)
	{
		if (isset($query['type']) && (string) $query['type'] == 'file') {
			db_import_sql_file($addon_path . '/' . (string) $query, 16384, false);
		} else {
			db_query((string)$query);
		}

		return true;
	}

	/**
	 * Returns array of custom addon js functions for manage addons page
	 * @return array
	 */
	public function get_js_functions()
	{
		$functions = array();

		if (isset($this->_xml->js_functions->item)) {
			foreach ($this->_xml->js_functions->item as $function) {
				$functions[(string)$function['for']] = (string)$function;
			}
		}

		return $functions;
	}
	
	/**
	 * Returns tab order
	 * @return string 
	 */
	public function get_tab_order()
	{		
		return (isset($this->_xml->tab_order)) ? $this->_xml->tab_order : 'append';
	}

	/**
	 * Returns addon promo status
	 * @return bool
	 */
	public function is_promo()
	{
		return (isset($this->_xml->promo)) ? (bool) $this->_xml->promo : false;
	}
	
	/**
	 * Returns addon promo status
	 * @return bool
	 */
	public function get_version()
	{
		return (isset($this->_xml->version)) ? (string) $this->_xml->version : '';
	}
	
	/**
	 * Returns edition type for this node.
	 * If in this node has no edition type returns edition type of it's parent.
	 * If for all parents of this node has no edition type returns ROOT.
	 * @param $xml_node
	 * @return string
	 */
	public function _get_edition_type($xml_node)
	{
		$edition_type = 'ROOT'; // Set default value of edition type

		if (isset($xml_node['edition_type'])) {
			$edition_type = (string) $xml_node['edition_type'];
		} else { // Try to take parent edition type
			if (is_object($xml_node)) {
				$parent = $xml_node->xpath('parent::*');
				if (is_array($parent)) {
					$parent = current($parent);
					if (!empty($parent)) {
						$edition_type = $this->_get_edition_type($parent);
					}
				}
			}
		}

		return $edition_type;
	}

	/**
	 * Returns translations of description and addon name.
	 * @return array|bool
	 */
	public function get_addon_translations()
	{
		return $this->_get_translations($this->_xml);
	}

	public function call_custom_functions($action)
	{		
		// Execute custom functions
		if (isset($this->_xml->functions)) {
			Registry::set('runtime.database.skip_errors', true);
			
			$addon_name = (string) $this->_xml->id;
			// Include func.php file of this addon
			if (is_file(DIR_ADDONS . $addon_name . '/func.php')) {
				require_once(DIR_ADDONS . $addon_name . '/func.php');

				if (is_file(DIR_ADDONS . $addon_name . '/config.php')) {
					require_once(DIR_ADDONS . $addon_name . '/config.php');
				}

				foreach ($this->_xml->functions->item as $v) {
					if (($action == 'install' && !isset($v['for'])) || (string)$v['for'] == $action) {
						if (function_exists((string)$v)) {
							call_user_func((string)$v, $v, $action);
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
	 * Uninstall all langvars 
	 */
	public function uninstall_language_values()
	{
		$node = $this->_get_lang_vars_section_name();
		$langvars = $this->_xml->xpath($node . '/item');
		if (!empty($langvars) && is_array($langvars)) {
			foreach($langvars as $langvar) {
				db_query("DELETE FROM ?:language_values WHERE name = ?s", (string) $langvar['name']);
			}
		}
	}
	
	/**
	 * Install all langvars from addon xml scheme
	 */
	public function install_language_values()
	{
		$langvars = array();
		
		$node = $this->_get_lang_vars_section_name();		
		$default_lang = $this->get_default_language();
		
		$default_langvars = $this->_xml->xpath($node . "/item[@lang='$default_lang']");
		if (!empty($default_langvars)) {
			// Fill all languages by default laguage values
			foreach ((array)Registry::get('languages') as $lang_code => $_v) {			
				// Install default			
				foreach($default_langvars as $lang_var) {
					db_query("REPLACE INTO ?:language_values ?e", array(
						'lang_code' => $lang_code,
						'name' => (string) $lang_var['id'],
						'value' => (string) $lang_var
					));
				}

				if ($lang_code != $default_lang) {
					$current_langvars = $this->_xml->xpath($node . "/item[@lang='$lang_code']");
					if (!empty($current_langvars)) {
						foreach($current_langvars as $lang_var) {
							db_query("REPLACE INTO ?:language_values ?e", array(
								'lang_code' => $lang_code,
								'name' => (string) $lang_var['id'],
								'value' => (string) $lang_var
							));
						}
					}
				}						
			}
		}
	}
	
	/**
	 * Returns one translation for some node for some language
	 * @param $node
	 * @param string $for
	 * @param $lang_code
	 * @return string
	 */
	protected function _get_translation($node, $for = '', $lang_code= CART_LANGUAGE)
	{
		$name = '';
		
		if (isset($node->translations)) {
			foreach ($node->translations->item as $item) {
				$a = isset($item['for']) && $for != '';
				$b = (string)$item['for'] == $for;
				$c = (string)$item['lang'] == $lang_code;
				if ($c && ($a && $b || !$a)) {
					$name = (string)$item;
				}
			}
		}
	
		return $name;
	}

	/**
	 * Returns all translations for xml_node for all installed laguages if it is presents in addon xml
	 * @param $xml_node
	 * @return array|bool
	 */
	protected function _get_translations($xml_node)
	{
		$translations = array();
		
		$default_language = $this->get_default_language();		
		
		// Generate id from attribute or property
		if (isset($xml_node['id'])) {
			$id = (string)$xml_node['id'];
		} elseif(isset($xml_node->id)) {
			$id = (string)$xml_node->id;
		} else {
			return false;
		}	
	
		$default_translation = array(
			'lang_code' => $default_language,
			'name' => $id,
			'value' => (string) $xml_node->name,
			'tooltip' => isset($xml_node->tooltip) ? (string) $xml_node->tooltip : '',
			'description' => isset($xml_node->description) ? (string) $xml_node->description : '',
		);		
		
		// Fill all languages by default laguage values
		foreach ((array)Registry::get('languages') as $lang_code => $_v) {
			$value = $xml_node->xpath("translations/item[(not(@for) or @for='name') and @lang='$lang_code']");
			$tooltip = $xml_node->xpath("translations/item[@for='tooltip' and @lang='$lang_code']");
			$description = $xml_node->xpath("translations/item[@for='description' and @lang='$lang_code']");
			if (!empty($value) || !empty($default_translation['value'])) {
				$translations[] = array(
					'lang_code' =>  $lang_code,
					'name' => $default_translation['name'],
					'value' => !empty($value) && is_array($value) ? (string) current($value) : $default_translation['value'],
					'tooltip' => !empty($tooltip) && is_array($tooltip) ? (string) current($tooltip) : $default_translation['tooltip'],
					'description' => !empty($description) && is_array($description) ? (string) current($description) : $default_translation['description'],
				);
			}
		}		

		return $translations;
	}

	/**
	 * Returns array of setting item data from xml node
	 * @param $xml_node
	 * @return array
	 */
	protected function _get_setting_item($xml_node)
	{
		if (isset($xml_node['id'])) {
			$_types = $this->_get_types();
			$setting = array(
				'edition_type' =>  $this->_get_edition_type($xml_node),
				'id' => (string) $xml_node['id'],
				'name' => (string) $xml_node->name,
				'type' => isset($_types[(string) $xml_node->type]) ? $_types[(string) $xml_node->type] : '',
				'translations' => $this->_get_translations($xml_node),
				'default_value' => isset($xml_node->default_value) ? (string) $xml_node->default_value : '',
				'variants' => $this->_get_variants($xml_node),
				'handler' => isset($xml_node->handler) ? (string) $xml_node->handler : ''
			);
			return $setting;
		} else {
			return array();
		}
	}

	/**
	 * Returns array of variants of setting item from xml node
	 * @param $xml_node
	 * @return array
	 */
	protected function _get_variants($xml_node)
	{
		$variants = array();
		if (isset($xml_node->variants)) {
			foreach ($xml_node->variants->item as $variant) {
				$variants[] = array(
					'id' => (string) $variant['id'],
					'name' => (string) $variant->name,
					'translations' => $this->_get_translations($variant),
				);
			}
		}
		return $variants;
	}

	/**
	 * Returns array of language variables of addon.
	 *
	 * @abstract
	 * @return array
	 */
	protected abstract function _get_lang_vars_section_name();
	
	/**
	 * Returns array of settings sections of addon.
	 * In current version of cart it is tabs on addon's update settings page
	 *
	 * @abstract
	 * @return array
	 */
	public abstract function get_sections();

	/**
	 * Returns array of settings on section
	 * @abstract
	 * @param $section_id
	 * @return void
	 */
	public abstract function get_settings($section_id);

	/**
	 * Returns array of SQL queries
	 * @abstract
	 * @param string $mode May be install or uninstall
	 * @return array
	 */
	protected abstract function get_queries($mode = '');

	/**
	 * Returns 2digits lang code
	 * @abstract
	 * @param string $mode May be install or uninstall
	 * @return string
	 */
	public abstract function get_default_language();

	/**
	 * Magic method for serialize
	 * @return array
	 */
	public function __sleep (){
		$this->_xml = $this->_xml->asXML();
		return array('_xml');
	}
}
?>

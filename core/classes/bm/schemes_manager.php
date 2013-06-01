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

class Bm_SchemesManager {
	/**
	 * Static storage for already read schemes
	 * @var array Static storage for already read schemes
	 */
	private static $schemes;

	/**
	 * Returns list of dispatches and it's descriptions
	 * @static
	 * @param string $lang_code 2 letter language code
	 * @return array List of dispatch descriptions as dispatch => description
	 */
	public static function get_dispatch_descriptions($lang_code = DESCR_SL)
	{
		$descriptions = self::_get_scheme('dispatch_descriptions');

		foreach($descriptions as $dispatch => $lang_var) {
			$descriptions[$dispatch] = fn_get_lang_var($lang_var, $lang_code);
		}

		return $descriptions;
	}

	/**
	 * Returns dynamic object data
	 * @static
	 * @param string $dispatch URL dispatch (controller.mode.action)
	 * @param string $area Area ('A' for admin or 'C' for customer)
	 * @return array|bool Array of dynamic object data, false otherwise
	 */
	public static function get_dynamic_object($dispatch, $area = 'A')
	{
		$area = self::_normalize_area($area);

		$objects = self::_get_scheme('dynamic_objects');

		foreach ($objects as $object_type => $properties) {
			if (isset($properties[$area]) && $properties[$area] == $dispatch) {
				$properties['object_type'] = $object_type;
				return $properties;
			}
		}

		return false;
	}

	/**
	 * Returns dynamic object data
	 * @static
	 * @param string $type Type of dinamic object
	 * @return array|bool Array of dynamic object data, false otherwise
	 */
	public static function get_dynamic_object_by_type($type)
	{
		$objects = self::_get_scheme('dynamic_objects');
		if (isset($objects[$type])) {
			return $objects[$type];
		}

		return array();
	}

	/**
	 * Checks existing block with $block_type in block manager scheme
	 * @static
	 * @param string $block_type Block type. Thirst key of scheme array
	 * @return bool
	 */
	public static function is_block_exist($block_type)
	{
		$scheme = self::_get_scheme('blocks');
		return isset($scheme[$block_type]);
	}

	/**
	 * Gets scheme for some block type
	 * @static
	 * @param string $block_type Block type. Thirst key of scheme array
	 * @param array $params Request params
	 * @param bool $no_cache Do not get scheme from cache
	 * @return array Array of block scheme data
	 */
	public static function get_block_scheme($block_type, $params, $no_cache = false)
	{
		$scheme = self::_get_scheme('blocks');

		$cache_name = 'scheme_block_' . $block_type;

		Registry::register_cache($cache_name, array('addons'), CACHE_LEVEL_STATIC);

		if (Registry::is_exist($cache_name) == true && $no_cache == false) {
			return Registry::get($cache_name);
		} else {
			if (isset($scheme[$block_type])) {
				// Get all data for this block type
				$_block_scheme = $scheme[$block_type];

				$_block_scheme['type'] = $block_type;

				// Update templates data
				$_block_scheme['templates'] = self::_prepare_templates($_block_scheme);
				$_block_scheme['wrappers'] = self::_prepare_wrappers($_block_scheme);
				$_block_scheme['content'] = self::prepare_content($_block_scheme, $params);
				$_block_scheme = self::_prepare_settings($_block_scheme);

				Registry::set($cache_name, $_block_scheme);

				return $_block_scheme;
			}
		}

		return array();
	}

	/**
	 * Generates content section of block scheme
	 * @static
	 * @param array $block_scheme Scheme of block
	 * @param array $request_params Request params
	 * @return array Content section of block scheme
	 */
	public static function prepare_content($block_scheme, $request_params)
	{
		$content = array();

		if (isset($block_scheme['content']) && is_array($block_scheme['content'])) {
			foreach($block_scheme['content'] as $name => $params) {
				$params = self::_get_value($params);
				if (is_array($params)) {
					foreach ($params as $param_name => $param_value) {
						$content[$name][$param_name] = $param_value;
						// Merge with fillings settings
						if ($param_name == 'fillings') {
							$fillings = self::_get_scheme('fillings');
							foreach($param_value as $filling_name => $filling_param) {
								if (isset($fillings[$filling_name])) {
									$content[$name][$param_name][$filling_name]['settings'] = $fillings[$filling_name];
								}

								$content[$name][$param_name][$filling_name] = self::_prepare_settings($content[$name][$param_name][$filling_name]);

								if (!self::is_filling_available($request_params, $block_scheme, $filling_name)) {
									unset($content[$name][$param_name][$filling_name]);
								}
							}
						}
					}	
				} else {
					$content[$name] = $params;
				}
			}
		}

		return $content;
	}

	/**
	 * Returns available filling for this template or no
	 * @static
	 * @param array $params Request params
	 * @param array $block_scheme Scheme of block
	 * @param string $filling_name name of filling
	 * @return bool True if filling is available for this template, false otherwise
	 */
	public static function is_filling_available($params, $block_scheme, $filling_name)
	{
		if (isset($params['properties']['template'])) {
			$template = $params['properties']['template'];
			if (isset($block_scheme['templates'][$template]['fillings'])) {
				return in_array($filling_name, $block_scheme['templates'][$template]['fillings']);
			}
		}
		return true;
	}

	/**
	 * Generates templates section of block scheme
	 * @static
	 * @param array $block_scheme Scheme of block
	 * @return array Templates section of block scheme
	 */
	private static function _prepare_templates($block_scheme)
	{
		$templates = array();

		if (isset($block_scheme['templates'])) {
			$_all_templates = self::_get_scheme('templates');
			$block_scheme['templates'] = self::_get_value($block_scheme['templates']);

			$skin_path = Bm_RenderManager::get_customer_skin_path();

			if (is_array($block_scheme['templates'])) {
				foreach($block_scheme['templates'] as $path => $template) {
					if (isset($_all_templates[$path])) {
						$template = array_merge($template, $_all_templates[$path]);
					}

					if (empty($template['name'])) {
						$template['name'] = self::generate_template_name($path, $skin_path);;
					}

					$templates[$path] = $template;
				}
			}
		}

		return self::_prepare_settings($templates);
	}

	/**
	 * Generates additional params for settings array
	 * @param array $settings 
	 * @return type
	 */
	private static function _prepare_settings($scheme)
	{
		if (!empty($scheme['settings']) && is_array($scheme['settings'])) {
			foreach($scheme['settings'] as $name => $value) {
				$scheme['settings'][$name] = self::_get_value($value);
			}
		}

		return $scheme;
	}

	/**
	 * Generates wrappers section of block scheme
	 * @static
	 * @param array $block_scheme Scheme of block
	 * @return array Wrappers section of block scheme
	 */
	public static function _prepare_wrappers ($block_scheme)
	{
		$wrappers = array();

		if (isset($block_scheme['wrappers'])) {
			return self::_get_value($block_scheme['wrappers']);
		}

		return $wrappers;
	}

	/**
	 * Returns all block types
	 * @static
	 * @param string $lang_code 2 letter language code
	 * @return array List of block types with name, icon and type
	 */
	public static function get_block_types ($lang_code = CART_LANGUAGE)
	{
		$scheme = self::_get_scheme('blocks');
		$types = array();

		foreach($scheme as $type => $params) {
			$types[$type] = array(
				'type' => $type,
				'name' => fn_get_lang_var('block_' . $type, $lang_code),
				'icon' => '/images/block_manager/block_icons/default.png'
			);

			if (!empty($params['icon'])) {
				$types[$type]['icon'] = $params['icon'];
			}
		}
		
		$types = fn_sort_array_by_key($types, 'name');

		return $types;
	}

	/**
	 * Removes blocks that cannot be on $location or can be only singular for this $location and already exist on it
	 * for $location and allready exists on it
	 * 
	 * To define that kind of block use hide_on_locations and single_for_location keys in blocks scheme
	 * 
	 * @param array $blocks List of blocks
	 * @param array $location Array with location data
	 * @return array Filtered list of blocks
	 */
	public static function filter_by_location($blocks, $location) {
		$scheme = self::_get_scheme('blocks');

		foreach($blocks as $block_key => $block) {
			if (!empty($block['type'])) {
				$type = $block['type'];
				if (!empty($scheme[$type]['hide_on_locations'])) {
					if (array_search($location['dispatch'], $scheme[$type]['hide_on_locations']) !== false) {
						unset($blocks[$block_key]);
                        continue;
					}
                }
				if (!empty($block['type']) && !empty($scheme[$type]['single_for_location'])) {
                    $block_exists = Bm_Block::instance()->get_blocks_by_type_for_location($type, $location['location_id']);
					if (!empty($block_exists)) {
						unset($blocks[$block_key]);
					}
				}
			}
		}
		return $blocks;
	}

	/**
	 * Returns true if content of this block type may be multilanguage.
	 * @static
	 * @param string $block_type Type of block
	 * @return bool True if content of this block type may be multilanguage, false otherwise
	 */
	public static function is_multilanguage_content($block_type)
	{
		$scheme = self::_get_scheme('blocks');

		if (isset($scheme[$block_type]['multilanguage'])) {
			return true;
		}

		return false;
	}

	/**
	 * Gets scheme and place it in private storage
	 * @static
	 * @param $target
	 * @param $name
	 * @return mixed
	 */
	private static function _get_scheme($name, $target = 'block_manager')
	{
		if (empty(self::$schemes[$name])) {
			self::$schemes[$name] = fn_get_schema($target, $name);
		}

		return self::$schemes[$name];
	}

	/**
	 * Returns 'customer' or 'admin' for 'C' or 'A'
	 * @param string $area Area ('A' for admin or 'C' for customer)
	 * @return string 
	 */
	private static function _normalize_area($area){
		if ($area == 'A') {
			$area = 'admin_dispatch';
		} else {
			$area = 'customer_dispatch';
		}

		return $area;
	}

	/**
	 * Generates scheme data
	 * @static
	 * @param mixed $item Item from scheme
	 * @return array|mixed
	 */
	private static function _get_value($item)
	{
		$tpls = Bm_RenderManager::get_customer_skin_path() . $item;

        if (is_array($item) && !empty($item[0]) && is_callable($item[0])) {
            // If it's a function execute it and return it result
            $callable = array_shift($item);
            return call_user_func_array($callable, $item);
		} elseif (is_file($tpls)) {
			return array(
				strval($item) => array(
					'name' => self::generate_template_name($item, Bm_RenderManager::get_customer_skin_path())
				)
			);
		} elseif (is_dir($tpls)) {
			// If it's dir with templates return list of templates
			$files = fn_get_dir_contents($tpls, false, true, '.tpl', $item . '/');

			$skin_path = Bm_RenderManager::get_customer_skin_path();

			// Now get tabs blocks from addons
			foreach (Registry::get('addons') as $addon => $v) {
				if ($v['status'] == 'A') {
					$_tpls = fn_get_dir_contents($skin_path . 'addons/' . $addon . '/' . $item, false, true, '.tpl', 'addons/' . $addon . '/' . $item . '/');
					if (!empty($_tpls)) {
						$files = fn_array_merge($files, $_tpls, false);
					}
				}
			}

			$result = Array();
			foreach ($files as $file) {
				$result[$file]['name'] = self::generate_template_name($file, $skin_path);
			}

			return $result;
		} elseif (is_dir(DIR_ROOT . '/' . $item)) {
			// If it's dir with templates return list of templates
			return fn_get_dir_contents(DIR_ROOT . '/' . $item, false, true);
		} else {
			if (!empty($item['data_function'][0]) && is_callable($item['data_function'][0])) {
                $callable = array_shift($item['data_function']);
                $item['values'] = call_user_func_array($callable, $item['data_function']);
			}
			return $item;
		}
	}

	/**
	 * Generates template name from language value
	 * from {*block-description: *} comment from template.
	 * @static
	 * @param string $path Path to template
	 * @param string $skin_path  Path to skin
	 * @return string Name of template
	 */
	public static function generate_template_name($path, $skin_path) 
	{
		$name = fn_get_file_description($skin_path . $path, 'block-description');

		if (empty($name)) {
			$name = fn_basename($path, '.tpl');
			$name = fn_get_lang_var($name);
		}

		return $name;
	}
}

?>

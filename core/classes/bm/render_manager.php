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

class Bm_RenderManager
{

	const ADMIN = 'admin';
	const CUSTOMER = 'customer';

	/**
	 * Current rendered location data
	 * @var array Location data
	 */
	private $location;

	/**
	 * Containers from current rendered location
	 * @var array List of containers data
	 */
	private $containers;

	/**
	 * Grids from current rendered location
	 * @var array List of grids data
	 */
	private $grids;

	/**
	 * Blocks from current rendered location
	 * @var array List of blocks data
	 */
	private $blocks;

	/**
	 * Current rendered area
	 * @var string Current rendered area
	 */
	private $area;

	/**
	 * Link to global Smarty object
	 * @var TemplateEngine_Core Link to global Smarty object
	 */
	private $view;

	/**
	 * Current skin name
	 * @var string Current skin name
	 */
	private $skin;

	/**
	 * @var array|bool
	 */
	private $dynamic_object_scheme;

	/**
	 * Loads location data, containers, grids and blocks
	 * @param string $dispatch URL dispatch (controller.mode.action)
	 * @param string $area Area ('A' for admin or 'C' for custom
	 * @param string $lang_code 2 letter language code
	 */
	public function __construct($dispatch, $area, $dynamic_object = array(), $location_id = 0, $lang_code = DESCR_SL)
	{
		Profiler::checkpoint('Start render location');
		// Try to get location for this dispatch
		if ($location_id > 0) {
			$this->location = Bm_Location::instance()->get_by_id($location_id, $lang_code);
		} else {
			$this->location = Bm_Location::instance()->get($dispatch, $dynamic_object, $lang_code);
		}

		$this->area = $area;

		if (!empty($this->location)) {
			if (isset($dynamic_object['object_id']) && $dynamic_object['object_id'] > 0) {
				$this->containers = Bm_Container::instance()->get_list_by_area($this->location['location_id'], 'C');
			} else {
				$this->containers = Bm_Container::instance()->get_list_by_area($this->location['location_id'], $this->area);
			}
			$this->grids = Bm_Grid::get_list(Bm_Container::instance()->get_ids($this->containers), array('g.*'));

			$blocks = Bm_Block::instance()->get_list(
				array('?:bm_snapping.*','?:bm_blocks.*', '?:bm_blocks_descriptions.*'),
				Bm_Grid::get_ids($this->grids),
				$dynamic_object,
				null,
				null,
				$lang_code
			);

			$this->blocks = $blocks;

			$this->view = Registry::get_view();
			$this->skin = self::_get_skin_path($this->area);
			$this->dynamic_object_scheme = Bm_SchemesManager::get_dynamic_object($this->location['dispatch'], 'C');
		} else {
			echo 'You have no default location!';

		}
	}

	/**
	 * Renders current location
	 * @return string HTML code of rendered location
	 */
	public function render()
	{
		if (!empty($this->location)) {
			$this->view->assign('containers', array(
				'top' => $this->_render_container($this->containers['TOP']),
				'central' => $this->_render_container($this->containers['CENTRAL']),
				'bottom' => $this->_render_container($this->containers['BOTTOM']),
			));

			Profiler::checkpoint('End render location');

			return $this->view->fetch($this->skin . 'location.tpl');
		} else {
			return '';
		}
	}

	/**
	 * Renders container
	 * @param array $container Container data to be rendered
	 * @return string HTML code of rendered container
	 */
	private function _render_container($container)
	{
		$content = '';

		$this->view->assign('container', $container);

		if (isset($this->grids[$container['container_id']])) {
			$grids = $this->grids[$container['container_id']];

			$grids = fn_build_hierarchic_tree($grids, 'grid_id');
			foreach ($grids as $grid) {
				$content .= $this->_render_grid($grid);
			}
		}

		$this->view->assign('content', $content);

		return $this->view->fetch($this->skin . 'container.tpl');
	}

	/**
	 * Renders grid
	 * @param int $grid Grid data to be rendered
	 * @return string HTML code of rendered grid
	 */
	private function _render_grid($grid)
	{
		$content = '';

		if (isset($grid['children']) && !empty($grid['children'])) {
			$grid['children'] = fn_sort_array_by_key($grid['children'], 'grid_id');
			foreach ($grid['children'] as $child_grid) {
				$content .= $this->_render_grid($child_grid);
			}
		} else {
			$content .= $this->render_blocks($grid);
		}

		$this->view->assign('content', $content);
		$this->view->assign('grid', $grid);

		return $this->view->fetch($this->skin . 'grid.tpl');
	}

	/**
	 * Renders blocks in grid
	 * @param array $grid Grid data
	 * @return string HTML code of rendered blocks
	 */
	public function render_blocks($grid)
	{
		$content = '';

		if (isset($this->blocks[$grid['grid_id']])) {
			foreach ($this->blocks[$grid['grid_id']] as $block) {
				$block['status'] = self::correct_status_for_dynamic_object($block, $this->dynamic_object_scheme);

				if ($this->area == 'C' && $block['status'] == 'D') {
					// Do not render block in customer if it disabled
					continue;
				}

				$content .= self::render_block($block, $grid, $this->area);
			}
		}

		return $content;
	}

	/**
	 * Corrects status if this block has different status for some dynamic object
	 * @static
	 * @param array $block Block data
	 * @return string Status A or D
	 */
	public static function correct_status_for_dynamic_object($block, $dynamic_object_scheme)
	{
		$status = $block['status'];
		// If dynamic object defined correct status
		if (!empty($dynamic_object_scheme['key'])) {
			$status = 'A';
			$object_key = $dynamic_object_scheme['key'];

			if ($block['status'] == 'A' && in_array($_REQUEST[$object_key], $block['items_array'])) {
				// If block enabled globally and disabled for some dynamic object
				$status = 'D';
			} elseif ($block['status'] == 'D' && !in_array($_REQUEST[$object_key], $block['items_array'])) {
				// If block disabled globally and not enabled for some dynamic object
				$status = 'D';
			}
		}

		return $status;
	}

	/**
	 * Renders block
	 * @static
	 * @param array $block Block data to be rendered
	 * @param string $content_alignment Alignment of block (float left, float, right, width 100%)
	 * @param string $area Area ('A' for admin or 'C' for custom
	 * @return string HTML code of rendered block
	 */
	public static function render_block($block, $parent_grid = '', $area = 'C')
	{
		if (Bm_SchemesManager::is_block_exist($block['type'])) {
			$view = Registry::get_view();

			$view->assign('parent_grid', $parent_grid);
			$view->assign('content_alignment', $parent_grid['content_align']);

			if ($area == 'C') {
				return self::render_block_content($block);
			} elseif ($area == 'A') {
				$view->assign('block_data', $block);
				return $view->fetch(self::_get_skin_path($area) . 'block.tpl');
			}
		}

		return '';
	}

	/**
	 * Renders block content
	 * @static
	 * @param array $block Block data for rendering content
	 * @return string HTML code of rendered block content
	 */
	public static function render_block_content($block)
	{
		// Do not render block if it disabled in customer area
		if (isset($block['is_disabled']) && $block['is_disabled'] == 1) {
			return '';
		}

		$smarty = Registry::get_view();
		$_tpl_vars = $smarty->_tpl_vars; // save state of original variables

		// By default block is displayed
		$display_block = true;

		self::_assign_block_settings($block);

		// Assign block data from DB
		Registry::get_view()->assign('block', $block);

		$skin_path = self::get_customer_skin_path();

		$block_scheme = Bm_SchemesManager::get_block_scheme($block['type'], array());

		$cache_name = 'block_content_' . $block['block_id'] . '_' . $block['snapping_id'] . '_' . $block['type'] . '_' . $block['grid_id'] . '_' . $block['object_id'] . '_' . $block['object_type'];

		// Register cache
		self::_register_block_cache($cache_name, $block_scheme);

		$block_content = '';

		if (isset($block_scheme['cache']) && Registry::is_exist($cache_name) == true && self::allow_cache()) {
			$block_content = Registry::get($cache_name);
		} else {
			if ($block['type'] == 'main') {
				$block_content = self::_render_main_content();
			} else {
				Registry::get_view()->assign('title', $block['name']);

				if (!empty($block_scheme['content'])) {
					foreach ($block_scheme['content'] as $template_variable => $field) {
						/**
						 * Actions before render any variable of block content
						 * @param string $template_variable name of current block content variable
						 * @param array $field Scheme of this content variable from block scheme content section
						 * @param array $block_scheme block scheme
						 * @param array $block Block data
						 */
						fn_set_hook('render_block_content_pre', $template_variable, $field, $block_scheme, $block);
						$value = self::get_value($template_variable, $field, $block_scheme, $block);

						// If block have not empty content - display it
						if (empty($value)) {
							$display_block = false;
						}

						Registry::get_view()->assign($template_variable, $value);
					}
				}

				// Assign block data from scheme
				Registry::get_view()->assign('block_scheme', $block_scheme);
				if ($display_block && file_exists($skin_path . $block['properties']['template'])) {
					$block_content = Registry::get_view()->fetch($skin_path . $block['properties']['template']);
				}
			}

			if (!empty($block['wrapper']) && file_exists($skin_path . $block['wrapper']) && $display_block) {
				Registry::get_view()->assign('content', $block_content);

				if ($block['type'] == 'main') {
					Registry::get_view()->assign('title', !empty($smarty->_smarty_vars['capture']['mainbox_title']) ? $smarty->_smarty_vars['capture']['mainbox_title'] : '', false);
				}
				$block_content = Registry::get_view()->fetch($skin_path . $block['wrapper']);
			} else {
				Registry::get_view()->assign('content', $block_content);
				$block_content = Registry::get_view()->fetch($skin_path . 'views/block_manager/render/block.tpl');
			}

			if (isset($block_scheme['cache']) && $display_block == true && self::allow_cache()) {
				Registry::set($cache_name, $block_content);
			}
		}

		$wrap_id = $smarty->get_template_vars('block_wrap');
		$smarty->_tpl_vars = $_tpl_vars; // restore original vars
		$smarty->_smarty_vars['capture']['title'] = null;

		if ($display_block == true) {
			if (!empty($wrap_id)) {
				$block_content = '<div id="' . $wrap_id . '">' . $block_content . '<!--' . $wrap_id . '--></div>';
			}
			return trim($block_content);
		} else {
			return '';
		}
	}

	/**
	 * Returns true if cache used for blocks
	 * 
	 * @static
	 * @return bool true if we may use cahce, false otherwise
	 */
	public static function allow_cache()
	{
		$use_cache = true;
		if (Registry::if_get('config.tweaks.disable_block_cache', false) || Registry::get('settings.customization_mode') == 'Y' || Registry::get('settings.translation_mode') == 'Y') {
			$use_cache = false;
		}

		return $use_cache;
	}

	/**
	 * Renders content of main content block
	 * @return string HTML code of rendered block content
	 */
	private static function _render_main_content()
	{
		$smarty = Registry::get_view();

		$notifications = $smarty->fetch('common_templates/notification.tpl', false);
		$block_content = $smarty->display($smarty->get_var('content_tpl'), false);

		return $notifications . $block_content;
	}

	/**
	 * Renders or gets value of some variable of block content
	 * @param string $template_variable name of current block content variable
	 * @param array $field Scheme of this content variable from block scheme content section
	 * @param array $block_scheme block scheme
	 * @param array $block Block data
	 * @return string Rendered block content variable value
	 */
	public static function get_value($template_variable, $field, $block_scheme, $block)
	{
		$value = '';
		// Init value by default
		if (isset($field['default_value'])) {
			$value = $field['default_value'];
		}

		if (isset($block['content'][$template_variable])) {
			$value = $block['content'][$template_variable];
		}

		if ($field['type'] == 'enum') {
			$value = Bm_Block::instance()->get_items($template_variable, $block, $block_scheme);
		}

		if ($field['type'] == 'function' && !empty($field['function'][0]) && is_callable($field['function'][0])) {
            $callable = array_shift($field['function']);
            array_unshift($field['function'], $value, $block, $block_scheme);
			$value = call_user_func_array($callable, $field['function']);
		}

		return $value;
	}

	/**
	 * Registers block cache
	 * @param string $cache_name Cache name
	 * @param array $block_scheme Block scheme data
	 */
	private static function _register_block_cache($cache_name, $block_scheme)
	{
		if (isset($block_scheme['cache'])) {
			$additional_level = '';

			$default_handlers = fn_get_schema('block_manager', 'block_cache_properties');

			if (isset($block_scheme['cache']['update_handlers']) && is_array($block_scheme['cache']['update_handlers'])) {
				$handlers = $block_scheme['cache']['update_handlers'];
			} else {
				$handlers = array();
			}

			$additional_level .= self::_generate_additional_cache_level($block_scheme['cache'], 'request_handlers', $_REQUEST);
			$additional_level .= self::_generate_additional_cache_level($block_scheme['cache'], 'session_handlers', $_SESSION);
			$additional_level .= self::_generate_additional_cache_level($block_scheme['cache'], 'auth_handlers', $_SESSION['auth']);
			$additional_level .= '|path=' . Registry::get('config.current_path');
			$additional_level = !empty($additional_level) ? md5($additional_level) : '';

			$handlers = array_merge($handlers, $default_handlers['update_handlers']);

			$cache_level = isset($block_scheme['cache']['cache_level']) ? $block_scheme['cache']['cache_level'] : CACHE_LEVEL_HTML_BLOCKS;
			Registry::register_cache($cache_name, $handlers, $cache_level . '__' . $additional_level);
		}
	}

	/**
	 * Generates additional cache levels by storage
	 * 
	 * @param array $cache_scheme Block cache scheme
	 * @param string $handler_name Name of handlers frocm block scheme
	 * @param array $storage Storage to find params
	 * @return string Additional chache level
	 */
	private static function _generate_additional_cache_level($cache_scheme, $handler_name, $storage)
	{
		$additional_level = '';

		if (!empty($cache_scheme[$handler_name]) && is_array($cache_scheme[$handler_name])) {
			foreach ($cache_scheme[$handler_name] as $param) {
				$param = fn_strtolower(str_replace('%', '', $param));
				if (isset($storage[$param])) {
					$additional_level .= '|' . $param . '=' . md5(serialize($storage[$param]));
				}
			}
		}

		return $additional_level;
	}

	/**
	 * Removes compiled block templates
	 * @return bool
	 */
	public static function delete_templates_cache()
	{
		static $is_deleted = false;
		
		if (!$is_deleted) {

			// mark cache as outdated
			Registry::set_changed_tables('bm_blocks');
			// run cache routines
			Registry::save();

			$is_deleted = true;
		}

		return $is_deleted;
	}

	/**
	 * Assigns block properties data to template
	 * @param array $block Block data
	 */
	private static function _assign_block_settings($block)
	{
		if (isset($block['properties']) && is_array($block['properties'])) {
			foreach ($block['properties'] as $name => $value) {
				Registry::get_view()->assign($name, $value);
			}
		}

	}

	/**
	 * Returns customer skin path
	 * @static
	 * @return string Path to customer skin folder
	 */
	public static function get_customer_skin_path()
	{
		return fn_get_skin_path('[skins]/[skin]/customer/', 'customer');
	}

	/**
	 * Returns skin path for different areas
	 * @static
	 * @param string $area Area ('A' for admin or 'C' for custom
	 * @return string Path to skin folder
	 */
	private static function _get_skin_path($area = 'C')
	{
		$skin_path = '';

		if ($area == 'A') {
			$skin_path = fn_get_skin_path('[skins]/[skin]/admin/views/block_manager/render/', 'admin') ;
		} elseif ($area == 'C') {
			$skin_path = self::get_customer_skin_path() . 'views/block_manager/render/';
		}

		return $skin_path;
	}

}

?>
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

if ( !defined('AREA') )	{ die('Access denied');	}

class SmartyEngine_Core extends Smarty
{
		var $a = array();
	var $plugins_dir = array(SMARTY_CUSTOM_PLUGINS, 'plugins');
	var $compiler_file = SMARTY_CUSTOM_CLASS;
	var $compiler_class = 'SmartyEngine_Compiler';
	var $lang_code = CART_LANGUAGE;
	var $company_id = null;
	var $skin_paths = array();
	
	var $disallowed_modifiers = array('exec', 'passthru', 'shell_exec', 'system', 'proc_open', 'popen', 'parse_ini_file', 'show_source');

	function __construct()
	{
		if (!Registry::get('config.tweaks.allow_php_in_templates')) {
			if (!empty($this->disallowed_modifiers)) {
				foreach ($this->disallowed_modifiers as $modifier) {
					$this->register_modifier($modifier, 'print_r');
				}
			}
		}
	}

	function _secure_include($params, $smarty)
	{
		if ($this->debugging && fn_basename($params['smarty_include_tpl_file']) == 'debug.tpl' || $params['smarty_include_tpl_file'] == 'evaluated template') {
			return true;
		}

		if (isset($params['smarty_include_vars']['skin_area']) && $params['smarty_include_vars']['skin_area'] == 'customer') {
			$path = Bm_RenderManager::get_customer_skin_path() . $params['smarty_include_tpl_file'];
			$path = realpath($path);
		} else {
			$path = str_replace($this->template_dir . '/', '', $params['smarty_include_tpl_file']);
			$path = realpath($this->template_dir . '/' . $path);
		}

		if ($path === false) {
			echo str_replace('[file]', $this->template_dir . '/' . $params['smarty_include_tpl_file'], fn_get_lang_var('unable_to_read_resource'));
			
			return false;
		}

		return true;
	}

	function _smarty_include($params)
	{
		// Substitute current skin area
		$_skin_name = ($this->_tpl_vars['skin_area'] == 'mail' || $this->_tpl_vars['skin_area'] == 'customer') ? Registry::get('settings.skin_name_customer') : Registry::get('config.skin_name');
		
		$area = empty($params['smarty_include_vars']['skin_area']) ? $this->_tpl_vars['skin_area'] : $params['smarty_include_vars']['skin_area'];

		$skin_path = fn_get_skin_path('[skins]/[skin]', $area, $this->company_id);
		
		$this->template_dir = $skin_path . '/' . $area;

		if (!$this->_secure_include($params, $this)) {
			return false;
		}
		
		if ($this->debugging) {
			$_params = array();
			require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
			$debug_start_time = smarty_core_get_microtime($_params, $this);
			$this->_smarty_debug_info[] = array(
				'type'      => 'template',
				'filename'  => $params['smarty_include_tpl_file'],
				'depth'     => ++$this->_inclusion_depth
			);
			$included_tpls_idx = count($this->_smarty_debug_info) - 1;
		}

		// Extract array with parameters
		if (!empty($params['smarty_include_vars']['params_array'])) {
			foreach ($params['smarty_include_vars']['params_array'] as $k => $v) {
				$this->_tpl_vars[$k] = $v;
			}
			unset($params['smarty_include_vars']['params_array']);
		}

		// Get customization mode info
		if ($this->customization) {
			$this->_smarty_customization_info[] = array('filename' => $params['smarty_include_tpl_file'], 'depth' => ($this->debugging ? $this->_inclusion_depth : ++$this->_inclusion_depth));
		}

		$this->_tpl_vars = array_merge($this->_tpl_vars, $params['smarty_include_vars']);

		// Load addons if necessary
		if (empty($params['smarty_include_vars']['skip_addon_check']) && strpos($params['smarty_include_tpl_file'], 'addons/') === 0) {
			$path_array = explode('/', $params['smarty_include_tpl_file']);
			if (fn_load_addon($path_array[1]) == false) {
				return false;
			}
		}

			
		$this->_tpl_vars['images_dir'] = fn_html_escape(Registry::get('config.full_host_name') . Registry::get('config.current_path') . '/' . (str_replace(DIR_ROOT . '/', '', $skin_path)) . '/' . $this->_tpl_vars['skin_area'] . '/images');
		$this->_tpl_vars['skin_dir'] = fn_html_escape(Registry::get('config.full_host_name') . Registry::get('config.current_path') . '/' . (str_replace(DIR_ROOT . '/', '', $skin_path)) . '/' . $this->_tpl_vars['skin_area']);

		// config vars are treated as local, so push a copy of the
		// current ones onto the front of the stack
		array_unshift($this->_config, $this->_config[0]);

		$_smarty_compile_path = $this->_get_compile_path($params['smarty_include_tpl_file']);

		$_is_compiled = $this->_is_compiled($params['smarty_include_tpl_file'], $_smarty_compile_path);

		if (!$_is_compiled) {
			// compiled templates were removed, so check the cache, in case it was not cleared.
			Bm_RenderManager::delete_templates_cache();
		}

		if ($_is_compiled || $this->_compile_resource($params['smarty_include_tpl_file'], $_smarty_compile_path)) {
			include($_smarty_compile_path);
		}

		// pop the local vars off the front of the stack
		array_shift($this->_config);

		if ($this->debugging) {
			// capture time for debugging info
			$_params = array();
			require_once(SMARTY_CORE_DIR . 'core.get_microtime.php');
			$this->_smarty_debug_info[$included_tpls_idx]['exec_time'] = smarty_core_get_microtime($_params, $this) - $debug_start_time;
		} else {
			$this->_inclusion_depth--;
		}

		if ($this->caching) {
			$this->_cache_info['template'][$params['smarty_include_tpl_file']] = true;
		}
	}

	function init_dirs($company_id = null)
	{
		$this->company_id = $company_id;

		// update paths for new company
		$path_id = !empty($company_id) ? $company_id : 0;

		if (empty($this->skin_paths[$path_id])) {

			$customer_skin_path = fn_get_skin_path('[skins]/[skin]', 'customer', $company_id);
			$area_skin_path = (AREA_NAME == 'customer') ? $customer_skin_path : fn_get_skin_path('[skins]/[skin]', AREA_NAME, $company_id);

			$area = $this->_tpl_vars['skin_area'];
			$path = ($area == 'admin') ? $area_skin_path : $customer_skin_path;
			$template_dir = $path . '/' . $area;

			$dir_templates = DIR_CACHE_TEMPLATES;
			$dir_cache = DIR_CACHE_TEMPLATES . 'cache/';
			if (PRODUCT_TYPE == 'ULTIMATE' && !empty($company_id)) {
				$dir_templates .= DIR_STORES . $company_id . '/';
				$dir_cache .= DIR_STORES . $company_id . '/';
			}

			$compile_dir = $dir_templates . $area . (defined('SKINS_PANEL') || PRODUCT_TYPE == 'ULTIMATE' ? '/' . Registry::get('config.skin_name') : '');
			$cache_dir = $dir_cache . $area . (defined('SKINS_PANEL') || PRODUCT_TYPE == 'ULTIMATE' ? '/' . Registry::get('config.skin_name') : '');
			$this->skin_paths[$path_id] = array (
				'customer_skin_path' => $customer_skin_path,
				'skin_path' => $area_skin_path,
				'template_dir' => $template_dir,
				'config_dir' => $template_dir,
				'secure_dir' => $template_dir,
				'images_dir' => Registry::get('config.full_host_name') . Registry::get('config.current_path') . (str_replace(DIR_ROOT, '', $area_skin_path)) . '/' . $area . '/images',
				'compile_dir' => $compile_dir,
				'cache_dir' => $cache_dir,
				'manifest' => fn_get_manifest($area, CART_LANGUAGE, $company_id),
			);
		}

		$skin_paths = $this->skin_paths[$path_id];

		$this->template_dir = $skin_paths['template_dir'];
		$this->config_dir = $skin_paths['config_dir'];
		$this->secure_dir = $skin_paths['secure_dir'];
		$this->compile_dir = $skin_paths['compile_dir'];
		$this->cache_dir = $skin_paths['cache_dir'];

		$this->assign('images_dir', $skin_paths['images_dir']);
		$this->assign('customer_skin_path', $skin_paths['customer_skin_path']);

		$this->assign('manifest', $skin_paths['manifest']);

		fn_mkdir($this->compile_dir);
		fn_mkdir($this->cache_dir);

		return true;
	}

	function display($tpl, $to_screen = true, $cache_id = null, $compile_id = null)
	{
		$full_render = !empty($_REQUEST['full_render']) ? $_REQUEST['full_render'] : false;

		if (defined('AJAX_REQUEST') && !$full_render){
			// Decrease amount of templates to parse if we're using ajax request
			$tpl = $tpl == 'index.tpl' ? (defined('PARSE_ALL')? $tpl : $this->get_var('content_tpl')) : $tpl;
		}

		$tpl = fn_addon_template_overrides($tpl, $this);

		// Pass navigation to templates
		$this->assign('navigation', Registry::get('navigation'));
		
		if ($to_screen == true) {
			if (ini_get('zlib.output_compression') == '' && strpos(@$_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false && !defined('AJAX_REQUEST')) {
				//ob_start('ob_gzhandler');
			}
			parent::display($tpl, $cache_id, $compile_id);
		} else {
			return $this->fetch($tpl, $cache_id, $compile_id);
		}
	}

	function display_mail($tpl, $to_screen, $company_id = null, $lang_code = CART_LANGUAGE)
	{


		$original_lang_code = $this->getLanguage();

		$this->setLanguage($lang_code);

		$result = true;

		if ($to_screen == true) {
			parent::display($tpl);
		} else {
			$result = $this->fetch($tpl);
		}

		$this->setLanguage($original_lang_code);



		return $result;
	}

	//
	// Overload base method to forbid array assigning
	//
	function assign($tpl_var, $value = null, $escape = true)
	{
		fn_update_lang_objects($tpl_var, $value);

		if (is_array($tpl_var)){
			$this->trigger_error("Assigning by array is not implemented");
		} else {
			if ($tpl_var != '') {
				$this->_tpl_vars[$tpl_var] = ($escape) ? fn_html_escape($value) : $value;
			}
		}
	}

    function _parse_resource_name(&$params)
    {
		$params['resource_name'] = fn_addon_template_overrides($params['resource_name'], $this);

		return parent::_parse_resource_name($params);

    }


	// ----------- Custom methods --------------------------


	//
	// Get template variable
	//
	function get_var($var, $default = NULL)
	{
		if (!isset($this->_tpl_vars[$var])) {
			$this->_tpl_vars[$var] = ($default === NULL) ? array() : $default;
		}

		return fn_html_escape($this->_tpl_vars[$var], true);
	}

	function setLanguage($lang_code)
	{
		$this->lang_code = $lang_code;
	}

	function getLanguage()
	{
		return $this->lang_code;
	}

	//
	// Checks if inline blocks are changed and parent template should be recompiled
	//
	function check_inline_blocks($resources = array())
	{
		$result = false;
		foreach ($resources as $res => $ts) {
			$_smarty_compile_path = $this->_get_compile_path($res);

			if (!file_exists($_smarty_compile_path) || $ts < filemtime($this->template_dir . '/' . $res)) {
				if ($this->_is_compiled($res, $_smarty_compile_path) == false) {
					$this->_compile_resource($res, $_smarty_compile_path);
				}
				$result = true;
			}
		}

		return $result;
	}

	//
	// This filter wraps templates which don't have {include} tags inside into ob_start/ob_end_flush functions
	// to speed-up content displaying
	//
	function prefilter_output_buffering($content, &$compiler)
	{

		if (strpos($content, '{include ') === false) {
			return "{php} ob_start(); {/php}" . $content . "{php} ob_end_flush(); {/php}";
		}

		return $content;
	}

	//
	// This filter adds unique field to all forms to protect from CSRF attacks
	//
	function outputfilter_security_hash($content, &$compiler)
	{
		$content = preg_replace('/<input type="hidden" name="security_hash".*?>/i', '', $content);
		$hash = fn_generate_security_hash();
		$content = str_replace('</form>', '<input type="hidden" name="security_hash" class="cm-no-hide-input" value="'. $hash .'" /></form>', $content);

		return $content;
	}
	
	//
	// This filter removes all {php} code.
	//
	function prefilter_security_exec($content, &$compiler)
	{
		$content = preg_replace('/\{\s*?\/?php\s*?\}/isSU', '', $content);
		$content = preg_replace('/\{\s*?include_php.*?\}/isSU', '', $content);

		return $content;
	}



	function prefilter_webdriver($content, &$compiler)
	{
		$href_expr = '/<a\s[^>]+>/is';

		if (preg_match_all($href_expr, $content, $matches)) {
			foreach ($matches[0] as $link) {
				$new_link = preg_replace('/<a\s/is', '<a data-template="' . $compiler->_current_file . '" ', $link);
				$content = str_replace($link, $new_link, $content);
			}
		}

		return $content;
	}

	function outputfilter_webdriver($content, &$compiler)
	{
		$href_expr = '/<a\s[^>]+>/is';

		if (preg_match_all($href_expr, $content, $matches)) {
			foreach ($matches[0] as $link) {
				if (preg_match('/href=(?:\'|")([^"\']+)(?:\'|")/is', $link, $matches)) {
					$href = empty($matches[1]) ? '' : $matches[1];
				} else {
					$href = '';
				}

				if (preg_match('/data-template="([^"]+)"/is', $link, $matches)) {
					$template = $matches[1];
				} else {
					$template = '';
					$link = '';
				}
				
				if (!preg_match('/data-webdriver="([^"]+)"/is', $link)) {
					$new_link = preg_replace('/<a\s/is', '<a data-webdriver="' . md5($template . $href) . '" ', $link);
					$content = str_replace($link, $new_link, $content);
				}
			}
		}

		return $content;
	}
	


	//
	// This filter adds unique field to all forms to protect from CSFR attacks
	//
	function prefilter_form_validator($content, &$compiler)
	{
		static $it = 0;
		if (strpos($content, '<form') !== false) {
			$content = str_replace('<form', '{capture name="fc"}<form', $content);
			$content = str_replace('</form>', '</form>{/capture}{$smarty.capture.fc|store_validator}', $content);
		}
		
		return $content;
	}

	//
	// This filter gets all available language variables in templates and puts their retrieving to the template start
	//
	function postfilter_translation($content, &$compiler)
	{
		if (preg_match_all('/fn_get_lang_var\(\'(\w*)\', \$this->getLanguage\(\)\)/i', $content, $matches)) {
			return "<?php\nfn_preload_lang_vars(array('" . implode("','", $matches[1]) . "'));\n?>\n" . $content;
		}

		return $content;
	}

	function outputfilter_translate_wrapper($content, &$compiler)
	{
		$pattern = '/\<(input|img|div)[^>]*?(\[lang name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/lang\])[^>]*?\>/';
		if (preg_match_all($pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$phrase_replaced = str_replace($matches[2][$k], $matches[5][$k], $matches[0][$k]);
				if (strpos($m, 'class="') !== false) {
					$class_added = str_replace('class="', 'class="cm-translate lang_' . $matches[3][$k] . $matches[4][$k] . ' ', $phrase_replaced);
				} else {
					$class_added = str_replace($matches[1][$k], $matches[1][$k] . ' class="cm-translate lang_' . $matches[3][$k] . $matches[4][$k] . '"', $phrase_replaced);
				}

				if ($matches[1][$k] == 'div') {
					$content = str_replace($matches[0][$k], $phrase_replaced, $content);
				} else {
					$content = str_replace($matches[0][$k], $class_added, $content);
				}
			}
		}

		$pattern = '/(\<(textarea|option)[^<]*?)\>(\[lang name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/lang\])[^>]*?\>/is';
		if (preg_match_all($pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$phrase_replaced = str_replace($matches[3][$k], $matches[6][$k], $matches[0][$k]);
				if (strpos($m, 'class="') !== false) {
					$class_added = str_replace('class="', 'class="cm-translate lang_' . $matches[4][$k] . $matches[5][$k] . ' ', $phrase_replaced);
				} else {
					$class_added = str_replace('<' . $matches[2][$k], '<' . $matches[2][$k] . ' class="cm-translate lang_' . $matches[4][$k] . $matches[5][$k] . '"', $phrase_replaced);
				}
				$content = str_replace($matches[0][$k], $class_added, $content);
			}
		}

		$pattern = '/<title>(.*?)<\/title>/is';
		$pattern_inner = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/is';
		preg_match($pattern, $content, $matches);
		$phrase_replaced = $matches[0];
		$phrase_replaced = preg_replace($pattern_inner, '$4', $phrase_replaced);
		$content = str_replace($matches[0], $phrase_replaced, $content);

		// remove translation tags from elements attributes
		$pattern = '/(\<[^<>]*\=[^<>]*)(\[lang name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/lang\])[^<>]*?\>/is';
		while (preg_match($pattern, $content, $matches)) {
			$phrase_replaced = preg_replace($pattern_inner, '$4', $matches[0]);
			$content = str_replace($matches[0], $phrase_replaced, $content);
		}


		$pattern = '/(?<=>)[^<]*?\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/is';
		$pattern_inner = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\]((?:(?>[^\[]+)|\[(?!\1[^\]]*\]))*?)\[\/\1\]/is';
		$replacement = '<font class="cm-translate lang_$2$3">$4</font>';
		while (preg_match($pattern, $content, $matches)) {
			$phrase_replaced = $matches[0];
			while (preg_match($pattern_inner, $phrase_replaced)) {
				$phrase_replaced = preg_replace($pattern_inner, $replacement, $phrase_replaced);
			}
			$content = str_replace($matches[0], $phrase_replaced, $content);
		}

		$pattern = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/';
		$replacement = '$4';
		$content = preg_replace($pattern, $replacement, $content);

		return $content;
	}


	function prefilter_form_tooltip($content, &$compiler)
	{
		$pattern = '/\<label[^>]*\>.*(\{\$lang\.([^\}]+)\}[^:\<]*).*\<\/label\>/';
		
		if (preg_match_all($pattern, $content, $matches)) {
			
			$cur_templ = $compiler->_current_file;

			$template_pattern = '/([^\/\.]+)/';
			$template_name = '';
			$ignored_names = array('tpl');
			
			if (preg_match_all($template_pattern, $cur_templ, $template_matches)) {
				foreach ($template_matches[0] as $k => $m) {
					if (!in_array($template_matches[1][$k], $ignored_names)) {
						$template_name .= $template_matches[1][$k] . '_';
					}
				}
			}

			$template_pref = 'tt_' . $template_name;
			$template_tooltips = fn_get_lang_vars_by_prefix($template_pref);

			foreach ($matches[0] as $k => $m) {
				$field_name = $matches[2][$k];
				
				preg_match("/(^[a-zA-z0-9][a-zA-Z0-9_]*)/", $field_name, $name_matches);
				if (@strlen($name_matches[0]) != strlen($field_name)) {
					continue;
				}
				
				$label = $matches[1][$k];

				$template_lang_var = $template_pref . $field_name;
				$common_lang_var = 'ttc_' . $field_name;
				
				if (isset($_REQUEST['stt'])) {
					$template_text = isset($template_tooltips[$template_lang_var]) ? '{$lang.' . $template_lang_var . '}' : '';
					$common_tip = fn_get_lang_var($common_lang_var);
					$common_text = '';
					if ($common_tip != '_' . $common_lang_var) {
						$common_text = '{$lang.' . $common_lang_var . '}';
					}

					$tooltip_text = sprintf("%s: %s <br/> %s: %s", $common_lang_var, $common_text, $template_lang_var, $template_text);
					$tooltip = '{capture name="tooltip"}' . $tooltip_text . '{/capture}{include file="common_templates/tooltip.tpl" tooltip=$smarty.capture.tooltip"}';
				} else {
					if (isset($template_tooltips[$template_lang_var])) {
						$tooltip_text = '$lang.' . $template_lang_var;
					} else {
						$tooltip = fn_get_lang_var($common_lang_var);
						if ($tooltip == '_' . $common_lang_var || empty($tooltip)) {
							continue;
						}
						$tooltip_text = '$lang.' . $common_lang_var;
					}


					$tooltip = '{include file="common_templates/tooltip.tpl" tooltip=' . $tooltip_text . '}';
				}
				$tooltip_added = str_replace($label, $label . $tooltip, $matches[0][$k]);

				$content = str_replace($matches[0][$k], $tooltip_added, $content);				
			}
		}

		return $content;
	}

	function prefilter_hook($content, &$compiler)
	{
		static $hooks_cache = array();
		$pattern = '/\{hook( name="([^"}]+)")\}((?:(?>[^\{]+)|\{(?!hook[^\}]*\}))*?)\{\/hook\}/is';
		$cur_templ = $compiler->_current_file;
		$positions = array('pre', 'post', 'override');
		$tmp = array();
		$cnt = 1000;

		$area = $this->_tpl_vars['skin_area'];

		if (!isset($hooks_cache[$area]['_filled'])) {
			$hooks_cache[$area]['_filled'] = 'Y';
			foreach (Registry::get('addons') as $i => $v) {
				$dir = $this->template_dir . '/addons/' . $i . '/hooks/';
				$hooks_cache[$area][$i] = array_flip(fn_get_dir_contents($dir, true, true, 'tpl', '', true));
			}
		}

		while (preg_match($pattern, $content, $matches)) {
			$cnt--;
			$tmp[] = $cnt;
			$override_prefix = '{tmp_prefilter#' . $cnt . $matches[1] .'}';
			$close_tag = '{/tmp_prefilter#' . $cnt .'}';
			$override_suffix = $close_tag;
			$hook_body = $matches[3];
			$tpl_name = str_replace(':', '/', $matches[2]);
			foreach (Registry::get('addons') as $i => $v) {
				foreach ($positions as $pos) {
					$_tpl = $tpl_name . '.' . $pos . '.tpl';
					$tpl = 'addons/' . $i . '/hooks/' . $_tpl;

					if (isset($hooks_cache[$area][$i][$_tpl]) && strpos($cur_templ, $tpl) === false) {

						if ($pos == 'pre') {
							$hook_body = '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '"}{/if}' . $hook_body;
						} elseif ($pos == 'post') {
							$hook_body .= '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '"}{/if}';
						} elseif ($pos == 'override') {
							$override_prefix = '{if $addons.' . $i . '.status == "A"}{include file="' . $tpl . '" assign="addon_content"}{else}{assign var="addon_content" value=""}{/if}{if $addon_content|trim}{$addon_content}{else}' . $override_prefix;
							$override_suffix .= '{/if}';
						}
					}
				}
			}
			$content = preg_replace($pattern, $override_prefix . $hook_body . $override_suffix, $content, 1);
		}

		foreach ($tmp as $key) {
			$pattern = '/tmp_prefilter#' . $key . '/is';
			$content = preg_replace($pattern, 'hook', $content);
		}

		return $content;
	}

	function prefilter_template_wrapper($content, &$compiler)
	{
		static $skin_path;

		if (empty($skin_path)) {
			// Substitute current skin area
			$_skin_name = ($this->_tpl_vars['skin_area'] == 'mail' || $this->_tpl_vars['skin_area'] == 'customer') ? Registry::get('settings.skin_name_customer') : Registry::get('config.skin_name');	
			$skin_path = DIR_SKINS . $_skin_name . '/' . $this->_tpl_vars['skin_area'] . '/';
		}

		$cur_templ = fn_addon_template_overrides($compiler->_current_file, $this);
		$cur_templ = str_replace(Bm_RenderManager::get_customer_skin_path(), '', $cur_templ);

		$ignored_template = array(
			'index.tpl',
			'common_templates/pagination.tpl',
			'views/categories/components/menu_items.tpl',
			'customer/views/block_manager/render/location.tpl',
			'customer/views/block_manager/render/container.tpl',
			'customer/views/block_manager/render/grid.tpl',
			'customer/views/block_manager/render/block.tpl',

		);

		if (!in_array($cur_templ, $ignored_template)) {
			$content = '{capture name="template_content"}' . $content . '{/capture}{if $smarty.capture.template_content|trim}{if $auth.area == "A"}<span class="cm-template-box" template="' . $cur_templ . '" id="{set_id name=' . $cur_templ . '}"><img class="cm-template-icon hidden" src="{$images_dir}/icons/layout_edit.gif" width="16" height="16" alt="" />{$smarty.capture.template_content}<!--[/tpl_id]--></span>{else}{$smarty.capture.template_content}{/if}{/if}';
		}

		return $content;
	}

	function outputfilter_template_ids($content, &$compiler)
	{
		$pattern = '/(\<head\>.*?)(\<span[^<>]*\>|\<\/span\>|\<img[^<>]*\>|\<!--[\w]*--\>)+?(.*?\<\/head\>)/is';
		while (preg_match($pattern, $content, $match)) {
			$content = str_replace($match[0], $match[1] . $match[3], $content);
		}
		$pattern = '/\<span[^<>]*\>|\<\/span\>|\<img[^<>]*\>|\<!--[\w]*--\>/is';
		$glob_pattern = '/\<script[^<>]*\>.*?\<\/script\>/is';
		if (preg_match_all($glob_pattern, $content, $matches)) {
			foreach ($matches[0] as $k => $m) {
				$replace_script = preg_replace($pattern, '', $matches[0][$k]);
				$content = str_replace($matches[0][$k], $replace_script, $content);
			}
		}

		static $template_ids;
		if (!isset($template_ids)) {
			$template_ids = array();
		}

		$pattern = '/\[(tpl_id) ([^ ]*)\]((?:(?>[^\[]+)|\[(?!\1[^\]]*\]))*?)\[\/\1\]/is';
		while (preg_match($pattern, $content, $matches)) {
			$id = 'te' . md5($matches[2]);
			if (empty($template_ids[$matches[2]])) {
				$template_ids[$matches[2]] = 1;
			} else {
				$template_ids[$matches[2]]++;
				$id .= '_' . $template_ids[$matches[2]];
			}
			$content = preg_replace($pattern, $id . '${3}' . $id, $content, 1);
		}

		return $content;
	}

	//
	// This filter include templates which have no {include} tags inside to the parent template
	//
	function prefilter_inline($source, &$compiler)
	{
		$params = array(
			'smarty_include_tpl_file' => $compiler->_current_file
		);

		if (!$this->_secure_include($params, $this)) {
			return false;
		}

		$compiler->_inline_cache = array();
		$output = preg_replace_callback('!' . preg_quote($this->left_delimiter, '!') . 'include (.*)' . preg_quote($this->right_delimiter, '!') . '!Us', array($compiler, '_prefilter_inline_callback'), $source);
		
		if (!empty($compiler->_inline_cache)) {
			$output = "{php}\n
				\$rname = !empty(\$resource_name) ? \$resource_name : \$params['smarty_include_tpl_file'];
				if (\$this->compile_check && empty(\$inline_no_check[\$rname]) && \$this->is_cached(\$rname)) {
					if (\$this->check_inline_blocks(" . var_export($compiler->_inline_cache, true) .")) {
						\$_smarty_compile_path = \$this->_get_compile_path(\$rname);
						\$this->_compile_resource(\$rname, \$_smarty_compile_path);
						\$inline_no_check[\$rname] = true;
						include \$_smarty_compile_path;
						return;
					}
				}
			{/php}" . $output;

			$compiler->_inline_cache = array();
		}

		return $output;
	}
}
?>
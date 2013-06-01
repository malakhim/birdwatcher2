<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_function_script($params, &$smarty)
{
	static $scripts = array();
	static $packer_loaded = false;

	/*if (!empty($params['include'])) {
		return implode("\n", $scripts);
	}*/

	if (!isset($scripts[$params['src']])) {
		$path = Registry::get('config.current_path');
		if (Registry::get('config.tweaks.js_compression') == true && strpos($params['src'], 'lib/') === false) {
			if (!file_exists(DIR_CACHE_TEMPLATES . $params['src'])) {
				if ($packer_loaded == false) {
					include_once(DIR_LIB . 'packer/class.JavaScriptPacker.php');
					$packer_loaded = true;
				}

				fn_mkdir(dirname(DIR_CACHE_TEMPLATES . $params['src']));
				$packer = new JavaScriptPacker(fn_get_contents(DIR_ROOT . '/' . $params['src']));
				fn_put_contents(DIR_CACHE_TEMPLATES . $params['src'], $packer->pack());
			}
			$path = Registry::get('config.cache_path');
		}

		$path = fn_html_escape($path);
		$scripts[$params['src']] = '<script type="text/javascript"' . (!empty($params['class']) ? ' class="' . $params['class'] . '" ' : '') . ' src="' . Registry::get('config.full_host_name') . $path . '/' . $params['src'] . '"></script>';

		// If output is captured, don't print script tag in the buffer, it will be printed directly to the screen

		if (!empty($smarty->_in_capture) && Registry::is_exist('block_cache_generate') != true) {
			$buff = array_pop($smarty->_in_capture);
			$smarty->_in_capture[] = $buff;
			$smarty->_scripts[$buff][] = $scripts[$params['src']];
			return '';
		}

		return $scripts[$params['src']];
	}
}


?>

<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_function_join_css($params, &$smarty)
{
	if (!empty($params['content'])) {
		if (Registry::get('config.tweaks.join_css') != true) {
			return $params['content'];
		}
	
		Registry::set('runtime.join_css.css_files', array());

		$code_pattern = '/(<!--\[if [lte ]{0,4}[\w ]+\]>)(.*?)(<!\[endif\]-->)/Uis';
		$res = preg_replace_callback($code_pattern, create_function('$m', 'return $m[1] . base64_encode($m[2]) . $m[3];'), $params['content']); // code
		
		$res = preg_replace_callback('/<link ([^>]+)>\s*/i', 'smarty_function_join_css_tag', $res);

		$res = preg_replace_callback($code_pattern, create_function('$m', 'return $m[1] . base64_decode($m[2]) . $m[3];'), $res); // decode
		
		$files = Registry::get('runtime.join_css.css_files');
		
		$dir = 'css/';
		$filename = 'style_' . fn_strtolower(AREA) . '_' . md5(serialize($files)) . '.css';
		
		$file = $dir . $filename;
		$css_source_file = Registry::get('config.cache_path') . '/' . $file;
		if (!file_exists(DIR_CACHE_TEMPLATES . $file)) {
			fn_mkdir(DIR_CACHE_TEMPLATES . $dir);
			$contents = '';
			foreach ($files as $f) {
				$f = str_replace(Registry::get('config.http_path'), '', $f);
				$contents .= smarty_function_join_css_get_contents(DIR_ROOT . $f, $css_source_file) . "\n\n";
			}

			fn_put_contents(DIR_CACHE_TEMPLATES . $file, $contents);
		}
		
		$res = '<link href="' . $css_source_file . '" rel="stylesheet" type="text/css" />' . "\n" . $res;
		
		return $res;
	}
}

function smarty_function_join_css_tag($data)
{
	$files =& Registry::get('runtime.join_css.css_files');
	
	if (preg_match('/type=(?:"|\')text\/css(?:"|\')/i', $data[1]) && preg_match('/href=(?:"|\')([\w\d\-.\/]+)(?:"|\')/i', $data[1], $href) && !preg_match('/media=(?:"|\')print(?:"|\')/i', $data[1])) {
		$files[] = $href[1];
		return '';
	} else {
		return $data[0];
	}
}

function smarty_function_join_css_get_contents($filename, $source)
{
	Registry::set('runtime.join_css.source', $source);
	$contents = fn_get_contents($filename);

	$target_dir = dirname(str_replace(DIR_ROOT, '', $filename)) . '/';
	$source = dirname(str_replace(Registry::get('config.current_path'), '', $source));
	
	Registry::set('runtime.join_css.css_link', implode('/', array_fill(0, substr_count($source, '/'), '..')) . $target_dir);
	Registry::set('runtime.join_css.css_target_dir', dirname($filename) . '/');

	$contents = preg_replace('/url\((\'|")?(?!data\:)/i', 'url($1' . Registry::get('runtime.join_css.css_link'), $contents);

	$contents = preg_replace_callback('/@import\s+url\((?:"|\')([\w\d\-.\/]+)(?:"|\')\);/i', create_function('$m', '
		$file = Registry::get(\'runtime.join_css.css_target_dir\') . str_replace(Registry::get(\'runtime.join_css.css_link\'), \'\', $m[1]);
		return smarty_function_join_css_get_contents($file, Registry::get(\'runtime.join_css.source\')) . "\n\n";
	'), $contents);
	
	return $contents;
}

?>
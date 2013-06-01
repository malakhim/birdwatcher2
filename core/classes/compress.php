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


if (!defined('AREA') ) { die('Access denied'); }

class Compress
{
	private static $config;

	function __construct($config)
	{
		self::$config = $config;
		ob_start();
	}

	function __destruct()
	{
		$text = ob_get_clean();
		$config = self::$config;

		if (!empty($config['compress_js'])) {
			$text = self::compressJs($text);
		}

		if (!empty($config['compress_css'])) {
			$text = self::compressCss($text);
		}

		echo $text;
	}

	public static function compressJs($text)
	{
		$output = '';

		$scripts_regexp = '/<script[^>]+src="(.*?)"/isS';
		$scripts = preg_match_all($scripts_regexp, $text, $matches);

		if (!empty($matches[1])) {
			$tmp_name = md5(implode('', $matches[1])) . '.js';

			$text = preg_replace('/<script[^>]+><\/script>/isS' , '', $text);

			if (is_readable(self::$config['cache_path'] . '/' . $tmp_name)) {
				$text = preg_replace('/<head>/' , '<head><script type="text/javascript" src="' . self::$config['http_cache_path'] . '/' . $tmp_name . '"></script>', $text);

				return $text;
			}

			foreach ($matches[1] as $script_path) {
				$path = self::$config['path'] . str_replace(self::$config['http_path'], '', $script_path);

				if (is_readable($path)) {
					$output .= file_get_contents($path);
				}
			}
			
			file_put_contents(self::$config['cache_path'] . '/' . $tmp_name, $output);
			$text = preg_replace('/<head>/' , '<head><script type="text\/javascript" src="' . self::$config['http_cache_path'] . '/' . $tmp_name . '"></script>', $text);
		}


		return $text;
	}
}
?>
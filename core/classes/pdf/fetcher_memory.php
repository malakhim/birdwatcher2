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

require(DIR_LIB . 'html2pdf/config.inc.php');
require(DIR_LIB . 'html2pdf/pipeline.factory.class.php');

class Pdf_FetcherMemory extends Fetcher {
	var $base_path;
	var $content;

	function Pdf_FetcherMemory($content, $base_path)
	{
		$this->content   = $content;
		$this->base_path = $base_path;
	}

	function get_data($url) 
	{
		if (is_numeric($url)) {
			return new FetchedDataURL($this->content[$url], array(), "");
		} else {
			if (substr($url,0,8) == 'file:///') {
				$url = substr($url, 10);
				if (defined('IS_WINDOWS')) {
					$url = substr($url, 1);
				}
			}

			if (strpos($url, Registry::get('config.http_location')) === 0) {
				$file = str_replace(Registry::get('config.http_location'), DIR_ROOT, $url);
			} elseif (strpos($url, Registry::get('config.https_location')) === 0) {
				$file = str_replace(Registry::get('config.https_location'), DIR_ROOT, $url);
			}

			if (!empty($file) && file_exists($file)) {
				$result = fn_get_contents($file);
			} else {
				list(, $result) = fn_http_request('GET', $url);
			}

			return new FetchedDataURL($result, array(), "");
		}
	}

	function get_base_url() {
		return $this->base_path;
	}
}

?>
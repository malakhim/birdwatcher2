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


if ( !defined('AREA') ) { die('Access denied'); }

/**
 * Check if mod_rewrite is active and clean up templates cache
 */
function fn_settings_actions_addons_seo(&$new_value, $old_value)
{
	if ($new_value == 'A') {
		$result = fn_http_request('GET', Registry::get('config.http_location') . '/catalog.html?version');
		if (strpos($result[0]['RESPONSE'], '200 OK') === false) {
			$new_value = 'D';
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_seo_urls_disabled'));
		}
	}

	fn_clear_cache();

	return true;
}

?>
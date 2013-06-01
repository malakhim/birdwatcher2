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


if ($mode == 'update' || $mode == 'install' || $mode == 'uninstall' ) {
	if ($_REQUEST['addon'] == 'seo') {
		$msg = fn_get_lang_var('text_se_seo_settings_notice');
	}

} elseif ($mode == 'update_status') {
	if ($_REQUEST['id'] == 'seo') {
		$msg = fn_get_lang_var('text_se_seo_settings_notice');
	}
}

if (!empty($msg)) {
	if (fn_se_is_registered() == true) {
		$msg = str_replace('[link]', fn_url('addons.update?addon=searchanise'), $msg);
		fn_set_notification('W', fn_get_lang_var('notice'), $msg);
	}
}

if ($mode == 'uninstall' && $_REQUEST['addon'] == 'searchanise') {
	fn_se_send_addon_status_request('disabled');
}

?>
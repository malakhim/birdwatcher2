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

function fn_settings_actions_addons_searchanise($new_status, $old_status, $on_install)
{
	if (!empty($on_install)) {
		return;
	}

	if ($new_status == 'A') {
		if (fn_se_is_registered() == true) {
			//not first install
			fn_se_send_addon_status_request('enabled');

			fn_se_signup();
			fn_se_queue_import();
		}

	} elseif ($new_status == 'D') {
		fn_se_send_addon_status_request('disabled');
	}

	return true;
}

?>
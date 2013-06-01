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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'send') {
		if (Registry::get('settings.Image_verification.use_for_send_to_friend') == 'Y' && fn_image_verification('send_to_friend', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
			fn_save_post_data();

			return array(CONTROLLER_STATUS_REDIRECT);
		}

		if (!empty($_REQUEST['send_data']['to_email'])) {
			$view_mail->assign('send_data', $_REQUEST['send_data']);
			$lnk = fn_query_remove($_REQUEST['redirect_url'], 'selected_section');
			$http_path = Registry::get('config.http_path');
			if (!empty($http_path) && strpos($lnk, $http_path) !== false) {
				$lnk = str_replace(Registry::get('config.http_path'), '', $lnk);
			} else {
				$lnk = '/' . ltrim($lnk, '/');
			}
			$view_mail->assign('link', Registry::get('config.http_location') . $lnk);

			$from = array(
				'email' => !empty($_REQUEST['send_data']['from_email']) ? $_REQUEST['send_data']['from_email'] : Registry::get('settings.Company.company_users_department'),
				'name' => !empty($_REQUEST['send_data']['from_name']) ? $_REQUEST['send_data']['from_name'] : Registry::get('settings.Company.company_name'),
			);
			if (fn_send_mail($_REQUEST['send_data']['to_email'], $from, 'addons/send_to_friend/mail_subj.tpl', 'addons/send_to_friend/mail.tpl', '', CART_LANGUAGE)) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_email_sent'));
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_no_recipient_address'));
		}

		return array(CONTROLLER_STATUS_REDIRECT);
	}
}

?>
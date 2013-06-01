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

require './init_payment.php';

if (!isset($_REQUEST['intAccountID'])) {
	$order_id = (strpos($_REQUEST['strCartID'], '_')) ? substr($_REQUEST['strCartID'], 0, strpos($_REQUEST['strCartID'], '_')) : $_REQUEST['strCartID'];
	fn_redirect(Registry::get('config.current_location') . "/$index_script?dispatch=payment_notification.notify&payment=mcpe&order_id=$order_id");

} else {
	$pp_response = array();
	$order_id = (strpos($_REQUEST['strCartID'], '_')) ? substr($_REQUEST['strCartID'], 0, strpos($_REQUEST['strCartID'], '_')) : $_REQUEST['strCartID'];

	if (empty($_REQUEST['intStatus'])) {
		$pp_response['order_status'] = 'F';
		$pp_response['reason_text'] = fn_get_lang_var('failed');

	} elseif($_REQUEST['intStatus'] == 1) {
		$pp_response['order_status'] = 'P';
		$pp_response['reason_text'] = fn_get_lang_var('order_id') . '-' . $_REQUEST['order_id'];

	} else {
		$pp_response['order_status'] = 'N';
		$pp_response['reason_text'] = fn_get_lang_var('cancelled');
	}

	$pp_response['transaction_id'] = $_REQUEST['intTransID'];

	if (fn_check_payment_script('mcpe.php', $_REQUEST['order_id'])) {
		fn_finish_payment($_REQUEST['order_id'], $pp_response);
	}
}
exit;
?>
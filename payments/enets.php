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

if (defined('PAYMENT_NOTIFICATION')) {

	if ($mode == 'notify') {
		fn_order_placement_routines($_REQUEST['order_id']);
	}

} elseif (empty($processor_data)) {

	if ($_REQUEST['txnRef']) {
		require './init_payment.php';

		$order_id = (strpos($_REQUEST['txnRef'], '_')) ? substr($_REQUEST['txnRef'], 0, strpos($_REQUEST['txnRef'], '_')) : $_REQUEST['txnRef'];
		$pp_response = array();
		$pp_response['order_status'] = ($_REQUEST['status'] == 'succ') ? 'P' : 'F';
		$pp_response['reason_text'] = fn_get_lang_var('order_id') . '-' . $order_id;
		$pp_response['transaction_id'] = '';

		if (fn_check_payment_script('enets.php', $order_id)) {
			fn_finish_payment($order_id, $pp_response, false);
		}

		fn_redirect(Registry::get('config.http_location') . "/$index_script?dispatch=payment_notification.notify&payment=enets&order_id=$order_id");
		exit;
	}

} else {
	if (!defined('AREA') ) { die('Access denied'); }

	$post_address = 'https://www.enets.sg/enets2/enps.do';
	$_order_id = ($order_info['repaid']) ? ($order_id . '_' . $order_info['repaid']) : $order_id;

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="$post_address" name="process">
	<input type="hidden" name="txnRef" value="{$_order_id}">
	<input type="hidden" name="mid" value="{$processor_data['params']['merchantid']}">
	<input type="hidden" name="amount" value="{$order_info['total']}">
	<input type="hidden" name="umapiType" value="lite">
EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'eNPS server', $msg);
echo <<<EOT
	</form>
	<p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
}
exit;
?>
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

if (!defined('AREA')) {
	if (!empty($_REQUEST['OrderID']) && !empty($_REQUEST['HashDigest'])) {
		require './init_payment.php';

		$order_id = (strpos($_REQUEST['OrderID'], '_')) ? substr($_REQUEST['OrderID'], 0, strpos($_REQUEST['OrderID'], '_')) : $_REQUEST['OrderID'];
		//Check hash
		$order_info = fn_get_order_info($order_id);
		$str = 'PreSharedKey=' . $order_info['payment_method']['params']['access_code'] .
			'&MerchantID=' . $order_info['payment_method']['params']['merchant_id'] .
			'&Password=' . $order_info['payment_method']['params']['password'] .
			'&CrossReference=' . $_REQUEST['CrossReference'] .
			'&OrderID=' . $_REQUEST['OrderID'];
		$hash = sha1($str);
		
		if ($hash == $_REQUEST['HashDigest']) {
			//Check the order status to make shure that it wasn't changed
			$request = array();
			$request[] = 'MerchantID=' . $order_info['payment_method']['params']['merchant_id'];
			$request[] = 'Password=' . $order_info['payment_method']['params']['password'];
			$request[] = 'CrossReference=' . $_REQUEST['CrossReference'];

			list($header, $_result) = fn_https_request('POST', 'https://mms.cardsaveonlinepayments.com/Pages/PublicPages/PaymentFormResultHandler.ashx', $request);

			parse_str($_result, $result);
			parse_str(urldecode($result['TransactionResult']), $transaction_result);
			$pp_response = array();
			$pp_response['reason_text'] = 'Reason text: ' . $transaction_result['Message'];
			$pp_response['order_status'] = ($transaction_result['StatusCode'] == '0') ? 'P' : 'F';

			if (!empty($_REQUEST['Message'])) {
				$pp_response['reason_text'] .= 'Message: ' . $_REQUEST['Message'];
			}                   

			$pp_response['transaction_id'] = $_REQUEST['CrossReference'];
			//Place order
			if (fn_check_payment_script('cardsave_hosted.php', $order_id)) {
				fn_finish_payment($order_id, $pp_response);
			}

			fn_redirect(Registry::get('config.current_location') . '/' . Registry::get('config.customer_index') . '?dispatch=payment_notification.notify&payment=cardsave_hosted&order_id=' . $order_id);
		} else {
			die('Access denied!');
		}
	} else {
		die('Access denied');
	}
}

if (defined('PAYMENT_NOTIFICATION')) {
	if ($mode == 'process') {
		//Check the received data
		if (!empty($_REQUEST['OrderID'])) {
			$order_id = intval($_REQUEST['order_id']);
			$status_code = intval($_REQUEST['StatusCode']);
			if ($status_code == '0') {
				$error = '';
				$error_message = '';
				$order_info = fn_get_order_info($order_id);
				if ($_REQUEST['MerchantID'] != $order_info['payment_method']['params']['merchant_id']) {
					$error = 'true';
					$error_message .= 'Incorrect MerchantID\n';
				}
				if (empty($_REQUEST['Amount']) || $_REQUEST['Amount'] != $order_info['total'] * 100) {
					$error = 'true';
					$error_message .= 'Incorrect Price\n';
				}
				if (empty($_REQUEST['CurrencyCode']) || $_REQUEST['CurrencyCode'] != $order_info['payment_method']['params']['currency']) {
					$error = 'true';
					$error_message .= 'Incorrect Currency\n';
				}
				if ($_REQUEST['PreviousStatusCode']) {
					$error = 'true';
					$error_message .= 'Duplaicated order\n';
				}
				if (!$error) {
					echo('StatusCode=0');
				} else {
					echo('StatusCode=' . $status_code . '&Message=' . $_REQUEST['Message']);
				}
			} else {
				echo('StatusCode=' . $status_code . '&Message=' . $_REQUEST['Message']);
			}
		}
	} elseif ($mode == 'notify') {
		fn_order_placement_routines($_REQUEST['order_id'], false);
	}
} else {
	$post = array(
		'Amount' => $order_info['total'] * 100,
		'CurrencyCode' => $processor_data['params']['currency'],
		'OrderID' => ($order_info['repaid']) ? ($order_id . '_' . $order_info['repaid']) : $order_id,
		'TransactionType' => $processor_data['params']['transaction_type'],
		'TransactionDateTime' => date('Y-m-d H:i:s O'),
		'CallbackURL' => Registry::get('config.current_location') . '/payments/cardsave_hosted.php', // it is not allowed to use arguments in this parameter
		'OrderDescription' => '',
		'CustomerName' => $order_info['b_firstname'] . ' ' . $order_info['b_lastname'],
		'Address1' => $order_info['b_address'],
		'Address2' => $order_info['b_address_2'],
		'Address3' => '',
		'Address4' => '',
		'City' => $order_info['b_city'], 
		'State' => $order_info['b_state_descr'],
		'PostCode' => $order_info['b_zipcode'],
		'CountryCode' => db_get_field('SELECT code_N3 FROM ?:countries WHERE code=?s', $order_info['b_country']),
		'CV2Mandatory' => $processor_data['params']['cv2_mandatory'],
		'Address1Mandatory' => $processor_data['params']['address_mandatory'],
		'CityMandatory' => $processor_data['params']['city_mandatory'],
		'PostCodeMandatory' => $processor_data['params']['postcode_mandatory'],
		'StateMandatory' => $processor_data['params']['state_mandatory'],
		'CountryMandatory' => $processor_data['params']['country_mandatory'],
		'ResultDeliveryMethod' => 'SERVER',
		'ServerResultURL' => Registry::get('config.current_location') . '/' . INDEX_SCRIPT . '?dispatch=payment_notification.process&payment=cardsave_hosted&order_id=' . $order_id . '&fake=true',
		'PaymentFormDisplaysResult' => 'false',
		'ServerResultURLCookieVariables' => '',
		'ServerResultURLFormVariables' => '',
		'ServerResultURLQueryStringVariables' => ''
	);
	$str = 'PreSharedKey=' . $processor_data['params']['access_code'] . 
		'&MerchantID=' . $processor_data['params']['merchant_id'] . 
		'&Password=' . $processor_data['params']['password'];
	foreach ($post as $k => $v) {
		$str .= "&$k=$v";
	}
	$hash = sha1($str);
echo <<<EOT
<html>
<body onLoad="document.process.submit();">
<form action="https://mms.cardsaveonlinepayments.com/Pages/PublicPages/PaymentForm.aspx" method="POST" name="process">
	<input type="hidden" name="HashDigest" value="{$hash}" />
	<input type="hidden" name="MerchantID" value="{$processor_data['params']['merchant_id']}" />
EOT;
foreach ($post as $name => $value) {
	echo "<input type=\"hidden\" name=\"$name\" value=\"$value\" />\n";
}
	$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'CardSave server', $msg);
echo <<<EOT
	</form>
	<p><div align=center>{$msg}</div></p>
</body>
</html>
EOT;
}
exit;
?>
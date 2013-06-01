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

	require './init_payment.php';

	if (!empty($_REQUEST['EncryptedParameters'])) {
		$payment_id = db_get_field("SELECT a.payment_id FROM ?:payments as a LEFT JOIN ?:payment_processors as b ON a.processor_id = b.processor_id WHERE a.status = 'A' AND b.processor_script = 'westpac.php' LIMIT 1");
		$processor_data = fn_get_payment_method_data($payment_id);

		$params = fn_payway_decrypt_parameters($processor_data['params']['encryption_key'], $_REQUEST['EncryptedParameters'], $_REQUEST['Signature']);
		if (!empty($params)) {
			$status = db_get_field("SELECT status FROM ?:orders WHERE order_id = ?i", $params['payment_reference']);
			if ($status == 'N') {
				$approved_response_codes = array('00', '08', 'QS');
				if (!empty($params['bank_reference']) && in_array($params['response_code'], $approved_response_codes)) {
					$pp_response["order_status"] = 'P';
					$pp_response["reason_text"] = "Authorization code: " . $params['bank_reference'];
				} else {
					$pp_response["order_status"] = 'F';
				}

				$pp_response['transaction_id'] = $params['payment_number'];
				if (fn_check_payment_script('westpac.php', $params['payment_reference'])) {
					fn_finish_payment($params['payment_reference'], $pp_response, false);
				}
			}

			fn_order_placement_routines($params['payment_reference']);
		}
	}
	exit;

} else {

	$merchant_id = ($processor_data['params']['mode'] == 'test') ? 'TEST' : $processor_data['params']['merchant_id'];
	$biller_code = $processor_data['params']['biller_code'];

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<form method="post" action="https://www.payway.com.au/MakePayment" name="process">
	<input type="hidden" name="merchant_id" value="{$merchant_id}">
	<input type="hidden" name="biller_code" value="{$biller_code}">

EOT;
// Products
if (!empty($order_info['items'])) {
	foreach ($order_info['items'] as $k => $v) {
		if (!empty($v['product_options'])) {
			$opts = '';
			foreach ($v['product_options'] as $key => $val) {
				$opts .= "$val[option_name]:$val[variant_name]; ";
			}
			$v['product'] .= ' ('.$opts.')';
		}
		$v['one_product_price'] = fn_format_price(($v['subtotal'] - fn_external_discounts($v)) / $v['amount']);
echo <<<EOT
	<input type="hidden" name="{$v['product']} " value="{$v['amount']},{$v['one_product_price']}">

EOT;
	}
}
// Gift Certificates
if (!empty($order_info['gift_certificates'])) {
	foreach ($order_info['gift_certificates'] as $v) {
		$v['amount'] = (!empty($v['extra']['exclude_from_calculate'])) ? 0 : $v['amount'];
echo <<<EOT
	<input type="hidden" name="{$v['gift_cert_code']} " value="1,{$v['amount']}">

EOT;
	}
}
// Payment surcharge
if (floatval($order_info['payment_surcharge'])) {
$desc = fn_get_lang_var('payment_surcharge');
echo <<<EOT
	<input type="hidden" name="{$desc}" value="{$order_info['payment_surcharge']}">
EOT;
}


if (floatval($order_info['subtotal_discount'])) {
	$desc = fn_get_lang_var('order_discount');
	$pr = fn_format_price($order_info['subtotal_discount']);
echo <<<EOT
	<input type="hidden" name="{$desc}" value="-{$pr}">

EOT;
}

// Shipping
if ($sh = fn_order_shipping_cost($order_info)) {
$desc = fn_get_lang_var('shipping_cost');
echo <<<EOT
	<input type="hidden" name="{$desc}" value="{$sh}">

EOT;
}
echo <<<EOT
	<input type="hidden" name="payment_reference" value="{$order_id}">
	<input type="hidden" name="receipt_address" value="{$order_info['email']}">

EOT;
$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'PayWay', $msg);
echo <<<EOT
	</form>
   <div align="center"><p>{$msg}</p></div>
 </body>
</html>
EOT;
exit;
}

function fn_payway_pkcs5_unpad($text)
{
	$pad = ord($text{strlen($text)-1});
	if ($pad > strlen($text)) {
		return false;
	}
	if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
		return false;
	}

	return substr($text, 0, -1 * $pad);
}

function fn_payway_decrypt_parameters($key, $params, $signature)
{
	$key = base64_decode($key);
	$iv = "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0";
	$td = mcrypt_module_open('rijndael-128', '', 'cbc', '');

	// Decrypt the parameter text
	mcrypt_generic_init($td, $key, $iv);
	$parameters_text = mdecrypt_generic($td, base64_decode($params));
	$parameters_text = fn_payway_pkcs5_unpad($parameters_text);
	mcrypt_generic_deinit($td);

	// Decrypt the signature value
	mcrypt_generic_init($td, $key, $iv);
	$hash = mdecrypt_generic($td, base64_decode($signature));
	$hash = bin2hex( fn_payway_pkcs5_unpad($hash));
	mcrypt_generic_deinit($td);

	mcrypt_module_close($td);

	// Compute the MD5 hash of the parameters
	$computed_hash = md5($parameters_text);

	// Check the provided MD5 hash against the computed one
	if ( $computed_hash != $hash ) {
		trigger_error( "Invalid parameters signature" );
	}

	$parameter_array = explode('&', $parameters_text);
	$parameters = array();

	// Loop through each parameter provided
	foreach ($parameter_array as $parameter ) {
		list($param_name, $param_value ) = explode('=', $parameter);
		$parameters[urldecode($param_name)] = urldecode($param_value);
	}

	return $parameters;
}

?>
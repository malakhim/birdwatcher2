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
	
	} elseif ($mode == 'process') {

		$pp_response = array(
			'order_status' => 'F',
			'pp_response' => '',
			'reason_text' => ''
		);
		$order_id = $_REQUEST['order_id'];

		if (!empty($_REQUEST['payment_number'])) {
			$pp_response['transaction_id'] = $_REQUEST['payment_number'];

			$conf_key = db_get_field("SELECT data FROM ?:order_data WHERE type = 'E' AND order_id = ?i", $order_id);

			if (empty($conf_key) || $conf_key != $_REQUEST['conf_key']) {
				$pp_response['reason_text'] .= 'Confirmation key does not match; ';
			} else {
				db_query("DELETE FROM ?:order_data WHERE type = 'E' AND order_id = ?i", $order_id);
				$pp_response['order_status'] = 'P';
			}
		} else {
			$pp_response['reason_text'] .= 'Payment number is empty; ';
		}

		$pp_response['reason_text'] .= ("Received from: " . $_SERVER['REMOTE_ADDR']);

		if (fn_check_payment_script('direct_one.php', $order_id)) {
			fn_finish_payment($order_id, $pp_response);
		}
	}

} else {
	$conf_key = md5($order_id . TIME . $_SESSION['auth']['user_id']);
	$data = array (
		'order_id' => $order_id,
		'type' => 'E', // extra order ID
		'data' => $conf_key,
	);
	db_query("REPLACE INTO ?:order_data ?e", $data);

	$gateway_url = 'https://vault.safepay.com.au/cgi-bin/' . ($processor_data['params']['mode'] == 'live' ? 'make' : 'test') . '_payment.pl';
	$return_url = Registry::get('config.current_location') . "/" . INDEX_SCRIPT . "?dispatch=payment_notification.notify&payment=direct_one&order_id=" . $order_id;
	$process_url = Registry::get('config.current_location') . "/" . INDEX_SCRIPT . "?dispatch=payment_notification.process&payment=direct_one&order_id=" . $order_id . "&payment_number=&conf_key=$conf_key";

echo <<<EOT
<html>
<body onLoad="javascript: document.process.submit();">
<FORM NAME="process" METHOD="POST" ACTION="{$gateway_url}">
	<INPUT TYPE="Hidden" NAME="vendor_name" VALUE="{$processor_data['params']['merchant_id']}">
	<INPUT TYPE="Hidden" NAME="return_link_url" VALUE="{$return_url}">
	<INPUT TYPE="Hidden" NAME="reply_link_url" VALUE="{$process_url}">
	<INPUT TYPE="Hidden" NAME="Billing_name" VALUE="{$order_info['b_firstname']}">
	<INPUT TYPE="Hidden" NAME="Billing_address1" VALUE="{$order_info['b_address']}">
	<INPUT TYPE="Hidden" NAME="Billing_address2" VALUE="{$order_info['b_address_2']}">
	<INPUT TYPE="Hidden" NAME="Billing_city" VALUE="{$order_info['b_city']}">
	<INPUT TYPE="Hidden" NAME="Billing_state" VALUE="{$order_info['b_state_descr']}">
	<INPUT TYPE="Hidden" NAME="Billing_zip" VALUE="{$order_info['b_zipcode']}">
	<INPUT TYPE="Hidden" NAME="Billing_country" VALUE="{$order_info['b_country_descr']}">
	<INPUT TYPE="Hidden" NAME="Delivery_name" VALUE="{$order_info['s_firstname']}">
	<INPUT TYPE="Hidden" NAME="Delivery_address1" VALUE="{$order_info['s_address']}">
	<INPUT TYPE="Hidden" NAME="Delivery_address2" VALUE="{$order_info['s_address_2']}">
	<INPUT TYPE="Hidden" NAME="Delivery_city" VALUE="{$order_info['s_city']}">
	<INPUT TYPE="Hidden" NAME="Delivery_state" VALUE="{$order_info['s_state_descr']}">
	<INPUT TYPE="Hidden" NAME="Delivery_zip" VALUE="{$order_info['s_zipcode']}">
	<INPUT TYPE="Hidden" NAME="Delivery_country" VALUE="{$order_info['s_country_descr']}">
	<INPUT TYPE="Hidden" NAME="Contact_email" VALUE="{$order_info['email']}">
	<INPUT TYPE="Hidden" NAME="Contact_phone" VALUE="{$order_info['phone']}">
	<INPUT TYPE="Hidden" NAME="information_fields" VALUE="Billing_name,Billing_address1,Billing_address2,Billing_city,Billing_state,Billing_zip,Billing_country,Delivery_name,Delivery_address1,Delivery_address2,Delivery_city,Delivery_state,Delivery_zip,Delivery_country,Contact_email,Contact_phone">
	<INPUT TYPE="Hidden" NAME="suppress_field_names" VALUE="">
	<INPUT TYPE="Hidden" NAME="hidden_fields" VALUE="">
	<INPUT TYPE="Hidden" NAME="print_zero_qty" VALUE="false">
EOT;

	if (empty($order_info['use_gift_certificates']) && !floatval($order_info['subtotal_discount']) && empty($order_info['points_info']['in_use'])) {
		// Products
		if (!empty($order_info['items'])) {
			foreach ($order_info['items'] as $k => $v) {
				$v['product'] = htmlspecialchars(strip_tags($v['product']));
				$v['price'] = fn_format_price(($v['subtotal'] - fn_external_discounts($v)) / $v['amount']);
				echo <<<EOT
				<input type="hidden" name="{$v['product']}" value="{$v['amount']},{$v['price']}" />
EOT;
			}
		}
		
		// Taxes
		if (!empty($order_info['taxes']) && Registry::get('settings.General.tax_calculation') == 'subtotal') {
			foreach ($order_info['taxes'] as $tax_id => $tax) {
				if ($tax['price_includes_tax'] == 'Y') {
					continue;
				}
				$item_name = htmlspecialchars(strip_tags($tax['description']));
				$item_price = fn_format_price($tax['tax_subtotal']);
				echo <<<EOT
				<input type="hidden" name="{$item_name}" value="1,{$item_price}" />
EOT;
			}
		}

		// Gift Certificates
		if (!empty($order_info['gift_certificates'])) {
			foreach ($order_info['gift_certificates'] as $k => $v) {
				$v['gift_cert_code'] = htmlspecialchars($v['gift_cert_code']);
				$v['amount'] = (!empty($v['extra']['exclude_from_calculate'])) ? 0 : fn_format_price($v['amount']);
				echo <<<EOT
				<input type="hidden" name="{$v['gift_cert_code']}" value="1,{$v['amount']}" />
EOT;
			}
		}

		// Payment surcharge
		if (floatval($order_info['payment_surcharge'])) {
			$name = fn_get_lang_var('surcharge');
			$payment_surcharge_amount = fn_format_price($order_info['payment_surcharge']);
			echo <<<EOT
			<input type="hidden" name="{$name}" value="1,{$payment_surcharge_amount}" />
EOT;
		}

		// Shipping
		$_shipping_cost = fn_order_shipping_cost($order_info);
		if (floatval($_shipping_cost)) {
			$name = fn_get_lang_var('shipping_cost');
			$payment_shipping_cost = fn_format_price($_shipping_cost);
			echo <<<EOT
			<input type="hidden" name="{$name}" value="1,{$payment_shipping_cost}" />
EOT;
		}
	} else {
		$total_description = fn_get_lang_var('total_product_cost');
		echo <<<EOT
		<input type="hidden" name="{$total_description}" value="1,{$order_info['total']}" />
EOT;
	}


$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'DirectOne server', $msg);
echo <<<EOT
	</form>
   <p><div align=center>{$msg}</div></p>
 </body>
</html>
EOT;
exit;
}

?>
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

// MoneyBookers Quick Checkout and Moneybookers eWallet payment systems

if ( !defined('AREA') ) { die('Access denied'); }

if (defined('PAYMENT_NOTIFICATION')) {
	if (AREA == 'A') {
		$master_account_cust_id = '13661561';
		$master_account_secret_word = 'secretword';
		
		$mb_exit_needed = false;
		if (in_array($mode, array('validate_email', 'activate', 'validate_secret_word'))) {
			$mb_exit_needed = true;
		}
		
		if (empty($_REQUEST['payment_id']) && $mb_exit_needed) {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('text_moneybookers_payment_is_not_saved'));
			exit;
		}
		
		if ($mode == 'validate_email') {

			if (!empty($_REQUEST['email']) && !empty($_REQUEST['payment_id'])) { 
				$processor_params = array();
				$processor_params['pay_to_email'] = $_REQUEST['email'];
		
				$get_data = array();
				$get_data['email'] = $_REQUEST['email'];
				$get_data['cust_id'] = $master_account_cust_id;
				$get_data['password'] = md5($master_account_secret_word);
				list($headers, $result) = fn_https_request('GET', "https://www.moneybookers.com/app/email_check.pl?email=$get_data[email]&cust_id=$get_data[cust_id]&password=$get_data[password]");
		
				$result_array = explode(',', $result);
		
				if ($result_array[0] == 'OK') {
					$processor_params['customer_id'] = $result_array[1];
					fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_moneybookers_email_is_registered'));
				} else {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_moneybookers_email_is_not_registered'));
				}
		
				$old_processor_data = fn_get_processor_data($_REQUEST['payment_id']);
				$old_processor_param = (empty($old_processor_data['params'])) ? array() : $old_processor_data['params'];
				$new_processor_param = $processor_params;
				$new_processor_param = array_merge($old_processor_param, $new_processor_param);
				$new_processor_data = serialize($new_processor_param);
		
				db_query('UPDATE ?:payments SET params = ?s WHERE payment_id = ?i', $new_processor_data, $_REQUEST['payment_id']);
		
				$ajax->assign('customer_id_' . $_REQUEST['payment_id'], $processor_params['customer_id']);
			}
		} 
		
		if ($mode == 'activate') {

			if (!empty($_REQUEST['payment_id']) && !empty($_REQUEST['email']) && !empty($_REQUEST['cust_id']) && !empty($_REQUEST['platform']) && !empty($_REQUEST['merchant_firstname']) && !empty($_REQUEST['merchant_lastname'])) {
				$moneybookers_email = 'ecommerce@moneybookers.com';
		
				Registry::get('view_mail')->assign('mb_firstname', $_REQUEST['merchant_firstname']);
				Registry::get('view_mail')->assign('mb_lastname', $_REQUEST['merchant_lastname']);
				
				Registry::get('view_mail')->assign('platform', $_REQUEST['platform']);
				Registry::get('view_mail')->assign('email', $_REQUEST['email']);
				Registry::get('view_mail')->assign('cust_id', $_REQUEST['cust_id']);
		
				fn_send_mail($moneybookers_email, $_REQUEST['email'], 'payments/cc_processors/activate_moneybookers_subj.tpl', 'payments/cc_processors/activate_moneybookers.tpl', '', Registry::get('settings.Appearance.admin_default_language'));
				fn_set_notification('W', fn_get_lang_var('important'), str_replace('[date]', date('m.d.Y'), fn_get_lang_var('text_moneybookers_activate_quick_checkout_short_explanation_1')));
		
			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_moneybookers_empty_input_data') );
			}		
		} 
		
		if ($mode == 'validate_secret_word') {
			if (!empty($_REQUEST['email']) && !empty($_REQUEST['payment_id']) && !empty($_REQUEST['cust_id']) && !empty($_REQUEST['secret'])) {
				$processor_params['pay_to_email'] = $_REQUEST['email'];
		
				$get_data = array();
				$get_data['email'] = $_REQUEST['email'];
				$get_data['cust_id'] = $master_account_cust_id;
				$get_data['secret'] = md5(md5($_REQUEST['secret']) . md5($master_account_secret_word));
				list($headers, $result) = fn_https_request('GET', "https://www.moneybookers.com/app/secret_word_check.pl?email=$get_data[email]&secret=$get_data[secret]&cust_id=$get_data[cust_id]");
		
				$result_array = explode(',', $result);
		
				if ($result_array[0] == 'OK') {
					fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_moneybookers_secret_word_is_correct'));
				} else {
					fn_set_notification('E', fn_get_lang_var('error'), str_replace('[date]', date('m.d.Y'), fn_get_lang_var('text_moneybookers_secret_word_is_incorrect')));
				}
		
				$processor_params['secret_word'] = $_REQUEST['secret'];
				$old_processor_data = fn_get_processor_data($_REQUEST['payment_id']);
				$old_processor_param = (empty($old_processor_data['params'])) ? array() : $old_processor_data['params'];
				$new_processor_param = $processor_params;
				$new_processor_param = array_merge($old_processor_param, $new_processor_param);
				$new_processor_data = serialize($new_processor_param);
		
				db_query('UPDATE ?:payments SET params = ?s WHERE payment_id = ?i', $new_processor_data, $_REQUEST['payment_id']);
		
				$ajax->assign('secret_word_' . $_REQUEST['payment_id'], $processor_params['secret_word']);
			}
		}

		if ($mb_exit_needed) {
			exit;
		}
	}

	$pp_response = array();
	if ($mode == 'return') {
		if (!empty($_REQUEST['iframe_mode'])) {
			define('MB_MAX_TIME', 60); // Time for awaiting callback
			
			$view->assign('order_action', fn_get_lang_var('placing_order'));
			$view->display('views/orders/components/placing_order.tpl');
			fn_flush();
			
			$_placed = false;
			$times = 0;
			
			while (!$_placed) {
				$order_id = db_get_field('SELECT order_id FROM ?:order_data WHERE type = ?s AND data = ?s', 'E', $_REQUEST['order_id']);

				if (!empty($order_id)) {
					$_placed = true;
				} else {
					sleep(1);
				}
				
				$times++;
				if ($times > MB_MAX_TIME) {
					break;
				}
			}
		} else {
			$order_id = $_REQUEST['order_id'];
		}
	
		// If order was placed successfully, associate the order with this customer
		if (!empty($order_id)) {
			$auth['order_ids'][] = $order_id;
			
			if (fn_check_payment_script('moneybookers_ewqc.php', $order_id)) {
				fn_order_placement_routines($order_id, false);
			}
			
			$redirect_url = fn_url('checkout.complete?order_id=' . $order_id);
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_mb_failed_order'));
			$redirect_url = fn_url('checkout.cart');
		}
		fn_redirect($redirect_url, true);
		
	} elseif ($mode == 'cancel') {

		if (!empty($_REQUEST['iframe_mode'])) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_transaction_cancelled'));
			fn_redirect(fn_url('checkout.checkout'), true);
		}

		if (fn_check_payment_script('moneybookers_ewqc.php', $_REQUEST['order_id'])) {
			$pp_response['order_status'] = 'N';
			$pp_response['reason_text'] = fn_get_lang_var('text_transaction_declined');
	
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
			fn_order_placement_routines($_REQUEST['order_id']);
		}
	} elseif ($mode == 'unsupported_currency') {
		if (fn_check_payment_script('moneybookers_ewqc.php', $_REQUEST['order_id'])) {
			$pp_response = array();
			$pp_response['order_status'] = 'F';
			$pp_response['reason_text'] = fn_get_lang_var('text_unsupported_currency');
	
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
			fn_order_placement_routines($_REQUEST['order_id']);
		}
	} elseif ($mode == 'status') {

		if (!empty($_REQUEST['iframe_mode'])) {
			$_REQUEST['order_id'] = fn_mb_place_order($_REQUEST);
		}

		$_status_descr = array(
			'2' => 'Processed',
			'0' => 'Pending',
			'-1' => 'Cancelled',
			'-2' => 'Failed',
			'-3' => 'Chargeback'
		);

		$payment_id = db_get_field('SELECT payment_id FROM ?:orders WHERE order_id=?i', $_REQUEST['order_id']);
		$processor_data = fn_get_payment_method_data($payment_id);
		$order_info = fn_get_order_info($_REQUEST['order_id']);

		$response_fields = array(
				'pay_to_email',
				'pay_from_email',
				'merchant_id',
				'customer_id',
				'transaction_id',
				'mb_transaction_id',
				'mb_amount',
				'mb_currency',
				'status',
				'md5sig',
				'amount',
				'currency',
				'payment_type',
				'merchant_fields',
			);

		$response_data = array();

		foreach ($response_fields as $field) {
			if (isset($_REQUEST[$field])) {
				$response_data[$field] = $_REQUEST[$field];
			}
		}

		$our_md5sig_string = $response_data['merchant_id'] . $response_data['transaction_id'] . strtoupper(md5($processor_data['params']['secret_word'])) . $response_data['mb_amount'] . $response_data['mb_currency'] . $response_data['status'];

		$our_md5sig = strtoupper(md5($our_md5sig_string));

		$pp_response = array();

		$pp_response['status'] = $_REQUEST['status'] . (!empty($_status_descr[$_REQUEST['status']]) ? (' (' . $_status_descr[$_REQUEST['status']] . ')') : '');

		$pp_response['mb_transaction_id'] = $_REQUEST['mb_transaction_id'];
//		$pp_response['mb_amount'] = $mb_amount;
//		$pp_response['mb_currency'] = $mb_currency;
		$pp_response['pay_from_email'] = $_REQUEST['pay_from_email'];
		$pp_response['payment_type'] = !empty($_REQUEST['payment_type']) ? $_REQUEST['payment_type'] : '';
		
		$__curr = $processor_data['params']['currency'];
		
		$adjusted_order_total = fn_mb_adjust_amount($order_info['total'], $__curr);

		if (($_REQUEST['md5sig'] == $our_md5sig) && $adjusted_order_total && ($_REQUEST['amount'] == $adjusted_order_total) && ($_REQUEST['currency'] == $processor_data['params']['currency'])) {
			if ($_REQUEST['status'] == '2') {
				$pp_response['order_status'] = 'P';
				$pp_response['reason_text'] = fn_get_lang_var('approved');
			} elseif ($_REQUEST['status'] == '0') {
				$pp_response['order_status'] = 'O';
				$pp_response['reason_text'] = fn_get_lang_var('pending');
			} elseif ($_REQUEST['status'] == '-1') {
				$pp_response['order_status'] = 'I';
				$pp_response['reason_text'] = fn_get_lang_var('cancelled');
			} else {
				$pp_response['order_status'] = 'F';
				$pp_response['reason_text'] = fn_get_lang_var('failed');
			}
		} else {
			$pp_response['order_status'] = 'F';

			if ($_REQUEST['md5sig'] != $our_md5sig) {
				$pp_response['reason_text'] .= fn_get_lang_var('mb_md5_hashes_not_match');
			}
			if (!$adjusted_order_total) {
				$pp_response['reason_text'] .= fn_get_lang_var('text_unsupported_currency');
			} elseif ($_REQUEST['amount'] != $adjusted_order_total) {
				$pp_response['reason_text'] .= fn_get_lang_var('mb_amounts_not_match');
			}
			if ($_REQUEST['currency'] != $processor_data['params']['currency']) {
				$pp_response['reason_text'] .= fn_get_lang_var('mb_currencies_not_match');
			}
		}

		if (fn_check_payment_script('moneybookers_ewqc.php', $_REQUEST['order_id'])) {
			fn_finish_payment($_REQUEST['order_id'], $pp_response);
		}
		exit;
	}

} else {
	$url = 'https://www.moneybookers.com/app/payment.pl';

	$suffix = (AREA != 'A' && empty($order_info['repaid']) && defined('IFRAME_MODE')) ? '&iframe_mode=true' : '';

	$post_data = array(
		'pay_to_email' => $processor_data['params']['pay_to_email'],
		'recipient_description' => $processor_data['params']['recipient_description'],
		'transaction_id' => $processor_data['params']['order_prefix'] . (!empty($order_info['repaid']) ? ($order_id . '_' . $order_info['repaid']) : $order_id),
		'return_url' => Registry::get('config.current_location') . '/' . INDEX_SCRIPT . "?dispatch=payment_notification.return&payment=moneybookers_ewqc&order_id=$order_id$suffix",
		'return_url_text' => '',
		'cancel_url' => Registry::get('config.current_location') . '/' . INDEX_SCRIPT . "?dispatch=payment_notification.cancel&payment=moneybookers_ewqc&order_id=$order_id$suffix",

		'status_url' => Registry::get('config.current_location') . '/' . INDEX_SCRIPT . "?dispatch=payment_notification.status&payment=moneybookers_ewqc&order_id=$order_id$suffix",
		
		'language' => $processor_data['params']['language'],

		'amount' => $order_info['total'],
		'currency' => $processor_data['params']['currency'], 

		// iframe_target
		'return_url_target' => '_parent',
		'cancel_url_target' => '_parent',

		'merchant_fields' => 'platform,mb_sess_id,inner_order_id',
		'mb_sess_id' => base64_encode(Session::get_id()),
		'inner_order_id' => $order_id,

		'platform' => '21477207'

	);
	
	$post_data['amount'] = fn_mb_adjust_amount($post_data['amount'], $post_data['currency']);
	
	if (!$post_data['amount']) {
		if (!empty($suffix)) {
			echo fn_get_lang_var('text_unsupported_currency');
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_unsupported_currency'));
			$url = Registry::get('config.current_location') . '/' . INDEX_SCRIPT . '?dispatch=payment_notification.unsupported_currency&payment=moneybookers_ewqc&order_id=' . $order_id; 
			echo <<<EOT
<html>
<body onLoad="document.process.submit();">
	<form action="{$url}" method="POST" name="process">
	</form>
</html>
EOT;
		}

		exit;
	}
	
	// gateway_fast_registration
	$post_data['firstname'] = $order_info['b_firstname'];
	$post_data['lastname'] = $order_info['b_lastname'];
	$post_data['pay_from_email'] = $order_info['email']; 
	
	//$post_data['pay_from_email'] = rand(). "@" . rand() . ".com"; // uncomment to test hide login feature
	$post_data['address'] = $order_info['b_address'];
	$post_data['address2'] = $order_info['b_address_2'];
	$post_data['postal_code'] = $order_info['b_zipcode'];
	$post_data['city'] = $order_info['b_city'];
	$post_data['state'] = fn_get_state_name($order_info['b_state'], $order_info['b_country']);
	if (empty($post_data['state'])) {
		$post_data['state'] = $order_info['b_state'];
	}
	if (fn_strlen($post_data['state']) > 50) {
		$post_data['state'] = fn_substr($post_data['state'], 0, 47) . '...';
	}
	$post_data['country'] = db_get_field('SELECT code_A3 FROM ?:countries WHERE code=?s', $order_info['b_country']);
	$post_data['phone_number'] = $order_info['phone'];
	
	if ($processor_data['params']['quick_checkout'] == 'Y') {
		$post_data['payment_methods'] = !empty($processor_data['params']['payment_methods']) ? '' : 'ACC';
		$post_data['hide_login'] = '1';
	} else {
		$post_data['payment_methods'] = 'WLT';
		$post_data['hide_login'] = (!empty($suffix)) ? '1' : '0';
	}

	// split_gateway
	if (!empty($processor_data['params']['payment_methods'])) {
		$post_data['payment_methods'] .= (!empty($post_data['payment_methods']) ? ',' : '') . $processor_data['params']['payment_methods'];
	}	
	// /split_gateway

	// logo
	if (!(!empty($processor_data['params']['do_not_pass_logo']) && $processor_data['params']['do_not_pass_logo'] == 'Y')) {
		$manifest = parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_' . AREA_NAME) . '/' . SKIN_MANIFEST, true);
		$path = Registry::get('settings.General.secure_checkout') == 'Y' ? ('https://' . Registry::get('config.https_host') .  Registry::get('config.https_path')) : ('http://' . Registry::get('config.http_host') . Registry::get('config.http_path'));
		$post_data['logo_url'] = $path . '/skins/' . Registry::get('config.skin_name') . '/' . AREA_NAME . '/images/' . $manifest['Customer_logo']['filename'];
	}

echo <<<EOT
<html>
<body onLoad="document.process.submit();">
	<form action="{$url}" method="POST" name="process">
EOT;

foreach ($post_data as $k => $v) {
echo <<<EOT
	<input type="hidden" name="{$k}" value="{$v}" />
EOT;
}

$msg = fn_get_lang_var('text_cc_processor_connection');
$msg = str_replace('[processor]', 'Moneybookers.com server', $msg);
echo <<<EOT
	</form>
	<div align=center>{$msg}</div>
</body>
</html>
EOT;
exit;
}

function fn_mb_adjust_amount($price, $payment_currency)
{
	$currencies = Registry::get('currencies');

	if (array_key_exists($payment_currency, $currencies)) {
		if ($currencies[$payment_currency]['is_primary'] != 'Y') {
			$price = fn_format_price($price / $currencies[$payment_currency]['coefficient']);
		}
	} else {
		return false;
	}
	
	return $price;
}

function fn_mb_place_order($data)
{
	define('SKIP_SESSION_VALIDATION', true);
	$order_id = 0;
	$mb_sess_id = base64_decode($data['mb_sess_id']);

	if (!empty($mb_sess_id)) {
		Session::reset_id($mb_sess_id);
		$cart = & $_SESSION['cart'];
		$auth = & $_SESSION['auth'];

		list($order_id, $process_payment) = fn_place_order($cart, $auth);

		if (!empty($_REQUEST['order_id'])) {
			$data = array (
				'order_id' => $order_id,
				'type' => 'S', 
				'data' => TIME,
			);
			db_query('REPLACE INTO ?:order_data ?e', $data);

			$data = array (
				'order_id' => $order_id,
				'type' => 'E', // extra order ID
				'data' => $_REQUEST['inner_order_id'],
			);
			db_query('REPLACE INTO ?:order_data ?e', $data);
		}
	}

	return $order_id;
}

?>
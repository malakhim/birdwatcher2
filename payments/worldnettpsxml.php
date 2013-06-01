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

if (!defined('AREA') ) { die('Access denied'); }

switch ($order_info['payment_info']['card']) {
	case 'vis': $card_type = 'VISA'; break;
	case 'vie': $card_type = 'ELECTRON'; break;
	case 'mcd': $card_type = 'MASTERCARD'; break;
	case 'amx': $card_type = 'AMEX'; break;
	case 'jsb': $card_type = 'JCB'; break;
	case 'dnc': $card_type = 'DINERS'; break;
	case 'sol': $card_type = 'SOLO'; break;
	case 'swi': $card_type = 'SWITCH'; break;
	case 'mae': $card_type = 'MAESTRO'; break;
	case 'las': $card_type = 'LASER'; break;
}

$_order_id = ($order_info['repaid']) ? ($order_id .'_'. $order_info['repaid']) : $order_id;
$expiry_date = $order_info['payment_info']['expiry_month'] . $order_info['payment_info']['expiry_year'];

$test = ($processor_data['params']['test'] == '1' ? true : false);
$avs = ($processor_data['params']['avs'] == '1' ? true : false);
$cvv = $order_info['payment_info']['cvv2'];

require_once('worldnettps_files/worldnet_tps_xml.php');

$sale = new XmlAuthRequest($processor_data['params']['terminal_id'], $_order_id . fn_date_format(TIME, '%H_%M_%S'), $processor_data['params']['currency'], $order_info['total'], $order_info['email'] . " " . $_order_id,$order_info['email'], $order_info['payment_info']['card_number'], $card_type, $expiry_date, $order_info['payment_info']['cardholder_name']);

if($cvv!="") $sale->SetCvv($cvv);
if($avs) {
		$address1 = $order_info['b_address'];
		$address2 = $order_info['b_city'] . $order_info['b_state'];
		$postcode = $order_info['b_zipcode'];

		$sale->SetAvs($address1,$address2,$postcode);
}

// Perform Auth
$response = $sale->ProcessRequest($processor_data['params']['shared_secret'],false,true);

// Verify response hash
$hash = md5($processor_data['params']['terminal_id'] . $_order_id . fn_date_format(TIME, '%H_%M_%S') . $order_info['total'] . $response->DateTime() . $response->ResponseCode() . $response->ResponseText() . $processor_data['params']['shared_secret']);

$pp_response = array();
if ($response->IsError()) {
		$pp_response['order_status'] = "F";
		$pp_response["reason_text"] = $response->ErrorString();
} elseif ($response->Hash() != $hash) {
		$pp_response['order_status'] = "F";
		$pp_response["reason_text"] = fn_get_lang_var('worldnettps_hash_error');
} else {
		$pp_response['order_status'] = ($response->ResponseCode() == "A" ? "P" : "F");
		$pp_response["reason_text"] = $response->ResponseText();
}

?>
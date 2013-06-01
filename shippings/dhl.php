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

function fn_get_dhl_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination, $service_id, $allow_multithreading = false)
{
	static $cached_rates = array();

	if ($shipping_settings['dhl_enabled'] != 'Y') {
		return false;
	}

	$cached_rate_id = fn_generate_cached_rate_id($package_info, $shipping_settings);

	if (!empty($cached_rates[$cached_rate_id])) {
		if (!empty($cached_rates[$cached_rate_id][$code])) {
			return array('cost' => $cached_rates[$cached_rate_id][$code]);
		} else {
			return false;
		}
	}

	if ($location['country'] == 'GB') {
		$location['country'] = 'UK';
	}

	$request_type = ($location['country'] != $origination['country']) ? 'IntlShipment' : 'Shipment';

	$username = !empty($shipping_settings['dhl']['system_id']) ? $shipping_settings['dhl']['system_id'] : '';
	$password = !empty($shipping_settings['dhl']['password']) ? $shipping_settings['dhl']['password'] : '';
	$account = !empty($shipping_settings['dhl']['account_number']) ? $shipping_settings['dhl']['account_number'] : '';
	$ship_key = ($request_type == 'Shipment') ? (!empty($shipping_settings['dhl']['ship_key']) ? $shipping_settings['dhl']['ship_key'] : '') : (!empty($shipping_settings['dhl']['intl_ship_key']) ? $shipping_settings['dhl']['intl_ship_key'] : '');
	$url = (!empty($shipping_settings['dhl']['test_mode']) && $shipping_settings['dhl']['test_mode'] == 'Y') ? 'https://ecommerce.airborne.com:443/apilandingtest.asp' : 'https://ecommerce.airborne.com:443/apilanding.asp';

	$weight = intval($weight_data['full_pounds']);
	$total = !empty($_SESSION['cart']['subtotal']) ? (intval($_SESSION['cart']['subtotal']) + 1) : 1;

	// Package type (Package, Letter)
	$package = !empty($shipping_settings['dhl']['shipment_type']) ? $shipping_settings['dhl']['shipment_type'] : '';

	// Ship date
	$ship_date = date("Y-m-d", TIME + (date('w', TIME) == 0 ? 86400 : 0));

	//Shipping Billing Type FIXME!!! move to options (S - sender, R - receiver, 3  - 3rd party)
	$billing_type = 'S';

	if (empty($all_codes)) {
		if ($request_type == 'Shipment') {
			$all_codes = db_get_fields("SELECT code FROM ?:shipping_services WHERE code NOT IN ('', 'IE', 'IE:SAT')");
		} else {
			$all_codes = array('IE', 'IE:SAT'); // DHL has the only international service Intl Express
		}
	}

	$ship_request = $bil_request = '';

	// International shipping is not dutiable and have no customs fee
	$dutiable = '';
	if ($request_type == 'IntlShipment') {
		$dutiable = "<Dutiable><DutiableFlag>N</DutiableFlag><CustomsValue>$total</CustomsValue></Dutiable>";
		$content = $origination['name'];
		$ship_request .= "<ContentDesc><![CDATA[$content]]></ContentDesc>"; // FIXME!!!
	}

	// Additional protection
	$protection = !empty($shipping_settings['dhl']['additional_protection']) ? $shipping_settings['dhl']['additional_protection'] : '';
	if ($protection != 'NR') {
		$ship_request .= "<AdditionalProtection><Code>$protection</Code><Value>$total</Value></AdditionalProtection>";
	}

	// Cache-on-delivery payment
	if (!empty($shipping_settings['dhl']['cod_payment']) && $shipping_settings['dhl']['cod_payment'] == 'Y') {
		$cod_method = !empty($shipping_settings['dhl']['cod_method']) ? $shipping_settings['dhl']['cod_method'] : '';
		$cod_value = !empty($shipping_settings['dhl']['cod_value']) ? $shipping_settings['dhl']['cod_value'] : '';
		$bil_request .= "<CODPayment><Code>$cod_method</Code><Value>$cod_value</Value></CODPayment>";
	}

	if ($package != 'L') {
		$length = !empty($shipping_settings['dhl']['length']) ? $shipping_settings['dhl']['length'] : '0';
		$width = !empty($shipping_settings['dhl']['width']) ? $shipping_settings['dhl']['width'] : '0';
		$height = !empty($shipping_settings['dhl']['height']) ? $shipping_settings['dhl']['height'] : '0';
		$ship_request .= "<Weight>$weight</Weight><Dimensions><Width>$width</Width><Height>$height</Height><Length>$length</Length></Dimensions>";

		if (!empty($package_info['packages'])) {		
			$ship_request .= '<ShipmentPieces>';
			foreach ($package_info['packages'] as $k => $package_item) {
				$package_length = empty($package_item['shipping_params']['box_length']) ? $length : $package_item['shipping_params']['box_length'];
				$package_width = empty($package_item['shipping_params']['box_width']) ? $width : $package_item['shipping_params']['box_width'];
				$package_height = empty($package_item['shipping_params']['box_height']) ? $height : $package_item['shipping_params']['box_height'];
				$package_weight_ar = fn_expand_weight($package['weight']);
				$package_weight = $package_weight_ar['full_pounds'];
				$package_piecenum = $k + 1;

				$ship_request .= "<Piece><PieceNum>$package_piecenum</PieceNum><Weight>$package_weight</Weight><Dimensions><Width>$package_width</Width><Height>$package_height</Height><Length>$package_length</Length></Dimensions></Piece>";
			}
			$ship_request .= '</ShipmentPieces>';
		}
	}

	$shipment_request = '';

	foreach ($all_codes as $c_code) {
		$_code = explode(':', $c_code);
		$service_code = $_code[0];
		$special_request = '';
		$shipment_instructions = '';

		// Ship hazardous materials
		if (!empty($shipping_settings['dhl']['ship_hazardous']) && $shipping_settings['dhl']['ship_hazardous'] == 'Y') {
			$special_request .= "<SpecialService><Code>HAZ</Code></SpecialService>";
		}

		if (!empty($_code[1])) {
			if ($_code[1] == 'SAT' && date('w', TIME) != '5') {
				$shipment_instructions = "<ShipmentProcessingInstructions><Overrides><Override><Code>ES</Code></Override></Overrides></ShipmentProcessingInstructions>";
			}
			$special_request .= "<SpecialService><Code>$_code[1]</Code></SpecialService>";
		}

		// ZipCode override
		//$shipment_instructions = "<ShipmentProcessingInstructions><Overrides><Override><Code>RP</Code></Override></Overrides></ShipmentProcessingInstructions>";

		if (!empty($special_request)) {
			$special_request = '<SpecialServices>' . $special_request . '</SpecialServices>';
		}

		$shipment_request .= <<<EOT
		<$request_type action="RateEstimate" version="1.0">
			<ShippingCredentials>
				<ShippingKey>$ship_key</ShippingKey>
				<AccountNbr>$account</AccountNbr>
			</ShippingCredentials>
			<ShipmentDetail>
				<ShipDate>$ship_date</ShipDate>
				<Service>
					<Code>$service_code</Code>
				</Service>
				<ShipmentType>
				<Code>$package</Code>
				</ShipmentType>
				$ship_request
				$special_request
			</ShipmentDetail>
			<Billing>
				<Party>
					<Code>$billing_type</Code>
				</Party>
				$bil_request
				<AccountNbr>$account</AccountNbr>
			</Billing>
			<Receiver>
				<Address>
					<Street>{$location['address']}</Street>
					<City>{$location['city']}</City>
					<State>{$location['state']}</State>
					<PostalCode>{$location['zipcode']}</PostalCode>
					<Country>{$location['country']}</Country>
				</Address>
			</Receiver>
			$dutiable
			$shipment_instructions
		</$request_type>
EOT;
	}

		$request = <<<EOT
	<?xml version="1.0" encoding="UTF-8" ?>
		<eCommerce action="Request" version="1.1">
		<Requestor>
			<ID>$username</ID>
			<Password>$password</Password>
		</Requestor>
		$shipment_request
		</eCommerce>
EOT;
	$post = explode("\n", $request);

	if ($allow_multithreading) {
		$h_req = fn_cm_register_request('POST', $url, $post, '', '', 'text/xml');
		return array($h_req, 'fn_dhl_process_result', array($code, $request_type));
	} else {
		list ($header, $result) = fn_https_request('POST', $url, $post, '', '', 'text/xml');
		return fn_dhl_process_result($header, $result, $code, $request_type, $cached_rates, $cached_rate_id);
	}
}

function fn_dhl_process_result($header, $result, $code, $request_type, &$cached_rates = null, $cached_rate_id = null)
{
	$rates = fn_arb_get_rates($result, $request_type);
	
	if ($cached_rates !== null && empty($cached_rates[$cached_rate_id]) && !empty($rates)) {
		$cached_rates[$cached_rate_id] = $rates;
	}
	
	if (!empty($rates[$code])) {
		return array('cost' => $rates[$code]);
	} else {
		if (defined('SHIPPING_DEBUG')) {
			return array('error' => fn_arb_get_error($result, $request_type));
		}
	}

	return false;
}

function fn_arb_get_rates($result, $request_type)
{
	// Parse XML message returned by the UPS post server.

	$doc = new XMLDocument();
	$xp = new XMLParser();
	$xp->setDocument($doc);
	$xp->parse($result);
	$doc = $xp->getDocument();
	$return = array();

	if (is_object($doc->root)) {
		$root = $doc->getRoot();
		$shipment = $root->getElementsByName($request_type);
		for ($i = 0; $i < count($shipment); $i++) {
			$_charge = $shipment[$i]->getValueByPath("/EstimateDetail/RateEstimate/TotalChargeEstimate");
			if (!empty($_charge)) {
				$_c = trim($shipment[$i]->getValueByPath("/EstimateDetail/Service/Code"));
				$_d = trim($shipment[$i]->getValueByPath("/EstimateDetail/ServiceLevelCommitment/Desc"));
				if ($_c == 'E' && !empty($_d)) {
					if ($_d == 'Delivery on Saturday') {
						$_c .= ":SAT";
					} elseif ($_d == 'Next business day by 10:30 A.M.') {
						$_c .= ":1030";
					}
				}
				$return[$_c] = trim($_charge);
			}
		}
	}
	return $return;
}

function fn_arb_get_error($result, $request_type)
{
	$doc = new XMLDocument();
	$xp = new XMLParser();
	$xp->setDocument($doc);
	$xp->parse($result);
	$doc = $xp->getDocument();
	$return = array();

	if (is_object($doc->root)) {
		$root = $doc->getRoot();
		$shipments = $root->getElementsByName($request_type);
		if ($shipments) {
			for ($k = 0; $k < count($shipments); $k++) {
				$faults = $shipments[$k]->getElementByName("Faults");
				if (!empty($faults)) {
					$fault = $faults->getElementsByName("Fault");
					for ($i = 0; $i < count($fault); $i++) {
						$return[] = $fault[$i]->getValueByPath("/Desc") . (($fault[$i]->getElementByName("Context")) ? (' ('. trim($fault[$i]->getValueByPath("/Context")) .')') : '');
					}
				}
			}
		}
	}
	return implode(' / ', $return);
}

// Temporarily disabled
/*function fn_get_dhl_shipping_key($zipcode, $shipping_settings)
{
	if (!empty($shipping_settings['dhl']["ship_key"])) {
		return
	}

	$username = $shipping_settings['dhl']['system_id'];
	$password = $shipping_settings['dhl']['password'];
	$account = $shipping_settings['dhl']['account_number'];

	$url = ($shipping_settings['dhl']['test_mode'] == 'Y') ? 'https://ecommerce.airborne.com:443/apilandingtest.asp' : 'https://ecommerce.airborne.com:443/apilanding.asp';

	$request =<<<EOT
<?xml version='1.0'?>
<eCommerce action="Request" version="1.1">
	<Requestor>
		<ID>$username</ID>
		<Password>$password</Password>
	</Requestor>
	<Register action='ShippingKey' version='1.0'>
		<AccountNbr>$account</AccountNbr>
		<PostalCode>$zipcode</PostalCode>
	</Register>
</eCommerce>
EOT;

	$post=explode("\n",$request);
	list ($header, $result) = fn_https_request('POST', $url, $post, '', '', 'text/xml');
	fn_print_die($result);

}
*/

?>
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

function fn_get_fedex_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination, $service_id = 0, $allow_multithreading = false)
{
	static $cached_rates = array();

	if ($shipping_settings['fedex_enabled'] != 'Y') {
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

	$fedex_options = array();

	if ($code == 'SMART_POST' && !empty($shipping_settings['fedex']['hub_id']) && !empty($shipping_settings['fedex']['indicia'])) {
		$fedex_options['RequestedShipment']['SmartPostDetail']['Indicia'] = $shipping_settings['fedex']['indicia'];
		if (!empty($shipping_settings['fedex']['ancillary_endorsement'])) {
			$fedex_options['RequestedShipment']['SmartPostDetail']['AncillaryEndorsement'] = $shipping_settings['fedex']['ancillary_endorsement'];
		}
		if (!empty($shipping_settings['fedex']['special_services']) && $shipping_settings['fedex']['special_services'] == 'Y') {
			$fedex_options['RequestedShipment']['SmartPostDetail']['SpecialServices'] = 'USPS_DELIVERY_CONFIRMATION';
		}
		$fedex_options['RequestedShipment']['SmartPostDetail']['HubId'] = $shipping_settings['fedex']['hub_id'];
		if (!empty($shipping_settings['fedex']['customer_manifest_id'])) {
			$fedex_options['RequestedShipment']['SmartPostDetail']['CustomerManifestId'] = $shipping_settings['fedex']['customer_manifest_id'];
		}
	}

	$fedex_options['WebAuthenticationDetail']['UserCredential']['Key'] = !empty($shipping_settings['fedex']['user_key']) ? $shipping_settings['fedex']['user_key'] : '';
	$fedex_options['WebAuthenticationDetail']['UserCredential']['Password'] = !empty($shipping_settings['fedex']['user_key_password']) ? $shipping_settings['fedex']['user_key_password'] : '';
	$fedex_options['ClientDetail']['AccountNumber'] = !empty($shipping_settings['fedex']['account_number']) ? $shipping_settings['fedex']['account_number'] : '';
	$fedex_options['ClientDetail']['MeterNumber'] = !empty($shipping_settings['fedex']['meter_number']) ? $shipping_settings['fedex']['meter_number'] : '';

	$fedex_options['PackagingType'] = !empty($shipping_settings['fedex']['package_type']) ? $shipping_settings['fedex']['package_type'] : '';
	$fedex_options['DropoffType'] = !empty($shipping_settings['fedex']['drop_off_type']) ? $shipping_settings['fedex']['drop_off_type'] : '';

	$fedex_options['Shipper'] = $fedex_options['Recipient'] = array();
	fn_fedex_fill_address($origination, $fedex_options, 'Shipper');
	fn_fedex_fill_address($location, $fedex_options, 'Recipient', $code);

	$fedex_options['Packages'] = fn_fedex_build_packages($weight_data, $shipping_settings['fedex'], $package_info);

	$url = 'https://ws' . (!empty($shipping_settings['fedex']['test_mode']) && $shipping_settings['fedex']['test_mode'] == 'Y' ? 'beta' : '') .'.fedex.com:443/web-services';

	$xml_req = fn_fedex_format_xml($fedex_options);
	$post = explode("\n", $xml_req);

	if ($allow_multithreading) {
		$h_req = fn_cm_register_request('POST', $url, $post, '', '', 'text/xml');
		return array($h_req, 'fn_fedex_process_result', array($code));
	} else {
		list($header, $result) = fn_https_request('POST', $url, $post, '', '', 'text/xml');
		return fn_fedex_process_result($header, $result, $code, $cached_rates, $cached_rate_id);
	}
}

function fn_fedex_process_result($header, $result, $code, &$cached_rates = null, $cached_rate_id = null)
{
	$rates = fn_fedex_get_rates($result);

	if ($cached_rates !== null && empty($cached_rates[$cached_rate_id]) && !empty($rates)) {
		$cached_rates[$cached_rate_id] = $rates;
	}

	if (!empty($rates[$code])) {
		return array('cost' => $rates[$code]);
	} else {
		if (defined('SHIPPING_DEBUG')) {
			return array('error' => fn_fedex_get_error($result));
		}
	}

	return false;
}

function fn_fedex_fill_address($source, &$_dest, $key, $code = '')
{
	$dest = & $_dest[$key];
	$dest['Address']['StreetLines']  = $source['address'];
	preg_match_all("/[\d\w]/", $source['zipcode'], $matches);
	$dest['Address']['PostalCode'] = !empty($matches[0]) ? implode('', $matches[0]) : '';
	$dest['Address']['City'] = $source['city'];
	$dest['Address']['StateOrProvinceCode'] = (strlen($source['state']) > 2) ? '' : $source['state']; 
	$dest['Address']['CountryCode'] = $source['country'];

	$dest['Contact']['PersonName'] = isset($source['firstname']) ? ($source['firstname'] . ' ' . $source['lastname']) : $source['name'];
	preg_match_all("/[\d]/", $source['phone'], $matches);
	$_phone = (!empty($matches[0]) ? implode('', $matches[0]) : '8001234567');
	$dest['Contact']['PhoneNumber'] = (strlen($_phone) >= 10) ? substr($_phone, 0, 10) : str_pad($_phone, 10, '0');

	if ($key == 'Recipient' && ($code == 'GROUND_HOME_DELIVERY' || empty($source['address_type']) || (!empty($source['address_type']) && $source['address_type'] == 'residential'))) {
		$dest['Address']['Residential'] = true;
	}

	if ($key == 'Recipient' && $code == 'FEDEX_GROUND') {
		$dest['Address']['Residential'] = false;
	}
}

function fn_fedex_format_xml($options)
{
	$xml_req = '<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v9="http://fedex.com/ws/rate/v9">
	<SOAP-ENV:Body>
		<v9:RateRequest>
			<v9:WebAuthenticationDetail>
				<v9:UserCredential>
					<v9:Key>' . $options['WebAuthenticationDetail']['UserCredential']['Key'] . '</v9:Key>
					<v9:Password>' . $options['WebAuthenticationDetail']['UserCredential']['Password'] . '</v9:Password>
				</v9:UserCredential>
			</v9:WebAuthenticationDetail>
			<v9:ClientDetail>
				<v9:AccountNumber>' . $options['ClientDetail']['AccountNumber'] . '</v9:AccountNumber>
				<v9:MeterNumber>' . $options['ClientDetail']['MeterNumber'] . '</v9:MeterNumber>
			</v9:ClientDetail>
			<v9:TransactionDetail>
				<v9:CustomerTransactionId>Rates Request</v9:CustomerTransactionId>
			</v9:TransactionDetail>
			<v9:Version>
				<v9:ServiceId>crs</v9:ServiceId>
				<v9:Major>9</v9:Major>
				<v9:Intermediate>0</v9:Intermediate>
				<v9:Minor>0</v9:Minor>
			</v9:Version>
			<v9:RequestedShipment>
				<v9:DropoffType>' . $options['DropoffType'] . '</v9:DropoffType>
				<v9:PackagingType>' . $options['PackagingType'] . '</v9:PackagingType>
				<v9:Shipper>
					<v9:Address>
						<v9:StreetLines>' . htmlspecialchars($options['Shipper']['Address']['StreetLines']) . '</v9:StreetLines>
						<v9:City>' . htmlspecialchars($options['Shipper']['Address']['City']) . '</v9:City>
						<v9:StateOrProvinceCode>' . $options['Shipper']['Address']['StateOrProvinceCode'] . '</v9:StateOrProvinceCode>
						<v9:PostalCode>' . $options['Shipper']['Address']['PostalCode'] . '</v9:PostalCode>
						<v9:CountryCode>' . $options['Shipper']['Address']['CountryCode'] . '</v9:CountryCode>
					</v9:Address>
				</v9:Shipper>
				<v9:Recipient>
					<v9:Address>
						<v9:StreetLines>' . htmlspecialchars($options['Recipient']['Address']['StreetLines']) . '</v9:StreetLines>
						<v9:City>' . htmlspecialchars($options['Recipient']['Address']['City']) . '</v9:City>
						<v9:StateOrProvinceCode>' . $options['Recipient']['Address']['StateOrProvinceCode'] . '</v9:StateOrProvinceCode>
						<v9:PostalCode>' . $options['Recipient']['Address']['PostalCode'] . '</v9:PostalCode>
						<v9:CountryCode>' . $options['Recipient']['Address']['CountryCode'] . '</v9:CountryCode>';
	if (!empty($options['Recipient']['Address']['Residential'])) {
		$xml_req .= '
						<v9:Residential>true</v9:Residential>';
	}
	$xml_req .= '
					</v9:Address>
				</v9:Recipient>
				<v9:ShippingChargesPayment>
					<v9:PaymentType>SENDER</v9:PaymentType>
					<v9:Payor>
						<v9:AccountNumber>' . $options['ClientDetail']['AccountNumber'] . '</v9:AccountNumber>
						<v9:CountryCode>' . $options['Shipper']['Address']['CountryCode'] . '</v9:CountryCode>
					</v9:Payor>
				</v9:ShippingChargesPayment>';
	if (!empty($options['RequestedShipment']['SmartPostDetail'])) {
		$xml_req .= '
				<v9:SmartPostDetail>';
		foreach ($options['RequestedShipment']['SmartPostDetail'] as $k => $v)
		{
			$xml_req .= '
					<v9:' . $k . '>' . $v . '</v9:' . $k . '>';
		}
		$xml_req .= '
				</v9:SmartPostDetail>';
	}
	$xml_req .= '
				<v9:RateRequestTypes>LIST</v9:RateRequestTypes>
';
	$xml_req .= $options['Packages'] . '
		
			</v9:RequestedShipment>
		</v9:RateRequest>
	</SOAP-ENV:Body>
</SOAP-ENV:Envelope>';

	return $xml_req;
}

function fn_fedex_get_error($result)
{
	$error = array();

	$result = str_replace(array('<v9:', '<soapenv:', '<env:', '<SOAP-ENV:', '<ns:'), '<', $result);
	$result = str_replace(array('</v9:', '</soapenv:', '</env:', '</SOAP-ENV:', '</ns:'), '</', $result);
	$xml = @simplexml_load_string($result);

	if ($xml) {
		$rate_reply = $xml->Body->RateReply;
		if ($rate_reply) {
			$error['type'] = (string) $rate_reply->HighestSeverity;
			$error['code'] = (string) $rate_reply->Notifications->Code;
			$error['message'] = (string) $rate_reply->Notifications->Message;
		} else {
			$error = array('type' => 'ERROR', 'code' => '', 'message' => 'Unknown error');
		}

		return implode(' ', $error);
	}

	return false;
}

function fn_fedex_get_rates($result)
{
	$result = str_replace(array('<v9:', '<soapenv:', '<env:', '<SOAP-ENV:', '<ns:'), '<', $result);
	$result = str_replace(array('</v9:', '</soapenv:', '</env:', '</SOAP-ENV:', '</ns:'), '</', $result);
	$xml = @simplexml_load_string($result);

	$return = array();

	if ($xml && $xml->Body->RateReply->RateReplyDetails) {
		foreach ($xml->Body->RateReply->RateReplyDetails as $item) {
			$service_code = (string) $item->ServiceType;
			$total_charge = (string) $item->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;
			if (!empty($total_charge)) {
				$return[$service_code] = $total_charge;
			}
		}
	}

	return $return;
}

function fn_fedex_build_packages($weight_data, $shipping_settings, $package_info)
{
	$length = !empty($shipping_settings['length']) ? $shipping_settings['length'] : 0;
	$width = !empty($shipping_settings['width']) ? $shipping_settings['width'] : 0;
	$height = !empty($shipping_settings['height']) ? $shipping_settings['height'] : 0;
	if (empty($package_info['packages'])) {
		$packages =<<<EOT
				<v9:PackageCount>1</v9:PackageCount>
				<v9:PackageDetail>INDIVIDUAL_PACKAGES</v9:PackageDetail>

				<v9:RequestedPackageLineItems>
					<v9:Weight>
						<v9:Units>LB</v9:Units>
						<v9:Value>{$weight_data['full_pounds']}</v9:Value>
					</v9:Weight>
					<v9:Dimensions>
						<v9:Length>{$length}</v9:Length>
						<v9:Width>{$width}</v9:Width>
						<v9:Height>{$height}</v9:Height>
						<v9:Units>IN</v9:Units>
					</v9:Dimensions>
				</v9:RequestedPackageLineItems>
EOT;
	} else {
		$count = count($package_info['packages']);
		$packages =<<<EOT
				<v9:PackageCount>{$count}</v9:PackageCount>
				<v9:PackageDetail>INDIVIDUAL_PACKAGES</v9:PackageDetail>
EOT;
		foreach ($package_info['packages'] as $package) {
			$package_length = empty($package['shipping_params']['box_length']) ? $length : $package['shipping_params']['box_length'];
			$package_width = empty($package['shipping_params']['box_width']) ? $width : $package['shipping_params']['box_width'];
			$package_height = empty($package['shipping_params']['box_height']) ? $height : $package['shipping_params']['box_height'];
			$weight_ar = fn_expand_weight($package['weight']);
			$weight = $weight_ar['full_pounds'];

			$packages .=<<<EOT
				<v9:RequestedPackageLineItems>
					<v9:Weight>
						<v9:Units>LB</v9:Units>
						<v9:Value>{$weight}</v9:Value>
					</v9:Weight>
					<v9:Dimensions>
						<v9:Length>{$package_length}</v9:Length>
						<v9:Width>{$package_width}</v9:Width>
						<v9:Height>{$package_height}</v9:Height>
						<v9:Units>IN</v9:Units>
					</v9:Dimensions>
				</v9:RequestedPackageLineItems>
EOT;
		}
	}

	return $packages;
}

?>
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

function fn_get_ups_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination, $service_id, $allow_multithreading = false)
{
	static $cached_rates = array();

	if ($shipping_settings['ups_enabled'] != 'Y') {
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

	if (!empty($shipping_settings['ups']['test_mode']) && $shipping_settings['ups']['test_mode'] == 'Y') {
		$url = "https://wwwcie.ups.com:443/ups.app/xml/Rate";
	} else {
		$url = "https://onlinetools.ups.com:443/ups.app/xml/Rate";
	}

	// Prepare data for UPS request
	$username = !empty($shipping_settings['ups']['username']) ? $shipping_settings['ups']['username'] : '';
	$password = !empty($shipping_settings['ups']['password']) ? $shipping_settings['ups']['password'] : '';
	$access_key = !empty($shipping_settings['ups']['access_key']) ? $shipping_settings['ups']['access_key'] : '';
	
	// Get shipper settings
	$shipper = '';
	$shipper_rate_information = '';
	if (isset($shipping_settings['ups']['negotiated_rates']) && $shipping_settings['ups']['negotiated_rates'] == 'Y') {
		$shipper = '<ShipperNumber>' . $shipping_settings['ups']['shipper_number'] . '</ShipperNumber>';
		$shipper_rate_information = '<RateInformation><NegotiatedRatesIndicator/></RateInformation>';
	}
	

	$origination_postal = $origination['zipcode'];
	$origination_country = $origination['country'];
	$origination_state = $origination['state'];
	
	$height = !empty($shipping_settings['ups']['height']) ? $shipping_settings['ups']['height'] : '0';
	$width = !empty($shipping_settings['ups']['width']) ? $shipping_settings['ups']['width'] : '0';
	$length = !empty($shipping_settings['ups']['length']) ? $shipping_settings['ups']['length'] : '0';

	$pickup_type = !empty($shipping_settings['ups']['pickup_type']) ? $shipping_settings['ups']['pickup_type'] : '';
	$package_type = !empty($shipping_settings['ups']['package_type']) ? $shipping_settings['ups']['package_type'] : '';

	$destination_postal = $location['zipcode'];
	$destination_country = $location['country'];
	$destination_state = $location['state'];

	// define weight unit and value
	$weight = $weight_data['full_pounds'];

	if (in_array($origination_country, array('US', 'DO','PR'))) {
		$weight_unit = 'LBS';
		$measure_unit = 'IN';
	} else {
		$weight_unit = 'KGS';
		$measure_unit = 'CM';
		$weight = $weight * 0.4536;
	}

	$customer_classification = '';
	if ($origination_country == 'US' && $pickup_type == '11') {
		$customer_classification=<<<EOT
	<CustomerClassification>
		<Code>04</Code>
	</CustomerClassification>
EOT;
	}

if (empty($package_info['packages'])) {
$packages =<<<EOT
	<Package>
		<PackagingType>
			<Code>$package_type</Code>
		</PackagingType>
			<Dimensions>
				<UnitOfMeasurement>
				<Code>$measure_unit</Code>
				</UnitOfMeasurement>
				<Length>$length</Length>
				<Width>$width</Width>
				<Height>$height</Height>
			</Dimensions>
		<PackageWeight>
			<UnitOfMeasurement>
				<Code>$weight_unit</Code>
			</UnitOfMeasurement>
			<Weight>$weight</Weight>
		</PackageWeight>   
	</Package>
EOT;
} else {
	$packages = '';
	foreach ($package_info['packages'] as $package) {
		$package_length = empty($package['shipping_params']['box_length']) ? $length : $package['shipping_params']['box_length'];
		$package_width = empty($package['shipping_params']['box_width']) ? $width : $package['shipping_params']['box_width'];
		$package_height = empty($package['shipping_params']['box_height']) ? $height : $package['shipping_params']['box_height'];
		$weight_ar = fn_expand_weight($package['weight']);
		$weight = (!in_array($origination_country, array('US', 'DO','PR'))) ? ($weight_ar['full_pounds'] * 0.4536) : $weight_ar['full_pounds'];

$packages .=<<<EOT
	<Package>
		<PackagingType>
			<Code>$package_type</Code>
		</PackagingType>
			<Dimensions>
				<UnitOfMeasurement>
				<Code>$measure_unit</Code>
				</UnitOfMeasurement>
				<Length>$package_length</Length>
				<Width>$package_width</Width>
				<Height>$package_height</Height>
			</Dimensions>
		<PackageWeight>
			<UnitOfMeasurement>
				<Code>$weight_unit</Code>
			</UnitOfMeasurement>
			<Weight>$weight</Weight>
		</PackageWeight>   
	</Package>
EOT;
	}
}

// Get the customer additional address
$additional_address = '';
if (!empty($location['address'])) {
	$additional_address .= '<AddressLine1>' . htmlspecialchars($location['address']) . '</AddressLine1>';
	if (!empty($location['address_2'])) {
		$additional_address .= "\n<AddressLine2>" . htmlspecialchars($location['address_2']) . '</AddressLine2>';
	}
}

$request=<<<EOT
<?xml version="1.0"?>
<AccessRequest xml:lang="en-US">
	<AccessLicenseNumber>$access_key</AccessLicenseNumber>
		<UserId>$username</UserId>
		<Password>$password</Password>
</AccessRequest>
<?xml version="1.0"?>
<RatingServiceSelectionRequest xml:lang="en-US">
  <Request>
	<TransactionReference>
	  <CustomerContext>Rate Request</CustomerContext>
	  <XpciVersion>1.0</XpciVersion>
	</TransactionReference>
	<RequestAction>Rate</RequestAction>
	<RequestOption>shop</RequestOption>
  </Request>
	<PickupType>
	<Code>$pickup_type</Code>
  </PickupType>
  $customer_classification
  <Shipment>
	<Shipper>
		<Address>
			<PostalCode>$origination_postal</PostalCode>
			<CountryCode>$origination_country</CountryCode>
		</Address>
		$shipper
	</Shipper>	
	<ShipTo>
		<Address>
			<StateProvinceCode>$destination_state</StateProvinceCode>
			<PostalCode>$destination_postal</PostalCode>
			<CountryCode>$destination_country</CountryCode>
			$additional_address
			<ResidentialAddressIndicator/>
		</Address>
	</ShipTo>
	<ShipFrom>
		<Address>
			<StateProvinceCode>$origination_state</StateProvinceCode>
			<PostalCode>$origination_postal</PostalCode>
			<CountryCode>$origination_country</CountryCode>
			<ResidentialAddressIndicator/>
		</Address>
	</ShipFrom>
	$packages
	$shipper_rate_information
  </Shipment>
</RatingServiceSelectionRequest>
EOT;

	$post=explode("\n", $request);

	if ($allow_multithreading) {
		$h_req = fn_cm_register_request('POST', $url, $post, '', '', 'text/xml');
		return array($h_req, 'fn_ups_process_result', array($code));
	} else {
		list($header, $result) = fn_https_request('POST', $url, $post, '', '', 'text/xml');
		return fn_ups_process_result($header, $result, $code, $cached_rates, $cached_rate_id);
	}
}

function fn_ups_process_result($header, $result, $code, &$cached_rates = null, $cached_rate_id = null)
{
	$rates = fn_ups_get_rates($result);

	if ($cached_rates !== null && empty($cached_rates[$cached_rate_id]) && !empty($rates)) {
		$cached_rates[$cached_rate_id] = $rates;
	}

	if (!empty($rates[$code])) {
		return array('cost' => $rates[$code]);
	} else {
		if (defined('SHIPPING_DEBUG')) {
			return array('error' => fn_ups_get_error($result));
		}
	}

	return false;
}

function fn_ups_get_error($result) 
{
	// Parse XML message returned by the UPS post server.

	$xml = @simplexml_load_string($result);
	$return = '';

	if (!empty($xml)) {
		$status_code = (string) $xml->Response->ResponseStatusCode;
		
		if ($status_code != '1') {
			$return = (string) $xml->Response->Error->ErrorDescription;
			if (!empty($xml->Response->Error->ErrorDigest)) {
				$return .= ' (' . (string) $xml->Response->Error->ErrorDigest . ').';
			}
			return $return;
		}
	}

	return false;
}

function fn_ups_get_rates($result) 
{
	$xml = @simplexml_load_string($result);
	$return = array();

	if (!empty($xml)) {
		$responseStatusCode = (string) $xml->Response->ResponseStatusCode;
		
		foreach ($xml->RatedShipment as $shipment) {
			$total_charge = 0;
			$service_code = (string) $shipment->Service->Code;
			
			// Try to get negotiated rates
			if (!empty($shipment->NegotiatedRates)) {
				$total_charge = (string) $shipment->NegotiatedRates->NetSummaryCharges->GrandTotal->MonetaryValue;
			}
			
			if (empty($total_charge)) {
				$total_charge = (string) $shipment->TotalCharges->MonetaryValue;
			}
			
			
			if (!($service_code && $total_charge)) {
				continue;
			}
			//$rated_packages = $shipment[$i]->getElementsByName("RatedPackage");
			//$days_to_delivery = $shipment[$i]->getValueByPath("/GuaranteedDaysToDelivery");
			//$delivery_time = $shipment[$i]->getValueByPath("/ScheduledDeliveryTime");
			if (!empty($total_charge)) {
				$return[$service_code] = $total_charge;
			}
		}
	}
	return $return;
}

/** /Body **/

?>
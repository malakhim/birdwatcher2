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

function fn_get_can_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination, $service_id, $allow_multithreading = false)
{
	static $cached_rates = array();

	if ($shipping_settings['can_enabled'] != 'Y') {
		return false;
	}

	$cached_rate_id = fn_generate_cached_rate_id($weight_data, $origination);

	if (!empty($cached_rates[$cached_rate_id])) {
		if (!empty($cached_rates[$cached_rate_id][$code])) {
			return array('cost' => $cached_rates[$cached_rate_id][$code]);
		} else {
			return false;
		}
	}

	$merchant_id = !empty($shipping_settings['can']['merchant_id']) ? $shipping_settings['can']['merchant_id'] : '';
	$length = !empty($shipping_settings['can']['length']) ? $shipping_settings['can']['length'] : '0';
	$width = !empty($shipping_settings['can']['width']) ? $shipping_settings['can']['width'] : '0';
	$height = !empty($shipping_settings['can']['height']) ? $shipping_settings['can']['height'] : '0';

	$origination_postal = $origination['zipcode'];
	$destination_postal = $location['zipcode'];
	$destination_country = $location['country'];
	$destination_city = $location['city'];
	$destination_state = $location['state'];

	$total_cost = $package_info['C'];
	$weight = $weight_data['full_pounds'] * 0.4536;
	$amount = '1';

	$lang = (CART_LANGUAGE == 'FR') ? 'fr' : 'en';

	$request[]=<<<XML
<?xml version="1.0" ?>
<eparcel>
	<language>$lang</language>
	<ratesAndServicesRequest>
		<merchantCPCID>$merchant_id</merchantCPCID>
		<fromPostalCode>$origination_postal</fromPostalCode>
		<turnAroundTime> 24 </turnAroundTime>
		<itemsPrice>$total_cost</itemsPrice>
		<lineItems>
			<item>
				<quantity>$amount</quantity>
				<weight>$weight</weight>
				<length>$length</length>
				<width>$width</width>
				<height>$height</height>
				<description>ggrtye</description>
				<readyToShip/>
			</item>
		</lineItems>
		<city>$destination_city</city>
		<provOrState>$destination_state</provOrState>
		<country>$destination_country</country>
		<postalCode>$destination_postal</postalCode>
	</ratesAndServicesRequest>
</eparcel>
XML;

	if ($allow_multithreading) {
		$h_req = fn_cm_register_request('POST', 'http://sellonline.canadapost.ca:30000', $request, '', '', 'text/xml');
		return array($h_req, 'fn_can_process_result', array($code));
	} else {
		list($header, $result) = fn_http_request('POST', 'http://sellonline.canadapost.ca:30000', $request);
		return fn_can_process_result($header, $result, $code, $cached_rates, $cached_rate_id);
	}
}

function fn_can_process_result($header, $result, $code, &$cached_rates = null, $cached_rate_id = null)
{
	$rates = fn_can_get_rates($result);

	if ($cached_rates !== null && empty($cached_rates[$cached_rate_id]) && !empty($rates['cost'])) {
		$cached_rates[$cached_rate_id] = $rates['cost'];
	}

	if (!empty($rates['cost'][$code])) {
		return array('cost' => $rates['cost'][$code]);
	} else {
		if (defined('SHIPPING_DEBUG')) {
			return array('error' => ((!empty($rates['error'])) ? $rates['error'] : fn_get_lang_var('service_not_available')));
		}
	}

	return false;
}

function fn_can_get_rates($result) 
{
	$doc = new XMLDocument();
	$xp = new XMLParser();
	$xp->setDocument($doc);
	$xp->parse($result);
	$doc = $xp->getDocument();
	$rates = array();

	if (is_object($doc->root)) {
		$root = $doc->getRoot();

		if ($root->getElementByName('ratesAndServicesResponse')) {

		$service_rates = $root->getElementByName('ratesAndServicesResponse');
		$shipment = $service_rates->getElementsByName('product');

			$currencies = Registry::get('currencies');
			if (!empty($currencies['CAD'])) {
				for ($i = 0; $i < count($shipment); $i++) {
					$id = $shipment[$i]->getAttribute("id");

					if (!empty($id) && $id > 0) {
						$rates[$id] = floatval($shipment[$i]->getValueByPath("rate")) * $currencies['CAD']['coefficient'];
						unset($id);
					}
				}

				$results['cost'] = $rates;

			} else {
				$results['error'] = fn_get_lang_var('canada_post_activation_error');
			}

		} elseif ($root->getElementByName('error')) {
			$results['error'] = $root->getValueByPath('/error/statusMessage');
		}
	}
	return $results;
}

?>
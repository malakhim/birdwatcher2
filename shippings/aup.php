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

function fn_get_aup_rates($code, $weight_data, $location, &$auth, $shipping_settings, $package_info, $origination, $service_id, $allow_multithreading = false)
{
	if ($shipping_settings['aup_enabled'] != 'Y') {
		return false;
	}

	$weight = $weight_data['full_pounds'] * 453.6;

	$packages_count = 1;

	$length = !empty($shipping_settings['aup']['length']) ? $shipping_settings['aup']['length'] : 0;
	$width = !empty($shipping_settings['aup']['width']) ? $shipping_settings['aup']['width'] : 0;
	$height = !empty($shipping_settings['aup']['height']) ? $shipping_settings['aup']['height'] : 0;

	if (!empty($package_info['packages'])) {
		$packages = $package_info['packages'];
		$packages_count = count($packages);
		if ($packages_count > 0) {
			// Default to parameters of first box - all boxes may not be the same, 
			// but this is best we can do if we can make only one call to Aus 
			// Post API.
			$package = $packages[0];
			
			// If there is more than one package we need to adjust the weight
			// to a weight per package.
			if ($packages_count > 1) {
				// divide total weight by number of packages.
				$weight /= $packages_count;
			}
			
			if (!empty($package['shipping_params'])) {
				$package_settings = $package['shipping_params'];
				$length = empty($package_settings['box_length']) ? 0 : $package_settings['box_length'];
				$width = empty($package_settings['box_width']) ? 0 : $package_settings['box_width'];
				$height = empty($package_settings['box_height']) ? 0 : $package_settings['box_height'];
			}
		}
	}

	//Registered Post International: price as Air Mail, plus $5, weight limit of 2kg.
	if ($code == 'RPI' && $weight > 2000) {
		return defined('SHIPPING_DEBUG') ? array('error' => fn_get_lang_var('illegal_item_weight')) : false;
	}

	$request = array(
		'Pickup_Postcode' => $origination['zipcode'],
		'Destination_Postcode' => $location['zipcode'],
		'Country' => $location['country'],
		'Weight' => $weight,
		'Length' => $length * 10,
		'Width' => $width * 10,
		'Height' => $height * 10,
		'Service_type' => ($code == 'RPI') ? 'AIR' : $code,
		'Quantity' => $packages_count,
	);
	
	if ($allow_multithreading) {
		$h_req = fn_cm_register_request('GET', 'http://drc.edeliver.com.au/ratecalc.asp', $request, '', '', 'text/xml');
		return array($h_req, 'fn_aup_process_result', array($code, $shipping_settings));
	} else {
		list ($header, $result) = fn_http_request('GET', 'http://drc.edeliver.com.au/ratecalc.asp', $request);
		return fn_aup_process_result($header, $result, $code, $shipping_settings);
	}
}

function fn_aup_process_result($header, $result, $code, $shipping_settings)
{
	if (!empty($result)) {
		$result = explode("\n", $result);
		if (preg_match("/charge=([\d\.]+)/i", $result[0], $matches)) {
			if (!empty($matches[1])) {
				$cost = (double)trim($matches[1]);
				if ($code == 'RPI') {
					$cost += (double)(!empty($shipping_settings['aup']['rpi_fee']) ? $shipping_settings['aup']['rpi_fee'] : 0);
				}
				if (!empty($shipping_settings['aup']['use_delivery_confirmation']) && $shipping_settings['aup']['use_delivery_confirmation'] == 'Y') {
					$cost += ($code == 'STANDARD' || $code == 'EXPRESS')? (double)(!empty($shipping_settings['aup']['delivery_confirmation_cost']) ? $shipping_settings['aup']['delivery_confirmation_cost'] : 0) : (double)(!empty($shipping_settings['aup']['delivery_confirmation_international_cost']) ? $shipping_settings['aup']['delivery_confirmation_international_cost'] : 0);
				}
				return array('cost' => $cost);
			} else {
				if (defined('SHIPPING_DEBUG') && preg_match("/err_msg=([\w ]*)/i", $result[2], $matches)) {
					return array('error' => $matches[1]);
				}
			}
		}
	}

	return false;
}
?>
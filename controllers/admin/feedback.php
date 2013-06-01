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


if ( !defined('AREA') )	{ die('Access denied');	}

$skip_errors = Registry::get('runtime.database.skip_errors');
Registry::set('runtime.database.skip_errors', true);

$fdata = fn_get_feedback_data($mode);

Registry::set('runtime.database.skip_errors', $skip_errors);

if ($mode == 'prepare') {
	$view->assign("fdata", $fdata);

} elseif ($mode == 'send') {
	list($headers, $result) = fn_https_request('POST', "http://helpdesk.cs-cart.com/index.php?dispatch=feedback", http_build_query(array('fdata' => $fdata)), '', '', 'application/x-www-form-urlencoded', '', '', '', array('Expect: '));
	if (empty($_REQUEST['action']) || !empty($_REQUEST['action']) && $_REQUEST['action'] != 'auto') {
		// Even if there is any problem we do not set the error.
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('feedback_is_sent_successfully'));
	}
	return array(CONTROLLER_STATUS_REDIRECT, "$index_script");
}

function fn_get_feedback_data($mode)
{
	$fdata = array();
	$fdata['tracks']['version'] = PRODUCT_VERSION;
	$fdata['tracks']['type'] = PRODUCT_TYPE;
	$fdata['tracks']['status'] = PRODUCT_STATUS;
	$fdata['tracks']['build'] = PRODUCT_BUILD;
	$fdata['tracks']['domain'] = Registry::get('config.http_host');
	$fdata['tracks']['url'] = 'http://'.Registry::get('config.http_host').Registry::get('config.http_path');

	// Sales reports usage
	$fdata['general']['sales_reports'] = db_get_field("SELECT COUNT(*) FROM ?:sales_reports");
	$fdata['general']['sales_tables'] = db_get_field("SELECT COUNT(*) FROM ?:sales_reports_tables");
	

	/**
	 * Get feedback data
	 *
	 * @param array $fdata Feedback data
	 */
	fn_set_hook('get_feedback_data', $fdata);

	// Localizations
	$fdata['general']['localizations'] = db_get_field("SELECT COUNT(*) FROM ?:localizations WHERE status='A'");

	if (PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') {
		$fdata['general']['companies'] = db_get_field("SELECT COUNT(*) FROM ?:companies");
	}
	

	// Languages usage
	$fdata['languages'] = db_get_array("SELECT lang_code, status FROM ?:languages");

	// Payments info. Here we get information about how many payments are used and whether surcharges were set.
	$fdata['payments'] = db_get_array(
		"SELECT payment_id, a.processor_id, processor_script, status, "
		. "IF(a_surcharge<>0 OR p_surcharge<>0, 'Y', 'N') as surcharge_exists "
		. "FROM ?:payments AS a LEFT JOIN ?:payment_processors USING(processor_id)"
	);

	// Currencies info. 
	$fdata['currencies'] = db_get_array("SELECT currency_code, is_primary, decimals_separator, thousands_separator, status FROM ?:currencies");

	// Settings info
	if (PRODUCT_TYPE == 'ULTIMATE') {
		$first_company_id = db_get_field("SELECT MIN(company_id) FROM ?:companies");
		if (!empty($first_company_id)) {
			$fdata['settings'] = fn_get_settings_feedback($mode, $first_company_id);
		}
	} else {
		$fdata['settings'] = fn_get_settings_feedback($mode);
	}

	// Users quantity
	$fdata['users']['customers'] =  db_get_field("SELECT COUNT(*) FROM ?:users WHERE user_type='C' AND status='A'");
	$fdata['users']['admins'] =  db_get_field("SELECT COUNT(*) FROM ?:users WHERE user_type='A' AND status='A'");
	$fdata['users']['affiliates'] =  db_get_field("SELECT COUNT(*) FROM ?:users WHERE user_type='P' AND status='A'");
	$fdata['users']['vendors'] =  db_get_field("SELECT COUNT(*) FROM ?:users WHERE user_type='V' AND status='A'");
	
	$fdata['users']['admin_usergroups'] = db_get_field("SELECT COUNT(*) FROM ?:usergroups WHERE type='A' AND status='A'");
	$fdata['users']['customer_usergroups'] = db_get_field("SELECT COUNT(*) FROM ?:usergroups WHERE type='C' AND status='A'");
	

	// Taxes info
	$fdata['taxes'] = db_get_array("SELECT address_type, price_includes_tax FROM ?:taxes WHERE status='A'");

	// Shippings
	$fdata['shippings'] = db_get_array(
		"SELECT rate_calculation, localization, a.service_id, module as carrier FROM "
		. "?:shippings AS a LEFT JOIN ?:shipping_services USING(service_id) WHERE a.status='A'"
	);

	// Destinations
	$fdata['general']['destinations'] = db_get_field("SELECT COUNT(*) FROM ?:destinations WHERE status='A'");

	// Blocks
	$fdata['general']['blocks'] = db_get_field("SELECT COUNT(*) FROM ?:bm_blocks");
	$fdata['general']['block_links'] = db_get_field("SELECT COUNT(*) FROM ?:bm_snapping");

	// Images
	$fdata['general']['images'] = db_get_field("SELECT COUNT(*) FROM ?:images");

	// Product items
	$fdata['products_stat']['total'] = db_get_field("SELECT COUNT(*) as amount FROM ?:products");
	$fdata['products_stat']['prices'] = db_get_field("SELECT COUNT(*) FROM ?:product_prices");
	$fdata['products_stat']['features'] = db_get_field("SELECT COUNT(*) FROM ?:product_features WHERE status='A'");
	$fdata['products_stat']['features_values'] = db_get_field("SELECT COUNT(*) FROM ?:product_features_values");
	$fdata['products_stat']['files'] = db_get_field("SELECT COUNT(*) FROM ?:product_files");
	$fdata['products_stat']['options'] = db_get_field("SELECT COUNT(*) FROM ?:product_options");
	$fdata['products_stat']['global_options'] = db_get_field("SELECT COUNT(*) FROM ?:product_options WHERE product_id='0'");
	$fdata['products_stat']['option_variants'] = db_get_field("SELECT COUNT(*) FROM ?:product_option_variants");
	$fdata['products_stat']['options_inventory'] = db_get_field("SELECT COUNT(*) FROM ?:product_options_inventory");
	$fdata['products_stat']['configurable'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE product_type = 'C'");
	$fdata['products_stat']['edp'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE is_edp = 'Y'");
	$fdata['products_stat']['free_shipping'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE free_shipping = 'Y'");
	
	$fdata['products_stat']['options_exceptions'] = db_get_field("SELECT COUNT(*) FROM ?:product_options_exceptions");
	$fdata['products_stat']['filters'] = db_get_field("SELECT COUNT(*) FROM ?:product_filters WHERE status='A'");
	

	// Promotions
	$fdata['promotions'] = db_get_array("SELECT stop, zone, status FROM ?:promotions");

	// Addons
	$fdata['addons'] = db_get_array("SELECT addon, status, priority FROM ?:addons ORDER BY addon");

	// Addon options
	$allowed_addons = array('access_restrictions', 'affiliate', 'discussion', 'gift_certificates', 'gift_registry', 'google_sitemap', 'live_help', 'barcode', 'polls', 'quickbooks', 'reward_points', 'rma', 'seo', 'tags');

	if (is_array($fdata['addons'])) {
		foreach ($fdata['addons'] as $k => $data) {
			if (!in_array($data['addon'], $allowed_addons)) {
				continue;
			}

			$section_info = CSettings::instance()->get_section_by_name($data['addon'], CSettings::ADDON_SECTION);

			if (empty($section_info)) {
				continue;
			}

			if (PRODUCT_TYPE == 'ULTIMATE') {
				if (!empty($first_company_id)) {
					$settings = CSettings::instance()->get_list($section_info['section_id'], 0, $first_company_id);
				}
			} else {
				$settings = CSettings::instance()->get_list($section_info['section_id']);
			}

			$settings = fn_check_feedback_value($settings);

			if ($mode == 'prepare') {
				// This line is to display addon options
				if (!empty($settings)) {
					$addons_settings = array();
					foreach ($settings as $subsection_id => $subsettings) {
						foreach($subsettings as $k => $v) {
							if (is_array($v['value'])) {
								$v['value'] = fn_to_json($v['value']);
							}
							$addons_settings[$subsection_id . '.' . $v['name']] = $v['value'];
						}
					}
					$fdata[fn_get_lang_var('options_for') . ' ' . $data['addon']] = $addons_settings;
				}
			} else {
				// This line is to send addon options
				$fdata['addons'][$k]['options'] = (!empty($settings)) ? serialize($settings): array();
			}
		}
	}

	return $fdata;
}

function fn_get_settings_feedback($mode, $company_id = null)
{

	// Exclude options that contain private information
	$exclude_options = array(
		'company_state', 
		'company_city', 
		'company_address', 
		'company_phone', 
		'company_phone_2', 
		'company_fax', 
		'company_name', 
		'company_website', 
		'company_zipcode', 
		'company_country', 
		'company_users_department', 
		'company_site_administrator', 
		'company_orders_department', 
		'company_support_department', 
		'company_newsletter_email', 
		'company_start_year', 
		'google_host', 
		'google_login', 
		'google_pass', 
		'mailer_smtp_host', 
		'mailer_smtp_auth', 
		'mailer_smtp_username', 
		'mailer_smtp_password', 
		'proxy_host', 
		'proxy_port', 
		'proxy_user', 
		'proxy_password', 
		'store_access_key',
		'cron_password', 
		'ftp_password', 
		'ftp_username', 
		'ftp_directory', 
		'ftp_hostname', 
		'license_number'
	);
	$settings = CSettings::instance()->get_list(0, 0, $company_id);
	$result = array();

	if (!empty($settings)) {
		foreach ($settings as $section_id => $subsections) {

			$section_info = CSettings::instance()->get_section_by_name($section_id, CSettings::ADDON_SECTION);
			if (!empty($section_info)) {
				continue;
			}

			foreach ($subsections as $subsection_id => $options) {
				$section_title = $section_id . '.' . (!empty($subsection_id) ? $subsection_id . '.' : '');
				foreach ($options as $option_info) {
					if ($option_info['type'] == 'H' || $option_info['type'] == 'D') {
						continue;
					}

					if (in_array($option_info['name'], $exclude_options)) {
						continue;
					}

					if ($mode == 'prepare' && is_array($option_info['value'])) {
						$option_info['value'] = fn_to_json($option_info['value']);
					}

					$result[] = array (
						'name' => $section_title . $option_info['name'],
						'value' => fn_check_feedback_value($option_info['value']),
					);
				}
			}

		}
	}

	return $result;
}

/**
 * Checks and changes setting value for the feedback if necessary
 *
 * @param string/array $value Setting value or settings array
 * @return string/array Checked value
 */
function fn_check_feedback_value($value)
{
	if (is_array($value)) {
		foreach ($value as $k =>$v) {
			$value[$k] = fn_check_feedback_value($v);
		}
	} else {
		$pattern = "/([\w-+=_]+(?:\.[\w-+=_]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)/i";
		if (preg_match_all($pattern, $value, $matches)) {
			$value = preg_replace($pattern, '[email]', $value);
		}
	}

	return $value;
}

?>
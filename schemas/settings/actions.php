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

/**
 * Check if secure connection is available
 */
function fn_settings_actions_general_secure_auth(&$new_value, $old_value)
{
	if ($new_value == 'Y') {
		if (PRODUCT_TYPE != 'ULTIMATE' || (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID'))) {
			if (PRODUCT_TYPE == 'ULTIMATE') {
				$storefront_url = fn_url('index.index?check_https=Y&company_id=' . COMPANY_ID, 'C', 'https', '&');
			} else {
				$storefront_url = Registry::get('config.https_location') . '/' . INDEX_SCRIPT . '?check_https=Y';
			}

			$content = fn_https_request('GET', $storefront_url);
			if (empty($content[1]) || $content[1] != 'OK') {
				// Disable https
				CSettings::instance()->update_value('secure_checkout', 'N', 'General');
				CSettings::instance()->update_value('secure_admin', 'N', 'General');
				CSettings::instance()->update_value('secure_auth', 'N', 'General');
				$new_value = 'N';

				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_https_disabled'));
			}
		}
	}
}

/**
 * Check if secure connection is available
 */
function fn_settings_actions_general_secure_checkout(&$new_value, $old_value) 
{
	return fn_settings_actions_general_secure_auth($new_value, $old_value);
}

/**
 * Check if secure connection is available
 */
function fn_settings_actions_general_secure_admin(&$new_value, $old_value)
{
	return fn_settings_actions_general_secure_auth($new_value, $old_value);
}

/**
 * Alter order initial ID
 */
function fn_settings_actions_general_order_start_id(&$new_value, $old_value)
{
	if (intval($new_value)) {
		db_query("ALTER TABLE ?:orders AUTO_INCREMENT = ?i", $new_value);
	}
}

/**
 * Save empty value if has no checked check boxes
 */
function fn_settings_actions_general_search_objects(&$new_value, $old_value)
{	
	if ($new_value == 'N') {
		$new_value = '';
	}
}

/**
 * Enable/disable revisions objects
 */
function fn_settings_actions_general_active_revisions_objects(&$new_value, $old_value)
{
	if ($new_value != 'N') {
		$old = Registry::get('settings.General.active_revisions_objects');

		include_once(DIR_CORE . 'fn.revisions.php');
		fn_init_revisions();

		parse_str($new_value, $new);
		$revisions = Registry::get('revisions');

		$skip = array ();
		$show_notification = false;

		if ($revisions) {
			foreach ($old as $key => $rec) {
				if ($rec == 'N' && isset($new[$key])) {
					fn_create_revision_tables();
					fn_revisions_set_object_active($key);
					fn_echo(fn_get_lang_var('creating_revisions') . ' ' . fn_get_lang_var($revisions['objects'][$key]['title']));
					fn_revisions_delete_objects($key);
					fn_revisions_create_objects($key, true);
					fn_echo(' ' .fn_get_lang_var('done') . '<br>');
					$show_notification = true;
				} elseif ($rec == 'Y' && !isset($new[$key])) {
					fn_echo(fn_get_lang_var('deleting_revisions') . ' ' . fn_get_lang_var($revisions['objects'][$key]['title']));
					fn_revisions_delete_objects($key);
					fn_echo(' ' .fn_get_lang_var('done') . '<br>');
				}

				$skip[] = $key;
			}

			if (!empty($new)) {
				foreach ($new as $object => $_v) {
					if (!in_array($object, $skip) && $object != 'N') {
						fn_create_revision_tables();
						fn_revisions_set_object_active($object);
							fn_echo(fn_get_lang_var('creating_revisions') . ' ' . fn_get_lang_var($revisions['objects'][$object]['title']));
						fn_revisions_delete_objects($object);
						fn_revisions_create_objects($object, true);
						fn_echo(' ' .fn_get_lang_var('done') . '<br>');
						$show_notification = true;
					}
				}
			}
			if ($show_notification) {
				$msg = fn_get_lang_var('warning_create_workflow');
				$msg = str_replace('[link]', fn_url("revisions_workflow.manage", 'A'), $msg);
				fn_set_notification('E', fn_get_lang_var('warning'), $msg, 'S');
			}
		}
	} else {
		Registry::set('revisions', null);
		$new_value = '';
	}
}

/**
 * Enable/disable Canada Post
 */
function fn_settings_actions_shippings_can_enabled(&$new_value, $old_value)
{
	$currencies = Registry::get('currencies');
	if ($new_value == 'Y' && empty($currencies['CAD'])) {
		fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('canada_post_activation_error'), 'S');
		$new_value = 'N';
	}
}

/**
 * Enable/disable EMS
 */
function fn_settings_actions_shippings_ems_enabled(&$new_value, $old_value)
{
	$currencies = Registry::get('currencies');
	if ($new_value == 'Y' && (empty($currencies['RUB']) || $currencies['RUB']['is_primary'] == 'N')) {
		fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('ems_activation_error'), 'S');
		$new_value = 'N';
	}
}

/**
 * Enable/disable Russian Post
 */
function fn_settings_actions_shippings_russian_post_enabled(&$new_value, $old_value)
{
        $currencies = Registry::get('currencies');
        if ($new_value == 'Y' && (empty($currencies['RUB']) || $currencies['RUB']['is_primary'] == 'N')) {
            fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('russian_post_activation_error'), 'S');
            $new_value = 'N';
        } elseif ($new_value == 'Y') {
            fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('russian_post_consuming_error'));
        }
}

function fn_settings_actions_shippings_edost_enabled(&$new_value, $old_value)
{
    $currencies = Registry::get('currencies');
    if ($new_value == 'Y' && (empty($currencies['RUB']) || $currencies['RUB']['is_primary'] == 'N')) {
        fn_delete_notification('changes_saved');
        fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('edost_activation_error'), 'S');
        $new_value = 'N';
    }
}

function fn_settings_actions_upgrade_center_license_number($new_value, $old_value)
{
	if (!empty($new_value)) {
		$data = Helpdesk::get_license_information($new_value);
		Helpdesk::parse_license_information($data, $_SESSION['auth']);
	}
}

?>

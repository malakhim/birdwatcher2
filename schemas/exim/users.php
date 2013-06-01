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

$schema = array (
	'section' => 'users',
	'pattern_id' => 'users',
	'name' => fn_get_lang_var('users'),
	'key' => array('user_id'),
	'order' => 0,
	'table' => 'users',
	'references' => array (
		'user_profiles' => array (
			'reference_fields' => array('user_id' => '#key', 'profile_type' => 'P'),
			'join_type' => 'LEFT'
		),
	),
	'range_options' => array (
		'selector_url' => 'profiles.manage',
		'object_name' => fn_get_lang_var('users'),
	),
	'options' => array (
		'lang_code' => array (
			'title' => 'language',
			'type' => 'languages',
		),
	),
	'export_fields' => array (
		'E-mail' => array (
			'db_field' => 'email',
			'alt_key' => true,
			'required' => true,
		),
		'Login' => array (
			'db_field' => 'user_login'
		),
		'User type' => array (
			'db_field' => 'user_type'
		),
		'Status' => array (
			'db_field' => 'status'
		),
		
		'User group IDs' => array (
			'process_get' => array ('fn_exim_get_usergroups', '#key'),
			'process_put' => array ('fn_exim_set_usergroups', '#key', '#this'),
			'linked' => false, // this field is not linked during import-export
		),
		
		'Password' => array (
			'db_field' => 'password',
			'pre_insert' => array('fn_exim_process_password', '#this'),
		),
		'Salt' => array (
			'db_field' => 'salt'
		),
		'Title' => array (
			'db_field' => 'title'
		),
		'First name' => array (
			'db_field' => 'firstname'
		),
		'Last name' => array (
			'db_field' => 'lastname'
		),
		'Company' => array (
			'db_field' => 'company'
		),
		'Fax' => array (
			'db_field' => 'fax'
		),
		'Phone' => array (
			'db_field' => 'phone'
		),
		'Web site' => array (
			'db_field' => 'url'
		),
		'Tax exempt' => array (
			'db_field' => 'tax_exempt'
		),
		'Registration date' => array (
			'db_field' => 'timestamp',
			'process_get' => array ('fn_timestamp_to_date', '#this'),
			'convert_put' => array ('fn_date_to_timestamp'),
			'default' => array ('time')
		),
		'Language' => array (
			'db_field' => 'lang_code'
		),
		'Billing: title' => array (
			'db_field' => 'b_title',
			'table' => 'user_profiles',
		),
		'Billing: first name' => array (
			'db_field' => 'b_firstname',
			'table' => 'user_profiles',
		),
		'Billing: last name' => array (
			'db_field' => 'b_lastname',
			'table' => 'user_profiles',
		),
		'Billing: address' => array (
			'db_field' => 'b_address',
			'table' => 'user_profiles',
		),
		'Billing: address (line 2)' => array (
			'db_field' => 'b_address_2',
			'table' => 'user_profiles',
		),
		'Billing: city' => array (
			'db_field' => 'b_city',
			'table' => 'user_profiles',
		),
		'Billing: state' => array (
			'db_field' => 'b_state',
			'table' => 'user_profiles',
		),
		'Billing: country' => array (
			'db_field' => 'b_country',
			'table' => 'user_profiles',
		),
		'Billing: zipcode' => array (
			'db_field' => 'b_zipcode',
			'table' => 'user_profiles',
		),
		'Billing: phone' => array (
			'db_field' => 'b_phone',
			'table' => 'user_profiles',
		),
		'Shipping: title' => array (
			'db_field' => 's_title',
			'table' => 'user_profiles',
		),
		'Shipping: first name' => array (
			'db_field' => 's_firstname',
			'table' => 'user_profiles',
		),
		'Shipping: last name' => array (
			'db_field' => 's_lastname',
			'table' => 'user_profiles',
		),
		'Shipping: address' => array (
			'db_field' => 's_address',
			'table' => 'user_profiles',
		),
		'Shipping: address (line 2)' => array (
			'db_field' => 's_address_2',
			'table' => 'user_profiles',
		),
		'Shipping: city' => array (
			'db_field' => 's_city',
			'table' => 'user_profiles',
		),
		'Shipping: state' => array (
			'db_field' => 's_state',
			'table' => 'user_profiles',
		),
		'Shipping: country' => array (
			'db_field' => 's_country',
			'table' => 'user_profiles',
		),
		'Shipping: zipcode' => array (
			'db_field' => 's_zipcode',
			'table' => 'user_profiles',
		),
		'Shipping: phone' => array (
			'db_field' => 's_phone',
			'table' => 'user_profiles',
		),
		'Extra fields' => array (
			'linked' => false,
			'process_get' => array('fn_exim_get_extra_fields', '#key', '@lang_code'),
			'process_put' => array('fn_exim_set_extra_fields', '#this', '#key')
		),
	),
);

if (PRODUCT_TYPE == 'ULTIMATE') {
	if (!defined('COMPANY_ID')) {
		$schema['export_fields']['Store'] = array (
			'db_field' => 'company_id',
			'process_get' => array('fn_exim_get_company_name', '#this'),
		);
	}
}


function fn_exim_process_password($user_data, $skip_record)
{
	$password = '';

	if (strlen($user_data['password']) == 32) {
		$password = $user_data['password'];
	} else {
		if (!isset($user_data['salt']) || empty($user_data['salt'])) {
			$password = md5($user_data['password']);
		} else {
			$password = fn_generate_salted_password($user_data['password'], $user_data['salt']);
		}
	}

	return $password;
}

function fn_exim_get_extra_fields($user_id, $lang_code = CART_LANGUAGE)
{
	$fields = array();

	$_user = db_get_hash_single_array("SELECT d.description, f.value FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s WHERE f.object_id = ?i AND f.object_type = 'U'", array('description', 'value'), $lang_code, $user_id);

	$_profile = db_get_hash_single_array("SELECT d.description, f.value FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s LEFT JOIN ?:user_profiles as p ON f.object_id = p.profile_id AND f.object_type = 'P' WHERE p.user_id = ?i", array('description', 'value'), $lang_code, $user_id);

	if (!empty($_user)) {
		$fields['user'] = $_user;
	}
	if (!empty($_profile)) {
		$fields['profile'] = $_profile;
	}

	if (!empty($fields)) {
		return fn_to_json($fields);
	}

	return '';
}

function fn_exim_set_extra_fields($data, $user_id)
{
	$data = fn_from_json($data);

	if (is_array($data) && !empty($data)) {
		foreach ($data as $type => $_data) {
			foreach ($_data as $field => $value) {
				// Check if field is exist
				$field_id = db_get_field("SELECT object_id FROM ?:profile_field_descriptions WHERE description = ?s AND object_type = 'F' LIMIT 1", $field);
				if (!empty($field_id)) {
					$update = array (
						'object_id' => (($type == 'user') ? $user_id : (db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i LIMIT 1", $user_id))),
						'object_type' => (($type == 'user') ? 'U' : 'P'),
						'field_id' => $field_id,
						'value' => $value
					);

					db_query('REPLACE INTO ?:profile_fields_data ?e', $update);
				}
			}
		}

		return true;
	}

	return false;
}


function fn_exim_get_usergroups($user_id)
{
	$pair_delimiter = ':';
	$set_delimiter = '; ';

	$result = array();
	$usergroups = db_get_array("SELECT usergroup_id, status FROM ?:usergroup_links WHERE user_id = ?i", $user_id);
	if (!empty($usergroups)) {
		foreach ($usergroups as $ug) {
			$result[] = $ug['usergroup_id'] . $pair_delimiter . $ug['status'];
		}
	}

	return !empty($result) ? implode($set_delimiter, $result) : '';
}

function fn_exim_set_usergroups($user_id, $data)
{
	$pair_delimiter = ':';
	$set_delimiter = '; ';

	db_query("DELETE FROM ?:usergroup_links WHERE user_id = ?i", $user_id);
	if (!empty($data)) {
		$usergroups = explode($set_delimiter, $data);
		if (!empty($usergroups)) {
			foreach ($usergroups as $ug) {
				$ug_data = explode($pair_delimiter, $ug);
				if (is_array($ug_data)) {
					// Check if user group exists
					$ug_id = db_get_field("SELECT usergroup_id FROM ?:usergroups WHERE usergroup_id = ?i", $ug_data[0]);
					if (!empty($ug_id)) {
						$_data = array (
							'user_id' => $user_id,
							'usergroup_id' => $ug_id,
							'status' => $ug_data[1]
						);
						db_query('REPLACE INTO ?:usergroup_links ?e', $_data);
					}
				}
			}
		}
	}

	return true;
}

?>
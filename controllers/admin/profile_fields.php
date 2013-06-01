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

// ----------
// fields types:
// I - input
// T - textarea
// C - checkbox
// S - selectbox
// R - radiobutton
// H - header
// D - data
// P - phone
// N - number
// --
// L - titles
// A - states
// O - country
// M - usergroup
// W - password

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$_suffix = '.manage';
	
	if ($mode == 'update') {
		$field_data = $_REQUEST['field_data'];

		$field_id = fn_update_profile_field($field_data, $_REQUEST['field_id'], DESCR_SL);

		$_suffix = '.update&field_id=' . $field_id;
	}

	if ($mode == 'm_update') {
		if (!empty($_REQUEST['fields_data'])) {
			$fields_data = $_REQUEST['fields_data'];
			if (isset($fields_data['email'])) {
				foreach ($fields_data['email'] as $enable_for => $field_id) {
					$fields_data[$field_id][$enable_for] = 'Y';
				}

				unset($fields_data['email']);
			}

			foreach ($fields_data as $field_id => $data) {
				fn_update_profile_field($data, $field_id, DESCR_SL);
			}
		}
	}

	if ($mode == 'delete') {
		if (!empty($_REQUEST['field_ids'])) {
			foreach ($_REQUEST['field_ids'] as $field_id) {
				fn_delete_profile_field($field_id);
			}
		}

		if (!empty($_REQUEST['value_ids'])) {
			foreach ($_REQUEST['value_ids'] as $value_id) {
				db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type = 'V'", $value_id);
				db_query("DELETE FROM ?:profile_field_values WHERE value_id = ?i", $value_id);
			}
		}
	}

	return array(CONTROLLER_STATUS_OK, 'profile_fields' . $_suffix);
}


if ($mode == 'manage') {

	$profile_fields = fn_get_profile_fields('ALL', array(), DESCR_SL);

	$view->assign('profile_fields_areas', fn_profile_fields_areas());
	$view->assign('profile_fields', $profile_fields);

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['field_id'])) {
		fn_delete_profile_field($_REQUEST['field_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "profile_fields.manage");

} elseif ($mode == 'update' || $mode == 'add') {

	fn_add_breadcrumb(fn_get_lang_var('profile_fields'), "profile_fields.manage");

	if ($mode == 'update') {
		$params['field_id'] = $_REQUEST['field_id'];
		$field = fn_get_profile_fields('ALL', array(), DESCR_SL, $params);

		$view->assign('field', $field);
	}
	
	$view->assign('profile_fields_areas', fn_profile_fields_areas());

}

// -------------- Functions ----------------
function fn_add_field_values($values = array(), $field_id = 0)
{
	if (empty($values) || empty($field_id)) {
		return false;
	}

	foreach ($values as $_v) {

		if (empty($_v['description'])) {
			continue;
		}
		// Insert main data
		$_data = fn_check_table_fields($_v, 'profile_field_values');
		$_data['field_id'] = $field_id;
		$value_id = db_query("INSERT INTO ?:profile_field_values ?e", $_data);

		// Insert descriptions
		$_data = array (
			'object_id' => $value_id,
			'object_type' => 'V',
			'description' => $_v['description'],
		);

		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
			db_query("INSERT INTO ?:profile_field_descriptions ?e", $_data);
		}
	}

	return true;
}

function fn_delete_field_values($field_id, $value_ids = array())
{
	if (empty($value_ids)) {
		$value_ids = db_get_fields("SELECT value_id FROM ?:profile_field_values WHERE field_id = ?i", $field_id);
	}

	if (!empty($value_ids)) {
		db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id IN (?n) AND object_type = 'V'", $value_ids);
		db_query("DELETE FROM ?:profile_field_values WHERE value_id IN (?n)", $value_ids);
	}
}

function fn_delete_profile_field($field_id, $no_match = false)
{
	$matching_id = db_get_field("SELECT matching_id FROM ?:profile_fields WHERE field_id = ?i", $field_id);
	if (!$no_match && !empty($matching_id)) {
		fn_delete_profile_field($matching_id, true);
	}

	fn_delete_field_values($field_id);
	db_query("DELETE FROM ?:profile_fields WHERE field_id = ?i", $field_id);
	db_query("DELETE FROM ?:profile_fields_data WHERE field_id = ?i", $field_id);
	db_query("DELETE FROM ?:profile_field_descriptions WHERE object_id = ?i AND object_type = 'F'", $field_id);
}

function fn_profile_fields_areas()
{
	$areas = array (
		'profile' => 'profile',
		'checkout' => 'checkout'
	);

	fn_set_hook('profile_fields_areas', $areas);

	return $areas;
}

function fn_update_profile_field($field_data, $field_id, $lang_code = DESCR_SL)
{
	if (empty($field_id)) {

		$add_match = false;

		if ($field_data['section'] == 'BS') {
			$field_data['section'] = 'B';
			$add_match = true;
		}

		// Insert main data
		$field_id = db_query("INSERT INTO ?:profile_fields ?e", $field_data);
		
		// Insert descriptions
		$_data = array (
			'object_id' => $field_id,
			'object_type' => 'F',
			'description' => $field_data['description'],
		);

		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
			db_query("INSERT INTO ?:profile_field_descriptions ?e", $_data);
		}

		if (substr_count('SR', $field_data['field_type']) && is_array($field_data['add_values']) && $add_match == false) {
			fn_add_field_values($field_data['add_values'], $field_id);
		}

		if ($add_match == true) {
			$field_data['section'] = 'S';
			$field_data['matching_id'] = $field_id;
			
			// Update match for the billing field
			$s_field_id = fn_update_profile_field($field_data, 0, $lang_code);
			if (!empty($s_field_id)) {				
				db_query('UPDATE ?:profile_fields SET matching_id = ?i WHERE field_id = ?i', $s_field_id, $field_id);
			}
		}
		
	} else {
		db_query("UPDATE ?:profile_fields SET ?u WHERE field_id = ?i", $field_data, $field_id);

		if (!empty($field_data['matching_id']) && $field_data['section'] == 'S') {
			db_query('UPDATE ?:profile_fields SET field_type = ?s WHERE field_id = ?i', $field_data['field_type'], $field_data['matching_id']);
		}

		db_query("UPDATE ?:profile_field_descriptions SET ?u WHERE object_id = ?i AND object_type = 'F' AND lang_code = ?s", $field_data, $field_id, $lang_code);

		if (!empty($field_data['field_type'])) {
			if (strpos('SR', $field_data['field_type']) !== false) {
				if (!empty($field_data['values'])) {
					foreach ($field_data['values'] as $value_id => $vdata) {
						$_data = fn_check_table_fields($vdata, 'profile_field_values');
						db_query("UPDATE ?:profile_field_values SET ?u WHERE value_id = ?i", $_data, $value_id);
						db_query("UPDATE ?:profile_field_descriptions SET ?u WHERE object_id = ?i AND object_type = 'V' AND lang_code = ?s", $vdata, $value_id, $lang_code);
					}

					// Completely delete removed values
					$existing_ids = db_get_fields("SELECT value_id FROM ?:profile_field_values WHERE field_id = ?i", $field_id);
					$val_ids = array_diff($existing_ids, array_keys($field_data['values']));

					if (!empty($val_ids)) {
						fn_delete_field_values($field_id, $val_ids);
					}
				} else {
					if (isset($field_data['add_values'])) {
						fn_delete_field_values($field_id);
					}
				}

				if (!empty($field_data['add_values']) && is_array($field_data['add_values'])) {
					fn_add_field_values($field_data['add_values'], $field_id);
				}
			} else {
				fn_delete_field_values($field_id);
			}
		}
	}

	return $field_id;
}

?>

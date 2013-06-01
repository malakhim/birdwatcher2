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


/* HOOKS */

function fn_mve_get_product_filter_fields(&$fields)
{
	$fields['S'] = array (
		'db_field' => 'company_id',
		'table' => 'products',
		'description' => 'vendor',
		'condition_type' => 'F',
		'range_name' => 'company',
		'foreign_table' => 'companies',
		'foreign_index' => 'company_id'
	);
}

function fn_mve_get_filter_range_name_post($range_name, $range_type, $range_id)
{
	if ($range_type == 'S') {
		$range_name = db_get_field("SELECT company FROM ?:companies WHERE company_id = ?i AND lang_code = ?s", $range_id, CART_LANGUAGE);
	}
}

function fn_mve_delete_user($user_id, $user_data)
{
	if ($user_data['is_root'] == 'Y') {
		db_query("UPDATE ?:users SET is_root = 'Y' WHERE company_id = ?i LIMIT 1", $user_data['company_id']);
	}
}

function fn_mve_get_user_type_description($type_descr)
{
	$type_descr['S']['V'] = 'vendor_administrator';
	$type_descr['P']['V'] = 'vendor_administrators';
}

function fn_mve_get_user_types($types)
{
	if (defined('COMPANY_ID') && COMPANY_ID > 0) {
		unset($types['A']);
	}

	if (!defined('COMPANY_ID') || defined('COMPANY_ID') && COMPANY_ID != 0) {
		$types['V'] = 'add_vendor_administrator';
	}
}

function fn_mve_user_need_login($types)
{
	$types[] = 'V';
}

function fn_mve_place_order($order_id, $action, $__order_status, $cart)
{
	$order_info = fn_get_order_info($order_id);
	if ($order_info['is_parent_order'] != 'Y') {
		// Check if the order already placed
		$payout_id = db_get_field('SELECT payout_id FROM ?:vendor_payouts WHERE order_id = ?i', $order_id);
		
		$company_data = fn_get_company_data($order_info['company_id'], DESCR_SL, false);
		$company_data['commission'] = $order_info['total'] > 0 ? $company_data['commission'] : 0;
		$company_data['commission_type'] = isset($company_data['commission_type']) ? $company_data['commission_type'] : '';
		$commission_amount = 0;
		
		if ($company_data['commission_type'] == 'P') {
			//Calculate commission amount and check if we need to include shipping cost
			$commission_amount = (($order_info['total'] - (Registry::get('settings.Suppliers.include_shipping') == 'N' ?  $order_info['shipping_cost'] : 0)) * $company_data['commission'])/100;
		} else {
			$commission_amount = $company_data['commission'];
		}

		//Check if we need to take payment surcharge from vendor
		if (Registry::get('settings.Suppliers.include_payment_surcharge') == 'Y') {
			$commission_amount += $order_info['payment_surcharge'];
		}

		$_data = array(
			'company_id' => $order_info['company_id'],
			'order_id' => $order_id,
			'payout_date' => TIME,
			'start_date' => TIME,
			'end_date' => TIME,
			'commission' => $company_data['commission'],
			'commission_type' => $company_data['commission_type'],
			'order_amount' => $order_info['total'],
			'commission_amount' => $commission_amount
		);

		fn_set_hook('mve_place_order', $order_info, $company_data, $action, $__order_status, $cart, $_data);

		if ($commission_amount > $order_info['total']) {
			$commission_amount = $order_info['total'];
		}

		if (empty($payout_id)) {		
			db_query('INSERT INTO ?:vendor_payouts ?e', $_data);
		} else {
			db_query('UPDATE ?:vendor_payouts SET ?u WHERE payout_id = ?i', $_data, $payout_id);
		}
	}
}

function fn_mve_delete_category_post($category_id)
{
	db_query("UPDATE ?:companies SET categories = ?p", fn_remove_from_set('categories', $category_id));
}

function fn_mve_export_process($pattern, $export_fields, $options, $conditions, $joins, $table_fields, $processes)
{
	if (defined('COMPANY_ID')) {
		if ($pattern['section'] == 'products') {
			// Limit scope to the current vendor's products only (if in vendor mode)
			$company_condition = fn_get_company_condition('products.company_id', false);
			if (!empty($company_condition)) {
				$conditions[] = $company_condition;
			}
		}
		
		if ($pattern['section'] == 'products' && $pattern['pattern_id'] == 'product_combinations') {
			$joins[] = 'INNER JOIN ?:products AS products ON (products.product_id = product_options_inventory.product_id)';	
		}
		
		if ($pattern['section'] == 'orders') {
			$company_condition = fn_get_company_condition('orders.company_id', false);
			
			if (!empty($company_condition)) {
				$conditions[] = $company_condition;
			}
		}
		
		if ($pattern['section'] == 'users') {
			$company_condition = fn_get_company_condition('orders.company_id', false);
			
			if (!empty($company_condition)) {
				$u_ids = db_get_fields('SELECT users.user_id FROM ?:users AS users LEFT JOIN ?:orders AS orders ON (users.user_id = orders.user_id) WHERE ' . $company_condition . ' GROUP BY users.user_id');
			}
			
			$conditions[] = db_quote('users.user_id IN (?a)', $u_ids);
			
		}
	}
}

function fn_mve_get_users(&$params, &$fields, &$sortings, &$condition, &$join)
{
	if (isset($params['company_id']) && $params['company_id'] != '') {
		$condition .= db_quote(' AND ?:users.company_id = ?i ', $params['company_id']);
	}
	
	if (defined('COMPANY_ID')) {
		if (empty($params['user_type'])) {
			$condition .= db_quote(" AND (?:users.user_id IN (?n) OR (?:users.user_type != ?s AND" . fn_get_company_condition('?:users.company_id', false) . ")) ", fn_get_company_customers_ids(COMPANY_ID), 'C');
		} elseif (fn_check_user_type_admin_area ($params['user_type'])) {
			$condition .= fn_get_company_condition('?:users.company_id');
		} elseif ($params['user_type'] == 'C') {
			$condition .= db_quote(" AND ?:users.user_id IN (?n) ", fn_get_company_customers_ids(COMPANY_ID));
		}
	}
}

/**
 * Hook is used for changing query that selects primary object ID.
 *
 * @param array $pattern Array with import pattern data
 * @param array $_alt_keys Array with key=>value data of possible primary object (used for 'where' condition)
 * @param array $v Array with importing data (one row)
 * @param boolean $skip_get_primary_object_id Skip or not getting Primary object ID
 */
function fn_mve_import_get_primary_object_id($pattern, $_alt_keys, $v, $skip_get_primary_object_id)
{
	if ($pattern['section'] == 'products' && $pattern['pattern_id'] == 'products') {
		if (defined('COMPANY_ID')) {
			$_alt_keys['company_id'] = COMPANY_ID;
		} elseif (!empty($v['company'])) {
			// field vendor is set
			$company_id = fn_get_company_id_by_name($v['company']);

			if ($company_id !== null) {
				$_alt_keys['company_id'] = $company_id;
			} else {
				$skip_get_primary_object_id = true;
			}
		} else {
			// field vendor is not set, so import for the base company
			$_alt_keys['company_id'] = 0;
		}
	}
}

function fn_mve_import_process_data($primary_object_id, $v, $pattern, $options, $processed_data, $processing_groups, $skip_record)
{
	static $company_categories     = null;
	static $company_categories_ids = null;

	if (defined('COMPANY_ID')) {
		unset($v['company']);
		if ($pattern['section'] == 'products' && in_array($pattern['pattern_id'], array('products', 'product_images', 'qty_discounts'))) {
			// Check the product data
			if ($pattern['pattern_id'] == 'products') {
				$v['company_id'] = COMPANY_ID;
				// Check the category name
				if (!empty($v['Category'])) {
					if (strpos($v['Category'], $options['category_delimiter']) !== false) {
						$paths = explode($options['category_delimiter'], $v['Category']);
						array_walk($paths, 'fn_trim_helper');
					} else {
						$paths[] = $v['Category'];
					}
					
					if (!empty($paths)) {
						$parent_id = 0;
						foreach ($paths as $category) {
							$category_id = db_get_field("SELECT ?:categories.category_id FROM ?:category_descriptions INNER JOIN ?:categories ON ?:categories.category_id = ?:category_descriptions.category_id WHERE ?:category_descriptions.category = ?s AND lang_code = ?s AND parent_id = ?i", $category, $options['lang_code'], $parent_id);
							if (empty($category_id)) {
								$skip_record = true;
								return false;
							}
							$parent_id = $category_id;
						}
						if ($company_categories === null) {
							$company_categories = Registry::get('s_companies.' . COMPANY_ID . '.categories');
							$company_categories_ids = explode(',', $company_categories);
						}
						$allow = empty($company_categories) || in_array($parent_id, $company_categories_ids);
						
						if (!$allow) {
							$skip_record = true;
							return false;
						}
					}
				}
			}

			if (!empty($primary_object_id)) {
				list($field, $value) = each($primary_object_id);
				$company_id = db_get_field('SELECT company_id FROM ?:products WHERE ' . $field . ' = ?s', $value);
				
				if ($company_id != COMPANY_ID) {
					$processed_data['S']++;
					$skip_record = true;
				}
			}
		} elseif ($pattern['section'] == 'products' && $pattern['pattern_id'] == 'product_combinations') {
			if (empty($primary_object_id) && empty($v['product_id'])) {
				$processed_data['S']++;
				$skip_record = true;
				
				return false;
			}
			
			if (!empty($primary_object_id)) {
				list($field, $value) = each($primary_object_id);
				$company_id = db_get_field('SELECT company_id FROM ?:products WHERE ' . $field . ' = ?s', $value);
			} else {
				$company_id = db_get_field('SELECT company_id FROM ?:products WHERE product_id = ?i', $v['product_id']);
			}
			
			if ($company_id != COMPANY_ID) {
				$processed_data['S']++;
				$skip_record = true;
			}
		}
	}
}

function fn_mve_set_admin_notification($auth)
{
	if ($auth['company_id'] == 0 && fn_check_permissions('companies', 'manage_vendors', 'admin')) {

		$count = db_get_field("SELECT COUNT(*) FROM ?:companies WHERE status IN ('N', 'P')");

		if ($count > 0) {
			$msg = fn_get_lang_var('text_not_approved_vendors');
			$msg = str_replace(']', '</a>', $msg);
			$msg = str_replace('[', '<a href="' . fn_url('companies.manage?status[]=N&status[]=P') . '">', $msg);
			fn_set_notification('W', fn_get_lang_var('notice'), $msg, 'K');
		}
	}
}

function fn_mve_get_companies(&$params, &$fields, &$sortings, &$condition, &$join, &$auth, &$lang_code)
{
	if (!empty($params['get_description'])) {
		$fields[] = '?:company_descriptions.company_description';
		$join .= db_quote(' LEFT JOIN ?:company_descriptions ON ?:company_descriptions.company_id = ?:companies.company_id AND ?:company_descriptions.lang_code = ?s ', CART_LANGUAGE);
	}
}

function fn_mve_delete_order($order_id)
{
	$parent_id = db_get_field("SELECT parent_order_id FROM ?:orders WHERE order_id = ?i", $order_id);
	if ($parent_id) {
		$count = db_get_field("SELECT COUNT(*) FROM ?:orders WHERE parent_order_id = ?i", $parent_id);
		if ($count == 1) { //this is the last child order, so we can delete the parent order.
			fn_delete_order($parent_id);
		}
	}
}

function fn_mve_get_user_info_pre($condition)
{
	if (trim($condition)) {
		if (COMPANY_ID > 0) {
			$condition = "(user_type = 'V' $condition)";
		} else {
			$condition = "(user_type = 'A' $condition)";
		}
		$company_customers = db_get_fields("SELECT user_id FROM ?:orders WHERE company_id = ?i", COMPANY_ID);
		if ($company_customers) {
			$condition = db_quote("(user_id IN (?n) OR $condition)", $company_customers);
		}
		$condition = " AND $condition ";
	}
}

function fn_mve_get_product_options($fields, $condition, $join, $extra_variant_fields, $product_ids, $lang_code)
{
	$condition .= fn_get_company_condition('a.company_id', true, '', true);
}

function fn_mve_get_product_global_options_before_select($params, $fields, $condition, $join)
{
	$condition .= fn_get_company_condition('company_id', true, '', true);
}

function fn_mve_get_product_option_data_pre($option_id, $product_id, $fields, $condition, $join, $extra_variant_fields, $lang_code)
{
	$condition .= fn_get_company_condition('company_id', true, '', true);
}

function fn_mve_clone_page_pre($page_id, $data)
{
	if (!fn_check_company_id('pages', 'page_id', $page_id)) {
		fn_company_access_denied_notification(false);
		unset($data);
	}
}

function fn_mve_update_page_post($page_data, $page_id, $lang_code, $create, $old_page_data)
{
	if (empty($page_data['page'])) {
		return false;
	}

	if (!$create) {
		//update page
		$page_childrens = db_get_fields("SELECT page_id FROM ?:pages WHERE id_path LIKE ?l AND parent_id != 0", '%' . $page_id . '%');
		
		if (!empty($page_childrens)) {
			//update childrens company if we update company for root page.
			if ($page_data['parent_id'] == 0 || $old_page_data['parent_id'] == 0) {
				fn_change_page_company($page_id, $page_data['company_id']);
			}
		}
	}
}
/* FUNCTIONS */

function fn_companies_place_suborders($order_id, $cart, &$auth, $action)
{
	$rewrite_order_id = empty($cart['rewrite_order_id']) ? array() : $cart['rewrite_order_id'];
	foreach ($cart['companies'] as $company_id) {
		$_cart = $cart;
		$_auth = & $auth;
		$total_products_price = 0;
		$total_shipping_cost = 0;
		$total_company_part = 0;
		foreach ($_cart['products'] as $product_id => $product) {
			if ($product['company_id'] != $company_id) {
				unset($_cart['products'][$product_id]);
			} else {
				$total_products_price += $product['price'];
			}
		}

		foreach ($_cart['shipping'] as $s_id => $shipping) {
			$total_shipping_cost += !empty($shipping['rates'][$company_id]) ? $shipping['rates'][$company_id] : 0;
		}

		$total_company_part = (($total_products_price + $total_shipping_cost)*100) / ($cart['subtotal'] + $cart['shipping_cost']);
		$_cart['payment_surcharge'] = $total_company_part * $cart['payment_surcharge'] / 100;
		$_cart['recalculate'] = true;
		$_cart['rewrite_order_id'] = array();
		if ($next_id = array_shift($rewrite_order_id)) {
			$_cart['rewrite_order_id'][] = $next_id;
		}
		
		$_cart['company_id'] = $company_id;
		$_cart['parent_order_id'] = $order_id;

		fn_calculate_cart_content($_cart, $_auth);
		fn_calculate_payment_taxes($_cart, $_auth);
		
		fn_place_order($_cart, $_auth, $action, $order_id);
	}
}

function fn_check_addon_permission($addon)
{
	$schema = fn_get_schema('permissions', 'vendor');
	$schema = $schema['addons'];

	if (isset($schema[$addon]['permission'])) {
		$permission = $schema[$addon]['permission'];
	}

	return isset($permission) ? $permission : true;
}

function fn_company_access_denied_notification($save_post_data = true)
{
	if ($save_post_data) {
		fn_save_post_data();
	}
	fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('access_denied'));
}

function fn_companies_get_payouts($params = array())
{
	$params = fn_init_view('balance', $params);
	
	$default_params = array(
		'sort_by' => 'vendor',
		'sort_order' => 'asc',
	);

	$params = array_merge($default_params, $params);

	$fields = array();
	$join = ' ';
	
	// Define sort fields
	$sortings = array(
		'sort_vendor' => 'companies.company',
		'sort_period' => 'payouts.start_date',
		'sort_amount' => 'payout_amount',
		'sort_date' => 'payouts.payout_date',
	);

	$directions = array(
		'asc' => 'asc',
		'desc' => 'desc'
	);
	
	$condition = $date_condition = ' 1 ';
	
	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page']; // default page is 1
	$params['items_per_page'] = empty($params['items_per_page']) ? Registry::get('settings.Appearance.admin_elements_per_page') : $params['items_per_page'];
	
	$join .= ' LEFT JOIN ?:orders AS orders ON (payouts.order_id = orders.order_id)';
	$join .= ' LEFT JOIN ?:companies AS companies ON (payouts.company_id = companies.company_id)';
	
	if (!isset($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'sort_vendor';
	}
	
	// If the sales period not defined, specify it as 'All'
	if (empty($params['time_from']) && empty($params['time_to'])) {
		$params['period'] = 'A';
	}
	
	if (empty($params['time_from']) && empty($params['period'])) {
		$params['time_from'] = mktime(0, 0, 0, date('n', TIME), 1, date('Y', time()));
	} elseif (!empty($params['time_from'])) {
		$params['time_from'] = fn_parse_date($params['time_from']);
	} else {
		$time_from = true;
	}
	
	if (empty($params['time_to']) && empty($params['period'])) {
		$params['time_to'] = time();
	} elseif (!empty($params['time_to'])) {
		$params['time_to'] = fn_parse_date($params['time_to']) + 24 * 60 * 60 - 1; //Get the day ending time
	} else {
		$time_to = true;
	}
	
	if (isset($time_from) || isset($time_to)) {
		$dates = db_get_row('SELECT MIN(start_date) AS time_from, MAX(end_date) AS time_to FROM ?:vendor_payouts');
		if (isset($time_from)) {
			$params['time_from'] = $dates['time_from'];
		}
		if (isset($time_to)) {
			$params['time_to'] = $dates['time_to'];
		}
	}
	
	// Order statuses condition
	$statuses = db_get_fields('SELECT status FROM ?:status_data WHERE `type` = ?s AND param = ?s AND `value` = ?s', 'O', 'calculate_for_payouts', 'Y');
	if (!empty($statuses)) {
		$condition .= db_quote(' AND (orders.status IN (?a) OR payouts.order_id = 0)', $statuses);
	}
	
	$date_condition .= db_quote(' AND ((payouts.start_date >= ?i AND payouts.end_date <= ?i AND payouts.order_id != ?i) OR (payouts.order_id = ?i AND (payouts.start_date BETWEEN ?i AND ?i OR payouts.end_date BETWEEN ?i AND ?i)))', $params['time_from'], $params['time_to'], 0, 0, $params['time_from'], $params['time_to'], $params['time_from'], $params['time_to']);
	
	// Filter by the transaction type
	if (!empty($params['transaction_type']) && ($params['transaction_type'] == 'income' || $params['transaction_type'] == 'expenditure')) {
		if ($params['transaction_type'] == 'income') {
			$condition .= ' AND (payouts.order_id != 0 OR payouts.payout_amount > 0)';
		} else {
			$condition .= ' AND payouts.payout_amount < 0';
		}
	}
	
	// Filter by vendor
	if (defined('COMPANY_ID')) {
		$params['vendor'] = COMPANY_ID;
	}
	if (isset($params['vendor']) && $params['vendor'] != 'all') {
		$condition .= db_quote(' AND payouts.company_id = ?i', $params['vendor']);
	}
	
	if (!empty($params['payment'])) {
		$condition .= db_quote(' AND payouts.payment_method like ?l', '%' . $params['payment'] . '%');
	}
	
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';
	
	$sorting = $sortings[$params['sort_by']] . ' ' . $directions[$params['sort_order']];
	
	$limit = '';
	if (!empty($params['items_per_page'])) {
		$limit = fn_paginate($params['page'], 0, $params['items_per_page'], true);
	}

	$items = db_get_array("SELECT SQL_CALC_FOUND_ROWS * FROM ?:vendor_payouts AS payouts $join WHERE $condition AND $date_condition GROUP BY payouts.payout_id ORDER BY $sorting $limit");

	if (!empty($params['items_per_page'])) {
		$_total = db_get_found_rows();
		fn_paginate($params['page'], $_total, $params['items_per_page']);
	}
	
	
	// Calculate balance for the selected period
	$total = array(
		'BCF' => 0, //Ballance carried forward
		'NO' => 0, // New orders
		'TPP' => 0, // Total period payouts
		'LPM' => 0, // Less Profit Margin
		'TOB' => 0, // Total outstanding balance
	);

	$bcf_query = db_quote("SELECT SUM(payouts.order_amount) - SUM(payouts.payout_amount) * (-1) - SUM(payouts.commission_amount) AS BCF FROM ?:vendor_payouts AS payouts $join WHERE $condition AND payouts.start_date < ?i", $params['time_from']);
	$current_payouts_query = db_quote("SELECT SUM(payouts.order_amount) AS NO, SUM(payouts.payout_amount) * (-1) AS TTP, SUM(payouts.order_amount) - SUM(payouts.commission_amount) + SUM(payouts.payout_amount) AS LPM FROM ?:vendor_payouts AS payouts LEFT JOIN ?:orders AS orders ON (payouts.order_id = orders.order_id) WHERE $condition AND $date_condition");
	$payouts_query = db_quote("SELECT payouts.*, companies.company, IF(payouts.order_id <> 0,orders.total,payouts.payout_amount) AS payout_amount, IF(payouts.order_id <> 0, payouts.end_date, '') AS date FROM ?:vendor_payouts AS payouts $join WHERE $condition AND $date_condition GROUP BY payouts.payout_id ORDER BY $sorting $limit");

	fn_set_hook('mve_companies_get_payouts', $bcf_query, $current_payouts_query, $payouts_query, $join, $total, $condition, $date_condition);

	$payouts = db_get_array($payouts_query);
	$total['BCF'] += db_get_field($bcf_query);

	$current_payouts = db_get_row($current_payouts_query);

	$total['NO'] = $current_payouts['NO'];
	$total['TPP'] = $current_payouts['TTP'];
	$total['LPM'] = $current_payouts['LPM'];
	$total['TOB'] += fn_format_price($total['BCF'] + $total['LPM']);
	$total['LPM'] = $total['LPM'] < 0 ? 0 : $total['LPM'];
	
	$total['new_period_date'] = db_get_field('SELECT MAX(end_date) FROM ?:vendor_payouts');
	
	return array($payouts, $params, $total);
}

function fn_companies_delete_payout($ids)
{
	if (is_array($ids)) {
		db_query('DELETE FROM ?:vendor_payouts WHERE payout_id IN (?a)', $ids);
	} else {
		db_query('DELETE FROM ?:vendor_payouts WHERE payout_id = ?i', $ids);
	}
}

function fn_companies_add_payout($payment)
{
	$_data = array(
		'company_id' => $payment['vendor'],
		'payout_date' => TIME, // Current timestamp
		'start_date' => fn_parse_date($payment['start_date']),
		'end_date' => fn_parse_date($payment['end_date']),
		'payout_amount' => $payment['amount'] * (-1),
		'payment_method' => $payment['payment_method'],
		'comments' => $payment['comments'],
	);
	
	if ($_data['start_date'] > $_data['end_date']) {
		$_data['start_date'] = $_data['end_date'];
	}
	
	db_query('INSERT INTO ?:vendor_payouts ?e', $_data);
	
	if (isset($payment['notify_user']) && $payment['notify_user'] == 'Y') {
		$company_data = fn_get_company_data($payment['vendor'], DESCR_SL, false);
		if (!empty($company_data['email'])) {
			$view_mail = Registry::get('view_mail');
			$view_mail->assign('company_data', $company_data);
			$view_mail->assign('payment', $payment);
			fn_send_mail($company_data['email'], Registry::get('settings.Company.company_support_department'), 'companies/payment_notification_subj.tpl', 'companies/payment_notification.tpl', '', $company_data['lang_code']);
		}
	}
}

function fn_company_products_check($product_ids, $notify = false)
{
	if (!empty($product_ids)) {
		$c = db_get_field("SELECT count(*) FROM ?:products WHERE product_id IN (?n) ?p", $product_ids, fn_get_company_condition('?:products.company_id'));
		if (count((array)$product_ids) == $c) {
			return true;
		} else {
			if ($notify) {
				fn_company_access_denied_notification(false);
			}
			return false;
		}
	}
	
	return true;
}

function fn_get_company_customers_ids($company_id)
{
	return db_get_fields("SELECT user_id FROM ?:orders WHERE company_id = ?i", $company_id);
}

function fn_take_payment_surcharge_from_vendor($products)
{
	$take_surcharge_from_vendor = false;
	if (Registry::get('settings.Suppliers.include_payment_surcharge') == 'Y') {
		$take_surcharge_from_vendor = true;
	}

	return $take_surcharge_from_vendor;
}

function fn_mve_update_page_before($page_data, $page_id, $lang_code)
{
	if (!empty($page_data['page'])) {
		fn_set_company_id($_data, 'company_id', true);
	}
}

function fn_mve_update_product($product_data, $product_id, $lang_code, $create)
{
	if (isset($product_data['company_id'])) {
		// Assign company_id to all product options
		$options_ids = db_get_fields('SELECT option_id FROM ?:product_options WHERE product_id = ?i', $product_id);
		if ($options_ids) {
			db_query("UPDATE ?:product_options SET company_id = ?s WHERE option_id IN (?a)", $product_data['company_id'], $options_ids);
		}
	}
}

/**
 * Changes the result of administrator access to profiles checking
 *
 * @param boolean $result Result of check : true if administeator has access, false otherwise
 * @param char $user_type Types of profiles 
 * @return bool Always true
 */
function fn_mve_check_permission_manage_profiles($result, $user_type)
{
	$params = array (
		'user_type' => $user_type
	);
	$result = $result && !fn_is_restricted_admin($params);
	
	if (defined('COMPANY_ID') && $result) {
		$result = ($user_type == 'V' && COMPANY_ID > 0 || $user_type == 'A' && COMPANY_ID == 0);
	}

	return true;
} 

/**
 * Changes defined user type
 * 
 * @param char User type 
 * @param array $params Request parameters
 * @return bool Always true
 */
function fn_mve_get_request_user_type($user_type, $params)
{
	if (AREA == 'A' && empty($params['user_type']) && empty($params['user_id']) && defined('COMPANY_ID'))  {
		$user_type = COMPANY_ID > 0 ? 'V' : 'A';
	}

	return true;
}

?>

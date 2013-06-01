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

// Generate dashboard
if ($mode == 'index') {
	// Check for feedback request
	if (
		!defined('COMPANY_ID') 
		&& (Registry::get('settings.General.feedback_type') == 'auto' || PRODUCT_TYPE == 'COMMUNITY')
		&& fn_is_expired_storage_data('send_feedback', SECONDS_IN_DAY * 30)
	) {
		fn_redirect('feedback.send?action=auto');
	}

	$condition = '';
	$stats = '';

	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$condition = " AND is_parent_order != 'Y' ";
	}

	$orders_stats = $product_stats = $users_stats = array();

	$latest_orders = db_get_hash_array(
		"SELECT order_id, timestamp, firstname, lastname, total, user_id, status "
		. "FROM ?:orders WHERE 1 ?p ORDER BY timestamp DESC LIMIT 5", 
		'order_id', $condition  . fn_get_company_condition('?:orders.company_id')
	);
	
	if (!empty($latest_orders)) {

		$order_items = db_get_array(
			"SELECT ?:order_details.order_id, ?:order_details.amount, ?:order_details.extra, ?:product_descriptions.product "
			. "FROM ?:order_details LEFT JOIN ?:product_descriptions ON ?:order_details.product_id = ?:product_descriptions.product_id "
			. "AND ?:product_descriptions.lang_code = ?s "
			. "WHERE ?:order_details.order_id IN (?a) ORDER BY ?:product_descriptions.product", 
			CART_LANGUAGE, array_keys($latest_orders)
		);

		foreach ($order_items as $item) {
			if (empty($item['product']) && !empty($item['extra'])) {
				$extra = unserialize($item['extra']);
				if (!empty($extra['product'])) {
					$item['product'] = $extra['product'];
				}
			}
			$latest_orders[$item['order_id']]['items'][] = array(
				'product' => $item['product'],
				'amount' => $item['amount']
			);
		}
	}

	if (Registry::get('settings.Appearance.calendar_date_format') == "month_first") {
		$date_format = 'm/d/Y';
	} else {
		$date_format = 'd/m/Y';
	}
	
	$paid_statuses = fn_get_order_paid_statuses();
	
	// Collect orders information
	// Dayly orders
	$date = array('TIME' => date($date_format, TIME));
	$today = getdate(TIME);
	$last_day = getdate(TIME - SECONDS_IN_DAY);
	
	$date['today'] = date($date_format, mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']));
	$orders_stats['daily_orders'] = db_get_hash_array(
		"SELECT status, COUNT(*) as amount FROM ?:orders "
		. "WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id') . " GROUP BY status", 
		'status', mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']), TIME
	);
	$orders_stats['daily_orders']['totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']), TIME
	);
	$orders_stats['daily_orders']['prev_totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $last_day['mon'], $last_day['mday'], $last_day['year']), mktime(0, 0, 0, $last_day['mon'], $last_day['mday'], $last_day['year']) + SECONDS_IN_DAY
	);
	
	if ($orders_stats['daily_orders']['prev_totals']['total_paid'] > 0) {
		$orders_stats['daily_orders']['totals']['profit'] = intval($orders_stats['daily_orders']['totals']['total_paid'] * 100 / $orders_stats['daily_orders']['prev_totals']['total_paid']) - 100;
	}
	
	// Weekly orders
	$wday = empty($today['wday']) ? "6" : (($today['wday'] == 1) ? "0" : $today['wday'] - 1);
	$wstart = getdate(strtotime("-$wday day"));
	$wday += 7;
	$last_wstart = getdate(strtotime("-$wday day"));
	
	$date['week'] = date($date_format, mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']));
	$orders_stats['weekly_orders'] = db_get_hash_array(
		"SELECT status, COUNT(*) as amount FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i "
		. "$condition " . fn_get_company_condition('?:orders.company_id') . " GROUP BY status", 
		'status', mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']), TIME
	);
	$orders_stats['weekly_orders']['totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']), TIME
	);
	$orders_stats['weekly_orders']['prev_totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $last_wstart['mon'], $last_wstart['mday'], $last_wstart['year']), (mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']) - (6 * SECONDS_IN_DAY))
	);
	
	if ($orders_stats['weekly_orders']['prev_totals']['total_paid'] > 0) {
		$orders_stats['weekly_orders']['totals']['profit'] = intval($orders_stats['weekly_orders']['totals']['total_paid'] * 100 / $orders_stats['weekly_orders']['prev_totals']['total_paid']) - 100;
	}

	// Monthly orders
	$date['month'] = date($date_format, mktime(0, 0, 0, $today['mon'], 1, $today['year']));
	$last_month = $today;
	if ($last_month['mon'] == 1) {
		$last_month['mon'] = 12;
		$last_month['year']--;
	} else {
		$last_month['mon']--;
	}
	
	$orders_stats['monthly_orders'] = db_get_hash_array(
		"SELECT status, COUNT(*) as amount, SUM(total) as total FROM ?:orders "
		. "WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id') . " GROUP BY status", 
		'status', mktime(0, 0, 0, $today['mon'], 1, $today['year']), TIME
	);
	$orders_stats['monthly_orders']['totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i  AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $today['mon'], 1, $today['year']), TIME
	);
	$orders_stats['monthly_orders']['prev_totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount "
		. "FROM ?:orders WHERE timestamp >= ?i  AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, $last_month['mon'], 1, $last_month['year']), mktime(0, 0, 0, $last_month['mon'], 1, $last_month['year']) + (mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']) + SECONDS_IN_DAY - mktime(0, 0, 0, $today['mon'], 1, $today['year']))
	);
	
	if ($orders_stats['monthly_orders']['prev_totals']['total_paid'] > 0) {
		$orders_stats['monthly_orders']['totals']['profit'] = intval($orders_stats['monthly_orders']['totals']['total_paid'] * 100 / $orders_stats['monthly_orders']['prev_totals']['total_paid']) - 100;
	}

	// Yearly orders
	$orders_stats['year_orders'] = db_get_hash_array(
		"SELECT status, COUNT(*) as amount, SUM(total) as total FROM ?:orders "
		. "WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id') . " GROUP BY status", 
		'status', mktime(0, 0, 0, 1, 1, $today['year']), TIME
	);
	$orders_stats['year_orders']['totals'] = db_get_row(
		"SELECT SUM(IF(status IN (?a), total, 0)) as total_paid, SUM(total) as total, COUNT(*) as amount FROM ?:orders "
		. "WHERE timestamp >= ?i AND timestamp <= ?i $condition " . fn_get_company_condition('?:orders.company_id'), 
		$paid_statuses, mktime(0, 0, 0, 1, 1, $today['year']), TIME
	);

	$order_statuses = fn_get_statuses(STATUSES_ORDER, true, true, true);

	if (!defined('HTTPS')) {
		$stats .= base64_decode('PGltZyBzcmM9Imh0dHA6Ly93d3cuY3MtY2FydC5jb20vaW1hZ2VzL2JhY2tncm91bmQuZ2lmIiBoZWlnaHQ9IjEiIHdpZHRoPSIxIiBhbHQ9IiIgLz4=');
	}

	$product_stats['total'] = db_get_field("SELECT COUNT(*) as amount FROM ?:products WHERE 1" . fn_get_company_condition('?:products.company_id'));
	$product_stats['status'] = db_get_hash_single_array(
		"SELECT status, COUNT(*) as amount FROM ?:products WHERE 1" . fn_get_company_condition('?:products.company_id') . " GROUP BY status", 
		array('status', 'amount')
	);

	$product_stats['configurable'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE product_type = 'C'" . fn_get_company_condition('?:products.company_id'));
	$product_stats['downloadable'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE is_edp = 'Y'" . fn_get_company_condition('?:products.company_id'));
	$product_stats['free_shipping'] = db_get_field("SELECT COUNT(*) FROM ?:products WHERE free_shipping = 'Y'" . fn_get_company_condition('?:products.company_id'));

	$stock = db_get_hash_single_array(
		"SELECT COUNT(product_id) as quantity, IF(amount > 0, 'in', 'out') as c FROM ?:products "
		. "WHERE tracking = 'B' " . fn_get_company_condition('?:products.company_id') . " GROUP BY c", 
		array('c', 'quantity')
	);
	$stock_o = db_get_hash_single_array(
		"SELECT COUNT(DISTINCT(?:product_options_inventory.product_id))  as quantity, "
		. "IF(?:product_options_inventory.amount > 0, 'in', 'out') as c FROM ?:product_options_inventory "
		. "LEFT JOIN ?:products ON ?:products.product_id = ?:product_options_inventory.product_id "
		. "WHERE ?:products.tracking = 'O'" . fn_get_company_condition('?:products.company_id') . " GROUP BY c", 
		array('c', 'quantity')
	);

	$product_stats['in_stock'] = (!empty($stock['in']) ? $stock['in'] : 0) + (!empty($stock_o['in']) ? $stock_o['in'] : 0);
	$product_stats['out_of_stock'] = (!empty($stock['out']) ? $stock['out'] : 0) + (!empty($stock_o['out']) ? $stock_o['out'] : 0);

	$category_stats['total'] = db_get_field("SELECT COUNT(*) FROM ?:categories");
	$category_stats['status'] =  db_get_hash_single_array("SELECT status, COUNT(*) as amount FROM ?:categories GROUP BY status", array('status', 'amount'));

	if (!empty($_SESSION['stats'])) {
		$stats .= implode('', $_SESSION['stats']);
		unset($_SESSION['stats']);
	}

	if (!defined('COMPANY_ID') && !defined('RESTRICTED_ADMIN')) {
		
		$users_stats['total'] = db_get_hash_single_array("SELECT user_type, COUNT(*) as total FROM ?:users GROUP BY user_type", array('user_type', 'total'));
		$users_stats['total_all'] = db_get_field("SELECT COUNT(*) FROM ?:users");
		$users_stats['not_approved'] = db_get_field("SELECT COUNT(*) FROM ?:users WHERE status = 'D'");
		
		$usergroups = fn_get_usergroups('F', DESCR_SL);
		$usergroups_type = db_get_hash_single_array("SELECT type, COUNT(*) as total FROM ?:usergroups GROUP BY type", array('type', 'total'));
		$users_stats['usergroup']['A'] = db_get_hash_single_array("SELECT ul.usergroup_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:usergroup_links as ul ON a.user_id = ul.user_id AND ul.status = 'A' LEFT JOIN ?:usergroups as b ON ul.usergroup_id = b.usergroup_id WHERE b.type = 'A' GROUP BY ul.usergroup_id", array('usergroup_id', 'amount'));
		$users_stats['usergroup']['C'] = db_get_hash_single_array("SELECT ul.usergroup_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:usergroup_links as ul ON a.user_id = ul.user_id AND ul.status = 'A' LEFT JOIN ?:usergroups as b ON ul.usergroup_id = b.usergroup_id WHERE b.type = 'C' GROUP BY ul.usergroup_id", array('usergroup_id', 'amount'));
		$users_stats['usergroup']['P'] = db_get_hash_single_array("SELECT ul.usergroup_id, COUNT(*) as amount FROM ?:users as a LEFT JOIN ?:usergroup_links as ul ON a.user_id = ul.user_id AND ul.status = 'A' LEFT JOIN ?:usergroups as b ON ul.usergroup_id = b.usergroup_id WHERE b.type = 'P' GROUP BY ul.usergroup_id", array('usergroup_id', 'amount'));
		$users_stats['not_members'] = db_get_hash_single_array("SELECT a.user_type, COUNT(DISTINCT(a.user_id)) as amount FROM ?:users as a LEFT JOIN ?:usergroup_links as ul ON a.user_id = ul.user_id AND ul.status = 'A' WHERE ul.user_id IS NULL GROUP BY a.user_type", array('user_type', 'amount'));

		$view->assign('usergroups', $usergroups);
		$view->assign('usergroups_type', $usergroups_type);
		
		$view->assign('users_stats', $users_stats);
	}

	$view->assign('date', $date);
	$view->assign('orders_stats', $orders_stats);
	$view->assign('order_statuses', $order_statuses);
	$view->assign('product_stats', $product_stats);
	$view->assign('category_stats', $category_stats);
	$view->assign('latest_orders', $latest_orders);
	$view->assign('stats', $stats);
}

?>
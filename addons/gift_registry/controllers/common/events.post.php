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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Delete events
	if ($mode == 'delete_events') {
		if (!empty($_REQUEST['event_ids']) && is_array($_REQUEST['event_ids'])) {
			foreach ($_REQUEST['event_ids'] as $v) {
				if (AREA == 'C') {
					if (empty($auth['user_id'])) {
						continue;
					}
				}

				fn_event_delete($v, (AREA == 'C') ? $auth['user_id'] : 0);
			}
		}
		$suffix = '.search';
	}

	// Send notifications
	if ($mode == 'send_notifications') {
		if (!empty($_REQUEST['event_recipients'])) {

			$event_data = db_get_row("SELECT event_id, title, status, type, owner FROM ?:giftreg_events WHERE event_id = ?i", $_REQUEST['event_id']);
			$a_key = '';
			if ($event_data['type'] == 'U') {// If the event is private - get ekey for it
				$a_key = db_get_field("SELECT ekey FROM ?:ekeys WHERE object_id = ?i AND object_type = 'G'", $event_data['event_id']);
			}

			$emails = db_get_array("SELECT email, name FROM ?:giftreg_event_subscribers WHERE event_id = ?i AND email IN (?a)", $_REQUEST['event_id'], $_REQUEST['event_recipients']);

			$view_mail->assign('access_key', $a_key);
			$view_mail->assign('event', $event_data);

			foreach ($emails as $recipient) {
				$view_mail->assign('recipient', $recipient);
				fn_send_mail($recipient['email'], Registry::get('settings.Company.company_newsletter_email'), 'addons/gift_registry/event_subj.tpl', 'addons/gift_registry/event.tpl');
			}
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_email_sent'));
		}
		$suffix = ".update?event_id=$_REQUEST[event_id]&selected_section=notifications";
	}

	// Delete products from event
	if ($mode == 'delete_products') {
		foreach ($_REQUEST['event_product_ids'] as $item_id) {
			db_query("DELETE FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $item_id, $_REQUEST['event_id']);
		}

		$suffix = ".update?selected_section=products&event_id=$_REQUEST[event_id]";
	}

	// Update event products
	if ($mode == 'update_products' && !empty($_REQUEST['event_products'])) {
		unset($_REQUEST['event_products']['custom_files']);
		foreach ($_REQUEST['event_products'] as $item_id => $data) {
			$data['item_id'] = fn_generate_cart_id($data['product_id'], array("product_options" => (!empty($data['product_options']) ? $data['product_options'] : array())), false);
			if (!empty($data['product_options'])) {
				$data['extra'] = serialize($data['product_options']);
			}
			$data['event_id'] = $_REQUEST['event_id'];

			if ($data['item_id'] != $item_id) {
				$existent_amount = db_get_field("SELECT amount FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $data['item_id'], $_REQUEST['event_id']);
				db_query("DELETE FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $item_id, $_REQUEST['event_id']);
				if (!empty($data['amount'])) {
					$data['amount'] += $existent_amount;
					$data = fn_check_table_fields($data, 'giftreg_event_products');
					db_query("REPLACE INTO ?:giftreg_event_products ?e", $data);
				}
			} else {
				$existent_amount = db_get_field("SELECT amount FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $data['item_id'], $_REQUEST['event_id']);
				if (!empty($data['amount'])) {
					$data = fn_check_table_fields($data, 'giftreg_event_products');
					db_query("UPDATE ?:giftreg_event_products SET ?u WHERE item_id = ?i AND event_id = ?i", $data, $item_id, $_REQUEST['event_id']);
				} else {
					db_query("DELETE FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $item_id, $_REQUEST['event_id']);
				}
			}
		 }

		$suffix = ".update?selected_section=products&event_id=$_REQUEST[event_id]";
	}

	// Add products to the event
	if ($mode == 'add_products') {
		foreach ($_REQUEST['product_data'] as $product_id => $data) {
			$data['item_id'] = fn_generate_cart_id($product_id, array("product_options" => @$data['product_options']), false);
			$existent_amount = db_get_field("SELECT amount FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $data['item_id'], $_REQUEST['event_id']);
			if (!empty($data['product_options'])) {
				$data['extra'] = serialize($data['product_options']);
			}
			$data['product_id'] = $product_id;
			$data['event_id'] = $_REQUEST['event_id'];
			if (!empty($data['amount'])) {
				$data['amount'] += $existent_amount;
				$data = fn_check_table_fields($data, 'giftreg_event_products');
				db_query("REPLACE INTO ?:giftreg_event_products ?e", $data);
			}
		}
		$suffix = ".update?selected_section=products&event_id=$_REQUEST[event_id]";
	}

	// Update the event
	if ($mode == 'update') {
		if (AREA == 'C' && !empty($_REQUEST['event_id']) && !defined('EVENT_OWNER') && Registry::get('addons.gift_registry.event_creators') != 'all') {
			return array(CONTROLLER_STATUS_DENIED);
		}

		list($event_id, $access_key) = fn_update_event($_REQUEST['event_data'], $_REQUEST['event_id']);

		$suffix = ".update?event_id=$event_id";
		$suffix .= !empty($access_key) ? "&access_key=$access_key" : '';		
	}

	if ($mode == 'request_access_key') {
		if (!empty($_REQUEST['email'])) {
			// check if this email is used by event creator (for private events and anonymous)
			$owner_events = db_get_array(
				"SELECT ?:giftreg_events.event_id, ?:giftreg_events.title, ?:giftreg_events.owner, ?:ekeys.ekey " .
				"FROM ?:giftreg_events LEFT JOIN ?:ekeys ON ?:ekeys.object_id = ?:giftreg_events.event_id AND ?:ekeys.object_type = 'O' " .
				"WHERE ?:giftreg_events.email = ?s AND (?:giftreg_events.type = 'U' || ?:giftreg_events.user_id = 0) ?p",
				$_REQUEST['email'], fn_get_gift_registry_company_condition('?:giftreg_events.company_id')
			);

			// check if this email is used in event recipients
			$subscriber_events = db_get_array(
				"SELECT ?:giftreg_event_subscribers.name, ?:giftreg_events.owner, ?:giftreg_event_subscribers.event_id, ?:giftreg_events.title, ?:ekeys.ekey " .
				"FROM ?:giftreg_event_subscribers LEFT JOIN ?:giftreg_events ON ?:giftreg_events.event_id = ?:giftreg_event_subscribers.event_id " .
				"LEFT JOIN ?:ekeys ON ?:ekeys.object_id = ?:giftreg_event_subscribers.event_id AND ?:ekeys.object_type = 'G' " .
				"WHERE ?:giftreg_event_subscribers.email = ?s AND ?:giftreg_events.type = 'U' ?p", 
				$_REQUEST['email'], fn_get_gift_registry_company_condition('?:giftreg_events.company_id')
			);

			if (empty($subscriber_events) && empty($owner_events)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_giftreg_email_not_found'));
			} else {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_email_sent'));
				$view_mail->assign('owner_events', $owner_events);
				$view_mail->assign('subscriber_events', $subscriber_events);
				fn_send_mail($_REQUEST['email'], Registry::get('settings.Company.company_users_department'), 'addons/gift_registry/access_key_subj.tpl', 'addons/gift_registry/access_key.tpl');
			}
		}
		$suffix = ".access_key";
	}

	if (AREA == 'A' && empty($suffix)) {
		$suffix = '.field_editor';
	}

	return array(CONTROLLER_STATUS_OK, "events$suffix");
}

// Search for events
if ($mode == 'search') {

	$params = $_REQUEST;

	list($events, $search) = fn_get_events($params);
	$view->assign('events', $events);
	$view->assign('search', $search);

	if (AREA != 'A') {
		fn_add_breadcrumb(fn_get_lang_var('events'));
	}

//
// Update event
//
} elseif ($mode == 'update') {
	if (empty($_REQUEST['event_id'])) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if (AREA == 'C' && !defined('EVENT_OWNER') && Registry::get('addons.gift_registry.event_creators') != 'all') {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$event_data = db_get_row("SELECT * FROM ?:giftreg_events WHERE event_id = ?i", $_REQUEST['event_id']);

	$event_data['fields'] = db_get_hash_single_array("SELECT * FROM ?:giftreg_event_fields WHERE ?:giftreg_event_fields.event_id = ?i", array('field_id', 'value'), $_REQUEST['event_id']);

	$event_data['subscribers'] = db_get_array("SELECT name, email FROM ?:giftreg_event_subscribers WHERE event_id = ?i ORDER BY name, email", $_REQUEST['event_id']);

	$event_data['products'] = fn_get_event_product($_REQUEST['event_id'], Registry::get('settings.Appearance.products_per_page'), empty($_REQUEST['page']) ? 1 : $_REQUEST['page']);

	foreach ($event_data['products'] as $k => $v) {
		$event_data['products'][$k]['extra'] = $event_data['products'][$k]['selected_options'] = unserialize($v['extra']);
		$product_options = $event_data['products'][$k]['extra'];
		$event_data['products'][$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
		$event_data['products'][$k]['original_price'] = $event_data['products'][$k]['price'] = fn_get_product_price($v['product_id'], 1, $auth);
		$event_data['products'][$k]['avail_amount'] = $v['amount'] - $v['ordered_amount'];
		
		if (!empty($event_data['products'][$k]['selected_options'])) {
			$options = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
			foreach ($event_data['products'][$k]['selected_options'] as $option_id => $variant_id) {
				foreach ($options as $option) {
					if ($option['option_id'] == $option_id && !in_array($option['option_type'], array('I', 'T', 'F')) && empty($variant_id)) {
						$event_data['products'][$k]['changed_option'] = $option_id;
						break 2;
					}
				}
			}
		}
	}
	
	fn_gather_additional_products_data($event_data['products'], array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true));

	$view->assign('event_id', $_REQUEST['event_id']);
	$view->assign('event_data', $event_data);


	Registry::set('navigation.tabs', array (
		'general' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'products' => array (
			'title' => fn_get_lang_var('products'),
			'js' => true
		),
		'notifications' => array (
			'title' => fn_get_lang_var('notifications'),
			'js' => true
		),
	));

	if (AREA != 'A') {
		fn_add_breadcrumb(fn_get_lang_var('events'), "events.search");
		fn_add_breadcrumb($event_data['title']);
	} else {
		fn_add_breadcrumb(fn_get_lang_var('events'), "events.search.reset_view");
		fn_add_breadcrumb(fn_get_lang_var('search_results'), "events.search.last_view");
	}

//
// Add new event
//
} elseif ($mode == 'add') {

	Registry::set('navigation.tabs', array (
		'general' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
	));

	fn_add_breadcrumb(fn_get_lang_var('events'), "events.search");
	if (AREA != 'A') {
		fn_add_breadcrumb(fn_get_lang_var('add'));
	}

//
// Delete products from event
//
} elseif ($mode == 'delete' && !empty($_REQUEST['item_id']) && !empty($_REQUEST['event_id'])) {

	$suffix = '.update?event_id=' . $_REQUEST['event_id'];

	if (!empty($auth['user_id'])) {
		$event_id = db_get_field("SELECT event_id FROM ?:giftreg_events WHERE event_id = ?i AND user_id = ?i", $_REQUEST['event_id'], $auth['user_id']);

		if (!empty($event_id)) {
			db_query("DELETE FROM ?:giftreg_event_products WHERE item_id = ?i AND event_id = ?i", $_REQUEST['item_id'], $_REQUEST['event_id']);
			$suffix .= (!empty($_REQUEST['access_key']) ? "&access_key=$_REQUEST[access_key]" : '');
		}
	}

	return array(CONTROLLER_STATUS_REDIRECT, "events$suffix");
}


$fields = db_get_hash_array("SELECT ?:giftreg_fields.*, ?:giftreg_descriptions.description FROM ?:giftreg_fields LEFT JOIN ?:giftreg_descriptions ON ?:giftreg_fields.field_id = ?:giftreg_descriptions.object_id AND ?:giftreg_descriptions.object_type = 'F' AND ?:giftreg_descriptions.lang_code = ?s ORDER BY ?:giftreg_fields.position", 'field_id', CART_LANGUAGE);

foreach ($fields as $k => $v) {
	if (strpos('SR', $v['field_type']) !== false) {
		$fields[$k]['variants'] = db_get_hash_array("SELECT ?:giftreg_field_variants.*, ?:giftreg_descriptions.description FROM ?:giftreg_field_variants LEFT JOIN ?:giftreg_descriptions ON ?:giftreg_descriptions.object_id = ?:giftreg_field_variants.variant_id AND ?:giftreg_descriptions.object_type = 'V' AND ?:giftreg_descriptions.lang_code = ?s WHERE ?:giftreg_field_variants.field_id = ?i ORDER BY ?:giftreg_field_variants.position", 'variant_id', CART_LANGUAGE, $v['field_id']);
	}
}

$view->assign('event_fields', $fields);

function fn_get_events($params, $items_per_page = 0)
{
	// Init filter
	$params = fn_init_view('events', $params);

	// Set default values to input params
	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	// Define fields that should be retrieved
	$fields = array (
		'*',
	);

	$condition = $join = '';

	if (!empty($params['type'])) {
		$condition .= db_quote(" AND type IN (?a)", $params['type']);
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);

		$condition .= db_quote(" AND (start_date >= ?i AND end_date <= ?i)", $params['time_from'], $params['time_to']);
	}

	if (isset($params['owner']) && fn_string_not_empty($params['owner'])) {
		$condition .= db_quote(" AND (owner LIKE ?l OR ?:giftreg_events.email LIKE ?l)", "%".trim($params['owner'])."%", "%".trim($params['owner'])."%");
	}

	if (isset($params['title']) && fn_string_not_empty($params['title'])) {
		$condition .= db_quote(" AND title LIKE ?l", "%".trim($params['title'])."%");
	}

	if (!empty($params['type'])) {
		$condition .= db_quote(" AND type IN (?a)", $params['type']);
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(" AND status IN (?a)", $params['status']);
	}

	if (isset($params['subscriber']) && fn_string_not_empty($params['subscriber'])) {
		$join .= " INNER JOIN ?:giftreg_event_subscribers ON ?:giftreg_event_subscribers.event_id = ?:giftreg_events.event_id";
		$condition .= db_quote(" AND (?:giftreg_event_subscribers.name LIKE ?l OR ?:giftreg_event_subscribers.email LIKE ?l)", "%".trim($params['subscriber'])."%", "%".trim($params['subscriber'])."%");
	}

	if (!empty($params['search_fields'])) {
		$_cond = array();
		$total_hits = 0;
		foreach ($params['search_fields'] as $f_id => $f_val) {
			$_condition = array();
			if (substr_count($f_val, '/') == 2) { // FIXME: it's date field
				$_condition[] = db_quote("?:giftreg_event_fields.value = ?s", fn_parse_date($f_val));
			} else {
				$_condition[] = db_quote("?:giftreg_event_fields.value LIKE ?l", "%$f_val%");
			}

			if (!empty($f_val)) {
				$total_hits++;
				$_cond[] = db_quote("(?:giftreg_event_fields.field_id = ?i AND ", $f_id) . implode(" AND ", $_condition) . ')';
			}
		}

		if (!empty($_cond)) {
			$cache_field_search = db_get_fields("SELECT event_id, COUNT(event_id) as cnt FROM ?:giftreg_event_fields WHERE (" . implode(' OR ', $_cond) . ") GROUP BY event_id HAVING cnt = $total_hits");
			$condition .= db_quote(" AND event_id IN (?n)", $cache_field_search);
		}
	}

	if (!empty($params['today_events'])) {
		$condition .= db_quote("AND (start_date <= ?i AND end_date > ?i)", TIME, TIME);
	}

	if (empty($items_per_page)) {
		$items_per_page = Registry::get('settings.Appearance.' . (AREA == 'A' ? 'admin_' : '') . 'elements_per_page');
	}

	$total = db_get_field("SELECT COUNT(*) FROM ?:giftreg_events ?p WHERE 1 ?p", $join, $condition . fn_get_gift_registry_company_condition('?:giftreg_events.company_id'));
	$limit = fn_paginate($params['page'], $total, $items_per_page);

	$events = db_get_array(
		"SELECT ?p FROM ?:giftreg_events ?p WHERE 1 ?p ORDER BY start_date ASC ?p",
          implode(',', $fields), $join, $condition . fn_get_gift_registry_company_condition('?:giftreg_events.company_id'), $limit
	);

	fn_view_process_results('events', $events, $params, $items_per_page);

	return array($events, $params);
}

?>
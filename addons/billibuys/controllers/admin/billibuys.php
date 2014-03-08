<?php

/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Controller for BilliBuys
 */

if ( !defined('AREA') ) { die('Access denied'); }

	if($mode == 'view'){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$bb_data = $_POST['bb_data'];
			if(is_array($bb_data)){
				if(fn_submit_bids($bb_data,$auth)){
					return array(CONTROLLER_STATUS_OK, "billibuys.view");
				}else{
					// TODO: Wtf is this here for? Dammit Bryan, stop coding halfdead
					return array(CONTROLLER_STATUS_REDIRECT,"billibuys.place_bid?request_id=$bb_data[request_id]");
				}
			}
		}else{
			$requests = fn_get_requests($_REQUEST);
			foreach($requests as &$request){
				if(is_array($request)){
					//Get duration since auction was placed
					//Find number of hours since placed, and divide by $HOURS_PER_DAY to indicate number of days since placed if over $HOURS_PER_DAY (24)
					$timediff = microtime(true) - $request['timestamp'];
					$duration = Array(
						'error' => 0, 
						'msg'   => null,
						'value' => 0,

					);
					if($timediff > 0){
						if($timediff < SECONDS_PER_MINUTE){
							// If under 1 minute, return value in seconds
							$duration = array_merge($duration, Array(
								'value' => number_format($timediff, DECIMAL_POINTS_AFTER_TIMESTAMP),
								'unit' => 's'
							));
						}elseif($timediff <= SECONDS_PER_HOUR){
							// If over 1 minute (fulfils above condition) but is under 1 hour, return value in minutes
							$duration = array_merge($duration, Array(
								'value' => number_format($timediff/SECONDS_PER_MINUTE, DECIMAL_POINTS_AFTER_TIMESTAMP), 
								'unit' => 'm'));
						}elseif($timediff <= SECONDS_PER_DAY){
							// If over 1 hour (fulfils above condition) but is under 1 day, return value in hours
							$duration = array_merge($duration, Array(
								'value' => number_format($timediff/SECONDS_PER_HOUR, DECIMAL_POINTS_AFTER_TIMESTAMP), 
								'unit' => 'h'));
						}elseif($timediff <= 2*SECONDS_PER_WEEK){
							// If over 1 day (fulfils above condition) but is under 2 weeks, return value in days
							$duration = array_merge($duration, Array(
								'value' => number_format($timediff/SECONDS_PER_DAY, DECIMAL_POINTS_AFTER_TIMESTAMP), 
								'unit' => 'd'));
						}elseif($timediff > 2*SECONDS_PER_WEEK){
							// If over 2 weeks, state "2 weeks+"
							$duration['msg'] = 'over_two_weeks';
						}else{
							// Catch any error conditions (invalid date or negative)
							$duration = array_merge($duration, Array('error' => 1, 'msg' => 'invalid_date'));
							//TODO: Send mail
						}
					}else{
						// microtime(true) < $request['timedate'] (Something's gone horribly wrong here folks)
						$duration = array_merge($duration, Array('error' => 1, 'msg' => 'nonpositive_value'));
						//TODO: Send mail
					}
					$request['timestamp'] = $duration;
				}
			}
			
			$view->assign('requests',$requests);
		}
	}elseif($mode == 'notify'){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$bb_data = $_REQUEST['bb_data'];
			$bb_data['auth'] = $auth;
			if(is_array($bb_data)){
				fn_bb_submit_notification($bb_data);
			}
		return array(CONTROLLER_STATUS_OK, "billibuys.view");		
		}
	}elseif($mode == 'request'){

		$params = Array('request_id'=>$_GET['request_id']);
		// Get all bids
		$request = fn_get_request($params);

		$view->assign('request',$request);
	}elseif($mode == 'place_bid'){
		// var_dump($auth);
		// Get list of products
	$params = $_REQUEST;
	$params['only_short_fields'] = true;
	$params['extend'][] = 'companies';

	if ($mode == 'p_subscr') {
		$params['get_subscribers'] = true;
		fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage");
	}

	list($products, $search, $product_count) = fn_get_products($params, Registry::get('settings.Appearance.admin_products_per_page'), DESCR_SL);
	fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => false, 'get_discounts' => false));
	

	if (!empty($_REQUEST['redirect_if_one']) && $product_count == 1) {
		return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id={$products[0]['product_id']}");
	}

	$selected_fields = array(
		array(
			'name' => '[data][popularity]',
			'text' => fn_get_lang_var('popularity')
		),
		array(
			'name' => '[data][status]',
			'text' => fn_get_lang_var('status'),
			'disabled' => 'Y'
		),
		array(
			'name' => '[data][product]',
			'text' => fn_get_lang_var('product_name'),
			'disabled' => 'Y'
		),
		array(
			'name' => '[data][price]',
			'text' => fn_get_lang_var('price')
		),
		array(
			'name' => '[data][list_price]',
			'text' => fn_get_lang_var('list_price')
		),
		array(
			'name' => '[data][short_description]',
			'text' => fn_get_lang_var('short_description')
		),
		array(
			'name' => '[categories]',
			'text' => fn_get_lang_var('categories')
		),
		array(
			'name' => '[data][full_description]',
			'text' => fn_get_lang_var('full_description')
		),
		array(
			'name' => '[data][search_words]',
			'text' => fn_get_lang_var('search_words')
		),
		array(
			'name' => '[data][meta_keywords]',
			'text' => fn_get_lang_var('meta_keywords')
		),
		array(
			'name' => '[data][meta_description]',
			'text' => fn_get_lang_var('meta_description')
		),
		
		array(
			'name' => '[data][usergroup_ids]',
			'text' => fn_get_lang_var('usergroups')
		),
		
		array(
			'name' => '[main_pair]',
			'text' => fn_get_lang_var('image_pair')
		),
		array(
			'name' => '[data][min_qty]',
			'text' => fn_get_lang_var('min_order_qty')
		),
		array(
			'name' => '[data][max_qty]',
			'text' => fn_get_lang_var('max_order_qty')
		),
		array(
			'name' => '[data][qty_step]',
			'text' => fn_get_lang_var('quantity_step')
		),
		array(
			'name' => '[data][list_qty_count]',
			'text' => fn_get_lang_var('list_quantity_count')
		),
		array(
			'name' => '[data][product_code]',
			'text' => fn_get_lang_var('product_code')
		),
		array(
			'name' => '[data][weight]',
			'text' => fn_get_lang_var('weight')
		),
		array(
			'name' => '[data][shipping_freight]',
			'text' => fn_get_lang_var('shipping_freight')
		),
		array(
			'name' => '[data][is_edp]',
			'text' => fn_get_lang_var('downloadable')
		),
		array(
			'name' => '[data][edp_shipping]',
			'text' => fn_get_lang_var('edp_enable_shipping')
		),
		array(
			'name' => '[data][free_shipping]',
			'text' => fn_get_lang_var('free_shipping')
		),
		array(
			'name' => '[data][feature_comparison]',
			'text' => fn_get_lang_var('feature_comparison')
		),
		array(
			'name' => '[data][zero_price_action]',
			'text' => fn_get_lang_var('zero_price_action')
		),
		array(
			'name' => '[data][taxes]',
			'text' => fn_get_lang_var('taxes')
		),
		array(
			'name' => '[data][features]',
			'text' => fn_get_lang_var('features')
		),
		array(
			'name' => '[data][page_title]',
			'text' => fn_get_lang_var('page_title')
		),
		array(
			'name' => '[data][timestamp]',
			'text' => fn_get_lang_var('creation_date')
		),
		array(
			'name' => '[data][amount]',
			'text' => fn_get_lang_var('quantity')
		),
		array(
			'name' => '[data][avail_since]',
			'text' => fn_get_lang_var('available_since')
		),
		array(
			'name' => '[data][out_of_stock_actions]',
			'text' => fn_get_lang_var('out_of_stock_actions')
		),
		
		array(
			'name' => '[data][localization]',
			'text' => fn_get_lang_var('localization')
		),
		
		array(
			'name' => '[data][details_layout]',
			'text' => fn_get_lang_var('product_details_layout')
		),
		array(
			'name' => '[data][min_items_in_box]',
			'text' => fn_get_lang_var('minimum_items_in_box')
		),
		array(
			'name' => '[data][max_items_in_box]',
			'text' => fn_get_lang_var('maximum_items_in_box')
		),
		array(
			'name' => '[data][box_length]',
			'text' => fn_get_lang_var('box_length')
		),
		array(
			'name' => '[data][box_width]',
			'text' => fn_get_lang_var('box_width')
		),
		array(
			'name' => '[data][box_height]',
			'text' => fn_get_lang_var('box_height')
		),
	);

	if (Registry::get('settings.General.inventory_tracking') == "Y") {
		$selected_fields[] = array(
			'name' => '[data][tracking]',
			'text' => fn_get_lang_var('inventory')
		);
	}

	if (PRODUCT_TYPE == 'PROFESSIONAL' && Registry::get('settings.Suppliers.enable_suppliers') == 'Y') {
		$selected_fields[] = array(
			'name' => '[data][company_id]',
			'text' => fn_get_lang_var('supplier')
		);
	}

	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$selected_fields[] = array(
			'name' => '[data][company_id]',
			'text' => fn_get_lang_var('vendor')
		);
	}

	$view->assign('selected_fields', $selected_fields);
	
	$filter_params = array(
		'get_fields' => true,
		'get_variants' => true,
		'short' => true
	);
	list($filters) = fn_get_product_filters($filter_params);
	$view->assign('filter_items', $filters);
	unset($filters);

	
	$feature_params = array(
		'get_fields' => true,
		'plain' => true,
		'variants' => true,
		'exclude_group' => true,
		'exclude_filters' => true
	);
	list($features) = fn_get_product_features($feature_params);
	$view->assign('feature_items', $features);
	unset($features);

	$view->assign('request_id',$params['request_id']);

	$view->assign('product_count', $product_count);
	fn_paginate((isset($_REQUEST['page']) ? $_REQUEST['page'] : 1), $product_count, Registry::get('settings.Appearance.admin_products_per_page'));
		// Let users place a bid

	$view->assign('products', $products);
	$view->assign('search', $search);

	}elseif($mode == 'm_place_bid'){
		// Todo: Error condition for this (invalid POSTs)
		if(fn_submit_bids($_POST,$auth)){
			header('Location: index.php?dispatch=billibuys.view',true);
			die;
		}
		// Else condition is handled in the function, by returning false and thus not redirecting
	}elseif($mode == 'categories_manage'){
		$categories = fn_bb_get_categories();
		$view->assign('categories',$categories);
	}elseif($mode == 'category_add'){
		// Get categories for select element
		// $categories = fn_bb_get_categories();

		// $child_for = array_keys($categories);
		// $where_condition = !empty($_REQUEST['category_id']) ? db_quote(' AND bb_request_category_id != ?i', $_REQUEST['category_id']) : '';
		// $has_children = db_get_hash_array("SELECT bb_request_category_id, parent_category_id FROM ?:bb_request_categories WHERE parent_category_id IN(?n) ?p", 'parent_category_id', $child_for, $where_condition);

		// 	// Group categories by the level (simple)
		// foreach ($categories as $k => $v) {
		// 	$v['level'] = substr_count($v['id_path'], '/');
		// 	if ((!empty($params['current_category_id']) || $v['level'] == 0) && isset($has_children[$k])) {
		// 		$v['has_children'] = $has_children[$k]['category_id'];
		// 	}
		// 	$tmp[$v['level']][$v['category_id']] = $v;

		// 	// Get images
		// 	// if ($params['get_images'] == true) {
		// 	// 	$tmp[$v['level']][$v['category_id']]['main_pair'] = fn_get_image_pairs($v['category_id'], 'category', 'M', true, true, $lang_code);
		// 	// }
		// }
		// 
		fn_add_breadcrumb(fn_get_lang_var('bb_manage_billibuys_categories'),"billibuys.categories_manage");
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			fn_bb_add_category($_REQUEST['category_data'],$auth);
			return array(CONTROLLER_STATUS_REDIRECT,$_REQUEST['dispatch']);
		}
	}elseif($mode == 'category_update'){
		$category_data = fn_bb_get_category($_REQUEST['category_id']);
		$view->assign("category_data",$category_data);
		$view->assign("id",$category_data['bb_request_category_id']);
	}elseif($mode == 'category_delete'){
		fn_bb_delete_category($_REQUEST['category_id']);
		return array(CONTROLLER_STATUS_OK,'billibuys.categories_manage');
	}elseif($mode == 'view_requests'){
		fn_redirect("index.php?dispatch=billibuys.view");
	}


	




?>
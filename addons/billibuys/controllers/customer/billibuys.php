<?php

/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Controller for BilliBuys
 */

if ( !defined('AREA') ) { die('Access denied'); }

	if($mode == 'view'){


		fn_add_breadcrumb(fn_get_lang_var('view_requests'), "billibuys.view");
		// Stub for viewing own auctions
		$search_params = Array(
			'user'         => $auth['user_id'],
			'own_auctions' => false,
			'current'	   => true,
		);

		// Add whatever other request parameters into the search params
		$search_params = array_merge($_REQUEST,$search_params);

		$user = $search_params['user'];

		if ($_SERVER['REQUEST_METHOD']	== 'POST') {
			// When values have been POSTed from billibuys.place_request
			fn_submit_request($user, $_POST);
		}
		if($_SERVER['REQUEST_METHOD'] == 'GET' && array_key_exists('q', $_GET)){
			$requests = fn_get_requests_by_product($_GET['q']);
		}else{
			$requests = fn_get_requests($search_params);	
		}

		if($requests['success'] == 1){
			foreach($requests as $key=>&$request){
				if(is_array($request)){
					$image_id = db_get_field("SELECT detailed_id FROM ?:images_links WHERE object_id = ?i AND object_type LIKE 'request'",$request['bb_request_id']);

					$request['image'] = fn_get_image_pairs($request['bb_request_id'], 'request', 'M', $get_icon = true, $get_detailed = true, $lang_code = CART_LANGUAGE);


						// $image_id, 'request');
					//Get duration since auction was placed
					//Find number of hours since placed, and divide by $HOURS_PER_DAY to indicate number of days since placed if over $HOURS_PER_DAY (24)
					// $timediff = microtime(true) - $request['timestamp'];
					$timediff = $request['expiry_date'] - microtime(true);
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
						$duration = array_merge($duration, Array('error' => 1, 'msg' => 'nonpositive_value'));
						unset($requests[$key]); // FIXME: This should be done in database function as a conditional rather than in php
						//TODO: Send mail
					}
					$request['timestamp'] = $duration;
				}
			}
		}
		

		if($_REQUEST['category_id'] > 0){
			$cat_title = db_get_field("SELECT category_name FROM ?:bb_request_category_descriptions WHERE lang_code = ?s AND bb_request_category_id = ?i",CART_LANGUAGE,$_REQUEST['category_id']);
			if($cat_title){
				$view->assign('category_title',$cat_title);
				fn_add_breadcrumb($cat_title,'index.php?dispatch=billibuys.view&category_id='.$_REQUEST['category_id']);
			}
		}

		$view->assign('requests',$requests);
	}elseif($mode == 'request'){

		$params = Array(
			'request_id'=>$_GET['request_id'],
			'fields' => Array(
				'bb_request_id',
				'timestamp',
				'title',
				'description',
				'max_price',
				'expiry_date',
				'user_id',
			)
		);

		// Get database results
		$request = fn_get_request($params);

		if(empty($request)){
			return array(CONTROLLER_STATUS_NO_PAGE);
		}
		// Remove underscores from any column names in database results and format timestamp
		foreach($request as $k=>&$r){
			if($k == 'timestamp'){
				$r = date('F j Y, g:i a',$r);
			}
			if($k == 'bb_request_id'){
				$request['id'] = $r;
			}
			if(strpos($k,'_') !== FALSE){
				$new_key = str_replace('_', ' ', $k);
				$request[$new_key] = $r;
				unset($request[$k]);
			}
		}

		// Reset params in case need to modify what is searched by later
		$params = Array('request_id' => $params['request_id']);
	
		$bids = fn_get_bids($params);	

		foreach($bids as &$bid){
			$bid['tot_price'] = $bid['price'] * $bid['quantity'];
		}
		
		// These bids are links to the product pages
		// Pricing is replaced by the bid price
		// Once bid is purchased, mark request as purchased and no further bids can be purchased
		$view->assign('uid',md5($auth['user_id']));
		$view->assign('bids',$bids);
		$view->assign('request_user_id',$request['user id']);
		$view->assign('request',$request);
		$view->assign('expired',$request['expiry date'] <= microtime(true));
		$view->assign('expiry',date('d-m-Y',$request['expiry date']));

	}elseif($mode == 'place_request'){
		if(!$auth['user_id']){
			// Redirect user to login if they ended up on this page accidentally (or otherwise)
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form");
		}else{
			$categories = fn_bb_get_categories();
			$view->assign('categories',$categories);
			fn_add_breadcrumb(fn_get_lang_var('bb_place_request'), "billibuys.place_request");
		}
	}
?>
<?php

/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Controller for BilliBuys
 */

if ( !defined('AREA') ) { die('Access denied'); }
	if($mode == 'view'){

		// Stub for viewing own auctions
		$search_params = Array(
			'user'         => $auth['user_id'],
			'own_auctions' => false,
		);

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
				'max_price'
			)
		);

		// Get database results
		$request = fn_get_request($params);

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
		$view->assign('request',$request);
	}elseif($mode == 'place_request'){
		if(!$auth['user_id']){
			// Redirect user to login if they ended up on this page accidentally (or otherwise)
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form");
		}else{
			fn_add_breadcrumb(fn_get_lang_var('bb_place_request'), "billibuys.place_request");
		}
	}


?>
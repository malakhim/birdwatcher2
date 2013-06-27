<?php

/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Controller for BilliBuys
 */

$SECONDS_PER_HOUR = 3600;
$DECIMAL_POINTS_AFTER_TIMESTAMP = 0;
$HOURS_PER_DAY = 24;

if ( !defined('AREA') ) { die('Access denied'); }
	if($mode == 'view'){
		// Stub for viewing own auctions
		$search_params = Array(
			'user'         => $_SESSION['auth']['user_id'],
			'own_auctions' => false,
		);

		$user = $search_params['user'];

		if ($_SERVER['REQUEST_METHOD']	== 'POST') {
			fn_submit_request($user, $_POST);
		}
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			$requests = fn_get_requests_by_product($_GET['q']);
		}else{
			$requests = fn_get_requests($search_params);	
		}
		
		if($requests['success'] == 1){
			foreach($requests as &$request){
				if(is_array($request)){
					//Get duration since auction was placed
					//Find number of hours since placed, and divide by $HOURS_PER_DAY to indicate number of days since placed if over $HOURS_PER_DAY (24)
					$duration = number_format((microtime(true) - $request['timestamp'])/$SECONDS_PER_HOUR,$DECIMAL_POINTS_AFTER_TIMESTAMP);
					if($duration >= $HOURS_PER_DAY){
						$duration = number_format($duration/$HOURS_PER_DAY,$DECIMAL_POINTS_AFTER_TIMESTAMP);
						$request['duration_unit'] = 'd';
					}else{
						$request['duration_unit'] = 'h';
					}
					$request['timestamp'] = $duration;
				}
			}
		}
		$view->assign('requests',$requests);
	}


?>
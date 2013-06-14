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
					$request['timestamp'] = microtime(true) - $request['timestamp'];
				}
			}
		}
		$view->assign('requests',$requests);
	}


?>
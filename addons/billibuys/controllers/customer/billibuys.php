<?php

/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Controller for BilliBuys
 */

if ( !defined('AREA') ) { die('Access denied'); }
	if($mode == 'view'){
		$user = $_SESSION['auth']['user_id'];
		if ($_SERVER['REQUEST_METHOD']	== 'POST') {
			fn_submit_request($user, $_POST);
			
		}
		$requests = fn_get_requests($user);
		if($requests['success'] == 1){
			foreach($request as &$request){
				$request['timestamp'] = microtime(true) - $request['timestamp'];
			}
		}

		$view->assign('requests',$requests);
	}


?>
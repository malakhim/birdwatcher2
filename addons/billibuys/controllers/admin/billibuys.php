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
				fn_submit_bids($bb_data,$auth);
			}
			return array(CONTROLLER_STATUS_OK, "billibuys.view");
		}else{
			$requests = fn_get_requests_by_product($_REQUEST['item']);
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
	}




?>